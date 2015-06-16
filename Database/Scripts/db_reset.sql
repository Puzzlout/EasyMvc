-- EasyMvc Framework
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
    `f_user_role_id` smallint(2) NOT NULL,
    `f_user_role_desc` varchar(100),
    PRIMARY KEY (`f_user_role_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;

-- Table structure for `f_user`
CREATE TABLE IF NOT EXISTS `f_user` (
    `f_user_id` int(11) NOT NULL AUTO_INCREMENT,
    `f_user_login` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `f_user_password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
    `f_user_salt` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
    `f_user_hint` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `f_user_email` VARCHAR(50) NOT NULL COMMENT 'User email that is unique and must be set',
    `f_user_role_id` smallint(2) NOT NULL COMMENT 'Look up the table user_role for details about the roles',
    `f_user_session_id` VARCHAR(50) NULL COMMENT 'Hashed session ID',
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
    `f_log_request_id` varchar(50) NOT NULL,
    `f_log_start` varchar(20) NOT NULL,
    `f_log_end` varchar(20) NOT NULL COMMENT 'FORMAT: Y-m-d H:i:s',
    `f_log_execution_time` float(10,6) NOT NULL COMMENT 'In milliseconds',
    `f_log_type` varchar(40) NOT NULL COMMENT 'http_request, controller_method',
    `f_log_filter` varchar(100) NOT NULL,
	`f_log_value` varchar(2000) NULL,
    PRIMARY KEY (`f_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
