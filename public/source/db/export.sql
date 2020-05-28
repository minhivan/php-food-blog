-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for Food
CREATE DATABASE IF NOT EXISTS `Food` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `Food`;

-- Dumping structure for table Food.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `decription` mediumtext NOT NULL,
  `img_thumbnails` varchar(255) NOT NULL DEFAULT '',
  `has_child` int(10) unsigned NOT NULL DEFAULT 0,
  `parent_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.cmtCategories
CREATE TABLE IF NOT EXISTS `cmtCategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `decription` mediumtext NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.cmtPost
CREATE TABLE IF NOT EXISTS `cmtPost` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `comment_date` datetime NOT NULL,
  `content` longtext NOT NULL DEFAULT '',
  `has_child` int(10) NOT NULL DEFAULT 0,
  `parent_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_post` (`post_id`),
  KEY `FK_comments_user` (`author_id`),
  KEY `FK_comments_cmtCategories` (`category_id`),
  CONSTRAINT `FK_comments_cmtCategories` FOREIGN KEY (`category_id`) REFERENCES `cmtCategories` (`id`),
  CONSTRAINT `FK_comments_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_comments_user` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.incredients
CREATE TABLE IF NOT EXISTS `incredients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `decription` longtext NOT NULL,
  `img_thumbnails` varchar(255) NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__user` (`author_id`),
  KEY `FK_incredients_incredientCategories` (`category_id`),
  CONSTRAINT `FK__user` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_incredients_incredientCategories` FOREIGN KEY (`category_id`) REFERENCES `incredientsCategories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.incredientsCategories
CREATE TABLE IF NOT EXISTS `incredientsCategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `decription` mediumtext NOT NULL,
  `img_thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `content` longtext NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `comment_count` double NOT NULL DEFAULT 0,
  `categories_id` bigint(10) unsigned NOT NULL,
  `author_id` bigint(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.post_taxamonies
CREATE TABLE IF NOT EXISTS `post_taxamonies` (
  `post_id` bigint(20) unsigned NOT NULL,
  `taxamonies_id` bigint(20) unsigned NOT NULL,
  KEY `FK_post_taxamonies_post` (`post_id`),
  KEY `FK_post_taxamonies_taxamonies` (`taxamonies_id`),
  CONSTRAINT `FK_post_taxamonies_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_post_taxamonies_taxamonies` FOREIGN KEY (`taxamonies_id`) REFERENCES `taxamonies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.recipe
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `decription` mediumtext NOT NULL DEFAULT '',
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.tags_post
CREATE TABLE IF NOT EXISTS `tags_post` (
  `post_id` bigint(20) unsigned NOT NULL,
  `tags_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `FK_tags_post_tags` (`tags_id`),
  CONSTRAINT `FK_tags_post_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_tags_post_tags` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.taxamonies
CREATE TABLE IF NOT EXISTS `taxamonies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `decription` mediumtext NOT NULL DEFAULT '',
  `img_thumbnail` varchar(255) NOT NULL,
  `has_child` int(10) NOT NULL DEFAULT 0,
  `parent_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table Food.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registered` datetime NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
