-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2021 at 03:24 AM
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
-- Table structure for table `lab_fees`
--

CREATE TABLE `lab_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `dosage_form_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpid` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Grand Parnet ID',
  `pid` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Parnet ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` mediumtext COLLATE utf8mb4_unicode_ci,
  `amount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_fees`
--

INSERT INTO `lab_fees` (`id`, `dosage_form_type`, `gpid`, `pid`, `name`, `desc`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'oral', 0, 0, 'oral form', '', 0, NULL, NULL),
(2, 'injection', 0, 0, 'injection/infusion form', '', 0, NULL, NULL),
(3, 'other', 0, 0, 'other dosage form', '', 0, NULL, NULL),
(4, NULL, 0, 1, 'single', '', 0, NULL, NULL),
(5, NULL, 0, 1, 'combination', '', 0, NULL, NULL),
(6, NULL, 1, 4, 'antibiotic', '', 300000, NULL, NULL),
(7, NULL, 1, 4, 'other', '', 250000, NULL, NULL),
(8, NULL, 1, 5, 'antibiotic', '', 400000, NULL, NULL),
(9, NULL, 1, 5, 'other', '', 400000, NULL, NULL),
(10, NULL, 0, 2, 'antibiotic', '', 0, NULL, NULL),
(11, NULL, 0, 2, 'other', '', 0, NULL, NULL),
(12, NULL, 2, 10, 'single', '', 500000, NULL, NULL),
(13, NULL, 2, 10, 'combination', '', 600000, NULL, NULL),
(14, NULL, 2, 11, 'single', '', 600000, NULL, NULL),
(15, NULL, 2, 11, 'combination', '', 600000, NULL, NULL),
(16, NULL, 0, 3, 'single', '', 250000, NULL, NULL),
(17, NULL, 0, 3, 'combination', '', 250000, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lab_fees`
--
ALTER TABLE `lab_fees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lab_fees`
--
ALTER TABLE `lab_fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
