CREATE SCHEMA `meus_recibos` DEFAULT CHARACTER SET latin1 ;

-- Create tables
-- 1.1
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `dt_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- 1.2
DROP TABLE IF EXISTS `receipts`;
CREATE TABLE `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `receipt_file` varchar(250) NOT NULL,
  `amount` float(15,2) NOT NULL,
  `dt_receipt` date NOT NULL,
  `dt_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id_FK_clients_idx` (`client_id`),
  CONSTRAINT `client_id_FK_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- 2.1
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(80) NOT NULL,
  `dt_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;