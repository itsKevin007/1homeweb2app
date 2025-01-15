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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `serProvId` int(11) NOT NULL DEFAULT 0,
  `accepted_at` varchar(50) DEFAULT NULL,
  `aAddress` varchar(100) DEFAULT NULL,
  `aContactNo` varchar(15) DEFAULT NULL,
  `aReqServ` varchar(100) DEFAULT NULL,
  `aStatus` int(10) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `serProvId` (`serProvId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table db_onehome.accepted_services: ~1 rows (approximately)
INSERT INTO `accepted_services` (`id`, `service_id`, `serProvId`, `accepted_at`, `aAddress`, `aContactNo`, `aReqServ`, `aStatus`) VALUES
	(1, 1, 1188, '2025-01-14 20:57:47', ' Paseo Mabini, Zone 15, Talisay, Negros Occidental, Negros Island Region, 6115, Philippines ', '00000000001', ' Cover Pipe Repairs ', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
