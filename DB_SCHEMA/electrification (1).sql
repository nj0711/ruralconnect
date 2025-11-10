-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 01:04 PM
-- Server version: 8.0.41
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `villageonweb_jol`
--

-- --------------------------------------------------------

--
-- Table structure for table `electrification`
--

CREATE TABLE `electrification` (
  `electrificationid` int NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `emergencycontactno` varchar(15) DEFAULT NULL,
  `energyresourcessolar` tinyint(1) NOT NULL,
  `energyresourceswind` tinyint(1) NOT NULL,
  `energyresourcescoal` tinyint(1) NOT NULL,
  `energyresourcesgas` tinyint(1) NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `officeaddress` varchar(255) NOT NULL,
  `servicearea` varchar(255) NOT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `supplychain` varchar(255) DEFAULT NULL,
  `villageid` int DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'on'
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `electrification`
--
ALTER TABLE `electrification`
  ADD PRIMARY KEY (`electrificationid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `electrification`
--
ALTER TABLE `electrification`
  MODIFY `electrificationid` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
