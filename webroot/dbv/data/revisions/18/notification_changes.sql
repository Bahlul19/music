CREATE TABLE `notifications` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `user_id` int(11) NOT NULL,
                  `notification` text NOT NULL,
                  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `notification_likes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `notification_id` int(11) NOT NULL,
                  `user_id` int(11) NOT NULL,
                  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
