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
    `f_log_id` int(25) NOT NULL AUTO_INCREMENT,
    `f_log_guid` varchar(36) NOT NULL COMMENT 'A GUID generated using the class \Library\Utility\UUID::v4()',
    `f_log_request_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The current http request id',
    `f_log_level` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'See the class \Library\BO\F_log_extension',
    `f_log_start` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'FORMAT: Y-m-d H:i:s',
    `f_log_end` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'FORMAT: Y-m-d H:i:s',
    `f_log_execution_time` float(10,6) NOT NULL COMMENT 'In milliseconds',
    `f_log_source` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'class_name->method',
    `f_log_context` varchar(4000) COLLATE utf8_unicode_ci NULL COMMENT 'data context at the time of log',
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
    `f_culture_language` varchar(3) NOT NULL COMMENT 'Language of format xx',
    `f_culture_region` varchar(3) NULL COMMENT 'Currency of format XX',
    `f_culture_iso_639` varchar(3)NOT NULL COMMENT 'ISO 639x Value',
    `f_culture_display_name` varchar(50) NOT NULL COMMENT 'Description of culture. ex: American English',
    PRIMARY KEY (`f_culture_id`),
    UNIQUE INDEX `un_f_culture` (`f_culture_language` ASC, `f_culture_region` ASC) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `f_common_resource` (
    `f_common_resource_group` varchar(50) NOT NULL COMMENT 'The group of the resource. Ex: Exception, etc...',
    `f_common_resource_key` varchar(50) NOT NULL COMMENT 'The identification of the resource. Ex: TopMenuBrandIconAlt',
    `f_common_resource_value` varchar(4000) NOT NULL,
    `f_common_resource_comment` varchar(100) NULL COMMENT 'Describe the resource usage',
    `f_culture_id` int(11) NOT NULL,
    PRIMARY KEY (`f_common_resource_group`,`f_common_resource_key`,`f_culture_id`),
    CONSTRAINT `fk_cul_resx_common` FOREIGN KEY (`f_culture_id`)
      REFERENCES `f_culture` (`f_culture_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `f_controller_resource` (
    `f_controller_resource_key` varchar(50) NOT NULL COMMENT 'The identification of the resource. Ex: H3Title or ButtonAddSomething',
    `f_controller_resource_module` varchar(50) NOT NULL COMMENT 'Usually represents the Controller name with the prefix "Controller"',
    `f_controller_resource_action` varchar(50) NOT NULL COMMENT 'Usually represents the action of the Controller executed',
    `f_controller_resource_value` varchar(4000) NOT NULL,
    `f_controller_resource_comment` varchar(100) NULL COMMENT 'Describe the resource usage',
    `f_culture_id` int(11) NOT NULL,
    PRIMARY KEY (`f_controller_resource_key`, `f_controller_resource_module`, `f_controller_resource_action`, `f_culture_id`),
    CONSTRAINT `fk_cul_resx_controller` FOREIGN KEY (`f_culture_id`)
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

INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('af','ZA','AFK','Afrikaans - South Africa');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sq','AL','SQI','Albanian - Albania');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','DZ','ARG','Arabic - Algeria');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','BH','ARH','Arabic - Bahrain');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','EG','ARE','Arabic - Egypt');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','IQ','ARI','Arabic - Iraq');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','JO','ARJ','Arabic - Jordan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','KW','ARK','Arabic - Kuwait');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','LB','ARB','Arabic - Lebanon');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','LY','ARL','Arabic - Libya');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','MA','ARM','Arabic - Morocco');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','OM','ARO','Arabic - Oman');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','QA','ARQ','Arabic - Qatar');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','SA','ARA','Arabic - Saudi Arabia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','SY','ARS','Arabic - Syria');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','TN','ART','Arabic - Tunisia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','AE','ARU','Arabic - United Arab Emirates');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ar','YE','ARY','Arabic - Yemen');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('hy','AM','','Armenian - Armenia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('eu','ES','EUQ','Basque - Basque');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('be','BY','BEL','Belarusian - Belarus');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('bg','BG','BGR','Bulgarian - Bulgaria');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ca','ES','CAT','Catalan - Catalan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','CN','CHS','Chinese - China');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','HK','ZHH','Chinese - Hong Kong SAR');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','MO','','Chinese - Macau SAR');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','SG','ZHI','Chinese - Singapore');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','TW','CHT','Chinese - Taiwan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','CHS','','Chinese (Simplified)');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('zh','CHT','','Chinese (Traditional)');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('hr','HR','HRV','Croatian - Croatia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('cs','CZ','CSY','Czech - Czech Republic');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('da','DK','DAN','Danish - Denmark');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('div','MV','','Dhivehi - Maldives');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('nl','BE','NLB','Dutch - Belgium');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('nl','NL','','Dutch - The Netherlands');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','AU','ENA','English - Australia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','BZ','ENL','English - Belize');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','CA','ENC','English - Canada');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','CB','','English - Caribbean');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','IE','ENI','English - Ireland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','JM','ENJ','English - Jamaica');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','NZ','ENZ','English - New Zealand');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','PH','','English - Philippines');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','ZA','ENS','English - South Africa');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','TT','ENT','English - Trinidad and Tobago');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','GB','ENG','English - United Kingdom');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','US','ENU','English - United States');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('en','ZW','','English - Zimbabwe');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('et','EE','ETI','Estonian - Estonia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fo','FO','FOS','Faroese - Faroe Islands');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fa','IR','FAR','Farsi - Iran');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fi','FI','FIN','Finnish - Finland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fr','BE','FRB','French - Belgium');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fr','CA','FRC','French - Canada');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fr','FR','','French - France');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fr','LU','FRL','French - Luxembourg');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fr','MC','','French - Monaco');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('fr','CH','FRS','French - Switzerland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('gl','ES','','Galician - Galician');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ka','GE','','Georgian - Georgia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('de','AT','DEA','German - Austria');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('de','DE','','German - Germany');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('de','LI','DEC','German - Liechtenstein');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('de','LU','DEL','German - Luxembourg');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('de','CH','DES','German - Switzerland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('el','GR','ELL','Greek - Greece');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('gu','IN','','Gujarati - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('he','IL','HEB','Hebrew - Israel');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('hi','IN','HIN','Hindi - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('hu','HU','HUN','Hungarian - Hungary');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('is','IS','ISL','Icelandic - Iceland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('id','ID','','Indonesian - Indonesia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('it','IT','','Italian - Italy');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('it','CH','ITS','Italian - Switzerland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ja','JP','JPN','Japanese - Japan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('kn','IN','','Kannada - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('kk','KZ','','Kazakh - Kazakhstan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('kok','IN','','Konkani - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ko','KR','KOR','Korean - Korea');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ky','KZ','','Kyrgyz - Kazakhstan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('lv','LV','LVI','Latvian - Latvia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('lt','LT','LTH','Lithuanian - Lithuania');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('mk','MK','MKD','Macedonian (FYROM)');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ms','BN','','Malay - Brunei');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ms','MY','','Malay - Malaysia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('mr','IN','','Marathi - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('mn','MN','','Mongolian - Mongolia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('nb','NO','','Norwegian (Bokmål) - Norway');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('nn','NO','','Norwegian (Nynorsk) - Norway');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('pl','PL','PLK','Polish - Poland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('pt','BR','PTB','Portuguese - Brazil');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('pt','PT','','Portuguese - Portugal');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('pa','IN','','Punjabi - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ro','RO','ROM','Romanian - Romania');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ru','RU','RUS','Russian - Russia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sa','IN','','Sanskrit - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sk','SK','SKY','Slovak - Slovakia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sl','SI','SLV','Slovenian - Slovenia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','AR','ESS','Spanish - Argentina');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','BO','ESB','Spanish - Bolivia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','CL','ESL','Spanish - Chile');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','CO','ESO','Spanish - Colombia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','CR','ESC','Spanish - Costa Rica');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','DO','ESD','Spanish - Dominican Republic');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','EC','ESF','Spanish - Ecuador');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','SV','ESE','Spanish - El Salvador');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','GT','ESG','Spanish - Guatemala');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','HN','ESH','Spanish - Honduras');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','MX','ESM','Spanish - Mexico');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','NI','ESI','Spanish - Nicaragua');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','PA','ESA','Spanish - Panama');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','PY','ESZ','Spanish - Paraguay');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','PE','ESR','Spanish - Peru');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','PR','ES','Spanish - Puerto Rico');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','ES','','Spanish - Spain');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','UY','ESY','Spanish - Uruguay');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('es','VE','ESV','Spanish - Venezuela');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sw','KE','','Swahili - Kenya');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sv','FI','SVF','Swedish - Finland');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('sv','SE','','Swedish - Sweden');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('syr','SY','','Syriac - Syria');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ta','IN','','Tamil - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('tt','RU','','Tatar - Russia');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('te','IN','','Telugu - India');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('th','TH','THA','Thai - Thailand');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('tr','TR','TRK','Turkish - Turkey');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('uk','UA','UKR','Ukrainian - Ukraine');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('ur','PK','URD','Urdu - Pakistan');
INSERT INTO `f_culture` (`f_culture_language`,`f_culture_region`,`f_culture_iso_639`,`f_culture_display_name`) VALUES ('vi','VN','VIT','Vietnamese - Vietnam');

INSERT INTO `easymvc_db`.`f_common_resource` VALUES 
('group1','test', 'This is a test value', 'Testing purpose', '47'),
('group1','test3', 'This is a test value3', 'Testing purpose', '47'),
('group2','test2', 'This is a test value2', 'Testing purpose', '47'),
('group2','test3', 'This is a test value3', 'Testing purpose', '47'),
('group1','test', 'This is a test value', 'Testing purpose', '48'),
('group1','test1', 'This is a test value1', 'Testing purpose', '48'),
('group2','test2', 'This is a test value2', 'Testing purpose', '48'),
('group2','test1', 'This is a test value1', 'Testing purpose', '48'),
('group1','test', 'C\'est une valeur de test', 'Testing purpose', '56'),
('group1','test2', 'C\'est une valeur de test2', 'Testing purpose', '56'),
('group2','test2', 'C\'est une valeur de test2', 'Testing purpose', '56'),
('group2','test3', 'C\'est une valeur de test3', 'Testing purpose', '56');

INSERT INTO `easymvc_db`.`f_controller_resource` VALUES 
('pagetitle', 'account', 'login', 'EasyMvc - Login', 'The title of the page', '47'),
('h1_title', 'account', 'login', 'Login View', 'The title of the H1 element', '47'),
('email_label', 'account', 'login', 'E-mail:', 'The label for the email input','47'),
('email_ph_text', 'account', 'login', 'e-mail address', 'The input placeholder for the e-mail','47'),
('username_label', 'account', 'login', 'Username', 'The label for the username input','47'),
('username_ph_text', 'account', 'login', 'type your username', 'The input placeholder for the username','47'),
('pwd_label', 'account', 'login', 'Password', 'The label for the password','47'),
('pwd_ph_text', 'account', 'login', 'type password', 'The input placeholder for the password','47'),
('login_btn_text', 'account', 'login', 'Login', 'The label for the Login button','47'),
('h1_title', 'account', 'create', 'Create account View', 'The title of the H1 element','47'),
('email_label', 'account', 'create', 'E-mail:', 'The label for the email input','47'),
('pagetitle', 'account', 'login', 'EasyMvc - Login', 'The title of the page', '48'),
('h1_title', 'account', 'login', 'Login View', 'The title of the H1 element','48'),
('email_label', 'account', 'login', 'E-mail:', 'The label for the email input','48'),
('email_ph_text', 'account', 'login', 'e-mail address', 'The input placeholder for the e-mail','48'),
('username_label', 'account', 'login', 'Username', 'The label for the username input','48'),
('username_ph_text', 'account', 'login', 'type your username', 'The input placeholder for the username','48'),
('pwd_label', 'account', 'login', 'Password', 'The label for the password','48'),
('pwd_ph_text', 'account', 'login', 'type password', 'The input placeholder for the password','48'),
('login_btn_text', 'account', 'login', 'Login', 'The label for the Login button','48'),
('h1_title', 'account', 'create', 'Create account View', 'The title of the H1 element','48'),
('email_label', 'account', 'create', 'E-mail:', 'The label for the email input','48'),
('pagetitle', 'account', 'login', 'EasyMvc - Login', 'The title of the page', '56'),
('h1_title', 'account', 'login', 'Vue Connexion', 'Le titre de l''élément H1','56'),
('email_label', 'account', 'login', 'E-mail :', 'Le libellé de l''input email','56'),
('h1_title', 'account', 'create', 'Vue Création de compte', 'Le titre de l''élément H1','56'),
('email_label', 'account', 'create', 'E-mail :', 'Le libellé de l''input email','56'),
('pagetitle', 'generator', 'buildresources', 'Code generation - Resources', 'Page title','47'),
('pagetitle', 'generator', 'buildresources', 'Code generation - Resources', 'Page title','48'),
('pagetitle', 'generator', 'builddao', 'Code generation - DAO', 'Page title','47'),
('pagetitle', 'generator', 'builddao', 'Code generation - DAO', 'Page title','48'),
('pagetitle', 'webide', 'createfile', 'IDE - Create a file or class', 'Page title','47'),
('pagetitle', 'webide', 'createfile', 'IDE - Create a file or class', 'Page title','48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
