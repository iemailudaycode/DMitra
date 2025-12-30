<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

?>
<?php
// job_details.php
require_once 'config.php';

$job_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$stmt = $pdo->prepare("SELECT j.*, c.name as category_name FROM jobs j JOIN categories c ON j.category_id = c.id WHERE j.id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    die("Job not found");
}

function makeClickable($text) {
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" class="text-blue-500 hover:text-blue-700 underline" target="_blank">$1</a>', $text);
}
?>

<?php
require_once 'config.php';


$job_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$stmt = $pdo->prepare("SELECT j.*, c.name as category_name FROM jobs j JOIN categories c ON j.category_id = c.id WHERE j.id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    die("Job not found");
}

$is_logged_in = isset($_SESSION['user_id']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?> - Job Details</title>
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
        <h1 class="text-4xl font-bold mb-4 text-center text-blue-800" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0"><?php echo htmlspecialchars($job['title']); ?></h1>
        <p class="text-2xl mb-8 text-center text-purple-700" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">Category: <?php echo htmlspecialchars($job['category_name']); ?></p>
        <div class="bg-white shadow-lg rounded-lg p-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
            <h2 class="text-2xl font-semibold mb-6 text-blue-800">Job Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="mb-4"><strong class="text-purple-700">Application Fee:</strong> Rs.<?php echo htmlspecialchars($job['application_fee']); ?></p>
                    <p class="mb-4"><strong class="text-purple-700">Important Dates:</strong></p>
                    <ul class="list-disc list-inside mb-4 ml-4">
                        <li>Starting Date: <?php echo htmlspecialchars($job['start_date']); ?></li>
                        <li>Last Date: <?php echo htmlspecialchars($job['end_date']); ?></li>
                    </ul>
                    <p class="mb-4"><strong class="text-purple-700">Age Limit:</strong></p>
                    <ul class="list-disc list-inside mb-4 ml-4">
                        <li>Minimum Age Limit: <?php echo htmlspecialchars($job['min_age']); ?></li>
                        <li>Maximum Age Limit: <?php echo htmlspecialchars($job['max_age']); ?></li>
                    </ul>
                </div>
                <div>
                    <p class="mb-4"><strong class="text-purple-700">Physical Standards:</strong></p>
                    <ul class="list-disc list-inside mb-4 ml-4">
                        <li>Male Height: <?php echo htmlspecialchars($job['male_height']); ?> cm</li>
                        <li>Female Height: <?php echo htmlspecialchars($job['female_height']); ?> cm</li>
                        <li>Chest (for Male Only): <?php echo htmlspecialchars($job['chest_male']); ?> cm</li>
                        <li>Weight: <?php echo htmlspecialchars($job['weight']); ?> kg</li>
                    </ul>
                    <p class="mb-4"><strong class="text-purple-700">Qualification:</strong> <?php echo nl2br(htmlspecialchars($job['qualification'])); ?></p>
                </div>
            </div>
            <div class="mt-6">
                <p class="mb-4"><strong class="text-purple-700">Apply Online:</strong> <a href="<?php echo htmlspecialchars($job['apply_link']); ?>" class="text-blue-500 hover:text-blue-700 underline" target="_blank">Click here</a></p>
                <p class="mb-4"><strong class="text-purple-700">Official Website:</strong> <a href="<?php echo htmlspecialchars($job['official_website']); ?>" class="text-blue-500 hover:text-blue-700 underline" target="_blank">Click here</a></p>
                <p class="mb-4"><strong class="text-purple-700">Detailed Notification:</strong> <?php echo makeClickable(nl2br(htmlspecialchars($job['detailed_notification']))); ?></p>
                <p class="mb-4"><strong class="text-purple-700">Study Material:</strong> <?php echo makeClickable(nl2br(htmlspecialchars($job['study_material']))); ?></p>
                <p class="mb-4"><strong class="text-purple-700">YouTube Links:</strong> <?php echo makeClickable(nl2br(htmlspecialchars($job['youtube_links']))); ?></p>
            </div>
        </div>
        <!-- <a href="user_view_jobs.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block mt-8 transition duration-300 ease-in-out transform hover:scale-105">Back to Job Listings</a> -->
        <!-- <a href="paid.php" class="ml-4 bg-green-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full inline-block mt-8 transition duration-300 ease-in-out transform hover:scale-105">Get Our Service</a> -->
        <section class="text-gray-600 body-font">
  <div class="container px-5 py-5 mx-auto flex items-center md:flex-row flex-col">
    <div class="flex flex-col md:pr-10 md:mb-0 mb-6 pr-0 w-full md:w-auto md:text-left text-center">
      <h1 class="md:text-3xl text-2xl font-medium title-font text-gray-900">Try Our Paid Services</h1>
    </div>
    <div class="flex md:ml-auto md:mr-0 mx-auto items-center flex-shrink-0 space-x-4">
    <a href="paid.php"> <button class="bg-green-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full inline-block mt-8 transition duration-300 ease-in-out transform hover:scale-105">Get Our Service</button></a>
    <a href="user_view_jobs.php"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block mt-8 transition duration-300 ease-in-out transform hover:scale-105">Back to Job Listings</button></a>
        
        
   
    </div>
  </div>
</section>
    </div>


   




    <?php include 'footer.php' ?>

</body>
</html>