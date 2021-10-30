CREATE TABLE `media_comments` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `media_id` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
                  `created` datetime NOT NULL,
                  `modified` datetime NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;