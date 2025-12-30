<?php

// category_info.php
require_once 'config.php';

$category_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Fetch all categories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$all_categories = $stmt->fetchAll();

// Fetch current category details
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$category_id]);
$current_category = $stmt->fetch();

if (!$current_category) {
    die("Category not found");
}

// Dummy information for each category
$category_info = [
    'Army' => [
        'description' => 'The Indian Army offers both professional and personal growth at every stage, with opportunities for education, adventure, and leadership development. 
        It provides various courses, paid study leave, and a lifestyle filled with social interaction, sports, and excellent medical care. 
        Perks include subsidized housing, free medical services, canteen facilities, and a strong sense of belonging. 
        Joining the Army is possible after school or graduation, offering a fulfilling career with attractive pay and benefits in a healthy, supportive environment.
        ',
        'slides' => [
            ['image' => 'https://w0.peakpx.com/wallpaper/18/923/HD-wallpaper-indian-soldiers-with-flag-indian-army.jpg', 'caption' => 'Serving with Pride'],
            ['image' => 'https://images.hindustantimes.com/img/2022/01/11/1600x900/8f93238c-72cc-11ec-8f22-243e37ddc844_1641898533811.jpg', 'caption' => 'Protecting Our Borders'],
            ['image' => 'https://w0.peakpx.com/wallpaper/881/118/HD-wallpaper-training-of-indian-army-indian-army.jpg', 'caption' => 'Rigorous Training']
        ]
    ],
    'Navy' => [
        'description' => 'The Border Security Force (BSF) is India\'s primary border guarding organisation on its border with Pakistan and Bangladesh. It is one of the five Central Armed Police Forces of India, and was raised in the wake of the 1965 War.',
        'slides' => [
            ['image' => 'https://w0.peakpx.com/wallpaper/899/898/HD-wallpaper-login-background-indian-navy-navy-navy-day-navy-sailor.jpg', 'caption' => 'Guarding Our Frontiers'],
            ['image' => 'https://images.cnbctv18.com/wp-content/uploads/2023/01/Indian-Navy-Shutterstock-1019x573.jpg', 'caption' => 'Constant Vigilance'],
            ['image' => 'https://www.naval-technology.com/wp-content/uploads/sites/15/2020/06/800px-Rana-081022-N-7730P-008.jpg', 'caption' => 'National Security']
        ]
    ],
    'Air Force' => [
        'description' => "The Indian Air Force (IAF), established in 1932, is India's aerial defense force responsible for protecting the nation's airspace, conducting air warfare, and supporting humanitarian missions. 
        With a diverse fleet of advanced aircraft and cutting-edge technology, the IAF ensures national security and contributes to global peacekeeping efforts. 
        Known for its operational readiness, strategic capabilities, and a tradition of gallantry, the IAF plays a pivotal role in safeguarding India's interests and responding to emergencies both domestically and internationally. 
        ",
        'slides' => [
            ['image' => 'https://media.cntraveller.in/wp-content/uploads/2017/01/airforcewomenlead-1366x768.jpg', 'caption' => 'Guarding Our Frontiers'],
            ['image' => 'https://carnegie-production-assets.s3.amazonaws.com/static/media/images/Kargil_605x328-1.jpg', 'caption' => 'Constant Vigilance'],
            ['image' => 'https://assets.telegraphindia.com/telegraph/33b2abc5-b19e-48fc-88c4-bbf79ef291e9.jpg', 'caption' => 'National Security']
        ]
    ],
     
];

$info = $category_info[$current_category['name']] ?? [
    'description' => 'Information about this category is coming soon.',
    'slides' => [
        ['image' => 'https://source.unsplash.com/random/800x600/?security', 'caption' => 'Serving the Nation'],
        ['image' => 'https://source.unsplash.com/random/800x600/?police', 'caption' => 'Ensuring Safety'],
        ['image' => 'https://source.unsplash.com/random/800x600/?force', 'caption' => 'Protecting Citizens']
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($current_category['name']); ?> Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /><br>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .swiper-container {
            width: 100%;
            height: 300px;
            position: relative;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .swiper-slide .caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
        }
        .swiper-button-next, .swiper-button-prev {
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 20px;
        }
        .swiper-pagination-bullet {
            background-color: white;
            opacity: 0.7;
        }
        .swiper-pagination-bullet-active {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
<?php include 'header.php' ?>

    <div x-data="{ showContent: false }" x-init="setTimeout(() => showContent = true, 100)" class="container mx-auto p-4 md:p-8">
        <nav class="text-sm font-semibold mb-6" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="index.php" class="text-gray-500 hover:text-blue-600">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li class="flex items-center">
                    <span class="text-gray-700"><?php echo htmlspecialchars($current_category['name']); ?> Information</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-wrap md:flex-nowrap">
            <!-- Sidebar for all categories -->
            <div class="w-full md:w-1/4 md:pr-8 mb-8 md:mb-0">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4 text-blue-600">All Categories</h2>
                    <ul class="space-y-2">
                        <?php foreach ($all_categories as $cat): ?>
                            <li>
                                <a href="category_info.php?id=<?php echo $cat['id']; ?>" 
                                   class="block p-2 rounded <?php echo ($cat['id'] == $category_id) ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100'; ?> transition duration-300">
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <div class="w-full md:w-3/4">
                <h1 class="text-4xl font-bold mb-8 text-center text-blue-800" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                Life in <?php echo htmlspecialchars($current_category['name']); ?>
                </h1>

                <div class="mb-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div class="swiper-container rounded-lg overflow-hidden">
                        <div class="swiper-wrapper">
                            <?php foreach ($info['slides'] as $slide): ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo htmlspecialchars($slide['image']); ?>" alt="<?php echo htmlspecialchars($slide['caption']); ?>">
                                    <div class="caption">
                                        <h3 class="text-white text-xl font-bold"><?php echo htmlspecialchars($slide['caption']); ?></h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div> <>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-8 mb-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <h2 class="text-2xl font-bold mb-4 text-blue-600">About <?php echo htmlspecialchars($current_category['name']); ?></h2>
                    <p class="text-gray-700 leading-relaxed mb-4"><?php echo htmlspecialchars($info['description']); ?></p>
                    <p class="text-gray-700 leading-relaxed">
                    Ranks in INDIAN ARMY: <br>
1. Sepoy <br>   
2. Naik<br>
3. Havildar<br>
4. Naib Subedar<br>
5. Subedar<br>
6. Subedar Major<br>
7. Lieutenant<br>
8. Captain<br>
9. Major<br>
10. Lt Colonel<br>
11. Colonel<br>
12. Brigadier<br>
13. Major General<br>
14. Lt General<br>
15. General<br><br>

How to join Indian army?<br>

Sepoy:
Agniveer (General Duty)<br>
Age - 17½ - 21 Years<br>
Qualifications - 10th pass with 45% & each subject must contain 33%<br><br>
Agniveer Office Assistant / SKT<br>
Age - 17½ - 21 Years<br>
Qualifications - 10+2 pass (60% marks)<br>
(Each subject must have 50% marks) with Maths & English<br><br>
Agniveer (Tech)<br>
Age - 17½ - 21 Years<br>
Qualifications - 10+2 pass (50% Marks)<br>
(Each subject must have 40% marks) with Physics, Chemistry, Math’s<br><br>
SOL Tech (NA)<br>
Age - 17½ - 23 <br>
Qualifications - 10+2 pass (50% Marks)<br>
(Each subject must have 40% marks)
with Physics, Chemistry, Biology<br><br>
Agniveer GD (WMP)<br>
Age - 17½ - 21 Years<br>
Qualifications - 10th pass with 45% & each subject must contain 33%.<br><br>
Agniveer Tradesmen 8th/10th pass<br>
Age - 17½ - 21 Years<br>
Qualifications - 10th / ITI and 8th pass (for some trades) with 45% & each subject must contain 33%.<br><br>

Havildar <br>

Havildar (Education)<br>
Age - 21 - 25 Years<br>
Qualifications - For Group X-MA/MSC/MCA or BA/BSC/BCA with Bed BSC(IT) for Group Y - BSC/BA/BCA (IT) without BEd<br><br>
Surveyor Auto Carto (Engineers)<br>
Age - 20 - 25 Years<br>
Qualifications - BA/BSC with Maths 10+2 (Math & Science)<br><br>
SEPOY (PHARMA)<br>
Age - 17½ - 27 Years<br>
Qualifications - 10+2 pass (50% Marks) (Each subject must have 40% marks) with Physics, Chemistry, Maths<br><br>

Subedar<br>
Catering JCO (ASC)<br>
Age - 21 - 27 Years<br>
Qualifications - 10+2 with Diploma in Hotel Management & Catering Technology<br><br>
JCO Religious Teacher<br>
Age - 27-34 Years<br>
Qualifications - Graduate + He is qualified in his religion.<br><br>

Lieutenant<br>
TGC (Education)<br>
Age - 23 - 27 Years<br>
Qualifications - MA/MSc in 1st or 2nd division<br>
(Presently Suspended)<br><br>
UES<br>
Age - 18-24 Years<br>
Qualifications - Pre-Final Student of Engineering Degree<br>
(Presently Suspended)<br><br>
TGC<br>
Age - 21-27 Years<br>
Qualifications - BE / B.Tech in notified Engineering streams.<br><br>
JAG (Men & Women)<br>
Age - 21-27 Years<br>
Qualifications -LAW Graduate with 55% Aggregate Marks and eligibility for registration of Bar Council of India/State. 
In addition, CLAT PG Score of Preceding year is mandatory for all candidates (including LLM qualified and LLM appearing candidates)<br><br>
National Defence Academy<br>
Age - 16½-19½ Years<br>
Qualifications - 10+2 for Army and with Physics, Chemistry and Maths in 12th for Airforce & Navy.<br><br>
10+2 Tech<br>
Age - 16½-19½ Years<br>
Qualifications - 10+2 ( 60 % marks with PCM) and appeared in JEE mains.<br><br>
Indian Military Academy (Non Tech)<br>
Age - 19-24 Years<br>
Qualifications - Graduate<br><br>
Short Service Commission (Non Tech)<br>
Age - 19-25 Years<br>
Qualifications - Graduate<br><br>
Short Service Commission (Tech)<br>
(Tech Men & Women)<br>
Age - 20-27 Years (Men & Women)<br>
Qualifications - BE / B.Tech in notified Engineering streams.<br><br>
NCC Special (Men & Women)<br>
Age - 19-25 Years<br>
Qualifications - Graduate with 50% aggregate "A” or "B” grade in NCC "C” certificate, 2/3
years (as applicable) in senior Division/Wing
of NCC.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8" x-show="showContent" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="bg-white shadow-lg rounded-lg p-8">
                        <h3 class="text-xl font-bold mb-4 text-blue-600">Key Responsibilities</h3>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Protect national borders</li>
                            <li>Counter insurgency operations</li>
                            <li>Maintain internal security</li>
                            <li>Disaster relief operations</li>
                            <li>Support to civil authorities</li>
                        </ul>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-8">
                        <h3 class="text-xl font-bold mb-4 text-blue-600">Career Benefits</h3>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Job security and stability</li>
                            <li>Opportunities for advancement</li>
                            <li>Comprehensive health care</li>
                            <li>Retirement benefits</li>
                            <li>Prestigious and respected career</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <a href="user_view_jobs.php?category=<?php echo $category_id; ?>" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 inline-block">
                        View <?php echo htmlspecialchars($current_category['name']); ?> Jobs
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>


    <script>
        var swiper = new Swiper('.swiper-container', {
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
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    </script>
</body>
</html>