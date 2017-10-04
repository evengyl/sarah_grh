-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 04 Octobre 2017 à 10:56
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
  `gsm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `employer`
--

TRUNCATE TABLE `employer`;
--
-- Contenu de la table `employer`
--

INSERT INTO `employer` (`id`, `nom`, `prenom`, `age`, `habite`, `travail`, `visible`, `gsm`) VALUES
(5, 'loic', 'baudoux', 26, 'labuissiere<br>', 'la louviere', 0, '0497 31 25 23'),
(6, 'loic', 'baudoux', 26, 'labuissiere', 'la louviere', 0, '0497 31 25 23'),
(7, 'loic', 'baudoux', 26, 'labuissiere<br>', 'la louviere', 0, '0497 31 25 23'),
(8, 'loic', 'baudoux de<br>', 26, 'labuissiere ahah<br>', 'la louviere', 1, '0497 31 25 23'),
(9, 'loic', 'baudoux', 26, 'labuissiere<br>', 'la louviere', 1, '0497 31 25 23'),
(10, 'loic', 'baudoux', 26, 'labuissiere', 'la louviere', 1, '0497 31 25 23'),
(11, 'loic', 'baudoux', 26, 'labuissiere<br>', 'la louviere', 1, '0497 31 25 23'),
(12, 'loic', 'baudoux zd dz<br>', 26, 'labuissiere', 'la louviere', 1, '0497 31 25 23');

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
(21, 0, 'qd', 'qzd', '', 1),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
