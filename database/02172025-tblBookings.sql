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
  `contact_num` text DEFAULT NULL,
  `booking_status` enum('pending','accepted') DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `bookings_image` varchar(50) DEFAULT NULL,
  `bookings_thumbnail` varchar(50) DEFAULT NULL,
  `roomNo` int(50) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `service_id` (`service_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_onehome.tbl_bookings: ~5 rows (approximately)
INSERT INTO `tbl_bookings` (`booking_id`, `user_id`, `service_id`, `requested_service`, `booking_address`, `contact_num`, `booking_status`, `created_at`, `updated_at`, `bookings_image`, `bookings_thumbnail`, `roomNo`) VALUES
	(1, 1190, NULL, 'Concrete and Bricks', 'Guimbala-on National High School, Guimbala-on, Silay, Negros Occidental, Negros Island Region, 6116,', '547868554', 'accepted', '2025-02-26', NULL, NULL, NULL, 4),
	(2, 1190, NULL, 'Tile Repair', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '979654657', 'accepted', '2025-02-21', NULL, NULL, NULL, 8),
	(3, 1190, NULL, 'Cover Pipe Repairs', 'Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines', '4376765767', 'accepted', '2025-02-15', NULL, NULL, NULL, 6),
	(4, 1190, NULL, 'Leak Detections', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '45945034934', 'accepted', '2025-02-20', NULL, NULL, NULL, 6),
	(5, 1190, NULL, 'Circuit Breaker', 'Ayala North Point Technohub, Mabini Street, Zone 15, Talisay, Negros Occidental, Negros Island Regio', '5675676576', 'accepted', '2025-02-25', NULL, NULL, NULL, 7);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
