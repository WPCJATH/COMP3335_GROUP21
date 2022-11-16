CREATE TABLE `Person` (
                          `id` int NOT NULL,
                          `name` varchar(20) NOT NULL,
                          `age` int
);


INSERT INTO `Person` (`id`, `name`,`age`) VALUES
                                              (1, 'William',30),
                                              (2, 'Marc',17),
                                              (3, 'John',55);

ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'test';
FLUSH PRIVILEGES;






