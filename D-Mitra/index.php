<?php
// index.php
require_once 'config.php';

// Fetch latest jobs
$stmt = $pdo->query("SELECT j.*, c.name as category_name FROM jobs j JOIN categories c ON j.category_id = c.id ORDER BY j.created_at DESC LIMIT 6");
$latest_jobs = $stmt->fetchAll();

// Fetch all categories
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>
<?php
// PHP code remains the same as in your original file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-Mitra - Find Your Dream Job</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-pattern {
            position: relative;
            overflow: hidden;
        }
        .hero-pattern::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,165,0,0.2), rgba(255,255,255,0.2), rgba(0,128,0,0.2));
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        h1 {
  color: white;
  text-shadow:
   -1px -1px 0 #000,  
    1px -1px 0 #000,
    -1px 1px 0 #000,
     1px 1px 0 #000;
}
    </style>
</head>

<body class="bg-gray-100">
    <?php include 'header.php' ?>

    <main>
        <section class="hero-pattern text-white py-96 relative">
            <video autoplay loop muted class="absolute inset-0 w-full h-full object-cover">
                <source src="xxx.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="container mx-auto px-6 text-center hero-content">
                <h1 class="text-5xl text-white font-bold mb-4 animate__animated animate__fadeInDown">Explore the D-Mitra</h1>
                <p class="text-xl text-white mb-8 animate__animated animate__fadeInUp animate__delay-1s">Explore thousands of job opportunities with all the information you need.</p>
                <br> <br> <a href="user_view_jobs.php" class="bg-white text-blue-600 font-bold py-3 px-6 rounded-full hover:bg-blue-100 transition duration-300 transform hover:scale-105 animate__animated animate__fadeInUp animate__delay-2s">
                    Explore Jobs
                </a>
            </div>
        </section>

        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8 animate__animated animate__fadeInDown">Job Categories</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    <?php foreach ($categories as $index => $category): ?>
                        <a href="category_info.php?id=<?php echo $category['id']; ?>" 
                           class="glass-effect p-6 text-center transition duration-300 transform hover:-translate-y-1 group animate__animated animate__fadeInUp" 
                           style="animation-delay: <?php echo $index * 0.1; ?>s">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600 transition duration-300">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </h3>
                            <p class="mt-2 text-gray-600 group-hover:text-blue-500 transition duration-300">Learn More</p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8 animate__animated animate__fadeInDown">Latest Job Openings</h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($latest_jobs as $job): ?>
                            <div class="swiper-slide">
                                <div class="glass-effect p-6 h-full">
                                    <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($job['title']); ?></h3>
                                    <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($job['category_name']); ?></p>
                                    <p class="text-gray-700 mb-4">Application Deadline: <?php echo htmlspecialchars($job['end_date']); ?></p>
                                    <a href="job_details.php?id=<?php echo $job['id']; ?>" class="text-blue-600 hover:text-blue-800 font-semibold">Learn More &rarr;</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="text-center mt-12">
                    <a href="user_view_jobs.php" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-700 transition duration-300 transform hover:scale-105 animate__animated animate__fadeInUp">
                        View All Jobs
                    </a>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php' ?>

    <script>
        new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
            },
            autoplay: {
                delay: 5000,
            },
        });
    </script>
</body>
</html>