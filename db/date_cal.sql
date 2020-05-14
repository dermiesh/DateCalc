-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2020 at 08:46 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `date_cal`
--

-- --------------------------------------------------------

--
-- Table structure for table `date_calculations`
--

DROP TABLE IF EXISTS `date_calculations`;
CREATE TABLE IF NOT EXISTS `date_calculations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_amt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `date_calculations`
--

INSERT INTO `date_calculations` (`id`, `date1`, `date2`, `day_amt`, `created_at`, `updated_at`) VALUES
(6, '2019-12-31', '2020-01-13', '13', NULL, NULL),
(2, '2020-01-06', '2020-01-11', '5', NULL, NULL),
(17, '2020-01-01', '2020-01-29', '28', NULL, NULL),
(18, '2020-01-01', '2020-01-30', '29', NULL, NULL),
(19, '2020-01-01', '2022-11-02', '1036', NULL, NULL),
(22, '2020-01-01', '2018-01-01', '730', NULL, NULL),
(21, '2020-01-01', '2020-01-01', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_05_14_031040_date_calculations', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
