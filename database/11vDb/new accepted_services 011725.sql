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

-- Dumping structure for table db_onehome.accepted_services
CREATE TABLE IF NOT EXISTS `accepted_services` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `service_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `accepted_at` varchar(50) DEFAULT NULL,
  `aAddress` varchar(100) DEFAULT NULL,
  `aContactNo` varchar(15) DEFAULT NULL,
  `aReqServ` varchar(100) DEFAULT NULL,
  `projectCost` decimal(9,3) DEFAULT NULL,
  `uid` varchar(70) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('accepted','ongoing','done') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `serProvId` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_onehome.accepted_services: ~2 rows (approximately)
INSERT INTO `accepted_services` (`id`, `service_id`, `user_id`, `accepted_at`, `aAddress`, `aContactNo`, `aReqServ`, `projectCost`, `uid`, `status`) VALUES
	(1, 1, 1188, '2025-01-17 16:46:30', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '2525252', ' Burst Pipe or Electrical short ', 200.000, 'c4ca4238a0b923820dcc509a6f75849b', 'ongoing'),
	(2, 2, 1188, '2025-01-17 16:46:45', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '63658', ' Leak Detections ', NULL, 'c81e728d9d4c2f636f067f89cc14862c', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
