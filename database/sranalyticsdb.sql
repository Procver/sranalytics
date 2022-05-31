-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 12:38 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sranalyticsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `Car_id` int(11) NOT NULL,
  `Session_id` int(11) NOT NULL,
  `Guid` bigint(17) NOT NULL,
  `Model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `Guid` bigint(17) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Team` varchar(50) DEFAULT NULL,
  `Nation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Event_id` int(11) NOT NULL,
  `Session_id` int(11) DEFAULT NULL,
  `Type` varchar(40) DEFAULT NULL,
  `Car_id` int(11) DEFAULT NULL,
  `OtherCar_id` int(11) DEFAULT NULL,
  `ImpactSpeed` double DEFAULT NULL,
  `WPX` double DEFAULT NULL,
  `WPY` double DEFAULT NULL,
  `WPZ` double DEFAULT NULL,
  `RPX` double DEFAULT NULL,
  `RPY` double DEFAULT NULL,
  `RPZ` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laps`
--

CREATE TABLE `laps` (
  `Lap_id` int(11) NOT NULL,
  `Session_id` int(11) DEFAULT NULL,
  `Car_id` int(11) DEFAULT NULL,
  `Timestamp` int(10) DEFAULT NULL,
  `LapTime` int(10) DEFAULT NULL,
  `Sector1` int(10) DEFAULT NULL,
  `Sector2` int(10) DEFAULT NULL,
  `Sector3` int(10) DEFAULT NULL,
  `Cuts` int(3) DEFAULT NULL,
  `Tyre` varchar(50) DEFAULT NULL,
  `BallastKG` int(3) DEFAULT NULL,
  `Restrictor` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `Model_id` int(11) NOT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Skin` varchar(50) DEFAULT NULL,
  `BallastKG` int(3) DEFAULT NULL,
  `Restrictor` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `Result_id` int(11) NOT NULL,
  `Session_id` int(11) NOT NULL,
  `Car_id` int(11) NOT NULL,
  `BestLap` int(10) NOT NULL,
  `TotalTime` int(10) NOT NULL,
  `BallastKG` int(3) NOT NULL,
  `Restrictor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `Session_id` int(11) NOT NULL,
  `SessionDate` bigint(12) DEFAULT NULL,
  `Weekend_id` int(11) DEFAULT NULL,
  `TrackName` varchar(50) DEFAULT NULL,
  `TrackConfig` varchar(50) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  `DurationSecs` int(5) DEFAULT NULL,
  `RaceLaps` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `Tournament_id` int(11) UNSIGNED NOT NULL,
  `Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `weekends`
--

CREATE TABLE `weekends` (
  `Weekend_id` int(11) NOT NULL,
  `UploadDate` bigint(12) DEFAULT NULL,
  `Tournament_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`Car_id`),
  ADD KEY `Session_id` (`Session_id`,`Model_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`Guid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_id`),
  ADD KEY `Session_id` (`Session_id`,`Car_id`,`OtherCar_id`);

--
-- Indexes for table `laps`
--
ALTER TABLE `laps`
  ADD PRIMARY KEY (`Lap_id`),
  ADD KEY `Session_id` (`Session_id`,`Car_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`Model_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`Result_id`) USING BTREE,
  ADD KEY `Session_id` (`Session_id`),
  ADD KEY `Car_id` (`Car_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`Session_id`),
  ADD KEY `Weekend_id` (`Weekend_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`Tournament_id`),
  ADD KEY `Tournament_id` (`Tournament_id`);

--
-- Indexes for table `weekends`
--
ALTER TABLE `weekends`
  ADD PRIMARY KEY (`Weekend_id`),
  ADD KEY `Tournament_id` (`Tournament_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `Car_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laps`
--
ALTER TABLE `laps`
  MODIFY `Lap_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `Model_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `Result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `Session_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `Tournament_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weekends`
--
ALTER TABLE `weekends`
  MODIFY `Weekend_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
