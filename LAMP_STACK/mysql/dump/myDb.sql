-- -------------------------------------------------------------
-- TablePlus 5.1.0(468)
--
-- https://tableplus.com/
--
-- Database: hotel
-- Generation Time: 2022-11-20 18:30:47.1680
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS hotel;
USE hotel;

DROP VIEW IF EXISTS `CLs`;


DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'first name',
  `last_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'last name',
  `gender` enum('male','female') NOT NULL,
  `age` int NOT NULL,
  `id_no` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'identification number',
  `email` varchar(256) NOT NULL DEFAULT 'email',
  `phone_no` varchar(256) NOT NULL DEFAULT 'phone number',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP VIEW IF EXISTS `FDs`;


DROP VIEW IF EXISTS `MAs`;


DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `res_id` bigint NOT NULL AUTO_INCREMENT,
  `cus_id` bigint NOT NULL,
  `room_number` bigint NOT NULL,
  `checkin_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` int NOT NULL DEFAULT '1',
  `cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `amt` int NOT NULL,
  `is_ordered` tinyint(1) NOT NULL DEFAULT '0',
  `responce` bigint NOT NULL,
  `room_type` bigint NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `cus_id` (`cus_id`),
  KEY `room_number` (`room_number`),
  KEY `response` (`responce`),
  KEY `room_type` (`room_type`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`room_number`) REFERENCES `room` (`id`),
  CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`responce`) REFERENCES `staff` (`id`),
  CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP VIEW IF EXISTS `reservation_column_wise_privileges_cleaners`;


DROP VIEW IF EXISTS `reservation_column_wise_privileges_fds_and_mas`;


DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `room_type` bigint NOT NULL,
  `occupied` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_type` (`room_type`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `room_type`;
CREATE TABLE `room_type` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL DEFAULT '0',
  `pic_dir` bigint NOT NULL,
  `capacity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `first_name` varchar(256) NOT NULL DEFAULT 'first name',
  `last_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'last name',
  `position` enum('FD','MA','CL') NOT NULL,
  `responsible_floor` int NOT NULL DEFAULT '0',
  `is_clean` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `travel_partner`;
CREATE TABLE `travel_partner` (
  `id` bigint NOT NULL,
  `partner_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`),
  CONSTRAINT `travel_partner_ibfk_1` FOREIGN KEY (`id`) REFERENCES `customer` (`id`),
  CONSTRAINT `travel_partner_ibfk_2` FOREIGN KEY (`partner_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `gender`, `age`, `id_no`, `email`, `phone_no`) VALUES
(1, 'Yaohong', 'DING', 'male', 1, 'U76777432', 'alittlestory233@gmail.com', '123456789');

INSERT INTO `reservation` (`res_id`, `cus_id`, `room_number`, `checkin_date`, `duration`, `cancelled`, `amt`, `is_ordered`, `responce`, `room_type`) VALUES
(4, 1, 1, '2022-11-20 15:59:28', 2, 0, 0, 1, 1, 1),
(5, 1, 1, '2022-11-20 15:59:28', 1, 1, 0, 1, 1, 1);

INSERT INTO `room` (`id`, `room_type`, `occupied`) VALUES
(1, 1, 0),
(2, 1, 0);

INSERT INTO `room_type` (`id`, `price`, `pic_dir`, `capacity`) VALUES
(1, 400, 1, 2);

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `position`, `responsible_floor`, `is_clean`) VALUES
(1, 'Richard', 'DING', 'FD', 1, 1);

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `CLs` AS select `staff`.`id` AS `id`,`staff`.`first_name` AS `first_name`,`staff`.`last_name` AS `last_name`,`staff`.`position` AS `position`,`staff`.`responsible_floor` AS `responsible_floor`,`staff`.`is_clean` AS `is_clean` from `staff` where (`staff`.`position` = 'CL');
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `FDs` AS select `staff`.`id` AS `id`,`staff`.`first_name` AS `first_name`,`staff`.`last_name` AS `last_name`,`staff`.`position` AS `position`,`staff`.`responsible_floor` AS `responsible_floor`,`staff`.`is_clean` AS `is_clean` from `staff` where (`staff`.`position` = 'FD');
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `MAs` AS select `staff`.`id` AS `id`,`staff`.`first_name` AS `first_name`,`staff`.`last_name` AS `last_name`,`staff`.`position` AS `position`,`staff`.`responsible_floor` AS `responsible_floor`,`staff`.`is_clean` AS `is_clean` from `staff` where (`staff`.`position` = 'MA');
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `reservation_column_wise_privileges_cleaners` AS select `customer`.`first_name` AS `customer_first_name`,`customer`.`last_name` AS `customer_last_name`,`customer`.`gender` AS `gender`,`reservation`.`room_number` AS `room_number`,`reservation`.`room_type` AS `room_type`,`reservation`.`checkin_date` AS `checkin_date`,`reservation`.`duration` AS `duration`,`reservation`.`cancelled` AS `cancelled`,`reservation`.`is_ordered` AS `is_ordered`,`staff`.`first_name` AS `staff_first_name`,`staff`.`last_name` AS `staff_last_name` from ((`reservation` join `customer` on((`customer`.`id` = `reservation`.`cus_id`))) join `staff` on((`staff`.`id` = `reservation`.`responce`)));
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `reservation_column_wise_privileges_fds_and_mas` AS select `customer`.`first_name` AS `customer_first_name`,`customer`.`last_name` AS `customer_last_name`,`customer`.`gender` AS `gender`,`customer`.`age` AS `age`,`customer`.`id_no` AS `id_no`,`customer`.`email` AS `email`,`customer`.`phone_no` AS `phone_no`,`reservation`.`room_number` AS `room_number`,`reservation`.`room_type` AS `room_type`,`reservation`.`checkin_date` AS `checkin_date`,`reservation`.`duration` AS `duration`,`reservation`.`cancelled` AS `cancelled`,`reservation`.`is_ordered` AS `is_ordered`,`staff`.`first_name` AS `staff_first_name`,`staff`.`last_name` AS `staff_last_name` from ((`reservation` join `customer` on((`customer`.`id` = `reservation`.`cus_id`))) join `staff` on((`staff`.`id` = `reservation`.`responce`)));

CREATE ROLE 'front_desk';
CREATE ROLE 'manager';
CREATE ROLE 'cleaner';
CREATE ROLE 'customer';
CREATE ROLE 'server';

-- connection required --
GRANT CREATE SESSION TO 'front_desk';
GRANT CREATE SESSION TO 'manager';
GRANT CREATE SESSION TO 'cleaner';
GRANT CREATE SESSION TO 'customer';
GRANT CREATE SESSION TO 'server';

-- create user --
GRANT CREATE USER ON *.* TO 'server'@'localhost' WITH GRANT option;
GRANT CREATE USER ON *.* TO 'manager'@'%' WITH GRANT option;

-- room type --
GRANT SELECT ON hotel.room_type TO 'front_desk'@'localhost';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.room_type TO 'manager'@'%' WITH GRANT OPTION;
GRANT SELECT ON hotel.room_type TO 'cleaner'@'localhost';
GRANT SELECT ON hotel.room_type TO 'customer'@'%';
GRANT SELECT ON hotel.room_type TO 'server'@'localhost' WITH GRANT OPTION;

-- staff --
GRANT SELECT ON FDs TO 'front_desk'@'localhost';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.staff TO 'manager'@'%' WITH GRANT OPTION;

-- room --
GRANT SELECT ON hotel.room TO 'front_desk'@'localhost';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.room TO 'manager'@'%' WITH GRANT OPTION;
GRANT SELECT ON hotel.room TO 'cleaner'@'localhost';
GRANT SELECT ON hotel.room TO 'customer'@'%';
GRANT SELECT ON hotel.room TO 'server'@'localhost' WITH GRANT OPTION;

-- customer --
GRANT SELECT, UPDATE ON hotel.customer TO 'front_desk'@'localhost';
GRANT SELECT, INSERT ON hotel.customer TO 'manager'@'%' WITH GRANT OPTION;
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.customer TO 'customer'@'%';

-- reservation --
GRANT SELECT, UPDATE ON hotel.reservation_column_wise_privileges_fds_and_mas TO 'front_desk'@'localhost';
GRANT SELECT, UPDATE, INSERT ON hotel.reservation_column_wise_privileges_fds_and_mas TO 'manager'@'%' WITH GRANT OPTION;
GRANT SELECT ON hotel.reservation_column_wise_privileges_cleaners TO 'cleaner'@'localhost';
GRANT SELECT, UPDATE, INSERT ON hotel.reservation_column_wise_privileges_fds_and_mas TO 'customer'@'%';



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;