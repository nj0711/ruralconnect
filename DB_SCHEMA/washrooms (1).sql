-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 01:05 PM
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
-- Database: `ruralconnectjol`
--

-- --------------------------------------------------------

--
-- Table structure for table `washrooms`
--

CREATE TABLE `washrooms` (
  `washroomsid` int NOT NULL,
  `villageid` int DEFAULT NULL,
  `numberofwashrooms` int NOT NULL,
  `locationdescription` varchar(255) NOT NULL,
  `facilitytype` enum('Free','Paid','Accessible') DEFAULT NULL,
  `washroomcondition` enum('Clean','Needs Repair') DEFAULT NULL,
  `maintenanceschedule` varchar(255) DEFAULT NULL,
  `entityname` varchar(255) DEFAULT NULL,
  `entitytype` enum('NGO','Government','Private') NOT NULL,
  `primarycontactperson` varchar(255) DEFAULT NULL,
  `phoneno` varchar(15) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `fundingsource` varchar(255) DEFAULT NULL,
  `establisheddate` date DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `washrooms`
--
ALTER TABLE `washrooms`
  ADD PRIMARY KEY (`washroomsid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `washrooms`
--
ALTER TABLE `washrooms`
  MODIFY `washroomsid` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
