-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 12 avr. 2021 à 13:56
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
-- Base de données : `banque`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `RIB` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Solde` decimal(65,0) NOT NULL,
  PRIMARY KEY (`RIB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `virementauto`
--

DROP TABLE IF EXISTS `virementauto`;
CREATE TABLE IF NOT EXISTS `virementauto` (
  `IdVirement` int(255) NOT NULL,
  `echeance` int(255) NOT NULL,
  `Montant` decimal(65,0) NOT NULL,
  `RIBEmetteur` varchar(255) NOT NULL,
  `RIBRecepteur` varchar(255) NOT NULL,
  PRIMARY KEY (`IdVirement`),
  KEY `RIB` (`RIBEmetteur`,`RIBRecepteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `virementmanu`
--

DROP TABLE IF EXISTS `virementmanu`;
CREATE TABLE IF NOT EXISTS `virementmanu` (
  `IdVirement` int(255) NOT NULL,
  `echeance` int(255) NOT NULL,
  `Montant` decimal(65,0) NOT NULL,
  `RIBEmetteur` varchar(255) NOT NULL,
  `RIBRecepteur` varchar(255) NOT NULL,
  PRIMARY KEY (`IdVirement`),
  KEY `RIB` (`RIBEmetteur`,`RIBRecepteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
