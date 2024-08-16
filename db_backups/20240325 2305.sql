-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: mra
-- ------------------------------------------------------
-- Server version 	10.4.28-MariaDB
-- Date: Mon, 25 Mar 2024 19:05:39 +0100

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `clients` VALUES (1,1,'Updated Amazon','','Amazon','0000-0000000','username@gmail.com','','Lahore','','','Pakistan',1,'2023-10-12 04:23:14','2023-10-12 04:23:14'),(2,2,'Digi Key','','digikey','0320-0000000','','','','','','',1,'2023-10-12 04:24:08','2023-10-12 04:24:08'),(3,3,'test vendor','','john doe','03224038389','','','','','','',1,'2024-02-02 20:22:17','2024-02-02 20:22:17'),(4,4,'New Client','','John doe','03221234567','email@email.com','03224064098','Lahore','Lahore','','Lahore, Pakistan',1,'2024-02-04 19:46:49','2024-02-04 19:46:49'),(5,5,'New client 2 Updated','','John','09874321478','junaid.khalil@gmail.com','03224064098','Lahore','Lahore','','Pakistan',1,'2024-02-04 19:48:15','2024-02-04 19:48:15');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `clients` with 5 row(s)
--

--
-- Table structure for table `companies`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `companies` with 0 row(s)
--

--
-- Table structure for table `conversion_rate`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversion_rate` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(10) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversion_rate`
--

LOCK TABLES `conversion_rate` WRITE;
/*!40000 ALTER TABLE `conversion_rate` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `conversion_rate` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `conversion_rate` with 0 row(s)
--

--
-- Table structure for table `counter`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `counter` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `counter`
--

LOCK TABLES `counter` WRITE;
/*!40000 ALTER TABLE `counter` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `counter` VALUES (1,'purchase',1000,'2021-07-15 14:54:04','2021-07-15 14:54:04'),(2,'quotations',1000,'2021-07-15 14:54:04','2021-07-15 14:54:04'),(3,'invoices',1000,'2021-07-15 14:54:04','2021-07-15 14:54:04'),(4,'vendor',1016,'2021-08-05 14:24:00','2021-08-05 14:24:00'),(5,'clients',1000,'2021-08-05 14:24:00','2021-08-05 14:24:00'),(6,'admin_prfs',0,'2021-08-05 14:24:00','2021-08-05 14:24:00'),(7,'prf_report_no',0,'2022-12-19 17:28:00','2022-12-19 17:28:00'),(8,'admin_prf_report_no',0,'2022-12-19 17:28:00','2022-12-19 17:28:00'),(9,'mtt_prfs',0,'2022-12-19 17:28:00','2022-12-19 17:28:00');
/*!40000 ALTER TABLE `counter` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `counter` with 9 row(s)
--

--
-- Table structure for table `draft`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `draft` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `draft`
--

LOCK TABLES `draft` WRITE;
/*!40000 ALTER TABLE `draft` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `draft` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `draft` with 0 row(s)
--

--
-- Table structure for table `draft_items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `draft_items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `draft_items`
--

LOCK TABLES `draft_items` WRITE;
/*!40000 ALTER TABLE `draft_items` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `draft_items` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `draft_items` with 0 row(s)
--

--
-- Table structure for table `invoices`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `invoices` with 0 row(s)
--

--
-- Table structure for table `invoice_items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `line_total` double NOT NULL,
  `additional_note` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `product_id` (`product_id`),
  KEY `quotation_no` (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `invoice_items` with 0 row(s)
--

--
-- Table structure for table `permissions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_permission` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `permissions` VALUES (1,'junaid.khalil@gmail.com','admin','','2021-09-23 16:53:22','2021-09-23 16:53:22');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `permissions` with 1 row(s)
--

--
-- Table structure for table `products`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `products` VALUES (1,'Test Item','Test specification','1711371103000-3607-6017','','',',,',0,'No.','consumable',0,'','',0,'2024-03-25 12:51:43','2024-03-25 12:51:43');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `products` with 1 row(s)
--

--
-- Table structure for table `projects`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) NOT NULL,
  `billing` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `child_id` int(11) NOT NULL,
  `child_name` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `projects` with 0 row(s)
--

--
-- Table structure for table `purchases`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `purchases` with 0 row(s)
--

--
-- Table structure for table `purchase_items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_no` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `line_total` double NOT NULL,
  `additional_note` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `product_id` (`product_id`),
  KEY `purchase_no` (`purchase_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_items`
--

LOCK TABLES `purchase_items` WRITE;
/*!40000 ALTER TABLE `purchase_items` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `purchase_items` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `purchase_items` with 0 row(s)
--

--
-- Table structure for table `quotations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations`
--

LOCK TABLES `quotations` WRITE;
/*!40000 ALTER TABLE `quotations` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `quotations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `quotations` with 0 row(s)
--

--
-- Table structure for table `quotation_items`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotation_items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `product_id` (`product_id`),
  KEY `quotation_no` (`quotation_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_items`
--

LOCK TABLES `quotation_items` WRITE;
/*!40000 ALTER TABLE `quotation_items` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `quotation_items` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `quotation_items` with 0 row(s)
--

--
-- Table structure for table `received_products`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `received_products` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`),
  KEY `product_id` (`product_id`(191)),
  KEY `received_by` (`received_by`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `received_products`
--

LOCK TABLES `received_products` WRITE;
/*!40000 ALTER TABLE `received_products` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `received_products` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `received_products` with 0 row(s)
--

--
-- Table structure for table `resources`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` varchar(100) NOT NULL,
  `user_name` varchar(1000) NOT NULL,
  `full_name` varchar(1000) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `resources` with 0 row(s)
--

--
-- Table structure for table `teams`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` varchar(100) NOT NULL,
  `team_name` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `teams` with 0 row(s)
--

--
-- Table structure for table `uom`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uom` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uom`
--

LOCK TABLES `uom` WRITE;
/*!40000 ALTER TABLE `uom` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `uom` VALUES (1,'Bag','2022-07-04 19:47:20','2022-07-04 19:47:20'),(2,'Box','2022-07-04 19:47:20','2022-07-04 19:47:20'),(3,'Bndl.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(4,'Coil','2022-07-04 19:47:20','2022-07-04 19:47:20'),(5,'Each','2022-07-04 19:47:20','2022-07-04 19:47:20'),(6,'ft.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(7,'gal.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(8,'in.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(9,'kg','2022-07-04 19:47:20','2022-07-04 19:47:20'),(10,'Ltr.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(11,'M','2022-07-04 19:47:20','2022-07-04 19:47:20'),(12,'mm','2022-07-04 19:47:20','2022-07-04 19:47:20'),(13,'No.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(14,'Pair','2022-07-04 19:47:20','2022-07-04 19:47:20'),(15,'Pcs.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(16,'qtr.','2022-07-04 19:47:20','2022-07-04 19:47:20'),(17,'Roll','2022-07-04 19:47:20','2022-07-04 19:47:20'),(18,'pkt.','2022-12-22 21:55:20','2022-12-22 21:55:20');
/*!40000 ALTER TABLE `uom` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `uom` with 18 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `assign_to` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Muhammad Junaid Khalil','junaid.khalil','junaid.khalil@gmail.com','21232f297a57a5a743894a0e4a801fc3','admin',NULL,0,'2021-07-07 18:52:49','2021-07-07 18:52:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 1 row(s)
--

--
-- Table structure for table `user_meta`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_meta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`umeta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user_meta` with 0 row(s)
--

--
-- Table structure for table `vendors`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `vendors` VALUES (1,1015,'Test Vendor','','Name','0300','','','','','','',0,'2024-03-25 13:08:41','2024-03-25 13:08:41'),(2,1016,'ModMyMods','','ModMyMods','0300','','','','','','',1,'2024-03-25 16:40:04','2024-03-25 16:40:04');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `vendors` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 25 Mar 2024 19:05:39 +0100
