ALTER TABLE `questions` CHANGE `status` `status` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1' COMMENT '0-disabled,1-enabled';