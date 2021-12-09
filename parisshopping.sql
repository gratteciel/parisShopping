-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 09 déc. 2021 à 10:41
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
-- Base de données : `parisshopping`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `numeroVoie` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `rue` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ville` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `codePostal` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `utilisateurId` int(11) NOT NULL,
  PRIMARY KEY (`idAdresse`),
  KEY `RefUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `numeroVoie`, `rue`, `ville`, `codePostal`, `nom`, `prenom`, `utilisateurId`) VALUES
(1, '8', 'villa Caroline', 'Voisins', 78960, 'BUET-ELFASSY', 'Mathis', 4);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE latin1_general_ci,
  `quantite` int(11) NOT NULL,
  `nombreVendu` int(11) NOT NULL,
  `typeArticle` char(1) COLLATE latin1_general_ci NOT NULL,
  `dernierAchat` datetime DEFAULT NULL,
  `articleimmediat` int(11) DEFAULT NULL,
  `vendeurId` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `categorie` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `RefArticleImmediat` (`articleimmediat`),
  KEY `RefVendeurId` (`vendeurId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `description`, `quantite`, `nombreVendu`, `typeArticle`, `dernierAchat`, `articleimmediat`, `vendeurId`, `nom`, `categorie`) VALUES
(1, 'C\'est la giga description', 11, 0, '0', NULL, NULL, 6, 'nvidia GTX 9999', ''),
(2, NULL, 100, 0, '0', NULL, NULL, 1, 'clavier pas fou', '');

-- --------------------------------------------------------

--
-- Structure de la table `articleimmediat`
--

DROP TABLE IF EXISTS `articleimmediat`;
CREATE TABLE IF NOT EXISTS `articleimmediat` (
  `idArticleImmediat` int(11) NOT NULL AUTO_INCREMENT,
  `prixActuel` int(11) NOT NULL,
  `idArticle` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idArticleImmediat`),
  KEY `RefidArticle` (`idArticle`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articleimmediat`
--

INSERT INTO `articleimmediat` (`idArticleImmediat`, `prixActuel`, `idArticle`) VALUES
(1, 900, 1),
(2, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `articleinpanier`
--

DROP TABLE IF EXISTS `articleinpanier`;
CREATE TABLE IF NOT EXISTS `articleinpanier` (
  `idArticleInPanier` int(11) NOT NULL AUTO_INCREMENT,
  `dateAJout` datetime NOT NULL,
  `articleId` int(11) NOT NULL,
  `utilisateurId` int(11) NOT NULL,
  PRIMARY KEY (`idArticleInPanier`),
  KEY `RefArticleId` (`articleId`),
  KEY `RefUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articlelog`
--

DROP TABLE IF EXISTS `articlelog`;
CREATE TABLE IF NOT EXISTS `articlelog` (
  `idArticleLog` int(11) NOT NULL AUTO_INCREMENT,
  `prixAchat` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `commandeLogId` int(11) NOT NULL,
  PRIMARY KEY (`idArticleLog`),
  KEY `RefArticleId` (`articleId`),
  KEY `RefCommandeLogId` (`commandeLogId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandelog`
--

DROP TABLE IF EXISTS `commandelog`;
CREATE TABLE IF NOT EXISTS `commandelog` (
  `idCommandeLog` int(11) NOT NULL AUTO_INCREMENT,
  `dateCommande` datetime NOT NULL,
  `quantiteArticle` int(11) NOT NULL,
  `utilisateurId` int(5) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCommandeLog`),
  KEY `RefUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci,
  `date` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idNotification`),
  KEY `refIdUtilisateur` (`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idPaiement` int(11) NOT NULL AUTO_INCREMENT,
  `typeCarte` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `numeroCarte` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nomCarte` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateExpiration` date NOT NULL,
  `codeSecurite` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `utilisateurId` int(11) NOT NULL,
  PRIMARY KEY (`idPaiement`),
  KEY `RefUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `mdp` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `estAdmin` tinyint(4) NOT NULL,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pseudo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `numTel` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `vendeurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  KEY `refVendeurId` (`vendeurId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mail`, `mdp`, `estAdmin`, `nom`, `prenom`, `pseudo`, `numTel`, `vendeurId`) VALUES
(4, 'test@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 0, 'Miche', 'Jean', 'jean', '', NULL),
(5, 'dimitri@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'Palatov', 'Dimitri', 'dimitri', '', NULL),
(6, 'mathis@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'FOURNOL', 'Mathis', 'mathis', '', NULL),
(7, 'emilian@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'MITU', 'Emilian', 'emilianLEBG', '', NULL),
(8, 'test2@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, '2', 'Test', 'test2', '', NULL),
(9, 'test3@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'te', 'te', 'test3', '', NULL),
(10, 'test42@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 0, 'oui', 'Gilbert', 'Gil', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `idVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurId` int(11) NOT NULL,
  PRIMARY KEY (`idVendeur`),
  KEY `refUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`idVendeur`, `utilisateurId`) VALUES
(1, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
