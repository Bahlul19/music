CREATE TABLE `notification_ratings` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `notification_id` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `rating` float NOT NULL,
                  `created` datetime NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

CREATE TABLE `notification_comments` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `notification_id` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `comment` text NOT NULL,
                  `created` datetime NOT NULL,
                  `modified` datetime NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;