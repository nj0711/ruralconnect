-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 01:03 PM
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
-- Table structure for table `drainage`
--

CREATE TABLE `drainage` (
  `drainageid` int NOT NULL,
  `villageid` int DEFAULT NULL,
  `systemcondition` enum('Good','Fair','Poor') NOT NULL,
  `lastmaintenancedate` date DEFAULT NULL,
  `capacity` decimal(10,2) DEFAULT NULL,
  `type` enum('Open Drain','Covered Drain','Sewer System') NOT NULL,
  `coveragearea` decimal(12,2) DEFAULT NULL,
  `issuesreported` varchar(255) DEFAULT NULL,
  `maintenancehistory` varchar(255) DEFAULT NULL,
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
-- Indexes for table `drainage`
--
ALTER TABLE `drainage`
  ADD PRIMARY KEY (`drainageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drainage`
--
ALTER TABLE `drainage`
  MODIFY `drainageid` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
