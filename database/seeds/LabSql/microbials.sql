-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2021 at 05:14 AM
-- Server version: 8.0.25-0ubuntu0.20.10.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_drug`
--

-- --------------------------------------------------------

--
-- Table structure for table `microbials`
--

-- CREATE TABLE `microbials` (
--   `id` bigint UNSIGNED NOT NULL,
--   `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- --
-- Dumping data for table `microbials`
--

INSERT INTO `microbials` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Detection of specified Microorganism<br>', '2021-09-13 03:08:41', '2021-09-20 08:59:58'),
(2, 'Total Viable Aerobic&nbsp; Count<br>', '2021-09-14 06:35:34', '2021-09-20 09:03:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `microbials`
--
ALTER TABLE `microbials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `microbials`
--
ALTER TABLE `microbials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
