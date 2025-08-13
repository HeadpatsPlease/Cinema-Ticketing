-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2025 at 04:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_cinema_ticketing_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `setBeverage` (IN `reference` VARCHAR(100), IN `beverage_id` INT, IN `quantity` INT)   BEGIN
    INSERT INTO `ticketbeverage`(`ticket_id`, `beverage_id`, `quantity`) VALUES (getTicket(reference),beverage_id,quantity);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setSeats` (IN `reference` VARCHAR(50), IN `seat` VARCHAR(50))   BEGIN
INSERT INTO `ticketseats`(`ticket_id`, `seat_id`) VALUES (getTicket(reference),getSeat(seat));
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getCinema` (`cinema_p` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE cinema_id INT;
    SELECT id INTO cinema_id FROM cinema_ticketing_db.cinemas WHERE cinema = cinema_p LIMIT 1;
    RETURN cinema_id;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getMovie` (`movieName` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE movie_id INT;
    SELECT movies.id INTO movie_id
    FROM cinema_ticketing_db.movies
    WHERE movie_name = movieName
    LIMIT 1;
    RETURN movie_id;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getQuality` (`quality` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE qual_id INT;
   	SELECT `id` INTO qual_id FROM cinema_ticketing_db.availability WHERE available_quality = quality
   	LIMIT 1;
    RETURN qual_id;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getSeat` (`seat` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE seat_id INT;
    SELECT id INTO seat_id FROM seats WHERE seat_num = seat
    LIMIT 1;
    RETURN seat_id;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getTicket` (`reference` VARCHAR(100)) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE movie_id INT;
    SELECT id INTO movie_id FROM `tickets` WHERE reference_number = reference
    LIMIT 1;
    RETURN movie_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `position`) VALUES
(1, 'staffone', 'Staff123', 'staff'),
(2, 'adminone', 'Admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` int(11) NOT NULL,
  `beverage_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`id`, `beverage_name`) VALUES
(1, 'popcorn-regular'),
(2, 'popcorn-large'),
(3, 'popcorn-bucket'),
(4, 'soda-regular'),
(5, 'soda-large'),
(6, 'hotdog-regular'),
(7, 'Combo1'),
(8, 'Combo2');

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservedseats`
-- (See below for the actual view)
--
CREATE TABLE `reservedseats` (
`movie_name` varchar(225)
,`schedule` datetime
,`seat_num` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `seat_num` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seat_num`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4'),
(5, 'A5'),
(6, 'A6'),
(7, 'A7'),
(8, 'A8'),
(9, 'A9'),
(10, 'B1'),
(11, 'B2'),
(12, 'B3'),
(13, 'B4'),
(14, 'B5'),
(15, 'B6'),
(16, 'B7'),
(17, 'B8'),
(18, 'B9'),
(19, 'C1'),
(20, 'C2'),
(21, 'C3'),
(22, 'C4'),
(23, 'C5'),
(24, 'C6'),
(25, 'C7'),
(26, 'C8'),
(27, 'C9'),
(28, 'D1'),
(29, 'D2'),
(30, 'D3'),
(31, 'D4'),
(32, 'D5'),
(33, 'D6'),
(34, 'D7'),
(35, 'D8'),
(36, 'D9'),
(37, 'E1'),
(38, 'E2'),
(39, 'E3'),
(40, 'E4'),
(41, 'E5'),
(42, 'E6'),
(43, 'E7'),
(44, 'E8'),
(45, 'E9');

-- --------------------------------------------------------

--
-- Table structure for table `ticketbeverage`
--

CREATE TABLE `ticketbeverage` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `beverage_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticketbeverage`
--

INSERT INTO `ticketbeverage` (`id`, `ticket_id`, `beverage_id`, `quantity`) VALUES
(7, 12, 2, 2),
(8, 12, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `quality_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `totalCost` int(11) NOT NULL,
  `schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `movie_id`, `quality_id`, `cinema_id`, `reference_number`, `totalCost`, `schedule`) VALUES
(12, 2, 3, 3, '259-418-447', 1650, '2025-08-15 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ticketseats`
--

CREATE TABLE `ticketseats` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticketseats`
--

INSERT INTO `ticketseats` (`id`, `ticket_id`, `seat_id`) VALUES
(5, 12, 2),
(6, 12, 11),
(7, 12, 10);

-- --------------------------------------------------------

--
-- Structure for view `reservedseats`
--
DROP TABLE IF EXISTS `reservedseats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservedseats`  AS SELECT `cinema_ticketing_db`.`movies`.`movie_name` AS `movie_name`, `tickets`.`schedule` AS `schedule`, `seats`.`seat_num` AS `seat_num` FROM (((`tickets` join `cinema_ticketing_db`.`movies` on(`tickets`.`movie_id` = `cinema_ticketing_db`.`movies`.`id`)) join `ticketseats` on(`tickets`.`id` = `ticketseats`.`ticket_id`)) join `seats` on(`ticketseats`.`seat_id` = `seats`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketbeverage`
--
ALTER TABLE `ticketbeverage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticketcons` (`ticket_id`),
  ADD KEY `beverageid` (`beverage_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie` (`movie_id`),
  ADD KEY `quality` (`quality_id`),
  ADD KEY `cinema` (`cinema_id`);

--
-- Indexes for table `ticketseats`
--
ALTER TABLE `ticketseats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticketid` (`ticket_id`),
  ADD KEY `seatid` (`seat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `ticketbeverage`
--
ALTER TABLE `ticketbeverage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ticketseats`
--
ALTER TABLE `ticketseats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticketbeverage`
--
ALTER TABLE `ticketbeverage`
  ADD CONSTRAINT `beverageid` FOREIGN KEY (`beverage_id`) REFERENCES `beverages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticketcons` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `cinema` FOREIGN KEY (`cinema_id`) REFERENCES `cinema_ticketing_db`.`cinemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie` FOREIGN KEY (`movie_id`) REFERENCES `cinema_ticketing_db`.`movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quality` FOREIGN KEY (`quality_id`) REFERENCES `cinema_ticketing_db`.`availability` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticketseats`
--
ALTER TABLE `ticketseats`
  ADD CONSTRAINT `seatid` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticketid` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
