-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 06:35 AM
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
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `l_id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `user_type` int(1) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `landMark` varchar(150) DEFAULT NULL,
  `area_long` text DEFAULT NULL,
  `area_lat` text DEFAULT NULL,
  `is_deleted` int(1) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` int(55) DEFAULT NULL,
  `modified_by` int(55) DEFAULT NULL,
  `date_modified` varchar(50) DEFAULT NULL,
  `date_deleted` varchar(50) DEFAULT NULL,
  `deleted_by` int(55) DEFAULT NULL,
  `uid` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`l_id`, `user_id`, `user_type`, `name`, `landMark`, `area_long`, `area_lat`, `is_deleted`, `is_active`, `date_added`, `added_by`, `modified_by`, `date_modified`, `date_deleted`, `deleted_by`, `uid`) VALUES
(1, 1150, 1, 'Lacson Street, Santo Domingo, Banago, Bacolod-1, Bacolo', NULL, '122.96190913197762', '10.700668158571482', 0, 1, '2024-12-20 13:25:48', 1150, 1150, '2024-12-23 11:03:26', '2025-01-29 19:39:43', 1150, 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 1150, 1, 'West Lake Viillas, Punta Tabuc, Roxas, Capiz, Western V', NULL, '122.7456512', '11.5900416', 0, 1, '2024-12-20 15:09:39', 1150, NULL, NULL, '2024-12-20 16:52:44', 1150, 'c81e728d9d4c2f636f067f89cc14862c'),
(3, 1150, 1, 'Pueblo Santa Maria, Daga, Cadiz, Negros Occidental, Neg', 'Sample landmark', '123.29147299076516', '10.944712314542851', 0, 1, '2024-12-23 10:18:40', 1150, 1150, '2025-01-29 20:01:10', '2025-01-29 20:01:22', 1150, 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
(4, 1190, 0, 'Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', 'tayabas elementary school', '122.96499678134596', '10.731925740507005', 0, 1, '2024-12-23 11:15:02', 1190, 1190, '2025-01-29 17:37:12', '2025-02-03 13:03:40', 1190, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 1190, 0, 'Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116,', 'INC CHURCH', '123.08576961259686', '10.755646854590262', 0, 1, '2024-12-23 16:02:11', 1190, 1190, '2025-01-29 19:58:00', '2025-02-03 13:01:34', 1190, 'e4da3b7fbbce2345d7772b0674a318d5'),
(6, 1188, 1, 'Lacson Street, Santo Domingo, Banago, Bacolod-1, Bacolod, Negros Island Region, 6115, Philippines', 'Country mart', '122.96199268541365', '10.699899940932056', 0, 1, '2024-12-27 09:49:59', 1188, 1188, '2025-01-29 20:10:01', '2024-12-27 09:54:26', 1188, '1679091c5a880faf6fb5e6087eb1b2dc'),
(9, 1190, 0, 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', 'ayala north point', '122.96311080404882', '10.722396873835189', 0, 1, '2025-01-29 14:59:02', 1190, NULL, NULL, '2025-02-03 10:27:20', 1190, '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(10, 1150, 0, '18th Street, Sibuyas, Lacson Tourism Strip, Bacolod-1, Bacolod, Negros Island Region, 6100, Philippines', 'starbucks', '122.9557825', '10.6813544', 0, 0, '2025-01-29 19:53:28', 1150, NULL, NULL, NULL, NULL, 'd3d9446802a44259755d38e6d163e820'),
(11, 1188, 0, 'Jollibee, F. Cabahug Street, Panagdait, Cebu City, Central Visayas, 6000, Philippines', 'test and sample landmark', '123.9187456', '10.3251968', 0, 0, '2025-01-29 20:07:13', 1188, NULL, NULL, NULL, NULL, '6512bd43d9caa6e02c990b0a82652dca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`l_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `l_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
