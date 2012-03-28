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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=cp1251;

/*Data for the table `comment` */

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=cp1251;

/*Data for the table `country` */

insert  into `country`(`id`,`name`) values (1,'Austria'),(2,'Belgium'),(3,'Bulgaria'),(4,'Cyprus'),(5,'Czech Republic'),(6,'Denmark'),(7,'Estonia'),(8,'Finland'),(9,'France'),(10,'Germany'),(11,'Greece'),(12,'Hungary'),(13,'Ireland'),(14,'Italy'),(15,'Latvia'),(16,'Lithuania'),(17,'Luxembourg'),(18,'Malta'),(19,'Netherlands'),(20,'Poland'),(21,'Portugal'),(22,'Romania'),(23,'Slovakia'),(24,'Slovenia'),(25,'Spain'),(26,'Sweden'),(27,'United Kingdom');

/*Table structure for table `page` */

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `body` longtext NOT NULL,
  `lineno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438191EAA5D4036` (`story_id`),
  CONSTRAINT `FK_B438191EAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

/*Data for the table `page` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F75B25545E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

/*Data for the table `role` */

insert  into `role`(`id`,`name`) values (1,'admin'),(3,'contributor'),(2,'moderator'),(4,'user');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `status` */

insert  into `status`(`id`,`name`) values (1,'Unpublished'),(2,'Published'),(3,'Moderated'),(4,'Blocked');

/*Table structure for table `story` */

DROP TABLE IF EXISTS `story`;

CREATE TABLE `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `meta_place` longtext,
  PRIMARY KEY (`id`),
  KEY `IDX_2A972B3CA76ED395` (`user_id`),
  KEY `IDX_2A972B3CF92F3E70` (`country_id`),
  KEY `IDX_2A972B3C5EEADD3B` (`time_id`),
  KEY `IDX_2A972B3C6BF700BD` (`status_id`),
  CONSTRAINT `FK_2A972B3C5EEADD3B` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`),
  CONSTRAINT `FK_2A972B3C6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_2A972B3CA76ED3951` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2A972B3CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=cp1251;

/*Data for the table `story` */


/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3BC4F1635E237E06` (`name`),
  UNIQUE KEY `UNIQ_3BC4F163989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `tag` */

/*Table structure for table `tagging` */

DROP TABLE IF EXISTS `tagging`;

CREATE TABLE `tagging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL,
  `resource_type` varchar(50) NOT NULL,
  `resource_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B13E8BFBAD26311` (`tag_id`),
  CONSTRAINT `FK_6B13E8BFBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `tagging` */

/*Table structure for table `time` */

DROP TABLE IF EXISTS `time`;

CREATE TABLE `time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=cp1251;

/*Data for the table `time` */

insert  into `time`(`id`,`name`) values (1,'1900'),(2,'1910'),(3,'1920'),(4,'1930'),(5,'1940'),(6,'1950'),(7,'1960'),(8,'1970'),(9,'1980'),(10,'1990'),(11,'2000'),(12,'2010');

/*Table structure for table `topic` */

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=cp1251;

/*Data for the table `topic` */

insert  into `topic`(`id`,`name`) values (1,'WW1'),(2,'WW2'),(3,'Daily life'),(4,'Childhood'),(5,'Games'),(6,'Work'),(7,'Health'),(8,'Architecture'),(9,'Travel'),(10,'Passion'),(11,'Hobbies'),(12,'Music'),(13,'Maps');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `biography` longtext,
  `city` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `birth` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  KEY `IDX_2DA17977F92F3E70` (`country_id`),
  CONSTRAINT `FK_2DA17977F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`salt`,`created_at`,`email`,`first_name`,`last_name`,`country_id`,`biography`,`city`,`photo`,`institution`,`birth`) values (1,'user','userpass','1','2012-02-03 16:57:36','kak222ac2a@mail.ru','Albinas','Bagdonas',1,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(2,'qwe','qwe','2','2012-02-03 16:57:36','kaka23a@mail.ru','Sergey','Belov',5,'Built as a sprite\r\nInstead of making every icon an extra request, we\'ve compiled them into a sprite—a bunch of images in one file that uses CSS to position the images with background-position. This is the same method we use on Twitter.com and it has worked well for us.\r\n\r\nAll icons classes are prefixed with .icon- for proper namespacing and scoping, much like our other components. This will help avoid conflicts with other tools.\r\n\r\nGlyphicons has granted us use of the Halflings set in our open-source toolkit so long as we provide a link and credit here in the docs. Please consider doing the same in your projects.','Obninsk','2.jpg','I.A.T.E.','2012-02-06 00:00:00'),(3,'asdasd','asdasd','123','2012-02-03 16:57:36','kakac442a@mail.ru','Irena','Levi?nik',3,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.',NULL,NULL,NULL,'2012-02-06 15:04:16'),(4,'qweqwe','qweqwe','123','2012-02-03 17:05:30','kakaca@mail.ru','Iva','Pust',4,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(5,'zzz','zzz','123','2012-02-03 17:21:43','qweqwe@zzz.ru','Marija','Povil?nait?',7,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(6,'ssss','ssss','123','2012-02-08 11:35:04','kakac2a@mail.ru','Milan','Pavliha',11,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(7,'ggggg','ggggg','123','2012-02-08 11:35:23','ggggg@mail.ru','Rodica','Bernicus',5,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(8,'qweasdzxc','qweqwe','123','2012-02-08 13:08:08','qweqwe@mail.ru',NULL,NULL,8,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `user_role` */

/*Table structure for table `video` */

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `player_url` varchar(255) NOT NULL,
  `watch_url` varchar(255) NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BD06F52868D3EA09` (`User_id`),
  CONSTRAINT `FK_BD06F52868D3EA09` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `video` */

/*Table structure for table `vote` */

DROP TABLE IF EXISTS `vote`;

CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `value` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unqiue_pair` (`user_id`,`story_id`),
  KEY `IDX_FA222A5AAA5D4036` (`story_id`),
  KEY `IDX_FA222A5AA76ED395` (`user_id`),
  CONSTRAINT `FK_FA222A5AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FA222A5AAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=cp1251;

/*Data for the table `vote` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
