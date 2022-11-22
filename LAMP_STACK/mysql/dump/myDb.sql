/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

set global activate_all_roles_on_login = on;

CREATE DATABASE IF NOT EXISTS `hotel`;
USE `hotel`;


DROP TABLE IF EXISTS `CUSTOMER`;
DROP TABLE IF EXISTS `RESERVATION`;
DROP TABLE IF EXISTS `ROOM`;
DROP TABLE IF EXISTS `ROOM_TYPE`;
DROP TABLE IF EXISTS `STAFF`;
DROP TABLE IF EXISTS `TRAVEL_PARTNER`;
DROP TABLE IF EXISTS `TRAVEL_PARTNER_INORDER`;


CREATE TABLE `CUSTOMER` (
                            `CUS_ID` VARCHAR(20) NOT NULL,
                            `NAME` VARCHAR(30) ,
                            `GENDER` ENUM('Male', 'Female') ,
                            `AGE` INT ,
                            `ID_NO` VARCHAR(18) ,
                            `EMAIL` VARCHAR(50) NOT NULL,
                            `PHONE_NO` VARCHAR(15) ,
                            PRIMARY KEY (`CUS_ID`)
);

CREATE TABLE `ROOM_TYPE` (
                             `TYPE` VARCHAR(20) NOT NULL,
                             `PRICE` FLOAT NOT NULL,
                             `IMAGE_DIR` VARCHAR(50) NOT NULL,
                             `CAPACITY` INT NOT NULL,
                             PRIMARY KEY (`TYPE`)
);

CREATE TABLE `ROOM` (
                        `ROOM_NO` VARCHAR(4)  NOT NULL,
                        `ROOM_TYPE` VARCHAR(20) NOT NULL,
                        `OCCUPIED` BOOLEAN NOT NULL,
                        `IS_CLEAN` BOOLEAN NOT NULL,
                        PRIMARY KEY (`ROOM_NO`),
                        FOREIGN KEY (`ROOM_TYPE`) REFERENCES `ROOM_TYPE`(`TYPE`)
);

CREATE TABLE `STAFF` (
                         `STAFF_ID` VARCHAR(20) NOT NULL,
                         `POSITION` ENUM('FD', 'MA', 'CL') NOT NULL,
                         `RESPONSIBLE_FLOOR` INT,
                         PRIMARY KEY (`STAFF_ID`)
);

CREATE TABLE `RESERVATION` (
                               `RES_ID` VARCHAR(20) NOT NULL,
                               `CUS_ID` VARCHAR(20) NOT NULL,
                               `ROOM_NUMBER` VARCHAR(4) ,
                               `CHECKIN_DATE` DATETIME NOT NULL,
                               `DURATION` INT NOT NULL,
                               `ROOM_TYPE` VARCHAR(20) NOT NULL,
                               `CANCELLED` BOOLEAN NOT NULL,
                               `AMT` INT NOT NULL,
                               `IS_ORDER` BOOLEAN NOT NULL,
                               `RESPONSE` VARCHAR(10),
                               PRIMARY KEY (`RES_ID`),
                               FOREIGN KEY (`ROOM_TYPE`) REFERENCES `ROOM_TYPE`(`TYPE`),
                               FOREIGN KEY (`RESPONSE`) REFERENCES `STAFF`(`STAFF_ID`),
                               FOREIGN KEY (`CUS_ID`) REFERENCES `CUSTOMER`(`CUS_ID`)
);

CREATE TABLE `TRAVEL_PARTNER` (
                                  `PARTNER_ID` VARCHAR(20) NOT NULL,
                                  `HOLDER` VARCHAR(20) NOT NULL,
                                  FOREIGN KEY (`PARTNER_ID`) REFERENCES `CUSTOMER`(`CUS_ID`),
                                  FOREIGN KEY (`HOLDER`) REFERENCES `CUSTOMER`(`CUS_ID`)
);

CREATE TABLE `TRAVEL_PARTNER_INORDER` (
                                          `RES_ID` VARCHAR(20) NOT NULL,
                                          `PARTNER_ID` VARCHAR(20) NOT NULL,
                                          FOREIGN KEY (`RES_ID`) REFERENCES `RESERVATION`(`RES_ID`),
                                          FOREIGN KEY (`PARTNER_ID`) REFERENCES `CUSTOMER`(`CUS_ID`)
);

/*
DROP VIEW IF EXISTS `CLs`;
DROP VIEW IF EXISTS `FDs`;
DROP VIEW IF EXISTS `MAs`;
DROP VIEW IF EXISTS `reservation_column_wise_privileges_cleaners`;
DROP VIEW IF EXISTS `reservation_column_wise_privileges_fds_and_mas`;

CREATE ALGORITHM =
    UNDEFINED DEFINER = `root`@`%`
    SQL SECURITY DEFINER VIEW `CLs`
AS SELECT `STAFF`.`STAFF_ID` AS `STAFF_ID`,
          `STAFF`.`POSITION` AS `POSITION`,
          `STAFF`.`RESPONSIBLE_FLOOR` AS `RESPONSIBLE_FLOOR`
   from `STAFF` where (`STAFF`.`position` = 'CL');


CREATE ALGORITHM=
    UNDEFINED DEFINER=`root`@`%`
    SQL SECURITY DEFINER VIEW `FDs`
AS SELECT `STAFF`.`STAFF_ID` AS `STAFF_ID`,
          `STAFF`.`POSITION` AS `POSITION`,
          `STAFF`.`RESPONSIBLE_FLOOR` AS `RESPONSIBLE_FLOOR`
   FROM `STAFF` WHERE (`STAFF`.`position` = 'FD');


CREATE ALGORITHM=
    UNDEFINED DEFINER=`root`@`%`
    SQL SECURITY DEFINER VIEW `MAs`
AS SELECT `STAFF`.`STAFF_ID` AS `STAFF_ID`,
          `STAFF`.`POSITION` AS `POSITION`,
          `STAFF`.`RESPONSIBLE_FLOOR` AS `RESPONSIBLE_FLOOR`
   FROM `STAFF` WHERE (`STAFF`.`position` = 'MA');


CREATE ALGORITHM=
    UNDEFINED DEFINER=`root`@`%`
    SQL SECURITY DEFINER VIEW `reservation_column_wise_privileges_cleaners`
AS select `CUSTOMER`.`CUS_ID` AS `CUS_ID`,
          `CUSTOMER`.`GENDER` AS `GENDER`,
          `RESERVATION`.`ROOM_NUMBER` AS `ROOM_NUMBER`,
          `RESERVATION`.`ROOM_TYPE` AS `ROOM_TYPE`,
          `RESERVATION`.`CHECKIN_DATE` AS `CHECKIN_DATE`,
          `RESERVATION`.`DURATION` AS `DURATION`,
          `RESERVATION`.`CANCELLED` AS `CANCELLED`,
          `RESERVATION`.`IS_ORDER` AS `IS_ORDER`,
          `STAFF`.`STAFF_ID` AS `STAFF_ID`
   FROM ((`reservation`
       JOIN `CUSTOMER` ON ((`CUSTOMER`.`CUS_ID` = `RESERVATION`.`CUS_ID`)))
       JOIN `STAFF` ON ((`STAFF`.`STAFF_ID` = `reservation`.`RESPONSE`)));


CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%`
    SQL SECURITY DEFINER VIEW `reservation_column_wise_privileges_fds_and_mas`
AS select `CUSTOMER`.`CUS_ID` AS `customer_first_name`,
          `CUSTOMER`.`GENDER` AS `gender`,
          `CUSTOMER`.`AGE` AS `AGE`,
          `CUSTOMER`.`ID_NO` AS `ID_NO`,
          `CUSTOMER`.`EMAIL` AS `EMAIL`,
          `CUSTOMER`.`PHONE_NO` AS `PHONE_NO`,
          `RESERVATION`.`ROOM_NUMBER` AS `ROOM_NUMBER`,
          `RESERVATION`.`ROOM_TYPE` AS `ROOM_TYPE`,
          `RESERVATION`.`CHECKIN_DATE` AS `CHECKIN_DATE`,
          `RESERVATION`.`DURATION` AS `DURATION`,
          `RESERVATION`.`CANCELLED` AS `CANCELLED`,
          `RESERVATION`.`IS_ORDER` AS `IS_ORDER`,
          `STAFF`.`STAFF_ID` AS `STAFF_ID`
   from ((`RESERVATION`
       join `CUSTOMER` on ((`CUSTOMER`.`CUS_ID` = `RESERVATION`.`CUS_ID`)))
       join `STAFF` on((`STAFF`.`STAFF_ID` = `RESERVATION`.`RESPONSE`)));

*/

CREATE ROLE IF NOT EXISTS 'FRONT_DESK'@'172.19.0.10';
CREATE ROLE IF NOT EXISTS 'MANAGER'@'%';
CREATE ROLE IF NOT EXISTS 'CLEANER'@'172.19.0.10';
CREATE ROLE IF NOT EXISTS 'CUSTOMER'@'%';
CREATE USER IF NOT EXISTS 'computer'@'172.19.0.10' IDENTIFIED BY '12345678';

/*
-- connection required --
GRANT CREATE SESSION TO 'FRONT_DESK';
GRANT CREATE SESSION TO 'MANAGER';
GRANT CREATE SESSION TO 'CLEANER';
GRANT CREATE SESSION TO 'CUSTOMER';
GRANT CREATE SESSION TO 'SERVER';
*/


-- create global level privileges user --
GRANT CREATE USER, RELOAD, SUPER, GRANT OPTION ON *.* TO 'computer'@'172.19.0.10';
GRANT SELECT ON mysql.user TO 'computer'@'172.19.0.10';
GRANT CREATE USER, RELOAD, SUPER, GRANT OPTION ON *.* TO 'MANAGER'@'%' WITH GRANT option;
GRANT SELECT ON mysql.user TO 'MANAGER'@'%' WITH GRANT option;

-- reload --
GRANT RELOAD ON *.* TO 'computer'@'172.19.0.10';
GRANT RELOAD ON *.* TO 'MANAGER'@'%' WITH GRANT option;


-- room type --
GRANT SELECT ON hotel.ROOM_TYPE TO 'FRONT_DESK'@'172.19.0.10';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.ROOM_TYPE TO 'MANAGER'@'%' WITH GRANT OPTION;
GRANT SELECT ON hotel.ROOM_TYPE TO 'CLEANER'@'172.19.0.10';
GRANT SELECT ON hotel.ROOM_TYPE TO 'CUSTOMER'@'%';
GRANT SELECT ON hotel.ROOM_TYPE TO 'computer'@'172.19.0.10' WITH GRANT OPTION;

-- staff --
/*
GRANT SELECT ON FDs TO 'FRONT_DESK'@'172.19.0.10';
*/
GRANT SELECT ON hotel.STAFF TO 'FRONT_DESK'@'172.19.0.10';
GRANT SELECT ON hotel.STAFF TO 'CLEANER'@'172.19.0.10';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.STAFF TO 'MANAGER'@'%' WITH GRANT OPTION;

-- room --
GRANT SELECT ON hotel.ROOM TO 'FRONT_DESK'@'172.19.0.10';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.ROOM TO 'MANAGER'@'%' WITH GRANT OPTION;
GRANT SELECT ON hotel.ROOM TO 'CLEANER'@'172.19.0.10';
GRANT SELECT ON hotel.ROOM TO 'CUSTOMER'@'%';
GRANT SELECT ON hotel.ROOM TO 'computer'@'172.19.0.10' WITH GRANT OPTION;

-- customer --
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.CUSTOMER TO 'computer'@'172.19.0.10' WITH GRANT OPTION ;
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.CUSTOMER TO 'CUSTOMER'@'%';

-- travel_partner --
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.TRAVEL_PARTNER TO 'computer'@'172.19.0.10' WITH GRANT OPTION ;
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.TRAVEL_PARTNER TO 'CUSTOMER'@'%';

-- travel_partner_inorder --
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.TRAVEL_PARTNER_INORDER TO 'computer'@'172.19.0.10' WITH GRANT OPTION ;
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.TRAVEL_PARTNER_INORDER TO 'CUSTOMER'@'%';


-- reservation --
/*
GRANT SELECT, UPDATE ON hotel.reservation_column_wise_privileges_fds_and_mas TO 'FRONT_DESK'@'172.19.0.10';
GRANT SELECT, UPDATE, INSERT ON hotel.reservation_column_wise_privileges_fds_and_mas TO 'MANAGER'@'%' WITH GRANT OPTION;
GRANT SELECT ON hotel.reservation_column_wise_privileges_cleaners TO 'CLEANER'@'172.19.0.10';
GRANT SELECT, UPDATE, INSERT ON hotel.reservation_column_wise_privileges_fds_and_mas TO 'CUSTOMER'@'%';
*/

GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.RESERVATION TO 'computer'@'172.19.0.10' WITH GRANT OPTION ;
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.RESERVATION TO 'CUSTOMER'@'%';
GRANT SELECT ON hotel.RESERVATION TO 'FRONT_DESK'@'172.19.0.10';
GRANT SELECT, UPDATE, INSERT, DELETE ON hotel.RESERVATION TO 'MANAGER'@'%' WITH GRANT OPTION;


GRANT 'FRONT_DESK'@'172.19.0.10'  TO 'MANAGER'@'%';
GRANT 'CLEANER'@'172.19.0.10'  TO 'MANAGER'@'%';
GRANT 'CUSTOMER'@'%' TO 'computer'@'172.19.0.10';
SET DEFAULT ROLE ALL TO 'computer'@'172.19.0.10';

-- Insert Values --

-- Insert Some User --

CREATE USER IF NOT EXISTS 'Alice'@'%' IDENTIFIED BY '12345678';
CREATE USER IF NOT EXISTS 'Bob'@'172.19.0.10' IDENTIFIED BY '12345678';
CREATE USER IF NOT EXISTS 'Chris'@'172.19.0.10' IDENTIFIED BY '12345678';
CREATE USER IF NOT EXISTS 'David'@'%' IDENTIFIED BY '12345678';
CREATE USER IF NOT EXISTS 'Ewing'@'%' IDENTIFIED BY '12345678';
CREATE USER IF NOT EXISTS 'Frank'@'%' IDENTIFIED BY '12345678';

-- Grant Roles --
GRANT 'MANAGER'@'%' TO 'Alice'@'%';
GRANT 'FRONT_DESK'@'172.19.0.10' TO 'Alice'@'%';
GRANT 'CLEANER'@'172.19.0.10' TO 'Alice'@'%';
SET DEFAULT ROLE ALL TO 'Alice'@'%';
-- GRANT Create User, Grant Option, Reload ON *.* TO `Alice`@`%`;
GRANT 'FRONT_DESK'@'172.19.0.10' TO 'Bob'@'172.19.0.10';
-- SET DEFAULT ROLE 'FRONT_DESK'@'172.19.0.10' ALL TO 'Bob'@'172.19.0.10';
GRANT 'CLEANER'@'172.19.0.10' TO 'Chris'@'172.19.0.10';
-- SET DEFAULT ROLE 'CLEANER'@'172.19.0.10' ALL TO 'Chris'@'172.19.0.10';
GRANT 'CUSTOMER'@'%' TO 'David'@'%';
GRANT 'CUSTOMER'@'%' TO 'Ewing'@'%';
GRANT 'CUSTOMER'@'%' TO 'Frank'@'%';
-- GRANT ALL ON hotel.* to 'Alice'@'%';
-- GRANT ALL ON hotel.* to 'computer'@'172.19.0.10';

Flush PRIVILEGES;

-- Creating corresponding profiles --
INSERT INTO  `CUSTOMER`
(`CUS_ID`, `NAME`, `AGE`, `GENDER`, `ID_NO`, `EMAIL`, `PHONE_NO`)
VALUES
    ('David','David, Someone', NULL, NULL,NULL,'123@123.com',NULL);

INSERT INTO  `CUSTOMER`
(`CUS_ID`, `NAME`, `AGE`, `GENDER`, `ID_NO`, `EMAIL`, `PHONE_NO`)
VALUES
    ('Ewing','Ewing, Someone',NULL, NULL,NULL,'123123@123.com',NULL);

INSERT INTO  `CUSTOMER`
(`CUS_ID`, `NAME`, `AGE`, `GENDER`, `ID_NO`, `EMAIL`, `PHONE_NO`)
VALUES
    ('Frank','Frank, Someone',NULL, NULL,NULL,'123@123123.com',NULL);

INSERT INTO `STAFF`
(`STAFF_ID`, `POSITION`, `RESPONSIBLE_FLOOR`)
VALUES
    ('Alice','MA', -1);

INSERT INTO `STAFF`
(`STAFF_ID`, `POSITION`, `RESPONSIBLE_FLOOR`)
VALUES
    ('Bob','FD', -1);

INSERT INTO `STAFF`
(`STAFF_ID`, `POSITION`, `RESPONSIBLE_FLOOR`)
VALUES
    ('Chris','CL', 3);



INSERT INTO `ROOM_TYPE`
(`TYPE` ,`PRICE`, `IMAGE_DIR`, `CAPACITY`)
VALUES
    ('Presidential Suite', 3000, 'room_type1.jpg', 4);

INSERT INTO `ROOM_TYPE`
(`TYPE` ,`PRICE`, `IMAGE_DIR`, `CAPACITY`)
VALUES
    ('Royal Suite', 2000, 'room_type2.jpg', 3);

INSERT INTO `ROOM_TYPE`
(`TYPE` ,`PRICE`, `IMAGE_DIR`, `CAPACITY`)
VALUES
    ('Deluxe Suite', 1000, 'room_type3.jpg', 2);




INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('100', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('101', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('102', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('103', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('104', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('105', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('106', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('107', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('108', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('109', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('200', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('201', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('202', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('203', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('204', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('205', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('206', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('207', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('208', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('209', 'Presidential Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('300', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('301', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('302', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('303', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('304', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('305', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('306', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('307', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('308', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('309', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('400', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('401', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('402', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('403', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('404', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('405', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('406', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('407', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('408', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('409', 'Royal Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('500', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('501', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('502', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('503', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('504', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('505', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('506', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('507', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('508', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('509', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('600', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('601', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('602', 'Deluxe Suite', 0, 1);

INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('603', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('604', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('605', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('606', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('607', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('608', 'Deluxe Suite', 0, 1);


INSERT INTO `ROOM`
(`ROOM_NO`, `ROOM_TYPE`, `OCCUPIED`, `IS_CLEAN`)
VALUES
    ('609', 'Deluxe Suite', 0, 1);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;