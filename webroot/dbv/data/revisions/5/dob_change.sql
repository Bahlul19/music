ALTER TABLE `feedbacks` CHANGE `status` `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-unread,1-read,2-read and replied';
