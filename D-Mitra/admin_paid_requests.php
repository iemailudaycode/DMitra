<?php
session_start();
require_once 'config.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $request_id = filter_input(INPUT_POST, 'request_id', FILTER_SANITIZE_NUMBER_INT);
    $new_status = $_POST['action'] == 'approve' ? 'approved' : 'rejected';
    
    $stmt = $pdo->prepare("UPDATE paid_requests SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $request_id]);
    
    // Redirect to refresh the page
    header("Location: admin_paid_requests.php");
    exit();
}

// Fetch paid requests with related information
$query = "SELECT pr.id, pr.amount, pr.payment_proof, pr.status, pr.created_at,
                 ja.id as application_id, ja.name, ja.email, ja.contact, ja.alt_contact, 
                 ja.height, ja.weight, ja.gender, ja.dob, ja.blood_group, 
                 ja.ex_serviceman, ja.relative_in_service,
                 j.title as job_title, c.name as category_name
          FROM paid_requests pr
          JOIN job_applications ja ON pr.application_id = ja.id
          JOIN jobs j ON ja.job_id = j.id
          JOIN categories c ON j.category_id = c.id
          ORDER BY pr.created_at DESC";
$stmt = $pdo->query($query);
$paid_requests = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Paid Requests Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        [x-cloak] { display: none !important; }
        .glassmorphism {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-scale {
            transition: transform 0.3s ease;
        }
        .animate-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="min-h-screen py-12 px-4 sm:px-6 lg:px-8" x-data="{ showModal: false, selectedRequest: null }">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-10 animate-fade-in-up">Paid Requests Management</h1>
        
        
        <div class="glassmorphism p-8 animate-fade-in-up" style="animation-delay: 0.2s;">
        <ul class="flex justify-center space-x-4">
                <li><a href="admin_paid_requests.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Paid Requests</a></li>
                <li><a href="admin_dashboard.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Manage Jobs</a></li>
                <li><a href="admin_post_job.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Post New Job</a></li>
                <li><a href="admin_logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Logout</a></li>
            </ul>
            <div class="py-6 mb-6">
                <input type="text" id="searchInput" placeholder="Search by name or email" class="w-full p-4 rounded-full border-none focus:ring-2 focus:ring-blue-400 transition duration-300 bg-white bg-opacity-50">
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        <?php foreach ($paid_requests as $index => $request): ?>
                            <tr class="hover:bg-gray-50 animate-fade-in-up" style="animation-delay: <?= 0.1 * ($index + 1) ?>s;">
                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($request['name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($request['email']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($request['job_title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">Rs. <?= number_format($request['amount'], 2) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php
                                        switch ($request['status']) {
                                            case 'approved':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'rejected':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-yellow-100 text-yellow-800';
                                        }
                                        ?>">
                                        <?= ucfirst($request['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= date('M d, Y', strtotime($request['created_at'])) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button @click="showModal = true; selectedRequest = <?= htmlspecialchars(json_encode($request)) ?>" class="text-indigo-600 hover:text-indigo-900 animate-scale">View Details</button>
                                    <?php if ($request['status'] == 'pending'): ?>
                                        <form method="POST" class="inline-block ml-2">
                                            <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                            <button type="submit" name="action" value="approve" class="text-green-600 hover:text-green-900 animate-scale">Approve</button>
                                            <button type="submit" name="action" value="reject" class="text-red-600 hover:text-red-900 ml-2 animate-scale">Reject</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center" x-cloak>
        <div @click.away="showModal = false" class="glassmorphism p-8 max-w-2xl w-full animate-fade-in-up">
            <h3 class="text-2xl font-bold text-gray-900 mb-6" x-text="selectedRequest ? 'Request Details for ' + selectedRequest.name : ''"></h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="selectedRequest">
                <div>
                    <p class="mb-2"><strong>Application ID:</strong> <span x-text="selectedRequest.application_id"></span></p>
                    <p class="mb-2"><strong>Job Title:</strong> <span x-text="selectedRequest.job_title"></span></p>
                    <p class="mb-2"><strong>Category:</strong> <span x-text="selectedRequest.category_name"></span></p>
                    <p class="mb-2"><strong>Email:</strong> <span x-text="selectedRequest.email"></span></p>
                    <p class="mb-2"><strong>Contact:</strong> <span x-text="selectedRequest.contact"></span></p>
                    <p class="mb-2"><strong>Alternate Contact:</strong> <span x-text="selectedRequest.alt_contact"></span></p>
                </div>
                <div>
                    <p class="mb-2"><strong>Height:</strong> <span x-text="selectedRequest.height + ' cm'"></span></p>
                    <p class="mb-2"><strong>Weight:</strong> <span x-text="selectedRequest.weight + ' kg'"></span></p>
                    <p class="mb-2"><strong>Gender:</strong> <span x-text="selectedRequest.gender"></span></p>
                    <p class="mb-2"><strong>Date of Birth:</strong> <span x-text="selectedRequest.dob"></span></p>
                    <p class="mb-2"><strong>Blood Group:</strong> <span x-text="selectedRequest.blood_group"></span></p>
                    <p class="mb-2"><strong>Ex-serviceman:</strong> <span x-text="selectedRequest.ex_serviceman ? 'Yes' : 'No'"></span></p>
                </div>
            </div>
            <div class="mt-6 bg-white bg-opacity-50 p-4 rounded-lg" x-show="selectedRequest">
                <h4 class="font-bold text-lg mb-2">Payment Information</h4>
                <p class="mb-2"><strong>Amount Paid:</strong> <span x-text="'Rs.' + selectedRequest.amount"></span></p>
                <p class="mb-2"><strong>Payment Status:</strong> <span x-text="selectedRequest.status" class="capitalize"></span></p>
                <p class="mb-2"><strong>Payment Date:</strong> <span x-text="selectedRequest.created_at"></span></p>
                <p class="mb-2"><strong>Payment Proof:</strong> <a :href="selectedRequest.payment_proof" target="_blank" class="text-blue-600 hover:text-blue-800 underline">View Payment Proof</a></p>
            </div>
            <div class="mt-8 text-right">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 animate-scale">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();

            rows.forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const email = row.cells[1].textContent.toLowerCase();
                const shouldShow = name.includes(searchTerm) || email.includes(searchTerm);
                row.style.display = shouldShow ? '' : 'none';
            });
        });
    </script>
</body>
</html>