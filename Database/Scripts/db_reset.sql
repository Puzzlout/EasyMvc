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
-- Table structure for `user_role`
CREATE TABLE IF NOT EXISTS `user_role` (
    `user_role_id` smallint(2) NOT NULL,
    `user_role_desc` varchar(100),
    PRIMARY KEY (`user_role_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;

-- Table structure for `user`
CREATE TABLE IF NOT EXISTS `user` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `user_hint` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `user_email` VARCHAR(50) NOT NULL COMMENT 'User email that is unique and must be set',
    `user_role_id` smallint(2) NOT NULL COMMENT 'Look up the table user_role for details about the roles',
    `user_session_id` VARCHAR(50) NULL COMMENT 'Hashed session ID',
    UNIQUE INDEX `un_user_login` (`user_login` ASC),
    UNIQUE INDEX `un_user_email` (`user_email` ASC),
    CONSTRAINT `fk_user_role_user` FOREIGN KEY (`user_role_id`)
        REFERENCES `user_role` (`user_role_id`),
    PRIMARY KEY (`user_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `account`
CREATE TABLE IF NOT EXISTS `account` (
    `account_id` int(11) NOT NULL AUTO_INCREMENT,
    `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `account_desc` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
    `account_active` tinyint(1) DEFAULT NULL,
    `account_visible` tinyint(1) DEFAULT NULL,
	`user_id` int(11) NOT NULL,
    PRIMARY KEY (`account_id`),
	CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`)
      REFERENCES `user` (`user_id`) ON DELETE CASCADE
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `log`
CREATE TABLE IF NOT EXISTS `log` (
    `log_id` int(11) NOT NULL AUTO_INCREMENT,
    `log_request_id` varchar(50) NOT NULL,
    `log_start` varchar(20) NOT NULL,
    `log_end` varchar(20) NOT NULL COMMENT 'FORMAT: Y-m-d H:i:s',
    `log_execution_time` float(10,6) NOT NULL COMMENT 'In milliseconds',
    `log_type` varchar(40) NOT NULL COMMENT 'http_request, controller_method',
    `log_filter` varchar(100) NOT NULL,
	`log_value` varchar(2000) NULL,
    PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
