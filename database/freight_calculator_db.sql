-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2024 at 06:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freight_calculator_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`Id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Lahore', 133, '2024-08-21 10:26:05', '2024-08-21 13:11:32'),
(2, 'Delhi', 76, '2024-08-21 11:09:24', '2024-08-21 11:09:24'),
(3, 'Sharjah', 184, '2024-08-21 13:13:39', '2024-08-21 13:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `Id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`Id`, `company_id`, `company_name`, `short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Venturetronics', 'VT', 1, '2023-04-28 15:25:55', '2023-04-28 15:25:55'),
(2, 2, 'Raythorne', 'RT', 1, '2023-04-28 15:25:55', '2023-04-28 15:25:55'),
(3, 3, 'Powersoft19', 'PS19', 1, '2023-04-28 15:25:55', '2023-04-28 15:25:55'),
(4, 4, 'Mechatrontech', 'MTT', 1, '2023-09-12 22:34:55', '2023-09-12 22:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `conversion_rate`
--

CREATE TABLE `conversion_rate` (
  `Id` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversion_rate`
--

INSERT INTO `conversion_rate` (`Id`, `currency`, `month`, `year`, `rate`, `created_at`, `updated_at`) VALUES
(1, 'USD', 4, 2022, 184, '2023-01-27 18:37:25', '2023-01-27 18:37:25'),
(2, 'USD', 5, 2022, 196, '2023-01-30 17:51:26', '2023-01-30 17:51:26'),
(3, 'USD', 6, 2022, 203, '2023-01-30 17:53:24', '2023-01-30 17:53:24'),
(4, 'USD', 7, 2022, 215, '2023-01-30 18:12:55', '2023-01-30 18:12:55'),
(5, 'USD', 8, 2022, 215, '2023-01-30 18:54:23', '2023-01-30 18:54:23'),
(6, 'USD', 9, 2022, 210, '2023-01-30 18:54:43', '2023-01-30 18:54:43'),
(7, 'USD', 10, 2022, 220, '2023-01-30 19:00:52', '2023-01-30 19:00:52'),
(8, 'USD', 11, 2022, 215, '2023-02-01 21:46:47', '2023-02-01 21:46:47'),
(9, 'USD', 12, 2022, 223, '2023-02-01 21:46:59', '2023-02-01 21:46:59'),
(10, 'USD', 1, 2023, 222, '2023-02-01 21:47:10', '2023-02-01 21:47:10'),
(11, 'USD', 2, 2023, 250, '2023-02-01 21:47:22', '2023-02-01 21:47:22'),
(12, 'USD', 3, 2023, 254, '2023-02-27 19:04:34', '2023-02-27 19:04:34'),
(13, 'USD', 4, 2023, 275, '2023-09-12 17:10:43', '2023-09-12 17:10:43'),
(14, 'USD', 5, 2023, 280, '2023-09-12 17:11:33', '2023-09-12 17:11:33'),
(15, 'USD', 6, 2023, 280, '2023-09-12 17:11:56', '2023-09-12 17:11:56'),
(16, 'USD', 7, 2023, 265, '2023-09-12 17:12:17', '2023-09-12 17:12:17'),
(17, 'USD', 8, 2023, 280, '2023-09-12 17:12:48', '2023-09-12 17:12:48'),
(18, 'USD', 9, 2023, 290, '2023-09-12 17:13:04', '2023-09-12 17:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `Id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`Id`, `type`, `count`, `created_at`, `updated_at`) VALUES
(1, 'purchase', 1003, '2021-07-15 14:54:04', '2021-07-15 14:54:04'),
(2, 'quotations', 1009, '2021-07-15 14:54:04', '2021-07-15 14:54:04'),
(3, 'invoices', 1005, '2021-07-15 14:54:04', '2021-07-15 14:54:04'),
(4, 'vendor', 4, '2021-08-05 14:24:00', '2021-08-05 14:24:00'),
(5, 'clients', 5, '2021-08-05 14:24:00', '2021-08-05 14:24:00'),
(6, 'admin_prfs', 647, '2021-08-05 14:24:00', '2021-08-05 14:24:00'),
(7, 'prf_report_no', 73, '2022-12-19 17:28:00', '2022-12-19 17:28:00'),
(8, 'admin_prf_report_no', 40, '2022-12-19 17:28:00', '2022-12-19 17:28:00'),
(9, 'mtt_prfs', 4, '2022-12-19 17:28:00', '2022-12-19 17:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`Id`, `name`, `country_code`, `region_id`, `created_at`, `updated_at`) VALUES
(2, 'Albania', 'al', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(3, 'Algeria', 'dz', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(4, 'Andorra', 'ad', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(5, 'Angola', 'ao', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(6, 'Antigua and Barbuda', 'ag', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(7, 'Argentina', 'ar', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(8, 'Armenia', 'am', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(9, 'Australia', 'au', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(10, 'Austria', 'at', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(11, 'Azerbaijan', 'az', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(12, 'Bahamas', 'bs', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(13, 'Bahrain', 'bh', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(14, 'Bangladesh', 'bd', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(15, 'Barbados', 'bb', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(16, 'Belarus', 'by', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(17, 'Belgium', 'be', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(18, 'Belize', 'bz', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(19, 'Benin', 'bj', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(20, 'Bhutan', 'bt', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(21, 'Bolivia', '', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(22, 'Bosnia and Herzegovina', 'ba', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(23, 'Botswana', 'bw', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(24, 'Brazil', 'br', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(25, 'Brunei', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(26, 'Bulgaria', 'bg', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(27, 'Burkina Faso', 'bf', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(28, 'Burundi', 'bi', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(29, 'Cabo Verde', 'cv', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(30, 'Cambodia', 'kh', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(31, 'Cameroon', 'cm', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(32, 'Canada', 'ca', 2, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(33, 'Central African Republic', 'cf', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(34, 'Chad', 'td', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(35, 'Chile', 'cl', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(36, 'China', 'cn', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(37, 'Colombia', 'co', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(38, 'Comoros', 'km', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(39, 'Congo', 'cg', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(40, 'Costa Rica', 'cr', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(41, 'Croatia', 'hr', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(42, 'Cuba', 'cu', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(43, 'Cyprus', 'cy', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(44, 'Czech Republic', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(45, 'Denmark', 'dk', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(46, 'Djibouti', 'dj', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(47, 'Dominica', 'dm', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(48, 'Dominican Republic', 'do', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(49, 'East Timor (Timor-Leste)', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(50, 'Ecuador', 'ec', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(51, 'Egypt', 'eg', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(52, 'El Salvador', 'sv', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(53, 'Equatorial Guinea', 'gq', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(54, 'Eritrea', 'er', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(55, 'Estonia', 'ee', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(56, 'Eswatini', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(57, 'Ethiopia', 'et', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(58, 'Fiji', 'fj', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(59, 'Finland', 'fi', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(60, 'France', 'fr', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(61, 'Gabon', 'ga', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(62, 'Gambia', 'gm', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(63, 'Georgia', 'ge', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(64, 'Germany', 'de', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(65, 'Ghana', 'gh', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(66, 'Greece', 'gr', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(67, 'Grenada', 'gd', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(68, 'Guatemala', 'gt', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(69, 'Guinea', 'gn', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(70, 'Guinea-Bissau', 'gw', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(71, 'Guyana', 'gy', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(72, 'Haiti', 'ht', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(73, 'Honduras', 'hn', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(74, 'Hungary', 'hu', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(75, 'Iceland', 'is', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(76, 'India', 'in', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(77, 'Indonesia', 'id', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(78, 'Iran', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(79, 'Iraq', 'iq', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(80, 'Ireland', 'ie', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(81, 'Israel', 'il', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(82, 'Italy', 'it', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(83, 'Ivory Coast', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(84, 'Jamaica', 'jm', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(85, 'Japan', 'jp', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(86, 'Jordan', 'jo', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(87, 'Kazakhstan', 'kz', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(88, 'Kenya', 'ke', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(89, 'Kiribati', 'ki', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(90, 'Korea, North', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(91, 'Korea, South', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(92, 'Kosovo', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(93, 'Kuwait', 'kw', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(94, 'Kyrgyzstan', 'kg', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(95, 'Laos', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(96, 'Latvia', 'lv', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(97, 'Lebanon', 'lb', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(98, 'Lesotho', 'ls', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(99, 'Liberia', 'lr', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(100, 'Libya', 'ly', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(101, 'Liechtenstein', 'li', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(102, 'Lithuania', 'lt', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(103, 'Luxembourg', 'lu', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(104, 'Madagascar', 'mg', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(105, 'Malawi', 'mw', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(106, 'Malaysia', 'my', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(107, 'Maldives', 'mv', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(108, 'Mali', 'ml', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(109, 'Malta', 'mt', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(110, 'Marshall Islands', 'mh', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(111, 'Mauritania', 'mr', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(112, 'Mauritius', 'mu', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(113, 'Mexico', 'mx', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(114, 'Micronesia', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(115, 'Moldova', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(116, 'Monaco', 'mc', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(117, 'Mongolia', 'mn', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(118, 'Montenegro', 'me', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(119, 'Morocco', 'ma', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(120, 'Mozambique', 'mz', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(121, 'Myanmar (Burma)', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(122, 'Namibia', 'na', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(123, 'Nauru', 'nr', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(124, 'Nepal', 'np', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(125, 'Netherlands', 'nl', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(126, 'New Zealand', 'nz', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(127, 'Nicaragua', 'ni', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(128, 'Niger', 'ne', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(129, 'Nigeria', 'ng', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(130, 'North Macedonia', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(131, 'Norway', 'no', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(132, 'Oman', 'om', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(133, 'Pakistan', 'pk', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(134, 'Palau', 'pw', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(135, 'Panama', 'pa', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(136, 'Papua New Guinea', 'pg', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(137, 'Paraguay', 'py', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(138, 'Peru', 'pe', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(139, 'Philippines', 'ph', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(140, 'Poland', 'pl', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(141, 'Portugal', 'pt', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(142, 'Qatar', 'qa', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(143, 'Romania', 'ro', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(144, 'Russia', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(145, 'Rwanda', 'rw', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(146, 'Saint Kitts and Nevis', 'kn', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(147, 'Saint Lucia', 'lc', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(148, 'Saint Vincent and the Grenadines', 'vc', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(149, 'Samoa', 'ws', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(150, 'San Marino', 'sm', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(151, 'Sao Tome and Principe', 'st', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(152, 'Saudi Arabia', 'sa', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(153, 'Senegal', 'sn', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(154, 'Serbia', 'rs', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(155, 'Seychelles', 'sc', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(156, 'Sierra Leone', 'sl', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(157, 'Singapore', 'sg', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(158, 'Slovakia', 'sk', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(159, 'Slovenia', 'si', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(160, 'Solomon Islands', 'sb', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(161, 'Somalia', 'so', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(162, 'South Africa', 'za', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(163, 'South Sudan', 'ss', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(164, 'Spain', 'es', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(165, 'Sri Lanka', 'lk', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(166, 'Sudan', 'sd', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(167, 'Suriname', 'sr', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(168, 'Sweden', 'se', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(169, 'Switzerland', 'ch', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(170, 'Syria', '', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(171, 'Taiwan', '', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(172, 'Tajikistan', 'tj', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(173, 'Tanzania', '', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(174, 'Thailand', 'th', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(175, 'Togo', 'tg', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(176, 'Tonga', 'to', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(177, 'Trinidad and Tobago', 'tt', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(178, 'Tunisia', 'tn', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(179, 'Turkey', 'tr', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(180, 'Turkmenistan', 'tm', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(181, 'Tuvalu', 'tv', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(182, 'Uganda', 'ug', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(183, 'Ukraine', 'ua', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(184, 'United Arab Emirates', 'ae', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(185, 'United Kingdom', '', 1, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(186, 'United States', '', 2, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(187, 'Uruguay', 'uy', 3, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(188, 'Uzbekistan', 'uz', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(189, 'Vanuatu', 'vu', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(190, 'Vatican City', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(191, 'Venezuela', '', 0, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(192, 'Vietnam', 'vn', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(193, 'Yemen', 'ye', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(194, 'Zambia', 'zm', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09'),
(195, 'Zimbabwe', 'zw', 4, '2024-08-19 17:46:09', '2024-08-19 17:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `count_number`
--

CREATE TABLE `count_number` (
  `Id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `count_number`
--

INSERT INTO `count_number` (`Id`, `type`, `count`, `created_at`, `updated_at`) VALUES
(1, 'estimate', 60, '2024-08-30 11:42:19', '2024-08-30 16:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `phone_1` varchar(20) DEFAULT NULL,
  `phone_2` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `mailing_address` text DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Id`, `customer_id`, `company_name`, `contact_name`, `phone_1`, `phone_2`, `email`, `city`, `mailing_address`, `billing_address`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'CTR01', 'Test Company', 'Customer 1', '789644', '', 'test@gmail.com', 'lahore', 'h#33 good street', 'h#33 good street', 'this is a atest ', '2024-08-21 14:23:25', '2024-08-21 14:27:34'),
(3, 'CTR02', 'Test Company2', 'Customer 22', '789644', '2323232', 'junaid.khalil@venturetronics.com', 'lahore', 'h#33 good street', 'h#33 good street', '23232332', '2024-08-21 14:26:08', '2024-08-21 14:32:48'),
(5, 'CTR03', 'Test Company 3', 'Customer 3', '789644', '2323232', 'testagency1@gmail.com', 'lahore', 'h#33 good street', 'h#33 good street', 'AAAASAS', '2024-08-21 14:29:30', '2024-08-21 14:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `Id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`Id`, `country_id`, `city_id`, `address`, `website`, `phone_number`, `created_at`, `updated_at`) VALUES
(2, 133, 1, 'Pak Lahore', 'www.testentity.com', '7844545454', '2024-08-21 13:35:10', '2024-08-21 13:35:10'),
(3, 76, 2, 'test is the test of each fields', 'www.testentity.com', '7844545454', '2024-08-22 10:09:15', '2024-08-22 10:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

CREATE TABLE `entity` (
  `Id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `Id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_permission` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`Id`, `user_email`, `user_role`, `user_permission`, `created_at`, `updated_at`) VALUES
(1, 'junaid.khalil@gmail.com', 'admin', '', '2021-09-23 16:53:22', '2021-09-23 16:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `Id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `tgs_sla_zone` varchar(10) NOT NULL,
  `tbs_priority` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL,
  `duty_tax` double NOT NULL,
  `customs_brokerage` double NOT NULL,
  `handling` double NOT NULL,
  `ior` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`Id`, `region_id`, `tgs_sla_zone`, `tbs_priority`, `country_id`, `duty_tax`, `customs_brokerage`, `handling`, `ior`, `created_at`, `updated_at`) VALUES
(2, 4, '1', '1', 133, 76, 450, 0, 500, '2024-08-21 16:57:00', '2024-08-23 12:54:14'),
(3, 1, '1', '1', 59, 5, 600, 300, 800, '2024-08-22 13:22:14', '2024-08-22 13:22:14'),
(4, 1, '1', '1', 80, 0, 0, 300, 0, '2024-08-23 11:39:09', '2024-08-23 12:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`Id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'EMEA Europe the Middle East and Africa ', '2024-08-19 17:16:51', '2024-08-20 18:37:08'),
(2, 'NA North America ', '2024-08-19 17:17:21', '2024-08-20 18:37:15'),
(3, 'LATAM (Latin America)', '2024-08-19 17:17:45', '2024-08-19 17:17:45'),
(4, 'APAC (Asia-Pacific)', '2024-08-19 17:17:45', '2024-08-19 17:17:45'),
(10, 'Test Region', '2024-08-21 13:17:40', '2024-08-21 13:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `val` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`Id`, `name`, `val`, `created_at`, `updated_at`) VALUES
(1, 'default_ior', '500', '2024-08-22 15:36:02', '2024-08-22 15:36:02'),
(2, 'default_duty_tax', '10', '2024-08-22 15:36:02', '2024-08-22 15:36:02'),
(3, 'default_handling_charges', '400', '2024-08-22 15:36:02', '2024-08-23 14:40:39'),
(4, 'default_customs_brokerage', '450', '2024-08-22 15:36:02', '2024-08-23 14:40:39'),
(6, 'admin_bank_charges', '250', '2024-08-23 13:53:50', '2024-08-23 13:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `assign_to` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `display_name`, `user_name`, `email`, `password`, `user_role`, `status`, `assign_to`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Junaid Khalil', 'junaid.khalil', 'junaid.khalil@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 0, '2021-07-07 18:52:49', '2021-07-07 18:52:49'),
(73, 'Ali Abbas', 'ali.abbas', 'ali.abbas@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 0, '2021-07-07 18:52:49', '2021-07-07 18:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1655304378;}'),
(41, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1657715222;}'),
(43, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1660306502;}'),
(44, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1661263530;}'),
(65, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1664180381;}'),
(66, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1664180382;}'),
(67, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1664269323;}'),
(68, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1664878926;}'),
(196, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1669800434;}'),
(200, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1671448177;}'),
(201, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1671454775;}'),
(238, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1677144677;}'),
(243, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1678706725;}'),
(244, 'junaid.khalil', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1680013241;}'),
(245, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1681406800;}'),
(246, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1681406803;}'),
(247, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1681406804;}'),
(248, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1681406811;}'),
(249, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1681407228;}'),
(250, 'junaid.khalil', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1683542921;}'),
(251, 'junaid.khalil', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1683543519;}'),
(252, 'junaid.khalil', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1686046710;}'),
(253, 'junaid.khalil', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1686046742;}'),
(254, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1688665632;}'),
(255, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1688665633;}'),
(256, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1689080419;}'),
(257, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1689080420;}'),
(258, 'junaid.khalil', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1691496542;}'),
(259, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1691756215;}'),
(260, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1692378805;}'),
(261, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1692378809;}'),
(262, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1692378930;}'),
(263, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1692378933;}'),
(264, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1693250855;}'),
(265, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1693250857;}'),
(266, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1694171525;}'),
(267, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"1\";s:4:\"date\";i:1694172438;}'),
(268, 'mirfan', 'current_status', 'a:2:{s:6:\"status\";s:1:\"0\";s:4:\"date\";i:1694172450;}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `conversion_rate`
--
ALTER TABLE `conversion_rate`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `count_number`
--
ALTER TABLE `count_number`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`umeta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conversion_rate`
--
ALTER TABLE `conversion_rate`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `count_number`
--
ALTER TABLE `count_number`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `entity`
--
ALTER TABLE `entity`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`Id`);

--
-- Constraints for table `entities`
--
ALTER TABLE `entities`
  ADD CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`Id`);

--
-- Constraints for table `entity`
--
ALTER TABLE `entity`
  ADD CONSTRAINT `entity_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`Id`);

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`Id`),
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
