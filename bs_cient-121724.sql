-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_onehome.bs_client
CREATE TABLE IF NOT EXISTS `bs_client` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `office_add` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- Dumping data for table db_onehome.bs_client: ~3 rows (approximately)
INSERT INTO `bs_client` (`c_id`, `user_id`, `c_fname`, `c_mname`, `c_lname`, `c_suffix`, `nationality`, `birth`, `age`, `govid`, `idnum`, `gender`, `civil`, `email`, `connum`, `region_text`, `province_text`, `city_text`, `barangay_text`, `zipcode`, `subdivision`, `street`, `unit`, `building`, `phase`, `blocklot`, `membership`, `payment`, `amount`, `bank`, `branch`, `checknum`, `accnum`, `billing`, `gateperimeter`, `waiver`, `agree`, `longitude`, `latitude`, `message`, `address`, `image`, `thumbnail`, `date_added`, `added_by`, `date_modified`, `modified_by`, `date_deleted`, `deleted_by`, `is_deleted`, `uid`, `c_username`, `c_password`, `is_active`, `last_login`, `last_logout`, `is_test`, `office_add`) VALUES
	(1, 1002, 'Admin', '', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', '09321321321', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'trident', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '2024-03-18 08:18:05', '2024-03-18 08:12:40', 0, NULL),
	(84, NULL, 'Ronald', 'Pagran', 'Tangguan', '', 'Filipino', '2001-07-17', 23, 'TIN ID', '12331123321', 'Male', 'Single', 'tangguaronald@gmail.com', '09397765466', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Talisay', 'Zone 4 (Pob.)', 6115, '', 'Capt Sabi', '', 'Rolly Hair Salon', '', '', 'Basic', 'cash', '500000', '123321123321', 'Talisay', '123321123321', '123321123321', 'Yes', 'Yes', 'Ronald Tangguan', 'agree', '122.966017', '10.739538', NULL, NULL, NULL, NULL, '2024-10-15 15:34:21', NULL, NULL, NULL, NULL, NULL, 0, '68d30a9594728bc39aa24be94b319d21', NULL, NULL, 0, '2024-10-15 07:34:21', '2024-10-15 07:34:21', 0, NULL),
	(85, 1191, 'Benz', 'Alijid', 'Lozada', '', 'Filipino', '2000-03-10', 24, 'TIN', '1234567890', 'Male', 'Single', 'heheh@gmail.com', '123456789', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Talisay', 'Zone 14 (Pob.)', 6115, '', 'Prk. Mahidaiton', '123', 'Sanparq', '4', 'Blk 10 lot 7', 'Platinum', 'check', '1000', 'BPI', 'Mandalagan', '09876', '0987654321', 'Yes', 'No', 'TEST', 'agree', '122.971832', '10.728494', NULL, NULL, '0e9b058eace4e61ca41cf4f1165d3e21.jpg', '5d77e89e3bce8dde0666639e6fa7a013.jpg', '2024-10-16 22:42:11', NULL, '2024-12-13 10:09:38', 1191, '', 0, 0, '3ef815416f775098fe977004015c6193', NULL, NULL, 0, '2024-12-13 02:09:38', '2024-10-16 14:42:11', 0, 'Brgy. Mandalagan, Bacolod City');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
