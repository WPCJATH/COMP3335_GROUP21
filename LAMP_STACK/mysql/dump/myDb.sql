-- -------------------------------------------------------------
-- TablePlus 5.1.0(468)
--
-- https://tableplus.com/
--
-- Database: hotel
-- Generation Time: 2022-11-17 22:22:18.9950
-- -------------------------------------------------------------
CREATE DATABASE hotel;
USE hotel;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
                        `id` bigint NOT NULL AUTO_INCREMENT,
                        `room_type` bigint NOT NULL,
                        `occupied` tinyint(1) NOT NULL,
                        PRIMARY KEY (`id`),
                        KEY `room_type` (`room_type`),
                        CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

INSERT INTO `room` (`id`, `room_type`, `occupied`) VALUES
                                                       (1, 1, 0),
                                                       (2, 1, 0);

INSERT INTO `room_type` (`id`, `price`, `pic_dir`, `capacity`) VALUES
    (1, 400, 1, 2);

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `position`, `responsible_floor`, `is_clean`) VALUES
    (1, 'Richard', 'DING', 'FD', 1, 1);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

