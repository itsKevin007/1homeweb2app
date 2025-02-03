-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 03:08 AM
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
-- Table structure for table `accepted_services`
--

CREATE TABLE `accepted_services` (
  `id` int(50) NOT NULL,
  `service_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `accepted_at` varchar(50) DEFAULT NULL,
  `aAddress` varchar(100) DEFAULT NULL,
  `aContactNo` varchar(15) DEFAULT NULL,
  `aReqServ` varchar(100) DEFAULT NULL,
  `projectCost` decimal(9,3) DEFAULT NULL,
  `uid` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('accepted','ongoing','done') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_client`
--

CREATE TABLE `bs_client` (
  `c_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `c_fname` varchar(100) DEFAULT NULL,
  `c_mname` varchar(100) DEFAULT NULL,
  `c_lname` varchar(100) DEFAULT NULL,
  `c_suffix` varchar(20) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `birth` varchar(50) DEFAULT NULL,
  `age` int(100) DEFAULT NULL,
  `govid` varchar(100) DEFAULT NULL,
  `idnum` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `civil` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `connum` varchar(50) DEFAULT NULL,
  `region_text` text DEFAULT NULL,
  `province_text` text DEFAULT NULL,
  `city_text` text DEFAULT NULL,
  `barangay_text` text DEFAULT NULL,
  `zipcode` int(50) DEFAULT NULL,
  `subdivision` text DEFAULT NULL,
  `street` text DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `building` text DEFAULT NULL,
  `phase` text DEFAULT NULL,
  `blocklot` text DEFAULT NULL,
  `membership` text DEFAULT NULL,
  `payment` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `bank` text DEFAULT NULL,
  `accname` text DEFAULT NULL,
  `branch` text DEFAULT NULL,
  `checknum` text DEFAULT NULL,
  `accnum` text DEFAULT NULL,
  `billing` text DEFAULT NULL,
  `gateperimeter` varchar(10) DEFAULT NULL,
  `waiver` text DEFAULT NULL,
  `agree` varchar(10) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(170) DEFAULT NULL,
  `thumbnail` varchar(50) DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_modified` varchar(50) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `date_deleted` varchar(50) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `uid` varchar(150) DEFAULT NULL,
  `c_username` varchar(50) DEFAULT NULL,
  `c_password` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_logout` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_test` tinyint(1) DEFAULT 0,
  `office_add` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_client`
--

INSERT INTO `bs_client` (`c_id`, `user_id`, `c_fname`, `c_mname`, `c_lname`, `c_suffix`, `nationality`, `birth`, `age`, `govid`, `idnum`, `gender`, `civil`, `email`, `connum`, `region_text`, `province_text`, `city_text`, `barangay_text`, `zipcode`, `subdivision`, `street`, `unit`, `building`, `phase`, `blocklot`, `membership`, `payment`, `amount`, `bank`, `accname`, `branch`, `checknum`, `accnum`, `billing`, `gateperimeter`, `waiver`, `agree`, `longitude`, `latitude`, `message`, `address`, `image`, `thumbnail`, `date_added`, `added_by`, `date_modified`, `modified_by`, `date_deleted`, `deleted_by`, `is_deleted`, `uid`, `c_username`, `c_password`, `is_active`, `last_login`, `last_logout`, `is_test`, `office_add`) VALUES
(1, 1002, 'Admin', '', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', '09321321321', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'trident', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'c4ca4238a0b923820dcc509a6f75849b', NULL, NULL, 0, '2025-01-16 02:31:53', '2024-03-18 08:12:40', 0, NULL),
(84, NULL, 'Ronald', 'Pagran', 'Tangguan', '', 'Filipino', '2001-07-17', 23, 'TIN ID', '12331123321', 'Male', 'Single', 'tangguaronald@gmail.com', '09397765466', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Talisay', 'Zone 4 (Pob.)', 6115, '', 'Capt Sabi', '', 'Rolly Hair Salon', '', '', 'Basic', 'cash', '500000', '123321123321', NULL, 'Talisay', '123321123321', '123321123321', 'Yes', 'Yes', 'Ronald Tangguan', 'agree', '122.966017', '10.739538', NULL, NULL, NULL, NULL, '2024-10-15 15:34:21', NULL, NULL, NULL, NULL, NULL, 0, '68d30a9594728bc39aa24be94b319d21', NULL, NULL, 0, '2024-10-15 07:34:21', '2024-10-15 07:34:21', 0, NULL),
(85, 1190, 'Benz', 'Alijid', 'Lozada', '', 'Filipino', '2000-03-10', 24, 'TIN', '1234567890', 'Male', 'Single', 'heheh@gmail.com', '123456789', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Talisay', 'Zone 14 (Pob.)', 6115, '', 'Prk. Mahidaiton', '123', 'Sanparq', '4', 'Blk 10 lot 7', 'Platinum', 'check', '1000', 'BPI', 'benz', 'Mandalagan', '09876', '1234', 'Yes', 'No', 'TEST', 'agree', '122.971832', '10.728494', NULL, NULL, '0e9b058eace4e61ca41cf4f1165d3e21.jpg', '5d77e89e3bce8dde0666639e6fa7a013.jpg', '2024-10-16 22:42:11', NULL, '2025-01-20 10:00:29', 1190, '', 0, 0, '3ef815416f775098fe977004015c6193', NULL, NULL, 0, '2025-01-20 02:00:29', '2024-10-16 14:42:11', 0, 'Brgy. Mandalagan, Bacolod City'),
(1191, NULL, 'Abel', 'Daphne Preston', 'Hoover', 'Dolore hic dicta exe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'qigehudo@mailinator.com', '+1 (857) 174-1493', 'Region XI (Davao Region)', 'Davao Del Norte', 'New Corella', 'Santa Cruz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2025, NULL, NULL, NULL, NULL, 0, 'b20bb95ab626d93fd976af958fbc61ba', NULL, NULL, 0, '2025-01-02 08:06:44', '2025-01-02 08:06:44', 0, NULL),
(1192, 1194, 'Allistair', 'Porter Figueroa', 'Russo', 'Qui esse quaerat acc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sutod@mailinator.com', '+1 (608) 631-8449', 'Cordillera Administrative Region (CAR)', 'Apayao', 'Pudtol', 'Poblacion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pa$$w0rd!', 2025, NULL, NULL, NULL, NULL, 0, '52292e0c763fd027c6eba6b8f494d2eb', NULL, NULL, 0, '2025-01-03 03:07:28', '2025-01-03 03:07:28', 0, NULL),
(1193, 1195, 'Allistair', 'Porter Figueroa', 'Russo', 'Qui esse quaerat acc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sutod123@mailinator.com', '+1 (608) 631-8449', 'Cordillera Administrative Region (CAR)', 'Apayao', 'Pudtol', 'Poblacion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pa$$w0rd!', 2025, NULL, NULL, NULL, NULL, 0, '9a3d458322d70046f63dfd8b0153ece4', NULL, NULL, 0, '2025-01-03 03:07:53', '2025-01-03 03:07:53', 0, NULL),
(1194, 1201, 'hadden', 'james', 'abarisia', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hadden@gmail.com', '123456789', 'Region VI (Western Visayas)', 'Negros Occidental', 'Bacolod City (Capital)', 'Vista Alegre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', 2025, NULL, NULL, NULL, NULL, 0, 'a42a596fc71e17828440030074d15e74', NULL, NULL, 0, '2025-01-10 07:40:24', '2025-01-10 07:40:24', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bs_page`
--

CREATE TABLE `bs_page` (
  `p_id` int(10) NOT NULL,
  `page` text DEFAULT NULL,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_page`
--

INSERT INTO `bs_page` (`p_id`, `page`, `is_deleted`) VALUES
(1, 'Profile', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bs_report`
--

CREATE TABLE `bs_report` (
  `report_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `page` varchar(50) NOT NULL,
  `is_deleted` int(10) UNSIGNED NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `bs_report`
--

INSERT INTO `bs_report` (`report_id`, `name`, `description`, `page`, `is_deleted`, `date_added`, `date_deleted`) VALUES
(1001, 'Student Log Report', 'Displays Student  Log Report', 'student_log_report', 1, '2015-07-28 02:51:10', '0000-00-00 00:00:00'),
(1013, 'Employee Log Report', 'Displays Employee Log Report', 'employee_log_report', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1014, 'Customer Report', 'Displays Customer Report', 'customer_report', 1, '2016-05-15 22:35:45', '0000-00-00 00:00:00'),
(1015, 'SO Report', 'Displays SO Report', 'so_report', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1016, 'Sales Graph', 'Displays sales graph', 'sales_graph', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1017, 'Accounts Receivable', 'Displays accounts receivable', 'ar_detail', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1018, 'Returned Product', 'Displays returned products', 'returned', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bs_review`
--

CREATE TABLE `bs_review` (
  `rev_id` int(11) NOT NULL,
  `s_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `date_added` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `added_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_modified` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_deleted` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bs_setting`
--

CREATE TABLE `bs_setting` (
  `setting_id` int(10) UNSIGNED NOT NULL,
  `directory` varchar(100) NOT NULL DEFAULT '',
  `admin_dir` varchar(70) NOT NULL,
  `system_title` varchar(100) NOT NULL DEFAULT '',
  `abrv` varchar(70) NOT NULL DEFAULT '',
  `year_developed` year(4) NOT NULL,
  `description` text NOT NULL,
  `developer` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_setting`
--

INSERT INTO `bs_setting` (`setting_id`, `directory`, `admin_dir`, `system_title`, `abrv`, `year_developed`, `description`, `developer`, `website`) VALUES
(1001, 'onehomeweb2app', 'onehomeweb2app/adminpanel', 'One Home', 'TO', '2024', '', 'Trident Technology', 'www.tridentechnology.com');

-- --------------------------------------------------------

--
-- Table structure for table `bs_time`
--

CREATE TABLE `bs_time` (
  `time_id` int(50) NOT NULL,
  `s_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `s_description` varchar(155) DEFAULT NULL,
  `time` varchar(155) DEFAULT NULL,
  `am_pm` varchar(155) DEFAULT NULL,
  `slots` varchar(155) DEFAULT NULL,
  `added_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_added` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_modified` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deleted_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_deleted` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `uid` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_time`
--

INSERT INTO `bs_time` (`time_id`, `s_id`, `user_id`, `s_description`, `time`, `am_pm`, `slots`, `added_by`, `date_added`, `modified_by`, `date_modified`, `deleted_by`, `date_deleted`, `is_deleted`, `uid`) VALUES
(41, 32, 1150, 'Kevin Hair Salon', '9:00', 'AM', '3', '1150', '2024-04-15 10:30:43', NULL, NULL, NULL, NULL, 0, '3416a75f4cea9109507cacd8e2f2aefc'),
(42, 32, 1150, 'Kevin Hair Salon', '10:00', 'AM', '5', '1150', '2024-04-15 10:31:53', NULL, NULL, NULL, NULL, 0, 'a1d0c6e83f027327d8461063f4ac58a6'),
(43, 32, 1150, 'Kevin Hair Salon', '11:00', 'AM', '5', '1150', '2024-04-15 10:31:59', NULL, NULL, NULL, NULL, 0, '17e62166fc8586dfa4d1bc0e1742c08b'),
(44, 32, 1150, 'Kevin Hair Salon', '12:00', 'PM', '5', '1150', '2024-04-15 10:32:03', '1150', '2024-04-15 10:33:23', NULL, NULL, 0, 'f7177163c833dff4b38fc8d2872f1ec6'),
(45, 32, 1150, 'Kevin Hair Salon', '1:00', 'PM', '5', '1150', '2024-04-15 10:32:12', NULL, NULL, NULL, NULL, 0, '6c8349cc7260ae62e3b1396831a8398f'),
(46, 32, 1150, 'Kevin Hair Salon', '2:00', 'PM', '5', '1150', '2024-04-15 10:32:27', NULL, NULL, NULL, NULL, 0, 'd9d4f495e875a2e075a1a4a6e1b9770f'),
(47, 32, 1150, 'Kevin Hair Salon', '3:00', 'PM', '5', '1150', '2024-04-15 10:32:36', NULL, NULL, NULL, NULL, 0, '67c6a1e7ce56d3d6fa748ab6d9af3fd7'),
(48, 32, 1150, 'Kevin Hair Salon', '4:00', 'PM', '5', '1150', '2024-04-15 10:32:42', NULL, NULL, NULL, NULL, 0, '642e92efb79421734881b53e1e1b18b6'),
(49, 32, 1150, 'Kevin Hair Salon', '5:00', 'PM', '5', '1150', '2024-04-15 10:32:47', NULL, NULL, NULL, NULL, 0, 'f457c545a9ded88f18ecee47145a72c0'),
(50, 32, 1150, 'Kevin Hair Salon', '6:00', 'PM', '5', '1150', '2024-04-15 10:32:54', NULL, NULL, NULL, NULL, 0, 'c0c7c76d30bd3dcaefc96f40275bdc0a'),
(51, 32, 1150, 'Kevin Hair Salon', '7:00', 'PM', '5', '1150', '2024-04-15 10:33:00', NULL, NULL, NULL, NULL, 0, '2838023a778dfaecdc212708f721b788'),
(52, 32, 1150, 'Kevin Hair Salon', '8:00', 'PM', '5', '1150', '2024-04-15 10:33:06', NULL, NULL, NULL, NULL, 0, '9a1158154dfa42caddbd0694a4e9bdc8'),
(53, 32, 1150, 'Kevin Hair Salon', '9:00', 'PM', '5', '1150', '2024-04-15 10:33:13', NULL, NULL, NULL, NULL, 0, 'd82c8d1619ad8176d665453cfb2e55f0'),
(58, 34, 1159, 'Oliver Nail Salon', '9:00', 'AM', '3', '1159', '2024-04-17 12:09:10', NULL, NULL, NULL, NULL, 0, '66f041e16a60928b05a7e228a89c3799'),
(59, 34, 1159, 'Oliver Nail Salon', '10:00', 'AM', '3', '1159', '2024-04-17 12:09:56', NULL, NULL, NULL, NULL, 0, '093f65e080a295f8076b1c5722a46aa2'),
(60, 34, 1159, 'Oliver Nail Salon', '11:00', 'AM', '3', '1159', '2024-04-17 12:10:05', NULL, NULL, NULL, NULL, 0, '072b030ba126b2f4b2374f342be9ed44'),
(61, 34, 1159, 'Oliver Nail Salon', '12:00', '', '3', '1159', '2024-04-17 12:10:18', '1159', '2024-04-17 12:11:28', '1159', '2024-04-17 12:11:42', 1, '7f39f8317fbdb1988ef4c628eba02591'),
(62, 34, 1159, 'Oliver Nail Salon', '12:00', 'PM', '3', '1159', '2024-04-17 12:11:54', NULL, NULL, NULL, NULL, 0, '44f683a84163b3523afe57c2e008bc8c');

-- --------------------------------------------------------

--
-- Table structure for table `bs_user`
--

CREATE TABLE `bs_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pos_id` int(25) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `pass_text` varchar(200) DEFAULT NULL,
  `email_verified_at` datetime(6) DEFAULT NULL,
  `verification_code` tinytext DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `contactno` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(200) DEFAULT NULL,
  `subDate` varchar(100) DEFAULT NULL,
  `is_sub` tinyint(1) DEFAULT 0,
  `sub_type` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `access_level` int(10) NOT NULL DEFAULT 0,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` int(10) NOT NULL DEFAULT 0,
  `date_modified` varchar(50) DEFAULT NULL,
  `modified_by` int(10) NOT NULL DEFAULT 0,
  `date_deleted` varchar(50) DEFAULT NULL,
  `deleted_by` int(10) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_logout` timestamp NOT NULL DEFAULT current_timestamp(),
  `uid` varchar(170) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_user`
--

INSERT INTO `bs_user` (`user_id`, `firstname`, `middlename`, `lastname`, `email`, `pos_id`, `username`, `password`, `pass_text`, `email_verified_at`, `verification_code`, `title`, `contactno`, `address`, `image`, `thumbnail`, `subDate`, `is_sub`, `sub_type`, `is_admin`, `access_level`, `date_added`, `added_by`, `date_modified`, `modified_by`, `date_deleted`, `deleted_by`, `is_deleted`, `is_active`, `last_login`, `last_logout`, `uid`) VALUES
(1002, 'Super Admin', 'ads', 'Super Admin', 'superadmin@gmail.com', 1, 'superadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '0000-00-00 00:00:00.000000', '247156', 'Senior Programmer', '123456789', 'Bacolod City', '2bba929d092056000351e51da78e23be.png', 'e1f178d18ad4c37117985eab2f05b32f.png', NULL, 0, 0, 1, 1, '2022-11-09 19:09:24', 0, '2024-10-21 15:27:46', 1002, NULL, 0, 0, 0, '2025-01-15 02:31:44', '2025-01-08 06:37:42', 'fba9d88164f3e2d9109ee770223212a0'),
(1003, 'Admin', '', 'Admin', 'admin@gmail.com', 0, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, '', '09876543210', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2bba929d092056000351e51da78e23be.png', 'e1f178d18ad4c37117985eab2f05b32f.png', NULL, 0, 0, 1, 1, '2023-07-27 14:50:24', 1002, '2024-04-10 17:59:47', 1177, '', 0, 0, 1, '2025-01-21 08:35:35', '2025-01-10 05:47:13', '8f1d43620bc6bb580df6e80b0dc05c48'),
(1150, 'Kevin', '', 'Cortez', 'cortez.kevin0914@gmail.com', 0, 'kevin', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '2024-04-10 09:48:45.000000', '247156', '', '0966546565', 'BC', 'ba31618c0c7e42267c3966dfb3d0ac45.png', 'e3bb7c05fb15255597bc80d61c86c4d0.png', '2025-01-15', 1, 0, 0, 1, '2024-03-08 09:44:14', 1002, '2024-12-10 09:53:05', 1003, '', 0, 0, 0, '2025-01-30 06:10:00', '2025-01-30 06:10:00', '2b38c2df6a49b97f706ec9148ce48d86'),
(1188, 'Errold', '', 'Calvo', 'Errold@gmail.com', 0, 'errold', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, '', '123', 'BC', 'd5a8278369550f3daa98864b30af7746.png', 'fa516964113604c9ecd05b311a254827.png', NULL, 0, 0, 0, 2, '2024-09-18 11:07:23', 1002, '2024-09-18 11:15:14', 1002, '', 0, 0, 0, '2025-01-30 01:46:05', '2025-01-30 01:46:05', 'c44e503833b64e9f27197a484f4257c0'),
(1189, 'Errold', '', 'Calvo', 'test@gmail.com', 0, 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, '', '123', 'BC', '0c703dd979603d22086cb8e79a6fb893.png', 'd6c09692fff54ca7af3c4ad702f94094.png', NULL, 0, 0, 0, 0, '2024-09-18 11:26:25', 1002, '2024-10-21 15:42:46', 1002, NULL, 0, 0, 1, '2024-10-21 07:42:46', '2024-09-18 03:26:25', '82c2559140b95ccda9c6ca4a8b981f1e'),
(1190, 'Benz', NULL, 'Lozada', 'benz@gmail.com', NULL, 'benz', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, NULL, '123456', 'talisay city', '0c21da512930f6c4a0ff08ded307a943.png', 'ae4a65946e0548851aaa1cf4f53964fa.png', '', 0, 1, 0, 0, '2024-12-12 15:29:19', 1150, '2025-01-20 10:00:29', 1190, NULL, 0, 0, 1, '2025-01-30 06:10:05', '2025-01-29 11:59:26', '160c88652d47d0be60bfbfed25111412'),
(1192, 'Abel', 'Daphne Preston', 'Hoover', 'qigehudo@mailinator.com', NULL, 'qigehudo@mailinator.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, '+1 (857) 174-1493', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-02 08:06:44', '2025-01-02 08:06:44', '52292e0c763fd027c6eba6b8f494d2eb'),
(1193, 'Ronald', 'Pagran', 'Tangguan', 'Ronald@gmail.com', NULL, 'Ronald@gmail.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL, '123456789', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 03:05:26', '2025-01-03 03:05:26', '9a3d458322d70046f63dfd8b0153ece4'),
(1194, 'Allistair', 'Porter Figueroa', 'Russo', 'sutod@mailinator.com', NULL, 'sutod@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (608) 631-8449', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 03:07:28', '2025-01-03 03:07:28', 'a42a596fc71e17828440030074d15e74'),
(1195, 'Allistair', 'Porter Figueroa', 'Russo', 'sutod123@mailinator.com', NULL, 'sutod123@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (608) 631-8449', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 03:07:53', '2025-01-03 03:07:53', '0188e8b8b014829e2fa0f430f0a95961'),
(1196, 'Patricia', 'Gage Ashley', 'Levine', 'hewomibe@mailinator.com', NULL, 'hewomibe@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (689) 575-8136', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 03:08:46', '2025-01-03 03:08:46', '9adeb82fffb5444e81fa0ce8ad8afe7a'),
(1197, 'Bell', NULL, NULL, 'cosucu@mailinator.com', NULL, 'cosucu@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (503) 607-9547', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 06:25:40', '2025-01-03 06:25:40', 'ae5e3ce40e0404a45ecacaaf05e5f735'),
(1198, 'Myles', NULL, NULL, 'vynyki@mailinator.com', NULL, 'vynyki@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (461) 771-8908', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 06:26:06', '2025-01-03 06:26:06', 'c54e7837e0cd0ced286cb5995327d1ab'),
(1199, 'Trident', NULL, NULL, 'trident@mail.com', NULL, 'trident@mail.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL, '12345689', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 06:34:19', '2025-01-03 06:34:19', '4d2e7bd33c475784381a64e43e50922f'),
(1200, 'Wynter', NULL, NULL, 'kuberabola123@mailinator.com', NULL, 'kuberabola123@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (823) 142-1197', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-03 06:37:28', '2025-01-03 06:37:28', 'fe2d010308a6b3799a3d9c728ee74244'),
(1201, 'hadden', 'james', 'abarisia', 'hadden@gmail.com', NULL, 'hadden@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, '123456789', NULL, NULL, NULL, '2025-01-15', 1, 1, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, '2025-01-15 02:40:41', '2025-01-10 08:05:57', '7501e5d4da87ac39d782741cd794002d');

-- --------------------------------------------------------

--
-- Table structure for table `ind_maincat`
--

CREATE TABLE `ind_maincat` (
  `sercatid` int(100) NOT NULL,
  `main_cat` varchar(80) DEFAULT NULL,
  `descript` varchar(80) DEFAULT NULL,
  `thumbnail` varchar(80) DEFAULT NULL,
  `image` varchar(80) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `is_archive` int(1) DEFAULT 0,
  `uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='sub category for independent service provider';

--
-- Dumping data for table `ind_maincat`
--

INSERT INTO `ind_maincat` (`sercatid`, `main_cat`, `descript`, `thumbnail`, `image`, `is_deleted`, `is_archive`, `uid`) VALUES
(1, 'Plumbing', 'Covers pipe repair, leak detection, faucet and toilet repairs, water heater main', NULL, NULL, 0, 0, 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'Electrical', 'Includes wiring, lighting fixtures, circuit breakers, and appliance repairs.', NULL, NULL, 0, 0, 'c81e728d9d4c2f636f067f89cc14862c'),
(3, 'Carpentry', 'For door, window, furniture, and cabinet repairs or installations.', NULL, NULL, 0, 0, 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
(4, 'HVAC (Heating, Ventilation, and Air Conditioning)', 'Involves air conditioner, heater, and ventilation system maintenance and repair.', NULL, NULL, 0, 0, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 'Roofing', 'Covers roof leaks, shingle replacement, and gutter cleaning or repairs.', NULL, NULL, 0, 0, 'e4da3b7fbbce2345d7772b0674a318d5'),
(6, 'Masonry', 'Encompasses concrete, brick, and tile repairs.', NULL, NULL, 0, 0, '1679091c5a880faf6fb5e6087eb1b2dc'),
(7, 'Painting', 'Includes interior and exterior wall painting, touch-ups, and decorative painting', NULL, NULL, 0, 0, '8f14e45fceea167a5a36dedd4bea2543'),
(8, 'Flooring', 'Covers tile, hardwood, carpet repair, and installations.', NULL, NULL, 0, 0, 'c9f0f895fb98ab9159f51fd0297e236d'),
(9, 'General Handyman Services', 'For minor repairs like fixing hinges, mounting shelves, and basic installations.', NULL, NULL, 0, 0, '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(10, 'Window and Glass Repair', 'Includes glass replacement and window frame repairs.', NULL, NULL, 0, 0, 'd3d9446802a44259755d38e6d163e820'),
(11, 'Outdoor Repairs', 'Covers fence repair, deck/patio maintenance, and irrigation systems.', NULL, NULL, 0, 0, '6512bd43d9caa6e02c990b0a82652dca'),
(12, 'Appliance Repair', 'For kitchen and laundry appliances, small electronics, and more.', NULL, NULL, 0, 0, 'c20ad4d76fe97759aa27a0c99bff6710'),
(13, 'Emergency Repairs', 'For urgent issues like burst pipes, electrical shorts, and storm damage.', NULL, NULL, 0, 0, 'c51ce410c124a10e0db5e4b97fc2af39'),
(14, 'Others', 'Other than General repairs', NULL, NULL, 0, 0, 'aab3238922bcc25a6f606eb525ffdc56');

-- --------------------------------------------------------

--
-- Table structure for table `ind_subcat`
--

CREATE TABLE `ind_subcat` (
  `subcatid` int(100) NOT NULL,
  `main_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `sub_categor` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `date_modified` varchar(50) DEFAULT NULL,
  `date_deleted` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='main category of independent service provider';

--
-- Dumping data for table `ind_subcat`
--

INSERT INTO `ind_subcat` (`subcatid`, `main_id`, `user_id`, `sub_categor`, `description`, `added_by`, `modified_by`, `deleted_by`, `date_added`, `date_modified`, `date_deleted`, `is_deleted`) VALUES
(4, '1', '1150', 'Cover Pipe Repairs', NULL, 1150, 1150, NULL, '2024-12-13 14:19:20', '2024-12-16 10:49:06', NULL, 0),
(5, '6', '1150', 'Tile Repair', NULL, 1150, 1150, NULL, '2024-12-13 14:19:20', '2024-12-16 10:49:06', NULL, 0),
(6, '2', '1150', 'Wiring', NULL, 1150, 1150, NULL, '2024-12-13 14:46:57', '2024-12-16 10:49:06', NULL, 0),
(7, '1', '1150', 'Leak Detections', NULL, 1150, 1150, NULL, '2024-12-13 14:51:18', '2024-12-16 10:49:06', NULL, 0),
(8, '2', '1150', 'Circuit Breaker', NULL, 1150, 1150, NULL, '2024-12-13 14:51:18', '2024-12-16 10:49:06', NULL, 0),
(9, '6', '1150', 'Concrete and Bricks', NULL, 1150, 1150, NULL, '2024-12-13 14:51:18', '2024-12-16 10:49:06', NULL, 0),
(10, '11', '1188', 'Cover Fences Repair', NULL, 1188, 1188, 1188, '2024-12-27 10:04:09', '2024-12-27 10:05:19', '2024-12-27 10:12:07', 1),
(11, '13', '1188', 'Burst Pipe or Electrical short', NULL, 1188, 1188, NULL, '2024-12-27 10:04:09', '2024-12-27 10:05:19', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `in_affiliate`
--

CREATE TABLE `in_affiliate` (
  `aid` int(55) NOT NULL,
  `inid` int(55) DEFAULT NULL,
  `members` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `in_affiliate`
--

INSERT INTO `in_affiliate` (`aid`, `inid`, `members`, `is_deleted`) VALUES
(1, 3, 'Veritatis non corrup', 0),
(2, 3, 'Lorem Ipsum ', 0),
(3, 3, 'Lorem Ipsum 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `in_awrec`
--

CREATE TABLE `in_awrec` (
  `arid` int(55) NOT NULL,
  `inid` int(55) DEFAULT NULL,
  `award` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_client`
--

CREATE TABLE `in_client` (
  `clid` int(55) NOT NULL,
  `inid` int(55) DEFAULT NULL,
  `client` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_cliref`
--

CREATE TABLE `in_cliref` (
  `crid` int(55) NOT NULL,
  `inid` int(55) DEFAULT NULL,
  `cliref` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_seroff`
--

CREATE TABLE `in_seroff` (
  `spid` int(55) NOT NULL,
  `inid` int(55) DEFAULT NULL,
  `seroff` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_serprod`
--

CREATE TABLE `in_serprod` (
  `spid` int(55) NOT NULL,
  `inid` int(55) DEFAULT NULL,
  `serprod` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_balance`
--

CREATE TABLE `tbl_balance` (
  `bal_id` int(100) NOT NULL,
  `userId` int(60) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_balance`
--

INSERT INTO `tbl_balance` (`bal_id`, `userId`, `balance`) VALUES
(1, 1190, 300.00);

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
  `bookings_thumbnail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`booking_id`, `user_id`, `service_id`, `requested_service`, `booking_address`, `contact_num`, `booking_status`, `created_at`, `updated_at`, `bookings_image`, `bookings_thumbnail`) VALUES
(1, 1190, 0, ' Cover Pipe Repairs ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '1', '', NULL, NULL, NULL, NULL),
(2, 1190, 0, ' Tile Repair ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '2', '', NULL, NULL, NULL, NULL),
(5, 1190, 0, ' Cover Pipe Repairs ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '40405404', NULL, NULL, NULL, NULL, NULL),
(58, 1190, 0, ' Wiring ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '546678', 'pending', NULL, NULL, NULL, NULL),
(59, 1190, 0, ' Tile Repair ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '56767', 'pending', NULL, NULL, NULL, NULL),
(60, 1190, 0, ' Tile Repair ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '5455', 'pending', NULL, NULL, NULL, NULL),
(61, 1190, 0, ' Circuit Breaker ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '545', 'accepted', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comadd`
--

CREATE TABLE `tbl_comadd` (
  `ca_id` int(100) NOT NULL,
  `cregion` varchar(55) DEFAULT NULL,
  `cprovince` varchar(55) DEFAULT NULL,
  `ccity` varchar(55) DEFAULT NULL,
  `cbarangay` varchar(55) DEFAULT NULL,
  `czip` varchar(55) DEFAULT NULL,
  `csubvil` varchar(55) DEFAULT NULL,
  `cstreet` varchar(55) DEFAULT NULL,
  `cunit` varchar(55) DEFAULT NULL,
  `cbname` varchar(55) DEFAULT NULL COMMENT 'building name',
  `cphase` varchar(55) DEFAULT NULL,
  `cbandl` varchar(55) DEFAULT NULL,
  `date_added` varchar(55) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `com_id` int(55) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `bname` varchar(100) DEFAULT NULL,
  `emailadd` varchar(50) DEFAULT NULL,
  `connum` text DEFAULT NULL,
  `in_region` varchar(50) DEFAULT NULL,
  `in_prov` varchar(50) DEFAULT NULL,
  `in_city` varchar(50) DEFAULT NULL,
  `in_barangay` varchar(50) DEFAULT NULL,
  `zipc` text DEFAULT NULL,
  `in_subdi` varchar(50) DEFAULT NULL,
  `str` varchar(50) DEFAULT NULL,
  `in_unit` varchar(50) DEFAULT NULL,
  `in_build` varchar(50) DEFAULT NULL,
  `phase` varchar(50) DEFAULT NULL,
  `blocklot` varchar(50) DEFAULT NULL,
  `credref` varchar(100) DEFAULT NULL,
  `bank` varchar(60) DEFAULT NULL,
  `branch` varchar(60) DEFAULT NULL,
  `accname` varchar(60) DEFAULT NULL,
  `accno` varchar(60) DEFAULT NULL,
  `conperna` varchar(100) DEFAULT NULL COMMENT 'contact name',
  `conperpos` varchar(100) DEFAULT NULL COMMENT 'contact position',
  `webUrl` varchar(100) DEFAULT NULL,
  `comRegNo` varchar(100) DEFAULT NULL,
  `tin` varchar(100) DEFAULT NULL,
  `dateEstab` varchar(100) DEFAULT NULL,
  `yrOpera` text DEFAULT NULL,
  `numEmp` text DEFAULT NULL,
  `dti` text DEFAULT NULL,
  `mayorper` text DEFAULT NULL,
  `cor` text DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` varchar(50) DEFAULT NULL,
  `date_deleted` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`com_id`, `user_id`, `bname`, `emailadd`, `connum`, `in_region`, `in_prov`, `in_city`, `in_barangay`, `zipc`, `in_subdi`, `str`, `in_unit`, `in_build`, `phase`, `blocklot`, `credref`, `bank`, `branch`, `accname`, `accno`, `conperna`, `conperpos`, `webUrl`, `comRegNo`, `tin`, `dateEstab`, `yrOpera`, `numEmp`, `dti`, `mayorper`, `cor`, `date_added`, `added_by`, `date_deleted`, `deleted_by`, `is_deleted`, `uid`) VALUES
(2, 1188, 'Errold', 'kiqat@mailinator.com', '528', 'Region X (Northern Mindanao)', 'Bukidnon', 'Cabanglasan', 'Capinonan', '16951', 'Non dolorem iusto co', 'Thomas Reilly', 'Qui nostrum sunt pos', 'Leila Cabrera', 'Enim reprehenderit', 'Est et vel unde est', '1234', 'China Bank', 'Lacson St.', 'Errold', '1234567', 'TEST', 'MANAGER', NULL, NULL, '', NULL, NULL, NULL, '1234567890', '0987654321', '456321789', '2024-10-17', NULL, '2024-10-18 11:19:58', '1002', 1, 'c81e728d9d4c2f636f067f89cc14862c'),
(4, NULL, '', 'hybyqirex@mailinator.com', '754', '', '', '', '', '21620', 'Quas deserunt perfer', 'Grant Welch', 'Magnam ratione repel', 'Cecilia Murphy', 'Sapiente sit ut mol', 'Et molestiae iure la', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17', NULL, '2024-10-17 15:13:58', '1002', 1, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 1199, 'Trident', 'trident@mail.com', '12345689', 'Region VI (Western Visayas)', 'Negros Occidental', 'Bacolod City (Capital)', 'Banago', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456789', '2025-01-03', NULL, NULL, 0, 'e4da3b7fbbce2345d7772b0674a318d5'),
(6, 1200, 'Wynter', 'kuberabola123@mailinator.com', '+1 (823) 142-1197', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Santa Cruz', 'Barangay 317', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pa$$w0rd!', '2025-01-03', NULL, NULL, 0, '1679091c5a880faf6fb5e6087eb1b2dc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter`
--

CREATE TABLE `tbl_counter` (
  `id` int(11) NOT NULL,
  `counter` int(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_counter`
--

INSERT INTO `tbl_counter` (`id`, `counter`) VALUES
(1, 1969);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedId` int(60) NOT NULL,
  `userId` int(70) DEFAULT NULL,
  `feedback_com` text DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedId`, `userId`, `feedback_com`, `date_added`, `is_deleted`) VALUES
(1, 1190, 'test feedback', '2025-01-22 11:49:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_independent`
--

CREATE TABLE `tbl_independent` (
  `in_id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `emailadd` varchar(50) DEFAULT NULL,
  `connum` text DEFAULT NULL,
  `in_region` varchar(50) DEFAULT NULL,
  `in_prov` varchar(50) DEFAULT NULL,
  `in_city` varchar(50) DEFAULT NULL,
  `in_barangay` varchar(50) DEFAULT NULL,
  `zipc` text DEFAULT NULL,
  `in_subdi` varchar(50) DEFAULT NULL,
  `str` varchar(50) DEFAULT NULL,
  `in_unit` varchar(50) DEFAULT NULL,
  `in_build` varchar(50) DEFAULT NULL,
  `phase` varchar(50) DEFAULT NULL,
  `blocklot` varchar(50) DEFAULT NULL,
  `b_address` int(100) DEFAULT NULL,
  `tin` tinytext DEFAULT NULL,
  `dti` tinytext DEFAULT NULL,
  `mayorper` tinytext DEFAULT NULL,
  `cor` tinytext DEFAULT NULL,
  `affiliate` int(40) DEFAULT NULL,
  `aandr` int(40) DEFAULT NULL,
  `serprod` varchar(50) DEFAULT NULL,
  `geographl` int(10) DEFAULT NULL,
  `geographv` int(10) DEFAULT NULL,
  `geographm` int(10) DEFAULT NULL,
  `assess` tinytext DEFAULT NULL,
  `kmmain` tinytext DEFAULT NULL,
  `desserprod` int(45) DEFAULT NULL,
  `seroffered` int(45) DEFAULT NULL,
  `liabilityinno` varchar(40) DEFAULT NULL,
  `liabilityin` int(10) DEFAULT NULL,
  `credref` int(45) DEFAULT NULL,
  `bank` varchar(50) NOT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `accname` varchar(50) DEFAULT NULL,
  `accno` text DEFAULT NULL,
  `liabityin` int(10) DEFAULT NULL,
  `compenin` int(10) DEFAULT NULL,
  `indemin` int(10) DEFAULT NULL,
  `liabilityinsu` varchar(40) DEFAULT NULL,
  `indeminno` varchar(40) DEFAULT NULL,
  `compeninno` varchar(40) DEFAULT NULL,
  `compeninsu` varchar(40) DEFAULT NULL,
  `indeminsu` varchar(40) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `clientref` int(11) DEFAULT NULL,
  `waiver` varchar(50) DEFAULT NULL,
  `agree` varchar(50) DEFAULT NULL,
  `date_added` varchar(30) DEFAULT NULL,
  `added_by` varchar(30) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `date_deleted` varchar(30) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_independent`
--

INSERT INTO `tbl_independent` (`in_id`, `user_id`, `fname`, `mname`, `lname`, `suffix`, `emailadd`, `connum`, `in_region`, `in_prov`, `in_city`, `in_barangay`, `zipc`, `in_subdi`, `str`, `in_unit`, `in_build`, `phase`, `blocklot`, `b_address`, `tin`, `dti`, `mayorper`, `cor`, `affiliate`, `aandr`, `serprod`, `geographl`, `geographv`, `geographm`, `assess`, `kmmain`, `desserprod`, `seroffered`, `liabilityinno`, `liabilityin`, `credref`, `bank`, `branch`, `accname`, `accno`, `liabityin`, `compenin`, `indemin`, `liabilityinsu`, `indeminno`, `compeninno`, `compeninsu`, `indeminsu`, `client`, `clientref`, `waiver`, `agree`, `date_added`, `added_by`, `deleted_by`, `date_deleted`, `is_deleted`, `uid`) VALUES
(2, 1150, 'Kevin', 'Broce', 'Cortez', '', 'cortez@gmail.com', '09123456789', 'Region X (Northern Mindanao)', 'Bukidnon', 'Cabanglasan', 'Capinonan', '16951', 'Non dolorem iusto co', 'Thomas Reilly', 'Qui nostrum sunt pos', 'Leila Cabrera', 'Enim reprehenderit', 'Est et vel unde est', NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PNB', 'Bata', 'kevin', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17', NULL, '', '', 0, 'c81e728d9d4c2f636f067f89cc14862c'),
(4, NULL, 'Ronald', 'Pagran', 'Tangguan', '', 'Ronald@gmail.com', '123456789', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Talisay', 'Zone 4 (Pob.)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456789', '2025-01-03', NULL, NULL, 0, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 1196, 'Patricia', 'Gage Ashley', 'Levine', 'Et tempor aut ex rei', 'hewomibe@mailinator.com', '+1 (689) 575-8136', 'Cordillera Administrative Region (CAR)', 'Mountain Province', 'Sadanga', 'Sacasacan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pa$$w0rd!', '2025-01-03', NULL, NULL, 0, 'e4da3b7fbbce2345d7772b0674a318d5');

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
(4, 1190, 0, 'Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', 'tayabas elementary school', '122.96499678134596', '10.731925740507005', 0, 0, '2024-12-23 11:15:02', 1190, 1190, '2025-01-29 17:37:12', '2025-02-03 09:58:03', 1190, 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 1190, 0, 'Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116,', 'INC CHURCH', '123.08576961259686', '10.755646854590262', 0, 1, '2024-12-23 16:02:11', 1190, 1190, '2025-01-29 19:58:00', '2025-02-03 09:59:23', 1190, 'e4da3b7fbbce2345d7772b0674a318d5'),
(6, 1188, 1, 'Lacson Street, Santo Domingo, Banago, Bacolod-1, Bacolod, Negros Island Region, 6115, Philippines', 'Country mart', '122.96199268541365', '10.699899940932056', 0, 1, '2024-12-27 09:49:59', 1188, 1188, '2025-01-29 20:10:01', '2024-12-27 09:54:26', 1188, '1679091c5a880faf6fb5e6087eb1b2dc'),
(9, 1190, 0, 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', 'ayala north point', '122.96311080404882', '10.722396873835189', 0, 1, '2025-01-29 14:59:02', 1190, NULL, NULL, '2025-02-03 09:56:10', 1190, '45c48cce2e2d7fbdea1afc51c7c6ad26'),
(10, 1150, 0, '18th Street, Sibuyas, Lacson Tourism Strip, Bacolod-1, Bacolod, Negros Island Region, 6100, Philippines', 'starbucks', '122.9557825', '10.6813544', 0, 0, '2025-01-29 19:53:28', 1150, NULL, NULL, NULL, NULL, 'd3d9446802a44259755d38e6d163e820'),
(11, 1188, 0, 'Jollibee, F. Cabahug Street, Panagdait, Cebu City, Central Visayas, 6000, Philippines', 'test and sample landmark', '123.9187456', '10.3251968', 0, 0, '2025-01-29 20:07:13', 1188, NULL, NULL, NULL, NULL, '6512bd43d9caa6e02c990b0a82652dca');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_management`
--

CREATE TABLE `tbl_management` (
  `manageId` int(55) NOT NULL,
  `contactNum` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `last_modified` varchar(55) DEFAULT NULL,
  `modified_by` varchar(55) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_management`
--

INSERT INTO `tbl_management` (`manageId`, `contactNum`, `is_deleted`, `last_modified`, `modified_by`, `uid`) VALUES
(1, '09123456789', 0, '2025-01-21 15:24:03', '1003', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `n_id` int(11) NOT NULL,
  `notification_type` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `other_id` int(50) NOT NULL DEFAULT 0,
  `misc_id` int(50) NOT NULL DEFAULT 0,
  `notification_message` text DEFAULT NULL,
  `notification_icon` text DEFAULT NULL,
  `notification_bg` text DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `is_done` int(1) NOT NULL DEFAULT 0,
  `date_created` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`n_id`, `notification_type`, `user_id`, `other_id`, `misc_id`, `notification_message`, `notification_icon`, `notification_bg`, `is_read`, `is_done`, `date_created`) VALUES
(14, 'success', 1150, 0, 0, 'Subscription request approved', 'success', 'bg-success', 1, 0, '2025-01-19 14:50:03'),
(15, 'error', 1150, 0, 0, 'Subscription request failed. Please Try again.', 'error', 'bg-error', 1, 0, '2025-01-18 14:50:03'),
(16, 'task', 1150, 0, 0, 'Client Notification - Job Order', 'primary', 'bg-primary', 1, 0, '2025-01-17 14:50:03'),
(17, 'info', 1150, 0, 0, 'Notify Test', 'info', 'bg-info', 1, 0, '2025-01-19 14:50:03'),
(100, 'success', 1002, 0, 1679091, 'Your Cash In has been confirmed. Thank you.', 'success', NULL, 0, 0, '2025-01-20 00:12:42'),
(102, 'info', 0, 0, 10, 'User has topped up 100 for reference number 123', 'info', NULL, 0, 0, '2025-01-20 00:26:19'),
(103, 'info', 0, 0, 11, 'User has topped up 300 for reference number 123213', 'info', NULL, 0, 0, '2025-01-20 00:26:45'),
(104, 'success', 1190, 0, 0, 'Your Cash In has been confirmed. Thank you.', 'success', NULL, 1, 0, '2025-01-20 00:29:21'),
(105, 'info', 0, 0, 10, 'User has subscribed', 'info', NULL, 0, 0, '2025-01-20 00:36:15'),
(107, 'info', 0, 0, 11, 'User has subscribed', 'info', NULL, 0, 0, '2025-01-20 00:44:29'),
(108, 'success', 1190, 0, 6512, 'Your Subscription has been approved.', 'success', NULL, 1, 0, '2025-01-20 00:48:11'),
(109, 'info', 0, 0, 12, 'User has topped up 500', 'info', NULL, 0, 0, '2025-01-21 15:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `posid` int(55) NOT NULL,
  `posname` varchar(50) DEFAULT NULL,
  `descript` varchar(50) DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` int(50) DEFAULT NULL,
  `date_modified` varchar(50) DEFAULT NULL,
  `modified_by` int(50) DEFAULT NULL,
  `date_deleted` varchar(50) DEFAULT NULL,
  `deleted_by` int(50) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`posid`, `posname`, `descript`, `date_added`, `added_by`, `date_modified`, `modified_by`, `date_deleted`, `deleted_by`, `uid`, `is_deleted`) VALUES
(1, 'CEO', 'Chief Executive Officer', '2024-10-21 10:36:26', 1002, '', 0, '', 0, 'c4ca4238a0b923820dcc509a6f75849b', 0),
(2, 'Admin Assistant', 'Assisting the CEO', '2024-10-21 14:38:06', 1002, NULL, NULL, NULL, NULL, 'c81e728d9d4c2f636f067f89cc14862c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `subid` int(100) NOT NULL,
  `userId` int(100) DEFAULT NULL,
  `subType` int(1) DEFAULT NULL,
  `refNo` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `sub_date` varchar(50) DEFAULT NULL,
  `sub_by` int(55) DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` int(50) DEFAULT NULL,
  `date_modified` varchar(50) DEFAULT NULL,
  `modified_by` int(50) DEFAULT NULL,
  `approve_by` int(50) DEFAULT NULL,
  `uid` varchar(70) DEFAULT NULL,
  `is_done` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`subid`, `userId`, `subType`, `refNo`, `thumbnail`, `image`, `sub_date`, `sub_by`, `date_added`, `added_by`, `date_modified`, `modified_by`, `approve_by`, `uid`, `is_done`) VALUES
(5, 1150, 0, '1234', '6276657a11b3fa9133a44ad83cb5d036.png', '3bf20f7aec98d9d0bb0f887a39136eb1.png', '2025-01-15', 1003, '2025-01-10 14:08:58', 1150, NULL, NULL, NULL, 'e4da3b7fbbce2345d7772b0674a318d5', 1),
(7, 1201, 1, '1234', '6799d69086508aa6aba5dd9303dc8f58.jpg', '8fdb1774f4c3f9d704a348fdb2ea6907.jpg', '2025-01-15', 1003, '2025-01-10 15:42:34', 1201, NULL, NULL, NULL, '8f14e45fceea167a5a36dedd4bea2543', 1),
(8, 1201, 1, '1234', '7f2020685ea776e5cba119182563696c.png', '477401777204e0cdd5a9d831b56254c8.png', '2025-01-13', 1003, '2025-01-10 15:44:50', 1201, NULL, NULL, NULL, 'c9f0f895fb98ab9159f51fd0297e236d', 1),
(11, 1190, 1, '123', '11c03d1b8e979ab66d8f3627207084e9.png', 'fdb166d70c84e81bf85f0cad5269bb71.png', '2025-01-20', 1002, '2025-01-20 00:44:29', 1190, NULL, NULL, NULL, '6512bd43d9caa6e02c990b0a82652dca', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topup`
--

CREATE TABLE `tbl_topup` (
  `cashId` int(100) NOT NULL,
  `userId` int(100) DEFAULT NULL,
  `pay_amount` decimal(9,2) DEFAULT NULL,
  `refNo` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(110) DEFAULT NULL,
  `image` varchar(110) DEFAULT NULL,
  `date_added` varchar(110) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `date_deleted` varchar(110) DEFAULT NULL,
  `deleted_by` int(100) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_done` tinyint(1) DEFAULT 0,
  `approved_by` int(60) DEFAULT NULL,
  `date_approve` varchar(50) DEFAULT NULL,
  `uid` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_topup`
--

INSERT INTO `tbl_topup` (`cashId`, `userId`, `pay_amount`, `refNo`, `thumbnail`, `image`, `date_added`, `added_by`, `date_deleted`, `deleted_by`, `is_deleted`, `is_done`, `approved_by`, `date_approve`, `uid`) VALUES
(3, 1190, 100.00, '123123', 'a18c5e570e75b9822abdd36881dce0a9.png', '9bd8305ee121ec2c6d530c210bd0930f.png', '2025-01-16 10:59:56', '1190', NULL, NULL, 0, 1, 1003, '2025-01-16', 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
(6, 1190, 100.00, '1234abc', '0d432508851141fa19296a90cbfa18c3.png', '9fad58475e248d10e302dec3b0f6b047.png', '2025-01-20 00:08:04', '1190', NULL, NULL, 0, 1, 1002, '2025-01-20', '1679091c5a880faf6fb5e6087eb1b2dc'),
(10, 1190, 100.00, '123', '97f6ee6fbf6c0ceeeab9fc0ef54d16fa.png', '4333045421c75a0f8506f33ae1bb58d9.png', '2025-01-20 00:26:19', '1190', NULL, NULL, 0, 1, 1002, '2025-01-20', 'd3d9446802a44259755d38e6d163e820'),
(11, 1190, 300.00, '123213', '59670f6c64dc604d9c0a519f89b29de8.png', 'c9e98aa2b0051d46d3a51829bfb9c904.png', '2025-01-20 00:26:45', '1190', NULL, NULL, 0, 0, NULL, NULL, '6512bd43d9caa6e02c990b0a82652dca'),
(12, 1190, 500.00, NULL, 'c751f1611a2f3759f1fe011c07f4225c.png', 'ff11e6227ac6177f78298a1817e6cbc2.png', '2025-01-21 15:55:19', '1190', NULL, NULL, 0, 0, NULL, NULL, 'c20ad4d76fe97759aa27a0c99bff6710');

-- --------------------------------------------------------

--
-- Table structure for table `tr_log`
--

CREATE TABLE `tr_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `module` varchar(70) DEFAULT NULL,
  `action` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `action_by` varchar(50) NOT NULL DEFAULT '0',
  `log_action_date` varchar(50) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_log`
--

INSERT INTO `tr_log` (`id`, `module`, `action`, `description`, `action_by`, `log_action_date`) VALUES
(1, 'User', 'Add New', 'First Name: Sample <br /> Last Name: Sample <br /> Username: sample <br /> Contact Number:  <br /> Card Number: 123', '1002', '2023-06-06 09:44:24'),
(2, 'Card', 'Add New', 'Card holder: John Doe  <br /> Card Number: 321 <br /> Diesel Peso Discount: 1 <br /> Premium Peso Discount: 1 <br /> Unleaded Peso Discount: 1', '1002', '2023-06-06 09:44:45'),
(3, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 09:44:54'),
(4, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:10:00'),
(5, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:10:30'),
(6, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:12:34'),
(7, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:13:22'),
(8, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:19:20'),
(9, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:19:52'),
(10, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:21:59'),
(11, 'Transaction', 'Add', 'Invoice Number: 060623-094450 <br /> Product Name: Premium <br /> Price: 70.20 <br /> Amount: 100 <br /> Card holder: John Doe  <br /> Card Number: 321 <br /> Card Discount: 1.00 <br /> Points: 1.42 <br /> User: Sample, Sample', '1002', '2023-06-06 16:24:51'),
(12, 'User', 'User Added', 'First Name: Ainsley<br /> Middle Name: Fatima Mckenzie<br /> Last Name: Rasmussen<br /> Contact Number: 442<br /> Address: Voluptate sed dolori', '1002', '2024-03-01 09:46:57'),
(13, 'User', 'User Deleted', 'First Name: Guy<br /> Middle Name: <br /> Last Name: Charles<br /> Contact Number: Est nihil quibusdam <br /> Address: Aute ullam quia est', '1002', '2024-03-04 09:57:39'),
(14, 'User', 'User Modified', 'First Name: Imogene<br /> Middle Name: Frost<br /> Last Name: Barron<br /> Contact Number: 42<br /> Address: Talisay', '1002', '2024-03-04 10:46:39'),
(15, 'User', 'User Modified', 'First Name: Imogene<br /> Middle Name: Frost<br /> Last Name: Barron<br /> Contact Number: 42<br /> Address: Talisay', '1002', '2024-03-04 10:46:53'),
(16, 'User', 'User Modified', 'First Name: Imogene<br /> Middle Name: Frost<br /> Last Name: Barron<br /> Contact Number: 42<br /> Address: Talisay', '1002', '2024-03-04 11:05:07'),
(17, 'User', 'User Modified', 'First Name: Salvador<br /> Middle Name: Sydney Gilliam<br /> Last Name: Cline<br /> Contact Number: 470<br /> Address: Laboris et ut omnis ', '1002', '2024-03-04 11:06:24'),
(18, 'User', 'User Modified', 'First Name: Imogene<br /> Middle Name: <br /> Last Name: Barron<br /> Contact Number: 42<br /> Address: Talisay', '1002', '2024-03-04 12:27:09'),
(19, 'User', 'User Modified', 'First Name: Cailin<br /> Middle Name: <br /> Last Name: Berry<br /> Contact Number: Iste cupidatat sed o<br /> Address: Doloribus est cupidi', '1002', '2024-03-04 12:27:41'),
(20, 'User', 'User Added', 'First Name: Malik<br /> Middle Name: <br /> Last Name: Salas<br /> Contact Number: 185<br /> Address: Nobis voluptas est ', '1002', '2024-03-04 12:31:37'),
(21, 'User', 'User Added', 'First Name: Ayanna<br /> Middle Name: <br /> Last Name: Cook<br /> Contact Number: 736<br /> Address: Tenetur rerum animi', '1002', '2024-03-04 12:37:24'),
(22, 'User', 'User Added', 'First Name: Hoyt<br /> Middle Name: <br /> Last Name: Mcguire<br /> Contact Number: 765<br /> Address: Dolore facilis aperi', '1002', '2024-03-04 12:40:26'),
(23, 'User', 'User Added', 'First Name: Leigh<br /> Middle Name: <br /> Last Name: Moody<br /> Contact Number: 924<br /> Address: Quam non nulla eu ve', '1002', '2024-03-04 12:45:27'),
(24, 'User', 'User Modified', 'First Name: Imogene<br /> Middle Name: <br /> Last Name: Barron<br /> Contact Number: 42<br /> Address: Talisay', '1002', '2024-03-04 12:47:35'),
(25, 'User', 'User Deleted', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-03-07 10:40:13'),
(26, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> c_email: <br /> c_contact: <br /> c_address: ', '1002', '2024-03-07 10:46:09'),
(27, 'User', 'User Added', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 096225656566<br /> Address: BC', '1002', '2024-03-08 09:42:51'),
(28, 'User', 'User Added', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: TC', '1002', '2024-03-08 09:44:14'),
(29, 'User', 'User Deleted', 'First Name: Imogene<br /> Middle Name: <br /> Last Name: Barron<br /> Contact Number: 42<br /> Address: Talisay', '1002', '2024-03-08 15:30:33'),
(30, 'User', 'User Deleted', 'First Name: Cailin<br /> Middle Name: <br /> Last Name: Berry<br /> Contact Number: Iste cupidatat sed o<br /> Address: Doloribus est cupidi', '1002', '2024-03-08 15:30:35'),
(31, 'User', 'User Deleted', 'First Name: Jerome<br /> Middle Name: Gentry<br /> Last Name: Burke<br /> Contact Number: 68<br /> Address: Natus magni laudanti', '1002', '2024-03-08 15:30:38'),
(32, 'User', 'User Deleted', 'First Name: Salvador<br /> Middle Name: Sydney Gilliam<br /> Last Name: Cline<br /> Contact Number: 470<br /> Address: Laboris et ut omnis ', '1002', '2024-03-08 15:30:40'),
(33, 'User', 'User Deleted', 'First Name: Olympia<br /> Middle Name: Haynes<br /> Last Name: Cooley<br /> Contact Number: 178<br /> Address: Facilis in ut ullamc', '1002', '2024-03-08 15:30:42'),
(34, 'User', 'User Deleted', 'First Name: Simon<br /> Middle Name: <br /> Last Name: Figueroa<br /> Contact Number: Perspiciatis corpor<br /> Address: Error lorem aut moll', '1002', '2024-03-08 15:30:45'),
(35, 'User', 'User Deleted', 'First Name: Emma<br /> Middle Name: <br /> Last Name: Franklin<br /> Contact Number: 347<br /> Address: ', '1002', '2024-03-08 15:30:47'),
(36, 'User', 'User Deleted', 'First Name: Sopoline<br /> Middle Name: <br /> Last Name: Hoffman<br /> Contact Number: 838<br /> Address: ', '1002', '2024-03-08 15:30:50'),
(37, 'User', 'User Deleted', 'First Name: Colorado<br /> Middle Name: <br /> Last Name: Norton<br /> Contact Number: Tempor irure ipsam l<br /> Address: Aperiam velit repre', '1002', '2024-03-08 15:30:52'),
(38, 'User', 'User Deleted', 'First Name: Ainsley<br /> Middle Name: Fatima Mckenzie<br /> Last Name: Rasmussen<br /> Contact Number: 442<br /> Address: Voluptate sed dolori', '1002', '2024-03-08 15:30:55'),
(39, 'User', 'User Deleted', 'First Name: Ann<br /> Middle Name: Hale<br /> Last Name: Sherman<br /> Contact Number: 397<br /> Address: ', '1002', '2024-03-08 15:30:58'),
(40, 'User', 'User Deleted', 'First Name: Bianca<br /> Middle Name: Yonson<br /> Last Name: Wong<br /> Contact Number: 1234567890<br /> Address: ', '1002', '2024-03-08 15:31:01'),
(41, 'User', 'User Deleted', 'c_fname: Sopoline<br /> c_lname: Hoffman<br /> c_email: kamoqomuj@mailinator.com<br /> c_contact: 838<br /> c_address: Dolor id aut earum e', '1002', '2024-03-08 15:31:13'),
(42, 'User', 'User Deleted', 'c_fname: Lucian<br /> c_lname: Warren<br /> c_email: gunemyg@mailinator.com<br /> c_contact: 673<br /> c_address: Architecto praesenti', '1002', '2024-03-08 15:31:15'),
(43, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> c_email: <br /> c_contact: <br /> c_address: ', '1002', '2024-03-08 16:53:14'),
(44, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> c_email: <br /> c_contact: <br /> c_address: ', '1002', '2024-03-08 16:54:25'),
(45, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> c_email: <br /> c_contact: <br /> c_address: ', '1002', '2024-03-08 16:54:37'),
(46, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> c_email: <br /> c_contact: <br /> c_address: ', '1002', '2024-03-08 16:55:11'),
(47, 'User', 'User Modified', 'First Name: Vladimer<br /> Middle Name: <br /> Last Name: Ombi-on<br /> Contact Number: 093656454645<br /> Address: TC', '1002', '2024-03-08 16:56:51'),
(48, 'User', 'User Deleted', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 09665034568<br /> Address: ', '1002', '2024-03-11 09:55:01'),
(49, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: TC', '1002', '2024-03-11 10:21:51'),
(50, 'User', 'User Modified', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09928522244<br /> Address: Talisay City', '1002', '2024-03-11 14:42:47'),
(51, 'User', 'User Modified', 'First Name: Vladimer<br /> Middle Name: <br /> Last Name: Ombi-on<br /> Contact Number: 093656454645<br /> Address: TC', '1002', '2024-03-11 14:43:34'),
(52, 'User', 'User Deleted', 'c_fname: Haden<br /> c_lname: James<br /> c_email: haden@gmail.com<br /> c_contact: 0946546456456<br /> c_address: BC', '1002', '2024-03-11 16:23:26'),
(53, 'User', 'User Deleted', 'c_fname: Odette<br /> c_lname: Roman<br /> c_email: wyfa@mailinator.com<br /> c_contact: 170<br /> c_address: Quos excepturi quos ', '1002', '2024-03-11 16:33:43'),
(54, 'User', 'User Deleted', 'c_fname: Haden<br /> c_lname: James<br /> c_email: haden@gmail.com<br /> c_contact: 0965148546565<br /> c_address: BC', '1002', '2024-03-11 16:33:46'),
(55, 'User', 'User Added', 'First Name: Chava<br /> Middle Name: <br /> Last Name: Frederick<br /> Contact Number: 129<br /> Address: Eos omnis aut laboru', '1002', '2024-03-11 16:34:39'),
(56, 'User', 'User Modified', 'First Name: Oliver<br /> Middle Name: <br /> Last Name: Oliver<br /> Contact Number: 111<br /> Address: Ab quo et et accusan', '1002', '2024-03-11 16:42:18'),
(57, 'User', 'User Modified', 'First Name: Oliver<br /> Middle Name: <br /> Last Name: Oliver<br /> Contact Number: 111<br /> Address: Ab quo et et accusan', '1002', '2024-03-11 16:42:23'),
(58, 'User', 'User Deleted', 'c_fname: Vladimer<br /> c_lname: Ombi-on<br /> c_email: vladimer@gmail.com<br /> c_contact: 09663656546<br /> c_address: BC', '1002', '2024-03-12 09:27:06'),
(59, 'User', 'User Deleted', 'Service Name: Haircut<br /> Service Price: 80.00', '1150', '2024-03-12 13:58:08'),
(60, 'User', 'User Deleted', 'Service Name: Hairstyle<br /> Service Price: 100.00', '1150', '2024-03-12 13:58:10'),
(61, 'User', 'User Deleted', 'Service Name: Hair Rebond<br /> Service Price: 1000.00', '1150', '2024-03-12 13:58:13'),
(62, 'User', 'User Deleted', 'Service Name: Semi Rebond<br /> Service Price: 800.00', '1150', '2024-03-12 13:58:16'),
(63, 'User', 'User Deleted', 'Service Name: Brazillian Hair Rebond<br /> Service Price: 1500.00', '1150', '2024-03-12 13:58:17'),
(64, 'User', 'User Deleted', 'Service Name: Brazillian Color Hair Rebond<br /> Service Price: 2000.00', '1150', '2024-03-12 13:58:19'),
(65, 'User', 'User Deleted', 'Service Name: Hair Trimming<br /> Service Price: 50.00', '1150', '2024-03-12 13:58:21'),
(66, 'User', 'User Deleted', 'Service Name: Shave<br /> Service Price: 100.00', '1150', '2024-03-12 13:58:23'),
(67, 'User', 'User Deleted', 'Service Name: Manicure<br /> Service Price: 150.00', '1150', '2024-03-12 13:58:25'),
(68, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: TC', '1002', '2024-03-13 15:49:51'),
(69, 'User', 'User Modified', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09928522244<br /> Address: Talisay City', '1002', '2024-03-14 11:40:54'),
(70, 'User', 'User Modified', 'First Name: Oliver<br /> Middle Name: <br /> Last Name: Oliver<br /> Contact Number: 111<br /> Address: Ab quo et et accusan', '1002', '2024-03-14 15:00:31'),
(71, 'User', 'User Modified', 'First Name: Vladimer<br /> Middle Name: <br /> Last Name: Ombi-on<br /> Contact Number: 09669544547<br /> Address: BC', '1002', '2024-03-14 15:00:49'),
(72, 'User', 'User Modified', 'First Name: Hiram<br /> Middle Name: <br /> Last Name: Cantrell<br /> Contact Number: 588<br /> Address: BC', '1002', '2024-03-15 10:54:39'),
(73, 'User', 'User Deleted', 'c_fname: Hiram<br /> c_lname: Cantrell<br /> c_email: jehynemy@mailinator.com<br /> c_contact: 588<br /> c_address: Facilis eaque blandi', '1002', '2024-03-15 10:58:11'),
(74, 'User', 'User Deleted', 'First Name: Hiram<br /> Middle Name: <br /> Last Name: Cantrell<br /> Contact Number: 588<br /> Address: BC', '1002', '2024-03-15 10:58:17'),
(75, 'User', 'User Modified', 'First Name: Erin<br /> Middle Name: <br /> Last Name: Frazier<br /> Contact Number: 625<br /> Address: BC', '1002', '2024-03-15 11:37:27'),
(76, 'User', 'User Deleted', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09928522244<br /> Address: Talisay City', '1002', '2024-03-18 14:26:44'),
(77, 'User', 'User Deleted', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09665034568<br /> Address: ', '1002', '2024-03-18 14:37:15'),
(78, 'User', 'User Deleted', 'c_fname: Ronald<br /> c_lname: Tangguan<br /> c_email: <br /> c_contact: 09665034568<br /> c_address: ', '1002', '2024-03-18 14:37:22'),
(79, 'User', 'User Modified', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09665034568<br /> Address: Capt Sabi Zone 4 Talisay City, Negros Occidental, Philippines', '1002', '2024-03-18 14:38:15'),
(80, 'User', 'User Deleted', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09665034568<br /> Address: Capt Sabi Zone 4 Talisay City, Negros Occidental, Philippines', '1002', '2024-03-18 14:50:05'),
(81, 'User', 'User Modified', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09665034568<br /> Address: Capt. Sabi Zone 4, Talisay City, Negros Occidental', '1002', '2024-03-18 14:53:14'),
(82, 'User', 'User Modified', 'First Name: Admin<br /> Middle Name: <br /> Last Name: Admin<br /> Contact Number: 09876543210<br /> Address: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '1002', '2024-03-18 16:16:21'),
(83, 'User', 'User Deleted', 'Service Name: Pedicure<br /> Service Price: 250.00', '1150', '2024-03-22 09:59:49'),
(84, 'User', 'User Deleted', 'Service Name: Manicure<br /> Service Price: 200.00', '1150', '2024-03-22 10:06:25'),
(85, 'User', 'User Deleted', 'Service Name: Haircut<br /> Service Price: 80.00', '1150', '2024-03-22 13:15:36'),
(86, 'User', 'User Deleted', 'Time 9:00<br /> AM/PM AM', '1150', '2024-03-25 15:41:50'),
(87, 'User', 'User Deleted', 'Time 10<br /> AM/PM AM', '1150', '2024-03-25 15:42:21'),
(88, 'User', 'User Deleted', 'Time 11<br /> AM/PM AM', '1150', '2024-03-25 15:42:23'),
(89, 'User', 'User Modified', 'First Name: Vladimer<br /> Middle Name: <br /> Last Name: Ombi-on<br /> Contact Number: 09669544547<br /> Address: BC', '1002', '2024-04-01 15:26:04'),
(90, 'User', 'User Modified', 'First Name: Vladi<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 114<br /> Address: TC', '1002', '2024-04-01 15:28:51'),
(91, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: TC', '1002', '2024-04-03 16:11:25'),
(92, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: TC', '1002', '2024-04-03 16:38:00'),
(93, 'User', 'User Deleted', 'Time 12<br /> AM/PM PM', '1150', '2024-04-15 10:22:04'),
(94, 'User', 'User Deleted', 'Time 12<br /> AM/PM AM', '1150', '2024-04-15 10:22:07'),
(95, 'User', 'User Deleted', 'c_fname: James<br /> c_lname: <br /> email: Hadden<br /> c_contact: 09928522244<br /> address: Talisay City Negros Occidental', '1002', '2024-04-16 14:12:43'),
(96, 'User', 'User Deleted', 'Time 12:00<br /> AM/PM ', '1159', '2024-04-17 12:11:42'),
(97, 'User', 'User Modified', 'First Name: Oliver<br /> Middle Name: <br /> Last Name: Oliver<br /> Contact Number: 111<br /> Address: Ab quo et et accusan', '1002', '2024-04-17 12:17:56'),
(98, 'User', 'User Deleted', 'First Name: Vladi<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 114<br /> Address: TC', '1002', '2024-09-03 13:55:21'),
(99, 'User', 'User Deleted', 'First Name: Shelby<br /> Middle Name: <br /> Last Name: Curry<br /> Contact Number: 640<br /> Address: ', '1002', '2024-09-03 13:55:24'),
(100, 'User', 'User Deleted', 'First Name: Erin<br /> Middle Name: <br /> Last Name: Frazier<br /> Contact Number: 625<br /> Address: BC', '1002', '2024-09-03 13:55:28'),
(101, 'User', 'User Deleted', 'First Name: James<br /> Middle Name: <br /> Last Name: Haden<br /> Contact Number: 0912321312<br /> Address: Bacolod City', '1002', '2024-09-03 13:55:31'),
(102, 'User', 'User Deleted', 'First Name: Reynan<br /> Middle Name: <br /> Last Name: Mole<br /> Contact Number: 12321321321<br /> Address: ', '1002', '2024-09-03 13:55:33'),
(103, 'User', 'User Deleted', 'First Name: Oliver<br /> Middle Name: <br /> Last Name: Oliver<br /> Contact Number: 111<br /> Address: Ab quo et et accusan', '1002', '2024-09-03 13:55:36'),
(104, 'User', 'User Deleted', 'First Name: Vladimer<br /> Middle Name: <br /> Last Name: Ombi-on<br /> Contact Number: 09669544547<br /> Address: BC', '1002', '2024-09-03 13:55:38'),
(105, 'User', 'User Deleted', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 09928522244<br /> Address: ', '1002', '2024-09-03 13:55:41'),
(106, 'User', 'User Deleted', 'First Name: X<br /> Middle Name: <br /> Last Name: Tian<br /> Contact Number: 09928522244<br /> Address: Bacolod', '1002', '2024-09-03 13:55:44'),
(107, 'User', 'User Deleted', 'c_fname: Ronald<br /> c_lname: <br /> email: Tangguan<br /> c_contact: 09665034568', '1002', '2024-09-03 13:55:49'),
(108, 'User', 'User Deleted', 'c_fname: Vladi<br /> c_lname: <br /> email: Cortez<br /> c_contact: 45645654045', '1002', '2024-09-03 13:55:52'),
(109, 'User', 'User Deleted', 'c_fname: Vladimer<br /> c_lname: <br /> email: Ombi-on<br /> c_contact: 32104554456', '1002', '2024-09-03 13:55:55'),
(110, 'User', 'User Deleted', 'c_fname: Shelby<br /> c_lname: <br /> email: Curry<br /> c_contact: 09784565405', '1002', '2024-09-03 13:55:58'),
(111, 'User', 'User Deleted', 'c_fname: Oliver<br /> c_lname: <br /> email: Morris<br /> c_contact: 09564565666', '1002', '2024-09-03 13:56:01'),
(112, 'User', 'User Deleted', 'c_fname: Erin<br /> c_lname: <br /> email: Frazier<br /> c_contact: 09397765466', '1002', '2024-09-03 13:56:06'),
(113, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> email: <br /> c_contact: ', '1002', '2024-09-17 09:33:39'),
(114, 'User', 'User Deleted', 'c_fname: <br /> c_lname: <br /> email: <br /> c_contact: ', '1002', '2024-09-17 09:34:01'),
(115, 'User', 'User Deleted', 'First Name: Admin<br /> Middle Name: <br /> Last Name: Admin<br /> Contact Number: 09876543210<br /> Address: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '1002', '2024-09-17 15:45:10'),
(116, 'User', 'User Deleted', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: TC', '1002', '2024-09-17 15:45:24'),
(117, 'User', 'User Modified', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-17 15:56:57'),
(118, 'User', 'User Modified', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-17 16:01:04'),
(119, 'User', 'User Modified', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-17 16:04:07'),
(120, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: BC', '1002', '2024-09-17 16:23:01'),
(121, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: BC', '1002', '2024-09-17 16:58:24'),
(122, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: BC', '1002', '2024-09-17 16:59:43'),
(123, 'User', 'User Modified', 'First Name: Kevin1<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: BC', '1002', '2024-09-18 09:34:36'),
(124, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: BC', '1002', '2024-09-18 10:04:04'),
(125, 'User', 'User Added', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:42:19'),
(126, 'User', 'User Deleted', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:42:21'),
(127, 'User', 'User Added', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:43:25'),
(128, 'User', 'User Deleted', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:43:31'),
(129, 'User', 'User Added', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:49:08'),
(130, 'User', 'User Deleted', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:49:11'),
(131, 'User', 'User Added', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:55:46'),
(132, 'User', 'User Deleted', 'First Name: <br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:55:49'),
(133, 'User', 'User Added', 'First Name: asd<br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:56:24'),
(134, 'User', 'User Deleted', 'First Name: asd<br /> Middle Name: <br /> Last Name: <br /> Contact Number: <br /> Address: ', '1002', '2024-09-18 10:56:29'),
(135, 'User', 'User Added', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-09-18 11:07:23'),
(136, 'User', 'User Deleted', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-09-18 11:11:40'),
(137, 'User', 'User Modified', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-09-18 11:15:14'),
(138, 'User', 'User Deleted', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-09-18 11:26:04'),
(139, 'User', 'User Added', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-09-18 11:26:25'),
(140, '0', '', 'Client Hadden1 Abarisia2 modified.', '1002', '2024-10-08 15:58:30'),
(141, '0', '', 'Client Hadden Abarisia modified.', '1002', '2024-10-08 15:59:28'),
(142, '0', '', 'Client Hadden1 Abarisia1 modified.', '1002', '2024-10-08 16:00:29'),
(143, '0', '', 'Client Hadden Abarisia modified.', '1002', '2024-10-08 16:00:34'),
(144, 'Company', 'Company Deleted', '4', '1002', '2024-10-17 15:13:58'),
(145, 'Independent', 'Independent Service Provider Deleted', '', '1002', '2024-10-17 15:47:09'),
(146, 'User', 'User Deleted', '3ef815416f775098fe977004015c6193', '1002', '2024-10-17 16:35:36'),
(147, 'Company', 'Company Deleted', 'c81e728d9d4c2f636f067f89cc14862c', '1002', '2024-10-18 11:19:58'),
(148, '0', '', 'Position CEO Chief Executive Officer Added.', '1002', '2024-10-21 10:36:26'),
(149, '0', '', 'Position   modified.', '1002', '2024-10-21 10:52:20'),
(150, '0', '', 'Position   modified.', '1002', '2024-10-21 10:52:27'),
(151, 'User', 'User Deleted', 'c4ca4238a0b923820dcc509a6f75849b', '1002', '2024-10-21 10:54:12'),
(152, 'Position', 'Position Deleted', 'c4ca4238a0b923820dcc509a6f75849b', '1002', '2024-10-21 11:04:22'),
(153, '0', '', 'Position Admin Assistant Assisting the CEO Added.', '1002', '2024-10-21 14:38:06'),
(154, 'Profile', 'Profile Modified', 'First Name: Super Admin1<br /> Middle Name: 1<br /> Last Name: Super Admin1<br /> Email: superadmin@gmail.com1<br /> Position: 1<br /> Contact Number: 1234567891<br /> Address: Bacolod City1', '1002', '2024-10-21 15:06:17'),
(155, 'Profile', 'Profile Modified', 'First Name: Super Admin1<br /> Middle Name: 1<br /> Last Name: Super Admin1<br /> Email: superadmin@gmail.com1<br /> Position: 1<br /> Contact Number: 1234567891<br /> Address: Bacolod City1', '1002', '2024-10-21 15:06:43'),
(156, 'Profile', 'Profile Modified', 'First Name: Super Admin<br /> Middle Name: <br /> Last Name: Super Admin<br /> Email: superadmin@gmail.com<br /> Position: 1<br /> Contact Number: 123456789<br /> Address: Bacolod City', '1002', '2024-10-21 15:17:54'),
(157, 'Profile', 'Profile Modified', 'First Name: Super Admin<br /> Middle Name: ads<br /> Last Name: Super Admin<br /> Email: superadmin@gmail.com5<br /> Position: 1<br /> Contact Number: 123456789<br /> Address: Bacolod City', '1002', '2024-10-21 15:24:41'),
(158, 'Profile', 'Profile Modified', 'First Name: Super Admin<br /> Middle Name: ads<br /> Last Name: Super Admin<br /> Email: superadmin@gmail.com<br /> Position: 1<br /> Contact Number: 123456789<br /> Address: Bacolod City', '1002', '2024-10-21 15:24:45'),
(159, 'Profile', 'Profile Modified', 'First Name: Super Admin<br /> Middle Name: ads<br /> Last Name: Super Admin<br /> Email: superadmin@gmail.com<br /> Position: 1<br /> Contact Number: 123456789<br /> Address: Bacolod City', '1002', '2024-10-21 15:27:46'),
(160, 'User', 'User Modified', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-10-21 15:42:22'),
(161, 'User', 'User Modified', 'First Name: Errold<br /> Middle Name: <br /> Last Name: Calvo<br /> Contact Number: 123<br /> Address: BC', '1002', '2024-10-21 15:42:46'),
(162, 'User', 'User Modified', 'First Name: Kevin<br /> Middle Name: <br /> Last Name: Cortez<br /> Contact Number: 0966546565<br /> Address: BC', '1003', '2024-12-10 09:53:05'),
(163, 'User', 'User Added', 'First Name: Ronald<br /> Middle Name: <br /> Last Name: Tangguan<br /> Contact Number: 123456<br /> Address: talisay city', '1150', '2024-12-12 15:29:19'),
(164, 'Service Category', 'Service Added', 'Sub Category Name: Tile Repairs', '1150', '2024-12-13 14:00:49'),
(165, 'Service Category', 'Service Added', 'Sub Category Name: Cover Pipe Repair', '1150', '2024-12-13 14:19:20'),
(166, 'Service Category', 'Service Added', 'Sub Category Name: Tile Repair', '1150', '2024-12-13 14:19:20'),
(167, 'Service Category', 'Service Added', 'Sub Category Name: Wiring', '1150', '2024-12-13 14:46:57'),
(168, 'Service Category', 'Service Added', 'Sub Category Name: Leak Detection', '1150', '2024-12-13 14:51:18'),
(169, 'Service Category', 'Service Added', 'Sub Category Name: Circuit Breaker', '1150', '2024-12-13 14:51:18'),
(170, 'Service Category', 'Service Added', 'Sub Category Name: Concrete and Bricks', '1150', '2024-12-13 14:51:18'),
(171, 'Service Provider', '', 'Edit Profile: ', '1150', '2024-12-16 15:24:30'),
(172, 'Service Provider', '', 'Edit Profile: ', '1150', '2024-12-16 15:25:17'),
(173, 'Service Provider', '', 'Edit Profile: ', '1150', '2024-12-16 15:27:26'),
(174, 'Service Provider', '', 'Edit Profile: e3bb7c05fb15255597bc80d61c86c4d0.png', '1150', '2024-12-16 16:20:14'),
(175, 'Profile', 'Add Location', 'Address:  Longitude: 122.96203349722444 Latitude: 10.700628720168847', '1150', '2024-12-20 13:25:48'),
(176, 'Profile', 'Add Location', 'Address:  Longitude: 122.7456512 Latitude: 11.5900416', '1150', '2024-12-20 15:09:39'),
(177, 'Location', 'Location Deleted', 'c4ca4238a0b923820dcc509a6f75849b', '1150', '2024-12-20 16:11:55'),
(178, 'Location', 'Location Deleted', 'c81e728d9d4c2f636f067f89cc14862c', '1150', '2024-12-20 16:52:07'),
(179, 'Location', 'Location Deleted', 'c81e728d9d4c2f636f067f89cc14862c', '1150', '2024-12-20 16:52:44'),
(180, 'Location', 'Location Deleted', 'c4ca4238a0b923820dcc509a6f75849b', '1150', '2024-12-22 22:47:58'),
(181, 'Profile', 'Add Location', 'Address:  Longitude: 123.29147299076516 Latitude: 10.944712314542851', '1150', '2024-12-23 10:18:40'),
(182, 'Location', 'Location Deleted', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1150', '2024-12-23 10:18:43'),
(183, 'Location', 'Location Deleted', 'c4ca4238a0b923820dcc509a6f75849b', '1150', '2024-12-23 10:32:18'),
(184, 'Location', 'Location Deleted', 'c4ca4238a0b923820dcc509a6f75849b', '1150', '2024-12-23 10:32:19'),
(185, 'Location', 'Modify Location', 'Address: Bacolod North Bound Terminal, Lacson Street, La Costa Brava del Sol, Banago, Bacolod-1, Bacolod, Negros Island Region, 6115, Philippines Longitude: 122.96199029703874 Latitude: 10.70672684498786', '1150', '2024-12-23 11:03:12'),
(186, 'Location', 'Modify Location', 'Address: Lacson Street, Santo Domingo, Banago, Bacolod-1, Bacolod, Negros Island Region, 6115, Philippines Longitude: 122.96190913197762 Latitude: 10.700668158571482', '1150', '2024-12-23 11:03:26'),
(187, 'Profile', 'Add Location', 'Address:  Longitude: 122.96498289144793 Latitude: 10.731982475420377', '1190', '2024-12-23 11:15:02'),
(188, 'Location', 'Location Deleted', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2024-12-23 11:15:05'),
(189, 'Location', 'Modify Location', 'Address: Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines Longitude: 122.96499678134596 Latitude: 10.731925740507005', '1190', '2024-12-23 11:15:32'),
(190, 'Profile', 'Add Location', 'Address:  Longitude: 123.08576961259686 Latitude: 10.755646854590262', '1190', '2024-12-23 16:02:11'),
(191, 'Location', 'Location Deleted', 'e4da3b7fbbce2345d7772b0674a318d5', '1190', '2024-12-23 16:02:19'),
(192, 'Service Provider', '', 'Edit Profile: fa516964113604c9ecd05b311a254827.png', '1188', '2024-12-26 15:45:43'),
(193, 'Profile', 'Add Location', 'Address:  Longitude: 122.9620716 Latitude: 10.7009138', '1188', '2024-12-27 09:49:59'),
(194, 'Location', 'Location Deleted', '1679091c5a880faf6fb5e6087eb1b2dc', '1188', '2024-12-27 09:54:07'),
(195, 'Location', 'Location Deleted', '1679091c5a880faf6fb5e6087eb1b2dc', '1188', '2024-12-27 09:54:25'),
(196, 'Location', 'Location Deleted', '1679091c5a880faf6fb5e6087eb1b2dc', '1188', '2024-12-27 09:54:26'),
(197, 'Location', 'Modify Location', 'Address: Lacson Street, Santo Domingo, Banago, Bacolod-1, Bacolod, Negros Island Region, 6115, Philippines Longitude: 122.96199268541365 Latitude: 10.699899940932056', '1188', '2024-12-27 09:54:34'),
(198, 'Service Category', 'Service Added', 'Sub Category Name: Fences', '1188', '2024-12-27 10:04:09'),
(199, 'Service Category', 'Service Added', 'Sub Category Name: Burst Pipe or Open Wire', '1188', '2024-12-27 10:04:09'),
(200, 'User', 'User Deleted', '10, 11', '1188', '2024-12-27 10:07:07'),
(201, 'User', 'User Deleted', '10, 11', '1188', '2024-12-27 10:08:24'),
(202, 'User', 'User Deleted', '10', '1188', '2024-12-27 10:09:38'),
(203, 'User', 'User Deleted', '10', '1188', '2024-12-27 10:12:07'),
(204, 'Recover Account', 'Change Password', 'Email: cortez.kevin0914@gmail.com', '', '2025-01-06 10:05:36'),
(205, 'Recover Account', 'Change Password', 'Email: cortez.kevin0914@gmail.com', '', '2025-01-06 10:21:00'),
(206, 'Recover Account', 'Change Password', 'Email: cortez.kevin0914@gmail.com', '', '2025-01-08 16:42:52'),
(207, 'Recover Account', 'Change Password', 'Email: cortez.kevin0914@gmail.com', '', '2025-01-08 16:43:20'),
(208, 'Subscription', 'Subscribed - 1234', '1234', '1150', '2025-01-10 11:41:22'),
(209, 'Subscription', 'Subscribed - 1234', '1234', '1150', '2025-01-10 11:44:23'),
(210, 'Subscription', 'Subscribed - 12345 Plan Type Basic', '12345', '1150', '2025-01-10 13:45:05'),
(211, 'Subscription', 'Subscribed - 1234 Plan Type Basic', '1234', '1150', '2025-01-10 14:08:58'),
(212, 'Subscription', 'Subscribed - 12345 Plan Type Premium', '12345', '1190', '2025-01-10 14:16:40'),
(213, 'Subscription', 'Subscribed - 1234 Plan Type Premium', '1234', '1201', '2025-01-10 15:42:34'),
(214, 'Subscription', 'Subscribed - 1234 Plan Type Premium', '1234', '1201', '2025-01-10 15:44:50'),
(215, NULL, '', 'Top up 100.50 for 123 by c81e728d9d4c2f636f067f89cc14862c', '1190', '2025-01-16 10:36:26'),
(216, NULL, '', 'Top up 100 for 123123 by eccbc87e4b5ce2fe28308fd9f2a7baf3', '1190', '2025-01-16 10:59:56'),
(217, NULL, '', 'Top up 100 for 1234abc by 1679091c5a880faf6fb5e6087eb1b2dc', '1190', '2025-01-20 00:08:04'),
(218, NULL, '', 'Top up 200 for `123 by 8f14e45fceea167a5a36dedd4bea2543', '1190', '2025-01-20 00:21:44'),
(219, NULL, '', 'Top up 100 for 123 by d3d9446802a44259755d38e6d163e820', '1190', '2025-01-20 00:26:19'),
(220, NULL, '', 'Top up 300 for 123213 by 6512bd43d9caa6e02c990b0a82652dca', '1190', '2025-01-20 00:26:45'),
(221, 'Subscription', 'Subscribed - 123 Plan Type Premium', '123', '1190', '2025-01-20 00:35:05'),
(222, 'Subscription', 'Subscribed - 123 Plan Type Premium', '123', '1190', '2025-01-20 00:36:15'),
(223, 'Subscription', 'Subscribed - 123 Plan Type Premium', '123', '1190', '2025-01-20 00:44:29'),
(224, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:51:16'),
(225, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:51:47'),
(226, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:51:57'),
(227, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:52:48'),
(228, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:53:36'),
(229, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:55:49'),
(230, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:59:49'),
(231, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 09:59:56'),
(232, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 10:00:12'),
(233, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 10:00:15'),
(234, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 10:00:17'),
(235, 'Client', 'Profile Edit', 'First Name: Benz<br /> Middle Name: Alijid<br /> Last Name: Lozada<br /> Suffix: <br /> Contact Number: 123456789<br /> Email: heheh@gmail.com<br /> Address: Region VI (Western Visayas), Negros Occidental, City Of Talisay, Zone 14 (Pob.), , Prk. Mahidaiton, 123, Sanparq, 4, Blk 10 lot 7, 6115', '1190', '2025-01-20 10:00:29'),
(236, 'Content Management', 'Contact Modify', 'EDIT: 123123123', '1003', '2025-01-21 15:22:43'),
(237, 'Content Management', 'Contact Modify', 'EDIT: 09123456789', '1003', '2025-01-21 15:24:03'),
(238, NULL, '', 'Top up 500 by c20ad4d76fe97759aa27a0c99bff6710', '1190', '2025-01-21 15:55:19'),
(239, 'Feedback', 'Add feedback', 'test feedback', '1190', '2025-01-22 11:49:17'),
(240, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-01-29 14:39:51'),
(241, 'Location', 'Location Status Updated', 'e4da3b7fbbce2345d7772b0674a318d5', '1190', '2025-01-29 14:40:01'),
(242, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-01-29 14:40:09'),
(243, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-01-29 14:40:13'),
(244, 'Profile', 'Add Location', 'Address:  Longitude: 122.9733046786565 Latitude: 10.79900289689114', '1190', '2025-01-29 14:56:06'),
(245, 'Profile', 'Add Location', 'Address:  Longitude: 122.96249826998041 Latitude: 10.722245634082052', '1190', '2025-01-29 14:57:27'),
(246, 'Location', 'Location Deleted', 'c9f0f895fb98ab9159f51fd0297e236d', '1190', '2025-01-29 14:58:40'),
(247, 'Location', 'Location Deleted', '8f14e45fceea167a5a36dedd4bea2543', '1190', '2025-01-29 14:58:42'),
(248, 'Profile', 'Add Location', 'Address:  Longitude: 122.96311080404882 Latitude: 10.722396873835189', '1190', '2025-01-29 14:59:02'),
(249, 'Location', 'Modify Location', 'Address: Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116, Longitude: 123.08576961259686 Latitude: 10.755646854590262 Landmark: ', '1190', '2025-01-29 15:54:16'),
(250, 'Location', 'Modify Location', 'Address: Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116, Longitude: 123.08576961259686 Latitude: 10.755646854590262 Landmark: INC chruch', '1190', '2025-01-29 15:55:10'),
(251, 'Location', 'Modify Location', 'Address: Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines Longitude: 122.96499678134596 Latitude: 10.731925740507005 Landmark: tayabas elementary school', '1190', '2025-01-29 17:37:12'),
(252, 'Location', 'Location Status Updated', 'c4ca4238a0b923820dcc509a6f75849b', '1150', '2025-01-29 19:39:41'),
(253, 'Location', 'Location Status Updated', 'c4ca4238a0b923820dcc509a6f75849b', '1150', '2025-01-29 19:39:43'),
(254, 'Profile', 'Add Location', 'Address:  Longitude: 122.9557825 Latitude: 10.6813544', '1150', '2025-01-29 19:53:28'),
(255, 'Location', 'Modify Location', 'Address: Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116, Longitude: 123.08576961259686 Latitude: 10.755646854590262 Landmark: INC CHURCH', '1190', '2025-01-29 19:58:00'),
(256, 'Location', 'Modify Location', 'Address: Pueblo Santa Maria, Daga, Cadiz, Negros Occidental, Neg Longitude: 123.29147299076516 Latitude: 10.944712314542851 Landmark: Sample landmark', '1150', '2025-01-29 20:01:10'),
(257, 'Location', 'Location Status Updated', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1150', '2025-01-29 20:01:21'),
(258, 'Location', 'Location Status Updated', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '1150', '2025-01-29 20:01:22'),
(259, 'Profile', 'Add Location', 'Address:  Longitude: 123.9187456 Latitude: 10.3251968', '1188', '2025-01-29 20:07:13'),
(260, 'Location', 'Modify Location', 'Address: Lacson Street, Santo Domingo, Banago, Bacolod-1, Bacolod, Negros Island Region, 6115, Philippines Longitude: 122.96199268541365 Latitude: 10.699899940932056 Landmark: Country mart', '1188', '2025-01-29 20:10:01'),
(261, 'Location', 'Location Status Updated', 'e4da3b7fbbce2345d7772b0674a318d5', '1190', '2025-02-03 09:56:09'),
(262, 'Location', 'Location Status Updated', '45c48cce2e2d7fbdea1afc51c7c6ad26', '1190', '2025-02-03 09:56:10'),
(263, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:57:24'),
(264, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:57:25'),
(265, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:57:35'),
(266, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:58:01'),
(267, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:58:02'),
(268, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:58:03'),
(269, 'Location', 'Location Status Updated', 'a87ff679a2f3e71d9181a67b7542122c', '1190', '2025-02-03 09:58:03'),
(270, 'Location', 'Location Status Updated', 'e4da3b7fbbce2345d7772b0674a318d5', '1190', '2025-02-03 09:59:22'),
(271, 'Location', 'Location Status Updated', 'e4da3b7fbbce2345d7772b0674a318d5', '1190', '2025-02-03 09:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `tr_login_attempt`
--

CREATE TABLE `tr_login_attempt` (
  `id` int(10) NOT NULL,
  `rand` int(10) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  `auth` int(10) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idnumber` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_login_attempt`
--

INSERT INTO `tr_login_attempt` (`id`, `rand`, `ip`, `username`, `password`, `status`, `auth`, `datetime`, `idnumber`) VALUES
(1, 6010, '::1', 'admin', 'admin', 0, 0, '2023-05-29 13:19:33', ''),
(2, 4973, '::1', 'admin', 'admin', 0, 0, '2023-06-06 09:39:10', ''),
(3, 2496, '::1', 'admin', 'admin', 0, 0, '2023-08-01 14:18:39', ''),
(4, 2897, '::1', 'admin', 'admin', 0, 0, '2023-08-01 14:22:17', ''),
(5, 6736, '::1', 'admin', 'admin', 0, 0, '2023-08-02 10:56:29', ''),
(6, 2120, '::1', 'admin', 'admin', 0, 0, '2023-08-03 10:12:57', ''),
(7, 6699, '::1', 'admin', 'admin', 0, 0, '2023-08-03 11:26:09', ''),
(8, 7987, '::1', 'admin', 'admin', 0, 0, '2023-08-03 11:26:09', ''),
(9, 4880, '::1', 'admin', 'admin', 0, 0, '2023-08-03 11:30:17', ''),
(10, 3059, '::1', 'admin', 'admin', 0, 0, '2023-08-03 14:10:10', ''),
(11, 4809, '::1', 'admin', 'admin', 0, 0, '2023-08-03 14:38:19', ''),
(12, 7063, '::1', 'admin', 'admin', 0, 0, '2023-08-04 10:20:04', ''),
(13, 6933, '::1', 'admin', 'admin', 0, 0, '2023-08-04 10:25:25', ''),
(14, 6020, '::1', 'admin', 'admin', 0, 0, '2023-08-04 13:49:18', ''),
(15, 1392, '::1', 'admin', 'admin', 0, 0, '2023-08-07 13:46:52', ''),
(16, 6852, '::1', 'admin', 'admin', 0, 0, '2023-08-08 09:27:32', ''),
(17, 1957, '::1', 'admin', 'admin', 0, 0, '2023-08-08 13:27:51', ''),
(18, 4734, '::1', 'admin', 'admin', 0, 0, '2023-08-10 12:00:23', ''),
(19, 6372, '::1', 'admin', 'admin', 0, 0, '2023-08-11 09:26:26', ''),
(20, 6632, '::1', 'admin', 'admin', 0, 0, '2023-08-11 10:49:20', ''),
(21, 5632, '::1', 'admin', 'admin', 0, 0, '2023-08-14 09:21:22', ''),
(22, 7938, '::1', 'admin', 'admin', 0, 0, '2023-08-14 13:04:47', ''),
(23, 7663, '::1', 'admin', 'admin', 0, 0, '2023-08-15 09:32:39', ''),
(24, 5828, '::1', 'admin', 'admin', 0, 0, '2023-08-16 09:40:53', ''),
(25, 8237, '::1', 'admin', 'admin', 0, 0, '2023-08-16 10:05:24', ''),
(26, 2143, '::1', 'admin', 'admin', 0, 0, '2023-08-16 12:56:17', ''),
(27, 8067, '::1', 'admin', 'admin', 0, 0, '2023-08-16 17:37:16', ''),
(28, 5877, '::1', 'admin', 'admin', 0, 0, '2023-08-17 10:02:53', ''),
(29, 5191, '::1', 'admin', 'admin', 0, 0, '2023-08-18 09:50:03', ''),
(30, 1330, '::1', 'admin', 'admin', 0, 0, '2023-08-22 09:27:18', ''),
(31, 2674, '::1', 'admin', 'admin', 0, 0, '2023-08-23 09:22:56', ''),
(32, 5359, '::1', 'admin', 'admin', 0, 0, '2023-08-30 15:39:40', ''),
(33, 4068, '::1', 'admin', 'admin', 0, 0, '2023-08-31 08:39:44', ''),
(34, 3367, '::1', 'admin', 'admin', 0, 0, '2023-09-04 11:39:47', ''),
(35, 3101, '::1', 'admin', 'adminn', 0, 1, '0000-00-00 00:00:00', ''),
(36, 7093, '::1', 'admin', 'admin', 0, 0, '2023-09-05 09:13:18', ''),
(37, 5252, '::1', 'admin', 'admin', 0, 0, '2024-02-21 08:51:50', ''),
(38, 8829, '::1', 'admin', 'admin', 0, 0, '2024-02-21 16:54:48', ''),
(39, 1729, '::1', 'admin', 'admin', 0, 0, '2024-02-22 13:03:12', ''),
(40, 5060, '::1', 'admin', 'admin', 0, 0, '2024-02-22 14:45:56', ''),
(41, 8131, '::1', 'admin', 'admin', 0, 0, '2024-02-22 14:52:20', ''),
(42, 7016, '::1', 'admin', 'admin', 0, 0, '2024-02-22 14:53:02', ''),
(43, 3525, '::1', 'admin', 'admin', 0, 0, '2024-02-22 14:54:45', ''),
(44, 1327, '::1', 'admin', 'admin', 0, 0, '2024-02-22 16:12:05', ''),
(45, 5721, '::1', 'admin', 'admin', 0, 0, '2024-02-22 16:19:55', ''),
(46, 1885, '::1', 'admin', 'admin', 0, 0, '2024-02-23 09:10:30', ''),
(47, 0, '', '', '', 0, 0, '2024-02-23 09:29:55', ''),
(48, 0, '', '', '', 0, 0, '2024-02-23 09:30:30', ''),
(49, 0, '', '', '', 0, 0, '2024-02-23 09:30:33', ''),
(50, 0, '', '', '', 0, 0, '2024-02-23 09:30:53', ''),
(51, 0, '', '', '', 0, 0, '2024-02-23 09:31:16', ''),
(52, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 10:31:00', ''),
(53, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 10:31:36', ''),
(54, 0, '', 'adsa', 'asdsa', 0, 0, '2024-02-23 10:32:35', ''),
(55, 0, '', 'admin', 'asdsa', 0, 0, '2024-02-23 10:33:37', ''),
(56, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 10:37:13', ''),
(57, 2454, '::1', 'admin', 'admin', 0, 0, '2024-02-23 11:05:31', ''),
(58, 0, '', 'admin', '1232', 0, 0, '2024-02-23 11:05:53', ''),
(59, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 11:05:58', ''),
(60, 0, '', '', '', 0, 0, '2024-02-23 11:07:36', ''),
(61, 0, '', 'admin2', 'admin', 0, 0, '2024-02-23 11:08:44', ''),
(62, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 11:11:33', ''),
(63, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 11:12:46', ''),
(64, 0, '', 'admin', '32', 0, 0, '2024-02-23 11:22:08', ''),
(65, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 11:22:30', ''),
(66, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 11:34:53', ''),
(67, 2016, '::1', '', 'sadsa', 0, 1, '2024-02-23 11:35:38', ''),
(68, 3139, '::1', '', 'asdsa', 0, 1, '2024-02-23 11:36:31', ''),
(69, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 11:52:39', ''),
(70, 0, '', 'admin', 'admin', 0, 0, '2024-02-23 13:37:59', ''),
(71, 4895, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:26:38', ''),
(72, 5397, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:27:04', ''),
(73, 5151, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:27:21', ''),
(74, 2055, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:28:02', ''),
(75, 5178, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:28:11', ''),
(76, 3570, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:29:36', ''),
(77, 7125, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:30:34', ''),
(78, 2117, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:36:33', ''),
(79, 6352, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:40:00', ''),
(80, 1085, '::1', 'admin', 'admin', 0, 0, '2024-02-23 16:50:41', ''),
(81, 8790, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:16:53', ''),
(82, 7492, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:17:40', ''),
(83, 7492, '::1', 'admin', 'admin', 0, 1, '2024-02-26 09:17:40', ''),
(84, 3643, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:17:43', ''),
(85, 3643, '::1', 'admin', 'admin', 0, 1, '2024-02-26 09:17:43', ''),
(86, 1948, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:17:46', ''),
(87, 1948, '::1', 'admin', 'admin', 0, 1, '2024-02-26 09:17:46', ''),
(88, 7943, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:18:07', ''),
(89, 7943, '::1', 'admin', 'admin', 0, 1, '2024-02-26 09:18:07', ''),
(90, 6656, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:18:09', ''),
(91, 6656, '::1', 'admin', 'admin', 0, 1, '2024-02-26 09:18:09', ''),
(92, 1831, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:18:12', ''),
(93, 7307, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:19:56', ''),
(94, 8382, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:20:00', ''),
(95, 5230, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:20:06', ''),
(96, 7228, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:20:18', ''),
(97, 4066, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:20:43', ''),
(98, 2039, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:21:02', ''),
(99, 7213, '::1', 'ronald', 'admin', 0, 1, '2024-02-26 09:23:27', ''),
(100, 8748, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:23:33', ''),
(101, 6657, '::1', 'admin', '123', 0, 1, '2024-02-26 09:26:01', ''),
(102, 5698, '::1', 'admin', '123', 0, 1, '2024-02-26 09:27:04', ''),
(103, 6065, '::1', 'admin', '12312321', 0, 1, '2024-02-26 09:27:08', ''),
(104, 4711, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:27:45', ''),
(105, 1972, '::1', 'admin', 'asdas', 0, 1, '2024-02-26 09:28:02', ''),
(106, 4676, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:28:05', ''),
(107, 3059, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:32:41', ''),
(108, 3132, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:32:49', ''),
(109, 4392, '::1', 'kevin', 'admin', 0, 1, '2024-02-26 09:32:56', ''),
(110, 7150, '::1', 'Ronald', 'admin', 0, 1, '2024-02-26 09:33:01', ''),
(111, 7307, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:33:04', ''),
(112, 3199, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:34:42', ''),
(113, 6340, '::1', 'admin', 'admin', 0, 0, '2024-02-26 09:34:49', ''),
(114, 1550, '::1', 'admin', 'admin', 0, 0, '2024-02-26 10:00:50', ''),
(115, 1296, '::1', 'admin', '123', 0, 1, '2024-02-26 10:00:57', ''),
(116, 6815, '::1', 'admin', '123123', 0, 1, '2024-02-26 10:01:05', ''),
(117, 1378, '::1', 'admin', 'admin', 0, 0, '2024-02-26 10:01:49', ''),
(118, 5190, '::1', 'ronald', 'ronald', 0, 1, '2024-02-26 10:08:57', ''),
(119, 2074, '::1', 'admin', 'admin', 0, 0, '2024-02-26 10:09:22', ''),
(120, 3811, '::1', 'Ronald', '123', 0, 1, '2024-02-26 10:09:59', ''),
(121, 3420, '::1', 'ronald', 'ronald', 0, 1, '2024-02-26 10:10:02', ''),
(122, 5873, '::1', 'kevin', 'kevin', 0, 1, '2024-02-26 10:12:43', ''),
(123, 2800, '::1', 'ronald', 'ronald', 0, 1, '2024-02-26 10:14:45', ''),
(124, 2237, '::1', 'vladi', 'vladi', 0, 1, '2024-02-26 10:14:48', ''),
(125, 1998, '::1', 'admin', 'admin', 0, 0, '2024-02-26 15:47:16', ''),
(126, 1881, '::1', 'admin', 'admin', 0, 0, '2024-02-26 15:50:25', ''),
(127, 8547, '::1', 'admin', 'admin', 0, 0, '2024-02-26 15:51:48', ''),
(128, 2678, '::1', 'admin', 'admin', 0, 0, '2024-02-26 15:53:29', ''),
(129, 1729, '::1', 'admin', 'admin', 0, 0, '2024-02-26 15:58:46', ''),
(130, 8705, '::1', 'admin', 'amdin', 0, 1, '2024-02-26 16:00:20', ''),
(131, 3148, '::1', 'admin', 'amdin', 0, 1, '2024-02-26 16:01:43', ''),
(132, 1449, '::1', 'admin', 'amdin', 0, 1, '2024-02-26 16:03:02', ''),
(133, 5565, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:03:10', ''),
(134, 6878, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:07:42', ''),
(135, 7859, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:07:47', ''),
(136, 1983, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:08:01', ''),
(137, 6355, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:08:07', ''),
(138, 8565, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:08:32', ''),
(139, 2306, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:08:36', ''),
(140, 2721, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:08:51', ''),
(141, 1260, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:08:57', ''),
(142, 3190, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:10:03', ''),
(143, 2125, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:10:07', ''),
(144, 5081, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:12:52', ''),
(145, 7799, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:13:11', ''),
(146, 2675, '::1', 'admi', 'admin', 0, 1, '2024-02-26 16:13:29', ''),
(147, 7412, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:13:33', ''),
(148, 8909, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:17:42', ''),
(149, 4921, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:17:46', ''),
(150, 7079, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:17:54', ''),
(151, 3584, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:18:02', ''),
(152, 1997, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:19:32', ''),
(153, 5526, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:22:38', ''),
(154, 7957, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:22:51', ''),
(155, 5002, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:26:14', ''),
(156, 4498, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:26:20', ''),
(157, 6728, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:26:51', ''),
(158, 8778, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:27:53', ''),
(159, 2411, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:28:55', ''),
(160, 1983, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:29:10', ''),
(161, 5853, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:29:15', ''),
(162, 4878, '::1', 'admin', 'adin', 0, 1, '2024-02-26 16:46:16', ''),
(163, 3788, '::1', 'admin', 'adin', 0, 1, '2024-02-26 16:46:23', ''),
(164, 2328, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:46:27', ''),
(165, 8065, '::1', 'admin', 'admin', 0, 0, '2024-02-26 16:57:17', ''),
(166, 7534, '::1', 'admin', 'admin', 0, 0, '2024-02-27 09:14:51', ''),
(167, 4861, '::1', 'admin', 'admin', 0, 0, '2024-02-27 15:38:59', ''),
(168, 6617, '::1', 'admin', 'admin', 0, 0, '2024-02-27 15:45:26', ''),
(169, 3287, '::1', 'admin', 'admin', 0, 0, '2024-02-27 15:45:43', ''),
(170, 6475, '::1', 'admin', 'admin', 0, 0, '2024-02-27 15:45:55', ''),
(171, 7396, '::1', 'qwer', '123', 0, 0, '2024-02-27 17:02:03', ''),
(172, 7253, '::1', 'qwer', '123', 0, 0, '2024-02-27 17:03:06', ''),
(173, 3810, '::1', 'admin', 'admin', 0, 0, '2024-02-27 17:03:19', ''),
(174, 6340, '::1', 'admin', 'admin', 0, 0, '2024-02-28 09:13:04', ''),
(175, 4067, '::1', 'admin', 'admin', 0, 0, '2024-02-28 10:36:52', ''),
(176, 3151, '::1', 'admin', 'admin', 0, 0, '2024-02-28 10:52:16', ''),
(177, 4949, '::1', 'admin', 'admin', 0, 0, '2024-02-28 11:36:29', ''),
(178, 3315, '::1', 'admin', 'admin', 0, 0, '2024-02-28 11:37:48', ''),
(179, 7968, '::1', 'admin', 'admin', 0, 0, '2024-02-28 11:43:29', ''),
(180, 4920, '::1', 'admin', 'admin', 0, 0, '2024-02-28 14:02:30', ''),
(181, 4761, '::1', 'Kevin', '1234', 0, 0, '2024-02-28 14:21:33', ''),
(182, 1625, '::1', 'Kevin', 'admin', 0, 1, '2024-02-28 14:25:25', ''),
(183, 2580, '::1', 'Kevin', '123', 0, 1, '2024-02-28 14:25:31', ''),
(184, 3952, '::1', 'Kevin', '1234', 0, 0, '2024-02-28 14:25:35', ''),
(185, 5650, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:36:25', ''),
(186, 1271, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:36:28', ''),
(187, 5070, '::1', 'Kevin', 'admin', 0, 1, '2024-02-28 14:36:32', ''),
(188, 3485, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:36:39', ''),
(189, 8039, '::1', 'Kevin', 'admin', 0, 1, '2024-02-28 14:36:52', ''),
(190, 8462, '::1', 'admin', '1234', 0, 0, '2024-02-28 14:37:05', ''),
(191, 2213, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:37:21', ''),
(192, 2993, '::1', 'Admin', 'admin', 0, 1, '2024-02-28 14:37:24', ''),
(193, 1041, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:37:42', ''),
(194, 2060, '::1', 'Kevin', 'admin', 0, 1, '2024-02-28 14:37:54', ''),
(195, 3694, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:37:58', ''),
(196, 2375, '::1', 'Admin', 'admin', 0, 1, '2024-02-28 14:38:00', ''),
(197, 1065, '::1', 'Admin', 'admin', 0, 1, '2024-02-28 14:38:33', ''),
(198, 7425, '::1', 'Admin', 'admin', 0, 1, '2024-02-28 14:38:46', ''),
(199, 3285, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:38:59', ''),
(200, 6082, '::1', 'Kevin', 'admin', 0, 1, '2024-02-28 14:39:02', ''),
(201, 8722, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:39:24', ''),
(202, 4747, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:40:44', ''),
(203, 2063, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:40:47', ''),
(204, 1445, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:41:28', ''),
(205, 7281, '::1', 'Kevin', 'admin', 0, 1, '2024-02-28 14:41:32', ''),
(206, 5832, '::1', 'finipyxime', 'Pa$$w0rd!', 0, 0, '2024-02-28 14:41:41', ''),
(207, 2761, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:42:35', ''),
(208, 5167, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:42:43', ''),
(209, 7988, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:43:30', ''),
(210, 3083, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:43:35', ''),
(211, 8168, '::1', 'ronald', '12345', 0, 0, '2024-02-28 14:44:36', ''),
(212, 5802, '::1', 'admin', 'admin', 0, 1, '2024-02-28 14:55:58', ''),
(213, 3044, '::1', 'ronald', '12345', 0, 0, '2024-02-28 14:58:23', ''),
(214, 5070, '::1', 'admin', 'admin', 0, 1, '2024-02-28 15:06:36', ''),
(215, 8888, '::1', 'Ronald', 'admin', 0, 1, '2024-02-28 15:06:39', ''),
(216, 1856, '::1', 'ronald', '1234', 0, 1, '2024-02-28 15:06:43', ''),
(217, 8094, '::1', 'admin', 'admin', 0, 1, '2024-02-28 15:07:23', ''),
(218, 2922, '::1', 'ronald', '12345', 0, 0, '2024-02-28 15:07:29', ''),
(219, 7356, '::1', 'admin', 'admin', 0, 0, '2024-02-28 15:14:59', ''),
(220, 2479, '::1', 'olympia', '1234', 0, 0, '2024-02-28 15:17:12', ''),
(221, 7529, '::1', 'ronald', '12345', 0, 0, '2024-02-28 15:25:08', ''),
(222, 4361, '::1', 'admin', 'admin', 0, 0, '2024-02-29 09:07:16', ''),
(223, 7355, '::1', 'admin', 'admin', 0, 0, '2024-02-29 15:39:05', ''),
(224, 4235, '::1', 'admin', 'admin', 0, 0, '2024-02-29 15:40:26', ''),
(225, 1971, '::1', 'admin', 'admin', 0, 0, '2024-02-29 15:40:43', ''),
(226, 3912, '::1', 'admin', 'admin', 0, 0, '2024-02-29 15:44:49', ''),
(227, 8904, '::1', 'admin', 'admin', 0, 0, '2024-02-29 15:46:07', ''),
(228, 6370, '::1', 'admin', 'admin', 0, 0, '2024-02-29 16:01:39', ''),
(229, 1818, '::1', 'admin', 'admin', 0, 0, '2024-02-29 16:02:17', ''),
(230, 6132, '::1', 'admin', 'admin', 0, 0, '2024-02-29 16:03:02', ''),
(231, 8871, '::1', 'admin', 'admin', 0, 0, '2024-02-29 16:03:34', ''),
(232, 3422, '::1', 'admin', 'admin', 0, 0, '2024-02-29 16:04:45', ''),
(233, 4833, '::1', 'admin', 'admin', 0, 0, '2024-03-01 09:32:17', ''),
(234, 8473, '::1', 'admin', 'admin', 0, 0, '2024-03-01 09:32:30', ''),
(235, 3329, '::1', 'admin', 'admin', 0, 0, '2024-03-01 13:11:56', ''),
(236, 6532, '::1', 'admin', 'admin', 0, 0, '2024-03-01 13:12:08', ''),
(237, 7309, '::1', 'admin', 'admin', 0, 0, '2024-03-01 13:23:39', ''),
(238, 6983, '::1', 'admin', 'admin', 0, 0, '2024-03-04 08:57:53', ''),
(239, 8995, '::1', 'admin', 'admin', 0, 0, '2024-03-04 11:46:40', ''),
(240, 1683, '::1', 'admin', 'admin', 0, 0, '2024-03-04 13:33:00', ''),
(241, 7902, '::1', 'admin', 'admin', 0, 0, '2024-03-04 15:34:11', ''),
(242, 6581, '::1', 'admin', 'admin', 0, 0, '2024-03-05 09:34:44', ''),
(243, 3231, '::1', 'admin', 'admin', 0, 0, '2024-03-06 10:56:19', ''),
(244, 6222, '::1', 'admin', 'admin', 0, 0, '2024-03-07 08:51:52', ''),
(245, 7804, '::1', 'admin', 'admin', 0, 0, '2024-03-07 15:39:08', ''),
(246, 6656, '::1', 'admin', 'admin', 0, 0, '2024-03-07 15:46:43', ''),
(247, 5019, '::1', 'admin', 'admin', 0, 0, '2024-03-07 16:40:08', ''),
(248, 5371, '::1', 'kevin', '1234', 0, 0, '2024-03-07 16:42:13', ''),
(249, 4941, '::1', 'admin', 'admin', 0, 0, '2024-03-07 16:43:39', ''),
(250, 5172, '::1', 'admin', 'admin', 0, 0, '2024-03-08 08:56:16', ''),
(251, 4403, '::1', 'admin', 'admin', 0, 0, '2024-03-08 14:30:41', ''),
(252, 1485, '::1', 'kevin', '1234', 0, 0, '2024-03-08 15:27:17', ''),
(253, 5757, '::1', 'admin', 'admin', 0, 0, '2024-03-08 15:30:21', ''),
(254, 4773, '::1', 'admin', 'admin', 0, 0, '2024-03-11 09:13:59', ''),
(255, 1765, '::1', 'kevin', '1234', 0, 0, '2024-03-11 10:18:32', ''),
(256, 6877, '::1', 'admin', 'admin', 0, 0, '2024-03-11 10:18:45', ''),
(257, 3334, '::1', 'kevin', '1234', 0, 0, '2024-03-11 10:22:00', ''),
(258, 2155, '::1', 'admin', 'admin', 0, 0, '2024-03-11 10:23:03', ''),
(259, 6786, '::1', 'kevin', '1234', 0, 0, '2024-03-11 10:34:28', ''),
(260, 2479, '::1', 'admin', 'admin', 0, 0, '2024-03-11 14:39:57', ''),
(261, 8820, '::1', 'ronald', 'admin', 0, 1, '2024-03-11 14:42:56', ''),
(262, 8679, '::1', 'admin', 'admin', 0, 0, '2024-03-11 14:43:23', ''),
(263, 4014, '::1', 'vladimer', '1234', 0, 0, '2024-03-11 14:43:56', ''),
(264, 1483, '::1', 'admin', 'admin', 0, 0, '2024-03-11 14:47:15', ''),
(265, 4712, '::1', 'kevin', '1234', 0, 0, '2024-03-11 15:06:37', ''),
(266, 8927, '::1', 'admin', 'admin', 0, 0, '2024-03-11 15:12:49', ''),
(267, 6933, '::1', 'kevin', '1234', 0, 0, '2024-03-11 15:17:38', ''),
(268, 8825, '::1', 'admin', 'admin', 0, 0, '2024-03-11 15:22:44', ''),
(269, 5892, '::1', 'kevin', '1234', 0, 0, '2024-03-11 16:13:42', ''),
(270, 8634, '::1', 'admin', 'admin', 0, 0, '2024-03-11 16:18:44', ''),
(271, 1837, '::1', 'odette', '1234', 0, 1, '2024-03-11 16:29:27', ''),
(272, 6856, '::1', 'Odette', '1234', 0, 1, '2024-03-11 16:29:34', ''),
(273, 4199, '::1', 'Romeo', '1234', 0, 1, '2024-03-11 16:29:50', ''),
(274, 5953, '::1', 'Romeo', '1234', 0, 1, '2024-03-11 16:30:12', ''),
(275, 5918, '::1', 'admin', 'admin', 0, 0, '2024-03-11 16:30:20', ''),
(276, 4879, '::1', 'admin', 'admin', 0, 0, '2024-03-11 16:33:31', ''),
(277, 7803, '::1', 'Oliver', '1234', 0, 0, '2024-03-11 16:41:01', ''),
(278, 7656, '::1', 'Oliver', '1234', 0, 0, '2024-03-11 16:41:39', ''),
(279, 8525, '::1', 'admin', 'admin', 0, 0, '2024-03-11 16:41:49', ''),
(280, 8842, '::1', 'Oliver', '1234', 0, 0, '2024-03-11 16:42:31', ''),
(281, 5365, '::1', 'admin', 'admin', 0, 0, '2024-03-11 16:55:49', ''),
(282, 5689, '::1', 'oliver', '1234', 0, 0, '2024-03-11 17:00:50', ''),
(283, 1847, '::1', 'admin', 'admin', 0, 0, '2024-03-11 17:02:54', ''),
(284, 4768, '::1', 'oliver', '1234', 0, 0, '2024-03-11 17:03:32', ''),
(285, 4557, '::1', 'admin', 'admin', 0, 0, '2024-03-11 17:05:02', ''),
(286, 8424, '::1', 'admin', 'admin', 0, 0, '2024-03-12 09:22:43', ''),
(287, 4798, '::1', 'kevin', '1234', 0, 0, '2024-03-12 10:09:43', ''),
(288, 1896, '::1', 'kevin', '1234', 0, 0, '2024-03-12 16:09:42', ''),
(289, 8130, '::1', 'admin', 'admin', 0, 0, '2024-03-13 08:17:34', ''),
(290, 6927, '::1', 'kevin', '1234', 0, 0, '2024-03-13 08:54:40', ''),
(291, 5137, '::1', 'Oliver', 'Oliver', 0, 1, '2024-03-13 10:37:17', ''),
(292, 8626, '::1', 'Oliver', 'Oliver', 0, 1, '2024-03-13 10:37:23', ''),
(293, 5114, '::1', 'oliver', 'oliver', 0, 1, '2024-03-13 10:37:26', ''),
(294, 4871, '::1', 'oliver', '1234', 0, 0, '2024-03-13 10:37:30', ''),
(295, 6442, '::1', 'admin', 'admin', 0, 0, '2024-03-13 13:53:17', ''),
(296, 6205, '::1', 'admin', 'admin', 0, 0, '2024-03-13 13:58:56', ''),
(297, 2419, '::1', 'kevin', '1234', 0, 0, '2024-03-13 15:49:58', ''),
(298, 4308, '::1', 'admin', 'admin', 0, 0, '2024-03-13 16:53:27', ''),
(299, 7409, '::1', 'admin', 'admin', 0, 0, '2024-03-13 16:54:07', ''),
(300, 8891, '::1', 'admin', 'admin', 0, 0, '2024-03-14 09:08:27', ''),
(301, 4965, '::1', 'kevin', '2134', 0, 1, '2024-03-14 09:08:58', ''),
(302, 6216, '::1', 'kevin', '1234', 0, 0, '2024-03-14 09:09:02', ''),
(303, 2945, '::1', 'admin', 'admin', 0, 0, '2024-03-14 11:37:44', ''),
(304, 6880, '::1', 'kevin', '1234', 0, 0, '2024-03-14 11:42:16', ''),
(305, 4378, '::1', 'kevin', '1234', 0, 0, '2024-03-14 13:15:15', ''),
(306, 3567, '::1', 'oliver', 'oliver', 0, 1, '2024-03-14 14:59:58', ''),
(307, 4822, '::1', 'oliver', '1234', 0, 0, '2024-03-14 15:00:01', ''),
(308, 4058, '::1', 'admin', 'admin', 0, 0, '2024-03-14 15:00:13', ''),
(309, 2751, '::1', 'oliver', '1234', 0, 0, '2024-03-14 15:01:06', ''),
(310, 8427, '::1', 'kevin', '1234', 0, 0, '2024-03-14 15:42:28', ''),
(311, 8870, '::1', 'oliver', '1234', 0, 0, '2024-03-14 16:00:30', ''),
(312, 2622, '::1', 'vladi', '1234', 0, 1, '2024-03-14 16:05:55', ''),
(313, 3557, '::1', 'vladimer', '1234', 0, 0, '2024-03-14 16:05:58', ''),
(314, 3140, '::1', 'kevin', '1234', 0, 0, '2024-03-14 16:06:15', ''),
(315, 2145, '::1', 'kevin', '1234', 0, 0, '2024-03-15 09:04:58', ''),
(316, 3567, '::1', 'oliver', '2134', 0, 1, '2024-03-15 09:05:45', ''),
(317, 5825, '::1', 'oliver', 'oliver', 0, 1, '2024-03-15 09:05:48', ''),
(318, 1599, '::1', 'oliver', 'oliver', 0, 1, '2024-03-15 09:05:53', ''),
(319, 6907, '::1', 'oliver', 'oliver', 0, 1, '2024-03-15 09:06:07', ''),
(320, 6744, '::1', 'oliver', '1234', 0, 0, '2024-03-15 09:06:11', ''),
(321, 8716, '::1', 'admin', 'admin', 0, 0, '2024-03-15 09:14:25', ''),
(322, 8207, '::1', 'kevin', '1234', 0, 0, '2024-03-15 09:20:43', ''),
(323, 4234, '::1', 'oliver', '1234', 0, 0, '2024-03-15 09:30:02', ''),
(324, 3895, '::1', 'kevin', '1234', 0, 0, '2024-03-15 09:31:23', ''),
(325, 6159, '::1', 'admin', 'admin', 0, 0, '2024-03-15 09:50:28', ''),
(326, 2157, '::1', 'kevin', '1234', 0, 0, '2024-03-15 10:38:56', ''),
(327, 2153, '::1', 'oliver', '1234', 0, 0, '2024-03-15 10:43:05', ''),
(328, 8996, '::1', 'admin', 'admin', 0, 0, '2024-03-15 10:45:23', ''),
(329, 6607, '::1', 'admin', 'admin', 0, 0, '2024-03-15 10:48:31', ''),
(330, 2977, '::1', 'Vladi', '12345', 0, 1, '2024-03-15 10:50:12', ''),
(331, 2262, '::1', 'Vladi', '1234', 0, 0, '2024-03-15 10:50:17', ''),
(332, 6563, '::1', 'admin', 'admin', 0, 0, '2024-03-15 10:50:43', ''),
(333, 8118, '::1', 'Hiram', '1234', 0, 0, '2024-03-15 10:53:47', ''),
(334, 3289, '::1', 'admin', 'admin', 0, 0, '2024-03-15 10:54:04', ''),
(335, 3412, '::1', 'Hiram', '1234', 0, 0, '2024-03-15 10:54:52', ''),
(336, 3569, '::1', 'admin', 'admin', 0, 0, '2024-03-15 10:57:05', ''),
(337, 1955, '::1', 'Erin', '1234', 0, 0, '2024-03-15 11:36:48', ''),
(338, 4817, '::1', 'admin', 'admin', 0, 0, '2024-03-15 11:37:04', ''),
(339, 6354, '::1', 'Erin', '1234', 0, 0, '2024-03-15 11:37:42', ''),
(340, 4813, '::1', 'admin', 'admin', 0, 0, '2024-03-15 11:38:02', ''),
(341, 5685, '::1', 'oliver', '1234', 0, 0, '2024-03-15 11:46:00', ''),
(342, 3767, '::1', 'admin', 'admin', 0, 0, '2024-03-15 14:07:54', ''),
(343, 3507, '::1', 'oliver', 'oliver', 0, 1, '2024-03-15 14:15:50', ''),
(344, 7171, '::1', 'kevin', '1234', 0, 0, '2024-03-15 14:15:54', ''),
(345, 2183, '::1', 'oliver', '1234', 0, 0, '2024-03-15 16:01:46', ''),
(346, 3151, '::1', 'kevin', '1234', 0, 0, '2024-03-15 16:03:37', ''),
(347, 2532, '::1', 'vladi', '1234', 0, 0, '2024-03-15 16:05:34', ''),
(348, 1165, '::1', 'oliver', '1234', 0, 0, '2024-03-15 16:06:01', ''),
(349, 6963, '::1', 'kevin', '1234', 0, 0, '2024-03-15 16:06:44', ''),
(350, 4040, '::1', 'oliver', '1234', 0, 0, '2024-03-15 16:34:49', ''),
(351, 3247, '::1', 'kevin', '1234', 0, 0, '2024-03-15 16:41:11', ''),
(352, 6546, '::1', 'admin', 'admin', 0, 0, '2024-03-18 09:35:47', ''),
(353, 6261, '::1', 'admin', 'admin', 0, 0, '2024-03-18 12:56:21', ''),
(354, 2987, '::1', 'ronald', '1234', 0, 0, '2024-03-18 14:30:15', ''),
(355, 1174, '::1', 'admin', 'admin', 0, 0, '2024-03-18 14:30:33', ''),
(356, 1501, '::1', 'ronald', '1234', 0, 0, '2024-03-18 14:38:32', ''),
(357, 4108, '::1', 'kevin', '1234', 0, 0, '2024-03-18 14:48:06', ''),
(358, 6229, '::1', 'oliver', '1234', 0, 0, '2024-03-18 14:48:22', ''),
(359, 1354, '::1', 'admin', 'admin', 0, 0, '2024-03-18 14:49:56', ''),
(360, 3790, '::1', 'ronald', '1234', 0, 0, '2024-03-18 14:53:28', ''),
(361, 4049, '::1', 'admin', 'admin', 0, 0, '2024-03-18 16:10:41', ''),
(362, 4631, '::1', 'admin', 'admin', 0, 0, '2024-03-19 09:05:14', ''),
(363, 3488, '::1', 'kevin', '1234', 0, 0, '2024-03-19 09:09:13', ''),
(364, 6096, '::1', 'admin', 'admin', 0, 0, '2024-03-19 09:09:40', ''),
(365, 8554, '::1', 'admin', 'admin', 0, 0, '2024-03-20 08:44:15', ''),
(366, 7546, '::1', 'kevin', '1234', 0, 0, '2024-03-20 09:09:22', ''),
(367, 6869, '::1', 'admin', 'admin', 0, 0, '2024-03-20 10:11:15', ''),
(368, 4378, '::1', 'admin', 'admin', 0, 0, '2024-03-21 10:22:34', ''),
(369, 6043, '::1', 'oliver', '1234', 0, 0, '2024-03-21 11:29:26', ''),
(370, 8586, '::1', 'admin', 'admin', 0, 0, '2024-03-21 11:40:05', ''),
(371, 5665, '::1', 'admin', 'admin', 0, 0, '2024-03-21 11:40:27', ''),
(372, 3195, '::1', 'admin', 'admin', 0, 0, '2024-03-21 11:40:45', ''),
(373, 6138, '::1', 'oliver', '1234', 0, 0, '2024-03-21 11:41:04', ''),
(374, 2203, '::1', 'kevin', '1234', 0, 0, '2024-03-21 11:46:14', ''),
(375, 7130, '::1', 'oliver', '1234', 0, 0, '2024-03-21 11:47:56', ''),
(376, 5230, '::1', 'admin', 'admin', 0, 0, '2024-03-21 11:48:48', ''),
(377, 7918, '::1', 'admin', 'admin', 0, 0, '2024-03-21 12:38:05', ''),
(378, 2716, '::1', 'oliver', '1234', 0, 0, '2024-03-21 12:39:16', ''),
(379, 3111, '::1', 'admin', 'admin', 0, 0, '2024-03-21 12:39:28', ''),
(380, 3640, '::1', 'oliver', '1234', 0, 0, '2024-03-21 12:42:54', ''),
(381, 5574, '::1', 'admin', 'admin', 0, 0, '2024-03-21 12:45:58', ''),
(382, 2678, '::1', 'oliver', '1234', 0, 0, '2024-03-21 12:46:22', ''),
(383, 5953, '::1', 'kevin', '1234', 0, 0, '2024-03-21 12:50:14', ''),
(384, 6025, '::1', 'admin', 'admin', 0, 0, '2024-03-21 12:51:24', ''),
(385, 8412, '::1', 'kevin', '1234', 0, 0, '2024-03-21 12:57:56', ''),
(386, 6935, '::1', 'vladi', '1234', 0, 0, '2024-03-21 13:02:31', ''),
(387, 3640, '::1', 'kevin', '134', 0, 1, '2024-03-21 13:03:26', ''),
(388, 7183, '::1', 'kevin', '1234', 0, 0, '2024-03-21 13:03:28', ''),
(389, 8369, '::1', 'admin', 'admin', 0, 0, '2024-03-21 13:06:22', ''),
(390, 4905, '::1', 'admin', 'admin', 0, 0, '2024-03-21 14:42:39', ''),
(391, 3983, '::1', 'ronald', '1234', 0, 0, '2024-03-21 14:43:14', ''),
(392, 2624, '::1', 'admin', 'admin', 0, 0, '2024-03-22 08:51:43', ''),
(393, 7833, '::1', 'admin', 'admin', 0, 0, '2024-03-22 08:52:18', ''),
(394, 7306, '::1', 'kevin', '1234', 0, 0, '2024-03-22 09:27:57', ''),
(395, 6406, '::1', 'kevin', '1234', 0, 0, '2024-03-22 13:13:43', ''),
(396, 1557, '::1', 'admin', 'admin', 0, 0, '2024-03-25 09:14:25', ''),
(397, 3832, '::1', 'admin', 'admin', 0, 0, '2024-03-25 09:37:18', ''),
(398, 6051, '::1', 'kevin', '1234', 0, 0, '2024-03-25 12:58:05', ''),
(399, 3746, '::1', 'kevin', '1234', 0, 0, '2024-03-25 14:15:53', ''),
(400, 1512, '::1', 'admin', 'admin', 0, 0, '2024-03-25 15:03:55', ''),
(401, 3438, '::1', 'kevin', '1234', 0, 0, '2024-03-25 15:04:13', ''),
(402, 4483, '::1', 'admin', 'admin', 0, 0, '2024-03-25 15:04:45', ''),
(403, 2459, '::1', 'kevin', '1234', 0, 0, '2024-03-25 15:04:55', ''),
(404, 1110, '::1', 'admin', 'admin', 0, 0, '2024-03-26 13:25:47', ''),
(405, 4523, '::1', 'admin', 'admin', 0, 0, '2024-03-26 13:59:26', ''),
(406, 2060, '::1', 'admin', 'admin', 0, 0, '2024-03-26 14:00:17', ''),
(407, 3559, '::1', 'admin', 'admin', 0, 0, '2024-03-26 14:01:35', ''),
(408, 5740, '::1', 'kevin', '1234', 0, 0, '2024-03-26 15:11:09', ''),
(409, 1622, '::1', 'admin', 'admin', 0, 0, '2024-03-26 16:32:35', ''),
(410, 1963, '::1', 'admin', 'admin', 0, 0, '2024-03-26 16:50:16', ''),
(411, 2875, '::1', 'kevin', '1234', 0, 0, '2024-03-26 17:18:21', ''),
(412, 1789, '::1', 'admin', 'admin', 0, 0, '2024-03-27 09:07:25', ''),
(413, 4102, '::1', 'admin', 'admin', 0, 0, '2024-04-01 09:10:06', ''),
(414, 1932, '::1', 'admin', 'admin', 0, 0, '2024-04-01 09:48:15', ''),
(415, 6387, '::1', 'kevin', '1234', 0, 0, '2024-04-01 15:11:55', ''),
(416, 2371, '::1', 'kevin', '1234', 0, 0, '2024-04-01 15:16:12', ''),
(417, 5626, '::1', 'vladi', '1234', 0, 0, '2024-04-01 15:25:31', ''),
(418, 8934, '::1', 'admin', 'admin', 0, 0, '2024-04-01 15:25:42', ''),
(419, 5395, '::1', 'vladi', '1234', 0, 0, '2024-04-01 15:26:32', ''),
(420, 2113, '::1', 'admin', 'admin', 0, 0, '2024-04-01 15:27:38', ''),
(421, 4332, '::1', 'vladi', '1234', 0, 0, '2024-04-01 15:28:15', ''),
(422, 8024, '::1', 'admin', 'admin', 0, 0, '2024-04-01 15:28:29', ''),
(423, 8850, '::1', 'vladi', '1234', 0, 0, '2024-04-01 15:29:01', ''),
(424, 2347, '::1', 'kevin', '123', 0, 1, '2024-04-02 09:23:47', ''),
(425, 4419, '::1', 'kevin', '1234', 0, 0, '2024-04-02 09:23:52', ''),
(426, 8928, '::1', 'admin', 'admin', 0, 0, '2024-04-02 14:27:19', ''),
(427, 4830, '::1', 'admin', 'admin', 0, 0, '2024-04-02 15:17:46', ''),
(428, 3040, '::1', 'kevin', '1234', 0, 0, '2024-04-02 16:05:07', ''),
(429, 1356, '::1', 'admin', 'admin', 0, 0, '2024-04-02 16:29:11', ''),
(430, 8391, '::1', 'kevin', '1234', 0, 0, '2024-04-02 16:29:39', ''),
(431, 2373, '::1', 'ronald', '1234', 0, 0, '2024-04-02 17:02:54', ''),
(432, 1429, '::1', 'kevin', '1234', 0, 0, '2024-04-02 17:03:41', ''),
(433, 2957, '::1', 'kevin', '1234', 0, 0, '2024-04-03 09:18:38', ''),
(434, 3812, '::1', 'admin', 'admin', 0, 0, '2024-04-03 09:42:48', ''),
(435, 2350, '::1', 'kevin', '1234', 0, 0, '2024-04-03 09:43:04', ''),
(436, 6524, '::1', 'admin', 'admin', 0, 0, '2024-04-03 10:42:15', ''),
(437, 8317, '::1', 'kevin', '1234', 0, 0, '2024-04-03 10:42:37', ''),
(438, 2158, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:20:06', ''),
(439, 5304, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:32:30', ''),
(440, 2931, '::1', 'kevin', '1234', 0, 0, '2024-04-03 11:33:09', ''),
(441, 4696, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:33:48', ''),
(442, 5623, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:38:45', ''),
(443, 5701, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:41:20', ''),
(444, 5637, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:43:59', ''),
(445, 3362, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:45:46', ''),
(446, 6781, '::1', 'admin', 'admin', 0, 0, '2024-04-03 11:46:46', ''),
(447, 4072, '::1', 'kevin', '1234', 0, 0, '2024-04-03 11:52:24', ''),
(448, 4656, '::1', 'kevin', '1234', 0, 0, '2024-04-03 14:18:14', ''),
(449, 2001, '::1', 'admin', 'admin', 0, 0, '2024-04-03 15:04:05', ''),
(450, 8741, '::1', 'ronald', '1234', 0, 0, '2024-04-03 16:16:11', ''),
(451, 8132, '::1', 'kevin', '1234', 0, 0, '2024-04-03 16:21:22', ''),
(452, 3257, '::1', 'kevin', '1234', 0, 0, '2024-04-03 16:27:03', ''),
(453, 5468, '::1', 'admin', 'admin', 0, 0, '2024-04-03 16:37:46', ''),
(454, 6059, '::1', 'kevin', '1234', 0, 0, '2024-04-03 16:38:07', ''),
(455, 3590, '::1', 'admin', 'admin', 0, 0, '2024-04-03 16:43:42', ''),
(456, 4670, '::1', 'admin', 'admin', 0, 0, '2024-04-03 16:47:30', ''),
(457, 1395, '::1', 'kevin', '1234', 0, 0, '2024-04-03 16:48:52', ''),
(458, 5984, '::1', 'kevin', '2134', 0, 1, '2024-04-03 16:51:49', ''),
(459, 4049, '::1', 'kevin', '1234', 0, 0, '2024-04-03 16:51:55', ''),
(460, 1181, '::1', 'admin', 'admin', 0, 0, '2024-04-03 16:52:04', ''),
(461, 1254, '::1', 'admin', 'admin', 0, 0, '2024-04-04 09:11:03', ''),
(462, 3134, '::1', 'admin', 'admin', 0, 0, '2024-04-04 09:13:20', ''),
(463, 5287, '::1', 'admin', 'admin', 0, 0, '2024-04-04 09:58:40', ''),
(464, 3309, '::1', 'kevin', '1234', 0, 0, '2024-04-04 09:59:05', ''),
(465, 7568, '::1', 'admin', '1234', 0, 0, '2024-04-04 10:27:42', ''),
(466, 6126, '::1', 'kevin', '1234', 0, 0, '2024-04-04 10:27:59', ''),
(467, 8183, '::1', 'admin', 'admin', 0, 0, '2024-04-04 10:30:18', ''),
(468, 2496, '::1', 'ronald', '1234', 0, 0, '2024-04-04 10:30:57', ''),
(469, 2620, '::1', 'oliver', '1234', 0, 0, '2024-04-04 11:03:47', ''),
(470, 8816, '::1', 'admin', 'admin', 0, 0, '2024-04-04 11:04:36', ''),
(471, 2067, '::1', 'kevin', '1234', 0, 0, '2024-04-04 11:05:05', ''),
(472, 8997, '::1', 'oliver', '1234', 0, 0, '2024-04-04 11:05:50', ''),
(473, 8567, '::1', 'vladi', '1234', 0, 0, '2024-04-04 11:06:17', ''),
(474, 3469, '::1', 'kevin', '1234', 0, 0, '2024-04-04 11:11:03', ''),
(475, 8759, '::1', 'kevin', '2134', 0, 1, '2024-04-04 11:15:48', ''),
(476, 1146, '::1', 'kevin', '1234', 0, 0, '2024-04-04 11:15:52', ''),
(477, 1812, '::1', 'vladi', '1234', 0, 0, '2024-04-04 11:16:00', ''),
(478, 8486, '::1', 'admin', 'admin', 0, 0, '2024-04-04 11:16:48', ''),
(479, 1908, '::1', 'kevin', '1234', 0, 0, '2024-04-04 11:16:58', ''),
(480, 8835, '::1', 'kevin', '1234', 0, 0, '2024-04-04 12:00:19', ''),
(481, 2825, '::1', 'kevin', '2134', 0, 1, '2024-04-04 15:38:02', ''),
(482, 6229, '::1', 'kevin', '1234', 0, 0, '2024-04-04 15:38:06', ''),
(483, 8915, '::1', 'vladi', '1234', 0, 0, '2024-04-04 15:45:23', ''),
(484, 6366, '::1', 'admin', 'admin', 0, 0, '2024-04-05 09:26:07', ''),
(485, 8492, '::1', 'kevin', '1234', 0, 0, '2024-04-05 09:26:50', ''),
(486, 8417, '::1', 'admin', 'admin', 0, 0, '2024-04-05 10:48:38', ''),
(487, 7880, '::1', 'kevin', '1234', 0, 0, '2024-04-05 10:48:49', ''),
(488, 3056, '::1', 'admin', 'admin', 0, 0, '2024-04-05 11:02:31', ''),
(489, 3004, '::1', 'kevin', '1234', 0, 0, '2024-04-05 13:03:17', ''),
(490, 1468, '::1', 'ronald', '1234', 0, 0, '2024-04-05 13:14:45', ''),
(491, 5385, '::1', 'admin', 'admin', 0, 0, '2024-04-05 14:41:45', ''),
(492, 4842, '::1', 'admin', 'admin', 0, 0, '2024-04-08 09:19:48', ''),
(493, 1754, '::1', 'kevin', '1234', 0, 0, '2024-04-08 09:47:02', ''),
(494, 6839, '::1', 'kevin', '1234', 0, 0, '2024-04-08 13:33:12', ''),
(495, 2257, '::1', 'admin', 'admin', 0, 0, '2024-04-08 14:17:37', ''),
(496, 3074, '::1', 'kevin', '1234', 0, 0, '2024-04-08 15:27:56', ''),
(497, 6516, '::1', 'kevin', '1234', 0, 0, '2024-04-08 16:30:55', ''),
(498, 3692, '::1', 'ronald', '1234', 0, 0, '2024-04-08 16:53:53', ''),
(499, 2482, '::1', 'admin', 'admin', 0, 0, '2024-04-08 19:42:44', ''),
(500, 2446, '::1', 'kevin', '1234', 0, 0, '2024-04-08 19:43:21', ''),
(501, 3381, '::1', 'admin', 'admin', 0, 0, '2024-04-09 09:36:36', ''),
(502, 1912, '::1', 'admin', 'admin', 0, 0, '2024-04-09 09:37:30', ''),
(503, 3749, '::1', 'admin', 'admin', 0, 0, '2024-04-09 09:41:58', ''),
(504, 2630, '::1', 'kevin', '1234', 0, 0, '2024-04-09 09:42:08', ''),
(505, 6865, '::1', 'kevin', '1234', 0, 0, '2024-04-09 11:23:03', ''),
(506, 1916, '::1', 'admin', 'admin', 0, 0, '2024-04-09 11:28:23', ''),
(507, 8334, '::1', 'kevin', '1234', 0, 0, '2024-04-09 11:50:59', ''),
(508, 8290, '::1', 'ronald', '1234', 0, 0, '2024-04-09 11:52:01', ''),
(509, 4323, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-09 20:48:22', ''),
(510, 2121, '::1', 'kevin', '1234', 0, 1, '2024-04-09 20:48:41', ''),
(511, 5994, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-09 20:48:50', ''),
(512, 1852, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 21:12:07', ''),
(513, 8357, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 21:12:16', ''),
(514, 5057, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 21:37:37', ''),
(515, 5876, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 21:38:09', ''),
(516, 3311, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 22:04:04', ''),
(517, 4537, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 22:15:50', ''),
(518, 1366, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 23:27:04', ''),
(519, 5214, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-09 23:27:21', ''),
(520, 3392, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-10 09:33:48', ''),
(521, 8837, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-10 09:34:00', ''),
(522, 6825, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-10 09:40:54', ''),
(523, 8128, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-10 09:40:59', ''),
(524, 8022, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-10 09:42:49', ''),
(525, 4093, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-10 09:48:48', ''),
(526, 8572, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-10 09:49:15', ''),
(527, 7816, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-10 09:52:02', ''),
(528, 1835, '::1', 'kevin', '1234', 0, 1, '2024-04-10 09:52:44', ''),
(529, 4226, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-10 09:53:00', ''),
(530, 8871, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-10 09:54:15', ''),
(531, 3354, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-10 10:09:24', ''),
(532, 1869, '::1', 'kevin', '1234', 0, 1, '2024-04-10 10:13:45', ''),
(533, 3694, '::1', 'kevin', '1234', 0, 1, '2024-04-10 10:13:49', ''),
(534, 6485, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-10 10:14:18', ''),
(535, 8571, '::1', 'kevin', '1234', 0, 0, '2024-04-10 11:11:30', ''),
(536, 8359, '::1', 'admin', 'admin', 0, 0, '2024-04-10 11:12:39', ''),
(537, 4394, '::1', 'kevin', '1234', 0, 1, '2024-04-10 11:13:07', ''),
(538, 8474, '::1', 'kevin', '1234', 0, 0, '2024-04-10 11:13:15', ''),
(539, 7971, '::1', 'kevin', '1234', 0, 0, '2024-04-10 11:14:55', ''),
(540, 2241, '::1', 'admin', 'admin', 0, 0, '2024-04-10 11:16:54', ''),
(541, 5175, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-10 11:49:51', ''),
(542, 3204, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-10 11:50:01', ''),
(543, 5497, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-10 11:54:10', ''),
(544, 3711, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-10 11:55:49', ''),
(545, 8502, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-10 11:56:00', ''),
(546, 4885, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-10 11:56:17', ''),
(547, 3336, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-10 12:00:35', ''),
(548, 5903, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-10 17:28:54', ''),
(549, 2716, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-11 10:08:43', ''),
(550, 3495, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-11 10:08:49', ''),
(551, 8777, '::1', 'vladi', '1234', 0, 1, '2024-04-11 10:17:25', ''),
(552, 5421, '::1', 'vladi', '1234', 0, 1, '2024-04-11 10:18:42', ''),
(553, 6787, '::1', 'vladi', '1234', 0, 1, '2024-04-11 10:18:52', ''),
(554, 7229, '::1', 'vladi', '1234', 0, 1, '2024-04-11 10:19:46', ''),
(555, 3154, '::1', 'vladi', '1234', 0, 1, '2024-04-11 10:19:57', ''),
(556, 5509, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 1, '2024-04-11 10:20:30', ''),
(557, 6673, '::1', 'tangguanronald@gmail.com', '1234', 0, 0, '2024-04-11 10:20:39', ''),
(558, 2591, '::1', 'kevin', '1234', 0, 1, '2024-04-11 10:40:27', ''),
(559, 2866, '::1', 'kevin', '1234', 0, 1, '2024-04-11 10:40:32', ''),
(560, 5139, '::1', 'kevin@gmail.com', '1234', 0, 1, '2024-04-11 10:40:47', ''),
(561, 8902, '::1', 'kevin', '1234', 0, 1, '2024-04-11 10:40:56', ''),
(562, 3218, '::1', 'kevin', '1234', 0, 1, '2024-04-11 10:42:47', ''),
(563, 7510, '::1', 'kevin', '1234', 0, 1, '2024-04-11 10:42:51', ''),
(564, 8412, '::1', 'kevin', '1234', 0, 0, '2024-04-11 10:44:37', ''),
(565, 3977, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-11 11:03:52', ''),
(566, 3470, '::1', 'tangguanronald@gmail.com', 'rognvaldr17', 0, 1, '2024-04-11 12:10:01', ''),
(567, 4735, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-11 12:10:13', ''),
(568, 5403, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-11 12:10:20', ''),
(569, 5233, '::1', 'kevin', '1234', 0, 0, '2024-04-11 13:41:38', ''),
(570, 2500, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-11 14:43:07', ''),
(571, 6589, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-11 14:43:18', ''),
(572, 4829, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-11 16:45:22', ''),
(573, 6863, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-12 12:50:11', ''),
(574, 2337, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-12 14:03:01', ''),
(575, 1374, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-12 16:13:03', ''),
(576, 7556, '::1', 'kevin', '1234', 0, 0, '2024-04-12 16:33:55', ''),
(577, 3471, '::1', 'kevin', '1234', 0, 0, '2024-04-15 09:29:33', ''),
(578, 7001, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-16 09:37:46', ''),
(579, 6320, '::1', 'kevin', '1234', 0, 0, '2024-04-16 09:37:56', ''),
(580, 6762, '::1', 'kevin', '1234', 0, 0, '2024-04-16 09:56:11', ''),
(581, 7210, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-16 11:08:25', ''),
(582, 7919, '::1', 'kevin', '1234', 0, 0, '2024-04-16 11:09:06', ''),
(583, 2089, '::1', 'admin', 'admin', 0, 1, '2024-04-16 13:48:58', ''),
(584, 3824, '::1', 'admin', 'admin', 0, 1, '2024-04-16 13:49:01', ''),
(585, 1371, '::1', 'admin', 'admin', 0, 1, '2024-04-16 13:49:33', ''),
(586, 3158, '::1', 'admin', '1234', 0, 1, '2024-04-16 13:50:15', ''),
(587, 3901, '::1', 'admin', '1234', 0, 1, '2024-04-16 13:50:18', ''),
(588, 2776, '::1', 'admin', '1234', 0, 0, '2024-04-16 13:50:42', ''),
(589, 6479, '::1', 'kevin', '1234', 0, 0, '2024-04-16 14:39:04', ''),
(590, 3665, '::1', 'kevin', '1234', 0, 0, '2024-04-16 14:42:07', ''),
(591, 6064, '::1', 'admin', '1234', 0, 0, '2024-04-16 14:43:27', ''),
(592, 4279, '::1', 'kevin', '1234', 0, 0, '2024-04-16 14:43:41', ''),
(593, 3329, '::1', 'kevin', '1234', 0, 1, '2024-04-16 14:54:09', ''),
(594, 7404, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-04-16 14:54:30', ''),
(595, 2421, '::1', 'kevin', '1234', 0, 0, '2024-04-16 15:00:48', ''),
(596, 8255, '::1', 'admin', 'admin', 0, 1, '2024-04-16 15:04:45', ''),
(597, 2394, '::1', 'admin', '1234', 0, 0, '2024-04-16 15:04:48', ''),
(598, 6902, '::1', 'kevin', '1234', 0, 0, '2024-04-16 15:31:33', ''),
(599, 3167, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-17 08:49:24', ''),
(600, 4334, '::1', 'admin', 'admin', 0, 1, '2024-04-17 11:50:37', ''),
(601, 7338, '::1', 'admin', '1234', 0, 0, '2024-04-17 11:50:42', ''),
(602, 3800, '::1', 'kevin', '1234', 0, 0, '2024-04-17 11:51:30', ''),
(603, 5583, '::1', 'oliver', '1234', 0, 0, '2024-04-17 12:02:51', ''),
(604, 7021, '::1', 'admin', '1234', 0, 0, '2024-04-17 12:04:35', ''),
(605, 2759, '::1', 'oliver', '1234', 0, 0, '2024-04-17 12:08:57', ''),
(606, 6794, '::1', 'kevin', '1234', 0, 0, '2024-04-17 12:16:34', ''),
(607, 6279, '::1', 'oliver', '1234', 0, 0, '2024-04-17 12:17:29', ''),
(608, 7216, '::1', 'admin', 'admin', 0, 1, '2024-04-17 12:17:39', ''),
(609, 1973, '::1', 'admin', '1234', 0, 0, '2024-04-17 12:17:43', ''),
(610, 4515, '::1', 'oliver', '1234', 0, 0, '2024-04-17 12:18:03', ''),
(611, 4736, '::1', 'kevin', '1234', 0, 0, '2024-04-18 09:38:15', ''),
(612, 3340, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-18 09:39:09', ''),
(613, 2778, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-18 09:39:18', ''),
(614, 6903, '::1', 'kevin', '1234', 0, 0, '2024-04-18 10:36:11', ''),
(615, 2458, '::1', 'admin', 'admin', 0, 1, '2024-04-22 09:53:35', ''),
(616, 2940, '::1', 'admin', '1234', 0, 0, '2024-04-22 09:53:40', ''),
(617, 5310, '::1', 'kevin', '1234', 0, 0, '2024-04-22 10:49:20', ''),
(618, 5531, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-22 11:08:42', ''),
(619, 1841, '::1', 'admin', '1234', 0, 0, '2024-04-22 14:22:52', ''),
(620, 1556, '::1', 'admin', '1234', 0, 0, '2024-04-22 14:59:02', ''),
(621, 7822, '::1', 'admin', '1234', 0, 0, '2024-04-23 09:16:31', ''),
(622, 1511, '::1', 'admin', 'admin', 0, 1, '2024-04-23 09:54:58', ''),
(623, 4569, '::1', 'admin', '1234', 0, 0, '2024-04-23 09:55:03', ''),
(624, 4544, '::1', 'admin', 'admin', 0, 1, '2024-04-23 11:19:29', ''),
(625, 2595, '::1', 'admin', 'admin', 0, 1, '2024-04-23 11:19:32', ''),
(626, 4501, '::1', 'admin', '1234', 0, 0, '2024-04-23 11:19:35', ''),
(627, 8054, '::1', 'kevin', '1234', 0, 0, '2024-04-23 11:39:31', ''),
(628, 4612, '::1', 'admin', 'admin', 0, 1, '2024-04-23 11:55:08', ''),
(629, 6689, '::1', 'admin', '1234', 0, 0, '2024-04-23 11:55:13', ''),
(630, 2393, '::1', 'kevin', '1234', 0, 0, '2024-04-23 14:54:56', ''),
(631, 8583, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-23 15:55:27', ''),
(632, 5074, '::1', 'admin', '1234', 0, 0, '2024-04-23 15:55:42', ''),
(633, 4515, '::1', 'kevin', '1234', 0, 0, '2024-04-23 15:55:49', ''),
(634, 8899, '::1', 'kevin', '1234', 0, 0, '2024-04-24 09:35:02', ''),
(635, 6800, '::1', 'admin', '1234', 0, 0, '2024-04-24 09:35:28', ''),
(636, 2359, '::1', 'kevin', '1234\'', 0, 1, '2024-04-24 09:35:34', ''),
(637, 4046, '::1', 'kevin', '1234', 0, 0, '2024-04-24 09:35:37', ''),
(638, 1461, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-24 15:40:03', ''),
(639, 2841, '::1', 'admin', '1234', 0, 0, '2024-04-25 09:05:40', ''),
(640, 3663, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-25 09:05:50', ''),
(641, 1789, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-25 09:05:55', ''),
(642, 8214, '::1', 'kevin', '1234', 0, 0, '2024-04-25 09:06:02', ''),
(643, 1511, '::1', 'kevin', '1234', 0, 0, '2024-04-25 09:35:17', ''),
(644, 5336, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-25 10:38:32', ''),
(645, 5456, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-25 10:38:37', ''),
(646, 1951, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-25 13:41:06', ''),
(647, 3830, '::1', 'kevin', '1234', 0, 0, '2024-04-25 13:41:13', ''),
(648, 8692, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-25 14:16:49', ''),
(649, 2288, '::1', 'kevin', '1234', 0, 0, '2024-04-25 14:27:15', ''),
(650, 4329, '::1', 'kevin', '1234', 0, 0, '2024-04-25 14:27:38', ''),
(651, 5204, '::1', 'kevin', '1234', 0, 0, '2024-04-25 14:28:52', ''),
(652, 2518, '::1', 'kevin', '1234', 0, 0, '2024-04-25 14:29:47', ''),
(653, 2256, '::1', 'kevin', '1234', 0, 0, '2024-04-26 09:37:20', ''),
(654, 8658, '::1', 'admin', '1234', 0, 0, '2024-04-26 09:37:38', ''),
(655, 5388, '::1', 'kevin', '1234', 0, 0, '2024-04-26 09:37:46', ''),
(656, 8414, '::1', 'tangguanronald@gmail.com', '1234', 0, 1, '2024-04-26 09:38:00', ''),
(657, 4465, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-26 09:38:06', ''),
(658, 8847, '::1', 'tangguanronald@gmail.com', 'ronald', 0, 0, '2024-04-26 11:23:09', ''),
(659, 2489, '::1', 'admin', 'admin', 0, 1, '2024-09-03 13:30:41', ''),
(660, 1079, '::1', 'admin', '1234', 0, 0, '2024-09-03 13:32:41', ''),
(661, 4726, '::1', 'admin', '1234', 0, 0, '2024-09-03 13:38:21', ''),
(662, 5272, '::1', 'admin', '1234', 0, 0, '2024-09-03 13:47:07', ''),
(663, 3226, '::1', 'admin', 'admin', 0, 1, '2024-09-06 14:48:39', ''),
(664, 7304, '::1', 'admin', 'gamechanger', 0, 1, '2024-09-06 14:48:57', ''),
(665, 4917, '::1', 'admin', 'admin', 0, 1, '2024-09-06 14:49:11', ''),
(666, 5502, '::1', 'admin', '1234', 0, 0, '2024-09-06 14:49:38', ''),
(667, 8686, '::1', 'admin', '1234', 0, 0, '2024-09-06 15:11:44', ''),
(668, 1645, '::1', 'admin', 'gamechanger', 0, 1, '2024-09-09 09:33:20', ''),
(669, 8287, '::1', 'admin', '1234', 0, 0, '2024-09-09 09:33:26', ''),
(670, 3986, '::1', 'admin', 'admin', 0, 1, '2024-09-11 08:35:42', ''),
(671, 7937, '::1', 'admin', '1234', 0, 0, '2024-09-11 08:35:47', ''),
(672, 6557, '::1', 'admin', '1234', 0, 0, '2024-09-12 12:02:05', ''),
(673, 2746, '::1', 'admin', '1234', 0, 0, '2024-09-12 13:10:51', ''),
(674, 2070, '::1', 'admin', '1234', 0, 0, '2024-09-12 13:16:38', ''),
(675, 2008, '::1', 'admin', '1234', 0, 0, '2024-09-12 13:16:51', ''),
(676, 7976, '::1', '1234', '12321', 0, 1, '2024-09-12 13:17:04', ''),
(677, 8140, '::1', 'admin', '1234', 0, 0, '2024-09-12 13:17:31', ''),
(678, 6398, '::1', 'admin', '1234', 0, 0, '2024-09-12 13:35:51', ''),
(679, 2673, '::1', 'admin', '1234', 0, 0, '2024-09-12 14:35:16', ''),
(680, 8503, '::1', 'admin', '1234', 0, 0, '2024-09-12 14:35:38', ''),
(681, 5859, '::1', 'admin', '1234', 0, 0, '2024-09-12 16:06:54', ''),
(682, 6172, '::1', 'admin', 'admin', 0, 1, '2024-09-17 16:08:51', ''),
(683, 3903, '::1', 'admin', 'gamechanger', 0, 1, '2024-09-17 16:08:57', ''),
(684, 2089, '::1', 'admin', '1234', 0, 0, '2024-09-17 16:09:15', ''),
(685, 1007, '::1', 'admin', '1234', 0, 0, '2024-09-18 11:25:53', ''),
(686, 6880, '::1', 'errold`', '1234', 0, 1, '2024-09-18 11:26:44', ''),
(687, 7469, '::1', 'errold', '1234', 0, 0, '2024-09-18 11:27:06', ''),
(688, 1680, '::1', 'admin', '1234', 0, 0, '2024-09-18 11:36:06', ''),
(689, 3148, '::1', 'admin', 'admin', 0, 1, '2024-09-23 09:11:43', ''),
(690, 6508, '::1', 'admin', '1234', 0, 0, '2024-09-23 09:11:48', ''),
(691, 2847, '::1', 'admin', '1234', 0, 0, '2024-09-24 10:10:59', ''),
(692, 4400, '::1', 'admin', '1234', 0, 0, '2024-10-08 12:12:06', ''),
(693, 8061, '::1', 'admin', '1234', 0, 0, '2024-10-15 14:33:54', ''),
(694, 6315, '::1', 'admin', '1234', 0, 0, '2024-10-17 08:28:31', ''),
(695, 1349, '::1', 'admin', '1234', 0, 0, '2024-10-18 10:32:19', ''),
(696, 5347, '::1', 'admin', '1234', 0, 0, '2024-10-21 09:34:18', ''),
(697, 1786, '::1', 'admin', '1234', 0, 0, '2024-10-21 09:46:56', ''),
(698, 7687, '::1', 'admin', '1234', 0, 1, '2024-12-05 15:48:51', ''),
(699, 5031, '::1', 'admin', '1234', 0, 1, '2024-12-05 15:48:57', ''),
(700, 6070, '::1', 'admin', '1234', 0, 1, '2024-12-05 15:51:48', ''),
(701, 7862, '::1', 'admin', '1234', 0, 1, '2024-12-05 15:52:36', ''),
(702, 7590, '::1', 'admin@gmail.com', '1234', 0, 0, '2024-12-05 16:00:29', ''),
(703, 8868, '::1', 'admin', 'admin', 0, 1, '2024-12-06 10:44:55', ''),
(704, 2649, '::1', 'admin@gmail.com', '1234', 0, 0, '2024-12-06 10:45:20', ''),
(705, 4639, '::1', 'admin', '1234', 0, 1, '2024-12-06 16:29:57', ''),
(706, 6336, '::1', 'admin', '1234', 0, 1, '2024-12-06 16:35:00', ''),
(707, 4555, '::1', 'admin', '1234', 0, 1, '2024-12-06 16:35:21', ''),
(708, 5671, '::1', 'admin', '1234', 0, 1, '2024-12-06 16:39:20', ''),
(709, 5838, '::1', 'admin', '1234', 0, 1, '2024-12-06 16:39:46', ''),
(710, 8163, '::1', 'admin@gmail.com', '1234', 0, 0, '2024-12-06 16:40:23', ''),
(711, 7390, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-12-09 09:49:07', ''),
(712, 5749, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-12-09 11:04:14', '');
INSERT INTO `tr_login_attempt` (`id`, `rand`, `ip`, `username`, `password`, `status`, `auth`, `datetime`, `idnumber`) VALUES
(713, 7808, '::1', 'admin@gmail.com', '1234', 0, 0, '2024-12-09 11:06:18', ''),
(714, 1637, '::1', 'kevin@gmail.com', '1234', 0, 0, '2024-12-09 11:06:26', ''),
(715, 5510, '::1', 'admin@gmail.com', '1234', 0, 0, '2024-12-10 09:52:39', ''),
(716, 7444, '::1', 'kevin@gmail.com', '1234', 0, 1, '2024-12-10 09:53:37', ''),
(717, 8874, '::1', 'kevin', '1234', 0, 0, '2024-12-10 09:54:11', ''),
(718, 5450, '192.168.68.115', 'kevin', '1234', 0, 0, '2024-12-10 10:26:08', ''),
(719, 7378, '192.168.1.23', 'kevin', '1234', 0, 0, '2024-12-13 15:01:27', ''),
(720, 3748, '::1', 'kevin', '1234', 0, 0, '2024-12-17 10:40:57', ''),
(721, 5392, '::1', 'benz', '1234', 0, 0, '2024-12-17 14:03:26', ''),
(722, 3050, '::1', 'benz', '1234', 0, 0, '2024-12-18 13:20:06', ''),
(723, 2831, '192.168.1.19', 'benz', '1234', 0, 0, '2024-12-18 13:31:45', ''),
(724, 1751, '::1', 'benz', '1234', 0, 0, '2024-12-19 10:52:56', ''),
(725, 6029, '::1', 'kevin', '1234', 0, 0, '2024-12-19 10:53:06', ''),
(726, 8576, '192.168.1.16', 'kevin', '1234', 0, 0, '2024-12-20 14:42:49', ''),
(727, 3183, '192.168.1.14', 'benz', '1234', 0, 0, '2024-12-22 22:06:13', ''),
(728, 6586, '192.168.1.14', 'kevin', '1234', 0, 0, '2024-12-22 22:06:46', ''),
(729, 7912, '::1', 'benz', '1234', 0, 0, '2024-12-22 22:48:32', ''),
(730, 5382, '192.168.1.2', 'kevin', '1234', 0, 0, '2024-12-23 10:08:43', ''),
(731, 4651, '::1', 'benz', '1234', 0, 0, '2024-12-23 11:09:11', ''),
(732, 8710, '::1', 'benz', '1234', 0, 0, '2024-12-26 10:22:30', ''),
(733, 4776, '::1', 'errold', '1234', 0, 1, '2024-12-26 11:14:48', ''),
(734, 5153, '::1', 'errold', '1234', 0, 0, '2024-12-26 11:15:42', ''),
(735, 1215, '::1', 'benz', '1234', 0, 0, '2024-12-26 13:50:39', ''),
(736, 2707, '::1', 'kevin', '1234', 0, 0, '2024-12-27 13:19:25', ''),
(737, 5269, '::1', 'kevin', '1234', 0, 0, '2025-01-02 10:14:07', ''),
(738, 4062, '::1', 'kevin', '1234', 0, 0, '2025-01-08 14:37:59', ''),
(739, 8332, '::1', 'kevin', '1234', 0, 0, '2025-01-09 10:40:09', ''),
(740, 4403, '::1', 'benz', '1234', 0, 0, '2025-01-09 10:49:02', ''),
(741, 5395, '::1', 'kevin', '1234', 0, 0, '2025-01-09 10:55:29', ''),
(742, 6244, '192.168.1.5', 'Kevin', '1234', 0, 0, '2025-01-09 13:18:21', ''),
(743, 2856, '192.168.1.5', 'kevin', '1234', 0, 0, '2025-01-09 13:49:00', ''),
(744, 7798, '::1', 'errold', '1234', 0, 0, '2025-01-09 13:51:16', ''),
(745, 4601, '::1', 'kevin', '1234', 0, 0, '2025-01-09 13:52:14', ''),
(746, 7759, '::1', 'kevin', '1234', 0, 0, '2025-01-10 09:59:07', ''),
(747, 5302, '::1', 'kevin', '1234', 0, 0, '2025-01-10 10:32:24', ''),
(748, 1144, '::1', 'errold', '1234', 0, 0, '2025-01-10 11:59:01', ''),
(749, 7649, '::1', 'kevin', '1234', 0, 0, '2025-01-10 13:35:17', ''),
(750, 1264, '::1', 'admin', 'admin', 0, 1, '2025-01-10 13:45:59', ''),
(751, 1123, '::1', 'admin', '1234', 0, 1, '2025-01-10 13:46:04', ''),
(752, 8259, '::1', 'admin', '1234', 0, 0, '2025-01-10 13:46:29', ''),
(753, 6630, '::1', 'admin', 'admin', 0, 1, '2025-01-10 13:46:35', ''),
(754, 7291, '::1', 'admin', 'admin', 0, 1, '2025-01-10 13:46:39', ''),
(755, 3696, '::1', 'admin', '1234', 0, 0, '2025-01-10 13:46:48', ''),
(756, 4620, '::1', 'admin', '1234', 0, 0, '2025-01-10 13:47:25', ''),
(757, 3043, '::1', 'admin', '1234', 0, 0, '2025-01-10 13:48:30', ''),
(758, 5746, '::1', 'admin', '1234', 0, 0, '2025-01-10 13:49:52', ''),
(759, 5135, '::1', 'benz', '1234', 0, 0, '2025-01-10 14:14:21', ''),
(760, 5133, '::1', 'kevin', '1234', 0, 0, '2025-01-10 14:45:15', ''),
(761, 4820, '192.168.1.7', 'hadden@gmail.com', '1234', 0, 1, '2025-01-10 15:37:46', ''),
(762, 8837, '192.168.1.7', 'hadden', '1234', 0, 1, '2025-01-10 15:37:55', ''),
(763, 3897, '::1', 'hadden@gmail.com', '1234', 0, 1, '2025-01-10 15:39:09', ''),
(764, 3675, '::1', 'hadden@gmail.com', '1234', 0, 0, '2025-01-10 15:41:34', ''),
(765, 5684, '192.168.1.7', 'hadden', '1234', 0, 1, '2025-01-10 15:41:47', ''),
(766, 7413, '192.168.1.7', 'hadden@gmail.com', '1234', 0, 0, '2025-01-10 15:41:55', ''),
(767, 5682, '192.168.1.7', 'kevin', '1234', 0, 0, '2025-01-10 16:04:35', ''),
(768, 8280, '::1', 'kevin', '1234', 0, 0, '2025-01-10 16:06:04', ''),
(769, 4465, '::1', 'kevin', '1234', 0, 0, '2025-01-13 10:57:57', ''),
(770, 5402, '::1', 'kevin', '1234', 0, 0, '2025-01-13 11:28:56', ''),
(771, 5848, '::1', 'admin', 'admin', 0, 1, '2025-01-13 11:31:06', ''),
(772, 7941, '::1', 'admin', '1234', 0, 0, '2025-01-13 11:31:11', ''),
(773, 7689, '::1', 'sdafd', 'dfasdf', 0, 1, '2025-01-13 11:35:09', ''),
(774, 1620, '::1', 'sdafd', 'dfasdf', 0, 1, '2025-01-13 11:38:02', ''),
(775, 1771, '::1', 'kevin', '1234', 0, 0, '2025-01-14 10:08:32', ''),
(776, 2409, '::1', 'errold', '1234', 0, 0, '2025-01-14 10:18:01', ''),
(777, 6034, '::1', 'admin', 'admin', 0, 1, '2025-01-14 10:19:26', ''),
(778, 7719, '::1', '2321312', '12312312', 0, 1, '2025-01-14 10:21:33', ''),
(779, 6009, '::1', '12321', '123123', 0, 1, '2025-01-14 10:27:45', ''),
(780, 5708, '::1', '12321', '123123', 0, 1, '2025-01-14 10:31:04', ''),
(781, 2416, '::1', '12321', '123123', 0, 1, '2025-01-14 10:31:12', ''),
(782, 3616, '::1', '21312321', '12321', 0, 1, '2025-01-14 10:33:56', ''),
(783, 3032, '::1', '12321', '12321', 0, 1, '2025-01-14 10:34:01', ''),
(784, 3608, '::1', '21312', '12312', 0, 1, '2025-01-14 10:34:35', ''),
(785, 1744, '::1', '21312', '12312', 0, 1, '2025-01-14 10:37:08', ''),
(786, 7195, '::1', '21312', '12312', 0, 1, '2025-01-14 10:37:16', ''),
(787, 7575, '::1', '21312', '12312', 0, 1, '2025-01-14 10:39:37', ''),
(788, 5289, '::1', '21312', '12312', 0, 1, '2025-01-14 10:41:28', ''),
(789, 1475, '::1', '21312', '12312', 0, 1, '2025-01-14 10:41:31', ''),
(790, 3089, '::1', '21312', '12312', 0, 1, '2025-01-14 10:42:03', ''),
(791, 7610, '::1', '21312', '12312', 0, 1, '2025-01-14 10:42:10', ''),
(792, 6451, '::1', '21312', '12312', 0, 1, '2025-01-14 10:42:41', ''),
(793, 3178, '::1', '21312', '12312', 0, 1, '2025-01-14 10:43:23', ''),
(794, 5110, '::1', '21312', '12312', 0, 1, '2025-01-14 10:44:19', ''),
(795, 3243, '::1', '21312', '12312', 0, 1, '2025-01-14 10:44:47', ''),
(796, 7678, '::1', '21312', '12312', 0, 1, '2025-01-14 10:48:25', ''),
(797, 3962, '::1', '21312', '12312', 0, 1, '2025-01-14 10:49:08', ''),
(798, 8665, '::1', '21312', '12312', 0, 1, '2025-01-14 10:49:42', ''),
(799, 6778, '::1', '21312', '12312', 0, 1, '2025-01-14 10:49:47', ''),
(800, 8228, '::1', '21312', '12312', 0, 1, '2025-01-14 10:50:09', ''),
(801, 1512, '::1', '21312', '12312', 0, 1, '2025-01-14 10:50:21', ''),
(802, 1446, '::1', '112312', '312312', 0, 1, '2025-01-14 10:52:50', ''),
(803, 6957, '::1', '112312', '312312', 0, 1, '2025-01-14 10:54:18', ''),
(804, 6342, '::1', '112312', '312312', 0, 1, '2025-01-14 10:57:05', ''),
(805, 3141, '::1', '112312', '312312', 0, 1, '2025-01-14 10:57:19', ''),
(806, 3516, '::1', '112312', '312312', 0, 1, '2025-01-14 10:57:28', ''),
(807, 2940, '::1', '112312', '312312', 0, 1, '2025-01-14 10:58:03', ''),
(808, 1823, '::1', '112312', '312312', 0, 1, '2025-01-14 11:03:29', ''),
(809, 1689, '::1', '112312', '312312', 0, 1, '2025-01-14 11:03:42', ''),
(810, 7160, '::1', '21312', '312312', 0, 1, '2025-01-14 11:03:55', ''),
(811, 1358, '::1', '21312', '312312', 0, 1, '2025-01-14 11:05:41', ''),
(812, 7659, '::1', '21312', '312312', 0, 1, '2025-01-14 11:05:52', ''),
(813, 3003, '::1', 'admin', '1234', 0, 0, '2025-01-14 11:06:14', ''),
(814, 3938, '::1', 'asdasdas', 'dasdas', 0, 1, '2025-01-14 11:21:47', ''),
(815, 7446, '::1', 'asdasdas', 'dasdas', 0, 1, '2025-01-14 11:21:56', ''),
(816, 4240, '::1', 'admin', '1234', 0, 0, '2025-01-14 11:22:05', ''),
(817, 8480, '::1', 'admin', '1234', 0, 0, '2025-01-14 14:00:47', ''),
(818, 5055, '::1', 'admin', 'admin', 0, 1, '2025-01-15 09:34:00', ''),
(819, 7412, '::1', 'admin', '1234', 0, 0, '2025-01-15 09:34:04', ''),
(820, 6558, '::1', '12321', '12321321', 0, 1, '2025-01-15 10:07:41', ''),
(821, 5387, '::1', 'admin', '1234', 0, 0, '2025-01-15 10:08:54', ''),
(822, 6869, '::1', 'kevin', '1234', 0, 0, '2025-01-15 13:12:31', ''),
(823, 1535, '::1', 'kevin', '1234', 0, 0, '2025-01-15 13:15:46', ''),
(824, 6757, '::1', 'admin', 'admin', 0, 1, '2025-01-15 13:16:12', ''),
(825, 3857, '::1', 'admin', '1234', 0, 0, '2025-01-15 13:16:17', ''),
(826, 2739, '::1', 'kevin', '1234', 0, 0, '2025-01-15 13:16:31', ''),
(827, 8313, '::1', 'admin', 'admin', 0, 1, '2025-01-15 13:18:50', ''),
(828, 5351, '::1', 'admin', '1234', 0, 0, '2025-01-15 13:18:55', ''),
(829, 6401, '::1', 'kevin', '1234', 0, 0, '2025-01-15 13:41:28', ''),
(830, 4563, '::1', 'benz', '1234', 0, 0, '2025-01-15 13:42:34', ''),
(831, 4938, '::1', 'errold', '1234', 0, 0, '2025-01-15 15:06:52', ''),
(832, 7846, '::1', 'errold', '1234', 0, 0, '2025-01-15 15:07:41', ''),
(833, 4652, '::1', 'client', '1234', 0, 1, '2025-01-15 15:08:20', ''),
(834, 6817, '::1', 'benz', '1234', 0, 0, '2025-01-15 15:08:27', ''),
(835, 5832, '::1', 'errold', '1234', 0, 0, '2025-01-15 15:56:00', ''),
(836, 1473, '::1', 'benz', '1234', 0, 0, '2025-01-15 15:58:04', ''),
(837, 3401, '::1', 'errold', '1234', 0, 0, '2025-01-15 16:08:09', ''),
(838, 2912, '::1', 'benz', '1234', 0, 0, '2025-01-15 16:09:47', ''),
(839, 6909, '::1', 'kevin', '1234', 0, 0, '2025-01-16 09:33:37', ''),
(840, 6912, '::1', 'benz', '1234', 0, 0, '2025-01-16 09:34:11', ''),
(841, 7439, '::1', 'admin', '1234', 0, 0, '2025-01-16 10:39:25', ''),
(842, 1888, '::1', 'kevin', '1234', 0, 0, '2025-01-16 16:31:15', ''),
(843, 4785, '::1', 'admin', 'admin', 0, 1, '2025-01-16 16:32:10', ''),
(844, 4747, '::1', 'admin', '1234', 0, 0, '2025-01-16 16:32:15', ''),
(845, 3430, '::1', 'kevin', '1234', 0, 0, '2025-01-16 16:46:29', ''),
(846, 5797, '::1', 'Benz', '1234', 0, 0, '2025-01-17 10:26:46', ''),
(847, 4084, '::1', 'admin', 'admin', 0, 1, '2025-01-17 10:28:59', ''),
(848, 7400, '::1', 'admin', '1234', 0, 0, '2025-01-17 10:29:04', ''),
(849, 8230, '::1', 'kevin', '1234', 0, 0, '2025-01-17 11:29:36', ''),
(850, 4032, '::1', 'admin', 'admin', 0, 1, '2025-01-17 11:34:02', ''),
(851, 1741, '::1', 'admin', '1234', 0, 0, '2025-01-17 11:34:06', ''),
(852, 7011, '::1', 'admin', '1234', 0, 0, '2025-01-17 11:57:51', ''),
(853, 7793, '::1', 'kevin', '1234', 0, 0, '2025-01-17 11:58:02', ''),
(854, 4227, '::1', 'benz', '1234', 0, 0, '2025-01-17 12:02:49', ''),
(855, 7694, '::1', 'kevin', '1234', 0, 0, '2025-01-17 14:40:00', ''),
(856, 3914, '::1', 'admin', 'admin', 0, 1, '2025-01-19 20:00:06', ''),
(857, 6297, '::1', 'kevin', '1234', 0, 0, '2025-01-19 20:00:13', ''),
(858, 7053, '::1', 'kevin', '1234', 0, 0, '2025-01-19 21:59:49', ''),
(859, 6968, '::1', 'kevin', '1234', 0, 0, '2025-01-19 22:04:20', ''),
(860, 1804, '::1', 'benz', '1234', 0, 0, '2025-01-20 00:03:41', ''),
(861, 1130, '::1', 'kevin', '1234', 0, 0, '2025-01-20 09:13:19', ''),
(862, 5909, '::1', 'benz', '1234', 0, 0, '2025-01-20 09:14:30', ''),
(863, 8393, '::1', 'kevin', '1234', 0, 0, '2025-01-20 09:29:13', ''),
(864, 1277, '::1', 'benz', '1234', 0, 0, '2025-01-20 09:44:43', ''),
(865, 4723, '::1', 'admin', 'admin', 0, 1, '2025-01-21 13:19:25', ''),
(866, 6952, '::1', 'admin', '1234', 0, 0, '2025-01-21 13:19:29', ''),
(867, 7260, '::1', 'admin', '1234', 0, 0, '2025-01-21 16:35:35', ''),
(868, 8618, '::1', 'benz', '1234', 0, 0, '2025-01-22 09:46:51', ''),
(869, 8534, '::1', 'benz', '1234', 0, 0, '2025-01-22 10:56:56', ''),
(870, 6848, '::1', 'kevin', '1234', 0, 0, '2025-01-22 16:04:33', ''),
(871, 5567, '::1', 'benz', '1234', 0, 0, '2025-01-22 16:04:45', ''),
(872, 6569, '::1', 'kevin', '1234', 0, 0, '2025-01-23 16:28:33', ''),
(873, 4077, '::1', 'benz', '1234', 0, 0, '2025-01-27 13:42:09', ''),
(874, 2374, '::1', 'benz', '1234', 0, 0, '2025-01-27 16:54:24', ''),
(875, 5849, '::1', 'kevin', '1234', 0, 0, '2025-01-29 13:06:06', ''),
(876, 6491, '::1', 'benz', '1234', 0, 0, '2025-01-29 13:11:34', ''),
(877, 6128, '::1', 'kevin', '1234', 0, 0, '2025-01-29 19:38:39', ''),
(878, 3264, '::1', 'benz', '1234', 0, 0, '2025-01-29 19:57:30', ''),
(879, 4827, '::1', 'kevin', '1234', 0, 0, '2025-01-29 19:59:33', ''),
(880, 7420, '::1', 'errold', '1234', 0, 0, '2025-01-29 20:03:50', ''),
(881, 5565, '::1', 'kevin', '1234', 0, 0, '2025-01-30 12:52:35', ''),
(882, 1996, '::1', 'benz', '1234', 0, 0, '2025-01-30 14:10:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `tr_otp`
--

CREATE TABLE `tr_otp` (
  `ra_id` int(50) NOT NULL,
  `e_id` int(50) NOT NULL DEFAULT 0,
  `email` varchar(150) DEFAULT NULL,
  `verification` varchar(150) DEFAULT NULL,
  `request_by` varchar(150) DEFAULT NULL,
  `date_request` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_otp`
--

INSERT INTO `tr_otp` (`ra_id`, `e_id`, `email`, `verification`, `request_by`, `date_request`) VALUES
(19, 1150, 'cortez.kevin0914@gmail.com', 'PPB8NT', '', '2025-01-08 16:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `tr_recover_account`
--

CREATE TABLE `tr_recover_account` (
  `ra_id` int(50) NOT NULL,
  `e_id` int(50) NOT NULL DEFAULT 0,
  `email` varchar(150) DEFAULT NULL,
  `verification` varchar(150) DEFAULT NULL,
  `request_by` varchar(150) DEFAULT NULL,
  `date_request` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_recover_account`
--

INSERT INTO `tr_recover_account` (`ra_id`, `e_id`, `email`, `verification`, `request_by`, `date_request`) VALUES
(19, 1150, 'cortez.kevin0914@gmail.com', 'PPB8NT', '', '2025-01-08 16:43:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_services`
--
ALTER TABLE `accepted_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `serProvId` (`user_id`) USING BTREE;

--
-- Indexes for table `bs_client`
--
ALTER TABLE `bs_client`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `bs_page`
--
ALTER TABLE `bs_page`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `bs_report`
--
ALTER TABLE `bs_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `bs_review`
--
ALTER TABLE `bs_review`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `bs_setting`
--
ALTER TABLE `bs_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `bs_time`
--
ALTER TABLE `bs_time`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `bs_user`
--
ALTER TABLE `bs_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ind_maincat`
--
ALTER TABLE `ind_maincat`
  ADD PRIMARY KEY (`sercatid`);

--
-- Indexes for table `ind_subcat`
--
ALTER TABLE `ind_subcat`
  ADD PRIMARY KEY (`subcatid`),
  ADD KEY `main_id` (`main_id`);

--
-- Indexes for table `in_affiliate`
--
ALTER TABLE `in_affiliate`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `in_awrec`
--
ALTER TABLE `in_awrec`
  ADD PRIMARY KEY (`arid`);

--
-- Indexes for table `in_client`
--
ALTER TABLE `in_client`
  ADD PRIMARY KEY (`clid`);

--
-- Indexes for table `in_cliref`
--
ALTER TABLE `in_cliref`
  ADD PRIMARY KEY (`crid`);

--
-- Indexes for table `in_seroff`
--
ALTER TABLE `in_seroff`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `in_serprod`
--
ALTER TABLE `in_serprod`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `tbl_balance`
--
ALTER TABLE `tbl_balance`
  ADD PRIMARY KEY (`bal_id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_comadd`
--
ALTER TABLE `tbl_comadd`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`com_id`) USING BTREE;

--
-- Indexes for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedId`);

--
-- Indexes for table `tbl_independent`
--
ALTER TABLE `tbl_independent`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `tbl_management`
--
ALTER TABLE `tbl_management`
  ADD PRIMARY KEY (`manageId`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`posid`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `tbl_topup`
--
ALTER TABLE `tbl_topup`
  ADD PRIMARY KEY (`cashId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tr_log`
--
ALTER TABLE `tr_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_login_attempt`
--
ALTER TABLE `tr_login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_otp`
--
ALTER TABLE `tr_otp`
  ADD PRIMARY KEY (`ra_id`);

--
-- Indexes for table `tr_recover_account`
--
ALTER TABLE `tr_recover_account`
  ADD PRIMARY KEY (`ra_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_services`
--
ALTER TABLE `accepted_services`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bs_client`
--
ALTER TABLE `bs_client`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1195;

--
-- AUTO_INCREMENT for table `bs_page`
--
ALTER TABLE `bs_page`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bs_report`
--
ALTER TABLE `bs_report`
  MODIFY `report_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1019;

--
-- AUTO_INCREMENT for table `bs_review`
--
ALTER TABLE `bs_review`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bs_setting`
--
ALTER TABLE `bs_setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT for table `bs_time`
--
ALTER TABLE `bs_time`
  MODIFY `time_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `bs_user`
--
ALTER TABLE `bs_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1202;

--
-- AUTO_INCREMENT for table `ind_maincat`
--
ALTER TABLE `ind_maincat`
  MODIFY `sercatid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ind_subcat`
--
ALTER TABLE `ind_subcat`
  MODIFY `subcatid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `in_affiliate`
--
ALTER TABLE `in_affiliate`
  MODIFY `aid` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `in_awrec`
--
ALTER TABLE `in_awrec`
  MODIFY `arid` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `in_client`
--
ALTER TABLE `in_client`
  MODIFY `clid` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `in_cliref`
--
ALTER TABLE `in_cliref`
  MODIFY `crid` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_seroff`
--
ALTER TABLE `in_seroff`
  MODIFY `spid` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `in_serprod`
--
ALTER TABLE `in_serprod`
  MODIFY `spid` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_balance`
--
ALTER TABLE `tbl_balance`
  MODIFY `bal_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_comadd`
--
ALTER TABLE `tbl_comadd`
  MODIFY `ca_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `com_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedId` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_independent`
--
ALTER TABLE `tbl_independent`
  MODIFY `in_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `l_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_management`
--
ALTER TABLE `tbl_management`
  MODIFY `manageId` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `posid` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `subid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_topup`
--
ALTER TABLE `tbl_topup`
  MODIFY `cashId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tr_log`
--
ALTER TABLE `tr_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `tr_login_attempt`
--
ALTER TABLE `tr_login_attempt`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=883;

--
-- AUTO_INCREMENT for table `tr_otp`
--
ALTER TABLE `tr_otp`
  MODIFY `ra_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tr_recover_account`
--
ALTER TABLE `tr_recover_account`
  MODIFY `ra_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
