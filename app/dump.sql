-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- Хост: 80.83.0.28
-- Время создания: Май 29 2012 г., 10:39
-- Версия сервера: 5.0.51
-- Версия PHP: 5.2.4-2ubuntu5.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `mystorie`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL auto_increment,
  `story_id` int(11) default NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `IDX_5BC96BF0AA5D4036` (`story_id`),
  KEY `IDX_5BC96BF0A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `story_id`, `message`, `created_at`, `user_id`) VALUES
(36, 29, 'This is a nice story!', '2012-03-29 18:51:16', 9),
(37, 34, 'This is quite boring story. Please imporove it soon!', '2012-03-30 16:35:25', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Austria'),
(2, 'Belgium'),
(3, 'Bulgaria'),
(4, 'Cyprus'),
(5, 'Czech Republic'),
(6, 'Denmark'),
(7, 'Estonia'),
(8, 'Finland'),
(9, 'France'),
(10, 'Germany'),
(11, 'Greece'),
(12, 'Hungary'),
(13, 'Ireland'),
(14, 'Italy'),
(15, 'Latvia'),
(16, 'Lithuania'),
(17, 'Luxembourg'),
(18, 'Malta'),
(19, 'Netherlands'),
(20, 'Poland'),
(21, 'Portugal'),
(22, 'Romania'),
(23, 'Slovakia'),
(24, 'Slovenia'),
(25, 'Spain'),
(26, 'Sweden'),
(27, 'United Kingdom');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL auto_increment,
  `story_id` int(11) default NULL,
  `body` longtext,
  `lineno` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `IDX_B438191EAA5D4036` (`story_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `story_id`, `body`, `lineno`) VALUES
(7, 29, '<h4>MyStory presentation from Romania shown idea of the project.</h4>', 1),
(8, 29, '<center><iframe src="http://www.youtube.com/embed/U_CJZGUTDCg" allowfullscreen="" frameborder="0" height="473" width="630"></iframe></center>', 2),
(9, 30, '<h3>A story from Romania.</h3>', 1),
(10, 30, '<center><iframe width="560" height="315" src="http://www.youtube.com/embed/YMz0eycs4xA?wmode=opaque" frameborder="0" allowfullscreen=""></iframe></center>', 2),
(11, 31, '<h4>Summary will be here.</h4>', 1),
(12, 31, '<div style="text-align: center;"><centerr><br></centerr></div><centerr><iframe width="560" height="315" src="http://www.youtube.com/embed/MKzky9P9Uo4?wmode=opaque" frameborder="0" allowfullscreen=""></iframe></centerr>', 2),
(13, 32, '<h4>About the story...</h4>', 1),
(14, 32, '<center><br></center><center>\r\n<iframe width="640" height="480" src="http://www.youtube.com/embed/kQxKRVGRdCA" frameborder="0" allowfullscreen=""></iframe>\r\n</center>', 2),
(15, 33, '<img src="http://mystories.eu/storymedia/marjatta_karjaa.jpg" alt="" align="right"><h4>Marjattta talks about her childhood in Finland. More description will be added here later.</h4>', 1),
(16, 33, '<center><iframe width="853" height="480" src="http://www.youtube.com/embed/aXrYL_4TcYQ" frameborder="0" allowfullscreen=""></iframe></center>', 2),
(17, 34, '<h3>Bucharest meeting.....</h3><ul><li data-page="2">end of March 2012</li><li data-page="3">weather is nice</li><li data-page="4">meeting goes well<br></li></ul>', 1),
(18, 34, 'STORY HERE<br>', 5),
(19, 34, 'MORE STUFF HERE<br>', 6),
(20, 34, 'EVEN MORE......<br>', 7),
(21, 35, 'Testing with subtitles.', 1),
(22, 35, '&lt;iframe width="640" height="360" src="http://www.youtube.com/embed/aXrYL_4TcYQ&amp;cc_load_policy=1" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;<br>', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNIQ_F75B25545E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'ROLE_ADMIN'),
(3, 'ROLE_CONTRIBUTOR'),
(2, 'ROLE_MODERATOR'),
(4, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Unpublished'),
(2, 'Published'),
(3, 'Moderated'),
(4, 'Blocked');

-- --------------------------------------------------------

--
-- Структура таблицы `story`
--

CREATE TABLE IF NOT EXISTS `story` (
  `id` int(11) NOT NULL auto_increment,
  `meta` longtext,
  `created_at` datetime NOT NULL,
  `user_id` int(11) default NULL,
  `title` varchar(255) NOT NULL,
  `country_id` int(11) default NULL,
  `time_id` int(11) default NULL,
  `status_id` int(11) default NULL,
  `meta_place` longtext,
  `meta_storyteller` longtext,
  `meta_time` longtext,
  PRIMARY KEY  (`id`),
  KEY `IDX_2A972B3CA76ED395` (`user_id`),
  KEY `IDX_2A972B3CF92F3E70` (`country_id`),
  KEY `IDX_2A972B3C5EEADD3B` (`time_id`),
  KEY `IDX_2A972B3C6BF700BD` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `story`
--

INSERT INTO `story` (`id`, `meta`, `created_at`, `user_id`, `title`, `country_id`, `time_id`, `status_id`, `meta_place`, `meta_storyteller`, `meta_time`) VALUES
(29, 'People', '2012-03-28 21:22:30', 9, 'MyStory presentation2', 22, 12, 2, NULL, NULL, NULL),
(30, 'Old man and woman talking.', '2012-03-28 21:50:28', 9, 'Colaj My Story', 22, 12, 2, NULL, NULL, NULL),
(31, 'Rodica Bernicu', '2012-03-28 21:54:24', 9, 'From Palanca to Kledering and Back', 22, 12, 2, NULL, NULL, NULL),
(32, 'People, deeds and memories', '2012-03-28 22:06:30', 9, 'Tacu', 22, 12, 2, NULL, NULL, NULL),
(33, 'Marjatta', '2012-03-28 22:52:38', 9, 'Marjatta from Karjaa', 8, 12, 2, 'Karjaa', NULL, NULL),
(34, 'jhjh', '2012-03-30 16:30:57', 9, 'Example story from our meeting', 13, 12, 2, NULL, NULL, NULL),
(35, NULL, '2012-05-07 13:57:45', 9, 'Marjatta from Finland 2', 8, 4, 2, 'Karjaa', NULL, '1985');

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNIQ_3BC4F1635E237E06` (`name`),
  UNIQUE KEY `UNIQ_3BC4F163989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(15, 'q', 'q', '2012-03-28 21:08:40', '2012-03-28 21:08:40'),
(16, 'topic', 'topic', '2012-03-28 21:12:50', '2012-03-28 21:12:50'),
(17, 'Project', 'project', '2012-03-28 21:22:30', '2012-03-28 21:22:30'),
(18, 'MyStory', 'mystory', '2012-03-28 21:22:30', '2012-03-28 21:22:30'),
(19, 'People', 'people', '2012-03-28 21:50:28', '2012-03-28 21:50:28'),
(20, 'Travel', 'travel', '2012-03-28 21:54:24', '2012-03-28 21:54:24'),
(21, 'Life', 'life', '2012-03-28 22:52:38', '2012-03-28 22:52:38'),
(22, 'Meeting', 'meeting', '2012-03-30 16:30:58', '2012-03-30 16:30:58'),
(23, 'Childhood', 'childhood', '2012-05-07 13:57:45', '2012-05-07 13:57:45');

-- --------------------------------------------------------

--
-- Структура таблицы `tagging`
--

CREATE TABLE IF NOT EXISTS `tagging` (
  `id` int(11) NOT NULL auto_increment,
  `tag_id` int(11) default NULL,
  `resource_type` varchar(50) NOT NULL,
  `resource_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `IDX_6B13E8BFBAD26311` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `tagging`
--

INSERT INTO `tagging` (`id`, `tag_id`, `resource_type`, `resource_id`, `created_at`, `updated_at`) VALUES
(27, 17, 'story', '29', '2012-03-28 21:22:30', '2012-03-28 21:22:30'),
(28, 18, 'story', '29', '2012-03-28 21:22:30', '2012-03-28 21:22:30'),
(29, 19, 'story', '30', '2012-03-28 21:50:28', '2012-03-28 21:50:28'),
(30, 20, 'story', '31', '2012-03-28 21:54:24', '2012-03-28 21:54:24'),
(31, 20, 'story', '32', '2012-03-28 22:06:30', '2012-03-28 22:06:30'),
(32, 21, 'story', '33', '2012-03-28 22:52:38', '2012-03-28 22:52:38'),
(33, 22, 'story', '34', '2012-03-30 16:30:58', '2012-03-30 16:30:58'),
(34, 23, 'story', '35', '2012-05-07 13:57:45', '2012-05-07 13:57:45');

-- --------------------------------------------------------

--
-- Структура таблицы `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `time`
--

INSERT INTO `time` (`id`, `name`) VALUES
(1, '2010'),
(2, '2000-2009'),
(3, '1990-1999'),
(4, '1980-1989'),
(5, '1970-1979'),
(6, '1960-1969'),
(7, '1950-1959'),
(8, '1940-1949'),
(9, '1930-1939'),
(10, '1920-1929'),
(11, '1910-1919'),
(12, '1900-1909'),
(13, '1890-1899'),
(14, '1880-1889');

-- --------------------------------------------------------

--
-- Структура таблицы `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `topic`
--

INSERT INTO `topic` (`id`, `name`) VALUES
(1, 'WW1'),
(2, 'WW2'),
(3, 'Daily life'),
(4, 'Childhood'),
(5, 'Games'),
(6, 'Work'),
(7, 'Health'),
(8, 'Architecture'),
(9, 'Travel'),
(10, 'Passion'),
(11, 'Hobbies'),
(12, 'Music'),
(13, 'Maps');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) default NULL,
  `last_name` varchar(255) default NULL,
  `country_id` int(11) default NULL,
  `biography` longtext,
  `city` varchar(255) default NULL,
  `photo` varchar(255) default NULL,
  `institution` varchar(255) default NULL,
  `birth` datetime default NULL,
  `role_id` int(11) default NULL,
  `teller_request` tinyint(1) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  KEY `IDX_2DA17977F92F3E70` (`country_id`),
  KEY `IDX_8D93D649D60322AC` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `created_at`, `email`, `first_name`, `last_name`, `country_id`, `biography`, `city`, `photo`, `institution`, `birth`, `role_id`, `teller_request`) VALUES
(1, 'user', 'userpass', '1', '2012-02-03 16:57:36', 'kak222ac2a@mail.ru', 'Albinas', 'Bagdonas', 1, 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', 'Obninsk', NULL, 'I.A.T.E.', '2012-02-06 15:04:16', 1, NULL),
(2, 'qwe', 'qwe', '2', '2012-02-03 16:57:36', 'kaka23a@mail.ru', 'Sergey', 'Belov', 5, 'Built as a sprite\r\nInstead of making every icon an extra request, we''ve compiled them into a sprite—a bunch of images in one file that uses CSS to position the images with background-position. This is the same method we use on Twitter.com and it has worked well for us.\r\n\r\nAll icons classes are prefixed with .icon- for proper namespacing and scoping, much like our other components. This will help avoid conflicts with other tools.\r\n\r\nGlyphicons has granted us use of the Halflings set in our open-source toolkit so long as we provide a link and credit here in the docs. Please consider doing the same in your projects.', 'Obninsk', '2.jpg', 'I.A.T.E.', '2012-02-06 00:00:00', 1, NULL),
(4, 'qweqwe', 'qweqwe', '123', '2012-02-03 17:05:30', 'kakaca@mail.ru', 'Iva', 'Pust', 4, 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', 'Obninsk', NULL, 'I.A.T.E.', '2012-02-06 15:04:16', 1, NULL),
(6, 'ssss', 'ssss', '123', '2012-02-08 11:35:04', 'kakac2a@mail.ru', 'Milan', 'Pavliha', 11, 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', 'Obninsk', NULL, 'I.A.T.E.', '2012-02-06 15:04:16', 1, NULL),
(7, 'ggggg', 'ggggg', '123', '2012-02-08 11:35:23', 'ggggg@mail.ru', 'Rodica', 'Bernicus', 5, 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', 'Obninsk', NULL, 'I.A.T.E.', '2012-02-06 15:04:16', 1, NULL),
(9, 'Ari', 'kakka', '123', '2012-03-28 11:01:07', 'ari.ketola@context.fi', 'Ari', 'Ketola', 8, NULL, NULL, '9.jpg', 'Context Learning', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `user_role`
--


-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL auto_increment,
  `vid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `player_url` varchar(255) NOT NULL,
  `watch_url` varchar(255) NOT NULL,
  `User_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `IDX_BD06F52868D3EA09` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `video`
--


-- --------------------------------------------------------

--
-- Структура таблицы `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL auto_increment,
  `story_id` int(11) default NULL,
  `value` int(11) NOT NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `unqiue_pair` (`user_id`,`story_id`),
  KEY `IDX_FA222A5AAA5D4036` (`story_id`),
  KEY `IDX_FA222A5AA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `vote`
--

INSERT INTO `vote` (`id`, `story_id`, `value`, `user_id`) VALUES
(34, 29, 4, 9),
(35, 30, 3, 9),
(36, 32, 4, 9),
(37, 34, 2, 9);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_5BC96BF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5BC96BF0AA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`);

--
-- Ограничения внешнего ключа таблицы `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_B438191EAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`);

--
-- Ограничения внешнего ключа таблицы `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `FK_2A972B3C5EEADD3B` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`),
  ADD CONSTRAINT `FK_2A972B3C6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `FK_2A972B3CA76ED3951` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2A972B3CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Ограничения внешнего ключа таблицы `tagging`
--
ALTER TABLE `tagging`
  ADD CONSTRAINT `FK_6B13E8BFBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_2DA17977F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `FK_8D93D649D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Ограничения внешнего ключа таблицы `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_BD06F52868D3EA09` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_FA222A5AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FA222A5AAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`);
