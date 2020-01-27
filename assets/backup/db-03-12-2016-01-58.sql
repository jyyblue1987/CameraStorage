#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS admin;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT '',
  `password` varchar(100) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `role` enum('super admin','admin','employee') DEFAULT NULL,
  `balance` double DEFAULT '0',
  `category_id` bigint(20) DEFAULT '0',
  `is_chat` tinyint(4) DEFAULT '0',
  `is_user` tinyint(4) DEFAULT '0',
  `is_product` tinyint(4) DEFAULT '0',
  `is_store` tinyint(4) DEFAULT '0',
  `is_employee` tinyint(4) DEFAULT '0',
  `is_order` tinyint(4) DEFAULT '0',
  `is_payment` tinyint(4) DEFAULT '0',
  `is_place` tinyint(4) DEFAULT '0',
  `is_membership` tinyint(4) DEFAULT '0',
  `is_content` tinyint(4) DEFAULT '0',
  `is_newsletter` tinyint(4) DEFAULT '0',
  `is_general` tinyint(4) DEFAULT '0',
  `is_ticket` tinyint(4) DEFAULT '0',
  `is_customer` tinyint(4) DEFAULT '0',
  `default` tinyint(4) DEFAULT '0',
  `enabled` tinyint(4) DEFAULT '1',
  `status` varchar(255) DEFAULT '',
  `date` datetime DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO admin (`id`, `username`, `password`, `email`, `image`, `type`, `role`, `balance`, `category_id`, `is_chat`, `is_user`, `is_product`, `is_store`, `is_employee`, `is_order`, `is_payment`, `is_place`, `is_membership`, `is_content`, `is_newsletter`, `is_general`, `is_ticket`, `is_customer`, `default`, `enabled`, `status`, `date`, `created`, `modified`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', NULL, '', 'super admin', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '1', NULL, '1416646926', '1416646926');


#
# TABLE STRUCTURE FOR: admin_permission
#

DROP TABLE IF EXISTS admin_permission;

CREATE TABLE `admin_permission` (
  `admin_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: banners
#

DROP TABLE IF EXISTS banners;

CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `order` int(11) DEFAULT NULL,
  `menu_location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `link` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repository_id` int(11) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO banners (`id`, `parent_id`, `status`, `order`, `menu_location`, `name`, `desc`, `image`, `link`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (1, 0, 1, 1, NULL, 'as', '0', 'ad_720x90-11.png', '', NULL, '2016-04-14 16:51:53', NULL, 'top', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners (`id`, `parent_id`, `status`, `order`, `menu_location`, `name`, `desc`, `image`, `link`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (2, 0, 1, 2, NULL, 'asda', '0', 'banner-300x250.gif', '', NULL, '2016-04-14 16:52:22', NULL, 'home_right', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners (`id`, `parent_id`, `status`, `order`, `menu_location`, `name`, `desc`, `image`, `link`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (3, 0, 1, 3, NULL, 'foor', '0', 'ad_720x90-111.png', '', NULL, '2016-04-15 15:19:06', NULL, 'bottom', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners (`id`, `parent_id`, `status`, `order`, `menu_location`, `name`, `desc`, `image`, `link`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (4, 0, 1, 4, NULL, 'sda', '0', 'banner_left1.jpg', '', NULL, '2016-04-28 07:09:21', NULL, 'post_right', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners (`id`, `parent_id`, `status`, `order`, `menu_location`, `name`, `desc`, `image`, `link`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (5, 0, 1, 5, NULL, 'sdsa', '0', 'staticblock_img1.jpg', '', NULL, '2016-04-28 07:09:42', NULL, 'post_right', NULL, NULL, NULL, NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: banners_lang
#

DROP TABLE IF EXISTS banners_lang;

CREATE TABLE `banners_lang` (
  `id_banner_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `banner_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_banner_lang`),
  KEY `fk_banner_language1` (`language_id`),
  KEY `fk_banner_lang_page1` (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (2, 2, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (5, 4, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (6, 4, 2, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (7, 5, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (8, 5, 2, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (9, 1, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (10, 1, 2, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (13, 3, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO banners_lang (`id_banner_lang`, `banner_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (14, 3, 2, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: c_categories
#

DROP TABLE IF EXISTS c_categories;

CREATE TABLE `c_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `usertype` bigint(20) DEFAULT '0',
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `menu_location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repository_id` int(11) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: c_categories_lang
#

DROP TABLE IF EXISTS c_categories_lang;

CREATE TABLE `c_categories_lang` (
  `id_category_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_category_lang`),
  KEY `fk_page_language1` (`language_id`),
  KEY `fk_page_lang_page1` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: camera
#

DROP TABLE IF EXISTS camera;

CREATE TABLE `camera` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `plan_id` bigint(20) DEFAULT '0',
  `m_id` bigint(20) DEFAULT '0',
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `port` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stream` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `camera_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT '0',
  `dealer_price` double DEFAULT '0',
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'free',
  `payment_id` bigint(20) DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `plan_day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_file` tinyint(4) DEFAULT '0',
  `is_expire` tinyint(4) DEFAULT '0',
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO camera (`id`, `parent_id`, `type`, `order`, `user_id`, `plan_id`, `m_id`, `code`, `name`, `resolution`, `motion`, `username`, `password`, `model`, `ip_address`, `port`, `channel`, `stream`, `camera_num`, `url`, `description`, `price`, `dealer_price`, `payment_type`, `payment_id`, `plan_date`, `plan_day`, `sys_file`, `is_expire`, `created_by`, `on_date`, `date_time`, `created`, `modified`, `enabled`, `status`) VALUES (1, 0, NULL, 2, 2, 1, 0, NULL, 'Bar Camera', 'CFI', 'Enable', 'admin', '123456', 'Custom RTSP Device', 'rtsp://demo.itechproducts.info', '95', '2', '0', '1', 'rtsp://demo.iTechProducts.info:95/user=admin&password=123456&channel=1&stream=1.sdp', NULL, '8', '6', 'paid', 1, '2016-11-21', '3', 1, 0, 'user', '2016-12-01', '2016-12-01 04:14:03', '1480583643', '1480583643', 1, 1);
INSERT INTO camera (`id`, `parent_id`, `type`, `order`, `user_id`, `plan_id`, `m_id`, `code`, `name`, `resolution`, `motion`, `username`, `password`, `model`, `ip_address`, `port`, `channel`, `stream`, `camera_num`, `url`, `description`, `price`, `dealer_price`, `payment_type`, `payment_id`, `plan_date`, `plan_day`, `sys_file`, `is_expire`, `created_by`, `on_date`, `date_time`, `created`, `modified`, `enabled`, `status`) VALUES (5, 0, NULL, 1, 2, 1, 0, NULL, 'url camera NVR', 'VGA 640x480', 'Enable', '', '', 'Custom RTSP Device', '', '', '1', '1', '1', 'rtsp://demo.iTechProducts.info:9095/video1.sdp', NULL, '58', '46', 'free', NULL, NULL, NULL, 1, 0, 'user', '2016-11-30', '2016-11-30 08:40:38', '1480513238', '1480513238', 1, 1);


#
# TABLE STRUCTURE FOR: camera_payment
#

DROP TABLE IF EXISTS camera_payment;

CREATE TABLE `camera_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `owner_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `s_date` date DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `hold` double DEFAULT '0',
  `d_hold` date DEFAULT NULL,
  `classes` varchar(255) DEFAULT NULL,
  `use_class` bigint(20) DEFAULT '0',
  `class_count` bigint(20) DEFAULT '0',
  `is_read` tinyint(4) DEFAULT '0',
  `is_expire` tinyint(4) DEFAULT '0',
  `PayerID` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `currencyCodeType` varchar(255) DEFAULT NULL,
  `paypal_id` varchar(255) DEFAULT NULL,
  `api_username` varchar(255) DEFAULT NULL,
  `api_signature` varchar(255) DEFAULT NULL,
  `api_password` varchar(255) DEFAULT NULL,
  `payment_record` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment` tinyint(4) DEFAULT '0',
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT 'user',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO camera_payment (`id`, `order_id`, `user_id`, `owner_id`, `product_id`, `type`, `name`, `amount`, `price`, `s_date`, `e_date`, `month`, `hold`, `d_hold`, `classes`, `use_class`, `class_count`, `is_read`, `is_expire`, `PayerID`, `token`, `currencyCodeType`, `paypal_id`, `api_username`, `api_signature`, `api_password`, `payment_record`, `payment_type`, `payment`, `on_date`, `on_datetime`, `created_by`, `created`, `modified`) VALUES (1, 0, 2, 1, 1, NULL, '3 days', '8', '8', NULL, NULL, '3', '0', NULL, NULL, 0, 0, 0, 0, '432', '2', 'USD', '1', 'sushant.goralkar-facilitator_api1.gmail.com', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AuKe7kbwoT1tSQmbYkUAVK8.1syK', '1405765594', NULL, 'Paypal', 1, '2016-11-21', '2016-11-21 09:24:00', 'user', '1479738246', '1479738246');


#
# TABLE STRUCTURE FOR: categories
#

DROP TABLE IF EXISTS categories;

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `order` int(11) DEFAULT NULL,
  `menu_location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repository_id` int(11) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: categories_lang
#

DROP TABLE IF EXISTS categories_lang;

CREATE TABLE `categories_lang` (
  `id_category_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_category_lang`),
  KEY `fk_page_language1` (`language_id`),
  KEY `fk_page_lang_page1` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: chat_messages
#

DROP TABLE IF EXISTS chat_messages;

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `username` varchar(255) CHARACTER SET latin1 DEFAULT '',
  `user_type` varchar(255) CHARACTER SET latin1 DEFAULT 'admin',
  `recipient` varchar(255) DEFAULT '',
  `recipient_type` varchar(255) CHARACTER SET latin1 DEFAULT 'admin',
  `recipient_id` int(11) DEFAULT '0',
  `message_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file_name` text,
  `message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` int(11) DEFAULT '0',
  `created` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS ci_sessions;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(255) NOT NULL DEFAULT '0',
  `ip_address` varchar(255) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ceb8bd5f43f6966fe2368bf6e716e655', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480422359, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:9:\"client su\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('655893e1bd1db7a480d4f89c8f727bbf', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 1480422671, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('072472df80e1e44439ee26ed458cb169', '59.88.10.253', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480422675, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f05b46543b32c692fbf7a0ed033d6df9', '10.0.1.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480453067, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:9:\"client su\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('3a11f9079338953acc3d5f96c3502ba8', '166.137.248.52', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480464868, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:7:\"user su\";s:5:\"email\";s:22:\"pvsysgroup00@gmail.com\";s:2:\"id\";s:1:\"1\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a9d5c429471fddeebd0e4f4dccae30e8', '189.103.107.116', 'Wget(linux)', 1480468679, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e3575126df918d8773e085f34df7824b', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480471650, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:9:\"client su\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('7b3b766278a1ea55c679569ca765f5d2', '104.223.17.112', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)', 1480478110, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f0332aa4885b7b37151e7ce51171d2e3', '45.32.128.51', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1480482100, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('16f0c042d1f948501f033511edd52350', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480484290, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:9:\"client su\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('dab5abb34f71e204364477bc8ad8eea0', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480486067, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('18a0ba0ba16d2956a227d107b00d1793', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480490165, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:9:\"client su\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ef9f8a05c9e64abaf60cd608bf868bed', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480505131, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9f041b32b9e9ef838c75550e5c946587', '117.196.184.30', 'Mozilla/5.0 (Linux; Android 4.4.2; M3 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.85 Mobile Sa', 1480505135, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('dc339c365513846b50377d8b56fe00cc', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480505171, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('c4c3a078bf78d97f73f643004807da72', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480505175, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('376b49052f4b0f930f98a775e7301bf5', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480507762, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('97a7cadb44049d6ae2013b4f3bae4328', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480507762, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1cf57f846adfcbf5e994676cd6752a89', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480507991, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('525e688b160e56c7e993809745a24b42', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 1480508155, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:7:\"user su\";s:5:\"email\";s:22:\"pvsysgroup00@gmail.com\";s:2:\"id\";s:1:\"1\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('19f92ececd50c0f9571cd7ef6575d3c6', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480510563, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1af4ba96f4e4d3f4576ae4a35ba69faa', '117.196.178.194', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480510774, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4b726721e7dbb61081d1fa09344b847f', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480512847, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e7388556aa40afcb317be2996cc32628', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480513004, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a9152af95fc99cb5dcffca9cddab3a8f', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480513037, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('108595e1340045b0cf804aaa432710fa', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480515659, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ccc5e9e347b662bfa91707184f6f18d4', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480515779, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('7e5210d49278157f000f9ac903cb9371', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480526567, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('113a4bacc90a555ec92c0587fad9ff41', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480527472, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('070e723a25560afd948e4c5ea3af42ff', '182.118.54.24', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2251.0 Safari/537.36', 1480527774, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e7051a8128dfaf6c5581c0add8cc4df0', '54.172.166.49', '0', 1480532582, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ebc13c4141a4c76ca3775295fdbeb03d', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480555636, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('88bb540bce17ea3028865c932deaf739', '197.231.221.211', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:48.0) Gecko/20100101 Firefox/48.0', 1480561904, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('88b94b19c0aeba619f0efe1ca41e7409', '169.56.71.53', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 1480567700, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('deb72b1f969416ab1f28d7731f353353', '157.55.39.185', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1480577070, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('87f303bcb3ce1e99fa6c3e9f74c54398', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480581095, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a1e5518799c97818dbb67a8e4d61b81a', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480581111, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('d35f8911ddb479cf239dea4a33c2a5b4', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480582441, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a8e16f53a45b5c3125ab06f137dfd265', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480582876, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('09d1bc2924f802237ca7735f4822a6d2', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480582876, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('79ade7f76ee7994734edffa789526f26', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480582891, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('345996ec84b6486995366e9d20a30074', '66.249.79.162', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585077, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('b6dad0555f4b2c62c3677bd291fb3ad2', '66.249.79.158', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585197, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('518812e6421b8a5e23855914dc6930da', '66.249.79.166', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585261, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('73a2ed988f7429c35b1d7db094b4969a', '66.249.79.162', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585309, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5df5dc9b372b24beb1619cef3ae0e8fb', '66.249.79.158', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585365, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('2bfc9ebed5064321861ff4d7cde79fb6', '66.249.79.166', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585425, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('01bb3eacf065865972d3ea807070e233', '66.249.79.162', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480585489, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('d27ea3bb94730ff893efb73d0a4dbc39', '198.20.69.74', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36', 1480586350, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8d76cb2586d273567cd75ef48e51f3ce', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480595829, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4fd0e74246323aa752bf3976616f11c7', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480613215, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8eea7d48000854b08303385379a5c957', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480606419, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5384972bc57e7d899fe3803e12b316a9', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480606419, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('935d1b0a8a54220a134c01bfb602e0cb', '178.17.174.55', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1480609187, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('cac7a14d13b2a033364fb072d60524f9', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480610068, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1272c28b1335d004d24aa651547a0201', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480610069, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ee662f8190a9c0c356469893decc1500', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480610073, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f69028f24a0574d1784c013d459d8a0f', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480611251, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e116820bd170332b67803ad4592da045', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480611251, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('92a193ceabe51c6f4302e107fdb0c170', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480611251, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('d10279f258575feb6d16107fa0d8dfa8', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480611251, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('11045bfda2733be31054372300098a78', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480611251, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('cbaba2872cd9746820b8950746aeb027', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('edaf742e063946d7fd9ea445d43dde3f', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480611255, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('32948122df8272b1b245a7879b0c2a1d', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480611255, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4ff1d9b58fc81b813cd6f7935b4bccb2', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480611255, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('d3ee46287f69d47e19c99ff3b49fa631', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480611255, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4613108a191b6e3e6409e5e0718685c2', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480614573, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f4e560eaa225607771dcde3ed07f5dde', '73.184.143.140', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_1_1 like Mac OS X) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0 Mobile/14', 1480613152, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6e97e973f6d3f37fe64207978635ca91', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480613256, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9cde066477bc7f29890cdce599565301', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480613256, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('99f5338429ebc77c115ac3a95679b1fa', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480613256, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('0b921bd502d5fc0c8ed0f201e582670f', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480613256, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('da269cf7093a93bf4169bcb696716744', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480613267, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('b781644a933aa9a25b296da352dfd851', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8e5dfdb0863d99a27115895bb2731e4b', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8e1b5c2cf7eaa2be5f07fbaab5d259f1', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('2d1fe84ca77f88d9171004ba5171bb2e', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('221b7103317b04939f7faf720339d5e0', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e2bed01a9bdf11f74145a446d046ddeb', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6d3794bd5c6c0373a8748a3b46a1d633', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ea6cc832655cbba2aa53936f8ab4a897', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('93acec4d76f2e62ef9a3eefc030ad775', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('c0f7929b503a0b41a6e37d2cfd9e9d62', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('85546a1fff35e953dcf53b5fc372b525', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5d0431be6857a982a824bbff0d58bb77', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9adcac447555459c0b73279cbc677b1d', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8c0800ace0991967a44a242cabefae21', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f8976c69ca119e7e321b29f56a88633f', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('3a474a5e21161d9a2481006d7abf0c52', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('51e8a822c236e733e3dd8ee30da5d5ad', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a75a5721c799675c63e847439363cc20', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('36e153bd2808c428d1eebdbcf96a8fa4', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('07b2ea9f801f0cee1dcef0f0ff8b85f6', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f65214b85e3b327d3f8cf5fb05122866', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('071681a9c671014e59a1d79984c79e6c', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a2322200aa38b1374e6f8538039b9c81', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5d720cc9a915d91a1a0ddf06d8231a3b', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a18bd621087e74e1c406322e93d5a093', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('16cce32702c0c1bc4bf5c299df08cc67', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('de4fc68b61016f821a9f02a3089c5197', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('fa9827d33ded9e5a024aafba7b9539a4', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e41a0f7c0a593ab7314564087faec8b5', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('3e2215e14448d910a25eed7e0ed5d8e8', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('340abda4b31a884b977615c901b485c2', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4871c0b508078ace0e04635875c5309a', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480626193, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6049de46832cc7f9a27cb5086eb64199', '10.0.1.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480719648, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('00fffdb6a250570935c9cc47ae344ab2', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480650076, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9dd04a5dec1b3490b48c3cd7f64503f0', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480653768, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('2ecf5dc580f63ab9a050beab9af7ee0c', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480658476, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('40aa95d3fe959c6cd2b2a395f111e806', '66.249.66.61', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656257, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('732d3a8d897d653f586a2339d27f3e43', '66.249.66.55', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656457, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('60b38575969fc0a1101221baa2f193fb', '66.249.66.58', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656487, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('33113b3a5e6e00a72c2411fde3810586', '66.249.66.55', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656520, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4a34497837a1265192cc32b50d5c5868', '66.249.66.58', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656564, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('70001d0118d564ec98ca92ba16a9ef0a', '66.249.69.11', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656675, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('35dc771d59e94aa8dba90dcf91dc9954', '66.249.69.7', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656676, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8881ae3c56d8463cdd17b2d6ae210ad5', '66.249.69.4', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480656770, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4f59e74deaecf4f2c7007a7184b06915', '66.249.69.8', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480657702, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6847550123507135fee47fbadd80a712', '66.249.69.61', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480657726, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9dab1b2b741b3591a330d8a5aea54960', '66.249.69.4', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480657755, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('de28c700d610d8d72a9e6e69e4ee0806', '66.249.69.61', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480657791, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a24d6e91190140b9f68860d7d57540c3', '73.184.143.140', 'Mozilla/5.0 (iPad; CPU OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F69 Safari/600', 1480663604, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('bb39f5fa4c27823357d0b35a7a244970', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 1480665097, 'a:3:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}s:13:\"admin_session\";a:5:{s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:15:\"admin@gmail.com\";s:2:\"id\";s:1:\"1\";s:11:\"logged_type\";s:5:\"admin\";s:8:\"loggedin\";b:1;}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('930d04cc301a0131176d8a30c972f801', '61.1.40.114', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480666431, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('33624b95129e6aa8d6bfaafceddb9c10', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480667275, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('7ed057a33e3b481b907976f768c4b08f', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480667277, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('c4ca637c7bfe15848cf4bbe3f5d816f5', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480667301, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5682fa65d5846e195f244b0f8d7ac424', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/', 1480667303, 'a:3:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}s:13:\"admin_session\";a:5:{s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:15:\"admin@gmail.com\";s:2:\"id\";s:1:\"1\";s:11:\"logged_type\";s:5:\"admin\";s:8:\"loggedin\";b:1;}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('636d83509558a358c39daeced09997bc', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/', 1480667304, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a527260935ea6743a61420f06f44de95', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480667345, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9649afd1061110f0971483d3d5149a60', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/', 1480667395, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4cb0d76f424c672e98d444970602eedc', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480667406, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4b8d1d4b91b37adfdbea76afe9da407c', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480668312, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('36c07a522e1c0194ea4230f016880847', '73.184.143.140', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480668312, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('145e5c02b8dde1d1414a0cbea512e947', '61.1.40.114', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480670992, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('98a4d9e531fc98aa1cdfae0ff0972778', '66.249.69.15', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mob', 1480672665, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('aada90f063d51e0bf6618d2a3dc4a49f', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 1480676118, 'a:4:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}s:13:\"admin_session\";a:5:{s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:15:\"admin@gmail.com\";s:2:\"id\";s:1:\"1\";s:11:\"logged_type\";s:5:\"admin\";s:8:\"loggedin\";b:1;}s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:7:\"user su\";s:5:\"email\";s:22:\"pvsysgroup00@gmail.com\";s:2:\"id\";s:1:\"1\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('d53801fedca8201aa0000c1fc89be643', '37.187.129.166', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:48.0) Gecko/20100101 Firefox/48.0', 1480679358, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('703313cefcb3f9f5640818a2c1220095', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 1480684439, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('74ae11b96a0cf7aded873cd3c26fc2dc', '66.249.69.11', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480700508, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e38c3c564bd43524158fe40e9d9283b7', '10.0.1.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1480700995, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8ec1b2a99caa286a614db32eadfb570d', '61.14.229.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 1480743060, 'a:3:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}s:13:\"admin_session\";a:5:{s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:15:\"admin@gmail.com\";s:2:\"id\";s:1:\"1\";s:11:\"logged_type\";s:5:\"admin\";s:8:\"loggedin\";b:1;}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('96cecf586909b8ee4056a3b6cee36742', '139.201.126.235', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)', 1480695484, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ebdf1def84bf65e149741e697b963a4f', '148.62.14.156', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.71 Safari/534.24', 1480695546, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('62d27c5db35aaa42ce5eec61aa03cbd1', '117.196.178.182', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480698407, 'a:3:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}s:13:\"admin_session\";a:5:{s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:15:\"admin@gmail.com\";s:2:\"id\";s:1:\"1\";s:11:\"logged_type\";s:5:\"admin\";s:8:\"loggedin\";b:1;}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1f32fb1eb616862dcc3aae4476442246', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480698168, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('897d784fc8e83581cbed79ccc09e596a', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480698169, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4d87f49fa464debe2aaad1024283c188', '23.99.101.118', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480698544, 'a:2:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('01d4b681ab047dd055adcd47264bb563', '40.78.146.128', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480698547, 'a:2:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a642c2b85a17cc25d94c8b77fb8c35eb', '104.238.217.130', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 (https://shrinkthe', 1480701110, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('d0d3783ec3ff6244e5c197fa17bd5ea1', '10.0.1.1', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480708840, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('7fa3556af40e145f0c08dae318448121', '66.249.69.11', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480701378, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('781523cfcdffc2b6e4676f6e83e32fc7', '89.248.172.16', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36', 1480718735, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8479b4144b98f11cfcc34bc18060ff25', '10.0.1.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480702573, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f1cd5089e5a61aa6b4e861300dd9e259', '13.76.241.210', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480703062, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('7e4fb1f81af5536b21c08af961246e7e', '10.0.1.1', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G930A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480705383, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('363ccbfa003cf1b476fc2b24ece85eb8', '195.2.253.2', 'masscan/1.0 (https://github.com/robertdavidgraham/masscan)', 1480703437, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('0f3ea7c4fb8d34d51717102efa409ff1', '104.209.188.207', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1480703590, 'a:2:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('46f6d37621a04179768ea60456850ec9', '10.0.1.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1480716848, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('8caec3d48a84ce58ecbf03e5dcad856c', '148.62.14.156', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.71 Safari/534.24', 1480703953, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('5aee7654c0245a527e125a8cbaff08ee', '148.62.14.156', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.71 Safari/534.24', 1480704617, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('b6527ae7ddd50399b36bc41ba66d5e45', '148.62.14.156', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.71 Safari/534.24', 1480704802, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('cb1ddb844199141106cc86cb53869abd', '75.149.221.170', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9', 1480704864, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('75a7e3a12da36dccc8fe7fba2bc7338a', '10.0.1.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1480706992, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('a81ef6a46a515859f1008fb1cd2282e0', '66.249.69.7', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480720481, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f1514af5fd81d4eb1db75c02ec302a35', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726104, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('c2f5157ca5bad736cdcfd5f1567c1227', '10.0.1.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_1_1 like Mac OS X) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0 Mobile/14', 1480710099, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"user_session\";a:5:{s:9:\"loginType\";s:4:\"user\";s:8:\"loggedin\";b:1;s:4:\"name\";s:6:\"client\";s:5:\"email\";s:22:\"pvsysgroup01@gmail.com\";s:2:\"id\";s:1:\"2\";}}');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('85ab8d007d21cbd45fadd7624147903c', '66.249.69.11', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mob', 1480715912, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('92ee7cd42d0c3d068742f9c46d3a5af7', '69.58.178.57', 'BlackBerry9000/4.6.0.167 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/102 ips-agent', 1480726106, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('673f64deba82d1c75d2f1eacb352369b', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726107, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('b9f4f385d1c473f3084d02b27f11d5e0', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726109, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('da281958625820e7d4b470991e350cdb', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726110, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1becb34a0289e3a90a885d9c35a3a21f', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726112, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('103937345abf729dfd5c58f1eae200af', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726113, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('36a4d061d70080e9eb51549a3db900e2', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726114, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('f24125944282e786e9a3f6eccdd900ce', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726115, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6a0dd3a5ef75e2e3636b1f3ab49ff53a', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726116, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4a6c52ce159dcd0d429178e6e82f258b', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726117, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('899937da3203e568ca7b84748816b71e', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726118, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1121383d1cd6e35b8fc645bdccea29ff', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726119, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('e3816588a9594ad68aa8d280c3d0b14b', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726121, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('ce7900137e6a55c6e430241915027baa', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726122, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('00f5b70fbce0bd87f1c2e27312633169', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726123, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('3ed67c6314d87520f3f0f0056c19f8b8', '69.58.178.57', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:14.0; ips-agent) Gecko/20100101 Firefox/14.0.1', 1480726124, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6c448310a539bf18025c372c13d396b8', '107.77.104.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_0_2 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14', 1480730924, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('6a645c846d19ca3b6e8a05a0154a8faa', '107.77.104.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_0_2 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14', 1480730928, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('9e91e23d91a385fe827380147851147c', '188.165.206.188', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 1480738325, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('87868904f35956a0dd99030f7bf63ea1', '66.249.69.7', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480738875, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('1b0058db54e6605b0cf06078d5575890', '66.249.69.11', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480738969, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('13c0acce3a069940ad64faf7e6c16874', '66.249.69.61', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480739037, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('56579d85dae2bd6ba4174cb33a54d6d6', '66.249.69.61', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1480739133, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('dc1ada2d7b60ac155809fde1a28d2477', '107.77.90.77', 'Mozilla/5.0 (Linux; Android 6.0.1; SAMSUNG-SM-G935A Build/MMB29M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1480740542, '');
INSERT INTO ci_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('65ea97fc4ac143f7b933cd66354d48f3', '73.184.143.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/', 1480747601, 'a:2:{s:9:\"user_data\";s:0:\"\";s:16:\"adminLangSession\";a:2:{s:9:\"lang_code\";s:2:\"EN\";s:7:\"lang_id\";s:1:\"1\";}}');


#
# TABLE STRUCTURE FOR: cities
#

DROP TABLE IF EXISTS cities;

CREATE TABLE `cities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `region_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `on_date` date DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO cities (`id`, `parent_id`, `region_id`, `order`, `name`, `desc`, `country`, `country_code`, `image`, `on_date`, `slug`, `created`, `modified`, `enabled`) VALUES (7, 0, 10, 5, 'San Martín Texmelucan', NULL, '5', NULL, NULL, NULL, NULL, '1471919947', '1471919947', 1);
INSERT INTO cities (`id`, `parent_id`, `region_id`, `order`, `name`, `desc`, `country`, `country_code`, `image`, `on_date`, `slug`, `created`, `modified`, `enabled`) VALUES (8, 0, 10, 6, 'Puebla', NULL, '5', NULL, NULL, NULL, NULL, '1472340947', '1472340947', 1);
INSERT INTO cities (`id`, `parent_id`, `region_id`, `order`, `name`, `desc`, `country`, `country_code`, `image`, `on_date`, `slug`, `created`, `modified`, `enabled`) VALUES (9, 0, 10, 7, 'Cholula', NULL, '5', NULL, NULL, NULL, NULL, '1472340971', '1472340973', 1);


#
# TABLE STRUCTURE FOR: content
#

DROP TABLE IF EXISTS content;

CREATE TABLE `content` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO content (`id`, `parent_id`, `name`, `order`, `type`, `link`, `video`, `date`, `created`, `modified`, `enabled`) VALUES (1, 0, NULL, NULL, 'home', '', NULL, '2016-11-18 08:38:21', NULL, '1473337356', 1);
INSERT INTO content (`id`, `parent_id`, `name`, `order`, `type`, `link`, `video`, `date`, `created`, `modified`, `enabled`) VALUES (2, 0, NULL, NULL, 'contact', NULL, NULL, '2015-10-27 10:20:49', NULL, NULL, 1);
INSERT INTO content (`id`, `parent_id`, `name`, `order`, `type`, `link`, `video`, `date`, `created`, `modified`, `enabled`) VALUES (3, 0, NULL, NULL, 'dealer term & condition', '', NULL, '2016-12-02 05:59:10', NULL, NULL, 1);
INSERT INTO content (`id`, `parent_id`, `name`, `order`, `type`, `link`, `video`, `date`, `created`, `modified`, `enabled`) VALUES (4, 0, NULL, NULL, 'footer', NULL, NULL, '2015-11-16 11:24:49', NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: content_lang
#

DROP TABLE IF EXISTS content_lang;

CREATE TABLE `content_lang` (
  `id_content_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `content_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_content_lang`),
  KEY `fk_page_language1` (`language_id`),
  KEY `fk_page_lang_page1` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO content_lang (`id_content_lang`, `content_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`) VALUES (37, 1, 1, NULL, NULL, '<div class=\"aa-title\">\n<h2>Welcome To RemoteSecurityVideoSolution</h2>\n</div>\n\n<p>This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;</p>\n\n<p>This is description.&nbsp;This is description.&nbsp;This is description.</p>\n', NULL, NULL, NULL);
INSERT INTO content_lang (`id_content_lang`, `content_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`) VALUES (38, 1, 2, NULL, NULL, '<div class=\"aa-title\">\n<h2>Bienvenidos a Sportiv</h2>\n</div>\n\n<p>&iexcl;pagina en Construccion!&nbsp;&iexcl;pagina en Construccion!&nbsp;&iexcl;pagina en Construccion!&nbsp;&iexcl;pagina en Construccion!&nbsp;&iexcl;pagina en Construccion!</p>\n\n<p>&iexcl;pagina en Construccion!</p>\n', NULL, NULL, NULL);
INSERT INTO content_lang (`id_content_lang`, `content_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`) VALUES (39, 3, 1, NULL, NULL, '<p>This is tearm &amp; condition page, This is tearm &amp; condition page, This is tearm &amp; condition page,</p>\n\n<p>This is tearm &amp; condition page, This is tearm &amp; condition page, This is tearm &amp; condition page.</p>\n', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: countries
#

DROP TABLE IF EXISTS countries;

CREATE TABLE `countries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO countries (`id`, `parent_id`, `order`, `name`, `desc`, `code`, `on_date`, `created`, `modified`, `enabled`) VALUES (5, 0, 8, 'Mexico', '0', NULL, NULL, '1471919901', '1471919901', 1);


#
# TABLE STRUCTURE FOR: documents
#

DROP TABLE IF EXISTS documents;

CREATE TABLE `documents` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `files` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: documents_user
#

DROP TABLE IF EXISTS documents_user;

CREATE TABLE `documents_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `document_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `gym_id` bigint(20) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `files` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: email
#

DROP TABLE IF EXISTS email;

CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (1, 'email varification', 'Welcome  To {site_name}!', '<p>hello {user_name},</p>\n\n<p>Thank you for registration. Please here for verification <a href=\"{site_link}\">Click Here</a>.</p>', '1410165891', '1479137345', 1, 0);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (2, 'confirm user to admin', 'User Verification Success', '<div style=\"border: solid #666;\">\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\n<h1>{site_name}</h1>\n</div>\n\n<div style=\"background-color: #fff; color: #000;\">\n<h3 style=\"margin-left:20px\">Dear Admin,</h3>\n</div>\n\n<div style=\"background-color: #999; color: #fff;\">\n<h3 style=\"margin-left:20px\">User Email: <strong>{user_email}</strong></h3>\n\n<h3 style=\"margin-left:20px\">User Password: {user_password}</h3>\n</div>\n\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\n<p>Regards,<br />\n<br />\n{site_name} Team</p>\n</div>\n</div>', '1410165891', '1447914428', 1, 0);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (3, 'send mail to created store user', 'Welcome to {site_name}', '<div style=\"border: solid #666;\">\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\n<h1>{site_name}</h1>\n</div>\n\n<div style=\"background-color: #fff; color: #000;\">\n<h3 style=\"margin-left:20px\">Dear {user_name}</h3>\n</div>\n\n<div style=\"background-color: #999; color: #fff;\">\n<h3 style=\"margin-left:20px\">Email: {user_email}</h3>\n\n<h3 style=\"margin-left:20px\">Password: {password}</h3>\n\n<h3 style=\"margin-left:20px\">Store: {store_name}</h3>\n\n<h3 style=\"margin-left:20px\">Login link:<a href=\"{login_link}\">Click here</a></h3>\n</div>\n\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\n<p>Regards,<br />\n<br />\n{site_name} Team</p>\n</div>\n</div>', '1410165891', '1449323591', 1, 1);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (4, 'contact', 'Welcome To {site_name}', '<div style=\"border: solid #666;\">\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\n<h1>{site_name}</h1>\n</div>\n\n<div style=\"background-color: #fff; color: #000;\">\n<h3 style=\"margin-left:20px\">Dear admin</h3>\n</div>\n\n<div style=\"background-color: #999; color: #fff;\">\n<h3 style=\"margin-left:20px\">Name: {name}</h3>\n\n<h3 style=\"margin-left:20px\">Email: {email}</h3>\n\n<h3 style=\"margin-left:20px\">Subject: <strong>{subject}</strong></h3>\n\n<h3 style=\"margin-left:20px\">Message: <strong>{message}</strong></h3>\n\n<p>&nbsp;</p>\n</div>\n\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\n<p>Regards,<br />\n<br />\n{site_name} Team</p>\n</div>\n</div>', '1410165891', '1479137360', 1, 0);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (5, 'mail order to user', 'Welcome to {site_name}', '<div style=\"border: solid #666;\">\r\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\r\n<h1>{site_name}</h1>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000;\">\r\n<h3 style=\"margin-left:20px\">Dear Admin</h3>\r\n</div>\r\n\r\n<div style=\"background-color: #999; color: #fff;\">\r\n<p style=\"margin-left:20px\">A ticket has been created by {user_name} ( {company_name} )\r\nTo view the ticket <a href=\"{ticket_link}\">click here</a></p>\r\n\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\r\n<p>Regards,<br />\r\n<br />\r\n{site_name} Team</p>\r\n</div>\r\n</div>\r\n', '1410165891', '1438763602', 1, 1);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (6, 'mail order to admin', 'Welcome to {site_name}', '<div style=\"border: solid #666;\">\r\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\r\n<h1>{site_name}</h1>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000;\">\r\n<h3 style=\"margin-left:20px\">Dear {user_name}</h3>\r\n</div>\r\n\r\n<div style=\"background-color: #999; color: #fff;\">\r\n<p style=\"margin-left:20px\">Your ticket has been created and sent to admin for review To view the ticket <a href=\"{ticket_link}\">click here</a></p>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\r\n<p>Regards,<br />\r\n<br />\r\n{site_name} Team</p>\r\n</div>\r\n</div>\r\n', '1410165891', '1423130494', 1, 1);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (7, 'invoice to pdf', 'Welcome to {site_name}', '<div style=\"border: solid #666;\">\r\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\r\n<h1>{site_name}</h1>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000;\">\r\n<h3 style=\"margin-left:20px\">Dear admin</h3>\r\n</div>\r\n\r\n<div style=\"background-color: #999; color: #fff;\">\r\n<p style=\"margin-left:20px\">You have updated the ticket {ticket_id} from open to in progress.\r\nTo view the ticket <a href=\"{ticket_link}\">click here</a></p>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\r\n<p>Regards,<br />\r\n<br />\r\n{site_name} Team</p>\r\n</div>\r\n</div>\r\n', '1410165891', '1449155973', 1, 1);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (8, 'mail order to store', 'Welcome to {site_name}', '<div style=\"border: solid #666;\">\r\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\r\n<h1>{site_name}</h1>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000;\">\r\n<h3 style=\"margin-left:20px\">Dear {user_name}</h3>\r\n</div>\r\n\r\n<div style=\"background-color: #999; color: #fff;\">\r\n<p style=\"margin-left:20px\">Your ticket {ticket_id} has been update by admin\r\nTo view the ticket <a href=\"{ticket_link}\">click here</a></p>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\r\n<p>Regards,<br />\r\n<br />\r\n{site_name} Team</p>\r\n</div>\r\n</div>\r\n', '1410165891', '1449498733', 1, 1);
INSERT INTO email (`id`, `name`, `subject`, `message`, `created`, `modified`, `status`, `deleted`) VALUES (9, 'send mail to created employee', 'Welcome to {site_name}', '<div style=\"border: solid #666;\">\r\n<div style=\"background-color: #000; color: #fff; text-align: center;\">\r\n<h1>{site_name}</h1>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000;\">\r\n<h3 style=\"margin-left:20px\">Dear {user_name}</h3>\r\n</div>\r\n\r\n<div style=\"background-color: #999; color: #fff;\">\r\n<h3 style=\"margin-left:20px\">Email: {user_email}</h3>\r\n\r\n<h3 style=\"margin-left:20px\">Password: {password}</h3>\r\n\r\n\r\n<h3 style=\"margin-left:20px\">Login link:<a href=\"{login_link}\">Click here</a></h3>\r\n</div>\r\n\r\n<div style=\"background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;\">\r\n<p>Regards,<br />\r\n<br />\r\n{site_name} Team</p>\r\n</div>\r\n</div>', NULL, NULL, 1, 0);


#
# TABLE STRUCTURE FOR: feedback
#

DROP TABLE IF EXISTS feedback;

CREATE TABLE `feedback` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_publish` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `publish_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS groups;

CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `camera_id` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO groups (`id`, `parent_id`, `user_id`, `camera_id`, `name`, `description`, `created_by`, `on_date`, `date_time`, `created`, `modified`, `enabled`) VALUES (1, 0, 2, '1', 'Group 1', NULL, 'user', '2016-12-02', '2016-12-02 07:56:10', '1480683370', '1480683370', 1);
INSERT INTO groups (`id`, `parent_id`, `user_id`, `camera_id`, `name`, `description`, `created_by`, `on_date`, `date_time`, `created`, `modified`, `enabled`) VALUES (2, 0, 2, '1,5', 'Group 2', NULL, 'user', '2016-12-02', '2016-12-02 07:56:24', '1480683384', '1480683384', 1);


#
# TABLE STRUCTURE FOR: groups_c
#

DROP TABLE IF EXISTS groups_c;

CREATE TABLE `groups_c` (
  `user_id` bigint(20) DEFAULT '0',
  `group_id` bigint(20) DEFAULT '0',
  `camera_id` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO groups_c (`user_id`, `group_id`, `camera_id`) VALUES (2, 1, 1);
INSERT INTO groups_c (`user_id`, `group_id`, `camera_id`) VALUES (2, 2, 1);
INSERT INTO groups_c (`user_id`, `group_id`, `camera_id`) VALUES (2, 2, 5);


#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS language;

CREATE TABLE `language` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` tinyint(4) DEFAULT '0',
  `image` text COLLATE utf8_unicode_ci,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` double DEFAULT '1',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO language (`id`, `code`, `language`, `default`, `image`, `currency`, `unit`, `created`, `modified`, `enabled`) VALUES (1, 'EN', 'English U.S', 1, 'US.png', 'Dollar', '1', NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: memberships
#

DROP TABLE IF EXISTS memberships;

CREATE TABLE `memberships` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT NULL,
  `price2` double DEFAULT '0',
  `c_point` double DEFAULT '0',
  `month` int(11) DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Public',
  `member` double DEFAULT '0',
  `plan_id` bigint(20) DEFAULT '0',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (1, 0, 1, '3 days', 'asd dasd asda', '8', '6', '0', 3, NULL, 'Public', '0', 1, '1479728696', '1479740232', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (2, 0, 2, '3 days', 'asd sdjl', '13', '10', '0', 3, NULL, 'Public', '0', 2, '1479728717', '1479740132', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (3, 0, 3, '7 days', 'This is description. This is description. This is description. This is description. This is description. \nThis is description. This is description.', '15', '12', '0', 7, NULL, 'Public', '0', 1, '1479739962', '1479739962', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (4, 0, 4, '15 days', 'This is description. This is description. This is description. This is description. This is description. \nThis is description. This is description.', '30', '24', '0', 15, NULL, 'Public', '0', 1, '1479739988', '1479740068', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (5, 0, 5, '30 days', 'This is description. This is description. This is description. This is description. This is description. \nThis is description. This is description.', '58', '46', '0', 30, NULL, 'Public', '0', 1, '1479740101', '1479740101', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (6, 0, 6, '7 days', '', '26', '20', '0', 7, NULL, 'Public', '0', 2, '1479740155', '1479740155', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (7, 0, 7, '15 days', 'This is description. This is description. This is description. This is description. This is description. \nThis is description. This is description.', '50', '40', '0', 15, NULL, 'Public', '0', 2, '1479740175', '1479740175', 1);
INSERT INTO memberships (`id`, `parent_id`, `order`, `name`, `desc`, `price`, `price2`, `c_point`, `month`, `slug`, `type`, `member`, `plan_id`, `created`, `modified`, `enabled`) VALUES (8, 0, 8, '30 days', 'This is description. This is description. This is description. This is description. This is description. \nThis is description. This is description.', '75', '60', '0', 30, NULL, 'Public', '0', 2, '1479740215', '1479740215', 1);


#
# TABLE STRUCTURE FOR: news
#

DROP TABLE IF EXISTS news;

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `menu_location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` text COLLATE utf8_unicode_ci,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repository_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: news_lang
#

DROP TABLE IF EXISTS news_lang;

CREATE TABLE `news_lang` (
  `id_page_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_page_lang`),
  KEY `fk_page_language1` (`language_id`),
  KEY `fk_page_lang_page1` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: newsletters
#

DROP TABLE IF EXISTS newsletters;

CREATE TABLE `newsletters` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: ownner_m_history
#

DROP TABLE IF EXISTS ownner_m_history;

CREATE TABLE `ownner_m_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `ownner_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `s_date` date DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `plan_month` double DEFAULT '0',
  `plan_coach` double DEFAULT '0',
  `plan_member` double DEFAULT '0',
  `plan_staff` double DEFAULT '0',
  `plan_competition` double DEFAULT '0',
  `plan_sport` double DEFAULT '0',
  `plan_business` double DEFAULT '0',
  `plan_photograph` double DEFAULT '0',
  `plan_tournament` double DEFAULT '0',
  `classes` varchar(255) DEFAULT NULL,
  `class_count` bigint(20) DEFAULT '0',
  `token` varchar(255) DEFAULT '',
  `PayerID` varchar(255) DEFAULT '',
  `currencyCodeType` varchar(255) DEFAULT '',
  `credits` double DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `a_bank_name` varchar(255) DEFAULT NULL,
  `a_bank_account` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_num` varchar(255) DEFAULT NULL,
  `api_username` varchar(255) DEFAULT NULL,
  `api_password` varchar(255) DEFAULT NULL,
  `api_signature` varchar(255) DEFAULT NULL,
  `payment_record` text,
  `is_read` tinyint(4) DEFAULT '0',
  `status` varchar(255) DEFAULT 'Pending',
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT 'user',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: p_categories
#

DROP TABLE IF EXISTS p_categories;

CREATE TABLE `p_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: page
#

DROP TABLE IF EXISTS page;

CREATE TABLE `page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `region_id` bigint(20) DEFAULT '0',
  `parent_id` bigint(20) DEFAULT '0',
  `top_menu` tinyint(4) DEFAULT '0',
  `middle_menu` tinyint(4) DEFAULT '0',
  `bottom_menu` tinyint(4) DEFAULT '0',
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_banner` tinyint(4) DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `order` int(11) DEFAULT NULL,
  `menu_location` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repository_id` int(11) DEFAULT NULL,
  `route_id` bigint(11) DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO page (`id`, `region_id`, `parent_id`, `top_menu`, `middle_menu`, `bottom_menu`, `color`, `is_banner`, `image`, `order`, `menu_location`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (1, 0, 0, 1, 0, 1, '0', NULL, 'slider6.jpg', 2, NULL, NULL, '2015-12-02 12:51:14', NULL, 'page', 'about-us', NULL, NULL, NULL, NULL, 1);
INSERT INTO page (`id`, `region_id`, `parent_id`, `top_menu`, `middle_menu`, `bottom_menu`, `color`, `is_banner`, `image`, `order`, `menu_location`, `type`, `date`, `date_publish`, `template`, `slug`, `repository_id`, `route_id`, `created`, `modified`, `enabled`) VALUES (2, 0, 0, 0, 0, 1, '0', NULL, NULL, 3, NULL, NULL, '2015-12-02 12:56:18', NULL, 'contact', 'Contact-Us', NULL, NULL, NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: page_files
#

DROP TABLE IF EXISTS page_files;

CREATE TABLE `page_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slide_lang` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  `page_id` bigint(20) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: page_lang
#

DROP TABLE IF EXISTS page_lang;

CREATE TABLE `page_lang` (
  `id_page_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `navigation_title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_page_lang`),
  KEY `fk_page_language1` (`language_id`),
  KEY `fk_page_lang_page1` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO page_lang (`id_page_lang`, `page_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (59, 2, 1, 'Contact Us', '0', '<p>In case of any problem , Please contact.</p>\n', NULL, '', '', NULL, NULL, 1);
INSERT INTO page_lang (`id_page_lang`, `page_id`, `language_id`, `title`, `navigation_title`, `body`, `description`, `short_description`, `keywords`, `created`, `modified`, `enabled`) VALUES (75, 1, 1, 'About us', '0', '<p>PAGE</p>\n\n<p>This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page. This is about us page.This is about us page.</p>\n', NULL, '', '', NULL, NULL, 1);


#
# TABLE STRUCTURE FOR: partner_sliders
#

DROP TABLE IF EXISTS partner_sliders;

CREATE TABLE `partner_sliders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO partner_sliders (`id`, `parent_id`, `type`, `status`, `order`, `name`, `description`, `image`, `link`, `created`, `modified`, `enabled`) VALUES (1, 0, '0', 1, 1, 'user', 'asdad', 'brad-pitt111.jpg', NULL, '1454426972', '1454426972', 1);
INSERT INTO partner_sliders (`id`, `parent_id`, `type`, `status`, `order`, `name`, `description`, `image`, `link`, `created`, `modified`, `enabled`) VALUES (2, 0, '0', 1, 2, 'asdas', 'asdad', 'apple.jpg', NULL, '1454426990', '1454426990', 1);


#
# TABLE STRUCTURE FOR: parts
#

DROP TABLE IF EXISTS parts;

CREATE TABLE `parts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `admin_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: parts_lang
#

DROP TABLE IF EXISTS parts_lang;

CREATE TABLE `parts_lang` (
  `id_part_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) DEFAULT NULL,
  `language_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_part_lang`),
  KEY `fk_tag_language1` (`language_id`),
  KEY `fk_tag_lang_page1` (`part_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: payment_setting
#

DROP TABLE IF EXISTS payment_setting;

CREATE TABLE `payment_setting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sandbox` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO payment_setting (`id`, `currency`, `sandbox`, `signature`, `password`, `username`, `created`, `modified`, `enabled`) VALUES (1, NULL, '1', '8a82941854afc7250154ba5ec43517ec', '7dBpneBfMN', '8a82941854afc7250154ba5ea4b917ea', NULL, '1463491756', 1);


#
# TABLE STRUCTURE FOR: paypal_setting
#

DROP TABLE IF EXISTS paypal_setting;

CREATE TABLE `paypal_setting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sandbox` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO paypal_setting (`id`, `currency`, `sandbox`, `signature`, `password`, `username`, `created`, `modified`, `enabled`) VALUES (1, NULL, '1', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AuKe7kbwoT1tSQmbYkUAVK8.1syK', '1405765594', 'sushant.goralkar-facilitator_api1.gmail.com', NULL, '1473262325', 1);


#
# TABLE STRUCTURE FOR: plans
#

DROP TABLE IF EXISTS plans;

CREATE TABLE `plans` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `details` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT '0',
  `discount_price` double DEFAULT '0',
  `image` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `is_feature` tinyint(4) DEFAULT '0',
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  `confirm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO plans (`id`, `parent_id`, `type`, `admin_id`, `user_id`, `slug`, `code`, `order`, `name`, `description`, `details`, `price`, `discount_price`, `image`, `address`, `is_feature`, `created_by`, `on_date`, `date_time`, `created`, `modified`, `enabled`, `confirm`, `status`) VALUES (1, 0, NULL, 1, 0, NULL, NULL, 1, '7 fps', 'This is description. This is description. This is description. \nThis is description. This is description. This is description.', NULL, '0', '0', NULL, NULL, 0, 'admin', '2016-11-21', '2016-11-21 06:30:12', '1479727812', '1479727812', 1, NULL, 1);
INSERT INTO plans (`id`, `parent_id`, `type`, `admin_id`, `user_id`, `slug`, `code`, `order`, `name`, `description`, `details`, `price`, `discount_price`, `image`, `address`, `is_feature`, `created_by`, `on_date`, `date_time`, `created`, `modified`, `enabled`, `confirm`, `status`) VALUES (2, 0, NULL, 1, 0, NULL, NULL, 2, '15 fps', 'This is description.  This is description. This is description. This is description. \nThis is description. This is description. This is description.', NULL, '0', '0', NULL, NULL, 0, 'admin', '2016-11-21', '2016-11-21 06:31:27', '1479727887', '1479727887', 1, NULL, 1);


#
# TABLE STRUCTURE FOR: problems
#

DROP TABLE IF EXISTS problems;

CREATE TABLE `problems` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `parent_id` bigint(20) DEFAULT '0',
  `category_id` bigint(20) DEFAULT '0',
  `admin_id` bigint(20) DEFAULT '0',
  `ticket_id` bigint(20) DEFAULT '0',
  `rate` double DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `help` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solve_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solve_user_time` double DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `left_time` double DEFAULT '0',
  `time_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'down',
  `is_new` tinyint(4) DEFAULT '0',
  `is_stop` tinyint(4) DEFAULT '0',
  `urgency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `files` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_responsive` tinyint(4) DEFAULT '0',
  `is_confirm` tinyint(4) DEFAULT '0',
  `is_private` tinyint(4) DEFAULT '0',
  `done_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `done_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: problems_files
#

DROP TABLE IF EXISTS problems_files;

CREATE TABLE `problems_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slide_lang` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  `problem_id` bigint(20) DEFAULT NULL,
  `problem_type` varchar(255) DEFAULT 'problem',
  `reply_id` bigint(20) DEFAULT '0',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: problems_rating
#

DROP TABLE IF EXISTS problems_rating;

CREATE TABLE `problems_rating` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `problem_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT '0',
  `rate` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `comment` text,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: products
#

DROP TABLE IF EXISTS products;

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT '0',
  `category_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_category_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier` bigint(20) DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `details` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT '0',
  `discount_price` double DEFAULT '0',
  `image` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gps` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minimum_order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reorder_point` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_feature` tinyint(4) DEFAULT '0',
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  `confirm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: products_buy
#

DROP TABLE IF EXISTS products_buy;

CREATE TABLE `products_buy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT '0',
  `order_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'order',
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) DEFAULT '0',
  `tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT '0',
  `dates` date DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  `confirm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: products_lang
#

DROP TABLE IF EXISTS products_lang;

CREATE TABLE `products_lang` (
  `id_product_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `mobile_description` text COLLATE utf8_unicode_ci,
  `highlights` text COLLATE utf8_unicode_ci,
  `terms` text COLLATE utf8_unicode_ci,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_product_lang`),
  KEY `fk_tag_language1` (`language_id`),
  KEY `fk_tag_lang_page1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: products_sell
#

DROP TABLE IF EXISTS products_sell;

CREATE TABLE `products_sell` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT '0',
  `order_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'order',
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) DEFAULT '0',
  `customer_id` bigint(20) DEFAULT '0',
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `details` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  `confirm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: products_sell_item
#

DROP TABLE IF EXISTS products_sell_item;

CREATE TABLE `products_sell_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `read` tinyint(4) DEFAULT '0',
  `order_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `ownner_id` bigint(20) DEFAULT '0',
  `store_id` bigint(20) DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `a_date` date DEFAULT NULL,
  `a_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_id` bigint(20) DEFAULT '0',
  `shipping_cost` double DEFAULT NULL,
  `credits_point` double DEFAULT '0',
  `order_content` text COLLATE utf8_unicode_ci,
  `payment_content` text COLLATE utf8_unicode_ci,
  `is_done` tinyint(4) DEFAULT '0',
  `is_review` tinyint(4) DEFAULT '0',
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: programs
#

DROP TABLE IF EXISTS programs;

CREATE TABLE `programs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `dates` date DEFAULT NULL,
  `is_feature` tinyint(4) DEFAULT '0',
  `is_read` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: public_chat
#

DROP TABLE IF EXISTS public_chat;

CREATE TABLE `public_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` bigint(20) DEFAULT NULL,
  `from` varchar(255) NOT NULL DEFAULT '',
  `from_name` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `to_id` bigint(20) DEFAULT NULL,
  `to` varchar(255) NOT NULL DEFAULT '',
  `to_name` varchar(255) DEFAULT NULL,
  `recipient_type` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` int(10) DEFAULT '0',
  `read` int(11) DEFAULT '0',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO public_chat (`id`, `from_id`, `from`, `from_name`, `user_type`, `to_id`, `to`, `to_name`, `recipient_type`, `message`, `sent`, `message_time`, `recd`, `read`, `created`, `modified`) VALUES (1, NULL, '1', 'test', NULL, NULL, '0', 'admin', NULL, '1234', '2016-11-22 02:54:37', '2016-11-22 14:54:37', 0, 0, '1479826477', '1479826477');


#
# TABLE STRUCTURE FOR: public_user
#

DROP TABLE IF EXISTS public_user;

CREATE TABLE `public_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `last_active_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(4) DEFAULT '0',
  `created` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO public_user (`id`, `user_id`, `user_name`, `email`, `user_type`, `status`, `last_active_time`, `is_read`, `created`, `modified`) VALUES (1, 0, 'test', NULL, 'user', 0, '2016-11-22 09:54:33', 0, '1479826473', '1479826473');


#
# TABLE STRUCTURE FOR: regions
#

DROP TABLE IF EXISTS regions;

CREATE TABLE `regions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `on_date` date DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO regions (`id`, `parent_id`, `order`, `name`, `desc`, `country`, `country_code`, `image`, `on_date`, `slug`, `created`, `modified`, `enabled`) VALUES (10, 0, 8, 'Puebla', '0', '5', NULL, NULL, NULL, NULL, '1471919915', '1471919915', 1);


#
# TABLE STRUCTURE FOR: setting
#

DROP TABLE IF EXISTS setting;

CREATE TABLE `setting` (
  `field` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('rss_url', NULL, NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('pinterest_url', NULL, NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('menu_imag', NULL, NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('menu_image', 'batman_2.jpg', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('image', 'logo.png', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('footer_text', 'All rights reserved @ 2014', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('donation', '5', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('admin_link', 'gadmin123', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('bank_name', 'bank name', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('bank_account', '9876543210', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('chat_option', '1', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('product_image', 'LMSD.png', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('background', 'back_sa.jpg', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('background2', 'background2.jpg', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('b_background', 'background21.jpg', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('l_background', 'account_bg3.jpg', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('r_background', 'remar.jpg', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('linkedin_url', 'http://linkedin.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('youtube_url', 'https://www.youtube.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('twitter_url', 'https://twitter.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('facebook_url', 'https://www.facebook.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('google_plus', 'https://plus.google.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('skype_id', '0', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('instagram_url', 'http://instagram_url.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('site_name', 'My Online Cameras', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('home_title', 'My Online Cameras', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('site_email', 'pvsysgrouptesting@gmail.com', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('meta_title', 'My Online Cameras', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('keywords', 'My Online Cameras', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('meta_description', 'My Online Cameras', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('phone', '+9876543210', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('address', 'Address', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('gps', '19.28280891497032, -98.4332768020218', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('website_active', '1', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('website_desc', '<h1>We&#39;ll be back soon!</h1>\n\n<div>\n<p>Sorry for the inconvenience but we are performing some maintenance at the moment. we will be back online shortly!</p>\n\n<p>The My Online CcamerasTeam</p>\n</div>\n', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('analytic_code', '                     ', NULL, NULL);
INSERT INTO setting (`field`, `value`, `created`, `modified`) VALUES ('logo', 'no-logo.png', NULL, NULL);


#
# TABLE STRUCTURE FOR: sliders
#

DROP TABLE IF EXISTS sliders;

CREATE TABLE `sliders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO sliders (`id`, `parent_id`, `type`, `status`, `order`, `name`, `desc`, `image`, `link`, `created`, `modified`, `enabled`) VALUES (1, 0, '0', 1, 1, 'slider 1', ' description. This is description. This is description.  This is description.  <br>\nThis is description. This is description.  This is description. This is description.<br>\nThis is description. This is description. This is description. ', 'slider2i1.jpg', '0', '1468836283', '1479476533', 1);
INSERT INTO sliders (`id`, `parent_id`, `type`, `status`, `order`, `name`, `desc`, `image`, `link`, `created`, `modified`, `enabled`) VALUES (2, 0, '0', 1, 2, 'Slider 2', 'This is description. This is description. This is description. This is description. <br>\nThis is description. This is description. This is description. This is description. <br>\nThis is description. This is description. This is description. This is description. <br>\nThis is description. This is description. This is description. This is description. <br>', 'slider3.jpg', '0', '1468836349', '1479476537', 1);


#
# TABLE STRUCTURE FOR: static_text
#

DROP TABLE IF EXISTS static_text;

CREATE TABLE `static_text` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (1, NULL, 'Register', NULL, 1, NULL, '1428477556', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (2, NULL, 'Login', NULL, 2, NULL, '1428477587', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (3, NULL, 'Search', NULL, 3, NULL, '1428477632', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (4, NULL, 'Update', NULL, 4, NULL, '1428477690', '1446201428', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (5, NULL, 'Delete', NULL, 5, NULL, '1428477724', '1446303257', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (6, NULL, 'Product', NULL, 6, NULL, '1428477823', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (7, NULL, 'Add Payment', NULL, 7, NULL, '1428477846', '1471847738', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (8, NULL, 'Machine', NULL, 8, NULL, '1428477864', '1472571356', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (9, NULL, 'News', NULL, 9, NULL, '1428477903', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (10, NULL, 'Home', NULL, 10, NULL, '1428477988', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (11, NULL, 'Pages', NULL, 11, NULL, '1428478009', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (12, NULL, 'Sign Up', NULL, 12, NULL, '1428478059', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (13, NULL, 'Sign in', NULL, 13, NULL, '1428478074', '1428481717', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (14, NULL, 'My Account', NULL, 14, NULL, '1428478094', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (15, NULL, 'Created By', NULL, 15, NULL, '1428478114', '1471868218', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (16, NULL, 'Name', NULL, 16, NULL, '1428478127', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (17, NULL, 'Surname', NULL, 17, NULL, '1428478142', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (18, NULL, 'E-mail', NULL, 18, NULL, '1428478156', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (19, NULL, 'Your Password', NULL, 19, NULL, '1428478199', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (20, NULL, 'Password', NULL, 20, NULL, '1428478217', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (21, NULL, 'confirm password', NULL, 21, NULL, '1428478240', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (22, NULL, 'Cancel', NULL, 22, NULL, '1428478281', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (23, NULL, 'Menu', NULL, 23, NULL, '1428478326', '1447751308', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (24, NULL, 'Forgot Your Password', NULL, 24, NULL, '1428478393', '1449048058', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (25, NULL, 'Day', NULL, 25, NULL, '1428478435', '1471448376', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (26, NULL, 'Available', NULL, 26, NULL, '1428478474', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (27, NULL, 'Keywords', NULL, 27, NULL, '1428478489', '1446291808', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (28, NULL, 'View', NULL, 28, NULL, '1428478501', '1447754968', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (29, NULL, 'Membership Management', NULL, 29, NULL, '1428478523', '1471097053', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (30, NULL, 'Retail Point-of-Sale', NULL, 30, NULL, '1428478543', '1471097145', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (31, NULL, 'Detailed Reporting', NULL, 31, NULL, '1428478559', '1471097240', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (32, NULL, 'Membership', NULL, 32, NULL, '1428478609', '1471008779', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (33, NULL, 'New Customer', NULL, 33, NULL, '1428478664', '1447750805', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (34, NULL, 'Sell gear through the point of sale interface right in your box, without the hassle of dealing with cash or counting inventory.', NULL, 34, NULL, '1428478685', '1471097663', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (35, NULL, 'Run detailed reports to compare revenue and budgets, giving you true insight into how your business is doing.', NULL, 35, NULL, '1428478740', '1471097773', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (36, NULL, 'people', NULL, 36, NULL, '1428478752', '1471005234', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (37, NULL, 'Manage athletes\' memberships and automatically bill them, leaving you more time to tend to other aspects of your business', NULL, 37, NULL, '1428478810', '1471097521', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (38, NULL, 'description', NULL, 38, NULL, '1428478828', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (39, NULL, 'code', NULL, 39, NULL, '1428478841', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (40, NULL, 'Other Expense', NULL, 40, NULL, '1428478853', '1471424302', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (41, NULL, 'price', NULL, 41, NULL, '1428478883', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (42, NULL, 'Year', NULL, 42, NULL, '1428478891', '1471448501', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (43, NULL, 'Total', NULL, 43, NULL, '1428478915', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (44, NULL, 'Thanks For Joining Our System , For More Features Please Upgrade Your Membership', NULL, 44, NULL, '1428478959', '1474904638', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (45, NULL, 'Profile Update', NULL, 45, NULL, '1428479019', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (46, NULL, 'address', NULL, 46, NULL, '1428479081', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (47, NULL, 'Liked', NULL, 47, NULL, '1428479123', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (48, NULL, 'Bank Name', NULL, 48, NULL, '1428479154', '1472884944', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (49, NULL, 'My Order', NULL, 49, NULL, '1428479168', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (50, NULL, 'Change Password', NULL, 50, NULL, '1428479182', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (51, NULL, 'Old Password', NULL, 51, NULL, '1428479191', '1428481718', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (52, NULL, 'State', NULL, 52, NULL, '1428479233', '1471434889', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (53, NULL, 'Action', NULL, 53, NULL, '1428479261', '1428481719', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (54, NULL, 'Fitness Level', NULL, 54, NULL, '1428479286', '1471448318', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (55, NULL, 'Message', NULL, 55, NULL, '1428595392', '1428595392', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (56, NULL, 'submit', NULL, 56, NULL, '1428595433', '1428595433', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (57, NULL, 'Logout', NULL, 57, NULL, '1428595459', '1428595459', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (58, NULL, 'calender', NULL, NULL, NULL, '1428596210', '1471005498', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (59, NULL, 'My Profile', NULL, NULL, NULL, '1428918325', '1471245520', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (60, NULL, 'Athletes behavior', NULL, NULL, NULL, '1428918342', '1473677895', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (61, NULL, 'Month', NULL, NULL, NULL, '1428918428', '1471448450', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (62, NULL, 'Copy Right', NULL, NULL, NULL, '1437662021', '1447751474', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (63, NULL, 'Your Membership', NULL, NULL, NULL, '1438581278', '1472049953', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (64, NULL, 'Term', NULL, NULL, NULL, '1438581329', '1472570262', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (65, NULL, 'New', NULL, NULL, NULL, '1438581451', '1438581451', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (66, NULL, 'Coachboard', NULL, NULL, NULL, '1438581540', '1473679239', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (67, NULL, 'Reporting', NULL, NULL, NULL, '1438581600', '1471426054', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (68, NULL, 'Attendances', NULL, NULL, NULL, '1438581689', '1471428275', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (69, NULL, 'Attendance', NULL, NULL, NULL, '1438581740', '1471699046', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (70, NULL, 'Performances', NULL, NULL, NULL, '1438581813', '1471428458', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (71, NULL, 'More', NULL, NULL, NULL, '1438581868', '1438581868', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (72, NULL, 'Get the latest deals and special offers', NULL, NULL, NULL, '1438581953', '1447751137', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (73, NULL, 'Read More', NULL, NULL, NULL, '1438582113', '1438582113', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (74, NULL, 'Get membership', NULL, NULL, NULL, '1438582181', '1472888418', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (75, NULL, 'Employee', NULL, NULL, NULL, '1438582406', '1472911869', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (76, NULL, 'Whiteboard', NULL, NULL, NULL, '1438582442', '1473679322', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (77, NULL, 'Subscribe', NULL, NULL, NULL, '1438583457', '1438583457', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (78, NULL, 'Salary Amount', NULL, NULL, NULL, '1438584051', '1472911959', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (79, NULL, 'Pricing', NULL, NULL, NULL, '1438584155', '1471009113', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (80, NULL, 'Dashboard', NULL, NULL, NULL, '1438601454', '1438601454', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (81, NULL, 'Enter your email', NULL, NULL, NULL, '1438603598', '1438603598', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (82, NULL, 'Phone', NULL, NULL, NULL, '1438603648', '1438603648', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (83, NULL, 'Date Of birth', NULL, NULL, NULL, '1438603677', '1438603677', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (84, NULL, 'City', NULL, NULL, NULL, '1438603697', '1438603697', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (85, NULL, 'Country', NULL, NULL, NULL, '1438603711', '1438603711', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (86, NULL, 'Create Account', NULL, NULL, NULL, '1438603742', '1438603742', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (87, NULL, 'Old Workout', NULL, NULL, NULL, '1438603863', '1471699115', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (88, NULL, 'Payment', NULL, NULL, NULL, '1438603880', '1472889154', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (89, NULL, 'Support', NULL, NULL, NULL, '1438603893', '1471009242', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (90, NULL, 'Get started', NULL, NULL, NULL, '1438603907', '1471009508', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (91, NULL, 'Inventory management', NULL, NULL, NULL, '1438603930', '1471423231', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (92, NULL, 'Proceed to checkout', NULL, NULL, NULL, '1438603951', '1438603951', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (93, NULL, 'Expenses Management', NULL, NULL, NULL, '1439279932', '1471423444', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (94, NULL, 'Start date', NULL, NULL, NULL, '1443714848', '1472888730', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (95, NULL, 'Depth Balance', NULL, NULL, NULL, '1443714883', '1472206954', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (96, NULL, 'Contact', NULL, NULL, NULL, '1443714911', '1443714911', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (97, NULL, 'Waivers', NULL, NULL, NULL, '1443714926', '1471006980', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (98, NULL, 'Order Summary', NULL, NULL, NULL, '1443714946', '1447752798', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (99, NULL, 'Facebook', NULL, NULL, NULL, '1443715302', '1443715302', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (100, NULL, 'Twitter', NULL, NULL, NULL, '1443715327', '1443715327', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (101, NULL, 'Google', NULL, NULL, NULL, '1443715344', '1443715344', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (102, NULL, 'Signature ', NULL, NULL, NULL, '1443868455', '1472885037', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (103, NULL, 'Requested Start Date', NULL, NULL, NULL, '1443868573', '1472885561', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (104, NULL, 'History', NULL, NULL, NULL, '1443868609', '1471424532', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (105, NULL, 'Financial', NULL, NULL, NULL, '1443868638', '1471007141', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (106, NULL, 'schedule', NULL, NULL, NULL, '1443868662', '1471425774', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (107, NULL, 'list', NULL, NULL, NULL, '1443878111', '1471005609', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (108, NULL, 'Company', NULL, NULL, NULL, '1443878162', '1471009652', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (109, NULL, 'Remove', NULL, NULL, NULL, '1443878313', '1443878313', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (110, NULL, 'Third Party Commissions', NULL, NULL, NULL, '1443878829', '1473670294', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (111, NULL, 'Email Address', NULL, NULL, NULL, '1443878862', '1443878862', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (112, NULL, 'Plan', NULL, NULL, NULL, '1443879258', '1471855987', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (113, NULL, 'User Type', NULL, NULL, NULL, '1443879294', '1472889206', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (114, NULL, 'Address Details', NULL, NULL, NULL, '1443879324', '1443879324', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (115, NULL, 'Post', NULL, NULL, NULL, '1443879362', '1472908218', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (116, NULL, 'Type', NULL, NULL, NULL, '1443879911', '1471097872', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (117, NULL, 'Type your location', NULL, NULL, NULL, '1443879923', '1471097973', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (118, NULL, 'Today Workout', NULL, NULL, NULL, '1443879934', '1475648412', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (119, NULL, 'Review', NULL, NULL, NULL, '1443879968', '1471955605', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (120, NULL, 'What Client Say', NULL, NULL, NULL, '1443879984', '1471098184', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (121, NULL, 'From', NULL, NULL, NULL, '1443879995', '1471097936', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (122, NULL, 'To', NULL, NULL, NULL, '1443880012', '1471097960', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (123, NULL, 'Observations', NULL, NULL, NULL, '1443880024', '1472912066', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (124, NULL, 'Find Your Best Gym', NULL, NULL, NULL, '1443880069', '1471098276', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (125, NULL, 'Account', NULL, NULL, NULL, '1443880088', '1472912272', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (126, NULL, 'About', NULL, NULL, NULL, '1443881175', '1473761186', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (127, NULL, 'Income Managment', NULL, NULL, NULL, '1443881784', '1473759165', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (128, NULL, 'Salary Paid', NULL, NULL, NULL, '1443881943', '1472570958', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (129, NULL, 'Cash On Delivery', NULL, NULL, NULL, '1443881962', '1443881962', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (130, NULL, 'Total Balance', NULL, NULL, NULL, '1443881975', '1472206723', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (131, NULL, 'ticket management', NULL, NULL, NULL, '1443882853', '1471016322', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (132, NULL, 'Back', NULL, NULL, NULL, '1443883903', '1472889252', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (133, NULL, 'Order Confirm', NULL, NULL, NULL, '1443883929', '1443883929', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (134, NULL, 'Language', NULL, NULL, NULL, '1444130161', '1444130161', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (135, NULL, 'paypal API', NULL, NULL, NULL, '1445864497', '1473759300', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (136, NULL, 'Holds', NULL, NULL, NULL, '1445864513', '1473759421', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (137, NULL, 'settings', NULL, NULL, NULL, '1445864853', '1471005867', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (138, NULL, 'panic setting', NULL, NULL, NULL, '1445869181', '1471016504', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (139, NULL, 'coach', NULL, NULL, NULL, '1445869205', '1471005958', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (140, NULL, 'Athlete', NULL, NULL, NULL, '1445869219', '1471006031', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (141, NULL, 'Athletes', NULL, NULL, NULL, '1445869240', '1471011921', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (142, NULL, 'staff', NULL, NULL, NULL, '1445871218', '1471006086', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (143, NULL, 'Our Coachs', NULL, NULL, NULL, '1445873707', '1471098306', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (144, NULL, 'Crendential', NULL, NULL, NULL, '1445955322', '1472572285', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (145, NULL, 'Gender', NULL, NULL, NULL, '1445955346', '1472571639', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (146, NULL, 'Your Details', NULL, NULL, NULL, '1445957173', '1445957173', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (147, NULL, 'Forgot Password', NULL, NULL, NULL, '1445958109', '1445958109', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (148, NULL, 'Photographer', NULL, NULL, NULL, '1446012421', '1472897009', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (149, NULL, 'info', NULL, NULL, NULL, '1446108159', '1471012408', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (150, NULL, 'S. No.', NULL, NULL, NULL, '1446109502', '1471865896', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (151, NULL, 'Diposit Number', NULL, NULL, NULL, '1446186569', '1478160259', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (152, NULL, 'Order History', NULL, NULL, NULL, '1446186940', '1446186940', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (153, NULL, 'Date', NULL, NULL, NULL, '1446187011', '1446187011', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (154, NULL, 'Skill Level', NULL, NULL, NULL, '1446187049', '1476797226', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (155, NULL, 'Total Amount', NULL, NULL, NULL, '1446187087', '1446187087', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (156, NULL, 'Option', NULL, NULL, NULL, '1446187126', '1446187126', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (157, NULL, 'Comment', NULL, NULL, NULL, '1446201046', '1446201046', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (158, NULL, 'Status', NULL, NULL, NULL, '1446201085', '1446201085', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (159, NULL, 'Select image', NULL, NULL, NULL, '1446201309', '1446201309', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (160, NULL, 'Change', NULL, NULL, NULL, '1446201356', '1446201356', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (161, NULL, 'New Password', NULL, NULL, NULL, '1446201570', '1446201570', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (162, NULL, 'General Settings', NULL, NULL, NULL, '1446210730', '1446210730', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (163, NULL, 'Email Settings', NULL, NULL, NULL, '1446210773', '1446210773', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (164, NULL, 'Language', NULL, NULL, NULL, '1446210914', '1446210914', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (165, NULL, 'Update Data', NULL, NULL, NULL, '1446210966', '1446210966', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (166, NULL, 'Product Management', NULL, NULL, NULL, '1446210981', '1446210981', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (167, NULL, 'Category', NULL, NULL, NULL, '1446210997', '1446210997', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (168, NULL, 'Total Class', NULL, NULL, NULL, '1446211021', '1472885671', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (169, NULL, 'GYM Fitness Level', NULL, NULL, NULL, '1446211037', '1472886657', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (170, NULL, 'Products', NULL, NULL, NULL, '1446211059', '1446211059', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (171, NULL, 'Order Management', NULL, NULL, NULL, '1446211077', '1446211077', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (172, NULL, 'Website', NULL, NULL, NULL, '1446211093', '1446211093', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (173, NULL, 'Reports', NULL, NULL, NULL, '1446211107', '1446211107', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (174, NULL, 'Payment History', NULL, NULL, NULL, '1446211122', '1446211122', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (175, NULL, 'System Fitness level', NULL, NULL, NULL, '1446211137', '1472886959', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (176, NULL, 'Rank', NULL, NULL, NULL, '1446211163', '1472887303', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (177, NULL, 'User Management', NULL, NULL, NULL, '1446211181', '1446211181', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (178, NULL, 'User', NULL, NULL, NULL, '1446211197', '1446211197', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (179, NULL, 'Athlete membership', NULL, NULL, NULL, '1446211209', '1471422646', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (180, NULL, 'Content Management', NULL, NULL, NULL, '1446211224', '1446211224', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (181, NULL, 'Content', NULL, NULL, NULL, '1446211238', '1446211238', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (182, NULL, 'Page', NULL, NULL, NULL, '1446211259', '1446211259', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (183, NULL, 'Slider', NULL, NULL, NULL, '1446211272', '1446211272', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (184, NULL, 'Partner Logo', NULL, NULL, NULL, '1446211386', '1446212241', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (185, NULL, 'standards/formates', NULL, NULL, NULL, '1446211434', '1471014794', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (186, NULL, 'Newsletter', NULL, NULL, NULL, '1446211447', '1446211447', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (187, NULL, 'User Subcriber', NULL, NULL, NULL, '1446211494', '1446211494', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (188, NULL, 'Social Network', NULL, NULL, NULL, '1446211647', '1446211647', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (189, NULL, 'Static Text', NULL, NULL, NULL, '1446211703', '1446211703', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (190, NULL, 'Thank you for subscribing', NULL, NULL, NULL, '1446212409', '1446212409', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (191, NULL, 'You already subscribe', NULL, NULL, NULL, '1446212463', '1446212463', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (192, NULL, 'Event', NULL, NULL, NULL, '1446212696', '1446212696', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (193, NULL, 'Skills', NULL, NULL, NULL, '1446212714', '1473761269', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (194, NULL, 'quantity', NULL, NULL, NULL, '1446212928', '1472908739', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (195, NULL, 'Tax', NULL, NULL, NULL, '1446212945', '1472909088', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (196, NULL, 'Suppliers', NULL, NULL, NULL, '1446212956', '1472909474', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (197, NULL, 'New', NULL, NULL, NULL, '1446213004', '1446213004', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (198, NULL, 'locations', NULL, NULL, NULL, '1446213020', '1471014959', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (199, NULL, 'Thank You for contacting us. We Will Contact You soon', NULL, NULL, NULL, '1446213533', '1446213533', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (200, NULL, 'Mail can not be send dur to some server problem', NULL, NULL, NULL, '1446213586', '1446213586', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (201, NULL, 'Please enter a valid email-id', NULL, NULL, NULL, '1446213601', '1446213601', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (202, NULL, 'Please enter email-id', NULL, NULL, NULL, '1446213614', '1446213614', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (203, NULL, 'invoices', NULL, NULL, NULL, '1446214568', '1471007986', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (204, NULL, 'features', NULL, NULL, NULL, '1446214634', '1471009009', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (205, NULL, 'Used Balance', NULL, NULL, NULL, '1446221046', '1472206782', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (206, NULL, 'Partners', NULL, NULL, NULL, '1446271430', '1471010192', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (207, NULL, 'Yes', NULL, NULL, NULL, '1446271509', '1446271509', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (208, NULL, 'No', NULL, NULL, NULL, '1446271518', '1446271518', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (209, NULL, 'Ticket', NULL, NULL, NULL, '1446271532', '1472888943', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (210, NULL, 'Bank Account', NULL, NULL, NULL, '1446271691', '1472570802', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (211, NULL, 'Profile has been successfully updated', NULL, NULL, NULL, '1446277661', '1446277661', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (212, NULL, 'Old Password is wrong password', NULL, NULL, NULL, '1446277709', '1446277709', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (213, NULL, 'Password does not match', NULL, NULL, NULL, '1446277773', '1446277773', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (214, NULL, 'Your Password has successfully been Updated', NULL, NULL, NULL, '1446277808', '1446277808', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (215, NULL, 'Thank you for order', NULL, NULL, NULL, '1446278658', '1446278658', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (216, NULL, 'Thanks for register!', NULL, NULL, NULL, '1446278798', '1446278798', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (217, NULL, 'Please verify your account by clicking the link sent to your e-mail address', NULL, NULL, NULL, '1446278815', '1446278815', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (218, NULL, 'Be sure to check your junk mail folder', NULL, NULL, NULL, '1446278828', '1446278828', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (219, NULL, 'Field required', NULL, NULL, NULL, '1446279068', '1446279068', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (220, NULL, 'Email must unique', NULL, NULL, NULL, '1446279226', '1446279226', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (221, NULL, 'Field must contain an integer', NULL, NULL, NULL, '1446279379', '1446279379', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (222, NULL, 'Your email ID has not verify', NULL, NULL, NULL, '1446281246', '1446281246', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (223, NULL, 'Your account has been deactived', NULL, NULL, NULL, '1446281260', '1446281260', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (224, NULL, 'Invalid user id or password', NULL, NULL, NULL, '1446281278', '1446281278', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (225, NULL, 'Your password has successfully sent your email ID. Please Check email', NULL, NULL, NULL, '1446281409', '1446281409', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (226, NULL, 'Invalid email-ID', NULL, NULL, NULL, '1446281436', '1446281436', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (227, NULL, 'Order Information', NULL, NULL, NULL, '1446281889', '1446281889', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (228, NULL, 'There is no data', NULL, NULL, NULL, '1446282073', '1446282073', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (229, NULL, 'Amount', NULL, NULL, NULL, '1446282188', '1446282188', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (230, NULL, 'Remaining', NULL, NULL, NULL, '1446282205', '1446282205', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (231, NULL, 'Used', NULL, NULL, NULL, '1446282218', '1446282218', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (232, NULL, 'Expire Date', NULL, NULL, NULL, '1446282233', '1446282233', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (233, NULL, 'Add New', NULL, NULL, NULL, '1446282544', '1446282544', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (234, NULL, 'Add', NULL, NULL, NULL, '1446282553', '1446282553', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (235, NULL, 'Save', NULL, NULL, NULL, '1446282572', '1446282572', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (236, NULL, 'Title', NULL, NULL, NULL, '1446282603', '1446282603', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (237, NULL, 'Users', NULL, NULL, NULL, '1446290331', '1446290331', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (238, NULL, 'Workout', NULL, NULL, NULL, '1446290344', '1471425577', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (239, NULL, 'Today Order', NULL, NULL, NULL, '1446290392', '1446290392', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (240, NULL, 'Month Order', NULL, NULL, NULL, '1446290410', '1446290410', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (241, NULL, 'Year Order', NULL, NULL, NULL, '1446290690', '1446290690', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (242, NULL, 'Username', NULL, NULL, NULL, '1446290862', '1446290862', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (243, NULL, 'Ordered On', NULL, NULL, NULL, '1446290921', '1446290921', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (244, NULL, 'ID', NULL, NULL, NULL, '1446291094', '1446291094', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (245, NULL, 'Site Name', NULL, NULL, NULL, '1446291451', '1446291451', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (246, NULL, 'Site Email', NULL, NULL, NULL, '1446291464', '1446291464', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (247, NULL, 'Meta Title', NULL, NULL, NULL, '1446291476', '1446291476', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (248, NULL, 'Meta Description', NULL, NULL, NULL, '1446291500', '1446291500', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (249, NULL, 'Home Title', NULL, NULL, NULL, '1446291512', '1446291512', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (250, NULL, 'Analytic Code', NULL, NULL, NULL, '1446291523', '1446291572', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (251, NULL, 'Website Active', NULL, NULL, NULL, '1446291582', '1446291582', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (252, NULL, 'Website Offline Message', NULL, NULL, NULL, '1446291606', '1446291606', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (253, NULL, 'Logo', NULL, NULL, NULL, '1446291627', '1446291627', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (254, NULL, 'Edit', NULL, NULL, NULL, '1446292488', '1446292488', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (255, NULL, 'Subject', NULL, NULL, NULL, '1446292636', '1446292636', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (256, NULL, 'Confirm', NULL, NULL, NULL, '1446292939', '1446292939', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (257, NULL, 'Create', NULL, NULL, NULL, '1446293408', '1446293408', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (258, NULL, 'Options', NULL, NULL, NULL, '1446293805', '1446293805', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (259, NULL, 'Flag', NULL, NULL, NULL, '1446293826', '1446293826', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (260, NULL, 'Default', NULL, NULL, NULL, '1446293854', '1446293854', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (261, NULL, 'Currency', NULL, NULL, NULL, '1446294078', '1446294078', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (262, NULL, 'Unit $ price ', NULL, NULL, NULL, '1446294105', '1446294105', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (263, NULL, 'Image', NULL, NULL, NULL, '1446294130', '1446294130', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (264, NULL, 'Drag to data and then click \'Save\'', NULL, NULL, NULL, '1446294875', '1446294875', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (265, NULL, 'Are you sure?', NULL, NULL, NULL, '1446295018', '1446295018', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (266, NULL, 'Parent', NULL, NULL, NULL, '1446295561', '1471087680', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (267, NULL, 'Slug', NULL, NULL, NULL, '1446295594', '1446295594', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (268, NULL, 'Translation data', NULL, NULL, NULL, '1446295612', '1446295612', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (269, NULL, 'Subcategory', NULL, NULL, NULL, '1446296679', '1446296679', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (270, NULL, 'Section', NULL, NULL, NULL, '1446296704', '1446296704', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (271, NULL, 'Discount Price', NULL, NULL, NULL, '1446297902', '1446297902', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (272, NULL, 'account info', NULL, NULL, NULL, '1446297927', '1471016141', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (273, NULL, 'Built for you, the box owner', NULL, NULL, NULL, '1446297951', '1471096943', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (274, NULL, 'Product Code', NULL, NULL, NULL, '1446297975', '1446297975', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (275, NULL, 'Youtube Link', NULL, NULL, NULL, '1446297993', '1446297993', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (276, NULL, 'Body', NULL, NULL, NULL, '1446298012', '1446298012', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (277, NULL, 'More Photo', NULL, NULL, NULL, '1446298043', '1446298043', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (278, NULL, 'Upload', NULL, NULL, NULL, '1446298065', '1446298065', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (279, NULL, 'Export', NULL, NULL, NULL, '1446298652', '1446298652', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (280, NULL, 'Add Order History', NULL, NULL, NULL, '1446299588', '1446299588', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (281, NULL, 'Athlete payment', NULL, NULL, NULL, '1446299616', '1471422806', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (282, NULL, 'store', NULL, NULL, NULL, '1446300679', '1471010794', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (283, NULL, 'Token', NULL, NULL, NULL, '1446300899', '1446300899', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (284, NULL, 'Place', NULL, NULL, NULL, '1446302138', '1446302138', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (285, NULL, 'sales portal', NULL, NULL, NULL, '1446303772', '1471014570', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (286, NULL, 'Active', NULL, NULL, NULL, '1446303867', '1472888239', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (287, NULL, 'Reduction Amount', NULL, NULL, NULL, '1446304467', '1446304467', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (288, NULL, 'Template', NULL, NULL, NULL, '1446305049', '1446305049', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (289, NULL, 'Top Menu', NULL, NULL, NULL, '1446305063', '1446305063', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (290, NULL, 'Bottom Menu', NULL, NULL, NULL, '1446305077', '1446305077', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (291, NULL, 'Position', NULL, NULL, NULL, '1446305683', '1446305683', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (292, NULL, 'Link', NULL, NULL, NULL, '1446306007', '1446306007', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (293, NULL, 'Save And Send', NULL, NULL, NULL, '1446306818', '1446306818', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (294, NULL, 'Setting has successfully updated', NULL, NULL, NULL, '1446451363', '1446451363', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (295, NULL, 'Data has successfully created', NULL, NULL, NULL, '1446451427', '1446451644', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (296, NULL, 'Data has successfully updated', NULL, NULL, NULL, '1446451585', '1446451669', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (297, NULL, 'Data has successfully deleted', NULL, NULL, NULL, '1446451599', '1446451599', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (298, NULL, 'Data has successfully sent', NULL, NULL, NULL, '1446452501', '1446452501', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (299, NULL, 'Code should be unique', NULL, NULL, NULL, '1446453473', '1446453473', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (300, NULL, 'Documents', NULL, NULL, NULL, '1446616967', '1471006753', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (301, NULL, 'Availability', NULL, NULL, NULL, '1446616995', '1446616995', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (302, NULL, 'Update weight', NULL, NULL, NULL, '1446617025', '1471698987', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (303, NULL, 'Contact Us', NULL, NULL, NULL, '1446619679', '1446619679', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (304, NULL, 'Contracts', NULL, NULL, NULL, '1446620477', '1471006864', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (305, NULL, 'Competition', NULL, NULL, NULL, '1446620503', '1472572313', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (306, NULL, 'Company Name', NULL, NULL, NULL, '1446621306', '1446621306', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (307, NULL, 'Favorite Workout', NULL, NULL, NULL, '1446621391', '1471609132', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (308, NULL, 'Gym', NULL, NULL, NULL, '1446621434', '1471012222', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (309, NULL, 'program', NULL, NULL, NULL, '1446622474', '1471006414', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (310, NULL, 'starred', NULL, NULL, NULL, '1446640888', '1471011795', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (311, NULL, 'Grand Total', NULL, NULL, NULL, '1446813761', '1446813761', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (312, NULL, 'refferal program', NULL, NULL, NULL, '1446814106', '1471010648', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (313, NULL, 'Height', NULL, NULL, NULL, '1446815422', '1472051434', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (314, NULL, 'Weight', NULL, NULL, NULL, '1446815437', '1472051500', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (315, NULL, 'Logos', NULL, NULL, NULL, '1446815599', '1471010386', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (316, NULL, 'Classes', NULL, NULL, NULL, '1446815612', '1471006566', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (317, NULL, 'salary', NULL, NULL, NULL, '1446815631', '1471424216', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (318, NULL, 'sell', NULL, NULL, NULL, '1446817456', '1471423945', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (319, NULL, 'Advertisement', NULL, NULL, NULL, '1447827893', '1447827893', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (320, NULL, 'Click Here', NULL, NULL, NULL, '1474904918', '1474904918', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (321, NULL, 'Thank you for upgrading your account', NULL, NULL, NULL, '1474905091', '1474905091', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (322, NULL, 'You cant see workouts before join classes', NULL, NULL, NULL, '1474905210', '1474905210', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (323, NULL, 'Unblock Exercise', NULL, NULL, NULL, '1474905301', '1474905301', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (324, NULL, 'Sport Nutritionist', NULL, NULL, NULL, '1474905343', '1474905343', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (325, NULL, 'Affiliate Business', NULL, NULL, NULL, '1474905370', '1474905370', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (326, NULL, 'Compromise Level', NULL, NULL, NULL, '1474905402', '1474905402', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (327, NULL, 'Transfers', NULL, NULL, NULL, '1474905433', '1474905433', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (328, NULL, 'Benchmark Workouts', NULL, NULL, NULL, '1475847655', '1475847655', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (329, NULL, 'My Workouts', NULL, NULL, NULL, '1475847686', '1475847686', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (330, NULL, 'Meal', NULL, NULL, NULL, '1476426613', '1476426613', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (331, NULL, 'Cheque', NULL, NULL, NULL, '1478161328', '1478161328', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (332, NULL, 'Comission', NULL, NULL, NULL, '1479111000', '1479111000', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (333, NULL, 'Instructions', NULL, NULL, NULL, '1479111193', '1479111193', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (334, NULL, 'Ledger', NULL, NULL, NULL, '1479122870', '1479122870', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (335, NULL, 'Time', NULL, NULL, NULL, '1479212165', '1479212165', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (336, NULL, 'Start Time', NULL, NULL, NULL, '1479212188', '1479212188', 1);
INSERT INTO static_text (`id`, `parent_id`, `name`, `type`, `order`, `image`, `created`, `modified`, `enabled`) VALUES (337, NULL, 'End Time', NULL, NULL, NULL, '1479212209', '1479212209', 1);


#
# TABLE STRUCTURE FOR: static_text_lang
#

DROP TABLE IF EXISTS static_text_lang;

CREATE TABLE `static_text_lang` (
  `id_static_text_lang` bigint(20) NOT NULL AUTO_INCREMENT,
  `static_text_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `title` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_static_text_lang`),
  KEY `fk_page_language1` (`language_id`),
  KEY `fk_page_lang_page1` (`static_text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2853 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1, 1, 1, 'Register', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (3, 2, 1, 'Login', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (5, 3, 1, 'Search', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (11, 6, 1, 'Product', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (17, 9, 1, 'News', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (19, 10, 1, 'Home', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (21, 11, 1, 'Pages', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (23, 12, 1, 'Sign Up', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (25, 13, 1, 'Sign in', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (27, 14, 1, 'My account', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (31, 16, 1, 'Name', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (33, 17, 1, 'Last Name', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (35, 18, 1, 'E-mail', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (37, 19, 1, 'Your Password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (39, 20, 1, 'Password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (41, 21, 1, 'Confirm password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (43, 22, 1, 'Cancel', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (51, 26, 1, 'Available', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (75, 38, 1, 'Description', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (77, 39, 1, 'Code', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (81, 41, 1, 'Price', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (85, 43, 1, 'Total', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (89, 45, 1, 'Profile Update', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (91, 46, 1, 'Address', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (93, 47, 1, 'Liked', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (97, 49, 1, 'My Order', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (99, 50, 1, 'Change Password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (101, 51, 1, 'Old Password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (105, 53, 1, 'Action', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (109, 55, 1, 'Message', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (111, 56, 1, 'Submit', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (113, 57, 1, 'Logout', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (375, 65, 1, 'New', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (387, 71, 1, 'More', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (391, 73, 1, 'Read More', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (399, 77, 1, 'Subscribe', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (405, 80, 1, 'Dashboard', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (407, 81, 1, 'Enter your email', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (409, 82, 1, 'Phone Number', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (411, 83, 1, 'Date of birth', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (413, 84, 1, 'City', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (415, 85, 1, 'Country', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (417, 86, 1, 'Create your account', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (429, 92, 1, 'Proceed to checkout', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (437, 96, 1, 'Customer Service', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (443, 99, 1, 'Facebook', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (445, 100, 1, 'Twitter', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (447, 101, 1, 'Google +', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (463, 109, 1, 'Remove', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (467, 111, 1, 'Email Address', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (473, 114, 1, 'Address details', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (503, 129, 1, 'Cash', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (511, 133, 1, 'Order Confirm', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (513, 134, 1, 'Language', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (537, 146, 1, 'Your Details', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (539, 147, 1, 'Forgot Password?', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (549, 152, 1, 'Order History', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (551, 153, 1, 'Date', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (555, 155, 1, 'Total Amount', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (557, 156, 1, 'Option', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (559, 157, 1, 'Comment', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (561, 158, 1, 'Status', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (563, 159, 1, 'Select image', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (565, 160, 1, 'Change', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (567, 4, 1, 'Update', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (569, 161, 1, 'New Password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (571, 162, 1, 'General Settings', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (573, 163, 1, 'Email Settings', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (575, 164, 1, 'Language', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (577, 165, 1, 'Update Data', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (579, 166, 1, 'Product Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (581, 167, 1, 'Category', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (587, 170, 1, 'Products', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (589, 171, 1, 'Order Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (591, 172, 1, 'Website', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (593, 173, 1, 'Reports', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (595, 174, 1, 'Payment History', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (601, 177, 1, 'User Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (603, 178, 1, 'User', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (607, 180, 1, 'Content Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (609, 181, 1, 'Content', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (611, 182, 1, 'Page', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (613, 183, 1, 'Slider', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (619, 186, 1, 'Newsletter', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (621, 187, 1, 'User Subcriber', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (623, 188, 1, 'Social Network', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (625, 189, 1, 'Static Text', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (627, 184, 1, 'Partner Logo', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (629, 190, 1, 'Thank you for subscribing', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (631, 191, 1, 'You already subscribe', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (633, 192, 1, 'Event', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (643, 197, 1, 'New', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (647, 199, 1, 'Thank you for your request. We will contact you soon!', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (649, 200, 1, 'Mail can not be send dur to some server problem', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (651, 201, 1, 'Please enter a valid email-id', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (653, 202, 1, 'Please enter email-id', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (663, 207, 1, 'Yes', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (665, 208, 1, 'No', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (671, 211, 1, 'Profile has been successfully updated', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (673, 212, 1, 'Old Password is wrong password.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (675, 213, 1, 'Password does not match.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (677, 214, 1, 'Your Password has successfully been Updated.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (679, 215, 1, 'Thank you for order', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (681, 216, 1, 'Thank you for register!', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (683, 217, 1, 'Please verify your account by clicking the link sent to your e-mail address.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (685, 218, 1, 'Be sure to check your junk mail folder', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (687, 219, 1, 'Field required', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (689, 220, 1, 'Email must unique', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (691, 221, 1, 'Field must contain an integer.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (693, 222, 1, 'Your email ID has not verify.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (695, 223, 1, 'Your account has been deactived.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (697, 224, 1, 'Invalid user id or password.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (699, 225, 1, 'Your password has successfully sent your email ID. Please Check email.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (701, 226, 1, 'Invalid email-ID!!', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (703, 227, 1, 'Order ', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (705, 228, 1, 'There is no data.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (707, 229, 1, 'Amount', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (709, 230, 1, 'Remaining', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (711, 231, 1, 'Used', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (713, 232, 1, 'Expire Date', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (715, 233, 1, 'Add New', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (717, 234, 1, 'Add', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (719, 235, 1, 'Save', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (721, 236, 1, 'Title', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (723, 237, 1, 'Users', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (727, 239, 1, 'Today Order', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (729, 240, 1, 'Month Order', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (731, 241, 1, 'Year Order', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (733, 242, 1, 'Username', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (735, 243, 1, 'Ordered On', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (737, 244, 1, 'ID', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (739, 245, 1, 'Site Name', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (741, 246, 1, 'Site Email', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (743, 247, 1, 'Meta Title', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (745, 248, 1, 'Meta Description', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (747, 249, 1, 'Home Title', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (751, 250, 1, 'Analytic Code', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (753, 251, 1, 'Website Active', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (755, 252, 1, 'Website Offline Message', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (757, 253, 1, 'Logo', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (759, 27, 1, 'Keywords', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (761, 254, 1, 'Edit', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (763, 255, 1, 'Subject', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (765, 256, 1, 'Confirm', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (767, 257, 1, 'Create', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (769, 258, 1, 'Options', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (771, 259, 1, 'Flag', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (773, 260, 1, 'Default', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (775, 261, 1, 'Currency', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (777, 262, 1, 'Unit $ price', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (779, 263, 1, 'Image', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (781, 264, 1, 'Drag to data and then click \'Save\'', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (783, 265, 1, 'Are you sure?', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (787, 267, 1, 'Slug', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (789, 268, 1, 'Translation data', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (791, 269, 1, 'Subcategory', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (793, 270, 1, 'Section', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (795, 271, 1, 'Discount', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (801, 274, 1, 'Bar Code', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (803, 275, 1, 'Youtube Link', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (805, 276, 1, 'Body', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (807, 277, 1, 'More Photo', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (809, 278, 1, 'Upload', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (811, 279, 1, 'Export', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (813, 280, 1, 'Add Order History', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (819, 283, 1, 'Token', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (821, 284, 1, 'Place', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (823, 5, 1, 'Delete', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (829, 287, 1, 'Reduction Amount', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (831, 288, 1, 'Template', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (833, 289, 1, 'Top Menu', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (835, 290, 1, 'Bottom Menu', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (837, 291, 1, 'Position', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (839, 292, 1, 'Link', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (841, 293, 1, 'Save And Send', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (843, 294, 1, 'Setting has successfully updated.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (849, 297, 1, 'Data has successfully deleted.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (851, 295, 1, 'Data has successfully created.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (853, 296, 1, 'Data has successfully updated.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (855, 298, 1, 'Data has successfully sent.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (857, 299, 1, 'Code should be unique.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (863, 301, 1, 'Availability', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (867, 303, 1, 'Contact us', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (875, 306, 1, 'Company Name', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (887, 311, 1, 'Grand Total', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1227, 33, 1, 'New Customer', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1231, 72, 1, 'Get the latest deals and special offers', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1233, 23, 1, 'Menu', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1235, 62, 1, '© All rights reservediLink Professionals, Inc', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1239, 98, 1, 'Order Summary', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1241, 28, 1, 'View', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1243, 319, 1, 'Advertisement', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1574, 24, 1, 'Forgot Your Password', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1894, 36, 1, 'People', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1896, 58, 1, 'Calender', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1898, 107, 1, 'Income', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1902, 137, 1, 'Settings', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1904, 139, 1, 'Coach', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1906, 140, 1, 'Athlete', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1908, 142, 1, 'Staff', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1912, 309, 1, 'Program', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1914, 316, 1, 'Classes', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1916, 300, 1, 'Documents', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1920, 304, 1, 'Contracts', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1922, 97, 1, 'Waivers', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1924, 105, 1, 'Financial', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1926, 203, 1, 'Invoices', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1928, 32, 1, 'Membership', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1930, 204, 1, 'Features', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1932, 79, 1, 'Pricing', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1934, 89, 1, 'Support', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1936, 90, 1, 'Get started', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1938, 108, 1, 'Company', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1946, 206, 1, 'Partners', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1948, 315, 1, 'Logos', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1950, 312, 1, 'refferal program', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1952, 282, 1, 'Store', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1954, 310, 1, 'Starred', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1956, 141, 1, 'Athletes', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1958, 308, 1, 'Gym', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1960, 149, 1, 'Info', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1962, 285, 1, 'sales portal', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1964, 185, 1, 'standards/formates', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1966, 198, 1, 'Locations', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1968, 272, 1, 'Account Info', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1972, 131, 1, 'Ticket Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1974, 138, 1, 'Panic Setting', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1978, 266, 1, 'Parent', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1980, 273, 1, 'Built for you, the box Dealer', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1982, 29, 1, 'Membership Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1984, 30, 1, 'Dealer', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1986, 31, 1, 'Detailed Reporting', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1988, 37, 1, 'This is description. This is description. This is description. ', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1990, 34, 1, 'This is description. This is description. This is description. ', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1992, 35, 1, 'Run detailed reports to compare revenue and budgets, giving you true insight into how your business is doing.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1994, 116, 1, 'Type', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1996, 121, 1, 'FROM', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (1998, 122, 1, 'TO', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2000, 117, 1, 'Name', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2002, 120, 1, 'What Client Say', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2004, 124, 1, 'Find Your Best Gym', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2006, 143, 1, 'Our Coachs', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2008, 59, 1, 'My Profile', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2014, 179, 1, 'Athlete membership', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2016, 281, 1, 'Athlete Payment', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2018, 91, 1, 'Inventory management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2020, 93, 1, 'Expenses Management', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2022, 318, 1, 'Sell', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2026, 317, 1, 'Salary', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2028, 40, 1, 'Other Expense', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2030, 104, 1, 'History', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2038, 238, 1, 'Workout', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2040, 106, 1, 'Schedule', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2042, 67, 1, 'Reporting', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2044, 68, 1, 'Attendances', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2046, 70, 1, 'Performances', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2048, 52, 1, 'State', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2050, 54, 1, 'Fitness level', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2052, 25, 1, 'Day', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2054, 61, 1, 'Month', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2056, 42, 1, 'Year', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2058, 307, 1, 'Favorite Workout', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2060, 302, 1, 'update measurements', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2062, 69, 1, 'Attendance', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2064, 87, 1, 'Old Workout', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2066, 7, 1, 'Add Membership', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2068, 112, 1, 'Plan', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2070, 150, 1, 'No.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2072, 15, 1, 'Created By', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2074, 119, 1, 'Review', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2076, 63, 1, 'Your Membership', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2078, 313, 1, 'Height', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2080, 314, 1, 'Weight', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2082, 130, 1, 'Total Balance', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2084, 205, 1, 'Used Balance', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2086, 95, 1, 'Credit Balance', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2726, 64, 1, 'Term', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2728, 210, 1, 'Bank Account', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2730, 128, 1, 'Salary Paid', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2732, 8, 1, 'Machine', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2734, 145, 1, 'Gender', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2736, 144, 1, 'Crendential', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2738, 305, 1, 'Competition', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2740, 48, 1, 'Bank Name', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2742, 102, 1, 'Signature', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2744, 103, 1, 'Requested Start Date', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2746, 168, 1, 'Total Class', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2750, 169, 1, 'GYM Fitness level', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2752, 175, 1, 'System Fitness level', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2754, 176, 1, 'Rank', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2756, 286, 1, 'Active', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2758, 74, 1, 'Get membership', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2760, 94, 1, 'Start date', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2762, 209, 1, 'Ticket', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2764, 88, 1, 'Payment', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2766, 113, 1, 'User Type', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2768, 132, 1, 'Back', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2770, 148, 1, 'Photographer', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2772, 115, 1, 'cost', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2774, 194, 1, 'quantity', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2778, 195, 1, 'Tax', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2780, 196, 1, 'Suppliers', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2782, 75, 1, 'Employee', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2784, 78, 1, 'Salary Amount', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2786, 123, 1, 'Observations', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2788, 125, 1, 'Account', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2790, 110, 1, 'Third Party Commissions', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2792, 60, 1, 'Athletes behavior', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2794, 66, 1, 'Coachboard', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2796, 76, 1, 'Whiteboard', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2800, 127, 1, 'Income Managment', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2802, 135, 1, 'paypal API', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2804, 136, 1, 'Holds', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2806, 126, 1, 'About', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2808, 193, 1, 'Skills', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2810, 44, 1, 'Thanks For Joining Our System , For More Features Please Upgrade Your Membership', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2812, 320, 1, 'Click Here', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2814, 321, 1, 'Thank you for upgrading your account.', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2816, 322, 1, 'You cant see workouts before join classes', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2818, 323, 1, 'Unblock Exercise', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2820, 324, 1, 'Sport Nutritionist', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2822, 325, 1, 'Affiliate Business', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2824, 326, 1, 'Compromise Level', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2826, 327, 1, 'Transfers', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2828, 118, 1, 'Today Workout', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2830, 328, 1, 'Benchmark Workouts', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2832, 329, 1, 'My Workouts', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2834, 330, 1, 'Meal', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2836, 154, 1, 'Skill Level', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2838, 151, 1, 'Diposit Number', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2840, 331, 1, 'Cheque', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2842, 332, 1, 'Commission', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2844, 333, 1, 'Instructions', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2846, 334, 1, 'Ledger', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2848, 335, 1, 'Time', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2850, 336, 1, 'Start Time', NULL, NULL, NULL, NULL);
INSERT INTO static_text_lang (`id_static_text_lang`, `static_text_id`, `language_id`, `title`, `body`, `description`, `short_description`, `keywords`) VALUES (2852, 337, 1, 'End Time', NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: stores
#

DROP TABLE IF EXISTS stores;

CREATE TABLE `stores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT NULL,
  `account_id` bigint(20) DEFAULT '0',
  `category_id` bigint(20) DEFAULT '0',
  `sub_category_id` bigint(20) DEFAULT '0',
  `sub_category` text COLLATE utf8_unicode_ci,
  `tag` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `image` text COLLATE utf8_unicode_ci,
  `logo` text COLLATE utf8_unicode_ci,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gps` text COLLATE utf8_unicode_ci,
  `lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_feature` tinyint(4) DEFAULT '0',
  `is_online` tinyint(4) DEFAULT '1',
  `admin_id` bigint(20) DEFAULT '0',
  `plan_id` bigint(20) DEFAULT '0',
  `plan_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: stores_files
#

DROP TABLE IF EXISTS stores_files;

CREATE TABLE `stores_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slide_lang` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  `store_id` bigint(20) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tickets
#

DROP TABLE IF EXISTS tickets;

CREATE TABLE `tickets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `parent_id` bigint(20) DEFAULT '0',
  `category_id` bigint(20) DEFAULT '0',
  `admin_id` bigint(20) DEFAULT '0',
  `ticket_id` bigint(20) DEFAULT '0',
  `rate` double DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `help` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solve_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solve_user_time` double DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `left_time` double DEFAULT '0',
  `time_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'down',
  `is_new` tinyint(4) DEFAULT '0',
  `is_stop` tinyint(4) DEFAULT '0',
  `urgency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `files` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_publish` datetime DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_responsive` tinyint(4) DEFAULT '0',
  `is_confirm` tinyint(4) DEFAULT '0',
  `is_private` tinyint(4) DEFAULT '0',
  `done_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `done_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `is_read` tinyint(4) DEFAULT '0',
  `on_date` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tickets (`id`, `customer_id`, `user_id`, `parent_id`, `category_id`, `admin_id`, `ticket_id`, `rate`, `company_name`, `user_name`, `name`, `desc`, `date`, `time`, `date_time`, `help`, `solve_time`, `solve_user_time`, `start_time`, `left_time`, `time_type`, `is_new`, `is_stop`, `urgency`, `files`, `type`, `date_publish`, `slug`, `is_responsive`, `is_confirm`, `is_private`, `done_by`, `done_user`, `is_read`, `on_date`, `create_date`, `created`, `modified`, `status`, `enabled`) VALUES (1, 0, 1, 0, 0, 0, 0, '0', NULL, NULL, 'ticket 232', 'asd sad', NULL, NULL, '2016-11-18 14:26:21', NULL, NULL, NULL, NULL, '0', 'down', 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'user', 1, '2016-11-18', NULL, '1479479181', '1479479181', 'Open', 1);


#
# TABLE STRUCTURE FOR: tickets_files
#

DROP TABLE IF EXISTS tickets_files;

CREATE TABLE `tickets_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  `ticket_id` bigint(20) DEFAULT NULL,
  `ticket_type` varchar(255) DEFAULT 'problem',
  `reply_id` bigint(20) DEFAULT '0',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tickets_status
#

DROP TABLE IF EXISTS tickets_status;

CREATE TABLE `tickets_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `notify` tinyint(1) DEFAULT '0',
  `description` text,
  `user_id` bigint(20) DEFAULT '0',
  `created_by` varchar(255) DEFAULT 'user',
  `date_added` datetime DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tickets_status (`id`, `ticket_id`, `status`, `notify`, `description`, `user_id`, `created_by`, `date_added`, `created`, `modified`) VALUES (1, 1, 'Pending', 0, 'asdas', 0, 'admin', NULL, '1479479295', '1479479295');


#
# TABLE STRUCTURE FOR: user_history
#

DROP TABLE IF EXISTS user_history;

CREATE TABLE `user_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `order_id` bigint(20) DEFAULT '0',
  `subscribe_type` varchar(255) DEFAULT NULL,
  `subscribe_status` varchar(255) DEFAULT '',
  `user_email` varchar(255) DEFAULT '',
  `token` varchar(255) DEFAULT '',
  `PayerID` varchar(255) DEFAULT '',
  `currencyCodeType` varchar(255) DEFAULT '',
  `credits` double DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `payment_record1` longtext,
  `payment_record2` longtext,
  `payment_type` varchar(255) DEFAULT NULL,
  `subscribe_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `on_date` date DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO user_history (`id`, `user_id`, `product_id`, `order_id`, `subscribe_type`, `subscribe_status`, `user_email`, `token`, `PayerID`, `currencyCodeType`, `credits`, `amt`, `payment_record1`, `payment_record2`, `payment_type`, `subscribe_date`, `on_date`, `created`, `modified`) VALUES (1, 1, 0, 0, NULL, 'confirm', '', '4234242', '43342342', 'USD', NULL, '2', NULL, NULL, 'Paypal', '2016-11-21 16:03:11', '2016-11-21', '1479744191', '1479744191');


#
# TABLE STRUCTURE FOR: user_membership_history
#

DROP TABLE IF EXISTS user_membership_history;

CREATE TABLE `user_membership_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `ownner_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `gym_id` bigint(20) DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `classes` double DEFAULT '0',
  `class_count` bigint(20) DEFAULT '0',
  `s_date` date DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT '',
  `PayerID` varchar(255) DEFAULT '',
  `currencyCodeType` varchar(255) DEFAULT '',
  `payment_record` text,
  `credits` double DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `bank_id` bigint(20) DEFAULT '0',
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_num` varchar(255) DEFAULT NULL,
  `paypal_id` bigint(20) DEFAULT '0',
  `api_username` varchar(255) DEFAULT NULL,
  `api_password` varchar(255) DEFAULT NULL,
  `api_signature` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `is_read` tinyint(4) DEFAULT '0',
  `created_by` varchar(255) DEFAULT 'user',
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: user_online
#

DROP TABLE IF EXISTS user_online;

CREATE TABLE `user_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `last_active_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO user_online (`id`, `user_id`, `user_name`, `email`, `user_type`, `status`, `last_active_time`, `created`, `modified`) VALUES (1, 0, NULL, NULL, 'admin', 1, '2016-12-03 06:58:06', NULL, NULL);
INSERT INTO user_online (`id`, `user_id`, `user_name`, `email`, `user_type`, `status`, `last_active_time`, `created`, `modified`) VALUES (2, 1, NULL, NULL, 'user', 1, '2016-11-18 09:51:21', NULL, NULL);


#
# TABLE STRUCTURE FOR: user_order_history
#

DROP TABLE IF EXISTS user_order_history;

CREATE TABLE `user_order_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT 'Pending',
  `order_status_id` int(5) DEFAULT NULL,
  `notify` tinyint(1) DEFAULT '0',
  `comment` text,
  `user_id` bigint(20) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: user_order_item_coupons
#

DROP TABLE IF EXISTS user_order_item_coupons;

CREATE TABLE `user_order_item_coupons` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `read` tinyint(4) DEFAULT '0',
  `item_id` bigint(20) DEFAULT '0',
  `order_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `ownner_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `complete_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complete_id` bigint(20) DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: user_order_items
#

DROP TABLE IF EXISTS user_order_items;

CREATE TABLE `user_order_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `read` tinyint(4) DEFAULT '0',
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `ownner_id` bigint(20) DEFAULT '0',
  `store_id` bigint(20) DEFAULT '0',
  `color_id` bigint(20) DEFAULT '0',
  `size_id` bigint(20) DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `credits_point` double DEFAULT '0',
  `order_content` text COLLATE utf8_unicode_ci,
  `payment_content` text COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: user_order_shipping_add
#

DROP TABLE IF EXISTS user_order_shipping_add;

CREATE TABLE `user_order_shipping_add` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `address1` text COLLATE utf8_unicode_ci,
  `address2` text COLLATE utf8_unicode_ci,
  `city` text COLLATE utf8_unicode_ci,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `house_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_house_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: user_orders
#

DROP TABLE IF EXISTS user_orders;

CREATE TABLE `user_orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tracking_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_number` bigint(20) DEFAULT '0',
  `order_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `store_id` bigint(20) DEFAULT '0',
  `comment` text COLLATE utf8_unicode_ci,
  `tax` bigint(20) DEFAULT '0',
  `total` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `coupon_cost` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `donation_cost` double DEFAULT '0',
  `credits_point` double DEFAULT '0',
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordered_on` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(4) DEFAULT '0',
  `read` tinyint(4) DEFAULT '0',
  `user_sound` tinyint(4) DEFAULT '0',
  `admin_read` tinyint(4) DEFAULT '0',
  `admin_sound` tinyint(4) DEFAULT '0',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) DEFAULT '0',
  `parent_id` bigint(20) DEFAULT '0',
  `account_type` varchar(255) DEFAULT 'U',
  `type` varchar(255) DEFAULT NULL,
  `department_id` varchar(255) DEFAULT NULL,
  `category` bigint(20) DEFAULT '0',
  `gender` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `debt_point` double DEFAULT '0',
  `credits_point` double DEFAULT '0',
  `total_point` double DEFAULT '0',
  `update_point` date DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `discount` double DEFAULT '0',
  `flash_notes` text,
  `image` varchar(255) DEFAULT NULL,
  `fees` double DEFAULT '0',
  `fb_id` varchar(255) DEFAULT NULL,
  `fb_image` text,
  `is_fb` tinyint(4) DEFAULT '0',
  `logo` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `address` tinytext,
  `address2` text,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `register_num` varchar(255) DEFAULT NULL,
  `expire_date` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT 'free',
  `plan_id` bigint(20) DEFAULT '0',
  `plan_type` varchar(255) DEFAULT NULL,
  `plan_month` double DEFAULT '0',
  `plan_start_date` date DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `plan_datetime` datetime DEFAULT NULL,
  `plan_member` double DEFAULT '0',
  `is_hold` tinyint(4) DEFAULT '0',
  `s_hold_date` date DEFAULT NULL,
  `e_hold_date` date DEFAULT NULL,
  `lang_id` bigint(20) DEFAULT '0',
  `created_by` varchar(255) DEFAULT 'user',
  `admin_confirm` tinyint(4) DEFAULT '1',
  `confirm` varchar(255) DEFAULT NULL,
  `enabled` tinyint(255) DEFAULT '1',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO users (`id`, `admin_id`, `parent_id`, `account_type`, `type`, `department_id`, `category`, `gender`, `company_name`, `debt_point`, `credits_point`, `total_point`, `update_point`, `first_name`, `last_name`, `username`, `email`, `password`, `discount`, `flash_notes`, `image`, `fees`, `fb_id`, `fb_image`, `is_fb`, `logo`, `dob`, `address`, `address2`, `street`, `city`, `region`, `state`, `country`, `country_code`, `zip`, `phone`, `phone2`, `province`, `mobile`, `website`, `register_num`, `expire_date`, `user_type`, `plan_id`, `plan_type`, `plan_month`, `plan_start_date`, `plan_date`, `plan_datetime`, `plan_member`, `is_hold`, `s_hold_date`, `e_hold_date`, `lang_id`, `created_by`, `admin_confirm`, `confirm`, `enabled`, `created`, `modified`, `status`, `date_added`) VALUES (1, 0, 0, 'D', '0', NULL, 0, NULL, 'dsad', '0', '8', '-4', NULL, 'user', 'su', 'user', 'pvsysgroup00@gmail.com', '123456', '0', 'yes dfds lfsdf\nd', 'profile-pics-18.jpg', '0', NULL, NULL, 0, 'iLinkPromainlogo.jpg', NULL, 'indore', NULL, NULL, 'indore', NULL, 'MP', 'india', NULL, NULL, '23432', '', NULL, NULL, NULL, NULL, NULL, 'free', 0, NULL, '0', NULL, NULL, NULL, '0', 0, NULL, NULL, 0, 'user', 1, 'confirm', 1, '1479478360', '1480718629', 1, '2016-11-18 14:12:40');
INSERT INTO users (`id`, `admin_id`, `parent_id`, `account_type`, `type`, `department_id`, `category`, `gender`, `company_name`, `debt_point`, `credits_point`, `total_point`, `update_point`, `first_name`, `last_name`, `username`, `email`, `password`, `discount`, `flash_notes`, `image`, `fees`, `fb_id`, `fb_image`, `is_fb`, `logo`, `dob`, `address`, `address2`, `street`, `city`, `region`, `state`, `country`, `country_code`, `zip`, `phone`, `phone2`, `province`, `mobile`, `website`, `register_num`, `expire_date`, `user_type`, `plan_id`, `plan_type`, `plan_month`, `plan_start_date`, `plan_date`, `plan_datetime`, `plan_member`, `is_hold`, `s_hold_date`, `e_hold_date`, `lang_id`, `created_by`, `admin_confirm`, `confirm`, `enabled`, `created`, `modified`, `status`, `date_added`) VALUES (2, 0, 1, 'A', 'Athletes', NULL, 0, '0', 'Com', '0', '0', '0', NULL, 'client', '', 'client', 'pvsysgroup01@gmail.com', '123456', '0', 'Test Message: Our server will be going down on xyz date at xyz time. Sorry for the inconvenience', 'profile-pics-181.jpg', '0', NULL, NULL, 0, NULL, '1969-12-31', 'indore', '0', NULL, 'indo', NULL, 'indore', '0', NULL, '0', '1-123-1234', '', '0', NULL, NULL, NULL, NULL, 'free', 0, NULL, '0', NULL, NULL, NULL, '0', 0, NULL, NULL, 0, 'dealer', 1, 'confirm', 1, '1479566378', '1480716288', 1, '2016-11-19 14:39:38');
INSERT INTO users (`id`, `admin_id`, `parent_id`, `account_type`, `type`, `department_id`, `category`, `gender`, `company_name`, `debt_point`, `credits_point`, `total_point`, `update_point`, `first_name`, `last_name`, `username`, `email`, `password`, `discount`, `flash_notes`, `image`, `fees`, `fb_id`, `fb_image`, `is_fb`, `logo`, `dob`, `address`, `address2`, `street`, `city`, `region`, `state`, `country`, `country_code`, `zip`, `phone`, `phone2`, `province`, `mobile`, `website`, `register_num`, `expire_date`, `user_type`, `plan_id`, `plan_type`, `plan_month`, `plan_start_date`, `plan_date`, `plan_datetime`, `plan_member`, `is_hold`, `s_hold_date`, `e_hold_date`, `lang_id`, `created_by`, `admin_confirm`, `confirm`, `enabled`, `created`, `modified`, `status`, `date_added`) VALUES (3, 0, 1, 'A', 'Athletes', NULL, 0, 'Male', 'cona', '0', '0', '0', NULL, 'test', 'test', 'test', 'test@test.com', '12-3456', '0', 'Welcome To user', NULL, '0', NULL, NULL, 0, NULL, NULL, '12321 abcd', NULL, NULL, 'Atlanta', NULL, 'GA', 'USA', NULL, NULL, '1231231234', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 0, NULL, '0', NULL, NULL, NULL, '0', 0, NULL, NULL, 0, 'dealer', 1, 'confirm', 1, '1479848241', '1479912594', 1, '2016-11-22 20:57:21');
INSERT INTO users (`id`, `admin_id`, `parent_id`, `account_type`, `type`, `department_id`, `category`, `gender`, `company_name`, `debt_point`, `credits_point`, `total_point`, `update_point`, `first_name`, `last_name`, `username`, `email`, `password`, `discount`, `flash_notes`, `image`, `fees`, `fb_id`, `fb_image`, `is_fb`, `logo`, `dob`, `address`, `address2`, `street`, `city`, `region`, `state`, `country`, `country_code`, `zip`, `phone`, `phone2`, `province`, `mobile`, `website`, `register_num`, `expire_date`, `user_type`, `plan_id`, `plan_type`, `plan_month`, `plan_start_date`, `plan_date`, `plan_datetime`, `plan_member`, `is_hold`, `s_hold_date`, `e_hold_date`, `lang_id`, `created_by`, `admin_confirm`, `confirm`, `enabled`, `created`, `modified`, `status`, `date_added`) VALUES (4, 0, 1, 'A', 'Client', NULL, 0, NULL, NULL, '0', '0', '0', NULL, 'user', 'self', 'user self', 'pvsysgroup02@gmail.com', '123456', '0', NULL, NULL, '0', NULL, NULL, 0, NULL, NULL, 'indore', NULL, NULL, 'indore', NULL, NULL, 'india', NULL, NULL, '2332432', NULL, NULL, NULL, NULL, NULL, NULL, 'free', 0, NULL, '0', NULL, NULL, NULL, '0', 0, NULL, NULL, 0, 'user', 1, 'confirm', 1, '1480690830', '1480690830', 1, '2016-12-02 10:00:30');


#
# TABLE STRUCTURE FOR: users_chat
#

DROP TABLE IF EXISTS users_chat;

CREATE TABLE `users_chat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` bigint(20) DEFAULT '0',
  `from` varchar(255) NOT NULL DEFAULT '',
  `from_name` varchar(255) DEFAULT NULL,
  `to` varchar(255) NOT NULL DEFAULT '',
  `to_id` bigint(20) DEFAULT '0',
  `to_name` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  `is_read` tinyint(4) DEFAULT '0',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users_membership
#

DROP TABLE IF EXISTS users_membership;

CREATE TABLE `users_membership` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `staff_id` bigint(20) DEFAULT '0',
  `program_id` text COLLATE utf8_unicode_ci,
  `gym_id` text COLLATE utf8_unicode_ci,
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT NULL,
  `c_point` double DEFAULT '0',
  `days` int(11) DEFAULT '0',
  `month` int(11) DEFAULT NULL,
  `slug` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `e_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member` int(11) DEFAULT '0',
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: users_paypal
#

DROP TABLE IF EXISTS users_paypal;

CREATE TABLE `users_paypal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `gym_id` bigint(20) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `comission` int(11) DEFAULT '0',
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT '0',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users_paypal (`id`, `user_id`, `gym_id`, `type`, `payment`, `username`, `password`, `signature`, `account`, `bank_name`, `description`, `comission`, `on_date`, `on_datetime`, `is_default`, `created`, `modified`, `enabled`) VALUES (1, 1, 0, 'paypal', 'Paypal', 'sushant.goralkar-facilitator_api1.gmail.com', '1405765594', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AuKe7kbwoT1tSQmbYkUAVK8.1syK', '1232131', NULL, NULL, 0, '2016-11-21', '2016-11-21 08:14:44', 1, '1479734084', '1479734084', 1);


#
# TABLE STRUCTURE FOR: users_permission
#

DROP TABLE IF EXISTS users_permission;

CREATE TABLE `users_permission` (
  `gym_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users_review
#

DROP TABLE IF EXISTS users_review;

CREATE TABLE `users_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `read` tinyint(4) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'user',
  `sender_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `request_id` bigint(20) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `comment` text COLLATE utf8_unicode_ci,
  `on_date` date DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: users_support
#

DROP TABLE IF EXISTS users_support;

CREATE TABLE `users_support` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT '0',
  `company_name` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `support_num` varchar(255) DEFAULT NULL,
  `support_hour` varchar(255) DEFAULT NULL,
  `sales_num` varchar(255) DEFAULT NULL,
  `business_hour` varchar(255) DEFAULT NULL,
  `notes` text,
  `term_desc` text,
  `image` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` longtext,
  `address2` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `enabled` tinyint(255) DEFAULT '1',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO users_support (`id`, `user_id`, `company_name`, `contact_name`, `website`, `email`, `support_num`, `support_hour`, `sales_num`, `business_hour`, `notes`, `term_desc`, `image`, `logo`, `address`, `address2`, `city`, `state`, `country`, `country_code`, `phone`, `phone2`, `enabled`, `created`, `modified`) VALUES (1, 1, 'Dealer Company', 'Dealer contacnt', 'http://pvsysgroup.us/myonlinecameras/', 'pvsysgroup00@gmail.com', '12121', '24', '34343', '5657', 'Additional Notes Pages', 'Term and condition pages\n\nTest 1  Test  2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1479817826', '1480716391');


#
# TABLE STRUCTURE FOR: users_transaction
#

DROP TABLE IF EXISTS users_transaction;

CREATE TABLE `users_transaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownner_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `product_id` bigint(20) DEFAULT '0',
  `order_id` bigint(20) DEFAULT '0',
  `amount` double DEFAULT '0',
  `amount2` double DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `on_date` date DEFAULT NULL,
  `on_datetime` datetime DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: visitor_activity
#

DROP TABLE IF EXISTS visitor_activity;

CREATE TABLE `visitor_activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `visit_date` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

