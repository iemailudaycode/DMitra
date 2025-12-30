<?php
// user_view_jobs.php
require_once 'config.php';

$category_id = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT) ?? null;

if ($category_id) {
    $stmt = $pdo->prepare("SELECT j.*, c.name as category_name FROM jobs j JOIN categories c ON j.category_id = c.id WHERE j.category_id = ?");
    $stmt->execute([$category_id]);
} else {
    $stmt = $pdo->query("SELECT j.*, c.name as category_name FROM jobs j JOIN categories c ON j.category_id = c.id");
}
$jobs = $stmt->fetchAll();

// Fetch all categories for the navigation
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
<?php include 'header.php' ?>

    <div x-data="{ showContent: false }" x-init="setTimeout(() => showContent = true, 100)" class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8 text-center text-blue-800" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">Job Listings</h1>
        <nav class="mb-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <ul class="flex flex-wrap justify-center space-x-4">
                <li><a href="user_view_jobs.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">All Jobs</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="user_view_jobs.php?category=<?php echo $category['id']; ?>" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105"><?php echo htmlspecialchars($category['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
            <?php foreach ($jobs as $index => $job): ?>
                <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" class="bg-white shadow-lg rounded-lg p-6 transition duration-300 ease-in-out transform hover:-translate-y-2" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="transition-delay: <?php echo $index * 100; ?>ms">
                    <h2 class="text-2xl font-semibold mb-4 text-blue-800"><?php echo htmlspecialchars($job['title']); ?></h2>
                    <p class="text-gray-600 mb-2">Category: <?php echo htmlspecialchars($job['category_name']); ?></p>
                    <p class="text-gray-600 mb-2">Application Fee: Rs.<?php echo htmlspecialchars($job['application_fee']); ?></p>
                    <p class="text-gray-600 mb-4">Last Date: <?php echo htmlspecialchars($job['end_date']); ?></p>
                    <a href="job_details.php?id=<?php echo $job['id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block transition duration-300 ease-in-out transform hover:scale-105">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include 'footer.php' ?>

</body>
</html>