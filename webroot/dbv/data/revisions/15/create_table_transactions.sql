CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `btn_id` varchar(255) DEFAULT NULL,
  `business` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_number` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mc_currency` varchar(255) DEFAULT NULL,
  `mc_fee` float DEFAULT NULL,
  `mc_gross` float DEFAULT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `option_selection` varchar(255) DEFAULT NULL,
  `payer_email` varchar(255) DEFAULT NULL,
  `payer_id` varchar(255) DEFAULT NULL,
  `payer_status` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `payment_fee` float DEFAULT NULL,
  `payment_gross` float DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `protection_eligibility` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `receiver_id` varchar(255) DEFAULT NULL,
  `residence_country` varchar(255) DEFAULT NULL,
  `subscr_id` varchar(255) DEFAULT NULL,
  `transaction_subject` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `txn_type` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
);

ALTER TABLE `transactions` ADD PRIMARY KEY(`id`);

ALTER TABLE `transactions` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;