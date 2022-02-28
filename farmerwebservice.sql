-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3309
-- Generation Time: Feb 28, 2022 at 11:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmerwebservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ADMIN_ID` char(7) NOT NULL,
  `ADMIN_PASSWORD` varchar(20) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ADMIN_ID`, `ADMIN_PASSWORD`, `dt`) VALUES
('A564', 'admin@2', '2022-01-23 13:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_page`
--

CREATE TABLE `complaint_page` (
  `FARMER_ID` char(7) NOT NULL,
  `COMPLAINT_NUMBER` int(10) NOT NULL,
  `COMPLAINT_TYPE` varchar(100) NOT NULL,
  `COMPLAINT_DESCRIPTION` varchar(1000) NOT NULL,
  `COMPLAINT_STATUS` text NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_page`
--

INSERT INTO `complaint_page` (`FARMER_ID`, `COMPLAINT_NUMBER`, `COMPLAINT_TYPE`, `COMPLAINT_DESCRIPTION`, `COMPLAINT_STATUS`, `dt`) VALUES
('F001', 1, 'About Supplier', 'Money not given', 'Solved', '2022-01-21 09:20:06'),
('F648', 2, 'CropIssue', 'Crop is not furtilize.', 'Solved', '2022-01-24 13:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `crop_advertisement`
--

CREATE TABLE `crop_advertisement` (
  `ADVERTISEMENT_ID` int(10) NOT NULL,
  `SUPPLIER_ID` varchar(7) NOT NULL,
  `CROP_ID` int(11) NOT NULL,
  `CROP_NAME` text NOT NULL,
  `REQUIRED_QUANTITY` varchar(100) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_advertisement`
--

INSERT INTO `crop_advertisement` (`ADVERTISEMENT_ID`, `SUPPLIER_ID`, `CROP_ID`, `CROP_NAME`, `REQUIRED_QUANTITY`, `dt`) VALUES
(1, 'S92', 17, 'Tomato', '150kg', '2022-01-21 11:13:19'),
(2, 'S261', 19, 'Apple', '200kg', '2022-01-24 13:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `FARMER_ID` char(7) NOT NULL,
  `FARMER_NAME` text NOT NULL,
  `FARMER_PASSWORD` varchar(20) NOT NULL,
  `FARMER_EMAIL` varchar(250) NOT NULL,
  `FARMER_CONTACT_NUMBER` varchar(10) NOT NULL,
  `FARMER_CONFIRM_PASSWORD` varchar(20) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`FARMER_ID`, `FARMER_NAME`, `FARMER_PASSWORD`, `FARMER_EMAIL`, `FARMER_CONTACT_NUMBER`, `FARMER_CONFIRM_PASSWORD`, `dt`) VALUES
('F001', 'Ramayya', 'f001ram', 'ramayya@farmer.com', '7705675485', 'f001ram', '2022-01-24 13:05:27'),
('F1446', 'Kalyan', '112233', 'kalyan@farmer', '9988776632', '112233', '2022-01-24 12:34:49'),
('F648', 'Vishnu', 'vishnu@1', 'vishnu@farmer.com', '7703485485', 'vishnu@1', '2022-01-19 11:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `farming_tips`
--

CREATE TABLE `farming_tips` (
  `TIPS_DESCRIPTION` text NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `SERIAL_NUMBER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farming_tips`
--

INSERT INTO `farming_tips` (`TIPS_DESCRIPTION`, `dt`, `SERIAL_NUMBER`) VALUES
('It is harvesting time.', '2022-01-20 14:55:09', 1),
('Use  of fertilizers should be minimal.', '2022-02-22 12:16:55', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sell_crop`
--

CREATE TABLE `sell_crop` (
  `SERIAL_NUMBER` int(10) NOT NULL,
  `SUPPLIER_ID` varchar(7) NOT NULL,
  `FARMER_ID` varchar(7) NOT NULL,
  `CROP_ID` int(10) NOT NULL,
  `CROP_NAME` varchar(50) NOT NULL,
  `AVAILABLE_QUANTITY` varchar(50) NOT NULL,
  `RUPEES` varchar(50) NOT NULL,
  `SELLING_STATUS` text NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell_crop`
--

INSERT INTO `sell_crop` (`SERIAL_NUMBER`, `SUPPLIER_ID`, `FARMER_ID`, `CROP_ID`, `CROP_NAME`, `AVAILABLE_QUANTITY`, `RUPEES`, `SELLING_STATUS`, `dt`) VALUES
(1, 'S92', 'F001', 17, 'Tomato', '100kg', '5000', 'Accepted', '2022-01-23 10:43:51'),
(2, 'S92', 'F648', 17, 'Tomato', '50kg', '2500', 'Accepted', '2022-01-24 14:37:10'),
(3, 'S92', 'F1446', 17, 'Tomato', '150kg', '7500', 'Rejected', '2022-01-24 14:37:08'),
(4, 'S261', 'F648', 19, 'Apple', '150kg', '10000', 'Accepted', '2022-01-24 14:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SUPPLIER_ID` char(7) NOT NULL,
  `SUPPLIER_NAME` varchar(32) NOT NULL,
  `SUPPLIER_PASSWORD` varchar(20) NOT NULL,
  `SUPPLIER_EMAIL` varchar(250) NOT NULL,
  `SUPPLIER_CONTACT_NUMBER` varchar(10) NOT NULL,
  `SUPPLIER_CONFIRM_PASSWORD` varchar(20) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SUPPLIER_ID`, `SUPPLIER_NAME`, `SUPPLIER_PASSWORD`, `SUPPLIER_EMAIL`, `SUPPLIER_CONTACT_NUMBER`, `SUPPLIER_CONFIRM_PASSWORD`, `dt`) VALUES
('S261', 'ShivaRam', 's001ram', 'ram@supplier.com', '9640766827', 's001ram', '2022-01-24 13:33:33'),
('S92', 'shiva@2', 's12345', 'shiva@supplier.com', '7702385486', 's12345', '2022-01-24 13:08:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `complaint_page`
--
ALTER TABLE `complaint_page`
  ADD PRIMARY KEY (`COMPLAINT_NUMBER`);

--
-- Indexes for table `crop_advertisement`
--
ALTER TABLE `crop_advertisement`
  ADD PRIMARY KEY (`ADVERTISEMENT_ID`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`FARMER_ID`);

--
-- Indexes for table `farming_tips`
--
ALTER TABLE `farming_tips`
  ADD UNIQUE KEY `S_No` (`SERIAL_NUMBER`),
  ADD UNIQUE KEY `S_No_2` (`SERIAL_NUMBER`);

--
-- Indexes for table `sell_crop`
--
ALTER TABLE `sell_crop`
  ADD PRIMARY KEY (`SERIAL_NUMBER`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SUPPLIER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_page`
--
ALTER TABLE `complaint_page`
  MODIFY `COMPLAINT_NUMBER` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `crop_advertisement`
--
ALTER TABLE `crop_advertisement`
  MODIFY `ADVERTISEMENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `farming_tips`
--
ALTER TABLE `farming_tips`
  MODIFY `SERIAL_NUMBER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sell_crop`
--
ALTER TABLE `sell_crop`
  MODIFY `SERIAL_NUMBER` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
