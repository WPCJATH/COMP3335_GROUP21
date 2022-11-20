CREATE DATABASE `hotel`;
USE `hotel`;

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