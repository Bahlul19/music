CREATE TABLE `follow` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `user_id` int(11) NOT NULL,
                  `followed_user` int(11) NOT NULL,
                  `status` int(1) NOT NULL,
                  `created` datetime NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;