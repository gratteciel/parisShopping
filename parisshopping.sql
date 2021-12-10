-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 déc. 2021 à 13:49
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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `numeroVoie`, `rue`, `ville`, `codePostal`, `nom`, `utilisateurId`, `pays`) VALUES
(17, 'f', 'f', 'f', 23, 'f', 11, 'f'),
(29, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 4, 'France'),
(27, '8', 'villa Caroline', 'Voisins-le-Bretonneux', 78960, 'Mathis BUET', 4, 'France'),
(28, '4', 'lieu dit Maintelon', 'Denée', 0, 'EMILIAN MOTU', 4, 'Pays pommer'),
(30, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 4, 'France'),
(31, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 4, 'France'),
(32, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 4, 'France'),
(33, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 4, 'France'),
(34, '8', 'villa', 'Paris', 75015, 'Matoush', 4, 'France'),
(35, '8', 'villa Caro', 'Voisinssdff', 78960, 'Mathis LE BG', 4, 'France');

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `adresselog`
--

INSERT INTO `adresselog` (`idAdresseLog`, `numeroVoie`, `rue`, `ville`, `codePostal`, `nom`, `idCommandeLog`, `pays`) VALUES
(35, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 32, 'France'),
(34, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 31, 'France'),
(33, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 30, 'France'),
(32, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 29, 'France'),
(31, '13', 'rue OUI', 'Paris', 75000, 'Mathis', 28, 'France'),
(30, '8', 'villa Caroline', 'Voisins-le-Bretonneux', 78960, 'Mathis BUET', 27, 'France'),
(29, '8', 'villa Caroline', 'Voisins-le-Bretonneux', 78960, 'Mathis BUET', 26, 'France'),
(28, '8', 'villa Caroline', 'Voisins-le-Bretonneux', 78960, 'Mathis BUET', 25, 'France');

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
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alertestock`
--

INSERT INTO `alertestock` (`idAlerte`, `idArticle`, `idUtilisateur`) VALUES
(76, 4, 4),
(89, 3, 4),
(83, 17, 4);

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
  `dernierAchat` datetime DEFAULT NULL,
  `vendeurId` int(11) NOT NULL,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `categorie` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `RefVendeurId` (`vendeurId`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `description`, `quantite`, `nombreVendu`, `dernierAchat`, `vendeurId`, `nom`, `categorie`) VALUES
(15, 'Créez, contrôlez et affirmez votre style de jeu avec la nouvelle souris Razer Basilisk V3, la quintessence de la souris gaming ergonomique à performances personnalisables. Avec 11 boutons programmables, une molette de défilement intelligente et une forte dose de Razer Chroma RGB, il est temps d’éclairer la concurrence avec votre style.', 179, 1, '2021-12-08 16:44:28', 1, 'Razer Basilisk V3', 'régulier'),
(16, 'Le NVIDIA A30 Tensor Core est le GPU de calcul grand public le plus polyvalent pour l\'inférence de l\'IA et les charges de travail des entreprises grand public. Alimenté par la technologie Tensor Core de l\'architecture NVIDIA Ampere, il prend en charge un large éventail de précisions mathématiques.', 10, 0, '2021-12-08 20:05:13', 6, 'Nvidia A30', 'rare'),
(17, 'Vous recherchez une souris simple, fiable et dotée de la technologie sans fil prête à l\'emploi ? Alors la Logitech Wireless Mouse M185 est faite pour vous ! Profitez de la fiabilité d\'un dispositif filaire, mais avec la liberté et la commodité de la technologie sans fil...', 300, 0, '2021-12-08 20:12:32', 2, 'Souris Logitech M185', 'régulier'),
(18, 'Travaillez où que Vous Soyez : Vous profitez d\'un contrôle précis du curseur, quel que soit l\'endroit où vous utilisez votre trackball. Les tables massives, les canapés confortables et les lits moelleux ne représentent aucun obstacle pour le trackball M570 !', 149, 1, '2021-12-08 20:22:35', 2, 'Logitech M570 sans fil Trackball', 'rare'),
(19, 'Le Vivobook S14 a évolué : plus léger, plus puissant ! (i5, RAM 8Go, 512 Go SSD)\r\nAvec ses bords soigneusement découpés au diamant et son élégant châssis métallique, le VivoBook S14 fait ressortir ce qu\'il y a d\'unique en vous. ', 110, 0, '2021-12-08 20:25:59', 1, 'Asus Vivobook S14 ', 'régulier'),
(20, 'Nouvelle architecture GPU NVIDIA Turing et plate-forme RTX avec entrainement en temps réel pour une expérience de jeu ultime : tracing en temps réel, NVIDIA G-SYNC compatible, HDMI 2.0', 80, 0, '2021-12-08 20:34:08', 4, 'KFA2 GeForce RTX 2060', 'régulier'),
(3, 'Processeur Intel de dernière génération, possédant 10 coeurs et intégrant la technologie hybride.', 1, 2, '2021-12-08 10:11:36', 2, 'Intel Core I5', 'régulier'),
(4, 'Processeur Intel de 12e génération, comportant 12 coeurs, de fréquence max 5GHz. Pour ceux qui veulent de la vitesse d\'exécution.', 0, 1, '2021-12-08 10:49:34', 2, 'Intel Core I7', 'haut de gamme'),
(5, 'La rolls des processeurs. Processeur 16 coeurs, sans aucune concession. Attention cet article est rare, les quantités sont limitées!', 0, 10, '2021-12-08 11:04:06', 6, 'Intel Core I9', 'rare'),
(6, 'L\'AMD Ryzen 3 1200 AF est un processeur 4 coeurs abordable, doté d\'un bon rapport qualité prix.', 200, 0, '2021-12-08 11:14:12', 2, 'AMD Ryzen 3 1200 AF', 'régulier'),
(7, 'Corsair Vengeance RGB PRO Series 16 Go en DDR4 2x 8 Go fort potentiel d\'overclocking', 200, 0, '2021-12-08 15:04:13', 2, 'Barettes RAM Corsair 16 Go', 'régulier'),
(8, 'Supprimez tous les obstacles sur le chemin de la victoire grâce à la souris PRO la plus légère et la plus rapide jamais produite. Souris conçue pour les habiles du poigné.', 74, 1, '2021-12-08 15:22:51', 6, 'Logitech PRO X', 'haut de gamme'),
(9, 'Casque de Jeu Filaire multiplateforme pour PC, PS4, Xbox One et Switch, avec commandes en ligne, de type supra-auriculaire (chauffe les oreilles). Le microphone unidirectionnel vous permet de communiquer avec votre équipe dans un son clair comme de l\'eau de roche.', 250, 0, '2021-12-08 15:28:45', 2, 'Razer Kraken', 'régulier'),
(10, 'Ecran PC Samsung avec dalle incurvée, 24 pouces, taux de rafraîchissement de 144 Hz, noir brillant, possédant un temps de réponse de 4 ms. Ecran immersif, donne l\'impression d\'être au cinéma.', 60, 0, '2021-12-08 15:40:34', 2, 'Ecran PC incurvé Samsung', 'haut de gamme'),
(11, 'Moniteur Samsung Curvo Gaming 49\", noir, format 32:9, taille démesurée. Si vous voulez vous abimer les yeux, n\'hésitez surtout pas.', 15, 0, '2021-12-08 15:44:08', 6, 'Ecran large Samsung incurvé', 'rare'),
(12, 'Asus ROG Strix PC Portable gamer, processeur AMD Ryzen 7, 16 Go RAM, SSD 512 Go, TRX 3050, clavier AZERTY, 15.6\", option sapin de Noël.', 50, 0, '2021-12-08 15:59:05', 6, 'ASUS Rog Strix PC portable', 'haut de gamme'),
(13, 'PC haut de gamme en série limitée, processeur Intel Core I9, 32 Go de RAM, Nvidia RTX 3080, SSD 2 To. Pour ceux qui en ont les moyens, ce PC est un produit rare, dépêchez-vous!', 2, 1, '2021-12-08 16:09:45', 6, 'MSI Gaming GE66 Raider', 'rare'),
(14, 'PC Portable Alienware AMD Ryzen R7 5800H, 15.6\", full HD 165 Hz, 16 Go RAM SSD 512 Go', 70, 0, '2021-12-08 16:30:44', 1, 'Alienware m15 r5', 'haut de gamme');

-- --------------------------------------------------------

--
-- Structure de la table `articleenchere`
--

DROP TABLE IF EXISTS `articleenchere`;
CREATE TABLE IF NOT EXISTS `articleenchere` (
  `idArticleEnchere` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `idArticle` int(11) NOT NULL,
  PRIMARY KEY (`idArticleEnchere`),
  KEY `RefidArticle` (`idArticle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articleimmediat`
--

INSERT INTO `articleimmediat` (`idArticleImmediat`, `prixActuel`, `idArticle`) VALUES
(1, 900, 1),
(2, 10, 2),
(3, 350, 3),
(4, 500, 4),
(5, 800, 5),
(6, 80, 6),
(7, 100, 7),
(8, 130, 8),
(9, 45, 9),
(10, 190, 10),
(11, 900, 11),
(12, 1400, 12),
(13, 5400, 13),
(14, 1600, 14),
(15, 80, 15),
(16, 5000, 16),
(17, 20, 17),
(18, 64, 18),
(19, 599, 19),
(20, 600, 20);

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
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `articlelog`
--

INSERT INTO `articlelog` (`idArticleLog`, `prixAchat`, `articleId`, `commandeLogId`) VALUES
(1, 350, 3, 3),
(2, 350, 3, 4),
(3, 500, 4, 5),
(4, 350, 3, 5),
(5, 500, 4, 6),
(6, 350, 3, 6),
(7, 350, 3, 9),
(8, 350, 3, 11),
(9, 500, 4, 12),
(10, 350, 3, 13),
(11, 5400, 13, 14),
(12, 800, 5, 14),
(13, 500, 4, 14),
(14, 350, 3, 15),
(15, 350, 3, 16),
(16, 800, 5, 17),
(17, 500, 4, 18),
(18, 800, 5, 26),
(19, 130, 8, 27),
(20, 5400, 13, 28),
(21, 64, 18, 29),
(22, 80, 15, 30),
(23, 800, 5, 31),
(24, 350, 3, 32);

-- --------------------------------------------------------

--
-- Structure de la table `articlenegociation`
--

DROP TABLE IF EXISTS `articlenegociation`;
CREATE TABLE IF NOT EXISTS `articlenegociation` (
  `idArticleNegociation` int(11) NOT NULL AUTO_INCREMENT,
  `prixBase` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idArticleNegociation`),
  KEY `RefidArticle` (`idArticle`),
  KEY `RefidUtilisateur` (`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `commandelog`
--

INSERT INTO `commandelog` (`idCommandeLog`, `dateCommande`, `utilisateurId`, `idAdresseLog`, `idPaiementLog`) VALUES
(32, '2021-12-10 14:47:54', 4, 35, 48),
(31, '2021-12-10 14:03:47', 4, 34, 47),
(30, '2021-12-10 14:01:30', 4, 33, 46),
(29, '2021-12-10 13:58:08', 4, 32, 45),
(28, '2021-12-10 13:54:43', 4, 31, 44),
(27, '2021-12-10 13:00:22', 4, 30, 43),
(26, '2021-12-10 12:45:39', 4, 29, 42);

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
  PRIMARY KEY (`idEnchere`),
  KEY `RefidUtilisateur` (`idUtilisateur`),
  KEY `RefidArticleEnchere` (`idArticleEnchere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `negociation`
--

DROP TABLE IF EXISTS `negociation`;
CREATE TABLE IF NOT EXISTS `negociation` (
  `idNegociation` int(11) NOT NULL AUTO_INCREMENT,
  `prixUser` int(11) NOT NULL,
  `commentaireVendeur` text COLLATE latin1_general_ci,
  `accepted` tinyint(4) NOT NULL,
  PRIMARY KEY (`idNegociation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifarticleprix`
--

DROP TABLE IF EXISTS `notifarticleprix`;
CREATE TABLE IF NOT EXISTS `notifarticleprix` (
  `prixPourNotif` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  KEY `RefidUtilisateur` (`idUtilisateur`),
  KEY `refidArticle` (`idArticle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`idNotification`, `nom`, `descriptionNotif`, `dateNotif`, `idUtilisateur`, `vu`, `lien`) VALUES
(7, 'Commande', 'Votre commande (Ref: 27) a bien été pris en compte', '2021-12-10 13:00:22', 4, 1, 'commande&id=27'),
(6, 'Commande', 'Votre commande (Ref: 26) a bien été pris en compte', '2021-12-10 12:45:39', 4, 1, 'commande&id=26'),
(5, 'Commande', 'Votre commande (Ref: 25) a bien été pris en compte', '2021-12-10 12:44:41', 4, 1, 'commande&id=25'),
(8, 'Ajout d adresse', 'Votre ajout d adresse a bien été pris en compte', '2021-12-10 13:04:50', 4, 1, 'votre_compte'),
(9, 'Ajout d\'adresse', 'Votre ajout d\'adresse (8, villa, Paris) a bien été pris en compte', '2021-12-10 13:05:54', 4, 1, 'votre_compte'),
(10, 'Ajout d\'adresse', 'Votre ajout d\'adresse (8 villa Caro à Voisinssdff) a bien été pris en compte', '2021-12-10 13:50:54', 4, 1, 'votre_compte'),
(11, 'Ajout de moyen de paiement', 'Votre ajout de paiement (Visa - 4444) a bien été pris en compte', '2021-12-10 13:53:54', 4, 1, 'votre_compte'),
(12, 'Commande', 'Votre commande (Ref: 28) a bien été pris en compte', '2021-12-10 13:54:43', 4, 1, 'commande&id=28'),
(13, 'Commande', 'Votre commande (Ref: 29) a bien été pris en compte', '2021-12-10 13:58:08', 4, 1, 'commande&id=29'),
(14, 'Commande', 'Votre commande (Ref: 30) a bien été pris en compte', '2021-12-10 14:01:30', 4, 1, 'commande&id=30'),
(15, 'Commande', 'Votre commande (Ref: 31) a bien été pris en compte', '2021-12-10 14:03:47', 4, 1, 'commande&id=31'),
(16, 'Rupture', 'Intel Core I7 est en rupture de stock', '2021-12-10 14:35:17', 4, 1, 'article&id='),
(17, 'Rupture', 'Intel Core I5 est en rupture de stock', '2021-12-10 14:36:41', 4, 1, 'article&id='),
(18, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:36:47', 4, 1, 'article&id='),
(19, 'Rupture', 'Intel Core I5 est en rupture de stock', '2021-12-10 14:37:31', 4, 1, 'article&id=3'),
(20, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:37:33', 4, 1, 'article&id=3'),
(21, 'Rupture', 'Intel Core I5 est en rupture de stock', '2021-12-10 14:38:32', 4, 1, 'article&id=3'),
(22, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:38:37', 4, 1, 'article&id=3'),
(23, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:47:27', 4, 1, 'article&id=3'),
(24, 'Rupture', 'Intel Core I5 est en rupture de stock', '2021-12-10 14:47:33', 4, 1, 'article&id=3'),
(25, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:47:51', 4, 1, 'article&id=3'),
(26, 'Commande', 'Votre commande (Ref: 32) a bien été pris en compte', '2021-12-10 14:47:54', 4, 1, 'commande&id=32'),
(27, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:48:44', 4, 1, 'article&id=3'),
(28, 'Rupture', 'Intel Core I5 est en rupture de stock', '2021-12-10 14:49:24', 4, 1, 'article&id=3'),
(29, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:49:27', 4, 1, 'article&id=3'),
(30, 'Rupture', 'Intel Core I5 est en rupture de stock', '2021-12-10 14:49:29', 4, 1, 'article&id=3'),
(31, 'Disponible', 'Intel Core I5 est enfin disponible', '2021-12-10 14:49:30', 4, 1, 'article&id=3');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idPaiement`, `typeCarte`, `numeroCarte`, `nomCarte`, `dateExpiration`, `codeSecurite`, `utilisateurId`) VALUES
(13, 'Visa', '1234123412344444', 'Mathis', '2022-05-05', '234', 4),
(11, 'Visa', '1234123412341234', 'Matoush', '2021-12-09', '234', 4),
(12, 'Visa', '1234123412341234', 'Mathis BUET', '2021-12-31', '234', 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `paiementlog`
--

INSERT INTO `paiementlog` (`idPaiementLog`, `typeCarte`, `numeroCarte`, `nomCarte`, `dateExpiration`, `codeSecurite`, `idCommandeLog`) VALUES
(48, 'Visa', '1234123412344444', 'Mathis', '2022-05-05', '234', 32),
(47, 'Visa', '1234123412344444', 'Mathis', '2022-05-05', '234', 31),
(46, 'Visa', '1234123412344444', 'Mathis', '2022-05-05', '234', 30),
(45, 'Visa', '1234123412344444', 'Mathis', '2022-05-05', '234', 29),
(44, 'Visa', '1234123412344444', 'Mathis', '2022-05-05', '234', 28),
(43, 'Visa', '1234123412341234', 'Mathis BUET', '2021-12-31', '234', 27),
(42, 'Visa', '1234123412341234', 'Mathis BUET', '2021-12-31', '234', 26),
(41, 'Visa', '1234123412341234', 'Mathis BUET', '2021-12-31', '234', 25);

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
  `clocheNotifs` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`),
  KEY `refVendeurId` (`vendeurId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mail`, `mdp`, `estAdmin`, `nom`, `prenom`, `pseudo`, `numTel`, `vendeurId`, `clocheNotifs`) VALUES
(4, 'test@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 0, 'Miche', 'Jean', 'jean', '', NULL, 0),
(5, 'dimitri@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'Palatov', 'Dimitri', 'dimitri', '', NULL, 0),
(6, 'mathis@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'FOURNOL', 'Mathis', 'mathis', '', NULL, 0),
(7, 'emilian@ece.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'MITU', 'Emilian', 'emilianLEBG', '', NULL, 0),
(8, 'test2@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, '2', 'Test', 'test2', '', NULL, 0),
(9, 'test3@gmail.com', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'te', 'te', 'test3', '', NULL, 0),
(10, 'test42@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 0, 'oui', 'Gilbert', 'Gil', '', NULL, 0),
(11, 'test@hotmail.fr', '*27604AF8B8A11344ED782C8335452D90FA1BC2E9', 0, 'tt', 'Sl', 'salutation', '', NULL, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`idVendeur`, `utilisateurId`, `photoVendeur`) VALUES
(1, 6, NULL);

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
