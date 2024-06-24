-- Dumping database structure for task_manager
CREATE DATABASE IF NOT EXISTS `task_manager` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `task_manager`;

-- Dumping structure for table task_manager.task
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `status` enum('Pending','In Progress','Completed') COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table task_manager.task: ~1 rows (approximately)
DELETE FROM `tasks`;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'test 1', 'test 1', 'Pending', '2024-06-21 15:06:46', '2024-06-21 15:06:48');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
