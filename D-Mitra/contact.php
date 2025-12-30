<?php
// contact.php
require_once 'config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message_body = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Here you would typically send an email or save to database
    // For this example, we'll just set a success message
    $message = "Thank you for your message, $name! We'll get back to you soon.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Para-Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .contact-pattern {
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
<?php include 'header.php' ?>

    <header x-data="{ mobileMenuOpen: false }" class="bg-white shadow-md">
        <!-- Same header as in index.php -->
    </header>

    <main>
        <section class="contact-pattern text-white py-20">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl mb-8">Get in touch with our team</p>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Send Us a Message</h2>
                        <?php if ($message): ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline"><?php echo $message; ?></span>
                            </div>
                        <?php endif; ?>
                        <form action="contact.php" method="POST" class="space-y-4">
                            <div>
                                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                                <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="subject" class="block text-gray-700 font-bold mb-2">Subject</label>
                                <input type="text" id="subject" name="subject" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
                                <textarea id="message" name="message" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">Send Message</button>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Contact Information</h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-3"></i>
                                <p class="text-gray-600">123 Job Street, sonytech belgaum, 590010</p>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone text-blue-600 mt-1 mr-3"></i>
                                <p class="text-gray-600">+91 6361723454</p>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-blue-600 mt-1 mr-3"></i>
                                <p class="text-gray-600">info@sonytech.in</p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300"><i class="fab fa-facebook-f fa-2x"></i></a>
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300"><i class="fab fa-twitter fa-2x"></i></a>
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300"><i class="fab fa-linkedin-in fa-2x"></i></a>
                                <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300"><i class="fab fa-instagram fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Frequently Asked Questions</h2>
                <div class="space-y-4" x-data="{selected:null}">
                    <div class="border border-gray-200 rounded-md">
                        <button
                            @click="selected !== 1 ? selected = 1 : selected = null"
                            class="flex justify-between items-center w-full p-4 focus:outline-none"
                        >
                            <span class="font-semibold text-left">How do I create an account?</span>
                            <span class="fas" :class="{'fa-chevron-down': selected !== 1, 'fa-chevron-up': selected === 1}"></span>
                        </button>
                        <div x-show="selected === 1" class="p-4 border-t border-gray-200">
                            To create an account, click on the "Sign Up" button in the top right corner of the page and follow the prompts to enter your information.
                        </div>
                    </div>
                    Add more FAQ items here
                </div>
            </div>
        </section> -->
    </main>
    <?php include 'footer.php' ?>

</body>
</html>