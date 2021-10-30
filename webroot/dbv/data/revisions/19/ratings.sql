CREATE TABLE `ratings` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `media_id` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `rating` float NOT NULL,
                  `created` datetime NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;