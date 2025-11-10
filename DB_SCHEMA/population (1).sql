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
-- Database: `villageonweb_jol`
--

-- --------------------------------------------------------

--
-- Table structure for table `population`
--

CREATE TABLE `population` (
  `populationid` int NOT NULL,
  `villageid` int DEFAULT NULL,
  `totalnoofmale` int DEFAULT NULL,
  `totalnooffemale` int DEFAULT NULL,
  `totalnoofchildren` int DEFAULT NULL,
  `religionandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `occupationandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `educationandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `salaryandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `birthanddeathratio` varchar(10) DEFAULT NULL,
  `agewisemale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `agewisefemale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `population`
--
ALTER TABLE `population`
  ADD PRIMARY KEY (`populationid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `population`
--
ALTER TABLE `population`
  MODIFY `populationid` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
