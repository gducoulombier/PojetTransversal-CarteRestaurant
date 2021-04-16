-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 avr. 2021 à 15:28
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
-- Base de données : `aventix`
--

-- --------------------------------------------------------

--
-- Structure de la table `cartes`
--

DROP TABLE IF EXISTS `cartes`;
CREATE TABLE IF NOT EXISTS `cartes` (
  `idCarte` int(11) NOT NULL AUTO_INCREMENT,
  `idEmploye` int(11) NOT NULL,
  `idEmployeur` int(11) NOT NULL,
  PRIMARY KEY (`idCarte`),
  KEY `idEmploye` (`idEmploye`),
  KEY `idEmployeur` (`idEmployeur`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cartes`
--

INSERT INTO `cartes` (`idCarte`, `idEmploye`, `idEmployeur`) VALUES
(1, 1, 1),
(2, 0, 9),
(3, 5, 9),
(4, 0, 9),
(5, 0, 9),
(6, 0, 9),
(7, 0, 9),
(8, 0, 9),
(9, 0, 9),
(10, 0, 9),
(11, 0, 9),
(12, 4, 9),
(13, 0, 9),
(14, 0, 9),
(15, 0, 9),
(16, 0, 9),
(17, 0, 9),
(18, 0, 9),
(19, 0, 9),
(20, 0, 9),
(21, 0, 9),
(22, 0, 9);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idEmployeur` int(11) NOT NULL,
  `nbCartes` int(11) NOT NULL,
  `dateCommande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCommande`),
  KEY `idEmployeur` (`idEmployeur`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `idEmployeur`, `nbCartes`, `dateCommande`) VALUES
(1, 9, 2, '2021-03-30 20:35:00'),
(2, 9, 2, '2021-03-30 20:35:44'),
(3, 9, 2, '2021-03-30 20:37:05'),
(4, 9, 2, '2021-03-30 20:37:39'),
(5, 9, 2, '2021-03-30 20:42:58'),
(6, 9, 3, '2021-03-30 20:45:05'),
(7, 9, 3, '2021-03-30 20:45:38'),
(8, 9, 3, '2021-03-30 20:46:33'),
(9, 9, 1, '2021-03-30 20:48:00'),
(10, 9, 2, '2021-03-30 20:48:41'),
(11, 9, 1, '2021-03-30 20:51:49'),
(12, 9, 2, '2021-03-30 20:52:48'),
(13, 9, 2, '2021-03-30 20:52:50');

-- --------------------------------------------------------

--
-- Structure de la table `commercant`
--

DROP TABLE IF EXISTS `commercant`;
CREATE TABLE IF NOT EXISTS `commercant` (
  `idCommercant` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `SIRET` int(11) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `RIB` varchar(100) NOT NULL,
  PRIMARY KEY (`idCommercant`),
  KEY `Email` (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `typeCompte` varchar(255) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`Email`, `password`, `typeCompte`) VALUES
('toto3@insa.fr', '$2y$12$6lH1LKkUT9O7J0ANPm4AOOI03Af11KJDQPwXKpk.ubE0zdsTR.TEy', 'employe'),
('guillaume@insa.fr', '$2y$12$rGJV1D0NALGZmS5nwu/5BOoe49eAOP52GkHR084OnOzjWQ4X.DHsi', 'employe'),
('julien@insa.fr', '$2y$12$00BNZUxNBBi3xOoGpu3mK.Iz3O.R6eVk/hHUhgl9i8WnCjxP1NOve', 'employe'),
('toto@insa.fr', '$2y$12$M9EaR4opMysoX7gSudwjnOXQsYXmpCvy1s3x7R8yQbzFJmRe0ihCW', 'employe'),
('toto2@insa.fr', '$2y$12$EMcAOZB3bqSf69alPx4fKO1OAC8mOaGsNwS0169p33f2CCM9BTkxy', 'employe');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `idEmploye` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Adresse` varchar(200) NOT NULL,
  `DateNaissance` date NOT NULL,
  `RIB` varchar(100) NOT NULL,
  `SoldeCompte` decimal(10,0) NOT NULL,
  `DatePrelevement` date NOT NULL,
  `PourcentageEmployeur` int(11) NOT NULL,
  PRIMARY KEY (`idEmploye`),
  KEY `Email` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`idEmploye`, `Email`, `Nom`, `Adresse`, `DateNaissance`, `RIB`, `SoldeCompte`, `DatePrelevement`, `PourcentageEmployeur`) VALUES
(4, 'julien@insa.fr', 'julien', 'ldifjodsjfo', '2021-03-29', 'FR76 1234 1234 1234 1234 123', '0', '2021-03-29', 20),
(3, 'guillaume@insa.fr', 'DUCOULOMBIER', '12 Rue de la ville', '1997-01-01', 'FR76 1234 1234 1234 1234 123', '0', '2021-03-23', 20),
(5, 'toto3@insa.fr', 'toto', 'totoville', '2021-03-30', 'FR76 1234 1234 1234 1234 123', '0', '2021-03-30', 20);

-- --------------------------------------------------------

--
-- Structure de la table `employeur`
--

DROP TABLE IF EXISTS `employeur`;
CREATE TABLE IF NOT EXISTS `employeur` (
  `idEmployeur` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `NomEntreprise` varchar(100) NOT NULL,
  `Adresse` varchar(200) NOT NULL,
  `SIRET` varchar(100) NOT NULL,
  `RIB` varchar(100) NOT NULL,
  `PourcentageDefaut` int(2) NOT NULL DEFAULT '20',
  `DatePrelevement` date NOT NULL,
  PRIMARY KEY (`idEmployeur`),
  KEY `Email` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employeur`
--

INSERT INTO `employeur` (`idEmployeur`, `Email`, `NomEntreprise`, `Adresse`, `SIRET`, `RIB`, `PourcentageDefaut`, `DatePrelevement`) VALUES
(9, 'julien@insa.fr', 'employe', 'valence', 'mefosdjoif', 'FR76 1234 1234 1234 1234 123', 20, '2021-03-31'),
(8, 'julien@insa.fr', 'employe', 'valence', 'mefosdjoif', 'FR76 1234 1234 1234 1234 123', 20, '2021-03-31'),
(7, 'julien@insa.fr', 'employe', 'valence', 'mefosdjoif', 'FR76 1234 1234 1234 1234 123', 20, '2021-03-31'),
(1, 'employeur@insa.fr', 'insa', 'insa, 69 Lyon', '123456789123', 'FR76 1234 5678 1234 5678 123', 20, '2021-04-05'),
(10, 'julien@insa.fr', 'employe', 'valence', 'mefosdjoif', 'FR76 1234 1234 1234 1234 123', 20, '2021-03-31');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `idFacture` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) NOT NULL,
  `Montant` int(11) NOT NULL,
  PRIMARY KEY (`idFacture`),
  KEY `idCommande` (`idCommande`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`idFacture`, `idCommande`, `Montant`) VALUES
(1, 12, 10),
(2, 13, 10);

-- --------------------------------------------------------

--
-- Structure de la table `terminal`
--

DROP TABLE IF EXISTS `terminal`;
CREATE TABLE IF NOT EXISTS `terminal` (
  `idTerminal` int(11) NOT NULL AUTO_INCREMENT,
  `idCommercant` int(11) NOT NULL,
  PRIMARY KEY (`idTerminal`),
  KEY `idCommercant` (`idCommercant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `idTransaction` int(11) NOT NULL AUTO_INCREMENT,
  `idCarte` int(11) NOT NULL,
  `idTerminal` int(11) NOT NULL,
  `Montant` decimal(10,0) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`idTransaction`),
  KEY `idCarte` (`idCarte`),
  KEY `idCommercant` (`idTerminal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
