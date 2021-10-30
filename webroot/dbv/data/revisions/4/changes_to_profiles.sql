ALTER TABLE `profiles` CHANGE `is_active` `is_active` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1-is_active';

ALTER TABLE `profiles` CHANGE `media_id` `media_id` INT(11) NULL DEFAULT NULL, CHANGE `short_bio` `short_bio` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `interest` `interest` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `dob` `dob` DATE NULL DEFAULT NULL, CHANGE `skill` `skill` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `tag` `tag` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;