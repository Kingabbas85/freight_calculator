-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 01:21 PM
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
-- Database: `mra`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
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
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Id`, `client_id`, `client_name`, `ntn_number`, `contact_name`, `contact_no`, `contact_email`, `phone`, `address`, `city`, `zip_code`, `country`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Updated Amazon', '', 'Amazon', '0000-0000000', 'username@gmail.com', '', 'Lahore', '', '', 'Pakistan', 1, '2023-10-12 04:23:14', '2023-10-12 04:23:14'),
(2, 2, 'Digi Key', '', 'digikey', '0320-0000000', '', '', '', '', '', '', 1, '2023-10-12 04:24:08', '2023-10-12 04:24:08'),
(3, 3, 'test vendor', '', 'john doe', '03224038389', '', '', '', '', '', '', 1, '2024-02-02 20:22:17', '2024-02-02 20:22:17'),
(4, 4, 'New Client', '', 'John doe', '03221234567', 'email@email.com', '03224064098', 'Lahore', 'Lahore', '', 'Lahore, Pakistan', 1, '2024-02-04 19:46:49', '2024-02-04 19:46:49'),
(5, 5, 'New client 2 Updated', '', 'John', '09874321478', 'junaid.khalil@gmail.com', '03224064098', 'Lahore', 'Lahore', '', 'Pakistan', 1, '2024-02-04 19:48:15', '2024-02-04 19:48:15');

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
(1, 'purchase', 1000, '2021-07-15 14:54:04', '2021-07-15 14:54:04'),
(2, 'quotations', 1000, '2021-07-15 14:54:04', '2021-07-15 14:54:04'),
(3, 'invoices', 1000, '2021-07-15 14:54:04', '2021-07-15 14:54:04'),
(4, 'vendor', 1000, '2021-08-05 14:24:00', '2021-08-05 14:24:00'),
(5, 'clients', 1000, '2021-08-05 14:24:00', '2021-08-05 14:24:00'),
(6, 'admin_prfs', 0, '2021-08-05 14:24:00', '2021-08-05 14:24:00'),
(7, 'prf_report_no', 0, '2022-12-19 17:28:00', '2022-12-19 17:28:00'),
(8, 'admin_prf_report_no', 0, '2022-12-19 17:28:00', '2022-12-19 17:28:00'),
(9, 'mtt_prfs', 0, '2022-12-19 17:28:00', '2022-12-19 17:28:00');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `specification` varchar(255) NOT NULL,
  `product_sku` varchar(1000) NOT NULL,
  `mfg` varchar(255) NOT NULL,
  `mfg_pn` varchar(255) NOT NULL,
  `dimension` varchar(255) NOT NULL DEFAULT ',,',
  `stock` double NOT NULL DEFAULT 0,
  `uom` varchar(255) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_qty` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `Id` int(11) NOT NULL,
  `client` varchar(255) NOT NULL,
  `billing` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `child_id` int(11) NOT NULL,
  `child_name` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `Id` int(11) NOT NULL,
  `purchase_no` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `credit_terms` varchar(50) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `qty` double NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `delivery_charges` double NOT NULL,
  `additional_charges` double NOT NULL,
  `comment` varchar(500) NOT NULL,
  `grand_total` double NOT NULL,
  `currency` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_closed` int(11) NOT NULL,
  `is_paid` int(11) NOT NULL,
  `generated_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `Id` int(11) NOT NULL,
  `purchase_no` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `Id` int(11) NOT NULL,
  `quotation_no` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `credit_terms` varchar(50) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `qty` double NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `delivery_charges` double NOT NULL,
  `additional_charges` double NOT NULL,
  `comment` varchar(500) NOT NULL,
  `grand_total` double NOT NULL,
  `currency` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_closed` int(11) NOT NULL,
  `is_invoice_generated` int(11) NOT NULL,
  `generated_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `Id` int(11) NOT NULL,
  `quotation_no` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `line_total` double NOT NULL,
  `additional_note` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `is_invoice_generated` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `received_products`
--

CREATE TABLE `received_products` (
  `Id` int(11) NOT NULL,
  `received_date` datetime NOT NULL DEFAULT current_timestamp(),
  `demand_no` int(100) NOT NULL,
  `po_number` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `product_id` varchar(1000) NOT NULL,
  `unit_price` double NOT NULL,
  `received_qty` double NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `shipper_type` varchar(255) NOT NULL,
  `shipment_no` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `statusof_item` varchar(100) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `model_no` varchar(100) NOT NULL,
  `rev` varchar(100) NOT NULL,
  `igp_no` varchar(100) NOT NULL,
  `igp_date` varchar(100) NOT NULL,
  `dc_no` varchar(100) NOT NULL,
  `dc_date` varchar(100) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `consignee` varchar(100) NOT NULL,
  `intended_dept` varchar(100) NOT NULL,
  `carrier` varchar(100) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `box_link` varchar(100) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `Id` int(11) NOT NULL,
  `resource_id` varchar(100) NOT NULL,
  `user_name` varchar(1000) NOT NULL,
  `full_name` varchar(1000) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `Id` int(11) NOT NULL,
  `team_id` varchar(100) NOT NULL,
  `team_name` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `Id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`Id`, `unit_name`, `created_at`, `updated_at`) VALUES
(1, 'Bag', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(2, 'Box', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(3, 'Bndl.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(4, 'Coil', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(5, 'Each', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(6, 'ft.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(7, 'gal.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(8, 'in.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(9, 'kg', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(10, 'Ltr.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(11, 'M', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(12, 'mm', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(13, 'No.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(14, 'Pair', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(15, 'Pcs.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(16, 'qtr.', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(17, 'Roll', '2022-07-04 19:47:20', '2022-07-04 19:47:20'),
(18, 'pkt.', '2022-12-22 21:55:20', '2022-12-22 21:55:20');

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

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `Id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
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
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`Id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `purchase_no` (`purchase_no`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `quotation_no` (`quotation_no`);

--
-- Indexes for table `received_products`
--
ALTER TABLE `received_products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `product_id` (`product_id`(191)),
  ADD KEY `received_by` (`received_by`(191));

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
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
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversion_rate`
--
ALTER TABLE `conversion_rate`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft_items`
--
ALTER TABLE `draft_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `received_products`
--
ALTER TABLE `received_products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
