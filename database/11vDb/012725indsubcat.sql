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

-- Dumping structure for table db_onehome.ind_subcat
CREATE TABLE IF NOT EXISTS `ind_subcat` (
  `subcatid` int(100) NOT NULL AUTO_INCREMENT,
  `main_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `sub_categor` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `date_modified` varchar(50) DEFAULT NULL,
  `date_deleted` varchar(50) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`subcatid`),
  KEY `main_id` (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='main category of independent service provider';

-- Dumping data for table db_onehome.ind_subcat: ~8 rows (approximately)
INSERT INTO `ind_subcat` (`subcatid`, `main_id`, `user_id`, `sub_categor`, `added_by`, `modified_by`, `deleted_by`, `date_added`, `date_modified`, `date_deleted`, `is_deleted`, `description`) VALUES
	(4, '1', '1150', 'Cover Pipe Repairs', 1150, 1150, NULL, '2024-12-13 14:19:20', '2024-12-16 10:49:06', NULL, 0, ' maintain the safety, functionality, and efficiency of your plumbing or infrastructure system.'),
	(5, '6', '1150', 'Tile Repair', 1150, 1150, NULL, '2024-12-13 14:19:20', '2024-12-16 10:49:06', NULL, 0, 'Cracked, chipped, loose tiles, and replacements'),
	(6, '2', '1150', 'Wiring', 1150, 1150, NULL, '2024-12-13 14:46:57', '2024-12-16 10:49:06', NULL, 0, 'Frayed, damaged, or faulty wiring, and replacements.'),
	(7, '1', '1150', 'Leak Detections', 1150, 1150, NULL, '2024-12-13 14:51:18', '2024-12-16 10:49:06', NULL, 0, 'Hidden leaks, water damage, and repairs.'),
	(8, '2', '1150', 'Circuit Breaker', 1150, 1150, NULL, '2024-12-13 14:51:18', '2024-12-16 10:49:06', NULL, 0, 'Tripped breakers, faulty connections, and replacements.'),
	(9, '6', '1150', 'Concrete and Bricks', 1150, 1150, NULL, '2024-12-13 14:51:18', '2024-12-16 10:49:06', NULL, 0, 'Cracks, damaged surfaces, and replacements.'),
	(10, '11', '1188', 'Cover Fences Repair', 1188, 1188, 1188, '2024-12-27 10:04:09', '2024-12-27 10:05:19', '2024-12-27 10:12:07', 1, 'Broken panels, loose posts, and replacements.'),
	(11, '13', '1188', 'Burst Pipe or Electrical short', 1188, 1188, NULL, '2024-12-27 10:04:09', '2024-12-27 10:05:19', NULL, 0, 'Leaks, shorts, and emergency repairs.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
