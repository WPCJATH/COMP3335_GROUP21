SET time_zone = "+08:00";


CREATE TABLE `ROOM_TYPE` (
                             `TYPE` VARCHAR(20) NOT NULL,
                             `PRICE` FLOAT NOT NULL,
                             PRIMARY KEY (`TYPE`)
);

CREATE TABLE `ROOM` (
                        `ROOM_NO` VARCHAR(4)  NOT NULL,
                        `ROOM_TYPE` VARCHAR(20) NOT NULL,
                        `OCCUPIED` BOOLEAN NOT NULL,
                        `CAPACITY` INT NOT NULL,
                        PRIMARY KEY (`ROOM_NO`),
                        FOREIGN KEY (`ROOM_TYPE`) REFERENCES `ROOM_TYPE`(`TYPE`)
);

CREATE TABLE `CUSTOMER` (
                            `CUS_ID` VARCHAR(10) NOT NULL,
                            `FIRSTNAME` VARCHAR(30) NOT NULL,
                            `LASTNAME` VARCHAR(30) NOT NULL,
                            `GENDER` ENUM('male', 'female') NOT NULL,
                            `AGE` INT NOT NULL,
                            `ID_NO` VARCHAR(8) NOT NULL,
                            `EMAIL` VARCHAR(20) NOT NULL,
                            `PHONE_NO` VARCHAR(8) NOT NULL,
                            PRIMARY KEY (`CUS_ID`)
);

CREATE TABLE `STAFF` (
                         `STAFF_ID` VARCHAR(10) NOT NULL,
                         `FIRSTNAME` VARCHAR(30) NOT NULL,
                         `LASTNAME` VARCHAR(30) NOT NULL,
                         `POSITION` ENUM('FD', 'MA', 'CL') NOT NULL,
                         `RESPONSIBLE_FLOOR` INT,
                         `IS_CLEAN` BOOLEAN NOT NULL,
                         PRIMARY KEY (`STAFF_ID`)
);

CREATE TABLE `RESERVATION` (
                               `RES_ID` VARCHAR(12) NOT NULL,
                               `CUS_ID` VARCHAR(10) NOT NULL,
                               `ROOM_NUMBER` VARCHAR(4) ,
                               `CHECKIN_DATE` DATETIME NOT NULL,
                               `DURATION` INT NOT NULL,
                               `ROOM_TYPE` VARCHAR(20) NOT NULL,
                               `CANCELLED` BOOLEAN NOT NULL,
                               `AMT` INT NOT NULL,
                               `IS_ORDER` BOOLEAN NOT NULL,
                               `PIC` VARCHAR(10),
                               PRIMARY KEY (`RES_ID`),
                               FOREIGN KEY (`CUS_ID`) REFERENCES `ROOM_TYPE`(`TYPE`),
                               FOREIGN KEY (`CUS_ID`) REFERENCES `CUSTOMER`(`CUS_ID`),
                               FOREIGN KEY (`PIC`) REFERENCES `STAFF`(`STAFF_ID`)
);

CREATE TABLE `TRAVEL_PARTNER` (
                                  `ID` VARCHAR(12) NOT NULL,
                                  `PARTNER_ID` VARCHAR(10) NOT NULL,
                                  PRIMARY KEY (`ID`),
                                  FOREIGN KEY (`ID`) REFERENCES `RESERVATION`(`RES_ID`),
                                  FOREIGN KEY (`PARTNER_ID`) REFERENCES `CUSTOMER`(`CUS_ID`)
);







