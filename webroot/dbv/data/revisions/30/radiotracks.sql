CREATE TABLE `radio_tracks` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `title` varchar(500) DEFAULT NULL,
                  `track` text NOT NULL,
                  `description` text,
                  `user_id` int(11) NOT NULL,
                  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `active` int(1) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;