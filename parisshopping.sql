-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 12 déc. 2021 à 18:53
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
  `utilisateurId` int(11) NOT NULL,
  `pays` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idAdresse`),
  KEY `RefUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `numeroVoie`, `rue`, `ville`, `codePostal`, `nom`, `utilisateurId`, `pays`) VALUES
(27, '8', 'villa Caroline', 'Voisins-le-Bretonneux', 78960, 'Mathis BUET', 4, 'France'),
(28, '4', 'lieu dit Maintelon', 'Denée', 49190, 'EMILIAN MOTU', 4, 'Pays pommer'),
(40, '8 ', 'villa', 'Paris', 75000, 'mathis', 6, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `adresselog`
--

DROP TABLE IF EXISTS `adresselog`;
CREATE TABLE IF NOT EXISTS `adresselog` (
  `idAdresseLog` int(11) NOT NULL AUTO_INCREMENT,
  `numeroVoie` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `rue` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ville` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `codePostal` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `idCommandeLog` int(11) DEFAULT NULL,
  `pays` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idAdresseLog`),
  KEY `RefidCommandeLog` (`idCommandeLog`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `adresselog`
--

INSERT INTO `adresselog` (`idAdresseLog`, `numeroVoie`, `rue`, `ville`, `codePostal`, `nom`, `idCommandeLog`, `pays`) VALUES
(103, '8', 'villa Caroline', 'Voisins-le-Bretonneux', 78960, 'Mathis BUET', 58, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `alertestock`
--

DROP TABLE IF EXISTS `alertestock`;
CREATE TABLE IF NOT EXISTS `alertestock` (
  `idAlerte` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAlerte`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alertestock`
--

INSERT INTO `alertestock` (`idAlerte`, `idArticle`, `idUtilisateur`) VALUES
(76, 4, 4),
(89, 3, 4),
(83, 17, 4),
(92, 14, 4),
(99, 15, 4);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE latin1_general_ci,
  `nombreVendu` int(11) NOT NULL,
  `vendeurId` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `categorie` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `photoPrincipale` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `idArticleImmediat` int(11) DEFAULT NULL,
  `idArticleEnchere` int(11) DEFAULT NULL,
  `idArticleNegociation` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `RefVendeurId` (`vendeurId`),
  KEY `RefidArticleImmediat` (`idArticleImmediat`),
  KEY `RefidArticleEnchere` (`idArticleEnchere`),
  KEY `RefidArticleNegociation` (`idArticleNegociation`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `description`, `nombreVendu`, `vendeurId`, `nom`, `categorie`, `photoPrincipale`, `idArticleImmediat`, `idArticleEnchere`, `idArticleNegociation`) VALUES
(15, 'Créez, contrôlez et affirmez votre style de jeu avec la nouvelle souris Razer Basilisk V3, la quintessence de la souris gaming ergonomique à performances personnalisables. Avec 11 boutons programmables, une molette de défilement intelligente et une forte dose de Razer Chroma RGB, il est temps d’éclairer la concurrence avec votre style.', 2, 9, 'Razer Basilisk V3', 'régulier', 'images_articles/Razer_basilisk.jpg', 15, NULL, NULL),
(16, 'Le NVIDIA A30 Tensor Core est le GPU de calcul grand public le plus polyvalent pour l\'inférence de l\'IA et les charges de travail des entreprises grand public. Alimenté par la technologie Tensor Core de l\'architecture NVIDIA Ampere, il prend en charge un large éventail de précisions mathématiques.', 0, 1, 'Nvidia A30', 'rare', 'images_articles/Nvidia_A30.jpg', NULL, NULL, 2),
(17, 'Vous recherchez une souris simple, fiable et dotée de la technologie sans fil prête à l\'emploi ? Alors la Logitech Wireless Mouse M185 est faite pour vous ! Profitez de la fiabilité d\'un dispositif filaire, mais avec la liberté et la commodité de la technologie sans fil...', 0, 9, 'Souris Logitech M185', 'régulier', 'images_articles/Logitech_M185.jpg', 17, NULL, NULL),
(18, 'Travaillez où que Vous Soyez : Vous profitez d\'un contrôle précis du curseur, quel que soit l\'endroit où vous utilisez votre trackball. Les tables massives, les canapés confortables et les lits moelleux ne représentent aucun obstacle pour le trackball M570 !', 1, 1, 'Logitech Trackball', 'rare', 'images_articles/Logitech_Trackball.jpg', 18, NULL, NULL),
(19, 'Le Vivobook S14 a évolué : plus léger, plus puissant ! (i5, RAM 8Go, 512 Go SSD)\r\nAvec ses bords soigneusement découpés au diamant et son élégant châssis métallique, le VivoBook S14 fait ressortir ce qu\'il y a d\'unique en vous. ', 2, 1, 'Asus Vivobook S14 ', 'haut de gamme', 'images_articles/Asus_Vivobook.jpg', 19, NULL, NULL),
(20, 'Nouvelle architecture GPU NVIDIA Turing et plate-forme RTX avec entrainement en temps réel pour une expérience de jeu ultime : tracing en temps réel, NVIDIA G-SYNC compatible, HDMI 2.0', 0, 9, 'KFA2 GeForce RTX 2060', 'régulier', 'images_articles/KFA2_2060.jpg', 20, NULL, NULL),
(3, 'Processeur Intel de dernière génération, possédant 10 coeurs et intégrant la technologie hybride.', 1, 1, 'Intel Core I5', 'régulier', 'images_articles/Intel_I5.jpg', 3, NULL, NULL),
(4, 'Processeur Intel de 12e génération, comportant 12 coeurs, de fréquence max 5GHz. Pour ceux qui veulent de la vitesse d\'exécution.', 1, 9, 'Intel Core I7', 'haut de gamme', 'images_articles/Intel_I7.jpg', 4, NULL, NULL),
(5, 'La rolls des processeurs. Processeur 16 coeurs, sans aucune concession. Attention cet article est rare, les quantités sont limitées!', 10, 1, 'Intel Core I9', 'rare', 'images_articles/Intel_I9.jpg', NULL, NULL, 1),
(6, 'L\'AMD Ryzen 3 1200 AF est un processeur 4 coeurs abordable, doté d\'un bon rapport qualité prix.', 0, 1, 'AMD Ryzen 3 1200 AF', 'régulier', 'images_articles/AMD_Ryzen_3.jpg', 6, NULL, NULL),
(7, 'Corsair Vengeance RGB PRO Series 16 Go en DDR4 2x 8 Go fort potentiel d\'overclocking', 0, 1, 'RAM Corsair 16 Go', 'régulier', 'images_articles/Barrettes_RAM_Corsair_16Go.jpg', 7, NULL, NULL),
(8, 'Supprimez tous les obstacles sur le chemin de la victoire grâce à la souris PRO la plus légère et la plus rapide jamais produite. Souris conçue pour les habiles du poigné.', 1, 9, 'Logitech G PRO X', 'haut de gamme', 'images_articles/Logitech_GPROX.jpg', 8, NULL, NULL),
(9, 'Casque de Jeu Filaire multiplateforme pour PC, PS4, Xbox One et Switch, avec commandes en ligne, de type supra-auriculaire (chauffe les oreilles). Le microphone unidirectionnel vous permet de communiquer avec votre équipe dans un son clair comme de l\'eau de roche.', 0, 1, 'Razer Kraken', 'régulier', 'images_articles/Razer_Kraken.jpg', 9, NULL, NULL),
(10, 'Ecran PC Samsung avec dalle incurvée, 24 pouces, taux de rafraîchissement de 144 Hz, noir brillant, possédant un temps de réponse de 4 ms. Ecran immersif, donne l\'impression d\'être au cinéma.', 0, 1, 'Ecran incurvé Samsung', 'haut de gamme', 'images_articles/Ecran_Samsung_Incurve.jpg', NULL, 2, NULL),
(11, 'Moniteur Samsung Curvo Gaming 49\", noir, format 32:9, taille démesurée. Si vous voulez vous abimer les yeux, n\'hésitez surtout pas.', 0, 9, 'Ecran large Samsung', 'rare', 'images_articles/Ecran_Samsung_Large.jpg', 11, NULL, NULL),
(12, 'Asus ROG Strix PC Portable gamer, processeur AMD Ryzen 7, 16 Go RAM, SSD 512 Go, TRX 3050, clavier AZERTY, 15.6\", option sapin de Noël.', 0, 9, 'ASUS Rog Strix', 'haut de gamme', 'images_articles/Asus_Rog_Strix.jpg', 12, NULL, NULL),
(13, 'PC haut de gamme en série limitée, processeur Intel Core I9, 32 Go de RAM, Nvidia RTX 3080, SSD 2 To. Pour ceux qui en ont les moyens, ce PC est un produit rare, dépêchez-vous!', 1, 9, 'MSI Gaming GE66 Raider', 'rare', 'images_articles/MSI_GE66_Raider.jpg', NULL, 1, NULL),
(14, 'PC Portable Alienware AMD Ryzen R7 5800H, 15.6\", full HD 165 Hz, 16 Go RAM SSD 512 Go', 9, 1, 'Alienware m15 r5', 'rare', 'images_articles/Alienware_M15_R5.jpg', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `articleenchere`
--

DROP TABLE IF EXISTS `articleenchere`;
CREATE TABLE IF NOT EXISTS `articleenchere` (
  `idArticleEnchere` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idArticle` int(11) NOT NULL,
  `fini` tinyint(4) NOT NULL DEFAULT '0',
  `prixDepart` int(11) NOT NULL,
  PRIMARY KEY (`idArticleEnchere`),
  KEY `RefidArticle` (`idArticle`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articleenchere`
--

INSERT INTO `articleenchere` (`idArticleEnchere`, `dateDebut`, `dateFin`, `idArticle`, `fini`, `prixDepart`) VALUES
(2, '2021-12-10', '2021-12-14', 10, 0, 800),
(1, '2021-12-10', '2021-12-20', 13, 0, 700);

-- --------------------------------------------------------

--
-- Structure de la table `articleimmediat`
--

DROP TABLE IF EXISTS `articleimmediat`;
CREATE TABLE IF NOT EXISTS `articleimmediat` (
  `idArticleImmediat` int(11) NOT NULL AUTO_INCREMENT,
  `prixActuel` int(11) NOT NULL,
  `idArticle` int(10) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idArticleImmediat`),
  KEY `RefidArticle` (`idArticle`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articleimmediat`
--

INSERT INTO `articleimmediat` (`idArticleImmediat`, `prixActuel`, `idArticle`, `quantite`) VALUES
(20, 600, 20, 12),
(19, 599, 19, 87),
(18, 64, 18, 12),
(17, 20, 17, 32),
(15, 80, 15, 1),
(14, 1600, 14, 4),
(12, 1400, 12, 9),
(11, 900, 11, 1),
(9, 45, 9, 20),
(8, 130, 8, 43),
(7, 100, 7, 20),
(6, 80, 6, 32),
(4, 500, 4, 24),
(3, 350, 3, 86),
(2, 10, 2, 3),
(1, 900, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articleinpanier`
--

INSERT INTO `articleinpanier` (`idArticleInPanier`, `dateAJout`, `articleId`, `utilisateurId`) VALUES
(62, '2021-12-09 19:48:34', 3, 11);

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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articlelog`
--

INSERT INTO `articlelog` (`idArticleLog`, `prixAchat`, `articleId`, `commandeLogId`) VALUES
(53, 80, 15, 58);

-- --------------------------------------------------------

--
-- Structure de la table `articlenegociation`
--

DROP TABLE IF EXISTS `articlenegociation`;
CREATE TABLE IF NOT EXISTS `articlenegociation` (
  `idArticleNegociation` int(11) NOT NULL AUTO_INCREMENT,
  `prixBase` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `fini` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idArticleNegociation`),
  KEY `RefidArticle` (`idArticle`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articlenegociation`
--

INSERT INTO `articlenegociation` (`idArticleNegociation`, `prixBase`, `idArticle`, `fini`) VALUES
(2, 8000, 16, 0),
(1, 750, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commandelog`
--

DROP TABLE IF EXISTS `commandelog`;
CREATE TABLE IF NOT EXISTS `commandelog` (
  `idCommandeLog` int(11) NOT NULL AUTO_INCREMENT,
  `dateCommande` datetime NOT NULL,
  `utilisateurId` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `idAdresseLog` int(11) NOT NULL,
  `idPaiementLog` int(11) NOT NULL,
  PRIMARY KEY (`idCommandeLog`),
  KEY `RefUtilisateurId` (`utilisateurId`),
  KEY `RefidAdresseLog` (`idAdresseLog`),
  KEY `RefidPaiementLog` (`idPaiementLog`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `commandelog`
--

INSERT INTO `commandelog` (`idCommandeLog`, `dateCommande`, `utilisateurId`, `idAdresseLog`, `idPaiementLog`) VALUES
(58, '2021-12-12 19:51:17', 4, 103, 116);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `idEnchere` int(11) NOT NULL AUTO_INCREMENT,
  `prixMax` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idArticleEnchere` int(11) NOT NULL,
  `idPaiementLog` int(11) NOT NULL,
  `idAdresseLog` int(11) NOT NULL,
  PRIMARY KEY (`idEnchere`),
  KEY `RefidUtilisateur` (`idUtilisateur`),
  KEY `RefidArticleEnchere` (`idArticleEnchere`),
  KEY `RefidPaiementLog` (`idPaiementLog`),
  KEY `RefidAdresseLog` (`idAdresseLog`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `negociation`
--

DROP TABLE IF EXISTS `negociation`;
CREATE TABLE IF NOT EXISTS `negociation` (
  `idNegociation` int(11) NOT NULL AUTO_INCREMENT,
  `prixUser` int(11) NOT NULL,
  `contreOffre` int(11) DEFAULT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '0',
  `traiter` tinyint(4) NOT NULL DEFAULT '0',
  `idPaiementLog` int(11) NOT NULL,
  `idAdresseLog` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idArticleNegociation` int(11) NOT NULL,
  `dateNegocUser` datetime NOT NULL,
  PRIMARY KEY (`idNegociation`),
  KEY `RefidPaiementLog` (`idPaiementLog`),
  KEY `RefidAdresseLog` (`idAdresseLog`),
  KEY `RefidUtilisateur` (`idUtilisateur`),
  KEY `RefidArticleNegociation` (`idArticleNegociation`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descriptionNotif` text COLLATE latin1_general_ci,
  `dateNotif` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `vu` tinyint(4) NOT NULL DEFAULT '0',
  `lien` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idNotification`),
  KEY `refIdUtilisateur` (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=279 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`idNotification`, `nom`, `descriptionNotif`, `dateNotif`, `idUtilisateur`, `vu`, `lien`) VALUES
(278, 'Vendeur - modification articles', 'Vous avez bien modifié les articles que vous vendez', '2021-12-12 19:51:50', 6, 0, 'vendeur&affichage=block&ou=1'),
(277, 'Alerte stock - Disponible ', 'Razer Basilisk V3 est enfin disponible', '2021-12-12 19:51:50', 4, 1, 'article&id=15'),
(276, 'Commande', 'Votre commande (Ref: 58) a bien été pris en compte', '2021-12-12 19:51:17', 4, 1, 'commande&id=58'),
(275, 'Alerte stock - Rupture ', 'Razer Basilisk V3 est en rupture de stock', '2021-12-12 19:51:17', 4, 1, 'article&id=15');

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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idPaiement`, `typeCarte`, `numeroCarte`, `nomCarte`, `dateExpiration`, `codeSecurite`, `utilisateurId`) VALUES
(12, 'Visa', '1234123412341234', 'Mathis BUET', '2021-12-31', '234', 4),
(41, 'Visa', '1111111111111111', 'TEST', '2022-01-02', '234', 6),
(40, 'Visa', '2222222222222222', 'YEEE', '2021-12-26', '234', 11);

-- --------------------------------------------------------

--
-- Structure de la table `paiementlog`
--

DROP TABLE IF EXISTS `paiementlog`;
CREATE TABLE IF NOT EXISTS `paiementlog` (
  `idPaiementLog` int(11) NOT NULL AUTO_INCREMENT,
  `typeCarte` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `numeroCarte` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nomCarte` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateExpiration` date NOT NULL,
  `codeSecurite` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `idCommandeLog` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPaiementLog`),
  KEY `RefidCommandeLog` (`idCommandeLog`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `paiementlog`
--

INSERT INTO `paiementlog` (`idPaiementLog`, `typeCarte`, `numeroCarte`, `nomCarte`, `dateExpiration`, `codeSecurite`, `idCommandeLog`) VALUES
(116, 'Visa', '1234123412341234', 'Mathis BUET', '2021-12-31', '234', 58);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idPhoto` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `idLiaisonTable` int(11) NOT NULL,
  PRIMARY KEY (`idPhoto`),
  KEY `RefidLiaisonTable` (`idLiaisonTable`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `lien`, `idLiaisonTable`) VALUES
(7, 'images_articles/Ryzen_V2.jpg', 6),
(6, 'images_articles/I9_V3.jpg', 5),
(5, 'images_articles/I9_V2.jpg', 5),
(4, 'images_articles/I7_V3.jpg', 4),
(3, 'images_articles/I7_V2.jpg', 4),
(2, 'images_articles/I5_V3.jpg', 3),
(1, 'images_articles/I5_V2.jpg\r\n', 3),
(8, 'images_articles/Ryzen_V3.jpg', 6),
(9, 'images_articles/Ram_V2.jpg', 7),
(10, 'images_articles/Ram_V3.jpg', 7),
(11, 'images_articles/Gpro_V2.jpg', 8),
(12, 'images_articles/Gpro_V3.jpg', 8),
(13, 'images_articles/Kraken_V2.jpg', 9),
(14, 'images_articles/Kraken_V3.jpg', 9),
(15, 'images_articles/Incurve_V2.jpg', 10),
(16, 'images_articles/Incurvé_V3.jpg', 10),
(17, 'images_articles/Large_V2.jpg', 11),
(18, 'images_articles/Large_V3.jpg', 11),
(19, 'images_articles/ROG_V2.jpg', 12),
(20, 'images_articles/ROG_V3.jpg', 12),
(21, 'images_articles/MSI_V2.jpg', 13),
(22, 'images_articles/MSI_V3.jpg', 13),
(23, 'images_articles/M15_V2.jpg', 14),
(24, 'images_articles/Trackball_V2.jpg', 18),
(25, 'images_articles/basilisk_V2.jpg', 15),
(26, 'images_articles/Basilisk_V3.jpg', 15),
(27, 'images_articles/A30_V2.jpg', 16),
(28, 'images_articles/M185_V2.jpg', 17),
(29, 'images_articles/M185_V3.jpg', 17),
(30, 'images_articles/Vivo_V2.jpg', 19),
(31, 'images_articles/Vivo_V3.jpg', 19),
(32, 'images_articles/KFA_V2.jpg', 20),
(33, 'images_articles/KFA_V3.jpg', 20);

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
  `clocheNotifs` tinyint(4) NOT NULL DEFAULT '0',
  `estVendeur` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`),
  KEY `refVendeurId` (`vendeurId`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mail`, `mdp`, `estAdmin`, `nom`, `prenom`, `pseudo`, `numTel`, `vendeurId`, `clocheNotifs`, `estVendeur`) VALUES
(4, 'test@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 1, 'Miche', 'Jean', 'jean', '', 1, 0, 1),
(5, 'dimitri@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'Palatov', 'Dimitri', 'dimitri', '', NULL, 0, 0),
(6, 'mathis@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'FOURNOL', 'Mathis', 'mathis', '', 9, 0, 1),
(7, 'emilian@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'MITU', 'Emilian', 'emilianLEBG', '', NULL, 0, 0),
(8, 'test2@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, '2', 'Test', 'test2', '', NULL, 0, 0),
(9, 'test3@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'te', 'te', 'test3', '', NULL, 0, 0),
(10, 'test42@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 0, 'oui', 'Gilbert', 'Gil', '', NULL, 0, 0),
(11, 'test@hotmail.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'tt', 'Sl', 'salutation', '', NULL, 0, 0),
(13, 'jimmy@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'Fallon', 'Jimmy', 'Jimmy', '', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `idVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurId` int(11) NOT NULL,
  `photoVendeur` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idVendeur`),
  KEY `refUtilisateurId` (`utilisateurId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`idVendeur`, `utilisateurId`, `photoVendeur`) VALUES
(1, 4, 'images_vendeur/tete_coupe.jpg'),
(9, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `idVideo` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `idLiaisonTable` int(11) NOT NULL,
  PRIMARY KEY (`idVideo`),
  KEY `RefidLiaisonTable` (`idLiaisonTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
