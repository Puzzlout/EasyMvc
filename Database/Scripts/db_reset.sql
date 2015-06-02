-- Loffy Framework
--
-- History:
-- 26-02-15: Creation

DROP SCHEMA IF EXISTS `budget_app_1`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- Database: `budget_app_1`
CREATE DATABASE IF NOT EXISTS `budget_app_1` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `budget_app_1`;

/*---------------------------------------------------------------------------------------------*/
/*                                         HELPERS                                             */
/*---------------------------------------------------------------------------------------------*/
--  PRIMARY KEY (`id`)
--
--  CONSTRAINT `fk_ba_budget` FOREIGN KEY (`budget_id`)
--      REFERENCES `budget_id` (`budget_id`) ON DELETE CASCADE
--
--
/*---------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
-- Table structure for table `user`
CREATE TABLE IF NOT EXISTS `user` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `user_hint` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`user_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `budget`
CREATE TABLE IF NOT EXISTS `budget` (
    `budget_id` int(11) NOT NULL AUTO_INCREMENT,
    `budget_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `budget_active` tinyint(1) DEFAULT NULL,
    `budget_visible` tinyint(1) DEFAULT NULL,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`budget_id`),
    CONSTRAINT `fk_user_budget` FOREIGN KEY (`user_id`)
      REFERENCES `user` (`user_id`) ON DELETE CASCADE
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `account`
CREATE TABLE IF NOT EXISTS `account` (
    `account_id` int(11) NOT NULL AUTO_INCREMENT,
    `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `account_desc` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
    `account_active` tinyint(1) DEFAULT NULL,
    `account_visible` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`account_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT=1;

-- Table structure for table `budget_account
CREATE TABLE `budget_account` (
    `budget_id` int(11) NOT NULL,
    `account_id` int(11) NOT NULL,
    CONSTRAINT `fk_ba_budget` FOREIGN KEY (`budget_id`)
        REFERENCES `budget_id` (`budget_id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ba_account` FOREIGN KEY (`account_id`)
        REFERENCES `account` (`account_id`) ON DELETE CASCADE
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
