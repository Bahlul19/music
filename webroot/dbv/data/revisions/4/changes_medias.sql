ALTER TABLE `medias` CHANGE `type` `type` TINYINT(10) NOT NULL COMMENT '0-image,1-video,2-audio,3-profile image';

ALTER TABLE `medias` CHANGE `status` `status` INT(10) NOT NULL COMMENT '0-not approved,1-approved';


