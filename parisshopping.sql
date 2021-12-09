-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 09 déc. 2021 à 13:02
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
    `prenom` varchar(100) COLLATE latin1_general_ci NOT NULL,
    `idCommandeLog` int(11) NOT NULL,
    PRIMARY KEY (`idAdresseLog`),
    KEY `RefidCommandeLog` (`idCommandeLog`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
    `articleimmediat` int(11) DEFAULT NULL,
    `vendeurId` int(11) NOT NULL,
    `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
    `categorie` varchar(255) COLLATE latin1_general_ci NOT NULL,
    PRIMARY KEY (`idArticle`),
    KEY `RefArticleImmediat` (`articleimmediat`),
    KEY `RefVendeurId` (`vendeurId`)
    ) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `description`, `quantite`, `nombreVendu`, `dernierAchat`, `articleimmediat`, `vendeurId`, `nom`, `categorie`) VALUES
                                                                                                                                                      (15, 'Créez, contrôlez et affirmez votre style de jeu avec la nouvelle souris Razer Basilisk V3, la quintessence de la souris gaming ergonomique à performances personnalisables. Avec 11 boutons programmables, une molette de défilement intelligente et une forte dose de Razer Chroma RGB, il est temps d’éclairer la concurrence avec votre style.', 180, 0, '2021-12-08 16:44:28', NULL, 1, 'Razer Basilisk V3', 'régulier'),
                                                                                                                                                      (16, 'Le NVIDIA A30 Tensor Core est le GPU de calcul grand public le plus polyvalent pour l\'inférence de l\'IA et les charges de travail des entreprises grand public. Alimenté par la technologie Tensor Core de l\'architecture NVIDIA Ampere, il prend en charge un large éventail de précisions mathématiques.', 10, 0, '2021-12-08 20:05:13', NULL, 6, 'Nvidia A30', 'rare'),
(17, 'Vous recherchez une souris simple, fiable et dotée de la technologie sans fil prête à l\'emploi ? Alors la Logitech Wireless Mouse M185 est faite pour vous ! Profitez de la fiabilité d\'un dispositif filaire, mais avec la liberté et la commodité de la technologie sans fil...', 300, 0, '2021-12-08 20:12:32', NULL, 2, 'Souris Logitech M185', 'régulier'),
(18, 'Travaillez où que Vous Soyez : Vous profitez d\'un contrôle précis du curseur, quel que soit l\'endroit où vous utilisez votre trackball. Les tables massives, les canapés confortables et les lits moelleux ne représentent aucun obstacle pour le trackball M570 !', 150, 0, '2021-12-08 20:22:35', NULL, 2, 'Logitech M570 sans fil Trackball', 'rare'),
(19, 'Le Vivobook S14 a évolué : plus léger, plus puissant ! (i5, RAM 8Go, 512 Go SSD)\r\nAvec ses bords soigneusement découpés au diamant et son élégant châssis métallique, le VivoBook S14 fait ressortir ce qu\'il y a d\'unique en vous. ', 110, 0, '2021-12-08 20:25:59', NULL, 1, 'Asus Vivobook S14 ', 'régulier'),
(20, 'Nouvelle architecture GPU NVIDIA Turing et plate-forme RTX avec entrainement en temps réel pour une expérience de jeu ultime : tracing en temps réel, NVIDIA G-SYNC compatible, HDMI 2.0', 80, 0, '2021-12-08 20:34:08', NULL, 4, 'KFA2 GeForce RTX 2060', 'régulier'),
(3, 'Processeur Intel de dernière génération, possédant 10 coeurs et intégrant la technologie hybride.', 80, 0, '2021-12-08 10:11:36', NULL, 2, 'Intel Core I5', 'régulier'),
(4, 'Processeur Intel de 12e génération, comportant 12 coeurs, de fréquence max 5GHz. Pour ceux qui veulent de la vitesse d\'exécution.', 75, 0, '2021-12-08 10:49:34', NULL, 2, 'Intel Core I7', 'haut de gamme'),
                                                                                                                                                      (5, 'La rolls des processeurs. Processeur 16 coeurs, sans aucune concession. Attention cet article est rare, les quantités sont limitées!', 10, 0, '2021-12-08 11:04:06', NULL, 6, 'Intel Core I9', 'rare'),
                                                                                                                                                      (6, 'L\'AMD Ryzen 3 1200 AF est un processeur 4 coeurs abordable, doté d\'un bon rapport qualité prix.', 200, 0, '2021-12-08 11:14:12', NULL, 2, 'AMD Ryzen 3 1200 AF', 'régulier'),
                                                                                                                                                      (7, 'Corsair Vengeance RGB PRO Series 16 Go en DDR4 2x 8 Go fort potentiel d\'overclocking', 200, 0, '2021-12-08 15:04:13', NULL, 2, 'Barettes RAM Corsair 16 Go', 'régulier'),
(8, 'Supprimez tous les obstacles sur le chemin de la victoire grâce à la souris PRO la plus légère et la plus rapide jamais produite. Souris conçue pour les habiles du poigné.', 75, 0, '2021-12-08 15:22:51', NULL, 6, 'Logitech PRO X', 'haut de gamme'),
(9, 'Casque de Jeu Filaire multiplateforme pour PC, PS4, Xbox One et Switch, avec commandes en ligne, de type supra-auriculaire (chauffe les oreilles). Le microphone unidirectionnel vous permet de communiquer avec votre équipe dans un son clair comme de l\'eau de roche.', 250, 0, '2021-12-08 15:28:45', NULL, 2, 'Razer Kraken', 'régulier'),
                                                                                                                                                      (10, 'Ecran PC Samsung avec dalle incurvée, 24 pouces, taux de rafraîchissement de 144 Hz, noir brillant, possédant un temps de réponse de 4 ms. Ecran immersif, donne l\'impression d\'être au cinéma.', 60, 0, '2021-12-08 15:40:34', NULL, 2, 'Ecran PC incurvé Samsung', 'haut de gamme'),
                                                                                                                                                      (11, 'Moniteur Samsung Curvo Gaming 49\", noir, format 32:9, taille démesurée. Si vous voulez vous abimer les yeux, n\'hésitez surtout pas.', 15, 0, '2021-12-08 15:44:08', NULL, 6, 'Ecran large Samsung incurvé', 'rare'),
(12, 'Asus ROG Strix PC Portable gamer, processeur AMD Ryzen 7, 16 Go RAM, SSD 512 Go, TRX 3050, clavier AZERTY, 15.6\", option sapin de Noël.', 50, 0, '2021-12-08 15:59:05', NULL, 6, 'ASUS Rog Strix PC portable', 'haut de gamme'),
(13, 'PC haut de gamme en série limitée, processeur Intel Core I9, 32 Go de RAM, Nvidia RTX 3080, SSD 2 To. Pour ceux qui en ont les moyens, ce PC est un produit rare, dépêchez-vous!', 3, 0, '2021-12-08 16:09:45', NULL, 6, 'MSI Gaming GE66 Raider', 'rare'),
                                                                                                                                                       (14, 'PC Portable Alienware AMD Ryzen R7 5800H, 15.6\", full HD 165 Hz, 16 Go RAM SSD 512 Go', 70, 0, '2021-12-08 16:30:44', NULL, 1, 'Alienware m15 r5', 'haut de gamme');

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
    `idAdresseLog` int(11) NOT NULL,
    `idPaiementLog` int(11) NOT NULL,
    PRIMARY KEY (`idCommandeLog`),
    KEY `RefUtilisateurId` (`utilisateurId`),
    KEY `RefidAdresseLog` (`idAdresseLog`),
    KEY `RefidPaiementLog` (`idPaiementLog`)
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
    `description` text COLLATE latin1_general_ci,
    `date` datetime NOT NULL,
    `idUtilisateur` int(11) NOT NULL,
    `vu` tinyint(4) NOT NULL DEFAULT '0',
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
    `idCommandeLog` int(11) NOT NULL,
    PRIMARY KEY (`idPaiementLog`),
    KEY `RefidCommandeLog` (`idCommandeLog`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
    ) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
                                                                                                                                             (10, 'test42@gmail.com', '*C87AFFAB5D58116D7A14F833F462B169E77B5CDA', 0, 'oui', 'Gilbert', 'Gil', '', NULL, 0);

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
