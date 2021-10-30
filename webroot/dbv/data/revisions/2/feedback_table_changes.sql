ALTER TABLE `feedbacks` ADD `name` VARCHAR(255) NOT NULL AFTER `id`;

ALTER TABLE `feedbacks` CHANGE `user_id` `user_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `feedbacks` CHANGE `status` `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-not replied,1-replied';

ALTER TABLE feedbacks DROP question;

ALTER TABLE `feedbacks` ADD `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`;