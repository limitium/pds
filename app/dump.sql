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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=cp1251;

/*Data for the table `comment` */

insert  into `comment`(`id`,`story_id`,`message`,`created_at`,`user_id`) values (36,29,'This is a nice story!','2012-03-29 18:51:16',9),(37,34,'This is quite boring story. Please imporove it soon!','2012-03-30 16:35:25',9);

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
  `body` longtext,
  `lineno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438191EAA5D4036` (`story_id`),
  CONSTRAINT `FK_B438191EAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `page` */

insert  into `page`(`id`,`story_id`,`body`,`lineno`) values (7,29,'<h4>MyStory presentation from Romania shown idea of the project.</h4>',1),(8,29,'<center><iframe width=\"630\" height=\"473\" src=\"http://www.youtube.com/embed/U_CJZGUTDCg\" frameborder=\"0\" allowfullscreen=\"\"></iframe></center>',2),(9,30,'<h3>A story from Romania.</h3>',1),(10,30,'<center><iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/YMz0eycs4xA?wmode=opaque\" frameborder=\"0\" allowfullscreen=\"\"></iframe></center>',2),(11,31,'<h4>Summary will be here.</h4>',1),(12,31,'<div style=\"text-align: center;\"><centerr><br></centerr></div><centerr><iframe width=\"560\" height=\"315\" src=\"http://www.youtube.com/embed/MKzky9P9Uo4?wmode=opaque\" frameborder=\"0\" allowfullscreen=\"\"></iframe></centerr>',2),(13,32,'<h4>About the story...</h4>',1),(14,32,'<center><br></center><center>\r\n<iframe width=\"640\" height=\"480\" src=\"http://www.youtube.com/embed/kQxKRVGRdCA\" frameborder=\"0\" allowfullscreen=\"\"></iframe>\r\n</center>',2),(15,33,'<img src=\"http://mystories.eu/storymedia/marjatta_karjaa.jpg\" alt=\"\" align=\"right\"><h4>Marjattta talks about her childhood in Finland. More description will be added here later.</h4>',1),(16,33,'<center><iframe width=\"853\" height=\"480\" src=\"http://www.youtube.com/embed/aXrYL_4TcYQ\" frameborder=\"0\" allowfullscreen=\"\"></iframe></center>',2),(17,34,'<h3>Bucharest meeting.....</h3><ul><li data-page=\"2\">end of March 2012</li><li data-page=\"3\">weather is nice</li><li data-page=\"4\">meeting goes well<br></li></ul>',1),(18,34,'STORY HERE<br>',5),(19,34,'MORE STUFF HERE<br>',6),(20,34,'EVEN MORE......<br>',7);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F75B25545E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

/*Data for the table `role` */

insert  into `role`(`id`,`name`) values (1,'ROLE_ADMIN'),(3,'ROLE_CONTRIBUTOR'),(2,'ROLE_MODERATOR'),(4,'ROLE_USER');

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
  `meta` longtext,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `meta_place` longtext,
  `meta_storyteller` longtext,
  `meta_time` longtext,
  PRIMARY KEY (`id`),
  KEY `IDX_2A972B3CA76ED395` (`user_id`),
  KEY `IDX_2A972B3CF92F3E70` (`country_id`),
  KEY `IDX_2A972B3C5EEADD3B` (`time_id`),
  KEY `IDX_2A972B3C6BF700BD` (`status_id`),
  CONSTRAINT `FK_2A972B3C5EEADD3B` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`),
  CONSTRAINT `FK_2A972B3C6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_2A972B3CA76ED3951` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2A972B3CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=cp1251;

/*Data for the table `story` */

insert  into `story`(`id`,`meta`,`created_at`,`user_id`,`title`,`country_id`,`time_id`,`status_id`,`meta_place`,`meta_storyteller`,`meta_time`) values (29,'People','2012-03-28 21:22:30',9,'MyStory presentation',22,12,2,NULL,NULL,NULL),(30,'Old man and woman talking.','2012-03-28 21:50:28',9,'Colaj My Story',22,12,2,NULL,NULL,NULL),(31,'Rodica Bernicu','2012-03-28 21:54:24',9,'From Palanca to Kledering and Back',22,12,2,NULL,NULL,NULL),(32,'People, deeds and memories','2012-03-28 22:06:30',2,'Tacu1',22,12,2,NULL,NULL,NULL),(33,'Marjatta','2012-03-28 22:52:38',9,'Marjatta from Karjaa',8,12,2,'Karjaa',NULL,NULL),(34,'jhjh','2012-03-30 16:30:57',9,'Example story from our meeting',13,12,2,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `tag` */

insert  into `tag`(`id`,`name`,`slug`,`created_at`,`updated_at`) values (15,'q','q','2012-03-28 21:08:40','2012-03-28 21:08:40'),(16,'topic','topic','2012-03-28 21:12:50','2012-03-28 21:12:50'),(17,'Project','project','2012-03-28 21:22:30','2012-03-28 21:22:30'),(18,'MyStory','mystory','2012-03-28 21:22:30','2012-03-28 21:22:30'),(19,'People','people','2012-03-28 21:50:28','2012-03-28 21:50:28'),(20,'Travel','travel','2012-03-28 21:54:24','2012-03-28 21:54:24'),(21,'Life','life','2012-03-28 22:52:38','2012-03-28 22:52:38'),(22,'Meeting','meeting','2012-03-30 16:30:58','2012-03-30 16:30:58'),(23,'qwes','qwes','2012-05-10 12:27:30','2012-05-10 12:27:30'),(24,'qweqwe','qweqwe','2012-05-10 19:14:11','2012-05-10 19:14:11'),(25,'test_topic1','test_topic1','2012-05-11 16:29:33','2012-05-11 16:29:33'),(26,'test_topic2','test_topic2','2012-05-11 16:29:33','2012-05-11 16:29:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

/*Data for the table `tagging` */

insert  into `tagging`(`id`,`tag_id`,`resource_type`,`resource_id`,`created_at`,`updated_at`) values (27,17,'story','29','2012-03-28 21:22:30','2012-03-28 21:22:30'),(28,18,'story','29','2012-03-28 21:22:30','2012-03-28 21:22:30'),(29,19,'story','30','2012-03-28 21:50:28','2012-03-28 21:50:28'),(30,20,'story','31','2012-03-28 21:54:24','2012-03-28 21:54:24'),(31,20,'story','32','2012-03-28 22:06:30','2012-03-28 22:06:30'),(32,21,'story','33','2012-03-28 22:52:38','2012-03-28 22:52:38'),(33,22,'story','34','2012-03-30 16:30:58','2012-03-30 16:30:58'),(37,25,'story','36','2012-05-11 16:42:21','2012-05-11 16:42:21'),(38,26,'story','36','2012-05-11 16:42:21','2012-05-11 16:42:21'),(39,25,'story','37','2012-05-11 16:44:18','2012-05-11 16:44:18'),(40,26,'story','37','2012-05-11 16:44:18','2012-05-11 16:44:18'),(41,25,'story','38','2012-05-11 16:44:41','2012-05-11 16:44:41'),(42,26,'story','38','2012-05-11 16:44:41','2012-05-11 16:44:41'),(43,25,'story','39','2012-05-11 16:49:09','2012-05-11 16:49:09'),(44,26,'story','39','2012-05-11 16:49:09','2012-05-11 16:49:09'),(45,25,'story','40','2012-05-11 16:49:25','2012-05-11 16:49:25'),(46,26,'story','40','2012-05-11 16:49:25','2012-05-11 16:49:25'),(47,25,'story','41','2012-05-11 16:51:13','2012-05-11 16:51:13'),(48,26,'story','41','2012-05-11 16:51:13','2012-05-11 16:51:13'),(49,25,'story','42','2012-05-11 16:51:42','2012-05-11 16:51:42'),(50,26,'story','42','2012-05-11 16:51:42','2012-05-11 16:51:42'),(53,25,'story','44','2012-05-11 16:59:20','2012-05-11 16:59:20'),(54,26,'story','44','2012-05-11 16:59:20','2012-05-11 16:59:20'),(55,25,'story','45','2012-05-11 17:00:23','2012-05-11 17:00:23'),(56,26,'story','45','2012-05-11 17:00:23','2012-05-11 17:00:23'),(57,25,'story','46','2012-05-11 17:01:06','2012-05-11 17:01:06'),(58,26,'story','46','2012-05-11 17:01:06','2012-05-11 17:01:06'),(59,25,'story','47','2012-05-11 17:01:58','2012-05-11 17:01:58'),(60,26,'story','47','2012-05-11 17:01:58','2012-05-11 17:01:58'),(61,25,'story','48','2012-05-11 17:03:34','2012-05-11 17:03:34'),(62,26,'story','48','2012-05-11 17:03:34','2012-05-11 17:03:34'),(63,25,'story','49','2012-05-11 17:05:39','2012-05-11 17:05:39'),(64,26,'story','49','2012-05-11 17:05:39','2012-05-11 17:05:39'),(69,25,'story','52','2012-05-11 17:08:15','2012-05-11 17:08:15'),(70,26,'story','52','2012-05-11 17:08:15','2012-05-11 17:08:15'),(71,25,'story','53','2012-05-11 17:08:43','2012-05-11 17:08:43'),(72,26,'story','53','2012-05-11 17:08:43','2012-05-11 17:08:43'),(75,25,'story','55','2012-05-11 17:10:16','2012-05-11 17:10:16'),(76,26,'story','55','2012-05-11 17:10:16','2012-05-11 17:10:16'),(81,25,'story','58','2012-05-11 17:14:54','2012-05-11 17:14:54'),(82,26,'story','58','2012-05-11 17:14:54','2012-05-11 17:14:54'),(83,25,'story','59','2012-05-11 17:16:37','2012-05-11 17:16:37'),(84,26,'story','59','2012-05-11 17:16:37','2012-05-11 17:16:37'),(85,25,'story','60','2012-05-11 17:17:14','2012-05-11 17:17:14'),(86,26,'story','60','2012-05-11 17:17:14','2012-05-11 17:17:14'),(87,25,'story','61','2012-05-11 17:17:46','2012-05-11 17:17:46'),(88,26,'story','61','2012-05-11 17:17:46','2012-05-11 17:17:46'),(91,25,'story','63','2012-05-11 17:26:26','2012-05-11 17:26:26'),(92,26,'story','63','2012-05-11 17:26:26','2012-05-11 17:26:26'),(93,25,'story','64','2012-05-11 17:27:10','2012-05-11 17:27:10'),(94,26,'story','64','2012-05-11 17:27:10','2012-05-11 17:27:10'),(95,25,'story','65','2012-05-11 17:28:55','2012-05-11 17:28:55'),(96,26,'story','65','2012-05-11 17:28:55','2012-05-11 17:28:55'),(97,25,'story','66','2012-05-11 17:30:26','2012-05-11 17:30:26'),(98,26,'story','66','2012-05-11 17:30:26','2012-05-11 17:30:26'),(99,25,'story','67','2012-05-11 17:31:25','2012-05-11 17:31:25'),(100,26,'story','67','2012-05-11 17:31:25','2012-05-11 17:31:25'),(117,25,'story','76','2012-05-11 17:52:17','2012-05-11 17:52:17'),(118,26,'story','76','2012-05-11 17:52:17','2012-05-11 17:52:17'),(119,25,'story','77','2012-05-11 17:52:50','2012-05-11 17:52:50'),(120,26,'story','77','2012-05-11 17:52:50','2012-05-11 17:52:50');

/*Table structure for table `time` */

DROP TABLE IF EXISTS `time`;

CREATE TABLE `time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;

/*Data for the table `time` */

insert  into `time`(`id`,`name`) values (1,'2010'),(2,'2000-2009'),(3,'1990-1999'),(4,'1980-1989'),(5,'1970-1979'),(6,'1960-1969'),(7,'1950-1959'),(8,'1940-1949'),(9,'1930-1939'),(10,'1920-1929'),(11,'1910-1919'),(12,'1900-1909'),(13,'1890-1899'),(14,'1880-1889');

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
  `role_id` int(11) DEFAULT NULL,
  `teller_request` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  KEY `IDX_2DA17977F92F3E70` (`country_id`),
  KEY `UNIQ_8D93D649D60322AC` (`role_id`),
  CONSTRAINT `FK_2DA17977F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  CONSTRAINT `FK_8D93D649D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=cp1251;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`salt`,`created_at`,`email`,`first_name`,`last_name`,`country_id`,`biography`,`city`,`photo`,`institution`,`birth`,`role_id`,`teller_request`) values (1,'user','userpass','1','2012-02-03 16:57:36','kak222ac2a@mail.ru','Albinas','Bagdonas',1,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16',3,NULL),(2,'qwe','qwe','2','2012-02-03 16:57:36','kaka23a@mail.ru','Sergey','Belov',5,'Built as a sprite\r\nInstead of making every icon an extra request, we\'ve compiled them into a sprite—a bunch of images in one file that uses CSS to position the images with background-position. This is the same method we use on Twitter.com and it has worked well for us.\r\n\r\nAll icons classes are prefixed with .icon- for proper namespacing and scoping, much like our other components. This will help avoid conflicts with other tools.\r\n\r\nGlyphicons has granted us use of the Halflings set in our open-source toolkit so long as we provide a link and credit here in the docs. Please consider doing the same in your projects.','Obninsk','2.jpg','I.A.T.E.','2012-02-06 00:00:00',2,NULL),(4,'qweqwe','qweqwe','123','2012-02-03 17:05:30','kakaca@mail.ru','Iva','Pust',4,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16',3,NULL),(6,'ssss','ssss','123','2012-02-08 11:35:04','kakac2a@mail.ru','Milan','Pavliha',11,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16',4,NULL),(7,'ggggg','ggggg','123','2012-02-08 11:35:23','ggggg@mail.ru','Rodica','Bernicus',5,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16',4,NULL),(9,'Ari','kakka','123','2012-03-28 11:01:07','ari.ketola@context.fi','Ari','Ketola',8,NULL,NULL,'9.jpg','Context Learning',NULL,4,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=cp1251;

/*Data for the table `vote` */

insert  into `vote`(`id`,`story_id`,`value`,`user_id`) values (34,29,4,9),(35,30,3,9),(36,32,4,9),(37,34,2,9);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
