-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 02:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `accepted_services`
--

CREATE TABLE `accepted_services` (
  `id` int(50) NOT NULL,
  `service_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `accepted_by` int(50) DEFAULT NULL,
  `client_id` int(50) DEFAULT NULL,
  `accepted_at` varchar(50) DEFAULT NULL,
  `aAddress` varchar(200) DEFAULT NULL,
  `aContactNo` varchar(15) DEFAULT NULL,
  `aReqServ` varchar(100) DEFAULT NULL,
  `projectCost` decimal(10,2) DEFAULT NULL,
  `uid` varchar(70) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('accepted','ongoing','done') DEFAULT 'accepted',
  `percentage` int(10) DEFAULT NULL,
  `date_started` varchar(50) DEFAULT NULL,
  `date_finish` varchar(50) DEFAULT NULL,
  `approval` enum('N','Y') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accepted_services`
--

INSERT INTO `accepted_services` (`id`, `service_id`, `user_id`, `accepted_by`, `client_id`, `accepted_at`, `aAddress`, `aContactNo`, `aReqServ`, `projectCost`, `uid`, `status`, `percentage`, `date_started`, `date_finish`, `approval`) VALUES
(1, 1, 1150, 1150, 1190, '2025-02-13 15:41:30', 'Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116,', '547868554', 'Concrete and Bricks', '890.00', NULL, 'done', 100, '2025-02-13', '2025-02-13', 'N'),
(2, 2, 1188, 1188, 1190, '2025-02-13 15:47:27', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '979654657', 'Tile Repair', '600.00', NULL, 'ongoing', NULL, NULL, NULL, 'N'),
(3, 3, 1150, 1150, 1190, '2025-02-14 09:15:34', 'Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', '4376765767', 'Cover Pipe Repairs', '676.00', NULL, 'ongoing', 81, '2025-02-14', NULL, 'N'),
(4, 4, 1150, 1150, 1190, '2025-02-14 09:15:36', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '45945034934', 'Leak Detections', '900.00', NULL, 'ongoing', NULL, NULL, NULL, 'N'),
(5, 5, 1150, 1150, 1190, '2025-02-14 09:15:40', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '5675676576', 'Circuit Breaker', '450.00', NULL, 'ongoing', NULL, NULL, NULL, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_services`
--
ALTER TABLE `accepted_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `serProvId` (`client_id`) USING BTREE,
  ADD KEY `client_id` (`accepted_by`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_services`
--
ALTER TABLE `accepted_services`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
