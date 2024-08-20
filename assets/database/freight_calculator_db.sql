-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2024 at 02:35 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `ntn_number` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Id`, `client_id`, `client_name`, `ntn_number`, `contact_name`, `contact_no`, `contact_email`, `phone`, `address`, `city`, `zip_code`, `country`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Updated Amazon', '', 'Amazon', '0000-0000000', 'username@gmail.com', '', 'Lahore', '', '', 'Pakistan', 1, '2023-10-12 04:23:14', '2023-10-12 04:23:14'),
(2, 2, 'Digi Key', '', 'digikey', '0320-0000000', '', '', '', '', '', '', 1, '2023-10-12 04:24:08', '2023-10-12 04:24:08'),
(3, 3, 'test vendor', '', 'john doe', '03224038389', '', '', '', '', '', '', 1, '2024-02-02 20:22:17', '2024-02-02 20:22:17'),
(4, 4, 'New Client', '', 'John doe', '03221234567', 'email@email.com', '03224064098', 'Lahore', 'Lahore', '', 'Lahore, Pakistan', 1, '2024-02-04 19:46:49', '2024-02-04 19:46:49'),
(5, 5, 'New client 2', '', 'John', '09874321478', 'junaid.khalil@gmail.com', '03224064098', 'Lahore', 'Lahore', '', 'Pakistan', 1, '2024-02-04 19:48:15', '2024-02-04 19:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

CREATE TABLE `draft` (
  `Id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_mode` varchar(30) NOT NULL,
  `credit_terms` varchar(30) NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `delivery_charges` double NOT NULL,
  `currency` int(11) NOT NULL,
  `comment` varchar(3000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `draft`
--

INSERT INTO `draft` (`Id`, `type`, `username`, `client_id`, `vendor_id`, `payment_mode`, `credit_terms`, `tax`, `discount`, `delivery_charges`, `currency`, `comment`, `created_at`, `updated_at`) VALUES
(28, 'purchase', 'junaid.khalil', 0, 0, '', 'per agreed terms', 0, 0, 0, 0, '', '2024-03-18 10:26:02', '2024-03-18 10:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `draft_items`
--

CREATE TABLE `draft_items` (
  `Id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `specification` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `additional_note` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `draft_items`
--

INSERT INTO `draft_items` (`Id`, `type`, `username`, `product_id`, `description`, `specification`, `qty`, `uom`, `unit_price`, `additional_note`, `created_at`, `updated_at`) VALUES
(3369, 'purchase', 'junaid.khalil', '', '', '', 0, '', 0, '', '2024-03-18 15:26:02', '2024-03-18 10:26:02'),
(3378, 'purchase', 'junaid.khalil', '1693585433000-5225-4265', 'aluminum block', '400mm*35mm*85mm', 3, 'No.', 19794, '', '2024-03-18 15:26:45', '2024-03-18 10:26:45'),
(3379, 'quotation', 'junaid.khalil', '1693833143000-5304-2717', 'can interface ic', '1/1 transceiver half canbus 8-soic', 5, 'No.', 0, '', '2024-08-13 17:35:54', '2024-08-13 12:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `Id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `quotation_no` int(11) NOT NULL,
  `po_no` varchar(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `credit_terms` varchar(50) NOT NULL,
  `qty` double NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `delivery_charges` double NOT NULL,
  `additional_charges` double NOT NULL,
  `additional_charges_detail` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `grand_total` double NOT NULL,
  `status` int(11) NOT NULL,
  `is_closed` int(11) NOT NULL,
  `is_paid` int(11) NOT NULL,
  `generated_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`Id`, `invoice_no`, `quotation_no`, `po_no`, `payment_mode`, `credit_terms`, `qty`, `tax`, `discount`, `delivery_charges`, `additional_charges`, `additional_charges_detail`, `comment`, `grand_total`, `status`, `is_closed`, `is_paid`, `generated_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 1001, 1002, '20240303-01', 'cash', 'per agreed terms', 0, 5000, 1000, 1200, 0, '', '&#34This is the first line&#34\r\nThis is the &#39SECOND&#39 line.\r\nThis is the third line. Updated', 55800, 1, 0, 0, 'junaid.khalil', 'junaid.khalil', '2024-03-04 19:48:04', '2024-03-08 20:04:35'),
(3, 1002, 1006, '123456-7890', 'Wire Transfer/TT', 'Net 15', 0, 1000, 500, 800, 0, '', 'Test note has been added', 89300, 1, 0, 0, 'junaid.khalil', 'junaid.khalil', '2024-03-08 20:05:26', '2024-03-14 15:02:44'),
(4, 1003, 1007, '', 'Wire Transfer/TT', 'Net 15', 0, 1000, 1000, 100, 0, '', '', 88100, 1, 0, 0, 'junaid.khalil', 'junaid.khalil', '2024-03-14 13:55:05', '2024-03-14 13:55:05'),
(5, 1004, 1002, '', 'cheque', 'Net 30', 0, 500, 800, 1200, 0, '', '', 47564, 1, 1, 0, 'junaid.khalil', 'junaid.khalil', '2024-03-20 14:59:20', '2024-03-20 14:59:20'),
(6, 1005, 1009, '', 'cheque', 'per agreed terms', 0, 0, 0, 0, 0, '', '', 106600, 1, 0, 0, 'junaid.khalil', 'junaid.khalil', '2024-03-20 14:59:29', '2024-03-20 14:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `Id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `line_total` double NOT NULL,
  `additional_note` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`Id`, `invoice_no`, `product_id`, `qty`, `uom`, `unit_price`, `line_total`, `additional_note`, `status`, `created_at`, `updated_at`) VALUES
(6, 1001, '1693243951000-4877-1538', 50, 'Pcs.', 120, 6000, 'test updated', 1, '2024-03-04 19:48:04', '2024-03-04 19:48:04'),
(7, 1001, '1693243951000-4877-1538', 32, 'Pcs.', 2900, 92800, 'test', 0, '2024-03-04 19:48:04', '2024-03-04 19:48:04'),
(8, 1001, '1693243939000-8865-8098', 4, 'Pcs.', 6500, 26000, 'test 2 updated', 1, '2024-03-04 19:48:04', '2024-03-04 19:48:04'),
(9, 1001, '1693926209000-9402-9366', 6, 'No.', 1200, 7200, '', 1, '2024-03-04 19:48:04', '2024-03-04 19:48:04'),
(10, 1001, '1693833143000-5304-2717', 4, 'No.', 2850, 11400, 'Updated comment', 1, '2024-03-04 19:48:04', '2024-03-04 19:48:04'),
(11, 1002, '1694610590000-3748-2404', 12, 'Pcs.', 1200, 14400, 'test', 0, '2024-03-08 20:05:26', '2024-03-08 20:05:26'),
(12, 1002, '1693398123000-5375-4707', 40, 'No.', 2200, 88000, '', 1, '2024-03-08 20:05:26', '2024-03-08 20:05:26'),
(13, 1003, '1693398123000-5375-4707', 40, 'No.', 2200, 88000, '', 1, '2024-03-14 13:55:05', '2024-03-14 13:55:05'),
(14, 1004, '1693243951000-4877-1538', 72, 'Pcs.', 112, 8064, '', 1, '2024-03-20 14:59:20', '2024-03-20 14:59:20'),
(15, 1004, '1693243951000-4877-1538', 60, 'Pcs.', 290, 17400, 'test', 1, '2024-03-20 14:59:20', '2024-03-20 14:59:20'),
(16, 1004, '1693243939000-8865-8098', 4, 'Pcs.', 650, 2600, 'test 2', 1, '2024-03-20 14:59:20', '2024-03-20 14:59:20'),
(17, 1004, '1693926209000-9402-9366', 6, 'Pcs.', 1200, 7200, '', 1, '2024-03-20 14:59:20', '2024-03-20 14:59:20'),
(18, 1004, '1693833143000-5304-2717', 4, 'No.', 2850, 11400, 'fggndyuj6y', 1, '2024-03-20 14:59:20', '2024-03-20 14:59:20'),
(19, 1005, '1694167272000-1905-9647', 1, 'No.', 52600, 52600, '', 1, '2024-03-20 14:59:29', '2024-03-20 14:59:29'),
(20, 1005, '1693229389000-1513-4178', 12, 'Box', 4500, 54000, '', 1, '2024-03-20 14:59:29', '2024-03-20 14:59:29');

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
(1, 'Muhammad Junaid Khalil', 'junaid.khalil', 'junaid.khalil@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 0, '2021-07-07 18:52:49', '2021-07-07 18:52:49');

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `draft`
--
ALTER TABLE `draft`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `draft_items`
--
ALTER TABLE `draft_items`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `quotation_no` (`invoice_no`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `draft_items`
--
ALTER TABLE `draft_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3380;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
