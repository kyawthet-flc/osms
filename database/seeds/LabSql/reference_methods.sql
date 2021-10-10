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
-- Table structure for table `reference_methods`
--
--
-- CREATE TABLE `reference_methods` (
--   `id` bigint UNSIGNED NOT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reference_methods`
--

INSERT INTO `reference_methods` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'CFR 1984', 'Bio-assay Test', '2021-09-14 03:55:13', '2021-09-20 09:16:07'),
(19, 'BP 1998', 'Bio-assay Test', '2021-09-14 03:55:13', '2021-09-20 09:16:07'),
(20, 'BP 2011', 'Bio-assay Test', '2021-09-14 03:55:13', '2021-09-20 09:16:07'),
(21, 'Japan 1993', 'Bio-assay Test', '2021-09-14 03:55:13', '2021-09-20 09:16:07'),
(22, 'BP 2017', 'Biostandartization Laboratory', '2021-09-20 09:51:57', '2021-09-20 09:51:57'),
(23, 'USP 2015(Naked eyes)', 'Biostandartization Laboratory', '2021-09-20 09:52:14', '2021-09-20 09:52:14'),
(24, 'BP 2017,&nbsp; USP 2015(Glass electrode)', 'Biostandartization Laboratory', '2021-09-20 09:52:26', '2021-09-20 09:52:26'),
(25, 'BP 2017, USP 2015(Direct Inoculation Method)', 'Biostandartization Laboratory', '2021-09-20 09:52:35', '2021-09-20 10:20:22'),
(26, 'BP 2017 (ELISA)', 'Biostandartization Laboratory', '2021-09-20 10:20:31', '2021-09-20 10:20:31'),
(27, 'BP 2017, USP 2015(Chromogenic Kinetic by ELISA)', 'Biostandartization Laboratory', '2021-09-20 10:20:57', '2021-09-20 10:20:57'),
(28, 'BP 2017 (UV-Vis, Lowry Method)', 'Biostandartization Laboratory', '2021-09-20 10:21:06', '2021-09-20 10:21:06'),
(29, 'Manufacturer`s method (UV-Vis, Lowry Method)', 'Biostandartization Laboratory', '2021-09-20 10:21:13', '2021-09-20 10:21:13'),
(30, 'BP 2017, USP 2015(Chromogenic Kinetic by ELISA)', 'Biostandartization Laboratory', '2021-09-20 10:21:22', '2021-09-20 10:21:22'),
(31, 'WHO, TRS No.978, 2013', 'Biostandartization Laboratory', '2021-09-20 10:21:29', '2021-09-20 10:21:29'),
(32, 'BP 2017 (UV-Vis)', 'Biostandartization Laboratory', '2021-09-20 10:21:37', '2021-09-20 10:21:37'),
(33, 'Shrivastaw’s method(UV-Vis)', 'Biostandartization Laboratory', '2021-09-20 10:21:48', '2021-09-20 10:21:48'),
(34, 'Requirement of Biological Products, Japan, 1986 (UV-Vis)', 'Biostandartization Laboratory', '2021-09-20 10:21:54', '2021-09-20 10:21:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reference_methods`
--
ALTER TABLE `reference_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reference_methods`
--
ALTER TABLE `reference_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
