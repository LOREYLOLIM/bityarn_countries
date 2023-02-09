-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 09:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counties`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Kenya');

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE `county` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `countryID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `county`
--

INSERT INTO `county` (`id`, `name`, `countryID`) VALUES
(1, 'Nairobi', 1),
(2, 'Kiambu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`) VALUES
(1, 'country'),
(2, 'county'),
(3, 'subcounty'),
(4, 'location'),
(5, 'ward');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subcountyID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `subcountyID`) VALUES
(1, 'Kibongoti', 3),
(2, 'Gacharu', 3),
(3, 'Cianda', 4),
(4, 'Kihara', 4),
(5, 'Runda', 1),
(6, 'Muthaiga', 1),
(7, 'Ngara', 2),
(8, 'Nairobi South', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subcounty`
--

CREATE TABLE `subcounty` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `countyID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcounty`
--

INSERT INTO `subcounty` (`id`, `name`, `countyID`) VALUES
(1, 'Westlands', 1),
(2, 'Starehe', 1),
(3, 'Ruiru', 2),
(4, 'Kikuyu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `locationID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `name`, `locationID`) VALUES
(1, 'Kiine', 1),
(2, 'Ndia', 1),
(3, 'Karima', 2),
(4, 'Kathaka', 2),
(5, 'Mwiki', 3),
(6, 'Ngewa', 3),
(7, 'Gitothua', 4),
(8, 'Mwihoko', 4),
(9, 'Deep Sea', 5),
(10, 'Suswa', 5),
(11, 'Karura', 6),
(12, 'Mountain View', 6),
(13, 'Kabanga', 7),
(14, 'Keza', 7),
(15, 'Ziwani', 8),
(16, 'Pangani', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryID` (`countryID`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcountyID` (`subcountyID`);

--
-- Indexes for table `subcounty`
--
ALTER TABLE `subcounty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countyID` (`countyID`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locationID` (`locationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `county`
--
ALTER TABLE `county`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subcounty`
--
ALTER TABLE `subcounty`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `county`
--
ALTER TABLE `county`
  ADD CONSTRAINT `county_ibfk_1` FOREIGN KEY (`countryID`) REFERENCES `country` (`id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`subcountyID`) REFERENCES `subcounty` (`id`);

--
-- Constraints for table `subcounty`
--
ALTER TABLE `subcounty`
  ADD CONSTRAINT `subcounty_ibfk_1` FOREIGN KEY (`countyID`) REFERENCES `county` (`id`);

--
-- Constraints for table `ward`
--
ALTER TABLE `ward`
  ADD CONSTRAINT `ward_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `location` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
