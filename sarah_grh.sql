-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 04 Octobre 2017 à 16:58
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sarah_grh`
--
CREATE DATABASE IF NOT EXISTS `sarah_grh` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sarah_grh`;

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `habite` varchar(255) NOT NULL,
  `travail` varchar(255) NOT NULL,
  `visible` tinyint(4) NOT NULL,
  `gsm` varchar(50) NOT NULL,
  `id_shop_proche_1` int(11) NOT NULL,
  `id_shop_proche_2` int(11) NOT NULL,
  `id_shop_proche_3` int(11) NOT NULL,
  `id_shop_proche_4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `employer`
--

TRUNCATE TABLE `employer`;
--
-- Contenu de la table `employer`
--

INSERT INTO `employer` (`id`, `nom`, `prenom`, `age`, `habite`, `travail`, `visible`, `gsm`, `id_shop_proche_1`, `id_shop_proche_2`, `id_shop_proche_3`, `id_shop_proche_4`) VALUES
(1, 'Jalane', 'Jimmy', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(2, 'Potloot', 'Thierry', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(3, 'TienneBrunne', 'Benoit', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(4, 'Andre', 'Emin<br>', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(5, 'Raout', 'Thierry', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(6, 'Buys', 'Jeremy', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(7, 'Bukala', 'Kylian', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(8, 'De Roo', 'Alex', 26, '<br>', 'la louviere', 1, '<br>', 0, 0, 0, 0),
(9, 'Chantraine', 'Marcel', 26, '<br>', 'la louvière<br>', 1, '<br>', 0, 0, 0, 0),
(10, 'Vandenbergh', 'Benoit', 0, '', '', 1, '', 0, 0, 0, 0),
(11, 'Mineo', 'Massimo', 0, '', '', 1, '', 0, 0, 0, 0),
(12, 'Non Connu', 'Samuel', 0, '', '', 1, '', 0, 0, 0, 0),
(13, 'Di Mase', 'Anthony', 0, '', '', 1, '', 0, 0, 0, 0),
(14, 'Wallon', 'Edwin', 0, '', '', 1, '', 0, 0, 0, 0),
(15, 'Davaux', 'Dylan', 0, '', '', 1, '', 0, 0, 0, 0),
(16, 'De Nicoli', 'Pierrot', 0, '', '', 1, '', 0, 0, 0, 0),
(17, 'Colmant', 'Attilio', 0, '', '', 1, '', 0, 0, 0, 0),
(18, 'Mabil', 'Michael', 0, '', '', 1, '', 0, 0, 0, 0),
(19, 'Geers', 'Steve', 0, '', '', 1, '', 0, 0, 0, 0),
(20, 'Boly', 'Adam', 0, '', '', 1, '', 0, 0, 0, 0),
(21, 'Prince', 'Frederic', 0, '', '', 1, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_connect` varchar(50) NOT NULL,
  `avertissement` int(11) NOT NULL,
  `password_no_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `login`
--

TRUNCATE TABLE `login`;
--
-- Contenu de la table `login`
--

INSERT INTO `login` (`id`, `login`, `password`, `last_connect`, `avertissement`, `password_no_hash`, `email`, `level`) VALUES
(20, 'evengyl', '$2y$10$LMyXpdg11OyYKNOtimiQOOfEABrPA5DOEubnuxvnmOCGiq1Y.BhvS', '1490198511', 0, 'legends', 'dark.evengyl@gmail.com', 3),
(21, 'evengyleez', '$2y$10$LMyXpdg11OyYKNOtimiQOOfEABrPA5DOEubnuxvnmOCGiq1Y.BhvS', '1490198511', 10, 'legends', 'dark.evengyl@gmail.com', 0),
(22, 'sarah', '$2y$10$ygzB2J6chpdbxJLClx.Pju7oOpeiCzIGnIigGkBsxtTMuo80VlQG6', '1507020415', 0, '01071987Sa', 'sarahdebevec21@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `id_employer_1` int(11) NOT NULL,
  `id_employer_2` int(11) NOT NULL,
  `couleur_horraire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `shop`
--

TRUNCATE TABLE `shop`;
--
-- Contenu de la table `shop`
--

INSERT INTO `shop` (`id`, `nom`, `id_responsable`, `id_employer_1`, `id_employer_2`, `couleur_horraire`) VALUES
(1, 'Bruxelle', 0, 0, 0, '#ff0000'),
(2, 'Chatelineau', 0, 0, 0, '#00b050'),
(3, 'Fleurus', 0, 0, 0, '#808080'),
(4, 'Hornu', 0, 0, 0, '#e26b0a'),
(5, 'Bomere', 0, 0, 0, '#4f6228'),
(6, 'La louvière (cora)', 0, 0, 0, '#ffff00'),
(7, 'Auchan', 0, 0, 0, '#e6b8b7'),
(8, 'Le roux', 0, 0, 0, '#b3a2c7'),
(9, 'Gilly', 0, 0, 0, '#00b0f0'),
(10, 'La louvière (centre) ', 0, 0, 0, '#ff00ff'),
(11, 'Ville 2 (charleroi)', 0, 0, 0, '#00ff00'),
(12, 'CigVapro', 0, 0, 0, '#b8cce4');

-- --------------------------------------------------------

--
-- Structure de la table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `todo_title` varchar(255) NOT NULL,
  `todo_content` text NOT NULL,
  `date` varchar(15) NOT NULL,
  `visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `todo`
--

TRUNCATE TABLE `todo`;
--
-- Contenu de la table `todo`
--

INSERT INTO `todo` (`id`, `id_user`, `todo_title`, `todo_content`, `date`, `visible`) VALUES
(1, 22, 'test', 'test test test test test test test test ', '05-10-2017', 0),
(2, 22, 'test', 'test test test test test test test test ', '05-10-2017', 0),
(3, 0, '', 'qzdqzddzdzd<br>', '05-10-2017', 0),
(4, 0, '', 'sefsef<br>', '05-10-2017', 1),
(5, 0, '', 'sefs<br>', '05-10-2017', 1),
(6, 22, 'test', 'test test test test test test test test ', '05-10-2017', 1),
(7, 22, 'test', 'test test test test test test test test ', '03-10-2017', 1),
(8, 0, '', 'qzdqzddzdzd<br>', '03-10-2017', 1),
(9, 0, '', 'sefsef<br>', '03-10-2017', 1),
(10, 0, '', 'sefs<br>', '03-10-2017', 1),
(11, 22, 'test', 'test test test test test test test test ', '03-10-2017', 1),
(12, 22, 'test', 'test test test test test test test test ', '04-10-2017', 0),
(13, 0, '', 'qzdqzddzdzd<br>', '04-10-2017', 1),
(14, 0, '', 'sefsef<br>', '04-10-2017', 1),
(15, 0, '', 'sefs<br>', '04-10-2017', 1),
(16, 22, 'test', 'test test test test test test test test ', '04-10-2017', 1),
(17, 22, 'test', 'test test test test test test test test ', '04-10-2017', 1),
(18, 0, '', 'qzdqzddzdzd<br>', '04-10-2017', 1),
(19, 0, '', 'sefsef<br>', '04-10-2017', 1),
(20, 0, '', 'sefs<br>', '04-10-2017', 1),
(21, 0, 'qd', 'qzd', '04-10-2017', 1),
(22, 0, '', 'qzdqdqdz', '04-10-2017', 1),
(23, 0, '', 'qdqdzdqd', '04-10-2017', 1),
(24, 0, '', 'qdqdqdd', '05-10-2017', 1),
(25, 0, '', 'qzdqzd', '04-10-2017', 1),
(26, 0, '', 'qdqdzd<br>', '06-10-2017', 1),
(27, 0, 'fefef', 'qdqzdqd<br>', '07-10-2017', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `todo`
--
ALTER TABLE `todo`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
