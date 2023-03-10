-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 mars 2023 à 13:59
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miams`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vendeur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `texte_avis` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_vendeur`, `id_utilisateur`, `note`, `texte_avis`) VALUES
(1, 1, 2, 4, NULL),
(2, 1, 3, 2, '<p>J\'ai vraiment pas aimé, je déconseille, ce mec ne sait absolument pas cuisiner c\'est terrible<br/>De plus il s\'est montré extrêmement désagréable avec nous en nous traitant je cite de \"Putains d\'arriérés qui n\'y connaissent rien à la bouffe\". Je souhaite de ce fait déposer une plainte contre ce monsieur afin de lui apprendre les bonnes manières, même si je doute que cela soit possible à ce niveau de bêtises.</p>'),
(3, 1, 4, 5, NULL),
(4, 1, 5, 4, NULL),
(5, 1, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_commande` varchar(5) NOT NULL,
  `cle_commande` varchar(2) NOT NULL,
  `id_plat` int(11) NOT NULL,
  `nombre_parts` int(11) NOT NULL,
  `montant_total` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  `recupere` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `numero_commande`, `cle_commande`, `id_plat`, `nombre_parts`, `montant_total`, `id_utilisateur`, `date_commande`, `actif`, `recupere`) VALUES
(1, 'O6352', '68', 2, 2, 48, 1, '2022-08-23 15:07:25', 1, 0),
(2, '673I2', 'O9', 1, 1, 12, 2, '2022-08-23 15:26:03', 1, 0),
(3, '989P1', '3X', 1, 2, 24, 4, '2022-08-23 15:26:22', 1, 0),
(4, '652Q8', '5K', 2, 3, 72, 3, '2022-08-23 15:37:32', 1, 0),
(5, '2628M', 'NB', 1, 2, 24, 7, '2022-08-26 13:32:23', 1, 0),
(6, '5G592', '6T', 3, 2, 14, 1, '2022-09-21 16:14:29', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `libelle`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

DROP TABLE IF EXISTS `plats`;
CREATE TABLE IF NOT EXISTS `plats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_plat` varchar(100) NOT NULL,
  `prix` int(11) NOT NULL,
  `parts` int(11) NOT NULL,
  `heure_limite` datetime NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `complement_adresse` varchar(255) DEFAULT NULL,
  `batiment` varchar(70) DEFAULT NULL,
  `etage` int(11) DEFAULT NULL,
  `code_postal` varchar(5) NOT NULL,
  `ville` varchar(38) NOT NULL,
  `photo_plat` varchar(255) NOT NULL,
  `note_vendeur` text,
  `id_vendeur` int(11) NOT NULL,
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `nom_plat`, `prix`, `parts`, `heure_limite`, `adresse`, `complement_adresse`, `batiment`, `etage`, `code_postal`, `ville`, `photo_plat`, `note_vendeur`, `id_vendeur`, `date_ajout`) VALUES
(1, 'Nachos', 12, 13, '2022-09-27 23:00:00', '10A Rue des écoles', NULL, NULL, 3, '68920', 'WINTZENHEIM', 'assets/img/nachos.jpg', NULL, 1, '2022-08-20 16:58:43'),
(2, 'Boeuf Bourguignon', 24, 2, '2022-09-27 18:00:00', '10A Rue des écoles', NULL, NULL, 3, '68920', 'WINTZENHEIM', 'assets/img/boeuf.jpg', NULL, 2, '2022-08-20 16:58:43'),
(3, 'Hamburger maison', 7, 3, '2022-09-27 18:00:00', '10A Rue des écoles', NULL, NULL, 3, '68920', 'WINTZENHEIM', 'assets/img/burger.jpg', NULL, 2, '2022-08-20 16:58:43');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `pass` text,
  `photo_profil` varchar(255) NOT NULL DEFAULT 'assets/utilisateurs/default.png',
  `adresse` varchar(255) DEFAULT NULL,
  `complement_adresse` varchar(255) DEFAULT NULL,
  `batiment` varchar(70) DEFAULT NULL,
  `etage` int(11) DEFAULT NULL,
  `code_postal` varchar(5) DEFAULT NULL,
  `ville` varchar(38) DEFAULT NULL,
  `tentatives` int(11) NOT NULL DEFAULT '5',
  `bloque` int(11) NOT NULL DEFAULT '0',
  `id_droit` int(11) NOT NULL DEFAULT '2',
  `date_inscription` datetime NOT NULL,
  `date_suppression` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `mail`, `pass`, `photo_profil`, `adresse`, `complement_adresse`, `batiment`, `etage`, `code_postal`, `ville`, `tentatives`, `bloque`, `id_droit`, `date_inscription`, `date_suppression`) VALUES
(1, 'SCHIFFERLE', 'Quentin', 'quentin.schifferle@gmail.com', '$2y$10$M6FiJlDo86Vw6L3OUlxbyubQgSFiGFACtds6gI.fcAOGCtXcps1SG', 'assets/utilisateurs/1-Nelly.jpg', '', '', '', 0, '', '', 5, 0, 1, '2022-08-18 16:40:18', NULL),
(2, 'COUCHOT', 'Emilie', 'mimi-couchot@live.fr', '$2y$10$67CDTfktl/4fX86TSZi/6.HcOlMctSBGMEnJPXoifMMh8WkgbajGO', 'assets/utilisateurs/2-1658414241475.jpg', '10A RUE DES ÉCOLES', '', '', 3, '68920', 'WINTZENHEIM', 5, 0, 2, '2022-08-18 20:32:21', NULL),
(3, NULL, NULL, NULL, NULL, 'assets/utilisateurs/default.png', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 2, '2022-08-18 20:32:21', '2022-08-25 14:45:22'),
(4, 'CARTIGNIES', 'Pierre-Loïc', 'pl.cartignies@coprotec.net', '$2y$10$67CDTfktl/4fX86TSZi/6.HcOlMctSBGMEnJPXoifMMh8WkgbajGO', 'assets/img/darth-vader.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 2, '2022-08-18 20:32:21', NULL),
(5, 'SCHWARTZ', 'Frédéric', 'f.schwartz@coprotec.net', '$2y$10$67CDTfktl/4fX86TSZi/6.HcOlMctSBGMEnJPXoifMMh8WkgbajGO', 'assets/img/unnamed.png', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 2, '2022-08-18 20:32:21', NULL),
(6, NULL, NULL, NULL, NULL, 'assets/utilisateurs/default.png', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 2, '2022-08-26 13:30:18', '2022-08-26 14:50:04'),
(7, 'SCHIFFERLE', 'Nathan', 'nathan.schifferle@gmail.com', '$2y$10$9rQZpKgJBBl44bU44axG/OgSj.CifGfRXTVhplhMm41wsowoA7Id2', 'assets/utilisateurs/7-processed-68781903-50f8-4412-a8dc-b611ed2d2339_fnGiRNHs.jpeg', '', '', '', 0, '', '', 5, 0, 2, '2022-08-26 13:32:09', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
