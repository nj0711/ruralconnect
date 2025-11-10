-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 01:06 PM
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
-- Table structure for table `watersupply`
--

CREATE TABLE `watersupply` (
  `watersupplyid` int NOT NULL,
  `villageid` int DEFAULT NULL,
  `systemdescription` varchar(255) NOT NULL,
  `sourcetype` varchar(255) NOT NULL,
  `sourcedescription` varchar(255) NOT NULL,
  `installationdate` date NOT NULL,
  `capacity` bigint NOT NULL,
  `lastmaintenancedate` date DEFAULT NULL,
  `systemcondition` varchar(255) DEFAULT NULL,
  `watersupplyschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `entityname` varchar(255) NOT NULL,
  `entitytype` varchar(255) DEFAULT NULL,
  `contactphone` bigint DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fundingsource` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `watersupply`
--
ALTER TABLE `watersupply`
  ADD PRIMARY KEY (`watersupplyid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `watersupply`
--
ALTER TABLE `watersupply`
  MODIFY `watersupplyid` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
