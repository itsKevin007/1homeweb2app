-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 03:34 AM
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
  `nav_tutorial` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_logout` timestamp NOT NULL DEFAULT current_timestamp(),
  `uid` varchar(170) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_user`
--

INSERT INTO `bs_user` (`user_id`, `firstname`, `middlename`, `lastname`, `email`, `pos_id`, `username`, `password`, `pass_text`, `email_verified_at`, `verification_code`, `title`, `contactno`, `address`, `image`, `thumbnail`, `subDate`, `is_sub`, `sub_type`, `is_admin`, `access_level`, `date_added`, `added_by`, `date_modified`, `modified_by`, `date_deleted`, `deleted_by`, `is_deleted`, `nav_tutorial`, `is_active`, `last_login`, `last_logout`, `uid`) VALUES
(1002, 'Super Admin', 'ads', 'Super Admin', 'superadmin@gmail.com', 1, 'superadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '0000-00-00 00:00:00.000000', '247156', 'Senior Programmer', '123456789', 'Bacolod City', '2bba929d092056000351e51da78e23be.png', 'e1f178d18ad4c37117985eab2f05b32f.png', NULL, 0, 0, 1, 1, '2022-11-09 19:09:24', 0, '2024-10-21 15:27:46', 1002, NULL, 0, 0, 0, 0, '2025-01-15 02:31:44', '2025-01-08 06:37:42', 'fba9d88164f3e2d9109ee770223212a0'),
(1003, 'Admin', '', 'Admin', 'admin@gmail.com', 0, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, '', '09876543210', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2bba929d092056000351e51da78e23be.png', 'e1f178d18ad4c37117985eab2f05b32f.png', NULL, 0, 0, 1, 1, '2023-07-27 14:50:24', 1002, '2024-04-10 17:59:47', 1177, '', 0, 0, 0, 1, '2025-01-21 08:35:35', '2025-01-10 05:47:13', '8f1d43620bc6bb580df6e80b0dc05c48'),
(1150, 'Kevin', '', 'Cortez', 'cortez.kevin0914@gmail.com', 0, 'kevin', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '2024-04-10 09:48:45.000000', '247156', '', '0966546565', 'BC', '92795e94d8d5d6228d695b0fd5adab6d.png', 'fd94dc31d5ead622668c61b36a3ec486.png', '2025-01-15', 1, 0, 0, 1, '2024-03-08 09:44:14', 1002, '2024-12-10 09:53:05', 1003, '2025-02-24 16:11:48', 0, 0, 1, 1, '2025-02-28 01:52:40', '2025-02-28 01:52:34', '2b38c2df6a49b97f706ec9148ce48d86'),
(1188, 'Errold', '', 'Calvo', 'Errold@gmail.com', 0, 'errold', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, '', '123', 'BC', 'd5a8278369550f3daa98864b30af7746.png', 'fa516964113604c9ecd05b311a254827.png', NULL, 0, 0, 0, 2, '2024-09-18 11:07:23', 1002, '2024-09-18 11:15:14', 1002, '', 0, 0, 0, 0, '2025-01-30 01:46:05', '2025-01-30 01:46:05', 'c44e503833b64e9f27197a484f4257c0'),
(1189, 'Errold', '', 'Calvo', 'test@gmail.com', 0, 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, '', '123', 'BC', '0c703dd979603d22086cb8e79a6fb893.png', 'd6c09692fff54ca7af3c4ad702f94094.png', NULL, 0, 0, 0, 0, '2024-09-18 11:26:25', 1002, '2024-10-21 15:42:46', 1002, NULL, 0, 0, 0, 1, '2024-10-21 07:42:46', '2024-09-18 03:26:25', '82c2559140b95ccda9c6ca4a8b981f1e'),
(1190, 'Benz', NULL, 'Lozada', 'benz@gmail.com', NULL, 'benz', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, NULL, NULL, '123456', 'talisay city', '0c21da512930f6c4a0ff08ded307a943.png', 'ae4a65946e0548851aaa1cf4f53964fa.png', '', 0, 1, 0, 0, '2024-12-12 15:29:19', 1150, '2025-01-20 10:00:29', 1190, NULL, 0, 0, 1, 0, '2025-02-28 01:48:02', '2025-02-28 01:48:02', '160c88652d47d0be60bfbfed25111412'),
(1192, 'Abel', 'Daphne Preston', 'Hoover', 'qigehudo@mailinator.com', NULL, 'qigehudo@mailinator.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, '+1 (857) 174-1493', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-02 08:06:44', '2025-01-02 08:06:44', '52292e0c763fd027c6eba6b8f494d2eb'),
(1193, 'Ronald', 'Pagran', 'Tangguan', 'Ronald@gmail.com', NULL, 'Ronald@gmail.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL, '123456789', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 03:05:26', '2025-01-03 03:05:26', '9a3d458322d70046f63dfd8b0153ece4'),
(1194, 'Allistair', 'Porter Figueroa', 'Russo', 'sutod@mailinator.com', NULL, 'sutod@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (608) 631-8449', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 03:07:28', '2025-01-03 03:07:28', 'a42a596fc71e17828440030074d15e74'),
(1195, 'Allistair', 'Porter Figueroa', 'Russo', 'sutod123@mailinator.com', NULL, 'sutod123@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (608) 631-8449', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 03:07:53', '2025-01-03 03:07:53', '0188e8b8b014829e2fa0f430f0a95961'),
(1196, 'Patricia', 'Gage Ashley', 'Levine', 'hewomibe@mailinator.com', NULL, 'hewomibe@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (689) 575-8136', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 03:08:46', '2025-01-03 03:08:46', '9adeb82fffb5444e81fa0ce8ad8afe7a'),
(1197, 'Bell', NULL, NULL, 'cosucu@mailinator.com', NULL, 'cosucu@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (503) 607-9547', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 06:25:40', '2025-01-03 06:25:40', 'ae5e3ce40e0404a45ecacaaf05e5f735'),
(1198, 'Myles', NULL, NULL, 'vynyki@mailinator.com', NULL, 'vynyki@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (461) 771-8908', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 06:26:06', '2025-01-03 06:26:06', 'c54e7837e0cd0ced286cb5995327d1ab'),
(1199, 'Trident', NULL, NULL, 'trident@mail.com', NULL, 'trident@mail.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL, '12345689', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 06:34:19', '2025-01-03 06:34:19', '4d2e7bd33c475784381a64e43e50922f'),
(1200, 'Wynter', NULL, NULL, 'kuberabola123@mailinator.com', NULL, 'kuberabola123@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, NULL, NULL, NULL, '+1 (823) 142-1197', NULL, NULL, NULL, NULL, 0, 0, 0, 1, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-03 06:37:28', '2025-01-03 06:37:28', 'fe2d010308a6b3799a3d9c728ee74244'),
(1201, 'hadden', 'james', 'abarisia', 'hadden@gmail.com', NULL, 'hadden@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, NULL, '123456789', NULL, NULL, NULL, '2025-01-15', 1, 1, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, '2025-01-15 02:40:41', '2025-01-10 08:05:57', '7501e5d4da87ac39d782741cd794002d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bs_user`
--
ALTER TABLE `bs_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bs_user`
--
ALTER TABLE `bs_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1202;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
