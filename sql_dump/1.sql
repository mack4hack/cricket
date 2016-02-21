 CREATE TABLE `keys` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `key` VARCHAR(40) NOT NULL,
       `level` INT(2) NOT NULL,
       `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
       `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
      `ip_addresses` TEXT NULL DEFAULT NULL,
       `date_created` INT(11) NOT NULL,
       PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 CREATE TABLE `logs` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `uri` VARCHAR(255) NOT NULL,
       `method` VARCHAR(6) NOT NULL,
       `params` TEXT DEFAULT NULL,
       `api_key` VARCHAR(40) NOT NULL,
       `ip_address` VARCHAR(45) NOT NULL,
       `time` INT(11) NOT NULL,
       `rtime` FLOAT DEFAULT NULL,
       `authorized` VARCHAR(1) NOT NULL,
       `response_code` smallint(3) DEFAULT '0',
       PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 CREATE TABLE `access` (
       `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
       `key` VARCHAR(40) NOT NULL DEFAULT '',
       `controller` VARCHAR(50) NOT NULL DEFAULT '',
       `date_created` DATETIME DEFAULT NULL,
       `date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 CREATE TABLE `limits` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `uri` VARCHAR(255) NOT NULL,
       `count` INT(10) NOT NULL,
       `hour_started` INT(11) NOT NULL,
       `api_key` VARCHAR(40) NOT NULL,
       PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#save lottery betting  details 
 CREATE TABLE IF NOT EXISTS `game_lottery` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_type` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `digit` int(2) NOT NULL,
  `bet_amount` decimal(10,2) NOT NULL,
  `payout` decimal(10,2) NOT NULL,
  `timeslot` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

 CREATE TABLE IF NOT EXISTS `player_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `game_type` int(11) NOT NULL,
  `timeslot` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_digit` int(1) DEFAULT NULL,
  `second_digit` int(1) DEFAULT NULL,
  `jodi_digit` int(2) DEFAULT NULL,
  `bet_amount` decimal(10,4) NOT NULL,
  `result` tinyint(1) NOT NULL DEFAULT '0',
  `payout` decimal(10,4) NOT NULL,
  `total_points` decimal(10,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

 CREATE TABLE IF NOT EXISTS `lucky_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lucky_number` int(2) NOT NULL,
  `timeslot` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `user_master` ADD `deposited_amount` DECIMAL(10,4) NOT NULL AFTER `is_blocked`, ADD `present_amount` DECIMAL(10,4) NOT NULL AFTER `deposited_amount`;

ALTER TABLE  `player_history` CHANGE  `bet_amount`  `bet_amount` INT( 11 ) NOT NULL ,
CHANGE  `payout`  `payout` INT( 11 ) NOT NULL ,
CHANGE  `total_points`  `total_points` INT( 11 ) NOT NULL ;

ALTER TABLE  `game_lottery` CHANGE  `bet_amount`  `bet_amount` INT( 11 ) NOT NULL ,
CHANGE  `payout`  `payout` INT( 11 ) NOT NULL ;

ALTER TABLE  `user_master` CHANGE  `deposited_amount`  `deposited_amount` INT( 11 ) NOT NULL ,
CHANGE  `present_amount`  `present_amount` INT( 11 ) NOT NULL ;

alter table `user_master` add
`ip_address` varchar(15) NOT NULL, add
  `salt` varchar(255) DEFAULT NULL, add
  `email` varchar(100) NOT NULL, add
  `activation_code` varchar(40) DEFAULT NULL, add
  `forgotten_password_code` varchar(40) DEFAULT NULL, add
  `forgotten_password_time` int(11) unsigned DEFAULT NULL, add
  `remember_code` varchar(40) DEFAULT NULL, add
  `created_on` int(11) unsigned NOT NULL, add
  `last_login` int(11) unsigned DEFAULT NULL, add
  `active` tinyint(1) unsigned DEFAULT NULL, add
  `company` varchar(100) DEFAULT NULL, add
  `phone` varchar(20) DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `admin_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_type` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `bet_amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `timeslot` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;  

ALTER TABLE `lucky_numbers` ADD `draw_id` INT( 11 ) NOT NULL AFTER `id` ;

CREATE TABLE IF NOT EXISTS `dealer_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_type` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `bet_amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `timeslot` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;    

ALTER TABLE `lucky_numbers` ADD `timeslot_id` INT(11) NOT NULL ;

delete FROM `countries` where id != 101;

delete FROM `states` where country_id != 101;

delete FROM `cities` where state_id not in (SELECT id FROM `states` )  ;




ALTER TABLE `admin_history` ADD `commission` INT( 11 ) NOT NULL AFTER `bet_amount` ;
ALTER TABLE `dealer_history` ADD `commission` INT( 11 ) NOT NULL AFTER `bet_amount` ;

ALTER TABLE `admin_history` ADD `timeslot_id` INT(11) NOT NULL ;
ALTER TABLE `dealer_history` ADD `timeslot_id` INT(11) NOT NULL ;
ALTER TABLE `player_history` ADD `timeslot_id` INT(11) NOT NULL AFTER `timeslot`;




ALTER TABLE `user_master` ADD `is_demo` INT( 11 ) NOT NULL DEFAULT '0';

ALTER TABLE `user_master` ADD `sunday_amount` INT( 11 ) NOT NULL AFTER `present_amount` ;

ALTER TABLE `user_master` ADD `is_restored` INT( 11 ) NOT NULL DEFAULT '0',
ADD `restored_time` DATETIME NOT NULL ;



ALTER TABLE `game_lottery` ADD `transaction_id` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `player_history` ADD `transaction_id` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `dealer_history` ADD `transaction_id` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `admin_history` ADD `transaction_id` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `player_history` ADD `is_canceled` BOOLEAN NOT NULL DEFAULT FALSE ;


ALTER TABLE `admin_history` CHANGE `commission` `commission` DECIMAL( 10, 2 ) NOT NULL ;
ALTER TABLE `user_master` CHANGE `present_amount` `present_amount` DECIMAL( 10, 2 ) NOT NULL ,
CHANGE `sunday_amount` `sunday_amount` DECIMAL( 10, 2 ) NOT NULL ;

ALTER TABLE `player_history` CHANGE `bet_amount` `bet_amount` DECIMAL(10,2) NOT NULL;
ALTER TABLE `player_history` CHANGE `payout` `payout` DECIMAL(10,2) NOT NULL;
ALTER TABLE `admin_history` CHANGE `bet_amount` `bet_amount` DECIMAL(10,2) NOT NULL;
ALTER TABLE `admin_history` CHANGE `total` `total` DECIMAL(10,2) NOT NULL;
ALTER TABLE `dealer_history` CHANGE `bet_amount` `bet_amount` DECIMAL(10,2) NOT NULL;
ALTER TABLE `dealer_history` CHANGE `commission` `commission` DECIMAL(10,2) NOT NULL;
ALTER TABLE `dealer_history` CHANGE `total` `total` DECIMAL(10,2) NOT NULL;
ALTER TABLE `game_lottery`  CHANGE `bet_amount` `bet_amount` DECIMAL(10,2) NOT NULL, CHANGE `payout` `payout` DECIMAL(10,2) NOT NULL;

ALTER TABLE `user_master` ADD `city` VARCHAR( 32 ) NOT NULL AFTER `city_id` ;

ALTER TABLE `game_lottery` ADD `commission` DECIMAL(10,2) NOT NULL ;




