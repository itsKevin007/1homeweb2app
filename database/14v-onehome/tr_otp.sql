-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 09:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_onehome`
--

-- --------------------------------------------------------

--
-- Table structure for table `tr_otp`
--

CREATE TABLE `tr_otp` (
  `ra_id` int(50) NOT NULL,
  `reg_id` int(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `verification` varchar(150) DEFAULT NULL,
  `request_by` varchar(150) DEFAULT NULL,
  `date_request` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_otp`
--

INSERT INTO `tr_otp` (`ra_id`, `reg_id`, `email`, `verification`, `request_by`, `date_request`) VALUES
(19, 1150, 'cortez.kevin0914@gmail.com', 'PPB8NT', '', '2025-01-08 16:43:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tr_otp`
--
ALTER TABLE `tr_otp`
  ADD PRIMARY KEY (`ra_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tr_otp`
--
ALTER TABLE `tr_otp`
  MODIFY `ra_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
