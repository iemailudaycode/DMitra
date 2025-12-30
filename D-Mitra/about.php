<?php
// about.php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - D-Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .about-pattern {
            background-color: #8EC5FC;
            background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
<?php include 'header.php' ?>

    <main>
        <section class="about-pattern text-white py-20">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold mb-4">About Us</h1>
                <p class="text-xl mb-8">Learn more about our mission and vision</p>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Story</h2>
                        <p class="text-gray-600 mb-4">
                        D-Mitra was founded in 2022 with a simple mission: to connect talented individuals with their dream jobs. We understand the challenges of job hunting and aim to make the process as smooth as possible for both job seekers and employers.
                        </p>
                        <p class="text-gray-600 mb-4">
                            Our platform has grown to become one of the most trusted D-Mitras in the country, featuring a wide range of opportunities across various industries and sectors.
                        </p>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <img src="https://cdn.pixabay.com/photo/2017/08/15/16/04/indian-flag-2644512_1280.jpg" alt="Our Team" class="rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-lg shadow-md p-6 text-center">
                        <i class="fas fa-handshake text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Integrity</h3>
                        <p class="text-gray-600">We believe in honesty and transparency in all our dealings.</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center">
                        <i class="fas fa-users text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Community</h3>
                        <p class="text-gray-600">We foster a supportive community for job seekers and employers.</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center">
                        <i class="fas fa-lightbulb text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Innovation</h3>
                        <p class="text-gray-600">We continuously improve our platform to meet the evolving needs of the job market.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Team</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <img height="150px" width="150px" src="head.png" alt="Team Member 2" class="rounded-full mx-auto mb-4">
                        <h3 class="text-xl font-semibold mb-2">Balkrushna Jadhav</h3>
                        <p class="text-gray-600">Operation Head</p>
                    </div>
                    <div class="text-center">
                        <img height="150px" width="150px" src="founder.png" alt="Team Member 1" class="rounded-full mx-auto mb-4">
                        <h3 class="text-xl font-semibold mb-2">Suprith Yalaigol & Uday Chougule</h3>
                        <p class="text-gray-600">Founder & CEO</p>
                    </div>
                    
                    <div class="text-center">
                        <img height="150px" width="150px" src="lead.png" alt="Team Member 3" class="rounded-full mx-auto mb-4">
                        <h3 class="text-xl font-semibold mb-2">Ashish Joshi</h3>
                        <p class="text-gray-600">Lead Developer</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Join Our Community</h2>
                <p class="text-gray-600 mb-8">Be part of our growing network of job seekers and employers.</p>
                <a href="user_view_jobs.php" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                    Explore Jobs
                </a>
            </div>
        </section>
    </main>
    <?php include 'footer.php' ?>

</body>
</html>