-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `artist_name` varchar(255) DEFAULT NULL,
  `release_year` year(4) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `warehouse_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2019-05-06 15:48:38