
--
-- Table structure for table `engine4_product_products`
--

DROP TABLE IF EXISTS `engine4_product_products`;
CREATE TABLE `engine4_product_products` (
  `product_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  `body` longtext NOT NULL,
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL default '0',
  `photo_id` int(11) unsigned NOT NULL default '0',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `view_count` int(11) unsigned NOT NULL default '0',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `like_count` int(11) unsigned NOT NULL default '0',
  `search` tinyint(1) NOT NULL default '1',
  `draft` tinyint(1) unsigned NOT NULL default '0',
  `view_privacy` VARCHAR(24) NOT NULL default 'everyone',
  PRIMARY KEY (`product_id`),
  KEY `owner_type` (`owner_type`, `owner_id`),
  KEY `search` (`search`, `creation_date`),
  KEY `owner_id` (`owner_id`, `draft`),
  KEY `draft` (`draft`, `search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_product_categories`
--

DROP TABLE IF EXISTS `engine4_product_categories`;
CREATE TABLE `engine4_product_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`, `category_name`),
  KEY `category_name` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_product_categories`
--

INSERT IGNORE INTO `engine4_product_categories` (`category_id`, `user_id`, `category_name`) VALUES
(1, 1, 'Arts & Culture'),
(2, 1, 'Business'),
(3, 1, 'Entertainment'),
(5, 1, 'Family & Home'),
(6, 1, 'Health'),
(7, 1, 'Recreation'),
(8, 1, 'Personal'),
(9, 1, 'Shopping'),
(10, 1, 'Society'),
(11, 1, 'Sports'),
(12, 1, 'Technology'),
(13, 1, 'Other');


-- --------------------------------------------------------

--
-- Table structure for table `engine4_product_subscriptions`
--

DROP TABLE IF EXISTS `engine4_product_subscriptions`;
CREATE TABLE IF NOT EXISTS `engine4_product_subscriptions` (
  `subscription_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `subscriber_user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`subscription_id`),
  UNIQUE KEY `user_id` (`user_id`,`subscriber_user_id`),
  KEY `subscriber_user_id` (`subscriber_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_jobtypes`
--

INSERT IGNORE INTO `engine4_core_jobtypes` (`title`, `type`, `module`, `plugin`, `priority`) VALUES
('Rebuild Product Privacy', 'product_maintenance_rebuild_privacy', 'product', 'Product_Plugin_Job_Maintenance_RebuildPrivacy', 50);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menus`
--

INSERT IGNORE INTO `engine4_core_menus` (`name`, `type`, `title`) VALUES
('product_main', 'standard', 'Product Main Navigation Menu'),
('product_quick', 'standard', 'Product Quick Navigation Menu'),
('product_gutter', 'standard', 'Product Gutter Navigation Menu')
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_product', 'product', 'Products', '', '{"route":"product_general","icon":"fa-pencil"}', 'core_main', '', 4),

('core_sitemap_product', 'product', 'Products', '', '{"route":"product_general"}', 'core_sitemap', '', 4),

('product_main_browse', 'product', 'Browse Entries', 'Product_Plugin_Menus::canViewProducts', '{"route":"product_general"}', 'product_main', '', 1),
('product_main_manage', 'product', 'My Entries', 'Product_Plugin_Menus::canCreateProducts', '{"route":"product_general","action":"manage"}', 'product_main', '', 2),
('product_main_create', 'product', 'Write New Entry', 'Product_Plugin_Menus::canCreateProducts', '{"route":"product_general","action":"create"}', 'product_main', '', 3),

('product_quick_create', 'product', 'Write New Entry', 'Product_Plugin_Menus::canCreateProducts', '{"route":"product_general","action":"create","class":"buttonlink icon_product_new"}', 'product_quick', '', 1),
('product_quick_style', 'product', 'Edit Product Style', 'Product_Plugin_Menus', '{"route":"product_general","action":"style","class":"smoothbox buttonlink icon_product_style"}', 'product_quick', '', 2),

('product_gutter_list', 'product', 'View All Entries', 'Product_Plugin_Menus', '{"route":"product_view","class":"buttonlink icon_product_viewall"}', 'product_gutter', '', 1),
('product_gutter_create', 'product', 'Write New Entry', 'Product_Plugin_Menus', '{"route":"product_general","action":"create","class":"buttonlink icon_product_new"}', 'product_gutter', '', 2),
('product_gutter_style', 'product', 'Edit Product Style', 'Product_Plugin_Menus', '{"route":"product_general","action":"style","class":"smoothbox buttonlink icon_product_style"}', 'product_gutter', '', 3),
('product_gutter_edit', 'product', 'Edit This Entry', 'Product_Plugin_Menus', '{"route":"product_specific","action":"edit","class":"buttonlink icon_product_edit"}', 'product_gutter', '', 4),
('product_gutter_delete', 'product', 'Delete This Entry', 'Product_Plugin_Menus', '{"route":"product_specific","action":"delete","class":"buttonlink smoothbox icon_product_delete"}', 'product_gutter', '', 5),
('product_gutter_share', 'product', 'Share', 'Product_Plugin_Menus', '{"route":"default","module":"activity","controller":"index","action":"share","class":"buttonlink smoothbox icon_comments"}', 'product_gutter', '', 6),
('product_gutter_report', 'product', 'Report', 'Product_Plugin_Menus', '{"route":"default","module":"core","controller":"report","action":"create","class":"buttonlink smoothbox icon_report"}', 'product_gutter', '', 7),
('product_gutter_subscribe', 'product', 'Subscribe', 'Product_Plugin_Menus', '{"route":"default","module":"product","controller":"subscription","action":"add","class":"buttonlink smoothbox icon_product_subscribe"}', 'product_gutter', '', 8),

('core_admin_main_plugins_product', 'product', 'Products', '', '{"route":"admin_default","module":"product","controller":"manage"}', 'core_admin_main_plugins', '', 999),

('product_admin_main_manage', 'product', 'View Products', '', '{"route":"admin_default","module":"product","controller":"manage"}', 'product_admin_main', '', 1),
('product_admin_main_settings', 'product', 'Global Settings', '', '{"route":"admin_default","module":"product","controller":"settings"}', 'product_admin_main', '', 2),
('product_admin_main_level', 'product', 'Member Level Settings', '', '{"route":"admin_default","module":"product","controller":"level"}', 'product_admin_main', '', 3),
('product_admin_main_categories', 'product', 'Categories', '', '{"route":"admin_default","module":"product","controller":"settings", "action":"categories"}', 'product_admin_main', '', 4),

('authorization_admin_level_product', 'product', 'Products', '', '{"route":"admin_default","module":"product","controller":"level","action":"index"}', 'authorization_admin_level', '', 999),
('mobi_browse_product', 'product', 'Products', '', '{"route":"product_general"}', 'mobi_browse', '', 3);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('product', 'Products', 'Products', '4.8.12', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('product_new', 'product', '{item:$subject} wrote a new product entry:', 1, 5, 1, 3, 1, 1),
('comment_product', 'product', '{item:$subject} commented on {item:$owner}''s {item:$object:product entry}.', 1, 1, 1, 3, 3, 0),
('like_product', 'product', '{item:$subject} liked {item:$owner}''s {item:$object:product entry}.', 1, 1, 1, 3, 3, 0);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_notificationtypes`
--

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('product_subscribed_new', 'product', '{item:$subject} has posted a new product entry: {item:$object}.', 0, '');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_mailtemplates`
--

INSERT IGNORE INTO `engine4_core_mailtemplates` (`type`, `module`, `vars`) VALUES
('notify_product_subscribed_new', 'product', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

-- ALL
-- auth_view, auth_comment, auth_html
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'auth_view' as `name`,
    5 as `value`,
    '["everyone","owner_network","owner_member_member","owner_member","owner"]' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'auth_comment' as `name`,
    5 as `value`,
    '["everyone","owner_network","owner_member_member","owner_member","owner"]' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'auth_html' as `name`,
    3 as `value`,
    'blockquote, strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr, iframe' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');

-- ADMIN, MODERATOR
-- create, delete, edit, view, comment, css, style, max
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'view' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'comment' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'style' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'max' as `name`,
    3 as `value`,
    1000 as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');

-- USER
-- create, delete, edit, view, comment, css, style, max
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'delete' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'edit' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'comment' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'style' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'max' as `name`,
    3 as `value`,
    50 as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');

-- PUBLIC
-- view
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'product' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('public');

