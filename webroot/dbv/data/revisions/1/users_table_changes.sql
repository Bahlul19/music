ALTER TABLE users DROP photo;

ALTER TABLE users DROP photo_dir;

ALTER TABLE `users` ADD `gender` TINYINT(2) NOT NULL COMMENT 'false:male,true:female' AFTER `zipcode`;

ALTER TABLE `users` ADD `is_deleted` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '1:deleted' AFTER `is_active`;