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
-- Table structure for table `sub_microbials`
--

-- CREATE TABLE `sub_microbials` (
--   `id` bigint UNSIGNED NOT NULL,
--   `microbial_id` int NOT NULL,
--   `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_microbials`
--

INSERT INTO `sub_microbials` (`id`, `microbial_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pseudomonas aeruginosa<br>', '2021-09-13 03:08:49', '2021-09-20 09:00:36'),
(2, 1, 'Staphylococcus aureus<br>', '2021-09-14 05:24:18', '2021-09-20 09:00:59'),
(3, 1, 'Escerichia coli<br>', '2021-09-14 05:24:45', '2021-09-20 09:01:32'),
(4, 2, 'Plate Count(for Bacteria)<br>', '2021-09-14 06:35:43', '2021-09-20 09:03:24'),
(5, 2, 'Plate Count(for Fungi)<br>', '2021-09-14 06:35:52', '2021-09-20 09:03:38'),
(6, 1, 'Salmonella', '2021-09-20 09:01:43', '2021-09-20 09:01:43'),
(7, 1, 'for Bile tolerant Gram Negative Becteria<br>', '2021-09-20 09:02:10', '2021-09-20 09:02:10'),
(8, 1, 'Candida albicans<br>', '2021-09-20 09:02:31', '2021-09-20 09:02:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_microbials`
--
ALTER TABLE `sub_microbials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_microbials`
--
ALTER TABLE `sub_microbials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
