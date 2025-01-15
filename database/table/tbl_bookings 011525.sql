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


-- Dumping database structure for db_onehome
CREATE DATABASE IF NOT EXISTS `db_onehome` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_onehome`;

-- Dumping structure for table db_onehome.tbl_bookings
CREATE TABLE IF NOT EXISTS `tbl_bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `requested_service` varchar(50) DEFAULT NULL,
  `booking_address` varchar(100) DEFAULT NULL,
  `contact_num` varchar(50) DEFAULT NULL,
  `booking_status` enum('pending','accepted') DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `service_id` (`service_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_onehome.tbl_bookings: ~3 rows (approximately)
INSERT INTO `tbl_bookings` (`booking_id`, `user_id`, `service_id`, `requested_service`, `booking_address`, `contact_num`, `booking_status`, `created_at`, `updated_at`) VALUES
	(1, 1190, 0, ' Cover Pipe Repairs ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '1', 'accepted', NULL, NULL),
	(2, 1190, 0, ' Tile Repair ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '2', 'accepted', NULL, NULL),
	(5, 1190, 0, ' Cover Pipe Repairs ', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '40405404', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
