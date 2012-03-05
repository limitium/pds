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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pds` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `Comment` */

DROP TABLE IF EXISTS `Comment`;

CREATE TABLE `Comment` (
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=cp1251;

/*Data for the table `Comment` */

insert  into `Comment`(`id`,`story_id`,`message`,`created_at`,`user_id`) values (1,1,'sdasdasd','2012-02-06 14:42:03',1),(2,1,'zzzzzzzzzzz','2012-02-06 14:46:43',2),(3,1,'[16:03:47] Андрей Елькин: крутые\r\n[16:03:52] limitium: да\r\n[16:03:56] Андрей Елькин: и че держите график?\r\n[16:04:01] limitium: да\r\n[16:04:05] Андрей Елькин: ваще ребята','2012-02-06 15:04:16',3),(4,1,'SELECT u0_.id AS id0, u0_.username AS username1, u0_.email AS email2, u0_.password AS password3, u0_.salt AS salt4, u0_.created_at AS created_at5 \r\nFROM USER u0_ \r\nWHERE u0_.username = \"qwe\" OR u0_.email = \"qwe\";storystory','2012-02-06 15:04:54',1),(5,1,'zzzzzzzzzzz','2012-02-06 15:05:15',2),(6,1,'[15:59:02] Андрей Елькин: дааа))))\r\n[15:59:04] Андрей Елькин: точно\r\n[15:59:14] Alexey Ivanov: я хотел играть\r\n[15:59:17] Андрей Елькин: Начальник подохуе)\r\n[15:59:20] Alexey Ivanov: а ты мне не давал\r\n[15:59:49] Андрей Елькин: как мы в вархаммер разложили\r\n[16:00:01 | Edited 16:00:09] Андрей Елькин: и в колонизаторов там шпилили\r\n[16:00:59] Андрей Елькин: и платили нам с гулькин нос\r\n[16:01:09] Alexey Ivanov: XD\r\n[16:01:19] Андрей Елькин: хотя я тогда с зп и завтраков накопил на юг с Катей съездить','2012-02-06 15:06:45',2),(7,1,'[15:56:37] Андрей Елькин: а твой папа нас устроил вот и пошли\r\n[15:56:58] Андрей Елькин: на тачке гоняли углы сшибали\r\n[15:57:06] Alexey Ivanov: да, но непонятно зачем\r\n[15:57:23] Андрей Елькин: ломали комнату из под старых компов\r\n[15:57:28] Андрей Елькин: есм помоему\r\n[15:57:38] Андрей Елькин: и стулья уничтожали\r\n[15:57:38] Alexey Ivanov: ааа, я книжки попиздил)\r\n[15:57:42] Андрей Елькин: да\r\n[15:57:47] Андрей Елькин: было такое\r\n[15:58:09] Alexey Ivanov: но комп ты у меня отжимал все время\r\n[15:58:26] Андрей Елькин: потому что надо было учить флеш\r\n[15:58:46] Андрей Елькин: а ты ниче не делал за ним по моему)\r\n[15:58:51] Alexey Ivanov: я помню тока как мы читали новости и книгу)\r\n[15:58:56] Alexey Ivanov: и играли в настольную игру','2012-02-06 15:07:05',3),(8,1,'test','2012-02-06 15:31:18',3),(9,1,'qweqweasd\r\nasd\r\nz\r\ndv\r\ns\r\ndfg\r\ns\r\ndg\r\nsdfg','2012-02-06 15:38:05',1),(10,1,'zzzzzzzzzzzzzz','2012-02-06 15:50:23',2),(11,1,'aaaaa','2012-02-06 15:55:41',2),(12,1,'fffff','2012-02-06 15:55:46',2),(13,1,'xxxxx','2012-02-06 15:55:50',2),(14,1,'xxxxx','2012-02-06 15:55:52',2),(15,1,'dfgdfgdfg','2012-02-06 15:55:59',2),(16,1,'dfgdfgdfg','2012-02-06 15:56:02',2),(17,1,'xcvxcv','2012-02-06 15:56:05',2),(18,1,'zxczxczxc','2012-02-06 15:57:42',2),(19,1,'zxczxczxc','2012-02-06 15:59:44',2),(20,1,'lalalaal','2012-02-06 16:09:16',2),(21,1,'asdasdasd','2012-02-06 16:11:11',2),(22,1,'xcvxcv','2012-02-06 16:38:20',2),(23,1,'ccccccc','2012-02-06 16:39:59',2),(24,1,'weeeeeeeeeeeeeeee','2012-02-06 16:40:55',2),(25,1,'yay','2012-02-06 16:41:51',2),(26,1,'qweqwe','2012-02-06 16:43:14',2),(27,1,'yay','2012-02-06 16:44:19',2),(28,1,'Charge!!! For the horde!!!!','2012-02-06 16:44:39',2),(29,2,'Very nice!!!','2012-02-07 13:39:53',3),(30,1,'CHARGE!!!!','2012-02-07 17:00:31',2),(31,1,'zzzz','2012-02-17 12:01:32',2);

/*Table structure for table `Country` */

DROP TABLE IF EXISTS `Country`;

CREATE TABLE `Country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=cp1251;

/*Data for the table `Country` */

insert  into `Country`(`id`,`name`) values (1,'Austria'),(2,'Belgium'),(3,'Bulgaria'),(4,'Cyprus'),(5,'Czech Republic'),(6,'Denmark'),(7,'Estonia'),(8,'Finland'),(9,'France'),(10,'Germany'),(11,'Greece'),(12,'Hungary'),(13,'Ireland'),(14,'Italy'),(15,'Latvia'),(16,'Lithuania'),(17,'Luxembourg'),(18,'Malta'),(19,'Netherlands'),(20,'Poland'),(21,'Portugal'),(22,'Romania'),(23,'Slovakia'),(24,'Slovenia'),(25,'Spain'),(26,'Sweden'),(27,'United Kingdom');

/*Table structure for table `Page` */

DROP TABLE IF EXISTS `Page`;

CREATE TABLE `Page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `body` longtext NOT NULL,
  `lineno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438191EAA5D4036` (`story_id`),
  CONSTRAINT `FK_B438191EAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `Page` */

insert  into `Page`(`id`,`story_id`,`body`,`lineno`) values (1,4,'qqqqqq',NULL),(2,4,'qqqqqqqqqqqqqqqqqq',NULL),(3,4,'qqqqqqqqq',NULL),(4,5,'qweqweqwe',NULL),(5,5,'sssssssssss',NULL),(6,5,'fffffffffffffff',NULL),(7,5,'hhhhhhhhhhhhhh',NULL),(8,6,'page 1',NULL),(9,6,'page 2',NULL),(10,6,'page 3',NULL),(11,6,'page 4',NULL),(12,6,'page 5',NULL),(13,5,'zzzzzzzzzzzzzzzzzzzzz',NULL),(14,1,'<h3>Little mudding</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/V_fh2fyXcc0\" frameborder=\"0\" allowfullscreen></iframe>',1),(15,1,'<h3>Crossing a river</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/hUMzu9k3CbE\" frameborder=\"0\" allowfullscreen></iframe>',2),(16,1,'<h3>Sand dune ;)</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/gvoL3g1wfjU\" frameborder=\"0\" allowfullscreen></iframe>',3),(17,1,'<h3>Moar sand</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/9gnLSq29E9g\" frameborder=\"0\" \r\nallowfullscreen></iframe>',4),(18,2,'<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/-UrJBu0_Yss\" frameborder=\"0\" allowfullscreen></iframe>\r\n<p>\r\nStuck in the creek at night. Morning evacuation :)\r\n</p>',NULL),(19,7,'1',1),(20,7,'3',2),(21,7,'2',3);

/*Table structure for table `Role` */

DROP TABLE IF EXISTS `Role`;

CREATE TABLE `Role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F75B25545E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

/*Data for the table `Role` */

insert  into `Role`(`id`,`name`) values (1,'admin'),(3,'contributor'),(2,'moderator'),(4,'user');

/*Table structure for table `Story` */

DROP TABLE IF EXISTS `Story`;

CREATE TABLE `Story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2A972B3CA76ED395` (`user_id`),
  KEY `IDX_2A972B3CF92F3E70` (`country_id`),
  KEY `IDX_2A972B3C5EEADD3B` (`time_id`),
  CONSTRAINT `FK_2A972B3C5EEADD3B` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`),
  CONSTRAINT `FK_2A972B3CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2A972B3CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251;

/*Data for the table `Story` */

insert  into `Story`(`id`,`meta`,`created_at`,`user_id`,`title`,`country_id`,`date`,`time_id`,`status`) values (1,'<p>[13:12:25] Андрей Елькин: хехе\r\n[13:14:07] Андрей Елькин: аж бедная скрючилась вся)\r\n[13:18:07] limitium: кто\r\n[13:24:34] Андрей Елькин: картинку посмотри\r\n[13:24:56] limitium: 2 девки\r\n[13:25:08] Андрей Елькин: внимание вопрос\r\n[13:25:18] Андрей Елькин: какая из 2х девок скрючилась?\r\n[13:26:16] limitium: обе норм\r\n[13:26:24] Андрей Елькин: ок!\r\n</p>\r\n[pagebreak]\r\n<iframe width=\"900\" height=\"500\" src=\"http://www.youtube.com/embed/8vcmhFvTeOo\" frameborder=\"0\" allowfullscreen></iframe>\r\n[pagebreak]\r\n<p>\r\nСтруктура и интерпретация компьютерных программ преподавалась в Массачусетском технологическом институте, и этот курс имел влияние на весь мир по учебным программам компьютерных наук в течение последних двух десятилетий. На stackoverflow пишут, что книга буквально просветлит нас (will enlighten you) и после нее появится стремление писать великолепные программы. И что если все остальные книги делают из нас лучшего (better) программиста, то конкретно эта — сделает из читателя программиста.\r\n</p>\r\n[pagebreak]\r\n<p>\r\nПервое англоязычное издание этой книги вышло в 1999 году. Первое русское издание — в 2004 году в серии «Библиотека программиста».\r\n\r\n«Это великая книга для программистов, которые где-то как-то научились программировать, может быть, в институте, но не совсем уверены что и как делать. Это как разница между наброском и готовым произведением. То, что вы изучали в университете — это наброски, эскизы, и вы вроде бы можете рисовать красиво, но если всё ещё чувствуете, что не вполне знаете с чего начать, если кто-то предложил вам написать программу для обмена музыкой через P2P-сети, то эта книга для вас». Джо Спольски.\r\n</p>\r\n[pagebreak]\r\n<p>\r\nТот самый Стив Макконнелл, которому приписывают фразу: \"Пишите код так, как будто сопровождать его будет склонный к насилию психопат, который знает, где вы живете.\"\r\n\r\nПервое издание этой книги вышло в 1993 году, второе — в 2004. Первый русский перевод — в 2005 году.\r\n\r\n«Энциклопедия хороших практик программирования. Совершенный код фокусируется на личном искусстве, мастерстве — тех вещах, которые мы интуитивно называем writing clean code. Это та книга, которая может 50 страниц описывать правильное форматирование кода и количество пробелов». Джо Спольски.\r\n</p>','2012-02-03 17:29:06',2,'One day of my suv',22,'2012-01-07',2,NULL),(2,'<div id=\"mybook\">\r\n    <div class=\"b-load\">\r\n        <div>\r\n            <h3>Yay, Page 1!</h3>\r\n        </div>\r\n        <div>\r\n            <h3>Yay, Page 2!</h3>\r\n        </div>\r\n        <div>\r\n            <h3>Yay, Page 3!</h3>\r\n        </div>\r\n        <div>\r\n            <h3>Yay, Page 4!</h3>\r\n        </div>\r\n    </div>\r\n</div>','2012-02-07 13:12:05',2,'Stuck in the creek',2,'2012-01-15',8,NULL),(3,'qwe','2012-02-24 16:35:11',2,'qweqwe',1,'2008-02-04',1,NULL),(4,'qqqqqqqqq','2012-02-28 16:36:15',2,'qqqqqqqq',1,'2012-07-02',2,NULL),(5,'meta','2012-02-28 16:55:35',2,'Story 1',7,'2012-08-02',1,NULL),(6,'lalalal lalal','2012-02-29 10:33:03',2,'one more story',1,'2012-02-02',1,NULL),(7,'qwe','2012-03-02 09:59:03',2,'qwe',1,'2012-06-03',1,NULL);

/*Table structure for table `StoryTopic` */

DROP TABLE IF EXISTS `StoryTopic`;

CREATE TABLE `StoryTopic` (
  `story_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`story_id`,`topic_id`),
  KEY `IDX_D854EEFAAA5D4036` (`story_id`),
  KEY `IDX_D854EEFA1F55203D` (`topic_id`),
  CONSTRAINT `FK_D854EEFA1F55203D` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`),
  CONSTRAINT `FK_D854EEFAAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `StoryTopic` */

insert  into `StoryTopic`(`story_id`,`topic_id`) values (1,2),(1,3),(1,5),(1,7);

/*Table structure for table `Time` */

DROP TABLE IF EXISTS `Time`;

CREATE TABLE `Time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=cp1251;

/*Data for the table `Time` */

insert  into `Time`(`id`,`name`) values (1,'1900'),(2,'1910'),(3,'1920'),(4,'1930'),(5,'1940'),(6,'1950'),(7,'1960'),(8,'1970'),(9,'1980'),(10,'1990'),(11,'2000');

/*Table structure for table `Topic` */

DROP TABLE IF EXISTS `Topic`;

CREATE TABLE `Topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=cp1251;

/*Data for the table `Topic` */

insert  into `Topic`(`id`,`name`) values (1,'WW1'),(2,'WW2'),(3,'Daily life'),(4,'Childhood'),(5,'Games'),(6,'Work'),(7,'Health'),(8,'Architecture'),(9,'Travel'),(10,'Passion'),(11,'Hobbies'),(12,'Music'),(13,'Maps');

/*Table structure for table `User` */

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
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

/*Data for the table `User` */

insert  into `User`(`id`,`username`,`password`,`salt`,`created_at`,`email`,`first_name`,`last_name`,`country_id`,`biography`,`city`,`photo`,`institution`,`birth`) values (1,'user','userpass','1','2012-02-03 16:57:36','kak222ac2a@mail.ru','Albinas','Bagdonas',1,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(2,'qwe','qwe','2','2012-02-03 16:57:36','kaka23a@mail.ru','Sergey','Belov',5,'Built as a sprite\r\nInstead of making every icon an extra request, we\'ve compiled them into a sprite—a bunch of images in one file that uses CSS to position the images with background-position. This is the same method we use on Twitter.com and it has worked well for us.\r\n\r\nAll icons classes are prefixed with .icon- for proper namespacing and scoping, much like our other components. This will help avoid conflicts with other tools.\r\n\r\nGlyphicons has granted us use of the Halflings set in our open-source toolkit so long as we provide a link and credit here in the docs. Please consider doing the same in your projects.','Obninsk','2.jpg','I.A.T.E.','2012-02-06 00:00:00'),(3,'asdasd','asdasd','123','2012-02-03 16:57:36','kakac442a@mail.ru','Irena','Levi?nik',3,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.',NULL,NULL,NULL,'2012-02-06 15:04:16'),(4,'qweqwe','qweqwe','123','2012-02-03 17:05:30','kakaca@mail.ru','Iva','Pust',4,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(5,'zzz','zzz','123','2012-02-03 17:21:43','qweqwe@zzz.ru','Marija','Povil?nait?',7,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(6,'ssss','ssss','123','2012-02-08 11:35:04','kakac2a@mail.ru','Milan','Pavliha',11,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(7,'ggggg','ggggg','123','2012-02-08 11:35:23','ggggg@mail.ru','Rodica','Bernicus',5,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16'),(8,'qweasdzxc','qweqwe','123','2012-02-08 13:08:08','qweqwe@mail.ru',NULL,NULL,8,'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.','Obninsk',NULL,'I.A.T.E.','2012-02-06 15:04:16');

/*Table structure for table `UserRole` */

DROP TABLE IF EXISTS `UserRole`;

CREATE TABLE `UserRole` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_A8503F73A76ED395` (`user_id`),
  KEY `IDX_A8503F73D60322AC` (`role_id`),
  CONSTRAINT `FK_A8503F73A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_A8503F73D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Data for the table `UserRole` */

/*Table structure for table `Vote` */

DROP TABLE IF EXISTS `Vote`;

CREATE TABLE `Vote` (
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

/*Data for the table `Vote` */

insert  into `Vote`(`id`,`story_id`,`value`,`user_id`) values (24,1,4,2),(25,2,2,2),(26,1,3,1),(27,1,3,3),(28,1,5,4),(29,5,3,2),(30,3,1,2),(32,4,1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
