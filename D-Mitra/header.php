<header x-data="{ mobileMenuOpen: false }" class=" bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3">
        

            <div class="flex justify-between items-center">
            <a href="index.php"><div class="text-2xl font-bold text-gray-800">D-Mitra</div></a>
                <div class="hidden md:flex space-x-4">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Home</a>
                    <a href="user_view_jobs.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Jobs</a>
                    <a href="about.php" class="text-gray-800 hover:text-blue-600 transition duration-300">About</a>
                    <a href="contact.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Contact</a>
                    <a href="admin_dashboard.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Admin</a>
                    <a href="login.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Login</a>
                    <!-- <a href="logout.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Logout</a> -->

                    
                    <!-- <?php //if (isset($_SESSION['user_id'])) {?>
                    <a href="logout.php" class="text-gray-800 hover:text-blue-600 transition duration-300">Logout</a>

                    <?php //} ?> -->
                </div>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden focus:outline-none">
                    <svg class="h-6 w-6 fill-current text-gray-800" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                        <path x-show="mobileMenuOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    </svg>
                </button>
            </div>
            <div x-show="mobileMenuOpen" class="md:hidden mt-4 space-y-2">
                <a href="index.php" class="block text-gray-800 hover:text-blue-600 transition duration-300">Home</a>
                <a href="user_view_jobs.php" class="block text-gray-800 hover:text-blue-600 transition duration-300">Jobs</a>
                <a href="about.php" class="block text-gray-800 hover:text-blue-600 transition duration-300">About</a>
                <a href="contact.php" class="block text-gray-800 hover:text-blue-600 transition duration-300">Contact</a>
                <a href="admin_dashboard.php" class="block text-gray-800 hover:text-blue-600 transition duration-300">Admin</a>
                <a href="login.php" class="block text-gray-800 hover:text-blue-600 transition duration-300">Login</a>
            </div>
        </nav>
    </header>