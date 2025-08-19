-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2025 at 06:45 AM
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
-- Database: `cinema_ticketing_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMovie` (IN `movie_names` VARCHAR(255), IN `movie_descriptions` TEXT, IN `rating_ids` VARCHAR(255), IN `director_ids` VARCHAR(255), IN `status_ids` VARCHAR(255), IN `year_ids` VARCHAR(255), IN `movie_posters` VARCHAR(100))   BEGIN
    INSERT INTO `movies`(`movie_name`, `movie_description`, `rating_id`, `director_id`, `status_id`, `year_id`, `movie_poster`) VALUES (movie_names,movie_descriptions,getRatingId(rating_ids),getDirectorId(director_ids),getStatusId(status_ids),getYearId(year_ids),movie_posters);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMovieGenre` (IN `movie_names` VARCHAR(255), IN `genre_ids` VARCHAR(255))   BEGIN 
    INSERT INTO `moviegenre`(`movie_id`, `genre_id`) VALUES (getMovieId(movie_names),getGenreId(genre_ids));
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMovieLocation` (IN `movie_ids` VARCHAR(255), IN `location_ids` VARCHAR(255))   BEGIN
    INSERT INTO `movielocation`(`movie_id`, `location_id`) VALUES (getMovieId(movie_ids),getLocationId(location_ids));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMovieQuality` (IN `movie_names` VARCHAR(255), IN `availability_ids` VARCHAR(255))   BEGIN 
    INSERT INTO `quality`(`movie_id`, `availability_id`) VALUES (getMovieId(movie_names),getQualityId(availability_ids));
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMovieTime` (IN `movie_ids` VARCHAR(255), IN `time_ids` VARCHAR(255), IN `availability_ids` VARCHAR(255), IN `cinema_ids` VARCHAR(255))   BEGIN
    INSERT INTO `movietime`(`movie_id`, `time_id`, `availability_id`, `cinema_id`) VALUES (getMovieId(movie_ids),getTimeId(time_ids),getQualityId(availability_ids),getCinemaId(cinema_ids));
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getCinemaId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `cinemas` WHERE cinema =  texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getDirectorId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `director` WHERE director = texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getGenreId` (`Genres` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
  DECLARE finds INT;
  SELECT `id` INTO finds FROM `genre` WHERE genre_name = Genres LIMIT 1;
  RETURN finds;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getLocationId` (`texts` VARCHAR(250)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `locations` WHERE location_name = texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getMovieId` (`texts` VARCHAR(250)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `movies` WHERE movie_name= texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getQualityId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `availability` WHERE available_quality = texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getRatingId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `rating` WHERE rating_text = texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getStatusId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `statusmovie` WHERE status = texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getTimeId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `availabletime` WHERE time = texts LIMIT 1;
  	RETURN find;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getYearId` (`texts` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC BEGIN
	DECLARE find INT;
    SELECT `id` INTO find FROM `years` WHERE year = texts LIMIT 1;
  	RETURN find;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `available_quality` varchar(20) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `available_quality`, `price`) VALUES
(1, '2D', 250),
(2, 'Directors Club', 350),
(3, 'IMAX', 450);

-- --------------------------------------------------------

--
-- Table structure for table `availabletime`
--

CREATE TABLE `availabletime` (
  `id` int(11) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availabletime`
--

INSERT INTO `availabletime` (`id`, `time`) VALUES
(1, '9:00 AM'),
(2, '10:00 AM'),
(3, '11:00 AM'),
(4, '12:00 PM'),
(5, '1:00 PM'),
(6, '2:00 PM'),
(7, '3:00 PM'),
(8, '4:00 PM'),
(9, '5:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `cinema` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `cinema`) VALUES
(1, 'Cinema 1'),
(2, 'Cinema 2'),
(3, 'Cinema 3');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `director` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id`, `director`) VALUES
(1, 'John Carlo Buscay'),
(3, 'Lorenzo Lacsojn'),
(4, 'Hakeem Emuy'),
(5, '');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genre_name`) VALUES
(1, 'Horror'),
(2, 'Rom-Com'),
(3, 'Thriller'),
(4, 'Psychological Thriller'),
(5, 'Mystery'),
(6, 'Suspense'),
(7, 'Comedy'),
(8, 'Family'),
(9, 'Slice of Life'),
(10, 'Drama'),
(11, 'Romance'),
(12, 'Fantasy'),
(13, 'Philosopical'),
(14, 'Sci-fi'),
(15, 'Animation'),
(16, 'Adventure'),
(17, 'Musical'),
(18, 'Action'),
(19, 'Pyschological');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`) VALUES
(1, 'dasmarinas'),
(2, 'batangas'),
(3, 'mall of asia');

-- --------------------------------------------------------

--
-- Stand-in structure for view `moviecinema`
-- (See below for the actual view)
--
CREATE TABLE `moviecinema` (
`movie_name` varchar(225)
,`time` varchar(10)
,`available_quality` varchar(20)
,`cinema` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `moviegenre`
--

CREATE TABLE `moviegenre` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moviegenre`
--

INSERT INTO `moviegenre` (`id`, `movie_id`, `genre_id`) VALUES
(25, 10, 12),
(26, 10, 16),
(27, 10, 5),
(28, 10, 15),
(29, 10, 8),
(30, 11, 14),
(31, 11, 18),
(32, 11, 12),
(33, 11, 16),
(34, 11, 11),
(35, 12, 17),
(36, 12, 2),
(37, 12, 10),
(38, 13, 2),
(39, 14, 12),
(40, 14, 7),
(41, 14, 16),
(42, 14, 15),
(43, 15, 3),
(44, 15, 18),
(45, 15, 10),
(46, 15, 6),
(47, 16, 11),
(48, 16, 7),
(49, 16, 17),
(50, 16, 10),
(51, 17, 14),
(52, 17, 12),
(53, 17, 5),
(54, 17, 10),
(55, 17, 16),
(56, 18, 14),
(57, 18, 3),
(58, 18, 11),
(59, 18, 10),
(60, 18, 19),
(178, 2, 10),
(179, 2, 11),
(180, 2, 12),
(181, 3, 10),
(182, 3, 11),
(183, 3, 14),
(184, 4, 1),
(185, 4, 3),
(186, 4, 5),
(187, 4, 6),
(188, 5, 2),
(203, 6, 2),
(204, 6, 10),
(205, 7, 7),
(206, 7, 8),
(207, 7, 9),
(208, 8, 10),
(209, 8, 11),
(210, 8, 13),
(211, 9, 3),
(212, 9, 5),
(213, 9, 10),
(224, 1, 1),
(225, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `movielocation`
--

CREATE TABLE `movielocation` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movielocation`
--

INSERT INTO `movielocation` (`id`, `movie_id`, `location_id`) VALUES
(24, 10, 2),
(25, 10, 3),
(26, 11, 2),
(27, 11, 3),
(28, 12, 1),
(29, 12, 3),
(30, 13, 1),
(31, 13, 3),
(32, 14, 1),
(33, 14, 3),
(34, 15, 1),
(35, 15, 3),
(36, 16, 1),
(37, 16, 3),
(38, 17, 1),
(39, 17, 3),
(40, 18, 1),
(41, 18, 3),
(99, 2, 1),
(100, 2, 2),
(101, 2, 3),
(102, 3, 1),
(103, 3, 2),
(104, 3, 3),
(105, 4, 1),
(106, 4, 2),
(107, 4, 3),
(108, 5, 1),
(109, 5, 2),
(110, 5, 3),
(122, 6, 2),
(123, 6, 3),
(124, 6, 1),
(125, 7, 1),
(126, 7, 2),
(127, 7, 3),
(128, 8, 2),
(129, 8, 3),
(130, 8, 1),
(131, 9, 2),
(132, 9, 3),
(133, 9, 1),
(149, 1, 1),
(150, 1, 2),
(151, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(225) NOT NULL,
  `movie_description` text NOT NULL,
  `rating_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `movie_poster` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `movie_name`, `movie_description`, `rating_id`, `director_id`, `status_id`, `year_id`, `movie_poster`) VALUES
(1, 'Premonition', 'It is a psychological thriller where\r\nterrifying visions of the future drive\r\nsomeone to desperately prevent an\r\nimpending catastrophe before their\r\nnightmares become reality.\r\n', 1, 1, 1, 1, 'premonition.jpg'),
(2, 'Rewrite our stars', 'The story of two souls destined for\r\nheartbreak who refuse to accept their\r\nfate. They embark on a powerful journey\r\nto defy the stars, proving that true love\r\nand unwavering will can forge a new, brighter destiny.\r\n', 5, 1, 1, 2, 'rewrite the stars.jpg'),
(3, 'Never too late', 'A woman finds a glowing path to change\r\nher past mistakes. She soon learns\r\naltering time has devastating and\r\nunforeseen consequences.\r\n', 5, 1, 1, 2, 'never too late.jpg'),
(4, 'Dead end', 'Simon is trapped in a haunting place and\r\nforced to confront a sinister, ancient\r\npresence. As he struggles for freedom,\r\nhe uncovers dark truths and faces an\r\ninescapable fate.\r\n', 2, 1, 1, 1, 'dead end.jpg'),
(5, 'Too cute to handle', 'This rom-com follows two overly cute\r\npeople whose charm leads to awkward\r\nand funny moments as they search for\r\nreal connection and maybe love.', 2, 1, 1, 2, 'too cute to handle.jpg'),
(6, '100 days to fall in love ', 'A cynical architect makes a bet to fall in\r\nlove within 100 days, only to find himself\r\nunexpectedly drawn to a independent\r\nartist. As the deadline looms, he must\r\ndecide if winning the bet is worth truly opening his heart.', 2, 1, 1, 2, '100 days to fall in love.jpg'),
(7, 'Twin slayers', 'Two sassy sisters, often mistaken for\r\ntwins, deal with chaos as their reckless\r\npersonalities cause several times as\r\nmuch trouble and strain their relationship.', 3, 1, 1, 1, 'twin slayers.jpg'),
(8, 'Rational of Love', 'Zander is a mathematician who believes\r\nlove is an algorithm and finds his theories\r\nchallenged when his program matches\r\nhim with a spontaneous artist. Can true\r\nlove ever truly be rational?', 5, 1, 1, 2, 'rational of love.jpg'),
(9, 'The Great Pretender', 'Driven by ambition, a charming outsider\r\ncreate a new identity to infiltrate an\r\nexclusive world. But as their perfect\r\nfacade starts to crumble, the truth\r\nthreatens to destroy everything they’ve gained.', 1, 1, 1, 2, 'the great pretender.jpg'),
(10, 'Dream Gallery', 'A young artist finds a secret gallery where\r\neach painting leads into someone’s\r\ndream. but altering these dreams could\r\nshatter reality. To save both worlds, they\r\nmust master the magic within.\r\n', 4, 1, 2, 1, 'dream gallery.jpg'),
(11, 'When Stars Collide', 'In a future where cosmic powers are tied\r\nto constellations, two rivals must unite to\r\nstop a galactic war, only to discover a\r\nprophecy that makes their bond the key\r\nto saving the galaxy.', 4, 1, 2, 1, 'when the stars collide.jpg'),
(12, 'Bubble Gum', 'A musician draws inspiration from bubble\r\ngum flavors for her album. Until a rival\r\nsteals her sound, sparking a sweet and\r\nchaotic collaboration that reshapes her\r\ncreative journey.\r\n', 2, 1, 2, 1, 'bubble gum.jpg'),
(13, 'Pastry Romance', 'In a small-town bake-off, two rival bakers\r\nclash over their culinary styles, only to\r\nfind a sweet romance rising between\r\nthem, forcing a choice between love and\r\nvictory.\r\n', 2, 1, 2, 1, 'pastry romance.jpg'),
(14, 'Oh! My Kimmy', 'Lonely inventor Mimmy accidentally\r\ncreates a playful plant creature, sparking\r\na whimsical quest to find a hidden place\r\nwhere their unlikely friendship can truly\r\nbloom.\r\n', 4, 1, 2, 1, 'oh my kimmy.jpg'),
(15, 'Double Crosser', 'A skilled but unlucky hacker is\r\nblackmailed into infiltrating a powerful\r\ncorporation, caught between two ruthless\r\nforces. And forced to betray both to\r\nescape and protect those they love.\r\n', 1, 1, 2, 1, 'double crosser.jpg'),
(16, 'Serenade: Season of Love', 'Two strangers with clashing views on love\r\nare drawn together by a shared melody\r\nduring a town’s romantic festival, where\r\ntheir impromptu duets spark an\r\nunexpected love story.\r\n', 5, 1, 2, 1, 'serenade.jpg'),
(17, 'Rainfall Under the Trees', 'A grieving arborist discovers a\r\nrain-activated magical grove and a hidden\r\ngroup of forest guardians. To save their\r\nhome, she must confront her past and a\r\ngrowing environmental threat.\r\n', 5, 1, 2, 1, 'rainfall under the trees.jpg'),
(18, 'Replayed Romance', 'In a future where memories are replayed,\r\na technician uncovers a disturbing\r\nromance. And as they delve deeper, the\r\nline between past and present begins to\r\ndangerously blur.\r\n', 1, 1, 2, 1, 'replayed romance.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movietime`
--

CREATE TABLE `movietime` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `availability_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movietime`
--

INSERT INTO `movietime` (`id`, `movie_id`, `time_id`, `availability_id`, `cinema_id`) VALUES
(379, 2, 1, 1, 1),
(380, 2, 1, 1, 2),
(381, 2, 1, 1, 3),
(382, 2, 1, 2, 1),
(383, 2, 1, 2, 2),
(384, 2, 1, 2, 3),
(385, 2, 1, 3, 1),
(386, 2, 1, 3, 2),
(387, 2, 1, 3, 3),
(388, 2, 4, 1, 1),
(389, 2, 4, 1, 2),
(390, 2, 4, 1, 3),
(391, 2, 4, 2, 1),
(392, 2, 4, 2, 2),
(393, 2, 4, 2, 3),
(394, 2, 4, 3, 1),
(395, 2, 4, 3, 2),
(396, 2, 4, 3, 3),
(397, 2, 7, 1, 1),
(398, 2, 7, 1, 2),
(399, 2, 7, 1, 3),
(400, 2, 7, 2, 1),
(401, 2, 7, 2, 2),
(402, 2, 7, 2, 3),
(403, 2, 7, 3, 1),
(404, 2, 7, 3, 2),
(405, 2, 7, 3, 3),
(406, 3, 1, 1, 1),
(407, 3, 1, 1, 2),
(408, 3, 1, 1, 3),
(409, 3, 1, 2, 1),
(410, 3, 1, 2, 2),
(411, 3, 1, 2, 3),
(412, 3, 1, 3, 1),
(413, 3, 1, 3, 2),
(414, 3, 1, 3, 3),
(415, 3, 4, 1, 1),
(416, 3, 4, 1, 2),
(417, 3, 4, 1, 3),
(418, 3, 4, 2, 1),
(419, 3, 4, 2, 2),
(420, 3, 4, 2, 3),
(421, 3, 4, 3, 1),
(422, 3, 4, 3, 2),
(423, 3, 4, 3, 3),
(424, 3, 7, 1, 1),
(425, 3, 7, 1, 2),
(426, 3, 7, 1, 3),
(427, 3, 7, 2, 1),
(428, 3, 7, 2, 2),
(429, 3, 7, 2, 3),
(430, 3, 7, 3, 1),
(431, 3, 7, 3, 2),
(432, 3, 7, 3, 3),
(433, 4, 2, 1, 1),
(434, 4, 2, 1, 2),
(435, 4, 2, 1, 3),
(436, 4, 2, 2, 1),
(437, 4, 2, 2, 2),
(438, 4, 2, 2, 3),
(439, 4, 2, 3, 1),
(440, 4, 2, 3, 2),
(441, 4, 2, 3, 3),
(442, 4, 5, 1, 1),
(443, 4, 5, 1, 2),
(444, 4, 5, 1, 3),
(445, 4, 5, 2, 1),
(446, 4, 5, 2, 2),
(447, 4, 5, 2, 3),
(448, 4, 5, 3, 1),
(449, 4, 5, 3, 2),
(450, 4, 5, 3, 3),
(451, 4, 8, 1, 1),
(452, 4, 8, 1, 2),
(453, 4, 8, 1, 3),
(454, 4, 8, 2, 1),
(455, 4, 8, 2, 2),
(456, 4, 8, 2, 3),
(457, 4, 8, 3, 1),
(458, 4, 8, 3, 2),
(459, 4, 8, 3, 3),
(460, 5, 2, 1, 1),
(461, 5, 2, 1, 2),
(462, 5, 2, 1, 3),
(463, 5, 2, 2, 1),
(464, 5, 2, 2, 2),
(465, 5, 2, 2, 3),
(466, 5, 5, 1, 1),
(467, 5, 5, 1, 2),
(468, 5, 5, 1, 3),
(469, 5, 5, 2, 1),
(470, 5, 5, 2, 2),
(471, 5, 5, 2, 3),
(472, 5, 8, 1, 1),
(473, 5, 8, 1, 2),
(474, 5, 8, 1, 3),
(475, 5, 8, 2, 1),
(476, 5, 8, 2, 2),
(477, 5, 8, 2, 3),
(556, 6, 2, 1, 1),
(557, 6, 2, 1, 2),
(558, 6, 2, 1, 3),
(559, 6, 2, 2, 1),
(560, 6, 2, 2, 2),
(561, 6, 2, 2, 3),
(562, 6, 2, 3, 1),
(563, 6, 2, 3, 2),
(564, 6, 2, 3, 3),
(565, 6, 5, 1, 1),
(566, 6, 5, 1, 2),
(567, 6, 5, 1, 3),
(568, 6, 5, 2, 1),
(569, 6, 5, 2, 2),
(570, 6, 5, 2, 3),
(571, 6, 5, 3, 1),
(572, 6, 5, 3, 2),
(573, 6, 5, 3, 3),
(574, 6, 8, 1, 1),
(575, 6, 8, 1, 2),
(576, 6, 8, 1, 3),
(577, 6, 8, 2, 1),
(578, 6, 8, 2, 2),
(579, 6, 8, 2, 3),
(580, 6, 8, 3, 1),
(581, 6, 8, 3, 2),
(582, 6, 8, 3, 3),
(583, 7, 3, 1, 2),
(584, 7, 3, 1, 3),
(585, 7, 6, 1, 2),
(586, 7, 6, 1, 3),
(587, 7, 9, 1, 2),
(588, 7, 9, 1, 3),
(589, 8, 3, 1, 1),
(590, 8, 3, 1, 2),
(591, 8, 3, 1, 3),
(592, 8, 6, 1, 1),
(593, 8, 6, 1, 2),
(594, 8, 6, 1, 3),
(595, 8, 9, 1, 1),
(596, 8, 9, 1, 2),
(597, 8, 9, 1, 3),
(598, 9, 3, 1, 1),
(599, 9, 3, 1, 2),
(600, 9, 3, 1, 3),
(601, 9, 3, 2, 1),
(602, 9, 3, 2, 2),
(603, 9, 3, 2, 3),
(604, 9, 3, 3, 1),
(605, 9, 3, 3, 2),
(606, 9, 3, 3, 3),
(607, 9, 6, 1, 1),
(608, 9, 6, 1, 2),
(609, 9, 6, 1, 3),
(610, 9, 6, 2, 1),
(611, 9, 6, 2, 2),
(612, 9, 6, 2, 3),
(613, 9, 6, 3, 1),
(614, 9, 6, 3, 2),
(615, 9, 6, 3, 3),
(616, 9, 9, 1, 1),
(617, 9, 9, 1, 2),
(618, 9, 9, 1, 3),
(619, 9, 9, 2, 1),
(620, 9, 9, 2, 2),
(621, 9, 9, 2, 3),
(622, 9, 9, 3, 1),
(623, 9, 9, 3, 2),
(624, 9, 9, 3, 3),
(663, 1, 4, 1, 1),
(664, 1, 4, 2, 1),
(665, 1, 4, 3, 1),
(666, 1, 7, 1, 2),
(667, 1, 7, 2, 2),
(668, 1, 7, 3, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `overview`
-- (See below for the actual view)
--
CREATE TABLE `overview` (
`id` int(11)
,`movie_name` varchar(225)
,`movie_description` text
,`movie_poster` text
,`rating_text` varchar(100)
,`rating_img` text
,`director` varchar(100)
,`status` varchar(225)
,`year` varchar(11)
,`genres` mediumtext
,`qualities` mediumtext
);

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE `quality` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `availability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quality`
--

INSERT INTO `quality` (`id`, `movie_id`, `availability_id`) VALUES
(23, 10, 1),
(24, 10, 2),
(25, 10, 3),
(26, 11, 1),
(27, 11, 2),
(28, 11, 3),
(29, 12, 1),
(30, 13, 1),
(31, 13, 2),
(32, 14, 1),
(33, 14, 2),
(34, 14, 3),
(35, 15, 1),
(36, 15, 2),
(37, 15, 3),
(38, 16, 1),
(39, 16, 2),
(40, 16, 3),
(41, 17, 1),
(42, 17, 2),
(43, 17, 3),
(44, 18, 1),
(81, 2, 1),
(82, 2, 2),
(83, 2, 3),
(84, 3, 1),
(85, 3, 2),
(86, 3, 3),
(87, 4, 1),
(88, 4, 2),
(89, 4, 3),
(90, 5, 1),
(91, 5, 2),
(101, 6, 1),
(102, 6, 2),
(103, 6, 3),
(104, 7, 1),
(105, 8, 1),
(106, 9, 1),
(107, 9, 2),
(108, 9, 3),
(124, 1, 1),
(125, 1, 2),
(126, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `rating_text` varchar(100) NOT NULL,
  `rating_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `rating_text`, `rating_img`) VALUES
(1, 'R-18', 'Rated18.png'),
(2, 'R-16', 'Rated16.png'),
(3, 'R-13', 'Rated13.png'),
(4, 'G', 'RatedG.png'),
(5, 'PG', 'RatedPG.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `showtimes`
-- (See below for the actual view)
--
CREATE TABLE `showtimes` (
`id` int(11)
,`movie_name` varchar(225)
,`movie_poster` text
,`rating_img` text
,`available_quality` varchar(20)
,`time` varchar(10)
,`location_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `statusmovie`
--

CREATE TABLE `statusmovie` (
  `id` int(11) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statusmovie`
--

INSERT INTO `statusmovie` (`id`, `status`) VALUES
(1, 'Now Showing'),
(2, 'Coming Soon');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `year` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`) VALUES
(1, '2025'),
(2, '2024'),
(3, '1233'),
(4, '2011'),
(5, '1234'),
(6, '2025'),
(7, '2025');

-- --------------------------------------------------------

--
-- Structure for view `moviecinema`
--
DROP TABLE IF EXISTS `moviecinema`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `moviecinema`  AS SELECT `movies`.`movie_name` AS `movie_name`, `availabletime`.`time` AS `time`, `availability`.`available_quality` AS `available_quality`, `cinemas`.`cinema` AS `cinema` FROM ((((`movietime` join `movies` on(`movietime`.`movie_id` = `movies`.`id`)) join `availabletime` on(`movietime`.`time_id` = `availabletime`.`id`)) join `availability` on(`movietime`.`availability_id` = `availability`.`id`)) join `cinemas` on(`movietime`.`cinema_id` = `cinemas`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `overview`
--
DROP TABLE IF EXISTS `overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `overview`  AS SELECT `m`.`id` AS `id`, `m`.`movie_name` AS `movie_name`, `m`.`movie_description` AS `movie_description`, `m`.`movie_poster` AS `movie_poster`, `r`.`rating_text` AS `rating_text`, `r`.`rating_img` AS `rating_img`, `d`.`director` AS `director`, `s`.`status` AS `status`, `y`.`year` AS `year`, group_concat(distinct `g`.`genre_name` separator ',') AS `genres`, group_concat(distinct `a`.`available_quality` separator ',') AS `qualities` FROM ((((((((`movies` `m` left join `rating` `r` on(`m`.`rating_id` = `r`.`id`)) left join `director` `d` on(`m`.`director_id` = `d`.`id`)) left join `statusmovie` `s` on(`m`.`status_id` = `s`.`id`)) left join `years` `y` on(`m`.`year_id` = `y`.`id`)) left join `moviegenre` `mg` on(`m`.`id` = `mg`.`movie_id`)) left join `genre` `g` on(`mg`.`genre_id` = `g`.`id`)) left join `quality` `q` on(`m`.`id` = `q`.`movie_id`)) left join `availability` `a` on(`q`.`availability_id` = `a`.`id`)) GROUP BY `m`.`id`, `m`.`movie_name`, `m`.`movie_description`, `m`.`movie_poster`, `r`.`rating_text`, `d`.`director`, `s`.`status`, `y`.`year` ;

-- --------------------------------------------------------

--
-- Structure for view `showtimes`
--
DROP TABLE IF EXISTS `showtimes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `showtimes`  AS SELECT `movies`.`id` AS `id`, `movies`.`movie_name` AS `movie_name`, `movies`.`movie_poster` AS `movie_poster`, `rating`.`rating_img` AS `rating_img`, `availability`.`available_quality` AS `available_quality`, `availabletime`.`time` AS `time`, `locations`.`location_name` AS `location_name` FROM ((((((`movies` left join `rating` on(`rating`.`id` = `movies`.`rating_id`)) left join `movietime` on(`movietime`.`movie_id` = `movies`.`id`)) left join `availabletime` on(`availabletime`.`id` = `movietime`.`time_id`)) left join `availability` on(`availability`.`id` = `movietime`.`availability_id`)) left join `movielocation` on(`movielocation`.`movie_id` = `movies`.`id`)) left join `locations` on(`locations`.`id` = `movielocation`.`location_id`)) GROUP BY `movies`.`id`, `movies`.`movie_name`, `movies`.`movie_poster`, `rating`.`rating_img`, `availability`.`available_quality`, `availabletime`.`time`, `locations`.`location_name` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `availabletime`
--
ALTER TABLE `availabletime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moviegenre`
--
ALTER TABLE `moviegenre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie` (`movie_id`),
  ADD KEY `genres` (`genre_id`);

--
-- Indexes for table `movielocation`
--
ALTER TABLE `movielocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moviecons` (`movie_id`),
  ADD KEY `locationcons` (`location_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `releaseDate` (`year_id`),
  ADD KEY `movieStatus` (`status_id`),
  ADD KEY `movieRate` (`rating_id`),
  ADD KEY `movieDirector` (`director_id`);

--
-- Indexes for table `movietime`
--
ALTER TABLE `movietime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movieconss` (`movie_id`),
  ADD KEY `timecons` (`time_id`),
  ADD KEY `availabilitycons` (`availability_id`),
  ADD KEY `cinemasconz` (`cinema_id`);

--
-- Indexes for table `quality`
--
ALTER TABLE `quality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movieQual` (`movie_id`),
  ADD KEY `avail` (`availability_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statusmovie`
--
ALTER TABLE `statusmovie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `availabletime`
--
ALTER TABLE `availabletime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `moviegenre`
--
ALTER TABLE `moviegenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `movielocation`
--
ALTER TABLE `movielocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `movietime`
--
ALTER TABLE `movietime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT for table `quality`
--
ALTER TABLE `quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `statusmovie`
--
ALTER TABLE `statusmovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `moviegenre`
--
ALTER TABLE `moviegenre`
  ADD CONSTRAINT `genres` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movielocation`
--
ALTER TABLE `movielocation`
  ADD CONSTRAINT `locationcons` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moviecons` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movieDirector` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieRate` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieStatus` FOREIGN KEY (`status_id`) REFERENCES `statusmovie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `releaseDate` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movietime`
--
ALTER TABLE `movietime`
  ADD CONSTRAINT `availabilitycons` FOREIGN KEY (`availability_id`) REFERENCES `availability` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cinemasconz` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`),
  ADD CONSTRAINT `movieconss` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timecons` FOREIGN KEY (`time_id`) REFERENCES `availabletime` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quality`
--
ALTER TABLE `quality`
  ADD CONSTRAINT `avail` FOREIGN KEY (`availability_id`) REFERENCES `availability` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieQual` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
