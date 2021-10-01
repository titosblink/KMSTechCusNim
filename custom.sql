-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 03:09 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `custom`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `rights` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`, `email`, `fullname`, `rights`) VALUES
(1, 'admin', '35056cf3019b02c1b7c4cbcfec9d39f0', 'aoclems@gmail.com', 'Clement', 'admin'),
(5, 'kkk', 'cb42e130d1471239a27fca6228094f0e', 'odumu.godwin@yahoo.com', 'kkk', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `bol_specific_segment`
--

CREATE TABLE `bol_specific_segment` (
  `id` int(20) NOT NULL,
  `xmlid` varchar(200) NOT NULL,
  `Line_number` varchar(200) NOT NULL,
  `Previous_document_reference` varchar(200) NOT NULL,
  `Bol_Nature` varchar(200) NOT NULL,
  `Unique_carrier_reference` varchar(200) NOT NULL,
  `Total_number_of_containers` varchar(200) NOT NULL,
  `Total_gross_mass_manifested` varchar(200) NOT NULL,
  `Volume_in_cubic_meters` varchar(200) NOT NULL,
  `Bol_type_segment_code` varchar(200) NOT NULL,
  `Exporter_segment_code` varchar(200) NOT NULL,
  `Exporter_segment_name` varchar(200) NOT NULL,
  `Exporter_segment_addr` varchar(200) NOT NULL,
  `Consignee_segment_code` varchar(200) NOT NULL,
  `Consignee_name` varchar(200) NOT NULL,
  `Consignee_segment_addr` varchar(200) NOT NULL,
  `Notify_segment_code` varchar(200) NOT NULL,
  `Notify_segment_name` varchar(200) NOT NULL,
  `Notify_segment_addr` varchar(200) NOT NULL,
  `Place_of_loading_segment_code` varchar(200) NOT NULL,
  `Place_of_unloading_segment_code` varchar(200) NOT NULL,
  `Package_type_code` varchar(200) NOT NULL,
  `Number_of_packages` varchar(200) NOT NULL,
  `Shipping_marks` varchar(200) NOT NULL,
  `Goods_description` varchar(200) NOT NULL,
  `Freight_segment_val` varchar(200) NOT NULL,
  `Freight_segment_cur` varchar(200) NOT NULL,
  `Indicator_segment_code` varchar(200) NOT NULL,
  `Customs_segment_val` varchar(200) NOT NULL,
  `Customs_segment_cur` varchar(200) NOT NULL,
  `Transport_segment_val` varchar(200) NOT NULL,
  `Transport_segment_cur` varchar(200) NOT NULL,
  `Insurance_segment_val` varchar(200) NOT NULL,
  `Insurance_segment_cur` varchar(200) NOT NULL,
  `Number_of_seals` varchar(200) NOT NULL,
  `Marks_of_seals` varchar(200) NOT NULL,
  `Sealing_party_code` varchar(200) NOT NULL,
  `Information_part_a` varchar(200) NOT NULL,
  `Location_segment_code` varchar(200) NOT NULL,
  `Location_segment_info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `id` int(20) NOT NULL,
  `xmlid` varchar(200) NOT NULL,
  `Referencez` varchar(200) NOT NULL,
  `Numberz` varchar(200) NOT NULL,
  `Typez` varchar(200) NOT NULL,
  `Empty` varchar(200) NOT NULL,
  `Seals` varchar(200) NOT NULL,
  `Mark1` varchar(200) NOT NULL,
  `mark2` varchar(200) NOT NULL,
  `Sealing_party` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `identification_segment`
--

CREATE TABLE `identification_segment` (
  `id` int(20) NOT NULL,
  `xmlid` varchar(200) NOT NULL,
  `reg_number` varchar(200) NOT NULL,
  `dated` varchar(200) NOT NULL,
  `bol_ref` varchar(200) NOT NULL,
  `custom_seg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logintimestamp`
--

CREATE TABLE `logintimestamp` (
  `id` int(20) NOT NULL,
  `userid` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `lasttime` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logintimestamp`
--

INSERT INTO `logintimestamp` (`id`, `userid`, `fullname`, `lasttime`) VALUES
(1, '1', 'Clement', '25-09-2021'),
(2, '2', 'users', '25-09-2021'),
(3, '1', 'Clement', '25-09-2021'),
(4, '2', 'users', '25-09-2021'),
(5, '2', 'users', '25-09-2021'),
(6, '2', 'users', '25-09-2021'),
(7, '1', 'Clement', '25-09-2021'),
(8, '1', 'Clement', '25-09-2021'),
(9, '3', 'kkk', '25-09-2021'),
(10, '1', 'Clement', '25-09-2021'),
(11, '1', 'Clement', '25-09-2021'),
(12, '1', 'Clement', '25-09-2021'),
(13, '1', 'Clement', '25-09-2021'),
(14, '2', 'users', '25-09-2021'),
(15, '2', 'users', '25-09-2021'),
(16, '2', 'users', '25-09-2021'),
(17, '1', 'Clement', '25-09-2021'),
(18, '1', 'Clement', '25-09-2021'),
(19, '1', 'Clement', '26-09-2021'),
(20, '1', 'Clement', '26-09-2021'),
(21, '1', 'Clement', '26-09-2021'),
(22, '5', 'kkk', '26-09-2021'),
(23, '1', 'Clement', '26-09-2021'),
(24, '5', 'kkk', '26-09-2021'),
(25, '5', 'kkk', '26-09-2021'),
(26, '5', 'kkk', '26-09-2021'),
(27, '5', 'kkk', '26-09-2021'),
(28, '1', 'Clement', '26-09-2021'),
(29, '1', 'Clement', '26-09-2021'),
(30, '1', 'Clement', '26-09-2021'),
(31, '5', 'kkk', '26-09-2021'),
(32, '1', 'Clement', '26-09-2021');

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `id` int(20) NOT NULL,
  `TerminalName` varchar(200) NOT NULL,
  `TerminalCode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`id`, `TerminalName`, `TerminalCode`) VALUES
(1, 'DANGOTE JETTY ( DQL)', 'AGENT-BP002171'),
(2, 'PORT AND TERMINAL OPERATORS NIGERIA LIMITED(PTOL)', 'OPERA-BP000038'),
(3, 'TINCAN ISLAND CONTAINER TERMINAL(TICT)', 'OPERA-BP000031 ');

-- --------------------------------------------------------

--
-- Table structure for table `uploadd`
--

CREATE TABLE `uploadd` (
  `id` int(20) NOT NULL,
  `companyname` varchar(200) NOT NULL,
  `fileext` varchar(200) NOT NULL,
  `dateofupload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xmldata`
--

CREATE TABLE `xmldata` (
  `id` int(20) NOT NULL,
  `xmlid` varchar(200) NOT NULL,
  `Registry_number` varchar(200) NOT NULL,
  `dates` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bol_specific_segment`
--
ALTER TABLE `bol_specific_segment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identification_segment`
--
ALTER TABLE `identification_segment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintimestamp`
--
ALTER TABLE `logintimestamp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploadd`
--
ALTER TABLE `uploadd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xmldata`
--
ALTER TABLE `xmldata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bol_specific_segment`
--
ALTER TABLE `bol_specific_segment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identification_segment`
--
ALTER TABLE `identification_segment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logintimestamp`
--
ALTER TABLE `logintimestamp`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uploadd`
--
ALTER TABLE `uploadd`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `xmldata`
--
ALTER TABLE `xmldata`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
