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
-- Table structure for table `reference_values`
--

-- CREATE TABLE `reference_values` (
--   `id` bigint UNSIGNED NOT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reference_values`
--

INSERT INTO `reference_values` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(9, '90-120%', 'Bio-assay Test', '2021-09-20 09:28:45', '2021-09-20 09:28:45'),
(10, '95-105%', 'Bio-assay Test', '2021-09-20 09:28:58', '2021-09-20 09:28:58'),
(11, 'No foreign matter is detected', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(12, '5.9 – 6.9 (Manufacturer`s specification)', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(13, 'Not less than the stated volume', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(14, 'Sterile', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(15, 'Positive', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(16, '<p style=\"margin-bottom: 0in; line-height: 100%; orphans: 2; widows: 2\" align=\"left\">\r\n<font style=\"font-size: 12pt\" size=\"3\"><font face=\"Pyidaungsu, serif\">NMT\r\n40 </font><font face=\"Symbol, serif\"></font><font face=\"Pyidaungsu, serif\">g/ml</font></font', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:43:20'),
(17, 'Less Than 2.5 EU/ml(Manufacturer`s specification)', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(18, '-Measured antigen content<br>-Relative Potency<br>-95 % confidence limit of potency (80 – 125 %)', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:42:55'),
(19, 'Not More Than 1.25 mg/dose', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(20, 'NMT 115% of stated amount(0.01 w/v %)', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16'),
(21, 'NMT 115% of stated amount(0.01 w/v %)', 'Biostandartization Laboratory', '2021-09-20 09:40:16', '2021-09-20 09:40:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reference_values`
--
ALTER TABLE `reference_values`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reference_values`
--
ALTER TABLE `reference_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
