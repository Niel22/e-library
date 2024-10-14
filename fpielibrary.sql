-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 05:25 AM
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
-- Database: `fpielibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `material_file` varchar(255) NOT NULL,
  `year` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `searched` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `type`, `course_name`, `course_code`, `semester`, `department`, `level`, `material_file`, `year`, `user_id`, `created_at`, `searched`) VALUES
(1, 'PDFs/Notes', 'File Organisation and Management', 'COM 226', 'Second Semester', 'Computer Science', 'ND II', 'assets/materials/File Organisation and Management.docx', '2024', 2, '2024-10-14 03:23:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contributions` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `image`, `department`, `created_at`, `contributions`) VALUES
(2, 'NIEL', 'niel2264@gmail.com', '$2y$10$F42BTJ02XUirC2AGd6QwB.1lBUhXdXwPkq/uvK/gFQJ4RGCf6bsYC', 'assets/profile/.trashed-1711193436-IMG_20240222_123029_125.jpg', 'Computer Science', '2024-10-14 02:55:37', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
