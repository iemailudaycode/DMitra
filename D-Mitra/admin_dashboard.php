<?php
// admin_dashboard.php
session_start();
require_once 'config.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all jobs
$stmt = $pdo->query("SELECT j.*, c.name as category_name FROM jobs j JOIN categories c ON j.category_id = c.id ORDER BY j.created_at DESC");
$jobs = $stmt->fetchAll();

// Handle job deletion
if (isset($_POST['delete_job'])) {
    $job_id = filter_input(INPUT_POST, 'job_id', FILTER_SANITIZE_NUMBER_INT);
    $stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
    $stmt->execute([$job_id]);
    $_SESSION['message'] = "Job deleted successfully!";
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
    <div x-data="{ showContent: false }" x-init="setTimeout(() => showContent = true, 100)" class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8 text-center text-blue-800" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">Admin Dashboard</h1>
        <nav class="mb-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <ul class="flex justify-center space-x-4">
                <li><a href="admin_paid_requests.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Paid Requests</a></li>
                <li><a href="admin_dashboard.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Manage Jobs</a></li>
                <li><a href="admin_post_job.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Post New Job</a></li>
                <li><a href="admin_logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">Logout</a></li>
            </ul>
        </nav>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h2 class="text-2xl font-semibold mb-4 text-purple-800" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Manage Jobs</h2>
        <div class="overflow-x-auto" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Category</th>
                        <th class="py-3 px-4 text-left">End Date</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($jobs as $job): ?>
                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                        <td class="py-3 px-4"><?php echo htmlspecialchars($job['title']); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($job['category_name']); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($job['end_date']); ?></td>
                        <td class="py-3 px-4">
                            <a href="admin_edit_job.php?id=<?php echo $job['id']; ?>" class="text-blue-500 hover:text-blue-700 mr-2 transition duration-200">Edit</a>
                            <form action="admin_dashboard.php" method="POST" class="inline-block">
                                <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                                <button type="submit" name="delete_job" class="text-red-500 hover:text-red-700 transition duration-200" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>