-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le :  lun. 01 juil. 2019 à 07:13
-- Version du serveur :  5.6.43
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_comments` int(11) NOT NULL,
  `date_comment` date NOT NULL,
  `content` mediumtext NOT NULL,
  `id_picture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comments`, `date_comment`, `content`, `id_picture`) VALUES
(1, '2019-06-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 22),
(2, '2019-06-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 22),
(3, '2019-06-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 22),
(4, '2019-06-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 22),
(5, '2019-06-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 22),
(6, '2019-06-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 22);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `adress` varchar(100) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_image`, `date_creation`, `adress`, `id_author`) VALUES
(18, '0000-00-00', '17.png', 8),
(19, '2019-06-26', '18.png', 8),
(20, '2019-06-26', '19.png', 8),
(21, '2019-06-26', '20.png', 8),
(22, '2019-06-26', '21.png', 8),
(23, '2019-06-26', '22.png', 8),
(24, '2019-06-26', '23.png', 8),
(25, '2019-06-26', '24.png', 8),
(26, '2019-06-26', '25.png', 8),
(27, '2019-06-26', '26.png', 8),
(28, '2019-06-26', '27.png', 8),
(29, '2019-06-26', '28.png', 8),
(30, '2019-06-26', '29.png', 8),
(31, '2019-06-26', '30.png', 8),
(32, '2019-06-26', '31.png', 8),
(33, '2019-06-26', '32.png', 8),
(34, '2019-06-26', '33.png', 8),
(35, '2019-06-26', '34.png', 8),
(36, '2019-06-26', '35.png', 8),
(37, '2019-06-26', '36.png', 8),
(38, '2019-06-26', '37.png', 8),
(39, '2019-06-26', '38.png', 8),
(40, '2019-06-26', '39.png', 8),
(88, '2019-07-01', '41.png', 9);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_like`, `id_image`, `id_author`) VALUES
(1, 25, 7),
(2, 26, 7),
(3, 8, 25),
(4, 8, 28),
(5, 25, 7),
(7, 24, 8),
(8, 25, 8),
(9, 40, 8),
(10, 23, 8),
(11, 31, 8),
(12, 35, 8),
(16, 25, 9),
(17, 40, 9),
(19, 36, 9),
(20, 37, 9),
(24, 23, 9),
(25, 22, 9);

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(240) NOT NULL,
  `email` varchar(100) NOT NULL,
  `confirmEmail` int(11) DEFAULT NULL,
  `preference` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`id_member`, `login`, `password`, `email`, `confirmEmail`, `preference`) VALUES
(7, 'gabrieldrai', '8018373c319f777ec23e69ba6724584322cdbeee8a04f3a25f6a7d275059f64f6e185774789167881ee9557f3110dc9ab87a3eb2365950af180ae30660599565', 'gabrieldrai@yahoo.fr', NULL, NULL),
(9, 'gagastrofe', '38f6c6a4a02f4dc44475e7e83a592aa526fd53b0ae86c2befe05ab34af1829c4686ce7776540cff811f8d95c216d965adc807b470679dbeb8c232ec250c0c0c0', 'gabrieldrai@yahoo.fr', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
