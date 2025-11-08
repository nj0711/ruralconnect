-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2024 at 11:51 AM
-- Server version: 10.6.20-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hownewsx_karamsad`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL DEFAULT 0,
  `pno` varchar(15) NOT NULL DEFAULT '0',
  `passwordhash` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `createdat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `banksid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `bankname` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phoneno` bigint(20) DEFAULT NULL,
  `address` varchar(300) NOT NULL,
  `numberofatms` int(11) DEFAULT NULL,
  `branchcode` varchar(20) NOT NULL,
  `operationalstatus` enum('Open','Under Renovation','Closed') NOT NULL,
  `otherserviceinformation` varchar(255) DEFAULT NULL,
  `servicetype` varchar(255) DEFAULT NULL,
  `servicedescription` varchar(255) DEFAULT NULL,
  `timeschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeschedule`)),
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `type` varchar(10) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phoneno` varchar(15) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `msg` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drainage`
--

CREATE TABLE `drainage` (
  `drainageid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `educationid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `facilityavailable` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `contactno` varchar(15) DEFAULT NULL,
  `emailid` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electrification`
--

CREATE TABLE `electrification` (
  `electrificationid` int(11) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `emergencycontactno` varchar(15) DEFAULT NULL,
  `energyresourcessolar` tinyint(1) NOT NULL,
  `energyresourceswind` tinyint(1) NOT NULL,
  `energyresourcescoal` tinyint(1) NOT NULL,
  `energyresourcesgas` tinyint(1) NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `officeaddress` varchar(255) NOT NULL,
  `servicearea` varchar(255) NOT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `supplychain` varchar(255) DEFAULT NULL,
  `villageid` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergencyservices`
--

CREATE TABLE `emergencyservices` (
  `emergencyservicesid` int(11) NOT NULL,
  `servicename` varchar(100) NOT NULL,
  `servicetype` varchar(30) NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `villageid` int(11) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employmentcenters`
--

CREATE TABLE `employmentcenters` (
  `employmentcentersid` int(11) NOT NULL,
  `centername` varchar(100) NOT NULL,
  `servicetype` varchar(30) NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `villageid` int(11) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entertainment`
--

CREATE TABLE `entertainment` (
  `entertainmentid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `timeschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeschedule`)),
  `contactno` bigint(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventsfestivals`
--

CREATE TABLE `eventsfestivals` (
  `eventsfestivalsid` int(11) NOT NULL,
  `eventname` varchar(100) NOT NULL,
  `eventtype` varchar(40) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `contactnumber` varchar(15) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `villageid` int(11) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuelstation`
--

CREATE TABLE `fuelstation` (
  `fuelstationid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `fuelstationname` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `address` varchar(300) DEFAULT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `pumpstimeduration` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pumpstimeduration`)),
  `typesoffuelavailable` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospitalsid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `type` enum('Hospital','Medical Shop','Care Center') NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `address` varchar(255) DEFAULT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `timeduration` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeduration`)),
  `patientcapacity` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotelsid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `hotelname` varchar(255) NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `timeschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeschedule`)),
  `contactno` bigint(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `amenities` varchar(255) DEFAULT NULL,
  `bookingprocess` varchar(255) DEFAULT NULL,
  `websitelink` varchar(255) DEFAULT NULL,
  `customerreviews` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pillarofcommunity`
--

CREATE TABLE `pillarofcommunity` (
  `pillarofcommunityid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `dateofpassing` date DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `politicalcareer` varchar(255) DEFAULT NULL,
  `positionsheld` varchar(255) DEFAULT NULL,
  `roleinindependencemovement` varchar(255) DEFAULT NULL,
  `villageid` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin  CHECK (json_valid(`photo`)),
  `profession` varchar(500) DEFAULT NULL,
  `typeofleader` varchar(50) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `placestoworship`
--

CREATE TABLE `placestoworship` (
  `placestoworshipid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `history` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `address` varchar(255) NOT NULL,
  `timeschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeschedule`)),
  `contactno` bigint(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `population`
--

CREATE TABLE `population` (
  `populationid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `totalnoofmale` int(11) DEFAULT NULL,
  `totalnooffemale` int(11) DEFAULT NULL,
  `totalnoofchildren` int(11) DEFAULT NULL,
  `religionandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`religionandpopulation`)),
  `occupationandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`occupationandpopulation`)),
  `educationandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`educationandpopulation`)),
  `salaryandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`salaryandpopulation`)),
  `birthanddeathratio` varchar(10) DEFAULT NULL,
  `agewisemale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`agewisemale`)),
  `agewisefemale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`agewisefemale`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurantsid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `restaurantname` varchar(255) NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `timeschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeschedule`)),
  `contactno` bigint(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cuisineserved` varchar(255) DEFAULT NULL,
  `websitelink` varchar(255) DEFAULT NULL,
  `customerreviews` varchar(255) DEFAULT NULL,
  `bookingprocess` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourismplaces`
--

CREATE TABLE `tourismplaces` (
  `tourismplacesid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `timeduration` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeduration`)),
  `contactno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `amenitiesfacilities` varchar(300) DEFAULT NULL,
  `entryfees` int(11) DEFAULT NULL,
  `history` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transportid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `stationname` varchar(255) DEFAULT NULL,
  `stationtype` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ticketingprocess` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villagebasic`
--

CREATE TABLE `villagebasic` (
  `villageid` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `mapdes` varchar(500) DEFAULT NULL,
  `area` varchar(10) DEFAULT NULL,
  `establishedyear` varchar(5) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `sarpanchname` varchar(50) DEFAULT NULL,
  `contactnumber` varchar(15) DEFAULT NULL,
  `vmap` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`villageid`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `washrooms`
--

CREATE TABLE `washrooms` (
  `washroomsid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `numberofwashrooms` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watersupply`
--

CREATE TABLE `watersupply` (
  `watersupplyid` int(11) NOT NULL,
  `villageid` int(11) DEFAULT NULL,
  `systemdescription` varchar(255) NOT NULL,
  `sourcetype` varchar(255) NOT NULL,
  `sourcedescription` varchar(255) NOT NULL,
  `installationdate` date NOT NULL,
  `capacity` bigint(20) NOT NULL,
  `lastmaintenancedate` date DEFAULT NULL,
  `systemcondition` varchar(255) DEFAULT NULL,
  `watersupplyschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`watersupplyschedule`)),
  `entityname` varchar(255) NOT NULL,
  `entitytype` varchar(255) DEFAULT NULL,
  `contactphone` bigint(20) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fundingsource` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `username` (`pno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`banksid`),
  ADD UNIQUE KEY `branchcode` (`branchcode`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactid`),
  ADD KEY `vid` (`vid`);

--
-- Indexes for table `drainage`
--
ALTER TABLE `drainage`
  ADD PRIMARY KEY (`drainageid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`educationid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `electrification`
--
ALTER TABLE `electrification`
  ADD PRIMARY KEY (`electrificationid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `emergencyservices`
--
ALTER TABLE `emergencyservices`
  ADD PRIMARY KEY (`emergencyservicesid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `employmentcenters`
--
ALTER TABLE `employmentcenters`
  ADD PRIMARY KEY (`employmentcentersid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `entertainment`
--
ALTER TABLE `entertainment`
  ADD PRIMARY KEY (`entertainmentid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `eventsfestivals`
--
ALTER TABLE `eventsfestivals`
  ADD PRIMARY KEY (`eventsfestivalsid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `fuelstation`
--
ALTER TABLE `fuelstation`
  ADD PRIMARY KEY (`fuelstationid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospitalsid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotelsid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `pillarofcommunity`
--
ALTER TABLE `pillarofcommunity`
  ADD PRIMARY KEY (`pillarofcommunityid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `placestoworship`
--
ALTER TABLE `placestoworship`
  ADD PRIMARY KEY (`placestoworshipid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `population`
--
ALTER TABLE `population`
  ADD PRIMARY KEY (`populationid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurantsid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `tourismplaces`
--
ALTER TABLE `tourismplaces`
  ADD PRIMARY KEY (`tourismplacesid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transportid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `villagebasic`
--
ALTER TABLE `villagebasic`
  ADD PRIMARY KEY (`villageid`),
  ADD KEY `adminid` (`adminid`);

--
-- Indexes for table `washrooms`
--
ALTER TABLE `washrooms`
  ADD PRIMARY KEY (`washroomsid`),
  ADD KEY `villageid` (`villageid`);

--
-- Indexes for table `watersupply`
--
ALTER TABLE `watersupply`
  ADD PRIMARY KEY (`watersupplyid`),
  ADD KEY `villageid` (`villageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `banksid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drainage`
--
ALTER TABLE `drainage`
  MODIFY `drainageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `educationid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electrification`
--
ALTER TABLE `electrification`
  MODIFY `electrificationid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergencyservices`
--
ALTER TABLE `emergencyservices`
  MODIFY `emergencyservicesid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employmentcenters`
--
ALTER TABLE `employmentcenters`
  MODIFY `employmentcentersid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entertainment`
--
ALTER TABLE `entertainment`
  MODIFY `entertainmentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventsfestivals`
--
ALTER TABLE `eventsfestivals`
  MODIFY `eventsfestivalsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuelstation`
--
ALTER TABLE `fuelstation`
  MODIFY `fuelstationid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospitalsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotelsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pillarofcommunity`
--
ALTER TABLE `pillarofcommunity`
  MODIFY `pillarofcommunityid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `placestoworship`
--
ALTER TABLE `placestoworship`
  MODIFY `placestoworshipid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `population`
--
ALTER TABLE `population`
  MODIFY `populationid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurantsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourismplaces`
--
ALTER TABLE `tourismplaces`
  MODIFY `tourismplacesid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transportid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villagebasic`
--
ALTER TABLE `villagebasic`
  MODIFY `villageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `washrooms`
--
ALTER TABLE `washrooms`
  MODIFY `washroomsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `watersupply`
--
ALTER TABLE `watersupply`
  MODIFY `watersupplyid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`vid`) REFERENCES `villagebasic` (`villageid`);

--
-- Constraints for table `drainage`
--
ALTER TABLE `drainage`
  ADD CONSTRAINT `drainage_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `electrification`
--
ALTER TABLE `electrification`
  ADD CONSTRAINT `electrification_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `emergencyservices`
--
ALTER TABLE `emergencyservices`
  ADD CONSTRAINT `emergencyservices_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `employmentcenters`
--
ALTER TABLE `employmentcenters`
  ADD CONSTRAINT `employmentcenters_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `entertainment`
--
ALTER TABLE `entertainment`
  ADD CONSTRAINT `entertainment_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`);

--
-- Constraints for table `eventsfestivals`
--
ALTER TABLE `eventsfestivals`
  ADD CONSTRAINT `eventsfestivals_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `fuelstation`
--
ALTER TABLE `fuelstation`
  ADD CONSTRAINT `fuelstation_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `pillarofcommunity`
--
ALTER TABLE `pillarofcommunity`
  ADD CONSTRAINT `pillarofcommunity_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `placestoworship`
--
ALTER TABLE `placestoworship`
  ADD CONSTRAINT `placestoworship_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `population`
--
ALTER TABLE `population`
  ADD CONSTRAINT `population_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `tourismplaces`
--
ALTER TABLE `tourismplaces`
  ADD CONSTRAINT `tourismplaces_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `villagebasic`
--
ALTER TABLE `villagebasic`
  ADD CONSTRAINT `villagebasic_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`adminid`) ON DELETE CASCADE;

--
-- Constraints for table `washrooms`
--
ALTER TABLE `washrooms`
  ADD CONSTRAINT `washrooms_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;

--
-- Constraints for table `watersupply`
--
ALTER TABLE `watersupply`
  ADD CONSTRAINT `watersupply_ibfk_1` FOREIGN KEY (`villageid`) REFERENCES `villagebasic` (`villageid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
