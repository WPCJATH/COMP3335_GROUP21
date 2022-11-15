SET time_zone = "+08:00";


CREATE TABLE `Person` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` int
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `Person` (`id`, `name`,`age`) VALUES
(1, 'William',30),
(2, 'Marc',17),
(3, 'John',55);
