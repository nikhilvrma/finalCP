-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2018 at 09:40 PM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.5-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp_backoffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `psychometricEvaluationResponses`
--

CREATE TABLE `psychometricEvaluationResponses` (
  `psychometricEvaluationResponseID` int(5) NOT NULL,
  `userID` int(8) NOT NULL,
  `questionID` int(5) NOT NULL,
  `responseOption` int(5) NOT NULL,
  `psychometricEvaluationCategoryID` int(5) NOT NULL,
  `responseAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `psychometricEvaluationResponses`
--
ALTER TABLE `psychometricEvaluationResponses`
  ADD PRIMARY KEY (`psychometricEvaluationResponseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `psychometricEvaluationResponses`
--
ALTER TABLE `psychometricEvaluationResponses`
  MODIFY `psychometricEvaluationResponseID` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
