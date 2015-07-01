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
    `f_user_salt` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
    `f_user_hint` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `easymvc_db`.`f_action` (`f_action_key`,`f_action_description`) VALUES ('auth','Authentication action');
INSERT INTO `easymvc_db`.`f_user_role` (`f_user_role_desc`) VALUES ('Default');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
