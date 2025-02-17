-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 02:52 AM
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
-- Table structure for table `tbl_bookings`
--

CREATE TABLE `tbl_bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `requested_service` varchar(50) DEFAULT NULL,
  `booking_address` varchar(100) DEFAULT NULL,
  `contact_num` text DEFAULT NULL,
  `booking_status` enum('pending','accepted') DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `bookings_image` varchar(50) DEFAULT NULL,
  `bookings_thumbnail` varchar(50) DEFAULT NULL,
  `roomNo` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`booking_id`, `user_id`, `service_id`, `requested_service`, `booking_address`, `contact_num`, `booking_status`, `created_at`, `updated_at`, `bookings_image`, `bookings_thumbnail`, `roomNo`) VALUES
(1, 1190, NULL, 'Concrete and Bricks', 'Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116,', '547868554', 'accepted', '2025-02-26', NULL, NULL, NULL, 4),
(2, 1190, NULL, 'Tile Repair', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '979654657', 'accepted', '2025-02-21', NULL, NULL, NULL, 8),
(3, 1190, NULL, 'Cover Pipe Repairs', 'Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', '4376765767', 'accepted', '2025-02-15', NULL, NULL, NULL, 6),
(4, 1190, NULL, 'Leak Detections', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '45945034934', 'accepted', '2025-02-20', NULL, NULL, NULL, 6),
(5, 1190, NULL, 'Circuit Breaker', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '5675676576', 'accepted', '2025-02-25', NULL, NULL, NULL, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
