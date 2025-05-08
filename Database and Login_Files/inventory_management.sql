-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 01:59 PM
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
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `position` varchar(50) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `password`, `created_at`, `position`, `contact`, `email`) VALUES
(1, 'Bohra', '$2y$10$co0DI28iEo1y8etDh219re1/voR02gfRX3MHLnKthrmLzU8tcQCIm', '2023-09-21 00:49:12', 'Owner', '8890919295', 'burhanuddinb542@gmail.com'),
(2, 'Kinana', '$2y$10$hAuZFcg4qGQ5b5E/mvx7A.2vdjQ5ywbym3l8oVIpS5SZkfIp4CZle', '2023-09-21 00:51:44', 'Owner', '8890919295', 'burhanuddinb542@gmail.com'),
(4, 'paawan', '$2y$10$N1/EGpr74f57Y6VKSTv79.xg.dlzFVO3vUUTPauq2fS1DLWjesEnO', '2023-09-21 01:08:47', 'Owner', '8890919295', 'burhanuddinb542@gmail.com'),
(5, 'diksha', '$2y$10$a5RQKOAzElL10Sf02Sm6hOB9vCnVtevobRuV0Y/uVSeHJb0ZsFD6K', '2023-10-04 09:23:17', 'manager', '9928329872', 'kanwardiksha45@gmail.com'),
(6, 'Banit Pandey', '$2y$10$itT7qkHPUG3FLTBvT5Sgae3kjOgb46FbMi4QbIPJVJKi84AwmdZlW', '2023-10-11 09:20:11', 'Manager', '8737989058', 'pandeybanit8737@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_name` varchar(50) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `total_product` int(50) NOT NULL,
  `total_cost` int(50) NOT NULL,
  `pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `date`, `customer_name`, `customer_contact`, `total_product`, `total_cost`, `pdf`) VALUES
('11725485', '2023-10-29 11:23:41', 'Bohra', '8890919295', 1, 150, ''),
('15409080', '2023-10-29 11:41:39', 'Bohra', '8890919295', 15, 10489, ''),
('48087113', '2023-10-29 12:16:59', 'Bohra', '8890919295', 0, 0, ''),
('70984413', '2023-10-29 11:41:17', 'Bohra', '8890919295', 1, 150, ''),
('72655612', '2023-10-29 11:23:17', 'Bohra', '8890919295', 4, 2847, ''),
('74922841', '2023-10-29 11:22:55', 'Bohra', '8890919295', 4, 2847, ''),
('93815221', '2023-10-29 12:17:48', 'Bohra', '8890919295', 0, 0, ''),
('93970164', '2023-10-29 11:52:50', 'Bohra', '8890919295', 0, 0, ''),
('94739360', '2023-10-29 11:52:35', 'Bohra', '8890919295', 15, 10489, ''),
('95625624', '2023-10-29 11:48:43', 'Bohra', '8890919295', 15, 10489, '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_id` int(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_quantity` int(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `dealer_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`date`, `product_id`, `product_name`, `product_description`, `product_price`, `product_quantity`, `product_img`, `dealer_name`) VALUES
('2023-12-07 10:47:10', 230407, 'Towel', 'Soft', 170, 24, 'uploads/towel.jpeg', 'bohra trader'),
('2023-11-09 14:42:54', 267475, 'Gucchi hoodie(L)', 'Standard, Soft, Royal Golden Look', 6000, 5, 'uploads/gucchi hoody.jpg', 'Gucchi Store'),
('2023-11-25 05:28:52', 293315, 'Nike t-shirt(XL)', 'Dark grey nike t-shirt', 899, 12, 'uploads/nike.jpeg', 'bohra trader'),
('2023-12-01 13:26:00', 298433, 'Pinky', 'Inky pinky ponky', 250, 4, 'uploads/pink t-shirt.jpeg', 'grezer cloths'),
('2023-10-28 23:17:02', 310415, 'Full sleeves T-shirt(L)', 'pink full sleeves t-shirt ', 399, 24, 'uploads/plain.jpeg', 'bohra trader'),
('2023-10-28 17:15:14', 406028, 'Galaxy Hoodie', 'galaxy effect', 899, 10, 'uploads/galaxy hoodie.jpeg', 'grezer cloths'),
('2023-11-01 10:05:32', 968374, 'Levis T-shirt(L)', 'light blue soft fabric with levis logo', 999, 0, 'uploads/levis.jpeg', 'grezer cloths');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `dealer_name` varchar(50) NOT NULL,
  `dealer_address` varchar(255) DEFAULT NULL,
  `reason` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `amount` int(50) NOT NULL,
  `bill_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `dealer_name`, `dealer_address`, `reason`, `date`, `amount`, `bill_pdf`) VALUES
(9, 'grezer cloths', 'jaipur', 'Personal/other', '2023-11-12', 12000, 'purchase_pdf/aifoil2.pdf'),
(11, 'bohra trader', 'jaipur', 'Personal/other', '2023-11-24', 200, 'purchase_pdf/profile2.png'),
(13, 'grezer cloths', 'jaipur', 'Goods', '2023-11-24', 10000, 'purchase_pdf/airfoils.pdf'),
(14, 'Gucchi Store', 'delhi', 'Goods', '2023-10-30', 200, 'purchase_pdf/logo.png'),
(15, 'Gucchi Store', 'jaipur', 'Goods', '2023-09-24', 5000, 'purchase_pdf/aerobatic.jpeg'),
(17, 'bohra trader', 'jaipur', 'Goods', '2023-11-29', 20000, 'purchase_pdf/certificate.jpg'),
(18, 'grezer cloths', 'delhi', 'Goods', '2023-12-04', 25000, 'purchase_pdf/Screenshot (180).png');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` int(11) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(50) NOT NULL,
  `total_units` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `discount` int(50) NOT NULL,
  `tax` int(50) NOT NULL,
  `total_amount` int(50) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `payment_status`, `date`, `invoice_no`, `customer_name`, `customer_contact`, `total_units`, `total`, `discount`, `tax`, `total_amount`, `note`) VALUES
(28, 'paid', '2023-10-22', '202311299947', 'Bohra', '9660362701', 2, 12000, 0, 300, 12300, NULL),
(29, 'paid', '2023-11-29', '202311297322', 'Bohra', '9660362701', 2, 12000, 0, 300, 12300, NULL),
(30, 'paid', '2023-11-29', '202311295342', 'Diksha', '8890919295', 2, 1099, 50, 27, 1076, ''),
(31, 'paid', '2023-11-29', '202311294869', 'kinana', '9660362701', 2, 698, 100, 17, 615, NULL),
(32, 'paid', '2023-12-01', '202312012097', 'Diksha', '9660362701', 5, 1499, 0, 37, 1536, NULL),
(33, 'paid', '2023-12-01', '202312016321', 'Diksha', '9660362701', 5, 999, 0, 25, 1024, NULL),
(35, 'paid', '2023-12-01', '202312019239', 'Diksha', '9660362701', 3, 1199, 0, 30, 1229, NULL),
(36, 'paid', '2023-12-01', '202312012463', 'banit', '9921389752', 7, 2397, 0, 60, 2457, NULL),
(44, 'paid', '2023-12-02', '202312016336', 'Bohra', '9921389752', 1, 5500, 500, 138, 5138, NULL),
(45, 'paid', '2023-12-02', '202312013623', 'Bohra', '9921389752', 2, 1798, 0, 45, 1843, ''),
(46, 'paid', '2023-12-01', '202312016524', 'Bohra', '9921389752', 2, 11000, 1000, 275, 10275, NULL),
(47, 'paid', '2023-12-02', '202312027470', 'Bohra', '8890919295', 5, 6600, 0, 165, 6765, NULL),
(64, 'paid', '2023-12-02', '202312024745', 'banit', '9660362701', 2, 1149, 0, 29, 1178, 'Thanks.'),
(70, 'unpaid', '2023-12-02', '202312025390', 'kinana', '9921389752', 2, 300, 0, 8, 308, ''),
(74, 'paid', '2023-12-02', '202312028522', 'kinana', '9921389752', 1, 6000, 0, 150, 6150, ''),
(77, 'unpaid', '2023-12-04', '202312038783', 'Bohra', '8890919295', 3, 10250, 2000, 256, 8506, 'Online'),
(79, 'paid', '2023-12-04', '202312032681', 'Banit', '9921389752', 2, 1598, 0, 0, 1598, 'No Tax'),
(80, 'unpaid', '2023-12-04', '202312039806', 'Bohra', '8890919295', 2, 748, 50, 19, 717, ''),
(81, 'paid', '2023-12-04', '202312049569', 'Chaitanya', '9660362701', 1, 5950, 50, 149, 6049, ''),
(82, 'unpaid', '2023-12-07', '202312076393', 'HImanshu', '1235678940', 4, 550, 50, 14, 514, ''),
(83, 'paid', '2023-12-07', '202312078922', 'Bohra', '9660362701', 1, 150, 0, 4, 154, ''),
(84, 'paid', '2023-12-07', '202312074502', 'Diksha', '9928329872', 1, 5000, 1000, 125, 4125, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
