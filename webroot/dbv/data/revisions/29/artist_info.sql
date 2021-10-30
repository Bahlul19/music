CREATE TABLE `artist_info` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `performing_right_org` int(11) DEFAULT NULL,
                  `publisher_with_right_org` int(11) DEFAULT NULL,
                  `member_of_a_union` int(11) DEFAULT NULL,
                  `other_union` varchar(500) DEFAULT NULL,
                  `music_related_organization` varchar(500) DEFAULT NULL,
                  `genre` int(11) DEFAULT NULL,
                  `record_label` varchar(500) DEFAULT NULL,
                  `management_contract` varchar(500) DEFAULT NULL,
                  `booking_agency_contract` varchar(200) DEFAULT NULL,
                  `artistName` varchar(200) DEFAULT NULL,
                  `numberOfMembers` int(3) DEFAULT NULL,
                  `city` varchar(100) DEFAULT NULL,
                  `state` int(5) DEFAULT NULL,
                  `recordLabel` varchar(200) DEFAULT NULL,
                  `recordingsTitle1` varchar(200) DEFAULT NULL,
                  `recordingsLabel1` varchar(200) DEFAULT NULL,
                  `recordingsDate1` date DEFAULT NULL,
                  `recordingsTitle2` varchar(200) DEFAULT NULL,
                  `recordingsLabel2` varchar(200) DEFAULT NULL,
                  `recordingsDate2` date DEFAULT NULL,
                  `recordingsTitle3` varchar(200) DEFAULT NULL,
                  `recordingsLabel3` varchar(200) DEFAULT NULL,
                  `recordingsDate3` date DEFAULT NULL,
                  `playLive` varchar(200) DEFAULT NULL,
                  `homeRecordSoftware` varchar(200) DEFAULT NULL,
                  `homeRecordHardware` varchar(200) DEFAULT NULL,
                  `purchaseSoftware` varchar(200) DEFAULT NULL,
                  `purchaseHardware` varchar(200) DEFAULT NULL,
                  `purchaseInstruments` varchar(200) DEFAULT NULL,
                  `producer` text,
                  `history` text,
                  `career` text,
                  `group_plan` int(11) DEFAULT NULL,
                  `signature` varchar(200) DEFAULT NULL,
                  `date` date DEFAULT NULL,
                  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `user_id` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


CREATE TABLE `genres` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `genre` varchar(500) NOT NULL,
                  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `modified` datetime DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `genres` (`id`, `genre`, `created`, `modified`) VALUES
(1, 'Acid Jazz', '2019-08-27 12:29:42', '2019-08-27 12:29:42'),
(2, 'Alt-Country', '2019-08-27 12:29:56', '2019-08-27 12:29:56'),
(3, 'Ambient', '2019-08-27 12:30:07', '2019-08-27 12:30:07'),
(4, 'Bluegrass', '2019-08-27 12:30:19', '2019-08-27 12:30:19');


CREATE TABLE IF NOT EXISTS `group_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan` varchar(500) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_plan`
--

INSERT INTO `group_plan` (`id`, `plan`, `created`) VALUES
(1, 'Make a professional recording', '2019-10-04 18:07:33'),
(2, 'Release a CD/DVD', '2019-10-04 18:07:33');

CREATE TABLE IF NOT EXISTS `organisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `name`, `created`) VALUES
(1, 'ASCAP', '2019-10-04 17:59:04'),
(2, 'BMI', '2019-10-04 17:59:04');

CREATE TABLE IF NOT EXISTS `unions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `name`, `created`) VALUES
(1, 'AFM', '2019-10-04 18:03:24'),
(2, 'SAG', '2019-10-04 18:03:24');