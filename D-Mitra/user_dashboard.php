<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Fetch job applications (you'll need to create an applications table for this)
$stmt = $pdo->prepare("SELECT a.*, j.title as job_title, c.name as category_name 
                       FROM applications a 
                       JOIN jobs j ON a.job_id = j.id 
                       JOIN categories c ON j.category_id = c.id 
                       WHERE a.user_id = ?");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Military Job Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Military Job Board</h1>
            <nav>
                <a href="index.php" class="mr-4">Home</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <h2 class="text-3xl font-bold mb-8">Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Your Information</h3>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Member since:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Your Applications</h3>
                <?php if (count($applications) > 0): ?>
                    <ul>
                        <?php foreach ($applications as $application): ?>
                            <li class="mb-2">
                                <strong><?php echo htmlspecialchars($application['job_title']); ?></strong> 
                                (<?php echo htmlspecialchars($application['category_name']); ?>)
                                - Status: <?php echo htmlspecialchars($application['status']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>You haven't applied to any jobs yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2023 Military Job Board. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
