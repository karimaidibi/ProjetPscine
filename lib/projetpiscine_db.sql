-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Genere le : mer. 06 oct. 2021 a 12:16
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
-- Base de donnees : `projetpiscine_db`
--
CREATE DATABASE IF NOT EXISTS `projetpiscine_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projetpiscine_db`;
-- --------------------------------------------------------

--
-- Structure de la table `allergene`
--

DROP TABLE IF EXISTS `allergene`;
CREATE TABLE IF NOT EXISTS `allergene` (
  `NumAllergene` int(11) NOT NULL AUTO_INCREMENT,
  `NomAllergene` varchar(60) NOT NULL,
  PRIMARY KEY (`NumAllergene`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_fiche`
--

DROP TABLE IF EXISTS `categorie_fiche`;
CREATE TABLE IF NOT EXISTS `categorie_fiche` (
  `NumeroCatFiche` int(11) NOT NULL AUTO_INCREMENT,
  `NomCatFiche` varchar(20) NOT NULL,
  PRIMARY KEY (`NumeroCatFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_ingredient`
--

DROP TABLE IF EXISTS `categorie_ingredient`;
CREATE TABLE IF NOT EXISTS `categorie_ingredient` (
  `NumCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `NomCategorie` varchar(20) NOT NULL,
  PRIMARY KEY (`NumCategorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `coefficientAss`
--

DROP TABLE IF EXISTS `coeffAss`;
CREATE TABLE IF NOT EXISTS `coeffAss` (
  `CodeCoeffAss` int(11) NOT NULL AUTO_INCREMENT,
  `valeurCoeffAss` float NOT NULL,
  PRIMARY KEY (`CodeCoeffAss`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `coefficientCoutFluide`
--

DROP TABLE IF EXISTS `coeffCoutPersonnel`;
CREATE TABLE IF NOT EXISTS `coeffCoutPersonnel` (
  `CodeCoeffCoutPersonnel` int(11) NOT NULL AUTO_INCREMENT,
  `valeurCoeffCoutPersonnel` float NOT NULL,
  PRIMARY KEY (`CodeCoeffCoutPersonnel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `FK_NumeroFiche` int(11) NOT NULL,
  `FK_NumIngredient` int(11) NOT NULL,
  `QuantiteIngredient` float NOT NULL,
  PRIMARY KEY (`FK_NumeroFiche`,`FK_NumIngredient`),
  Key `FK_composer_FK_NumeroFiche` (`FK_NumeroFiche`),
  key `FK_composer_FK_NumIngredient` (`FK_NumIngredient`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ajouter les FK a la table composer 
ALTER TABLE `composer` 
  ADD CONSTRAINT `FK_composer_FK_NumeroFiche` FOREIGN KEY (`FK_NumeroFiche`) REFERENCES `fichetechnique` (`NumeroFiche`),
  ADD CONSTRAINT `FK_composer_FK_NumIngredient` FOREIGN KEY (`FK_NumIngredient`) REFERENCES `ingredient` (`NumIngredient`);

-- -------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `FK_NumeroFiche` int(11) NOT NULL,
  `FK_NumEtape` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`FK_NumeroFiche`,`FK_NumEtape`,`ordre`),
  key `FK_contenir_FK_NumeroFiche` (`FK_NumeroFiche`),
  key `FK_contenir_FK_NumEtape` (`FK_NumEtape`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ajouter les FK a la table contenir
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_contenir_FK_NumeroFiche` FOREIGN KEY (`FK_NumeroFiche`) REFERENCES `fichetechnique` (`NumeroFiche`),
  ADD CONSTRAINT `FK_contenir_FK_NumEtape` FOREIGN KEY (`FK_NumEtape`) REFERENCES `etape` (`NumEtape`);
-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `NumEtape` int(11) NOT NULL AUTO_INCREMENT,
  `DescriptionEtape` text NOT NULL,
  PRIMARY KEY (`NumEtape`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fichetechnique`
--

DROP TABLE IF EXISTS `fichetechnique`;
CREATE TABLE IF NOT EXISTS `fichetechnique` (
  `NumeroFiche` int(11) NOT NULL AUTO_INCREMENT,
  `NomFiche` varchar(60) NOT NULL,
  `NbreCouverts` int(11) NOT NULL,
  `NomAuteur` varchar(60) NOT NULL,
  `CoutFluide` float NOT NULL,
  `FK_NumeroCatFiche` int(11) NOT NULL,
  `FK_CodeCoeffAss` int(11) NOT NULL,
  `FK_CodeCoeffCoutPersonnel` int(11) NOT NULL,
  PRIMARY KEY (`NumeroFiche`),
  key `FK_fichetechnique_FK_NumeroCatFiche` (`FK_NumeroCatFiche`),
  key `FK_fichetechnique_FK_CodeCoeffAss` (`FK_CodeCoeffAss`),
  key `FK_fichetechnique_FK_CodeCoeffCoutPersonnel` (`FK_CodeCoeffCoutPersonnel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- definir les FK pour la table fichetechnique 
ALTER TABLE `fichetechnique`
  ADD CONSTRAINT `FK_fichetechnique_FK_NumeroCatFiche` FOREIGN KEY (`FK_NumeroCatFiche`) REFERENCES `categorie_fiche` (`NumeroCatFiche`),
  ADD CONSTRAINT `FK_fichetechnique_FK_CodeCoeffAss` FOREIGN KEY (`FK_CodeCoeffAss`) REFERENCES `coeffAss` (`CodeCoeffAss`),
  ADD CONSTRAINT `FK_fichetechnique_FK_CodeCoeffCoutPersonnel` FOREIGN KEY (`FK_CodeCoeffCoutPersonnel`) REFERENCES `coeffCoutPersonnel` (`CodeCoeffCoutPersonnel`);
-- --------------------------------------------------------

--
-- Structure de la table `inclure`
--

DROP TABLE IF EXISTS `inclure`;
CREATE TABLE IF NOT EXISTS `inclure` (
  `FK_NumeroFiche` int(11) NOT NULL,
  `FK_NumeroSousFiche` int(11) NOT NULL,
  `ordre` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`FK_NumeroFiche`,`FK_NumeroSousFiche`,`ordre`),
  key `FK_inclure_FK_NumeroFiche` (`FK_NumeroFiche`),
  key `FK_inclure_FK_NumeroSousFiche` (`FK_NumeroSousFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- les FK de inclure 
ALTER TABLE `inclure`
  ADD CONSTRAINT `FK_inclure_FK_NumeroFiche` FOREIGN KEY (`FK_NumeroFiche`) REFERENCES `fichetechnique` (`NumeroFiche`),
  ADD CONSTRAINT `FK_inclure_FK_NumeroSousFiche` FOREIGN KEY (`FK_NumeroSousFiche`) REFERENCES `fichetechnique` (`NumeroFiche`);
-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `NumIngredient` int(11) NOT NULL AUTO_INCREMENT,
  `NomIng` varchar(60) NOT NULL,
  `prixUnitaireIng` float NOT NULL,
  `QteStockIngredient` float NOT NULL,
  `FK_NumUnite` int(11) NOT NULL,
  `FK_NumAllergene` int(11) NOT NULL,
  `FK_CodeTVA` int(11) NOT NULL,
  `FK_NumCategorie` int(11) NOT NULL,
  PRIMARY KEY (`NumIngredient`),
  key `FK_ingredient_FK_NumUnite` (`FK_NumUnite`),
  key `FK_ingredient_FK_NumAllergene` (`FK_NumAllergene`),
  key `FK_ingredient_FK_CodeTVA` (`FK_CodeTVA`),
  key `FK_ingredient_FK_NumCategorie` (`FK_NumCategorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- les FK pour la table ingredient
ALTER TABLE `ingredient`
  ADD CONSTRAINT `FK_ingredient_FK_NumUnite` FOREIGN KEY (`FK_NumUnite`) REFERENCES `unite` (`NumUnite`),
  ADD CONSTRAINT `FK_ingredient_FK_NumAllergene` FOREIGN KEY (`FK_NumAllergene`) REFERENCES `allergene` (`NumAllergene`),
  ADD CONSTRAINT `FK_ingredient_FK_CodeTVA` FOREIGN KEY (`FK_CodeTVA`) REFERENCES `tva` (`CodeTVA`),
  ADD CONSTRAINT `FK_ingredient_FK_NumCategorie` FOREIGN KEY (`FK_NumCategorie`) REFERENCES `categorie_ingredient` (`NumCategorie`);
-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

DROP TABLE IF EXISTS `tva`;
CREATE TABLE IF NOT EXISTS `tva` (
  `CodeTVA` int(11) NOT NULL AUTO_INCREMENT,
  `NomTVA` varchar(60) NOT NULL,
  `CoefTVA` float NOT NULL,
  PRIMARY KEY (`CodeTVA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `NumUnite` int(11) NOT NULL AUTO_INCREMENT,
  `NomUnite` varchar(10) NOT NULL,
  PRIMARY KEY (`NumUnite`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
