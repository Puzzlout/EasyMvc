--  Framework
--
-- History:
-- 26-02-15: Creation

DROP SCHEMA IF EXISTS `easymvc_db`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- Database: `budget_app_1`
CREATE DATABASE IF NOT EXISTS `easymvc_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `easymvc_db`;

/*---------------------------------------------------------------------------------------------*/
/*                                         HELPERS                                             */
/*---------------------------------------------------------------------------------------------*/
--  PRIMARY KEY (`id`)
--
--  CONSTRAINT `fk_some_table` FOREIGN KEY (`some_id`)
--      REFERENCES `some_other_table` (`some_id`) ON DELETE CASCADE
--
--
/*---------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
-- Table structure for `f_user_role`
CREATE TABLE IF NOT EXISTS `f_user_role` (
    `f_user_role_id` smallint(2) NOT NULL AUTO_INCREMENT,
    `f_user_role_desc` varchar(100),
    PRIMARY KEY (`f_user_role_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for `f_user`
CREATE TABLE IF NOT EXISTS `f_user` (
    `f_user_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_user_login` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `f_user_password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
	`f_user_password_is_hashed`tinyint(1) DEFAULT 0 NOT NULL COMMENT 'Flag to know if a password is hashed or not',
	`f_user_token` varchar(24) COLLATE utf8_unicode_ci NULL COMMENT 'The token used to enable a user to login after changing his password at the first connection',
    `f_user_salt` varchar(36) COLLATE utf8_unicode_ci NULL,
    `f_user_hint` varchar(20) COLLATE utf8_unicode_ci NULL,
    `f_user_email` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User email that is unique and must be set',
    `f_user_role_id` smallint(2) NOT NULL COMMENT 'Look up the table user_role for details about the roles',
    `f_user_session_id` VARCHAR(50) COLLATE utf8_unicode_ci NULL COMMENT 'Hashed session ID',
    UNIQUE INDEX `un_user_login` (`f_user_login` ASC),
    UNIQUE INDEX `un_user_email` (`f_user_email` ASC),
    CONSTRAINT `fk_user_role_user` FOREIGN KEY (`f_user_role_id`)
        REFERENCES `f_user_role` (`f_user_role_id`),
    PRIMARY KEY (`f_user_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_account`
CREATE TABLE IF NOT EXISTS `f_account` (
    `f_account_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `f_account_desc` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
    `f_account_active` tinyint(1) DEFAULT NULL,
    `f_account_visible` tinyint(1) DEFAULT NULL,
	`f_user_id` int(11) NOT NULL,
    PRIMARY KEY (`f_account_id`),
	CONSTRAINT `fk_user_account` FOREIGN KEY (`f_user_id`)
      REFERENCES `f_user` (`f_user_id`) ON DELETE CASCADE
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_log`
CREATE TABLE IF NOT EXISTS `f_log` (
    `f_log_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_log_request_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `f_log_start` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `f_log_end` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'FORMAT: Y-m-d H:i:s',
    `f_log_execution_time` float(10,6) NOT NULL COMMENT 'In milliseconds',
    `f_log_type` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT 'http_request, controller_method',
    `f_log_filter` varchar(100) NOT NULL,
	`f_log_value` varchar(2000) NULL,
    PRIMARY KEY (`f_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;


-- Table structure for table `f_action`
CREATE TABLE IF NOT EXISTS `f_action` (
    `f_action_key` varchar(4) NOT NULL,
    `f_action_description` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Describe the action',
    PRIMARY KEY (`f_action_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for table `f_ip_blacklist`
CREATE TABLE IF NOT EXISTS `f_ip_blacklist` (
    `f_ip_blacklist_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_ip_blacklist_ip_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Actual IP address value',
    `f_ip_blacklist_attempts` tinyint(1) NOT NULL COMMENT 'Attempts made by ip of a certain action',
    `f_ip_blacklist_timestamp` varchar(20) COLLATE utf8_unicode_ci NULL COMMENT 'Timestamp set when the ip is blacklisted. FORMAT: Y-m-d H:i:s',
	`f_ip_blacklist_expired` tinyint(1) NULL DEFAULT 0 COMMENT 'Value to 1 expires the blacklisting of the ip for the action',
	`f_action_key` varchar(6) NOT NULL,
    PRIMARY KEY (`f_ip_blacklist_id`),
	CONSTRAINT `fk_ip_blacklist_action` FOREIGN KEY (`f_action_key`)
      REFERENCES `f_action` (`f_action_key`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_common_partial_view`
CREATE TABLE IF NOT EXISTS `f_common_partial_view` (
    `f_common_partial_view_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_common_partial_view_file_path` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`f_common_partial_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_route_type`
CREATE TABLE IF NOT EXISTS `f_route_type` (
    `f_route_type_id` varchar(10) NOT NULL,
    `f_route_type_description` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Describe the type',
    PRIMARY KEY (`f_route_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for table `f_route`
CREATE TABLE IF NOT EXISTS `f_route` (
    `f_route_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_route_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Url to match the request',
    `f_route_controller` tinyint(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Controller class to load',
    `f_route_action` varchar(50) COLLATE utf8_unicode_ci NULL COMMENT 'Controller action to execute',
	`f_route_resource_key` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Key to retrieve the resources for the route',
	`f_route_type_id` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'See f_route_type table',
    PRIMARY KEY (`f_route_id`),
	CONSTRAINT `fk_route_route_type` FOREIGN KEY (`f_route_type_id`)
      REFERENCES `f_route_type` (`f_route_type_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_route_js`
CREATE TABLE IF NOT EXISTS `f_route_js` (
    `f_route_js_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_route_js_file_path` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `f_route_id` int(11) NOT NULL COMMENT 'See f_route table',
    PRIMARY KEY (`f_route_js_id`),
    CONSTRAINT `fk_route_route_js` FOREIGN KEY (`f_route_id`)
      REFERENCES `f_route` (`f_route_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_route_css`
CREATE TABLE IF NOT EXISTS `f_route_css` (
    `f_route_css_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_route_css_file_path` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `f_route_id` int(11) NOT NULL COMMENT 'See f_route table',
    PRIMARY KEY (`f_route_css_id`),
    CONSTRAINT `fk_route_route_css` FOREIGN KEY (`f_route_id`)
      REFERENCES `f_route` (`f_route_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_route_common_partial_view`
CREATE TABLE IF NOT EXISTS `f_route_common_partial_view` (
    `f_route_id` int(11) NOT NULL COMMENT 'See f_route table',
    `f_common_partial_view_id` int(11) NOT NULL COMMENT 'See f_common_partial_view',
    CONSTRAINT `fk_rcpv_route` FOREIGN KEY (`f_route_id`)
      REFERENCES `f_route` (`f_route_id`) ON DELETE CASCADE,
    CONSTRAINT `fk_rcpv_cpv` FOREIGN KEY (`f_common_partial_view_id`)
      REFERENCES `f_common_partial_view` (`f_common_partial_view_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `f_document`
CREATE TABLE IF NOT EXISTS `f_document` (
    `f_document_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_document_content_type` varchar(50) NOT NULL COMMENT 'Store the content type of the document',
    `f_document_category` varchar(50) NOT NULL COMMENT 'Is the name of the table/class for which we want a document. Ex: element_id for element table',
    `f_document_category_id_value` varchar(50) NOT NULL COMMENT 'Is the id of document_category. Ex: the value of element_id of element table',
    `f_document_value` varchar(100) NOT NULL COMMENT 'A unique constraint prevent adding the same document as a given type',
    `f_document_size` int(11) NOT NULL COMMENT 'File size in Kb',
    `f_document_title` varchar(250) NULL DEFAULT 'Caption goes here' COMMENT 'This is the value for a document that is displayed in the HTML as a caption',
    PRIMARY KEY (`f_document_id`),
    UNIQUE INDEX `un_doc_cat_val` (`f_document_id` ASC, `f_document_category` ASC, `f_document_category_id_value` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `f_culture` (
    `f_culture_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_culture_lang` varchar(2) NOT NULL COMMENT 'Language of format xx',
    `f_culture_currency` varchar(2) NULL COMMENT 'Currency of format XX',
    `f_culture_desc` varchar(25) NOT NULL COMMENT 'Description of culture. ex: American English',
    PRIMARY KEY (`f_culture_id`),
    UNIQUE INDEX `un_f_culture` (`f_culture_value` ASC) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `f_resource_global` (
    `f_resource_global_key` varchar(50) NOT NULL COMMENT 'The identification of the resource. Ex: TopMenuBrandIconAlt',
    `f_resource_global_value` varchar(4000) NOT NULL,
    `f_culture_id` int(11) NOT NULL,
    PRIMARY KEY (`f_resource_global_key`,`f_culture_id`),
    CONSTRAINT `fk_cul_resx_global` FOREIGN KEY (`f_culture_id`)
      REFERENCES `f_culture` (`f_culture_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `f_resource_local` (
    `f_resource_local_key` varchar(50) NOT NULL COMMENT 'The identification of the resource. Ex: H3Title or ButtonAddSomething',
    `f_resource_local_action` varchar(50) NOT NULL COMMENT 'Usually represents the action of the Controller executed',
    `f_resource_local_module` varchar(50) NOT NULL COMMENT 'Usually represents the Controller name with the prefix "Controller"',
    `f_resource_local_value` varchar(4000) NOT NULL,
    `f_culture_id` int(11) NOT NULL,
    PRIMARY KEY (`f_resource_local_key`,`f_culture_id`),
    CONSTRAINT `fk_cul_resx_local` FOREIGN KEY (`f_culture_id`)
      REFERENCES `f_culture` (`f_culture_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------------------------------------------------------
-- Data 
-- ----------------------------------------------------------------------------
INSERT INTO `f_action` (`f_action_key`,`f_action_description`) VALUES ('auth','Authentication action');

INSERT INTO `f_route_type` (`f_route_type_id`,`f_route_type_description`) 
VALUES 
('ui','Represent a route executing an action in a Application controller to load a HTML view to the end user.'),
('lib','Represent a route executing an action in a Framework controller to load a HTML view to the developer.'),
('ajax','Represent a route executing an AJAX request in an Application controller.'),
('lib ajax','Represent a route executing an AJAX request in an Framework controller.');

INSERT INTO `f_user_role` (`f_user_role_desc`) VALUES ('Default');

INSERT INTO `f_user` VALUES (1,'t','t',0,null,null,null,'t@t.com',1,null);

INSERT INTO `f_culture` (`f_culture_value`) VALUES 
('en', null, 'English'),
('en', 'US', 'American English'),
('fr', null, 'Français'),
('fr', 'FR', 'Français (France)');

INSERT INTO `easymvc_db`.`f_resource_global` VALUES 
('test', 'This is a test value', '1'),
('test', 'This is a test value', '2'),
('test', 'C\'est une valeur de test', '3'),
('test', 'C\'est une valeur de test', '4');

INSERT INTO `easymvc_db`.`f_resource_local` VALUES 
('h1_title', 'account', 'login', 'Login View', '1'),
('email_label', 'account', 'login', 'E-mail:', '1'),
('h1_title', 'account', 'login', 'Login View', '2'),
('email_label', 'account', 'login', 'E-mail:', '2'),
('h1_title', 'account', 'login', 'Vue Connexion', '3'),
('email_label', 'account', 'login', 'E-mail :', '3'),
('h1_title', 'account', 'login', 'Vue Connexion', '4'),
('email_label', 'account', 'login', 'E-mail :', '4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
