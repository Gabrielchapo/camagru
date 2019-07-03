-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2019 at 09:27 AM
-- Server version: 5.6.43
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comments` int(11) NOT NULL,
  `date_comment` date NOT NULL,
  `content` mediumtext NOT NULL,
  `id_picture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comments`, `date_comment`, `content`, `id_picture`) VALUES
(1, '2019-07-03', 'beau gosse !', 1),
(2, '2019-07-03', 'bien sur', 1),
(3, '2019-07-03', 'bg du 75', 1),
(4, '2019-07-03', 'tres beau gosse !', 1),
(5, '2019-07-03', 'wooooowww', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `address` mediumtext NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_image`, `date_creation`, `address`, `id_author`) VALUES
(1, '2019-07-03', '1.png', 1),
(2, '2019-07-03', '2.png', 1),
(3, '2019-07-03', '3.png', 1),
(4, '2019-07-03', '4.png', 1),
(5, '2019-07-03', '5.png', 1),
(6, '2019-07-03', '6.png', 1),
(7, '2019-07-03', '7.png', 1),
(8, '2019-07-03', '8.png', 1),
(9, '2019-07-03', '9.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_like`, `id_image`, `id_author`) VALUES
(1, 1, 1),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `confirmEmail` text NOT NULL,
  `preference` tinyint(1) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `login`, `password`, `email`, `confirmEmail`, `preference`, `token`) VALUES
(1, 'gagastrofe', '38f6c6a4a02f4dc44475e7e83a592aa526fd53b0ae86c2befe05ab34af1829c4686ce7776540cff811f8d95c216d965adc807b470679dbeb8c232ec250c0c0c0', 'gabrieldrai@yahoo.fr', '1', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
