-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 05:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmitra1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Army'),
(2, 'Navy'),
(3, 'Air Force');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `application_fee` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL,
  `male_height` decimal(5,2) DEFAULT NULL,
  `female_height` decimal(5,2) DEFAULT NULL,
  `chest_male` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `apply_link` varchar(255) DEFAULT NULL,
  `official_website` varchar(255) DEFAULT NULL,
  `detailed_notification` text DEFAULT NULL,
  `study_material` text DEFAULT NULL,
  `youtube_links` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `category_id`, `title`, `application_fee`, `start_date`, `end_date`, `min_age`, `max_age`, `male_height`, `female_height`, `chest_male`, `weight`, `qualification`, `apply_link`, `official_website`, `detailed_notification`, `study_material`, `youtube_links`, `created_at`) VALUES
(1, 1, 'fsdgdsfg', '100.00', '2024-07-27', '2024-07-28', 100, 100, '100.00', '100.00', '100.00', '100.00', 'sdasda', 'https://sonytech.in/', 'https://sonytech.in/', 'snnngnf snnngnf snnngnf snnngnf snnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnf', 'snnngnf snnngnf snnngnf snnngnf snnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnf', 'snnngnf snnngnf snnngnf snnngnf snnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnfsnnngnf snnngnf snnngnf snnngnf', '2024-07-17 10:51:27'),
(2, 2, 'Full onn', '1000.00', '2024-07-21', '2024-07-21', 100, 1111, '999.99', '999.99', '999.99', '100.00', ' asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd ', 'https://sonytech.in/', 'https://sonytech.in/', ' asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd ', ' asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd ', ' asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd  asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd asdasd asdasdasd ', '2024-07-17 11:30:49'),
(3, 1, 'lalalla', '400.00', '2024-07-17', '2024-07-18', 18, 52, '182.00', '170.00', '100.00', '100.00', '10th PUC Ug PG', 'https://sonytech.in/', 'https://sonytech.in/', 'https://sonytech.in/\r\nhttps://sonytech.in/\r\nhttps://sonytech.in/\r\nhttps://sonytech.in/\r\nhttps://sonytech.in/', 'https://sonytech.in/\r\nhttps://sonytech.in/\r\nhttps://sonytech.in/\r\nhttps://sonytech.in/', 'https://sonytech.in/\r\nhttps://sonytech.in/\r\nhttps://sonytech.in/', '2024-07-17 14:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `alt_contact` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `dob` date NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `ex_serviceman` tinyint(1) NOT NULL,
  `relative_in_service` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `name`, `contact`, `alt_contact`, `email`, `height`, `weight`, `gender`, `dob`, `blood_group`, `ex_serviceman`, `relative_in_service`, `created_at`) VALUES
(1, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '150.00', '150.00', 'male', '2024-07-19', 'A-', 1, 'asdfasdf', '2024-07-17 13:30:00'),
(2, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '180.00', '100.00', 'male', '2024-07-11', 'B+', 0, 'asdfasdf', '2024-07-17 14:03:46'),
(3, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '180.00', '100.00', 'male', '2024-07-11', 'B+', 0, 'asdfasdf', '2024-07-17 14:04:28'),
(4, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '800.00', '100.00', 'male', '2024-07-19', 'B+', 0, 'asdfasdf', '2024-07-17 14:05:45'),
(5, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '800.00', '100.00', 'male', '2024-07-19', 'B+', 0, 'asdfasdf', '2024-07-17 14:06:04'),
(6, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '800.00', '100.00', 'male', '2024-07-19', 'B+', 0, 'asdfasdf', '2024-07-17 14:06:42'),
(7, 1, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '100.00', '100.00', 'male', '2024-07-26', 'A+', 1, '', '2024-07-17 14:13:06'),
(8, 3, 'aa aa', '09182869242', '09182869242', 'admin@gmail.com', '100.00', '100.00', 'male', '2024-07-27', 'A-', 0, 'asdfasdf', '2024-07-17 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `paid_requests`
--

CREATE TABLE `paid_requests` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paid_requests`
--

INSERT INTO `paid_requests` (`id`, `application_id`, `amount`, `payment_proof`, `status`, `created_at`) VALUES
(1, 1, '100.00', 'uploads/6697c7583778e_qr.png', 'approved', '2024-07-17 13:30:00'),
(2, 2, '100.00', 'uploads/6697cf42b0a8e_qr.png', 'approved', '2024-07-17 14:03:46'),
(3, 3, '100.00', 'uploads/6697cf6cc096a_qr.png', 'rejected', '2024-07-17 14:04:28'),
(4, 4, '100.00', 'uploads/6697cfb9290a6_qr.png', 'approved', '2024-07-17 14:05:45'),
(5, 5, '100.00', 'uploads/6697cfcc9046b_qr.png', 'rejected', '2024-07-17 14:06:04'),
(6, 6, '100.00', 'uploads/6697cff2b5f15_qr.png', 'rejected', '2024-07-17 14:06:42'),
(7, 7, '100.00', 'uploads/6697d1720868c_qr.png', 'approved', '2024-07-17 14:13:06'),
(8, 8, '100.00', 'uploads/6697de03e0998_qr.png', 'approved', '2024-07-17 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'pranay', 'zz@zz.com', '$2y$10$gX63w3hZOZ.9vGP/olXo9e.4SOM6HEJ9RqLRQRcuxAeqotDhJGza2', '2024-07-17 10:44:06'),
(4, 'u1', 'u1@u.com', '$2y$10$YWHFwcpLmy1.FcPcAIhXhesrdbHZyb9rhdeMs/42.mpDzhBPvXjRy', '2024-07-17 11:15:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `paid_requests`
--
ALTER TABLE `paid_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paid_requests`
--
ALTER TABLE `paid_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Constraints for table `paid_requests`
--
ALTER TABLE `paid_requests`
  ADD CONSTRAINT `paid_requests_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `job_applications` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
