-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2022 at 01:28 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `erp_employee_jds`
--

CREATE TABLE `erp_employee_jds` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_sop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose_repeat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency_repeat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `erp_employee_jds`
--

INSERT INTO `erp_employee_jds` (`id`, `task_name`, `task_sop`, `dose_repeat`, `attachment`, `frequency_repeat`, `created_at`, `updated_at`) VALUES
(18, 'task1', '2209136898161663050161.jpg', 'yes', '2209136898161663050161.jpg', 'daily', '2022-09-13 01:22:41', '2022-09-13 01:22:41'),
(19, 'task1', '2209132142891663050411.jpg', 'yes', '2209133852411663050411.jpg', 'daily', '2022-09-13 01:26:51', '2022-09-13 01:26:51'),
(20, 'task1', '2209132820191663066223.jpg', 'yes', '2209133788751663066223.jpg', 'daily', '2022-09-13 05:50:25', '2022-09-13 05:50:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `erp_employee_jds`
--
ALTER TABLE `erp_employee_jds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`task_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erp_employee_jds`
--
ALTER TABLE `erp_employee_jds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
