ALTER TABLE `transactions` ADD `status` TINYINT(2) NOT NULL COMMENT '0-failed,1-success' AFTER `payment_status`;