-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 oct. 2021 à 12:16
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
  `NuméroCatFiche` int(11) NOT NULL AUTO_INCREMENT,
  `NomCatFiche` varchar(20) NOT NULL,
  PRIMARY KEY (`NuméroCatFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_ingredient`
--

DROP TABLE IF EXISTS `categorie_ingredient`;
CREATE TABLE IF NOT EXISTS `categorie_ingredient` (
  `NumCatégorie` int(11) NOT NULL AUTO_INCREMENT,
  `NomCatégorie` varchar(20) NOT NULL,
  PRIMARY KEY (`NumCatégorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `coefficient`
--

DROP TABLE IF EXISTS `coefficient`;
CREATE TABLE IF NOT EXISTS `coefficient` (
  `CodeCoeff` int(11) NOT NULL AUTO_INCREMENT,
  `valeurCoefficient` float NOT NULL,
  PRIMARY KEY (`CodeCoeff`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `FK_NuméroFiche` int(11) NOT NULL,
  `FK_NumIngrédient` int(11) NOT NULL,
  `QuantitéIngrédient` float NOT NULL,
  PRIMARY KEY (`FK_NuméroFiche`,`FK_NumIngrédient`),
  Key `FK_composer_FK_NuméroFiche` (`FK_NuméroFiche`),
  key `FK_composer_FK_NumIngrédient` (`FK_NumIngrédient`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ajouter les FK a la table composer 
ALTER TABLE `composer` 
  ADD CONSTRAINT `FK_composer_FK_NuméroFiche` FOREIGN KEY (`FK_NuméroFiche`) REFERENCES `fichetechnique` (`NuméroFiche`),
  ADD CONSTRAINT `FK_composer_FK_NumIngrédient` FOREIGN KEY (`FK_NumIngrédient`) REFERENCES `ingredient` (`NumIngrédient`);

-- -------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `FK_NuméroFiche` int(11) NOT NULL,
  `FK_NumEtape` int(11) NOT NULL,
  PRIMARY KEY (`FK_NuméroFiche`,`FK_NumEtape`),
  key `FK_contenir_FK_NuméroFiche` (`FK_NuméroFiche`),
  key `FK_contenir_FK_NumEtape` (`FK_NumEtape`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ajouter les FK a la table contenir
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_contenir_FK_NuméroFiche` FOREIGN KEY (`FK_NuméroFiche`) REFERENCES `fichetechnique` (`NuméroFiche`),
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
  `NuméroFiche` int(11) NOT NULL AUTO_INCREMENT,
  `NomFiche` varchar(60) NOT NULL,
  `NbreCouverts` int(11) NOT NULL,
  `NomAuteur` varchar(60) NOT NULL,
  `CoutFluide` float NOT NULL,
  `FK_NuméroCatFiche` int(11) NOT NULL,
  PRIMARY KEY (`NuméroFiche`),
  key `FK_fichetechnique_FK_NuméroCatFiche` (`FK_NuméroCatFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- definir les FK pour la table fichetechnique 
ALTER TABLE `fichetechnique`
  ADD CONSTRAINT `FK_fichetechnique_FK_NuméroCatFiche` FOREIGN KEY (`FK_NuméroCatFiche`) REFERENCES `categorie_fiche` (`NuméroCatFiche`);
-- --------------------------------------------------------

--
-- Structure de la table `inclure`
--

DROP TABLE IF EXISTS `inclure`;
CREATE TABLE IF NOT EXISTS `inclure` (
  `FK_NuméroFiche` int(11) NOT NULL,
  `FK_NuméroSousFiche` int(11) NOT NULL,
  PRIMARY KEY (`FK_NuméroFiche`,`FK_NuméroSousFiche`),
  key `FK_inclure_FK_NuméroFiche` (`FK_NuméroFiche`),
  key `FK_inclure_FK_NuméroSousFiche` (`FK_NuméroSousFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- les FK de inclure 
ALTER TABLE `inclure`
  ADD CONSTRAINT `FK_inclure_FK_NuméroFiche` FOREIGN KEY (`FK_NuméroFiche`) REFERENCES `fichetechnique` (`NuméroFiche`),
  ADD CONSTRAINT `FK_inclure_FK_NuméroSousFiche` FOREIGN KEY (`FK_NuméroSousFiche`) REFERENCES `fichetechnique` (`NuméroFiche`);
-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `NumIngrédient` int(11) NOT NULL AUTO_INCREMENT,
  `NomIng` varchar(60) NOT NULL,
  `prixUnitaireIng` float NOT NULL,
  `QtéStockIngrédient` float NOT NULL,
  `FK_NumUnité` int(11) NOT NULL,
  `FK_NumAllergene` int(11) NOT NULL,
  `FK_CodeTVA` int(11) NOT NULL,
  `FK_NumCatégorie` int(11) NOT NULL,
  PRIMARY KEY (`NumIngrédient`),
  key `FK_ingredient_FK_NumUnité` (`FK_NumUnité`),
  key `FK_ingredient_FK_NumAllergene` (`FK_NumAllergene`),
  key `FK_ingredient_FK_CodeTVA` (`FK_CodeTVA`),
  key `FK_ingredient_FK_NumCatégorie` (`FK_NumCatégorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- les FK pour la table ingrédient
ALTER TABLE `ingredient`
  ADD CONSTRAINT `FK_ingredient_FK_NumUnité` FOREIGN KEY (`FK_NumUnité`) REFERENCES `unite` (`NumUnité`),
  ADD CONSTRAINT `FK_ingredient_FK_NumAllergene` FOREIGN KEY (`FK_NumAllergene`) REFERENCES `allergene` (`NumAllergene`),
  ADD CONSTRAINT `FK_ingredient_FK_CodeTVA` FOREIGN KEY (`FK_CodeTVA`) REFERENCES `tva` (`CodeTVA`),
  ADD CONSTRAINT `FK_ingredient_FK_NumCatégorie` FOREIGN KEY (`FK_NumCatégorie`) REFERENCES `categorie_ingredient` (`NumCatégorie`);
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
  `NumUnité` int(11) NOT NULL AUTO_INCREMENT,
  `NomUnité` varchar(10) NOT NULL,
  PRIMARY KEY (`NumUnité`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

DROP TABLE IF EXISTS `utiliser`;
CREATE TABLE IF NOT EXISTS `utiliser` (
  `FK_CodeCoeff` int(11) NOT NULL,
  `FK_NuméroFiche` int(11) NOT NULL,
  PRIMARY KEY (`FK_CodeCoeff`,`FK_NuméroFiche`),
  key `FK_utiliser_FK_CodeCoeff` (`FK_CodeCoeff`),
  key `FK_utiliser_FK_NuméroFiche` (`FK_NuméroFiche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- les FK pour la table utiliser
ALTER TABLE `utiliser`
  ADD CONSTRAINT `FK_utiliser_FK_CodeCoeff` FOREIGN KEY (`FK_CodeCoeff`) REFERENCES `coefficient` (`CodeCoeff`),
  ADD CONSTRAINT `FK_utiliser_FK_NuméroFiche` FOREIGN KEY (`FK_NuméroFiche`) REFERENCES `fichetechnique` (`NuméroFiche`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
