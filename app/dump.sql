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

/*Data for the table `Page` */

insert  into `Page`(`id`,`story_id`,`body`,`lineno`) values (1,4,'qqqqqq',NULL),(2,4,'qqqqqqqqqqqqqqqqqq',NULL),(3,4,'qqqqqqqqq',NULL),(4,5,'<img src=\"http://jquery.com/demo/thickbox/images/plant4.jpg\">\r\n<img src=\"http://www.boingboing.net/images/_documents_anemone_images_anemone850-1.jpg\"><div>test test</div>',1),(5,5,'sssssssss<img src=\"http://www.marshallcenter.org/mcpublicweb/MCDocs/images/img_CMS/imgThumbnails/400x300-MCDocs-images-img_MC-img_news-0001.jpeg\">ss',2),(6,5,'fffffffffffffff',3),(7,5,'hhhhhhhhhhhhhh',4),(8,6,'page 1',NULL),(9,6,'page 2',NULL),(10,6,'page 3',NULL),(11,6,'page 4',NULL),(12,6,'page 5',NULL),(13,5,'zzzzzzzzzzzzzzzzzzzzz',5),(14,1,'<h3>Little mudding</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/V_fh2fyXcc0\" frameborder=\"0\" allowfullscreen></iframe>',1),(15,1,'<h3>Crossing a river</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/hUMzu9k3CbE\" frameborder=\"0\" allowfullscreen></iframe>',2),(16,1,'<h3>Sand dune ;)</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/gvoL3g1wfjU\" frameborder=\"0\" allowfullscreen></iframe>',3),(17,1,'<h3>Moar sand</h3>\r\n<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/9gnLSq29E9g\" frameborder=\"0\" \r\nallowfullscreen></iframe>',4),(18,2,'<iframe width=\"910\" height=\"450\" src=\"http://www.youtube.com/embed/-UrJBu0_Yss\" frameborder=\"0\" allowfullscreen></iframe>\r\n<p>\r\nStuck in the creek at night. Morning evacuation :)\r\n</p>',1),(19,7,'1',1),(20,7,'3',2),(21,7,'2',3),(22,8,'1',1),(23,8,'2',2),(24,8,'1',3),(25,9,'1',1),(26,9,'2',2),(27,9,'1',3),(28,10,'1',1),(29,10,'2',2),(30,10,'1',3),(31,11,'1',1),(32,11,'2',2),(33,11,'1',3),(34,12,'1',1),(35,12,'2',2),(36,12,'1',3),(37,13,'1',1),(38,13,'1',2),(39,13,'22',3),(40,14,'1',1),(41,14,'1',2),(42,14,'22',3),(43,15,'1',1),(44,15,'1',2),(45,15,'22',3),(46,16,'1',1),(47,16,'1',2),(48,16,'22',3),(49,17,'1',1),(50,17,'1',2),(51,17,'22',3),(52,18,'1',1),(53,18,'213',2),(54,18,'23123',3),(55,19,'1',1),(56,19,'213',2),(57,19,'23123',3),(58,20,'1',1),(59,20,'213',2),(60,20,'23123',3),(61,21,'1',1),(62,21,'213',2),(63,21,'23123',3),(64,22,'1',1),(65,22,'213',2),(66,22,'23123',3),(67,23,'1',1),(68,23,'213',2),(69,23,'23123',3),(70,1,'<img src=\"http://www.aviation-images.com/user/zooms/118/451nw/aviation-images.com21079968wm.jpg?d=1179938582\"/>',5),(71,1,'<img src=\"http://jquery.com/demo/thickbox/images/plant4.jpg\"/>',6),(72,3,'summary',1),(73,3,'page1',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
