-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 08:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lovecash`
--

-- --------------------------------------------------------

--
-- Structure for view `vw_dashboard`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dashboard`  AS SELECT concat(`accounts`.`first_name`,' ',`accounts`.`last_name`) AS `fullname`, `accounts`.`email` AS `email`, `card`.`card_num` AS `card_num`, `card`.`pin` AS `pin`, `card`.`balance` AS `balance`, `card`.`monthly_limit` AS `monthly_limit`, `card`.`daily_limit` AS `daily_limit`, `card`.`expiry_date` AS `expiry_date` FROM (`card` join `accounts` on(`card`.`acc_id` = `accounts`.`acc_id`)) ;

--
-- VIEW `vw_dashboard`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
