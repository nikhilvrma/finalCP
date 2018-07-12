-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2018 at 11:12 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

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
-- Table structure for table `psychometricEvaluationTestSettings`
--

CREATE TABLE `psychometricEvaluationTestSettings` (
  `psychometricEvaluationTestSettingsID` int(11) NOT NULL,
  `numberOfQuestions` int(5) NOT NULL,
  `testTime` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psychometricEvaluationTestSettings`
--

INSERT INTO `psychometricEvaluationTestSettings` (`psychometricEvaluationTestSettingsID`, `numberOfQuestions`, `testTime`) VALUES
(1, 15, 1200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `psychometricEvaluationTestSettings`
--
ALTER TABLE `psychometricEvaluationTestSettings`
  ADD PRIMARY KEY (`psychometricEvaluationTestSettingsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `psychometricEvaluationTestSettings`
--
ALTER TABLE `psychometricEvaluationTestSettings`
  MODIFY `psychometricEvaluationTestSettingsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
