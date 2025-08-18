-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 06:45 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addBalance` (IN `cardEmail` VARCHAR(500), `amount` DECIMAL(10,2))   BEGIN 
	START TRANSACTION;
UPDATE card
    SET card.balance = card.balance + amount
    WHERE card.card_num = (SELECT vw_dashboard.card_num from vw_dashboard where vw_dashboard.email = cardEmail);
    IF ROW_COUNT() > 0 THEN
        COMMIT;
    ELSE
        ROLLBACK;
    END IF;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addTransaction` (IN `emailad` VARCHAR(225), IN `cardiD` VARCHAR(225), IN `transName` VARCHAR(225), IN `transType` VARCHAR(225), IN `amountin` DECIMAL(10,2), IN `datein` DATETIME, IN `statusin` VARCHAR(225))   BEGIN
	DECLARE cardNum VARCHAR(100);
    DECLARE accIds INT;
    
    SELECT acc_id INTO accIds 
    FROM accounts 
    WHERE email = emailad
    LIMIT 1;
    SELECT card.card_id INTO cardNum FROM card WHERE card.card_num = cardiD LIMIT 1;
    
    INSERT INTO `transactions`(`acc_id`, `card_id`, `transaction_name`, `trans_type`, `amount`, `date`, `Status`) VALUES (accIds,cardNum,transName,transType,amountin,datein,statusin);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deductBalance` (IN `cardEmail` VARCHAR(500), `amount` DECIMAL(10,2))   BEGIN 
	START TRANSACTION;
UPDATE card
    SET card.balance = card.balance - amount
    WHERE card.card_num = (SELECT vw_dashboard.card_num from vw_dashboard where vw_dashboard.email = cardEmail) AND balance >= amount;
    IF ROW_COUNT() > 0 THEN
        COMMIT;
    ELSE
        ROLLBACK;
    END IF;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `feedBack` (`emailaddress` VARCHAR(100), `feedbackText` LONGTEXT)   BEGIN
	DECLARE accId int;
    SELECT accounts.acc_id INTO accId FROM accounts WHERE accounts.email = emailaddress;
    
	INSERT INTO `feedback`(`acc_id`, `feedback`) VALUES (accId,feedbackText);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertCard` (IN `accId` INT, IN `cardNum` INT, IN `pinz` INT, IN `balancez` DECIMAL(10,2), IN `monthlyLimit` DECIMAL(10,2), IN `dailyLimit` DECIMAL(10,2), IN `expiryDate` DATE)   BEGIN
	INSERT INTO `card`(`acc_id`, `card_num`, `pin`, `balance`, `monthly_limit`, `daily_limit`, `expiry_date`) 
    VALUES (accId, cardNum, pinz, balancez, monthlyLimit, dailyLimit, expiryDate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Payment` (IN `emailad` VARCHAR(255), IN `cardNum` VARCHAR(225), IN `amounts` DECIMAL(10,2), IN `name` VARCHAR(100), IN `type` VARCHAR(100))   BEGIN
	DECLARE userCount int;
    DECLARE transferTo VARCHAR(100);
    DECLARE cardId VARCHAR(100);
    
    SELECT DISTINCT vw_dashboard.email INTO transferTo FROM vw_dashboard WHERE vw_dashboard.card_num = cardNum LIMIT 1;
    SELECT DISTINCT vw_dashboard.card_num INTO cardId FROM vw_dashboard WHERE vw_dashboard.email = emailad LIMIT 1;
    SELECT COUNT(*) INTO userCount FROM card WHERE card.card_num = cardNum;
    
    
    IF userCount > 0 AND transferTo IS NOT NULL AND cardId IS NOT NULL THEN
    	CALL addBalance(emailad, amounts);
        CALL deductBalance(transferTo, amounts);
        CALL addTransaction(emailad,cardId,name,type,amounts,CURRENT_TIMESTAMP,CONCAT("Sent to " , cardNum));
        CALL addTransaction(transferTo,cardNum,"Recieved Money","Payment",amounts,CURRENT_TIMESTAMP,CONCAT("Recieved from ",cardId));
    ELSE
    	CALL addBalance(emailad,(amounts + taxCalc(cardId )));
        CALL addTransaction(emailad,cardId,name,type,(amounts + taxCalc(cardId )),CURRENT_TIMESTAMP,CONCAT("Sent to " , cardNum));
    END IF; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProfileInfo` (IN `emailAdd` VARCHAR(255), IN `firstname` VARCHAR(50), IN `lastname` VARCHAR(50), IN `emailz` VARCHAR(225), IN `phonenum` INT, IN `countryz` VARCHAR(50), IN `cityz` VARCHAR(225), IN `provincez` VARCHAR(225), IN `postalcodez` INT)   BEGIN
    DECLARE accountId INT;

    SELECT acc_id INTO accountId FROM accounts WHERE email = emailAdd;

    IF accountId IS NOT NULL THEN
        UPDATE accounts SET 
            first_name = firstname,
            last_name = lastname,
            email = emailz,
            phone_num = phonenum
        WHERE acc_id = accountId;

        UPDATE address SET 
            country = countryz,
            province = provincez,
            city = cityz,
            postalcode = postalcodez
        WHERE acc_id = accountId;
    ELSE

        INSERT INTO accounts (first_name, last_name, email, phone_num)
        VALUES (firstname, lastname, emailz, phonenum);

        SELECT acc_id INTO accountId FROM accounts WHERE email = emailz;

        INSERT INTO address (acc_id, country, province, city, postalcode)
        VALUES (accountId, countryz, provincez, cityz, postalcodez);
    END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `presently` (`emailAddress` VARCHAR(255)) RETURNS DECIMAL(10,2)  BEGIN 
	DECLARE daily_limit DECIMAL (10, 2);
    DECLARE balance DECIMAL (10, 2);
    DECLARE result DECIMAL (10, 2);
    
    SELECT vw_dashboard.daily_limit
    INTO daily_limit
    FROM vw_dashboard WHERE vw_dashboard.email = emailAddress
    LIMIT 1;
    SELECT vw_dashboard.balance
    INTO balance
    FROM vw_dashboard WHERE vw_dashboard.email = emailAddress
    LIMIT 1;
    
    SET result = daily_limit - balance;
    RETURN result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `remaining` (`emailAddress` VARCHAR(255)) RETURNS DECIMAL(10,2)  BEGIN 
	DECLARE daily_limit DECIMAL (10, 2);
    DECLARE presently DECIMAL (10, 2);
    DECLARE result DECIMAL (10, 2);
    
    SELECT vw_dashboard.daily_limit
    INTO daily_limit
    FROM vw_dashboard WHERE vw_dashboard.email = emailAddress
    LIMIT 1;
    SELECT presently(emailAddress) 
    INTO presently
    LIMIT 1;
    
    SET result = daily_limit - presently;
    RETURN result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `taxCalc` (`cardNumber` VARCHAR(100)) RETURNS DECIMAL(10,2)  BEGIN
    DECLARE total DECIMAL(10,2);
    SELECT (card.balance * 0.005) AS total INTO total from card WHERE card.card_num = cardNumber;
    RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_num` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `first_name`, `last_name`, `email`, `password`, `phone_num`) VALUES
(1, 'Hakeem', 'Emuy', 'hakeememuy@gmail.com', '$2b$10$izukOLrXJDjGIhLC6mWTs.61MLacl9nf7iDtYvM9Yqo7Xo0kVhNQm', '10101010'),
(2, 'Menro', 'Kenshi', 'menrosanji@gmail.com', '$2b$10$ctqU6f5GsKIuKi8lVTioWu0OnzHRhFgGUyx3lRx6xMe2zUtx0rtIu', NULL),
(9, 'Princess', 'Peach', 'princesspeach@gmail.com', '$2b$10$CjdLRQ9YkMJsNDxvPz9iKeG1rqtkYCdOkFE085ztArnScwosq9xV2', NULL),
(10, 'Erica', 'Sajol', 'ericasajol888@email.com', '$2b$10$GFhRaoIrrGt9q.gHhvu0iuKIyxgYD6l1qk8.xWzXB1Q0.hd7TDPxC', NULL),
(19, 'Neri', 'San', 'nerisan@email.com', '$2b$10$oc9acEXMg5jTBYLXVAGCN.R594jhYp8Dj5i43Luw/sHZ0Hofr/Fae', NULL),
(20, 'Test', 'Tester', 'TestingTester@gmail.com', 'Test', NULL);

--
-- Triggers `accounts`
--
DELIMITER $$
CREATE TRIGGER `autoAdress` AFTER INSERT ON `accounts` FOR EACH ROW INSERT INTO `address`(`acc_id`, `country`, `province`, `city`, `postalcode`) VALUES (NEW.acc_id,NULL,NULL,NULL,NULL)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `autoCard` AFTER INSERT ON `accounts` FOR EACH ROW BEGIN
	CALL insertCard( NEW.acc_id, CONCAT(LPAD(FLOOR(RAND() * 1000000000), 15, '0')), CONCAT(FLOOR(1000 + RAND() * 9999)), 0, 60000, 15000, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL FLOOR(RAND() * 2192) DAY));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `postalcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `acc_id`, `country`, `province`, `city`, `postalcode`) VALUES
(1, 19, 'Phillipines', 'Cavite', 'Trece Martires City', 4109),
(3, 1, 'Philippines', 'Cavite', 'Poop', 12345),
(4, 20, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `card_num` varchar(255) DEFAULT NULL,
  `pin` int(11) NOT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `monthly_limit` decimal(10,2) DEFAULT NULL,
  `daily_limit` decimal(10,2) DEFAULT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `acc_id`, `card_num`, `pin`, `balance`, `monthly_limit`, `daily_limit`, `expiry_date`) VALUES
(1, 1, '123 4567 890', 1234, 5075.34, 60000.00, 15000.00, '2030-05-15'),
(2, 2, '1234567789', 132, 0.00, NULL, NULL, '2030-05-31'),
(12, 19, '817566999', 1006, 6600.00, 60000.00, 15000.00, '2028-09-27'),
(13, 20, '308823043', 6812, 0.00, 60000.00, 15000.00, '2031-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `feedback` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `acc_id`, `feedback`) VALUES
(1, 1, 'This is very cool and informative testing procedure'),
(6, 1, 'Step 1'),
(7, 1, 'Pooper');

-- --------------------------------------------------------

--
-- Stand-in structure for view `personalinfo`
-- (See below for the actual view)
--
CREATE TABLE `personalinfo` (
`first_name` varchar(100)
,`last_name` varchar(100)
,`email` varchar(225)
,`phone_num` varchar(255)
,`country` varchar(100)
,`city` varchar(225)
,`province` varchar(100)
,`postalcode` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `transaction_name` varchar(225) NOT NULL,
  `trans_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `acc_id`, `card_id`, `transaction_name`, `trans_type`, `amount`, `date`, `Status`) VALUES
(1, 10, 1, 'Poop', 'Testing', 200.00, '2025-06-12 01:39:00', 'Sent to 12'),
(2, 10, 1, 'Poop', 'Testing', 200.00, '2025-06-12 01:40:41', 'Sent to 12'),
(3, 10, 1, 'Poop', 'Testing', 200.00, '2025-06-12 01:42:52', 'Sent to 123 4567 890'),
(4, 10, 1, 'Poop', 'Testing', 200.00, '2025-06-12 01:45:20', 'Sent to 123 4567 890'),
(5, 1, 1, 'Poop', 'Testing', 200.00, '2025-06-12 01:45:54', 'Sent to 123 4567 890'),
(6, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:46:27', 'Sent to 817566999'),
(7, 19, 12, 'Recieved Money', 'Payment', 100.00, '2025-06-12 01:46:27', 'Recieved from 123 4567 890'),
(8, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:47:48', 'Sent to 817566999'),
(9, 19, 12, 'Recieved Money', 'Payment', 100.00, '2025-06-12 01:47:48', 'Recieved from 123 4567 890'),
(10, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:48:20', 'Sent to 8175669991'),
(11, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:51:25', 'Sent to 8175669991'),
(12, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:51:49', 'Sent to 817566999'),
(13, 19, 12, 'Recieved Money', 'Payment', 100.00, '2025-06-12 01:51:49', 'Recieved from 123 4567 890'),
(14, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:52:15', 'Sent to 817566999'),
(15, 19, 12, 'Recieved Money', 'Payment', 100.00, '2025-06-12 01:52:15', 'Recieved from 123 4567 890'),
(16, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:55:22', 'Sent to 817566999'),
(17, 19, 12, 'Recieved Money', 'Payment', 100.00, '2025-06-12 01:55:22', 'Recieved from 123 4567 890'),
(18, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:56:15', 'Sent to 81756699911'),
(19, 1, 1, 'Testing transaction', 'Type kita', 100.00, '2025-06-12 01:56:25', 'Sent to 81756699911'),
(20, 1, 1, 'Website Payment', 'Pay Bills', 100.00, '2025-06-12 08:40:34', 'Sent to 1234567789'),
(21, 2, 2, 'Recieved Money', 'Payment', 100.00, '2025-06-12 08:40:34', 'Recieved from 123 4567 890'),
(22, 1, 1, 'Voidlings', 'Pay Bills', 209.65, '2025-06-12 08:45:49', 'Sent to 12345677543'),
(23, 1, 1, 'Testing', 'Pay Bills', 110.19, '2025-06-12 08:55:40', 'Sent to 12345'),
(24, 1, 1, 'Transfer Money', 'Transfer Money', 32.49, '2025-06-12 09:02:58', 'Sent to 123456789011'),
(25, 1, 1, 'Transfer Money', 'Transfer Money', 32.65, '2025-06-12 09:03:00', 'Sent to 123456789011'),
(26, 1, 1, 'Transfer Money', 'Transfer Money', 32.81, '2025-06-12 09:03:00', 'Sent to 123456789011'),
(27, 1, 1, 'Transfer Money', 'Transfer Money', 32.98, '2025-06-12 09:03:32', 'Sent to 123456789011'),
(28, 1, 1, 'Transfer Money', 'Transfer Money', 33.14, '2025-06-12 09:03:32', 'Sent to 123456789011'),
(29, 1, 1, 'Transfer Money', 'Transfer Money', 33.31, '2025-06-12 09:03:32', 'Sent to 123456789011'),
(30, 1, 1, 'Transfer Money', 'Transfer Money', 33.47, '2025-06-12 09:03:52', 'Sent to 123456789011'),
(31, 1, 1, 'Testing', 'Transfer Money', 102.85, '2025-06-12 09:04:58', 'Sent to 11'),
(32, 1, 1, 'Poopers', 'Transfer Money', 12.92, '2025-06-12 09:11:20', 'Sent to 12'),
(33, 1, 1, 'Negative', 'Transfer Money', 0.92, '2025-06-12 09:11:50', 'Sent to 111'),
(34, 1, 1, 'negative', 'Transfer Money', 23.04, '2025-06-12 09:18:18', 'Sent to 11'),
(35, 1, 1, 'Negative', 'Transfer Money', 124.66, '2025-06-12 09:19:00', 'Sent to 1234'),
(36, 1, 1, 'Erica Bill', 'Pay Bills', 2400.00, '2025-06-12 11:47:26', 'Sent to 817566999'),
(37, 19, 12, 'Recieved Money', 'Payment', 2400.00, '2025-06-12 11:47:26', 'Recieved from 123 4567 890'),
(38, 1, 1, 'Step 2', 'Pay Bills', 35.84, '2025-06-12 12:17:43', 'Sent to 1212131'),
(39, 1, 1, 'Hakeem', 'Transfer Money', 36.02, '2025-06-12 12:19:20', 'Sent to 12341'),
(40, 1, 1, 'Hakeem123', 'Transfer Money', 36.20, '2025-06-12 12:20:19', 'Sent to 1235677'),
(41, 1, 1, 'Lool', 'Pay Bills', 36.38, '2025-06-12 12:20:36', 'Sent to 12345');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_dashboard`
-- (See below for the actual view)
--
CREATE TABLE `vw_dashboard` (
`email` varchar(225)
,`card_num` varchar(255)
,`pin` int(11)
,`balance` decimal(10,2)
,`monthly_limit` decimal(10,2)
,`daily_limit` decimal(10,2)
,`expiry_date` date
);

-- --------------------------------------------------------

--
-- Structure for view `personalinfo`
--
DROP TABLE IF EXISTS `personalinfo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `personalinfo`  AS SELECT `accounts`.`first_name` AS `first_name`, `accounts`.`last_name` AS `last_name`, `accounts`.`email` AS `email`, `accounts`.`phone_num` AS `phone_num`, `address`.`country` AS `country`, `address`.`city` AS `city`, `address`.`province` AS `province`, `address`.`postalcode` AS `postalcode` FROM (`accounts` join `address` on(`accounts`.`acc_id` = `address`.`acc_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_dashboard`
--
DROP TABLE IF EXISTS `vw_dashboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dashboard`  AS SELECT `accounts`.`email` AS `email`, `card`.`card_num` AS `card_num`, `card`.`pin` AS `pin`, `card`.`balance` AS `balance`, `card`.`monthly_limit` AS `monthly_limit`, `card`.`daily_limit` AS `daily_limit`, `card`.`expiry_date` AS `expiry_date` FROM (`card` join `accounts` on(`card`.`acc_id` = `accounts`.`acc_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_num` (`phone_num`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_acc` (`acc_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `card_num` (`card_num`),
  ADD KEY `account` (`acc_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback` (`acc_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `cards` (`card_id`),
  ADD KEY `acountz` (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_acc` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `account` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `acountz` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cards` FOREIGN KEY (`card_id`) REFERENCES `card` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
