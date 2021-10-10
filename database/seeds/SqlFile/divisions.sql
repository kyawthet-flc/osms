-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2021 at 02:42 AM
-- Server version: 10.1.48-MariaDB-0+deb9u2
-- PHP Version: 7.3.13-1+0~20191218.50+debian9~1.gbp23c2da

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esubmission_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_mm` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'state, division',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `country_id`, `name`, `name_mm`, `type`, `created_at`, `updated_at`) VALUES
(1, 148, 'Kachin State', 'ကချင်ပြည်နယ်', 'State', NULL, NULL),
(2, 148, 'Sagaing  Region', 'စစ်ကိုင်းတိုင်းဒေသကြီး', 'Division', NULL, NULL),
(3, 148, 'Chin State', 'ချင်းပြည်နယ်', 'State', NULL, NULL),
(4, 148, 'Magway Region', 'မကွေးတို်ငးဒေသကြီး', 'Division', NULL, NULL),
(5, 148, 'Mandalay Region', 'မန္တလေးတိုင်းဒေသကြီး', 'Division', NULL, NULL),
(6, 148, 'Shan  State', 'ရှမ်းပြည်နယ်', 'State', NULL, NULL),
(7, 148, 'Rakhine State', 'ရခိုင်ပြည်နယ်', 'State', NULL, NULL),
(8, 148, 'Bago Region', 'ပဲခူးတိုင်းဒေသကြီး', 'Division', NULL, NULL),
(9, 148, 'Kayah State', 'ကယားပြည်နယ်', 'State', NULL, NULL),
(10, 148, 'Ayeyarwaddy Region', 'ဧရာဝတီတိုင်းဒေသကြီး', 'Division', NULL, NULL),
(11, 148, 'Yangon Region', 'ရန်ကုန်တိုင်းဒေသကြီး', 'Division', NULL, NULL),
(12, 148, 'Mon  State', 'မွန်ပြည်နယ်', 'State', NULL, NULL),
(13, 148, 'Kayin State', 'ကရင်ပြည်နယ်', 'State', NULL, NULL),
(14, 148, 'Tanintharyi Region', 'တနင်္သာရီတိုင်းဒေသကြီး', 'Division', NULL, NULL),
(15, 148, 'NayPyiTaw', 'နေပြည်တော်ပြည်ထောင်စုနယ်မြေ', 'Division', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
