<?php
session_start();

// Database configuration
$host = 'localhost';
$db   = 'dmitra1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// AJAX handler for fetching posts
if (isset($_GET['action']) && $_GET['action'] == 'get_posts') {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_NUMBER_INT);

    if (!$category_id) {
        echo json_encode([]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, title FROM jobs WHERE category_id = ?");
        $stmt->execute([$category_id]);
        $posts = $stmt->fetchAll();
        
        echo json_encode($posts);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode([]);
    }
    exit;
}

// Fetch job categories
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo->beginTransaction();

        // Insert into job_applications table
        $stmt = $pdo->prepare("INSERT INTO job_applications (job_id, name, contact, alt_contact, email, height, weight, gender, dob, blood_group, ex_serviceman, relative_in_service) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['post'],
            $_POST['name'],
            $_POST['contact'],
            $_POST['alt_contact'],
            $_POST['email'],
            $_POST['height'],
            $_POST['weight'],
            $_POST['gender'],
            $_POST['dob'],
            $_POST['blood_group'],
            $_POST['ex_serviceman'] == 'yes' ? 1 : 0,
            $_POST['relative_in_service']
        ]);

        $application_id = $pdo->lastInsertId();

        // Handle file upload for payment proof
        $upload_dir = 'uploads/';
        $file_name = uniqid() . '_' . $_FILES['payment_proof']['name'];
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $file_path)) {
            // Insert into paid_requests table
            $stmt = $pdo->prepare("INSERT INTO paid_requests (application_id, amount, payment_proof) VALUES (?, ?, ?)");
            $stmt->execute([$application_id, 100.00, $file_path]); // Assuming a fixed amount of 100.00

            $pdo->commit();
            echo "<script> alert('Application submitted successfully!');</script>";
            header("Location: index.php");

        } else {
            throw new Exception("Failed to upload file.");
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    exit;
}
?>
<?php
// PHP code remains the same as in your original file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form - D-Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="min-h-screen pt-16 pb-12">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r ">
        <?php include'header.php'?>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-8" x-data="{ step: 1 }">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800 animate-fade-in-up">Job Application Form</h1>
        
        <!-- Progress indicator -->
        <div class="mb-8 bg-white rounded-lg shadow-md p-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex justify-between">
                    <div class="w-1/3 text-center" :class="{ 'text-blue-600 font-bold': step === 1 }">
                        <div class="rounded-full h-8 w-8 flex items-center justify-center bg-blue-600 text-white mx-auto mb-2" :class="{ 'bg-blue-600': step >= 1, 'bg-gray-300': step < 1 }">1</div>
                        Personal Info
                    </div>
                    <div class="w-1/3 text-center" :class="{ 'text-blue-600 font-bold': step === 2 }">
                        <div class="rounded-full h-8 w-8 flex items-center justify-center bg-gray-300 text-white mx-auto mb-2" :class="{ 'bg-blue-600': step >= 2, 'bg-gray-300': step < 2 }">2</div>
                        Job Details
                    </div>
                    <div class="w-1/3 text-center" :class="{ 'text-blue-600 font-bold': step === 3 }">
                        <div class="rounded-full h-8 w-8 flex items-center justify-center bg-gray-300 text-white mx-auto mb-2" :class="{ 'bg-blue-600': step >= 3, 'bg-gray-300': step < 3 }">3</div>
                        Payment
                    </div>
                </div>
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-500 ease-in-out" :style="{ width: (step / 3 * 100) + '%' }"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <form action="" method="POST" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-xl animate-fade-in-up" enctype="multipart/form-data">
            <!-- Step 1: Personal Information -->
            <div x-show="step === 1">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly class="bg-gray-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name (as per Aadhaar card)</label>
                        <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">Contact Number</label>
                        <input type="tel" id="contact" name="contact" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="alt_contact" class="block text-gray-700 text-sm font-bold mb-2">Alternate Contact Number</label>
                        <input type="tel" id="alt_contact" name="alt_contact" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="button" @click="step = 2" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        Next
                    </button>
                </div>
            </div>

            <!-- Step 2: Physical Details and Job Preferences -->
            <div x-show="step === 2">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Physical Details and Job Preferences</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="height" class="block text-gray-700 text-sm font-bold mb-2">Height (cm)</label>
                        <input type="number" id="height" name="height" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="weight" class="block text-gray-700 text-sm font-bold mb-2">Weight (kg)</label>
                        <input type="number" id="weight" name="weight" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="gender" value="male" required>
                                <span class="ml-2">Male</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio" name="gender" value="female">
                                <span class="ml-2">Female</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="blood_group" class="block text-gray-700 text-sm font-bold mb-2">Blood Group</label>
                        <select id="blood_group" name="blood_group" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select blood group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    <div>
                        <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Job Category</label>
                        <select id="category" name="category" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select a category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="post" class="block text-gray-700 text-sm font-bold mb-2">Post</label>
                        <select id="post" name="post" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select a post</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" @click="step = 1" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        Previous
                    </button>
                    <button type="button" @click="step = 3" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        Next
                    </button>
                </div>
            </div>

            <!-- Step 3: Additional Information and Payment -->
            <div x-show="step === 3">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Additional Information and Payment</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Ex-serviceman</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="ex_serviceman" value="yes" required>
                            <span class="ml-2">Yes</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="ex_serviceman" value="no">
                            <span class="ml-2">No</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">

                    <label for="relative_in_service" class="block text-gray-700 text-sm font-bold mb-2">Relative Name in Service (if applicable, or NA)</label>
                    <input type="text" id="relative_in_service" name="relative_in_service" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-bold mb-2">Payment Information -Application Fees + Rs.500(Service Charges)</h3>
                    <img src="qr.png" alt="Payment QR Code" class="mb-4 mx-auto w-48 h-48 object-contain">
                    <label for="payment_proof" class="block text-gray-700 text-sm font-bold mb-2">Upload Payment Proof</label>
                    <input type="file" id="payment_proof" name="payment_proof" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-bold mb-2">Important Notes:</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        <li>Please ensure all information provided matches your Aadhaar card details.</li>
                        <li>Double-check your contact information for accuracy.</li>
                        <li>Make sure to upload a clear image of your payment proof.</li>
                        <li>Applications with incomplete or incorrect information may be rejected.</li>
                        <li>For any queries, please contact our support team at support@d-mitra.com</li>
                    </ul>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" @click="step = 2" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        Previous
                    </button>
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        Submit Application
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            const categoryId = this.value;
            const postSelect = document.getElementById('post');
            
            // Clear existing options
            postSelect.innerHTML = '<option value="">Select a post</option>';
            
            if (categoryId) {
                // Fetch posts for the selected category using AJAX
                fetch(`?action=get_posts&category_id=${categoryId}`)
                    .then(response => response.json())
                    .then(posts => {
                        posts.forEach(post => {
                            const option = document.createElement('option');
                            option.value = post.id;
                            option.textContent = post.title;
                            postSelect.appendChild(option);
                        });
                    });
            }
        });

        // Add some animations when the page loads
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelector('header').classList.add('animate-fade-in-up');
            setTimeout(() => {
                document.querySelector('form').classList.add('animate-fade-in-up');
            }, 300);
        });
    </script>
</body>
</html>