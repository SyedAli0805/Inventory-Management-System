-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 05:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `customer_name`, `phone`, `address`, `email`) VALUES
(1, 'Syed Aqeel Ashiq', '03465318323', 'C-141,PAEC-ECHS , Rawat', 'aqeel613122@gmail.com'),
(2, 'Syed Ali Akbar Shah', '03056477014', 'Taxila', 'akbarsyedali131@gmail.com'),
(4, 'Muqaddas Aslam', '03464995313', 'Wahh Cantt', 'muqaddasaslam5747@gmail.com'),
(8, 'Syed Zain Ul Abideen', '03215052668', 'Rawat', 'zain668@gmail.com'),
(16, 'Muhammad Junaid Jiya ', '03087806060', 'Mianwali', 'junaidniazi@gmail.com'),
(17, 'Daniyal Khan Niazi', '03041565757', 'Daud Khel City', 'daniyalkhan22@gmail.com'),
(18, 'Mohammad Soban', '03045879092', 'Soans Mianwali', 'sobankhan@gmail.com'),
(19, 'Salman', '03059021929', 'Islamabad', 'salmanmehmood1001@gmail.com'),
(20, 'Syed Aqeel Ashiq', '099999999', 'C-141,PAEC-ECHS , Rawat', 'aqeel613@gmail.com'),
(21, 'umama', '0998298292', 'town', 'umama@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(300) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `name`, `address`, `username`, `phone`) VALUES
('akbarsyedali13', '1234', 'Syed Ali Akbar Shah', 'HITEC University, Taxila', 'Syed Ali Akbar', '03464995312'),
('akbarsyedali131@gmail.com', '18390gyh32', 'Syed Ali Akbar Shah', 'HITEC University, Taxila', 'akbarsyedali131@gmail.com', '03056477014'),
('muqaddasaslam5747@gamil.com', 'muq32', 'Muqaddas Aslam', 'Wah Cantt', 'muqaddasaslam5747@gamil.com', '03464995312');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_status` smallint(6) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `product_id`, `product_quantity`, `order_date`, `total_amount`, `order_status`) VALUES
(13, 1, 10, 2, '2023-05-29 11:34:48', 200.00, 1),
(14, 2, 7, 2, '2023-05-29 11:51:58', 10.00, 1),
(15, 2, 7, 2, '2023-05-29 12:04:49', 10.00, 1),
(18, 2, 16, 2, '2023-06-02 11:35:19', 200.00, 1),
(19, 4, 16, 10, '2023-06-03 16:21:32', 1000.00, 1),
(22, 8, 7, 2, '2023-06-04 12:19:41', 10.00, 1),
(23, 4, 16, 2, '2023-06-04 14:45:09', 200.00, 1),
(25, 1, 14, 25, '2023-06-04 19:32:26', 2500.00, 1),
(26, 2, 16, 25, '2023-06-04 19:34:24', 2500.00, 1),
(27, 1, 10, 40, '2023-06-04 19:37:36', 4000.00, 1),
(29, 4, 13, 50, '2023-06-04 22:16:32', 1750.00, 1),
(32, 1, 11, 8, '2023-06-05 11:56:37', 560.00, 1),
(34, 1, 15, 8, '2023-06-07 12:12:32', 800.00, 1),
(37, 16, 13, 30, '2023-06-08 19:05:23', 1050.00, 1),
(39, 18, 13, 10, '2023-06-08 20:10:52', 350.00, 1),
(40, 18, 7, 8, '2023-06-08 20:11:45', 40.00, 1),
(41, 19, 10, 1, '2023-06-08 22:09:17', 100.00, 1),
(42, 2, 15, 10, '2023-06-09 08:51:10', 1000.00, 1),
(43, 4, 7, 2, '2023-06-09 08:52:14', 20.00, 0),
(44, 1, 11, 20, '2023-06-09 08:53:09', 1400.00, 1),
(45, 1, 25, 15, '2023-06-09 08:55:07', 1500.00, 1),
(46, 21, 22, 2, '2023-06-09 08:57:54', 100.00, 1);

--
-- Triggers `order`
--
DELIMITER $$
CREATE TRIGGER `subtract_quantity` AFTER INSERT ON `order` FOR EACH ROW BEGIN
    UPDATE `product`
    SET quantity = quantity - NEW.product_quantity
    WHERE id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `subtract_quantity_trigger` AFTER INSERT ON `order` FOR EACH ROW BEGIN
  UPDATE `product`
  SET quantity = quantity - NEW.product_quantity
  WHERE id = NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `quantity`, `unit_price`) VALUES
(7, 'Lays Masala', 148, 10),
(10, 'Snacker', 170, 100),
(11, 'Nestle Fruita Vitals Chaunsa', 40, 70),
(13, 'Lays Salted', 10, 35),
(14, 'Bubbly Dairy Milk', 0, 100),
(15, 'Bounty Chocolate', 10, 100),
(16, 'Sting', 0, 100),
(17, 'Nestle Pure Life Water', 71, 75),
(20, 'KNN Seekh Kebab ', 0, 1265),
(22, 'Kurkure', 58, 50),
(25, 'choclate', 5, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_ibfk_1` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
