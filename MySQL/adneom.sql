-- phpMyAdmin SQL Dump
-- version 4.2.6
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1:3388
-- Généré le :  Mer 01 Novembre 2017 à 02:11
-- Version du serveur :  5.6.19
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `adneom`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

CREATE TABLE IF NOT EXISTS `avatar` (
`id` int(11) NOT NULL,
  `picture` varchar(32) NOT NULL DEFAULT '',
  `animation` varchar(32) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `avatar`
--

INSERT INTO `avatar` (`id`, `picture`, `animation`) VALUES
(3, 'ragna2.png', 'ragna-home.gif'),
(4, 'tsubaki.png', 'tsubaki-fly.gif'),
(5, 'noel.jpg', 'noel.gif'),
(6, 'dizzy.jpg', 'dizzy.gif'),
(7, 'taokaka.gif', 'taokaka.gif'),
(8, 'hakumen.jpg', 'hakumen.gif'),
(9, 'kagura.png', 'takama.gif'),
(10, 'susanoo.jpg', 'susanoo.gif'),
(11, 'tager.png', 'tager.gif'),
(12, 'azrael.png', 'azrael.gif'),
(13, 'konoe.png', 'Konoe.gif'),
(14, 'hades.png', 'hades-izanami.gif'),
(15, 'nu-no13.jpg', 'nu-no13.gif'),
(20, 'jin.png', 'jin.gif'),
(17, 'arakune.jpg', 'arakune.gif'),
(18, 'gordeau.png', 'gordeau.gif'),
(19, 'kykiske.png', 'kykiske.gif'),
(21, 'kurogane.png', 'kurogane.gif'),
(22, 'relius.png', 'relius.gif'),
(23, 'bang.png', 'bang.gif'),
(24, 'valkenhayn.png', 'valkenhayn.gif'),
(25, 'rachel.png', 'rachel.gif');

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
`id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `difficuty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `games_history`
--

CREATE TABLE IF NOT EXISTS `games_history` (
`id` int(11) NOT NULL,
  `fk_game` int(11) NOT NULL,
  `fk_user_1` int(11) NOT NULL,
  `fk_user_2` int(11) NOT NULL,
  `fk_user_3` int(11) DEFAULT '0',
  `fk_user_4` int(11) DEFAULT '0',
  `winners` varchar(32) NOT NULL,
  `amount_of_points` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `temp_signup`
--

CREATE TABLE IF NOT EXISTS `temp_signup` (
  `mail` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `avatar` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `mail` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL DEFAULT '',
  `points` int(11) NOT NULL DEFAULT '0',
  `fk_avatar` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avatar`
--
ALTER TABLE `avatar`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games_history`
--
ALTER TABLE `games_history`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_1` (`fk_user_1`), ADD KEY `fk_user_2` (`fk_user_2`), ADD KEY `fk_user_3` (`fk_user_3`), ADD KEY `fk_user_4` (`fk_user_4`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_avatar` (`fk_avatar`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avatar`
--
ALTER TABLE `avatar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `games_history`
--
ALTER TABLE `games_history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
