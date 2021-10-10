-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2021 at 05:15 AM
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
-- Table structure for table `test_parameters`
--

-- CREATE TABLE `test_parameters` (
--   `id` bigint UNSIGNED NOT NULL,
--   `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_parameters`
--

INSERT INTO `test_parameters` (`id`, `type`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Bio-assay Test', 'Amikacin Sulfate Injection<style type=\"text/css\">p { margin-bottom: 0.1in; direction: ltr; line-height: 115%; text-align: left; orphans: 2; widows: 2; background: transparent }</style>', '2021-09-14 03:05:28', '2021-09-20 09:08:58'),
(4, 'Bio-assay Test', 'Benzyl Penicillin Potassium/Sodium&nbsp; Injection', '2021-09-14 03:07:41', '2021-09-20 09:09:21'),
(5, 'Bio-assay Test', 'Benzyl Penicillin Injection/&nbsp; Penicillin G Potassium Tablet', '2021-09-14 04:02:39', '2021-09-20 09:10:56'),
(6, 'Bio-assay Test', 'Procaine Penicillin G Potassium Injection', '2021-09-14 04:06:19', '2021-09-20 09:11:03'),
(7, 'Bio-assay Test', 'Cefoperazone Sodium Injection', '2021-09-17 02:37:17', '2021-09-20 09:11:10'),
(8, 'Bio-assay Test', 'Ceftiaxone Sodium Injection', '2021-09-17 02:37:24', '2021-09-20 09:11:17'),
(9, 'Bio-assay Test', 'Clindamycin Hydrochloride Injection', '2021-09-17 02:37:51', '2021-09-20 09:11:24'),
(10, 'Bio-assay Test', 'Doxycycline/Tetracycline Capsule Hydrochloride', '2021-09-17 02:37:59', '2021-09-20 09:11:32'),
(11, 'Bio-assay Test', 'Erythromycin Tablet', '2021-09-17 02:41:57', '2021-09-20 09:11:39'),
(12, 'Bio-assay Test', 'Gentamycin Sulfate Injection', '2021-09-17 02:42:04', '2021-09-20 09:11:47'),
(14, 'Bio-assay Test', 'Kanamycin Sulfate for Injection', '2021-09-17 10:29:37', '2021-09-20 09:11:54'),
(15, 'Bio-assay Test', 'Levofloxacin Hemihydrate Tablet/Infusion', '2021-09-17 10:29:47', '2021-09-20 09:12:03'),
(16, 'Bio-assay Test', 'Lincomycin Hydrochloride', '2021-09-20 09:12:14', '2021-09-20 09:12:14'),
(17, 'Bio-assay Test', 'Oxytetracycline Hydrochloride Capsule', '2021-09-20 09:12:20', '2021-09-20 09:12:20'),
(18, 'Bio-assay Test', 'Rifampicin Capsule', '2021-09-20 09:12:27', '2021-09-20 09:12:27'),
(19, 'Bio-assay Test', 'Roxithromycin', '2021-09-20 09:12:32', '2021-09-20 09:12:32'),
(20, 'Bio-assay Test', 'Streptomycin Sulfate Injection', '2021-09-20 09:12:39', '2021-09-20 09:12:39'),
(21, 'Bio-assay Test', 'Tetracycline', '2021-09-20 09:12:43', '2021-09-20 09:12:43'),
(22, 'Biostandartization Laboratory', 'Content Uniformity(vial)<br>', '2021-09-20 09:34:36', '2021-09-20 09:34:36'),
(23, 'Biostandartization Laboratory', 'Particulate Matter<br>', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(24, 'Biostandartization Laboratory', 'pH', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(25, 'Biostandartization Laboratory', 'Extractable volume', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(26, 'Biostandartization Laboratory', 'Sterility Test', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(27, 'Biostandartization Laboratory', 'Identification', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(28, 'Biostandartization Laboratory', 'Bacterial Endotoxin', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(29, 'Biostandartization Laboratory', 'Protein Content', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(30, 'Biostandartization Laboratory', 'Bacterial Endotoxin', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(31, 'Biostandartization Laboratory', 'Potency test(In-vitro)', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(32, 'Biostandartization Laboratory', 'Adjuvant(Aluminium)', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(33, 'Biostandartization Laboratory', 'Preservative(Thiomersal)', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(34, 'Biostandartization Laboratory', 'Detoxifying agent(Free Formaldehyde)', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(35, 'Pharmaceutical Chemistry Laboratory', 'Uniformity of Weight', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(36, 'Pharmaceutical Chemistry Laboratory', 'Disintegration', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(37, 'Pharmaceutical Chemistry Laboratory', 'PH', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(38, 'Pharmaceutical Chemistry Laboratory', 'Deliverable volume', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(39, 'Pharmaceutical Chemistry Laboratory', 'Extractable volume', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(40, 'Pharmaceutical Chemistry Laboratory', 'Filling volume', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(41, 'Pharmaceutical Chemistry Laboratory', 'Identification', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(42, 'Pharmaceutical Chemistry Laboratory', 'Assay', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(43, 'Pharmaceutical Chemistry Laboratory', 'Uniformity of Content', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(44, 'Pharmaceutical Chemistry Laboratory', 'Dissolution', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(45, 'Pharmaceutical Chemistry Laboratory', 'Melting Point', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(46, 'Pharmaceutical Chemistry Laboratory', 'Refractive Index', '2021-09-20 09:34:51', '2021-09-20 09:34:51'),
(47, 'Pharmaceutical Chemistry Laboratory', 'Impurity', '2021-09-20 09:34:51', '2021-09-20 09:34:51');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_parameters`
--
ALTER TABLE `test_parameters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test_parameters`
--
ALTER TABLE `test_parameters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
