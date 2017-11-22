SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `ed_words`;
DROP TABLE IF EXISTS `ed_users`;

CREATE TABLE `ed_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL UNIQUE,
  `email` varchar(30) NOT NULL UNIQUE,
  `password` varchar(32) NOT NULL,
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ed_words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eng` varchar(20) NOT NULL,
  `rus` varchar(20) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`owner`) REFERENCES `ed_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
