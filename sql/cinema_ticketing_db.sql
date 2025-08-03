-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 10:43 AM
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
-- Database: `cinema_ticketing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `available_quality` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `available_quality`) VALUES
(1, '2D'),
(2, 'Director\'s Club'),
(3, 'IMAX');

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
(1, 'John Carlo Buscay');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genre` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genre`) VALUES
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
(1, 1, 1),
(2, 1, 4),
(3, 2, 10),
(4, 2, 11),
(5, 2, 12),
(6, 3, 14),
(7, 3, 10),
(8, 3, 11),
(9, 4, 1),
(10, 4, 3),
(11, 4, 5),
(12, 4, 6),
(13, 5, 2),
(14, 6, 2),
(15, 6, 10),
(16, 7, 7),
(17, 7, 8),
(18, 7, 9),
(19, 8, 11),
(20, 8, 10),
(21, 8, 13),
(22, 9, 3),
(23, 9, 10),
(24, 9, 5),
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
(60, 18, 19);

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
-- Table structure for table `quality`
--

CREATE TABLE `quality` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `availability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Now Showing'),
(2, 'Coming Soon');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `year`) VALUES
(1, '2025'),
(2, '2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
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
-- Indexes for table `moviegenre`
--
ALTER TABLE `moviegenre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie` (`movie_id`),
  ADD KEY `genres` (`genre_id`);

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
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
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
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `moviegenre`
--
ALTER TABLE `moviegenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quality`
--
ALTER TABLE `quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movieDirector` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieRate` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieStatus` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `releaseDate` FOREIGN KEY (`year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quality`
--
ALTER TABLE `quality`
  ADD CONSTRAINT `avail` FOREIGN KEY (`availability_id`) REFERENCES `availability` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movieQual` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
