-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2018 at 10:27 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letstravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Email` varchar(40) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `age_group`
--

CREATE TABLE `age_group` (
  `Location` varchar(20) NOT NULL,
  `AgeGroup` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `get_recommendation`
--

CREATE TABLE `get_recommendation` (
  `UserEmail` varchar(40) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `NumberOfDays` tinyint(2) NOT NULL,
  `AgeGroup` varchar(10) NOT NULL,
  `TripGroup` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `Hotel Name` varchar(22) DEFAULT NULL,
  `Rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`Hotel Name`, `Rating`) VALUES
('Amarvilas', 5),
('The Lalit', 5),
('Grand Hyatt ', 5),
('The Renaissance', 5),
('JW Marriott', 5),
('The Oberoi', 5),
('The Taj', 5),
('The Leela Palace', 5),
('Ritz Carlton', 5),
('The Roseate', 5),
('Trident', 5),
('The Tamara', 5),
('Vivanta', 5),
('Le Meridian', 5),
('Hotel de l\'Orient', 5),
('Four Seasons Hotel', 3),
('The Westin Garden City', 3),
('Fairmont', 3),
('Park Hyatt', 3),
('Moevenpick', 3),
('Taj Exotica', 3),
('Wildflower Hall', 3),
('AmanBagh Resort', 3),
('Orange Country Resort', 3),
('Kohinoor', 3),
('Hotel Le Grande', 3),
('Regal Enclave', 3),
('Mapple Hermitage', 3),
('The Oriental Residency', 3),
('Tunga International', 3);

-- --------------------------------------------------------

--
-- Table structure for table `join_trip`
--

CREATE TABLE `join_trip` (
  `UserEmail` varchar(40) NOT NULL,
  `TripId` varchar(5) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Age` tinyint(3) NOT NULL,
  `Contact` bigint(10) NOT NULL,
  `AadharNumber` bigint(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE `recommendation` (
  `Location` varchar(20) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Link` varchar(40) NOT NULL,
  `NumberOfDays` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `TripId` varchar(10) NOT NULL,
  `Image` varchar(20) NOT NULL,
  `BasePrice` mediumint(10) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Itinerary` varchar(20) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `CreatedBy` varchar(40) NOT NULL,
  `GuideName` varchar(40) NOT NULL,
  `GuideContact` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_group`
--

CREATE TABLE `trip_group` (
  `Location` varchar(20) NOT NULL,
  `TripGroup` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_location`
--

CREATE TABLE `trip_location` (
  `tripId` varchar(10) NOT NULL,
  `locations` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Mobile` bigint(10) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Rate` tinyint(1) UNSIGNED NOT NULL,
  `Review` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`FirstName`, `LastName`, `Email`, `Password`, `Mobile`, `City`, `Rate`, `Review`) VALUES
('Grusha', 'Dharod', 'grusha.d@somaiya.edu', 'grusha', 1234567890, '', 0, ''),
('Shivanee', 'Jaiswal', 'shivanee.j@somaiya.edu', '12345', 8097806372, '', 0, ''),
('Vicky', 'Daiya', 'vicky.daiya@somaiya.edu', 'vicky', 9876543210, '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `age_group`
--
ALTER TABLE `age_group`
  ADD PRIMARY KEY (`Location`,`AgeGroup`);

--
-- Indexes for table `get_recommendation`
--
ALTER TABLE `get_recommendation`
  ADD PRIMARY KEY (`UserEmail`,`Location`),
  ADD KEY `get_recommendation_ibfk_2` (`Location`);

--
-- Indexes for table `join_trip`
--
ALTER TABLE `join_trip`
  ADD PRIMARY KEY (`UserEmail`,`TripId`,`AadharNumber`),
  ADD KEY `TripId` (`TripId`),
  ADD KEY `UserEmail` (`UserEmail`);

--
-- Indexes for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD PRIMARY KEY (`Location`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`TripId`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `trip_group`
--
ALTER TABLE `trip_group`
  ADD PRIMARY KEY (`Location`,`TripGroup`);

--
-- Indexes for table `trip_location`
--
ALTER TABLE `trip_location`
  ADD KEY `triploc` (`tripId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `age_group`
--
ALTER TABLE `age_group`
  ADD CONSTRAINT `age_group_ibfk_1` FOREIGN KEY (`Location`) REFERENCES `recommendation` (`Location`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `get_recommendation`
--
ALTER TABLE `get_recommendation`
  ADD CONSTRAINT `get_recommendation_ibfk_1` FOREIGN KEY (`UserEmail`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `get_recommendation_ibfk_2` FOREIGN KEY (`Location`) REFERENCES `recommendation` (`Location`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `join_trip`
--
ALTER TABLE `join_trip`
  ADD CONSTRAINT `join_trip_ibfk_1` FOREIGN KEY (`TripId`) REFERENCES `trip` (`TripId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `join_trip_ibfk_2` FOREIGN KEY (`UserEmail`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `admin` (`Email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trip_group`
--
ALTER TABLE `trip_group`
  ADD CONSTRAINT `trip_group_ibfk_1` FOREIGN KEY (`Location`) REFERENCES `recommendation` (`Location`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_location`
--
ALTER TABLE `trip_location`
  ADD CONSTRAINT `triploc` FOREIGN KEY (`tripId`) REFERENCES `trip` (`TripId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
