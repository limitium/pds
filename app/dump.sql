/*
SQLyog Ultimate - MySQL GUI v8.2 
MySQL - 5.1.40-community : Database - pds
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pds` /*!40100 DEFAULT CHARACTER SET cp1251 */;

USE `pds`;

/*Table structure for table `Role` */

DROP TABLE IF EXISTS `Role`;

CREATE TABLE `Role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F75B25545E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `Role` */

/*Table structure for table `UserRole` */

DROP TABLE IF EXISTS `UserRole`;

CREATE TABLE `UserRole` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_A8503F73A76ED395` (`user_id`),
  KEY `IDX_A8503F73D60322AC` (`role_id`),
  CONSTRAINT `FK_A8503F73D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_A8503F73A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `UserRole` */

/*Table structure for table `comment` */

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0AA5D4036` (`story_id`),
  KEY `IDX_5BC96BF0A76ED395` (`user_id`),
  CONSTRAINT `FK_5BC96BF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_5BC96BF0AA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `comment` */

/*Table structure for table `story` */

DROP TABLE IF EXISTS `story`;

CREATE TABLE `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2A972B3CA76ED395` (`user_id`),
  CONSTRAINT `FK_2A972B3CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

/*Data for the table `story` */

insert  into `story`(`id`,`body`,`created_at`,`user_id`) values (1,'[13:12:25] Андрей Елькин: хехе\r\n[13:14:07] Андрей Елькин: аж бедная скрючилась вся)\r\n[13:18:07] limitium: кто\r\n[13:24:34] Андрей Елькин: картинку посмотри\r\n[13:24:56] limitium: 2 девки\r\n[13:25:08] Андрей Елькин: внимание вопрос\r\n[13:25:18] Андрей Елькин: какая из 2х девок скрючилась?\r\n[13:26:16] limitium: обе норм\r\n[13:26:24] Андрей Елькин: ок!','2012-02-03 17:29:06',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`salt`,`created_at`,`email`) values (1,'user','userpass','1','0000-00-00 00:00:00','1'),(2,'qwe','qwe','2','0000-00-00 00:00:00','2'),(3,'asdasd','asdasd','123','2012-02-03 16:57:36','0'),(4,'qweqwe','qweqwe','123','2012-02-03 17:05:30','kakaca@mail.ru'),(5,'zzz','zzz','123','2012-02-03 17:21:43','qweqwe@zzz.ru');

/*Table structure for table `vote` */

DROP TABLE IF EXISTS `vote`;

CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `value` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA222A5AAA5D4036` (`story_id`),
  KEY `IDX_FA222A5AA76ED395` (`user_id`),
  CONSTRAINT `FK_FA222A5AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FA222A5AAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `vote` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
