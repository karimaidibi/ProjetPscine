-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 19 sep. 2021 à 20:58
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetpiscine_db`
--
CREATE DATABASE IF NOT EXISTS `projetpiscine_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projetpiscine_db`;

-- --------------------------------------------------------

-- Structure de la table `fichetechnique`
--

DROP TABLE IF EXISTS `fiche_technique`;
CREATE TABLE IF NOT EXISTS `fiche_technique` (
  `numeroFiche` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `nbreCouverts` int(11) NOT NULL,
  `progression` text NOT NULL,
  PRIMARY KEY (`numeroFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ingrédient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `codeIngredient` int(11) NOT NULL AUTO_INCREMENT,
  `nature` varchar(255) NOT NULL,
  `unite` varchar(255) NOT NULL,
  `prixU` float NOT NULL,
  `allergene` tinyint(1) NOT NULL,
  PRIMARY KEY (`codeIngredient`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Structure de la table `contenufiche`
--

DROP TABLE IF EXISTS `contenu_fiche`;
CREATE TABLE IF NOT EXISTS `contenu_fiche` (
  `idFiche` int(11) NOT NULL,
  `idIngredient` int(11) NOT NULL,
  `ordreIngredient` int(11) NOT NULL,
  `quantiteIngredient` float NOT NULL,
  PRIMARY KEY (`idfiche`,`idingredient`),
  Key `FK_contenu_fiche_idFiche` (`idFiche`),
  Key `FK_contenu_fiche_idIngredient` (`idIngredient`) 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- contrainte pour la table contenu_fiche
--
ALTER TABLE `contenu_fiche`
  ADD CONSTRAINT `FK_contenu_fiche_idFiche` FOREIGN KEY (`idFiche`) REFERENCES `fiche_technique` (`numeroFiche`),
  ADD CONSTRAINT `FK_contenu_fiche_idIngredient` FOREIGN KEY (`idIngredient`) REFERENCES `ingredient` (`codeIngredient`);


-- --------------------------------------------------------
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
