CREATE TABLE `myprofile` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `user_id` int(11) NOT NULL,
                  `wall_img_path` varchar(1000) DEFAULT NULL,
                  `photo_path` varchar(1000) DEFAULT NULL,
                  `video` varchar(2000) DEFAULT NULL,
                  `music` varchar(2000) DEFAULT NULL,
                  `news` text,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;