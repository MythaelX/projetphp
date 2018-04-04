-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1:3306
-- Généré le :  Mer 04 Avril 2018 à 16:10
-- Version du serveur :  5.7.21-0ubuntu0.16.04.1
-- Version de PHP :  7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chen-co.corp`
--
CREATE DATABASE IF NOT EXISTS `chen-co.corp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chen-co.corp`;

-- --------------------------------------------------------

--
-- Structure de la table `cambrure`
--

CREATE TABLE `cambrure` (
  `id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `t` int(11) NOT NULL,
  `f` int(11) NOT NULL,
  `yintra` int(11) NOT NULL,
  `yextra` int(11) NOT NULL,
  `id_param` int(11) NOT NULL,
  `igz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `id` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `corde` float NOT NULL,
  `tmax` float NOT NULL,
  `tmaxmm` float NOT NULL,
  `fmax` float NOT NULL,
  `fmaxmm` float NOT NULL,
  `nb_points` int(11) NOT NULL,
  `date` date NOT NULL,
  `fic_img` text NOT NULL,
  `fic_csv` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cambrure`
--
ALTER TABLE `cambrure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_param` (`id_param`);

--
-- Index pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cambrure`
--
ALTER TABLE `cambrure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `parametre`
--
ALTER TABLE `parametre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cambrure`
--
ALTER TABLE `cambrure`
  ADD CONSTRAINT `parametre` FOREIGN KEY (`id_param`) REFERENCES `parametre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
