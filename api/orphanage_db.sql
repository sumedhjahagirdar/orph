-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 06:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Sumedh', 'sumedhj23@gmail.com', 'sumedh23'),
(3, 'Sumedh', 'sumedh23@gmail.com', 'sumedh23'),
(4, 'Mahesh', 'mahesh19@gmail.com', 'mahesh19');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `orphanage_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `user_id`, `orphanage_id`, `amount`, `date`, `created_at`) VALUES
(1, 1, 1, 2000, '2025-12-07 22:11:39', '2025-12-07 23:06:15'),
(2, 1, 1, 2000, '2025-12-07 22:13:41', '2025-12-07 23:06:15'),
(3, 1, 2, 9876, '2025-12-07 22:15:31', '2025-12-07 23:06:15'),
(4, 1, 1, 323232, '2025-12-07 23:03:34', '2025-12-07 23:06:15'),
(5, 1, 1, 32413, '2025-12-07 23:06:49', '2025-12-07 23:06:49'),
(6, 1, 2, 12345, '2025-12-07 23:08:00', '2025-12-07 23:08:00'),
(7, 3, 3, 2000, '2025-12-07 23:34:47', '2025-12-07 23:34:47'),
(8, 1, 2, 2919, '2025-12-08 14:45:56', '2025-12-08 14:45:56'),
(9, 1, 3, 3000, '2025-12-08 16:57:06', '2025-12-08 16:57:06'),
(10, 1, 4, 1234, '2025-12-24 22:10:54', '2025-12-24 22:10:54'),
(11, 4, 4, 1234, '2025-12-24 22:12:02', '2025-12-24 22:12:02'),
(12, 5, 4, 5000, '2025-12-29 10:21:21', '2025-12-29 10:21:21'),
(13, 6, 4, 1, '2025-12-29 11:14:20', '2025-12-29 11:14:20'),
(14, 6, 4, 5000, '2025-12-29 11:14:48', '2025-12-29 11:14:48'),
(15, 6, 4, 2, '2025-12-29 11:16:20', '2025-12-29 11:16:20'),
(16, 6, 4, 1, '2025-12-29 11:18:40', '2025-12-29 11:18:40'),
(17, 6, 4, 1, '2025-12-29 11:19:47', '2025-12-29 11:19:47'),
(18, 6, 4, 1, '2025-12-29 11:20:43', '2025-12-29 11:20:43'),
(19, 6, 4, 1, '2025-12-29 11:20:51', '2025-12-29 11:20:51'),
(20, 6, 4, 2, '2025-12-29 11:21:49', '2025-12-29 11:21:49'),
(21, 6, 4, 3, '2025-12-29 11:23:13', '2025-12-29 11:23:13'),
(22, 6, 4, 45, '2025-12-29 11:37:28', '2025-12-29 11:37:28'),
(23, 6, 4, 5000, '2025-12-29 15:38:07', '2025-12-29 15:38:07'),
(24, 6, 4, 123, '2025-12-29 22:55:05', '2025-12-29 22:55:05'),
(25, 6, 4, 200, '2025-12-29 23:04:33', '2025-12-29 23:04:33'),
(26, 6, 1, 123, '2025-12-29 23:07:47', '2025-12-29 23:07:47'),
(27, 6, 3, 123, '2025-12-29 23:16:12', '2025-12-29 23:16:12'),
(28, 6, 5, 123, '2025-12-29 23:18:32', '2025-12-29 23:18:32'),
(29, 6, 4, 2000, '2025-12-29 23:26:43', '2025-12-29 23:26:43'),
(30, 6, 4, 290, '2025-12-30 13:41:27', '2025-12-30 13:41:27'),
(31, 11, 4, 100, '2025-12-30 14:35:23', '2025-12-30 14:35:23'),
(32, 6, 4, 400, '2025-12-30 17:31:56', '2025-12-30 17:31:56'),
(33, 6, 10, 500, '2025-12-31 22:32:18', '2025-12-31 22:32:18'),
(34, 6, 10, 500, '2025-12-31 22:40:39', '2025-12-31 22:40:39'),
(35, 6, 10, 500, '2026-01-01 16:35:46', '2026-01-01 16:35:46'),
(36, 6, 10, 500, '2026-01-02 13:55:06', '2026-01-02 13:55:06'),
(37, 6, 10, 500, '2026-01-02 13:56:01', '2026-01-02 13:56:01'),
(38, 6, 11, 123, '2026-01-02 22:12:47', '2026-01-02 22:12:47'),
(39, 6, 11, 123, '2026-01-02 22:13:11', '2026-01-02 22:13:11'),
(40, 6, 10, 1000, '2026-01-02 22:13:23', '2026-01-02 22:13:23'),
(41, 6, 10, 1000, '2026-01-02 22:14:40', '2026-01-02 22:14:40'),
(42, 6, 11, 1000, '2026-01-06 16:57:11', '2026-01-06 16:57:11'),
(43, 6, 11, 454, '2026-01-07 14:40:51', '2026-01-07 14:40:51'),
(44, 6, 11, 96, '2026-01-07 14:43:50', '2026-01-07 14:43:50'),
(45, 6, 14, 800, '2026-01-08 10:32:14', '2026-01-08 10:32:14'),
(46, 6, 14, 500, '2026-01-08 15:21:47', '2026-01-08 15:21:47'),
(47, 6, 15, 200, '2026-01-12 14:11:33', '2026-01-12 14:11:33'),
(48, 6, 16, 400, '2026-01-12 14:31:36', '2026-01-12 14:31:36'),
(49, 24, 15, 8900, '2026-01-12 14:35:08', '2026-01-12 14:35:08'),
(50, 24, 16, 1, '2026-01-12 14:35:56', '2026-01-12 14:35:56'),
(51, 6, 16, 400, '2026-01-13 08:15:08', '2026-01-13 08:15:08'),
(52, 6, 16, 1, '2026-01-13 12:14:09', '2026-01-13 12:14:09'),
(53, 24, 16, 600, '2026-01-13 22:16:35', '2026-01-13 22:16:35'),
(54, 24, 16, 600, '2026-01-13 22:16:54', '2026-01-13 22:16:54'),
(55, 24, 16, 500, '2026-01-16 10:35:09', '2026-01-16 10:35:09'),
(56, 24, 16, 500, '2026-01-16 10:42:56', '2026-01-16 10:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `orphanages`
--

CREATE TABLE `orphanages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `orphanage_image` varchar(255) DEFAULT NULL,
  `upi_id` varchar(100) DEFAULT NULL,
  `bank_details` text DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved') DEFAULT 'pending',
  `children_count` int(11) DEFAULT 0,
  `age_group` varchar(50) DEFAULT 'Not Specified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orphanages`
--

INSERT INTO `orphanages` (`id`, `name`, `email`, `password`, `address`, `description`, `orphanage_image`, `upi_id`, `bank_details`, `qr_code`, `status`, `children_count`, `age_group`) VALUES
(14, 'Sushanti Children\'s Home', 'Sushanti@gmail.om', '$2y$10$htIS1UFwBzABVEgDWoIdfemG/xw5cX3LL//./w5r.8Zh0ilhgC6W.', '12, Brahmagi Colony, beside Chetan College of Commerce (MBA College, Unkal, Tabhidar Colony, Hubballi, Karnataka 58003)', 'Welcome to our orphanage. We appreciate your support!', 'orphanage_images/1767848221_Screenshot 2026-01-08 102218.png', 'pending@upi', '8880571444@sbi', 'qr_codes/1767848221_Sushanti QR.jpeg', 'pending', 15, '5-16 yrs'),
(15, 'Sushanti Children\'s Orphanage', 'sushanti@gmail.com', '$2y$10$W5c9nw985sYLE7jJCZyDZec7v08bENqeQbK4SUfvBnclvMOL.ex2G', '12, Brahmagi Colony, beside Chetan College of Commerce (MBA College, Unkal, Tabhidar Colony, Hubballi, Karnataka 58003)', 'Welcome to our orphanage. We appreciate your support!', 'orphanage_images/1768207276_Orphanage Photo.jpeg', 'pending@upi', '8880571444@sbi', 'qr_codes/1768207276_Orphanage QR.jpeg', 'pending', 15, '5-16 yrs'),
(16, 'Dayashankar Gurukul', 'dayashankar@gmail.com', '$2y$10$rgH0yVKCutN0.yXqWAL7Uu..imohvson/vlfXQbin2ehXUUDf1qzS', ' Door NO, 30/2/C Besaid K M F Lakamanahalli, PB Rd, Dharwad, Karnataka 580004', 'Welcome to our orphanage. We appreciate your support!', 'orphanage_images/1768208465_Dayashanakar Photo.jpeg', 'pending@upi', 'AkshayaTrust@IOB', 'qr_codes/1768208465_Dayashankar QR.jpeg', 'pending', 40, '4-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Sumedh Jahagirdar', 'sumedhj2007@gmail.com', '$2y$10$NyOa7SAV1pcXYX2S/IreDONknwXan/vLX/8uubDyCE6LCXv6nsUTy', 'normal'),
(2, 'sumedhNGO', 'sjNGO@gmail.com', '$2y$10$Bb4veaOcPzq0v.RAKRhmjeo2Qh1vLmsXzxOMImm2ZWAinziVRdkg6', 'ngo'),
(3, 'demo 2', 'demo@gmail.com', '$2y$10$jzjBqLQAey.VaP3H5QLCvuQ59SM07vNOMVBDsU5s4l8SL57OvkttO', 'normal'),
(4, 'DTSI_Review', 'orphanage@gmail.com', '$2y$10$EMVFLdibc23iix3NKq5FQ.ZIdjw3Ck4N2qw7PFYN9W8xjdcBGPzlW', 'ngo'),
(5, 'DEmo 2', 'demo23@gmail.com', '$2y$10$gWQSqVy1eV87LfaLq8j0AOeVbVwGhL1i6lxpi1uqmats.rsQTDsLa', 'normal'),
(6, 'dayashankar', 'd@gmail.com', '$2y$10$sV/f3dQUivYJQDoDAACJt.acDHu9FOThJ.ZIR5IhkY3D7XCl4h.A2', 'ngo'),
(10, '1231', '123@123', '$2y$10$lg0OyiTy0bWLAmCUEyH4yuxIHll0RcukRl4I6HYDDxb5fXgavd3c6', 'normal'),
(11, 'Suppi', 'supreethsnm3@gmail.com', '$2y$10$cVh3qXKPSsdSN8vuWplQHO6iGW3GQhPV0Ix7o9BuK00P6vxZBvJIy', 'Donor'),
(12, 'NGOOOO', 'NGO@NGO', '$2y$10$efgSmTAERanPEB5lDnoiueYOt913qDqICdSXqs3gE6QCKuM2d9A2S', 'NGO'),
(15, '2222', '2@2', '$2y$10$0wb/DfkdvBQIQRy27wo.w.WvOh4T8FbjgbK4twgFyearPbjsl1jU2', 'Donor'),
(16, '12', '1@1', '$2y$10$g6gwuVjHGlr6dfuwXs1Z4.CrEVh3zSu6ZnDp/6Sd.tJPzt3nFj7Qm', 'NGO'),
(17, '1', 's@s', '$2y$10$C0iN.DAvtCVhvv9qb0lh8uMOHgDswY/UWV/7.906SJUwfuhNVbrrG', 'Individual Donor'),
(22, '1', 'aa@aa', '$2y$10$z2QDTnOtXDWr1DpRiHB77.9Y8SMFe0foumYHmsU9YSiv9QUI6sJI.', 'Individual Donor'),
(23, '121', 'ssa@ss', '$2y$10$yj5MvWJ9fn3HJPUcqsWrEOs04p0S6fi6anHwBWmcDFWpJfr..IfKa', 'Individual Donor'),
(24, 'Anshu Kumar', 'kumaranshu6248@gmail.com', '$2y$10$kpoA0ALGaoZFVYKy8AkGZOqbyrjmZEcDaZpB5XtwBTFTrqBLNe4z6', 'Individual Donor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orphanages`
--
ALTER TABLE `orphanages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `orphanages`
--
ALTER TABLE `orphanages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
