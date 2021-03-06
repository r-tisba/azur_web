-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 mai 2022 à 09:29
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9
=======
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : ipssisqazur.mysql.db
-- Généré le : dim. 24 avr. 2022 à 14:08
-- Version du serveur : 5.6.51-log
-- Version de PHP : 7.4.25
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
<<<<<<< HEAD
-- Base de données : `gestion`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `recupererInterlocuteur`$$
CREATE PROCEDURE `recupererInterlocuteur` (IN `p_idDiscussion` INT, IN `p_idUtilisateur` INT)  BEGIN
DECLARE p_idEnvoyeur INT DEFAULT 0;
DECLARE p_idDestinataire INT DEFAULT 0;
DECLARE p_identifiant VARCHAR(100) DEFAULT "";
	SELECT idEnvoyeur, idDestinataire INTO p_idEnvoyeur, p_idDestinataire
    FROM discussions
    WHERE idDiscussion = p_idDiscussion;
    IF p_idUtilisateur = p_idDestinataire THEN
    	SELECT idUtilisateur, identifiant
		FROM utilisateurs
		WHERE idUtilisateur = p_idEnvoyeur;
	ELSE
		SELECT idUtilisateur, identifiant
		FROM utilisateurs
		WHERE idUtilisateur = p_idDestinataire;
	END IF;
END$$

DELIMITER ;
=======
-- Base de données : `ipssisqazur`
--
CREATE DATABASE IF NOT EXISTS `ipssisqazur` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ipssisqazur`;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `composition_equipes`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `composition_equipes`;
CREATE TABLE IF NOT EXISTS `composition_equipes` (
  `idEquipe` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  KEY `idEquipe` (`idEquipe`),
  KEY `idUtilisateur` (`idUtilisateur`)
=======
CREATE TABLE `composition_equipes` (
  `idEquipe` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `composition_equipes`
--

INSERT INTO `composition_equipes` (`idEquipe`, `idUtilisateur`) VALUES
(2, 1),
(2, 3),
(3, 2),
<<<<<<< HEAD
(4, 6),
=======
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
(5, 1),
(16, 1),
(3, 1),
(5, 2),
<<<<<<< HEAD
(2, 6),
(18, 0),
(2, 0);
=======
(2, 6);
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `discussions`;
CREATE TABLE IF NOT EXISTS `discussions` (
  `idDiscussion` int(11) NOT NULL AUTO_INCREMENT,
  `idEnvoyeur` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  PRIMARY KEY (`idDiscussion`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
=======
CREATE TABLE `discussions` (
  `idDiscussion` int(11) NOT NULL,
  `idEnvoyeur` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `discussions`
--

INSERT INTO `discussions` (`idDiscussion`, `idEnvoyeur`, `idDestinataire`) VALUES
(1, 2, 1),
(6, 3, 1),
(58, 3, 2),
<<<<<<< HEAD
(60, 3, 6),
(59, 3, 36);
=======
(61, 35, 1),
(62, 3, 35);
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `nomEquipe` varchar(100) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT '../images/design/image_equipe.png',
  PRIMARY KEY (`idEquipe`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
=======
CREATE TABLE `equipes` (
  `idEquipe` int(11) NOT NULL,
  `nomEquipe` varchar(100) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT '../images/design/image_equipe.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`idEquipe`, `nomEquipe`, `image`) VALUES
<<<<<<< HEAD
(4, 'Test', '../images/design/image_equipe.png'),
(2, 'Dev', '../images/design/computer.png'),
(3, 'Communication', '../images/design/haut_parleur.png'),
(5, 'R&D', '../images/design/r&d.png'),
(16, 'Trésorerie', '../images/design/coins.png'),
(18, 'Equipe test', '../images/design/logo2.png');

--
-- Déclencheurs `equipes`
--
DROP TRIGGER IF EXISTS `before_delete_equipe`;
DELIMITER $$
CREATE TRIGGER `before_delete_equipe` BEFORE DELETE ON `equipes` FOR EACH ROW BEGIN
    DELETE FROM composition_equipes
    WHERE idEquipe = OLD.idEquipe;
END
$$
DELIMITER ;
=======
(2, 'Dev', '../images/design/computer.png'),
(3, 'Communication', '../images/design/haut_parleur.png'),
(5, 'R&D', '../images/design/r&d.png'),
(16, 'Trésorerie', '../images/design/coins.png');
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `etapes`;
CREATE TABLE IF NOT EXISTS `etapes` (
  `idEtape` int(11) NOT NULL AUTO_INCREMENT,
=======
CREATE TABLE `etapes` (
  `idEtape` int(11) NOT NULL,
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `idProjet` int(11) NOT NULL,
  `nomEtape` varchar(300) DEFAULT NULL,
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `etatEtape` int(11) NOT NULL DEFAULT '0',
<<<<<<< HEAD
  PRIMARY KEY (`idEtape`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
=======
  `dateValidation` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `etapes`
--

<<<<<<< HEAD
INSERT INTO `etapes` (`idEtape`, `idProjet`, `nomEtape`, `dateDebut`, `dateFin`, `etatEtape`) VALUES
(11, 6, 'Maquette du site web', '2021-11-17 09:39:23', '2021-11-19 09:39:23', 1),
(12, 6, 'Etape random n°2', '2021-11-21 09:39:23', '2021-11-26 09:39:23', 1),
(13, 6, 'Création de l\'onglet \"Cours\"', '2021-11-29 09:41:21', '2021-12-10 09:41:21', 1),
(14, 6, 'Mise à jour de la page \"Formations\"', '2021-11-30 09:00:00', '2021-12-03 09:41:21', 1),
(15, 6, 'Création de tables exportables de données utilisateurs', '2022-02-28 09:43:09', '2022-04-01 09:43:09', 0),
(16, 6, 'Intégrer les imports dans \"Notes\"', '2022-03-07 09:48:12', '2022-03-11 09:48:59', 0),
(17, 7, 'Etape 1', '2022-01-03 09:00:21', '2022-01-14 09:00:21', 1),
(18, 7, 'Etape 2', '2022-01-14 09:49:21', '2022-01-21 09:49:21', 1),
(19, 7, 'Etape 3', '2022-02-24 09:51:00', '2022-03-02 09:51:00', 1),
(20, 7, 'Etape 4', '2022-02-28 09:51:16', '2022-03-09 09:51:16', 1),
(21, 7, 'Etape 5', '2022-03-01 09:51:50', '2022-03-03 09:51:50', 0),
(22, 8, 'Etape N°478392', '2021-11-08 09:57:37', NULL, 0),
(33, 6, 'Sécuriser les injections SQL', '2022-02-28 19:48:18', '2022-03-02 19:48:18', 0),
(30, 7, 'Etape 6', '2022-03-14 21:58:16', '2022-04-22 21:58:16', 0),
(35, 12, 'BILOUT', '2022-02-05 16:31:42', '2022-02-24 16:31:42', 0),
(36, 12, 'ZESREHDFGC', '2022-02-05 16:34:53', '2022-02-05 16:34:53', 0);
=======
INSERT INTO `etapes` (`idEtape`, `idProjet`, `nomEtape`, `dateDebut`, `dateFin`, `etatEtape`, `dateValidation`) VALUES
(11, 6, 'Maquette du site web', '2021-11-17 09:39:23', '2021-11-19 09:39:23', 1, '2021-11-19 09:39:23'),
(12, 6, 'Etape random n°2', '2021-11-21 09:39:23', '2021-11-26 09:39:23', 1, '2021-11-26 09:39:23'),
(13, 6, 'Création de l\'onglet \"Cours\"', '2021-11-29 09:41:21', '2021-12-10 09:41:21', 1, '2021-12-09 09:41:21'),
(14, 6, 'Mise à jour de la page \"Formations\"', '2021-11-30 09:00:00', '2021-12-03 09:41:21', 1, '2021-12-01 09:41:21'),
(15, 6, 'Création de tables exportables de données utilisateurs', '2022-02-28 09:43:09', '2022-04-01 09:43:09', 0, NULL),
(16, 6, 'Intégrer les imports dans \"Notes\"', '2022-03-07 09:48:12', '2022-03-11 09:48:59', 0, NULL),
(17, 7, 'Etape 1', '2022-01-03 09:00:21', '2022-01-14 09:00:21', 1, '2022-01-14 09:00:21'),
(18, 7, 'Etape 2', '2022-01-14 09:49:21', '2022-01-21 09:49:21', 1, '2022-01-21 09:49:21'),
(19, 7, 'Etape 3', '2022-02-24 09:51:00', '2022-03-02 09:51:00', 1, '2022-04-05 21:57:52'),
(20, 7, 'Etape 4', '2022-02-28 09:51:16', '2022-03-09 09:51:16', 0, NULL),
(21, 7, 'Etape 5', '2022-03-01 09:51:50', '2022-03-03 09:51:50', 0, NULL),
(22, 8, 'Etape N°478392', '2021-11-08 09:57:37', NULL, 0, NULL),
(33, 6, 'Sécuriser les injections SQL', '2022-02-28 19:48:18', '2022-03-02 19:48:18', 0, NULL),
(30, 7, 'Etape 6', '2022-03-14 21:58:16', '2022-04-22 21:58:16', 0, NULL),
(45, 19, 'Casting', '2022-04-08 08:38:58', '2022-04-12 15:38:58', 1, NULL),
(44, 19, 'Script', '2022-04-05 10:38:35', '2022-04-07 18:38:35', 1, NULL),
(40, 6, 'test', '2022-04-03 00:31:58', '2022-04-03 00:31:58', 0, NULL),
(46, 19, 'Tournage', '2022-04-13 08:39:19', '2022-04-15 17:39:19', 0, NULL),
(47, 19, 'Montage', '2022-04-18 09:39:40', '2022-04-22 16:39:40', 0, NULL),
(48, 7, 'Etape 7', '2022-04-11 08:57:51', '2022-04-29 16:57:51', 0, NULL);
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
=======
CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `backgroundColor` varchar(7) NOT NULL DEFAULT '#007bff',
  `borderColor` varchar(7) NOT NULL DEFAULT '#007bff',
  `textColor` varchar(7) NOT NULL DEFAULT '#ffffff',
  `url` varchar(255) DEFAULT NULL,
  `nom_url` varchar(255) DEFAULT NULL,
<<<<<<< HEAD
  `idCreateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;
=======
  `idCreateur` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `title`, `description`, `start`, `end`, `backgroundColor`, `borderColor`, `textColor`, `url`, `nom_url`, `idCreateur`) VALUES
<<<<<<< HEAD
(199, 'Deadline Projet Test', 'Date de rendu du projet pour : Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente sint ipsam quas, iste consectetur veritatis, error voluptates facilis at aperiam, fuga corporis ducimus eius ut dolorum? Pariatur sapiente autem exercitationem. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita dolore modi', '2022-04-28 16:00:00', '2022-04-28 17:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(198, 'Deadline Syvios', 'Date de rendu du projet pour : Développement d\'un site de formation en ligne pour l\'entreprise Quali\'consult avec affichage de notes, emploi du temps et messagerie instantanée.', '2022-04-20 13:00:00', '2022-04-20 14:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(200, 'Deadline Cerbère', 'Date de rendu du projet pour : [CENSURÉ]', '2022-07-20 08:40:45', '2022-07-20 09:40:45', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(74, 'Deadline Test SQL', 'Date de rendu du projet pour : ', '2022-02-23 23:00:00', '2022-02-24 00:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(177, 'Brainstorming', 'Brainstorming avec l\'equipe de dev sur le projet Syvios. Dans la salle de reu \'Ulysse\'', '2022-03-28 09:00:00', '2022-03-28 11:30:00', '#28a745', '#28a745', '#ffffff', NULL, NULL, 1),
(175, 'Conference RGPD', 'Conférence sur la place du RGPD dans la SI', '2022-03-28 14:00:00', '2022-03-28 17:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(178, 'Truc professionnel', 'Truc de boulot BLABLA', '2022-03-30 10:00:00', '2022-03-30 13:00:00', '#d29e00', '#d29e00', '#ffffff', NULL, NULL, 1),
(179, 'Point avec Clem', 'Point d\'avancement sur le projet Syvios', '2022-03-31 15:00:00', '2022-03-31 16:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(180, 'E-learning Agile', 'Tout est dans le titre', '2022-03-31 16:00:00', '2022-03-31 18:00:00', '#28a745', '#28a745', '#ffffff', NULL, NULL, 1),
(181, 'Point avec les clients', 'Presentation de l\'avancement sur projet random', '2022-03-29 14:00:00', '2022-03-29 16:00:00', '#d9534f', '#d9534f', '#ffffff', NULL, NULL, 1),
(182, 'Autre truc pro', 'AAAAAAAAAAAAAAAAA', '2022-04-01 09:00:00', '2022-04-01 12:00:00', '#d29e00', '#d29e00', '#ffffff', NULL, NULL, 1),
(183, 'Presenter la maquette pour le projet 87452', 'Presenter la maquette web à  l\'equipe dev', '2022-03-31 11:00:00', '2022-03-31 13:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(188, 'Deadline test', 'Date de rendu du projet pour : test2', '2022-03-09 23:00:00', '2022-03-10 00:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(193, 'Deadline uhiu', 'Date de rendu du projet pour : ', '2022-03-06 23:00:00', '2022-03-07 00:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL);
=======
(204, 'Deadline Projet Test', 'Date de rendu du projet pour : Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente sint ipsam quas, iste consectetur veritatis, error voluptates facilis at aperiam, fuga corporis ducimus eius ut dolorum? Pariatur sapiente autem exercitationem. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita dolore modi', '2021-12-29 16:00:00', '2021-12-29 17:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(73, 'Deadline Syvios', 'Date de rendu du projet pour : Développement d\'un site de formation en ligne pour l\'entreprise Quali\'consult avec affichage de notes, emploi du temps et messagerie instantanÃ©e.', '2022-04-08 15:00:00', '2022-04-08 16:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(81, 'Deadline Cerbère', 'Date de rendu du projet pour : [CENSURÉ]', '2021-12-23 08:40:45', '2021-12-23 09:40:45', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(203, 'Deadline Quart d\'heure numérique', 'Date de rendu du projet pour : Création d\'une série de vidéos promo pour x afin de blablabla', '2022-04-29 16:00:00', '2022-04-29 17:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(177, 'Brainstorming', 'Brainstorming avec l\'equipe de dev sur le projet Syvios. Dans la salle de reu \'Ulysse\'', '2022-04-04 09:00:00', '2022-04-04 11:30:00', '#28a745', '#28a745', '#ffffff', NULL, NULL, 1),
(175, 'Conference RGPD', 'Conférence sur la place du RGPD dans la SI', '2022-04-04 14:00:00', '2022-04-04 17:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(178, 'Truc professionnel', 'Truc de boulot BLABLA', '2022-04-06 10:00:00', '2022-04-06 13:00:00', '#d29e00', '#d29e00', '#ffffff', NULL, NULL, 1),
(179, 'Point avec Clem', 'Point d\'avancement sur le projet Syvios', '2022-04-07 15:00:00', '2022-04-07 16:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(180, 'E-learning Agile', 'Tout est dans le titre', '2022-04-07 16:00:00', '2022-04-07 18:00:00', '#28a745', '#28a745', '#ffffff', NULL, NULL, 1),
(181, 'Point avec les clients', 'Presentation de l\'avancement sur projet random', '2022-04-05 14:00:00', '2022-04-05 16:00:00', '#d9534f', '#d9534f', '#ffffff', NULL, NULL, 1),
(182, 'Autre truc pro', 'AAAAAAAAAAAAAAAAA', '2022-04-08 09:30:00', '2022-04-08 12:30:00', '#d29e00', '#d29e00', '#ffffff', NULL, NULL, 1),
(183, 'Presenter la maquette pour le projet 87452', 'Presenter la maquette web à  l\'equipe dev', '2022-04-07 11:00:00', '2022-04-07 13:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(205, 'Deadline AAA', 'Date de rendu du projet pour : AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2022-06-23 23:00:00', '2022-06-24 00:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL),
(206, 'Deadline Projet Test 2', 'Date de rendu du projet pour : TESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTEST', '2022-06-21 23:00:00', '2022-06-22 00:00:00', '#dc3545', '#dc3545', '#ffffff', NULL, NULL, NULL);
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déclencheurs `evenements`
--
<<<<<<< HEAD
DROP TRIGGER IF EXISTS `before_delete_evenement`;
=======
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
DELIMITER $$
CREATE TRIGGER `before_delete_evenement` BEFORE DELETE ON `evenements` FOR EACH ROW BEGIN
    DELETE FROM participants_evenements
    WHERE idEvenement = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `ip_admins`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `ip_admins`;
CREATE TABLE IF NOT EXISTS `ip_admins` (
=======
CREATE TABLE `ip_admins` (
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `idUtilisateur` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ip_admins`
--

INSERT INTO `ip_admins` (`idUtilisateur`, `ip`) VALUES
(1, '37.70.218.118'),
(2, '37.70.218.118'),
(35, '37.70.218.118'),
(1, '::1'),
<<<<<<< HEAD
(35, '::1');
=======
(35, '::1'),
(1, '86.245.248.200');
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `ip_bannies`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `ip_bannies`;
CREATE TABLE IF NOT EXISTS `ip_bannies` (
  `idBannissement` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`idBannissement`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
=======
CREATE TABLE `ip_bannies` (
  `idBannissement` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
=======
CREATE TABLE `logs` (
  `idLog` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`idLog`, `idUtilisateur`, `date`, `ip`) VALUES
(1, 1, '2022-03-17 10:27:16', '::1'),
(2, 1, '2022-03-17 10:28:24', '::1'),
(3, 1, '2022-03-17 10:31:13', '::1'),
(4, 1, '2022-03-17 10:50:55', '::1'),
(5, 1, '2022-03-17 10:51:39', '::1'),
(6, 1, '2022-03-17 10:51:39', '::1'),
(7, 1, '2022-03-17 10:52:29', '::1'),
(8, 1, '2022-03-17 10:52:48', '::1'),
(9, 1, '2022-03-17 10:53:03', '::1'),
(10, 1, '2022-03-17 11:02:31', '::1'),
(11, 1, '2022-03-17 11:10:25', '::1'),
(12, 2, '2022-03-17 11:51:16', '::1'),
(13, 2, '2022-03-17 11:53:40', '::1'),
(14, 2, '2022-03-17 11:54:33', '::1'),
(15, 1, '2022-03-17 12:13:53', '::1'),
(16, 3, '2022-03-17 12:14:35', '::1'),
(17, 1, '2022-03-17 12:26:47', '::1'),
(18, 1, '2022-03-17 17:08:39', '::1'),
(19, 1, '2022-03-17 17:44:58', '::1'),
(20, 3, '2022-03-18 09:06:35', '::1'),
(21, 1, '2022-03-18 09:30:02', '::1'),
(22, 3, '2022-03-18 11:20:38', '::1'),
(23, 1, '2022-03-18 11:21:33', '::1'),
(24, 1, '2022-03-18 11:56:04', '::1'),
<<<<<<< HEAD
(25, 1, '2022-03-29 14:28:32', '::1'),
(26, 1, '2022-03-30 09:13:21', '::1'),
(27, 1, '2022-03-30 16:21:43', '::1'),
(28, 1, '2022-03-31 09:44:18', '::1'),
(29, 1, '2022-03-31 15:12:21', '::1'),
(30, 1, '2022-04-12 12:59:41', '::1'),
(31, 1, '2022-04-14 14:23:15', '::1'),
(32, 1, '2022-04-15 12:52:51', '::1'),
(33, 1, '2022-04-15 12:55:42', '::1');
=======
(25, 1, '2022-03-21 17:19:49', '::1'),
(26, 1, '2022-03-27 17:37:15', '::1'),
(27, 1, '2022-03-29 20:06:57', '::1'),
(28, 1, '2022-03-31 19:17:39', '::1'),
(29, 1, '2022-03-31 19:54:54', '::1'),
(30, 1, '2022-04-01 20:28:10', '::1'),
(31, 1, '2022-04-03 13:35:18', '::1'),
(32, 1, '2022-04-05 21:28:27', '::1'),
(33, 1, '2022-04-06 19:08:00', '::1'),
(34, 1, '2022-04-08 19:34:52', '86.245.248.200'),
(35, 1, '2022-04-08 19:54:18', '86.245.248.200'),
(36, 1, '2022-04-08 20:04:54', '86.245.248.200'),
(37, 1, '2022-04-08 20:08:34', '86.245.248.200'),
(38, 1, '2022-04-08 21:42:46', '86.245.248.200'),
(39, 1, '2022-04-09 18:34:37', '86.245.248.200'),
(40, 35, '2022-04-11 18:38:12', '185.128.26.60'),
(41, 1, '2022-04-12 15:22:15', '37.70.218.118'),
(42, 1, '2022-04-14 14:09:33', '37.70.218.118'),
(43, 3, '2022-04-23 00:21:34', '92.118.62.109'),
(44, 35, '2022-04-23 00:26:10', '92.118.62.109'),
(45, 3, '2022-04-23 00:31:24', '86.245.248.200'),
(46, 35, '2022-04-23 00:33:14', '86.245.248.200'),
(47, 1, '2022-04-23 01:01:49', '86.245.248.200'),
(48, 35, '2022-04-23 01:02:22', '86.245.248.200'),
(49, 35, '2022-04-24 14:08:35', '217.138.192.68');
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
=======
CREATE TABLE `messages` (
  `idMessage` int(11) NOT NULL,
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `idDiscussion` int(11) NOT NULL,
  `contenu` varchar(1500) NOT NULL,
  `date` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
<<<<<<< HEAD
  `dateModif` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;
=======
  `dateModif` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idMessage`, `idDiscussion`, `contenu`, `date`, `idUtilisateur`, `dateModif`) VALUES
(1, 1, 'Bonjour Ano!', '2021-04-02 15:06:30', 1, '2022-02-15 11:49:51'),
(2, 1, 'Bonjour Raph :)', '2021-04-02 15:20:17', 2, NULL),
(3, 1, 'AAAAAAAAAAAA!', '2021-04-02 15:24:40', 1, '2022-02-17 14:30:06'),
(16, 6, 'WAH !', '2021-10-18 14:34:52', 3, NULL),
<<<<<<< HEAD
(131, 59, 'test 2', '2022-03-18 11:21:02', 3, NULL),
(130, 58, 'test 1', '2022-03-18 11:20:52', 3, NULL),
(129, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id egestas ipsum. Vestibulum quam leo, ultricies nec venenatis in, fermentum eget tellus. Aliquam molestie interdum erat, ut accumsan magna auctor vel. Quisque sit amet tristique nunc. Etiam at eros ut ante scelerisque maximus. Fusce molestie mattis erat, a elementum nisi vehicula sit amet. Vivamus iaculis purus mattis lacus bibendum, sed dignissim mauris tempor. Sed dignissim, lorem non suscipit vulputate, ligula ante lobortis magna, in scelerisque orci nisl et sem.', '2022-03-16 15:03:56', 1, NULL),
(132, 60, 'test 3', '2022-03-18 11:21:18', 3, NULL);
=======
(135, 61, 'Salut Raph !', '2022-04-23 00:28:44', 35, NULL),
(130, 58, 'Salut Ano !', '2022-03-18 11:20:52', 3, '2022-04-23 00:23:06'),
(129, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id egestas ipsum. Vestibulum quam leo, ultricies nec venenatis in, fermentum eget tellus. Aliquam molestie interdum erat, ut accumsan magna auctor vel. Quisque sit amet tristique nunc. Etiam at eros ut ante scelerisque maximus. Fusce molestie mattis erat, a elementum nisi vehicula sit amet. Vivamus iaculis purus mattis lacus bibendum, sed dignissim mauris tempor. Sed dignissim, lorem non suscipit vulputate, ligula ante lobortis magna, in scelerisque orci nisl et sem.', '2022-03-16 15:03:56', 1, '2022-03-31 20:45:09'),
(136, 62, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor et arcu ut finibus. Nunc vel felis a erat feugiat feugiat eu non sem. Aenean tempus vehicula dui, nec maximus nibh interdum nec. Phasellus gravida tortor quis aliquam viverra. Pellentesque erat mi, bibendum luctus aliquet quis, sollicitudin pulvinar justo. Maecenas sed pellentesque justo.', '2022-04-23 00:32:15', 3, NULL),
(140, 61, 'Salut Admin :)', '2022-04-23 01:02:04', 1, NULL),
(139, 62, 'Bien vu !', '2022-04-23 01:01:25', 35, NULL);
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

-- --------------------------------------------------------

--
-- Structure de la table `messages_groupes`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `messages_groupes`;
CREATE TABLE IF NOT EXISTS `messages_groupes` (
  `idMessageGroupe` int(11) NOT NULL AUTO_INCREMENT,
=======
CREATE TABLE `messages_groupes` (
  `idMessageGroupe` int(11) NOT NULL,
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `idEquipe` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
<<<<<<< HEAD
  `dateModif` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessageGroupe`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
=======
  `dateModif` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `messages_groupes`
--

INSERT INTO `messages_groupes` (`idMessageGroupe`, `idEquipe`, `idUtilisateur`, `contenu`, `date`, `dateModif`) VALUES
(1, 4, 2, 'test modif réussi', '2021-10-18 13:24:54', '2021-10-18 14:32:57'),
(3, 2, 1, 'Yo la team !', '2021-11-18 10:06:59', '2021-11-18 10:13:53'),
(4, 2, 3, 'La pêche tout le monde ?', '2021-11-18 10:07:24', NULL),
(9, 2, 33, 'Est ce que quelqu\'un aurait la doc technique du projet Syvios ?', '2022-02-18 12:11:21', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participants_evenements`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `participants_evenements`;
CREATE TABLE IF NOT EXISTS `participants_evenements` (
  `idUtilisateur` int(11) NOT NULL,
  `idEvenement` int(11) NOT NULL,
  KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idEvenement` (`idEvenement`)
=======
CREATE TABLE `participants_evenements` (
  `idUtilisateur` int(11) NOT NULL,
  `idEvenement` int(11) NOT NULL
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participants_evenements`
--

INSERT INTO `participants_evenements` (`idUtilisateur`, `idEvenement`) VALUES
(3, 175),
(15, 178),
(2, 178),
(3, 178),
(1, 177),
(33, 177),
(2, 175),
(6, 180),
(33, 175),
(15, 180),
(33, 180),
(1, 175),
(3, 177),
(2, 182),
(15, 175),
(6, 175),
(1, 179),
(3, 179),
(2, 177),
(1, 182),
(1, 181),
(6, 181),
(3, 181),
(2, 181),
(1, 180),
(1, 178),
(33, 182),
(15, 182),
(6, 182),
(3, 182),
(6, 183),
(15, 183),
(2, 183),
(1, 183);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
=======
CREATE TABLE `projets` (
  `idProjet` int(11) NOT NULL,
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `idEquipe` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `etatProjet` int(11) NOT NULL,
  `nomProjet` varchar(100) NOT NULL,
<<<<<<< HEAD
  `importance` int(11) DEFAULT NULL,
  `illustration` varchar(300) DEFAULT NULL,
  `intitule` varchar(100) NOT NULL,
  `contexte` text,
  PRIMARY KEY (`idProjet`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
=======
  `intitule` varchar(100) NOT NULL,
  `contexte` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `projets`
--

<<<<<<< HEAD
INSERT INTO `projets` (`idProjet`, `idEquipe`, `dateDebut`, `dateFin`, `etatProjet`, `nomProjet`, `importance`, `illustration`, `intitule`, `contexte`) VALUES
(6, 2, '2021-11-01 09:30:00', '2022-04-20 14:00:00', 0, 'Syvios', 1, NULL, 'Site de formation en ligne', 'Développement d\'un site de formation en ligne pour l\'entreprise Quali\'consult avec affichage de notes, emploi du temps et messagerie instantanée.'),
(7, 2, '2021-12-09 09:30:00', '2022-04-28 17:00:00', 0, 'Projet Test', 1, NULL, 'Test de la gestion de projet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente sint ipsam quas, iste consectetur veritatis, error voluptates facilis at aperiam, fuga corporis ducimus eius ut dolorum? Pariatur sapiente autem exercitationem. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita dolore modi'),
(8, 2, '2021-11-22 09:35:45', '2022-07-20 09:40:45', 0, 'Cerbère', 1, NULL, 'Création d\'un outil de sécurité logiciel', '[CENSURÉ]'),
(17, 4, '2022-03-02 00:00:00', '2022-03-10 00:00:00', 0, 'test', NULL, NULL, 'test2', 'test2'),
(12, 4, '2022-02-01 00:00:00', '2022-02-15 00:00:00', 0, 'Test SQL', NULL, NULL, 'Test des triggers 2', ''),
(18, 4, '2022-03-21 00:00:00', '2022-03-07 00:00:00', 0, 'uhiu', NULL, NULL, 'uiuuig', '');
=======
INSERT INTO `projets` (`idProjet`, `idEquipe`, `dateDebut`, `dateFin`, `etatProjet`, `nomProjet`, `intitule`, `contexte`) VALUES
(6, 2, '2021-11-01 09:30:00', '2022-03-04 14:00:00', 0, 'Syvios', 'Site de formation en ligne', 'Développement d\'un site de formation en ligne pour l\'entreprise Quali\'consult avec affichage de notes, emploi du temps et messagerie instantanée.'),
(7, 5, '2021-12-09 09:30:00', '2021-12-29 17:00:00', 0, 'Projet Test', 'Test de la gestion de projet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente sint ipsam quas, iste consectetur veritatis, error voluptates facilis at aperiam, fuga corporis ducimus eius ut dolorum? Pariatur sapiente autem exercitationem. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita dolore modi'),
(8, 2, '2021-11-22 09:35:45', '2021-12-23 09:40:45', 0, 'Cerbère', 'Création d\'un outil de sécurité logiciel', '[CENSURÉ]'),
(20, 2, '2022-02-07 00:00:00', '2022-06-24 00:00:00', 0, 'AAA', 'Projet AAA', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(19, 3, '2022-04-04 08:00:00', '2022-04-29 17:00:00', 0, 'Quart d\'heure numérique', 'Campagne promotionnelle vidéo', 'Création d\'une série de vidéos promo pour x afin de blablabla'),
(21, 5, '2022-03-15 00:00:00', '2022-06-22 00:00:00', 1, 'Projet Test 2', 'Tout est dans le nom', 'TESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTESTEST');
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déclencheurs `projets`
--
<<<<<<< HEAD
DROP TRIGGER IF EXISTS `after_insert_projet`;
=======
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
DELIMITER $$
CREATE TRIGGER `after_insert_projet` AFTER INSERT ON `projets` FOR EACH ROW BEGIN
    INSERT INTO evenements(title, description, start, end, backgroundColor, borderColor, idCreateur)
    VALUES(CONCAT('Deadline ', NEW.nomProjet), CONCAT('Date de rendu du projet pour : ', NEW.contexte), DATE_SUB(NEW.dateFin, INTERVAL 1 HOUR), NEW.dateFin, "#dc3545", "#dc3545", NULL);
END
$$
DELIMITER ;
<<<<<<< HEAD
DROP TRIGGER IF EXISTS `after_update_projet`;
=======
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
DELIMITER $$
CREATE TRIGGER `after_update_projet` AFTER UPDATE ON `projets` FOR EACH ROW BEGIN
    DELETE FROM evenements
    WHERE title = CONCAT('Deadline ', OLD.nomProjet);

    INSERT INTO evenements(title, description, start, end, backgroundColor, borderColor, idCreateur)
    VALUES(CONCAT('Deadline ', NEW.nomProjet), CONCAT('Date de rendu du projet pour : ', NEW.contexte), DATE_SUB(NEW.dateFin, INTERVAL 1 HOUR), NEW.dateFin, "#dc3545", "#dc3545", NULL);
END
$$
DELIMITER ;
<<<<<<< HEAD
DROP TRIGGER IF EXISTS `before_delete_projet`;
=======
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
DELIMITER $$
CREATE TRIGGER `before_delete_projet` BEFORE DELETE ON `projets` FOR EACH ROW BEGIN
    DELETE FROM evenements
    WHERE title = CONCAT('Deadline ', OLD.nomProjet);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRole` int(11) NOT NULL,
  `nomRole` varchar(100) NOT NULL,
  PRIMARY KEY (`idRole`)
=======
CREATE TABLE `roles` (
  `idRole` int(11) NOT NULL,
  `nomRole` varchar(100) NOT NULL
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `nomRole`) VALUES
(0, 'Utilisateur'),
(1, 'Admin'),
(2, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

<<<<<<< HEAD
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
=======
CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `poste` varchar(100) NOT NULL,
  `identifiant` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'Utilisateur',
  `avatar` varchar(100) DEFAULT '../images/avatar/default_avatar.png',
  `token` varchar(15) DEFAULT NULL,
<<<<<<< HEAD
  `validation` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
=======
  `validation` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `poste`, `identifiant`, `mdp`, `role`, `avatar`, `token`, `validation`) VALUES
<<<<<<< HEAD
(1, 'Tisba', 'Raphael', 'Développeur web', 'raphael.tisba', '$2y$10$eM5Tglaj5CfUxRvXvim/a.wzO8kEYlXNnfcrvWIjOXmbZfCcgz5gO', 'SuperAdmin', '../images/avatar/Capture d’écran (90) - Copie - Copie.png', '2vSK89DF5GV0WjT', 1),
=======
(1, 'Tisba', 'Raphael', 'Développeur web', 'raphael.tisba', '$2y$10$eM5Tglaj5CfUxRvXvim/a.wzO8kEYlXNnfcrvWIjOXmbZfCcgz5gO', 'SuperAdmin', '../images/avatar/avatar_raphael.tisba.png', '2vSK89DF5GV0WjT', 1),
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
(2, 'Nyme', 'Ano', 'Secret', 'ano.nyme', '$2y$10$XnTrWL529Z.ST2wmUuPpTeB/sQmGFJU8nb5vzRGMjeUD3CwBOIyLS', 'Admin', '../images/avatar/default_avatar.png', NULL, 0),
(3, 'Entine', 'Clem', 'Développeur web', 'clem.entine', '$2y$10$9VLF2sBZWY8VLVKBBiWOkOo7KktwJ3nG6Ul8LlygTtluWduh2q3be', 'Utilisateur', '../images/avatar/avatar_clem.entine.png', NULL, 1),
(6, 'TEST', 'test', 'Stagiaire', 'test.test', '$2y$10$gSXgueCdVLAe4dn7sFF9X.X/UA2z33Z1t/dxkZgwkvgdB.l/.iD0a', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 1),
(15, 'AAA', 'BBBBBBB', 'DDDDD', 'bbbbbbb.aaaaaa', '$2a$11$ynyOcpLokY5bxZn/giOY1.7AwOh.V6ky3TBuejYdT0a0llCg8jxmS', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 0),
(36, 'Rasmus', 'Lerdorff', 'Développeur fullstack', 'lerdorff.rasmus', '$2a$11$78m/yqMLDCH.0PZwQe2xzOMbV1qiLlGjOF7Ha5fgbESiGq5Zxsfze', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 0),
(35, 'admin', 'admin', 'Admin', 'admin.admin', '$2a$11$lfHVQaRAWLfUauF79vN9wOrHnV9vNa3v2BllVn6hORAe52lfNMQRW', 'Admin', '../images/avatar/default_avatar.png', NULL, 1),
(37, 'Doe', 'John', 'Développeur Web', 'john.doe', '$2y$10$emtYf5bv8OlmN4', 'Utilisateur', '../images/avatar/default_avatar.png', '8hYF14OF5GV8wjT', 0),
<<<<<<< HEAD
(38, 'Hack', 'Eur', 'Méchant', 'eur.hack', '$2a$11$MBlbNanzsOEzhU1bkGQWO.6e4J4gA13tFOT3YhivpbW.4aupVphl2', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 0),
(39, 'aaa', 'bbb', 'ccc', 'bbb.aaa', '$2a$11$WnObY3UO1ztDYvysLfIiD.KnLY2WikR6YblHAHutYjilr8WkKaQHq', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 0),
(40, 'fgdf', 'gdfgdgf', 'jhBGJHG', 'hjghg.hghjg', '$2a$11$hb939Sxfs5RALZTpkQW09.AQeoCIYO8rP2RyUEg7S2Q3i3fCtGPoO', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 0);
=======
(39, 'aaa', 'bbb', 'ccc', 'bbb.aaa', '$2a$11$WnObY3UO1ztDYvysLfIiD.KnLY2WikR6YblHAHutYjilr8WkKaQHq', 'Utilisateur', '../images/avatar/default_avatar.png', NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `composition_equipes`
--
ALTER TABLE `composition_equipes`
  ADD KEY `idEquipe` (`idEquipe`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`idDiscussion`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`idEquipe`);

--
-- Index pour la table `etapes`
--
ALTER TABLE `etapes`
  ADD PRIMARY KEY (`idEtape`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ip_bannies`
--
ALTER TABLE `ip_bannies`
  ADD PRIMARY KEY (`idBannissement`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idLog`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `messages_groupes`
--
ALTER TABLE `messages_groupes`
  ADD PRIMARY KEY (`idMessageGroupe`);

--
-- Index pour la table `participants_evenements`
--
ALTER TABLE `participants_evenements`
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idEvenement` (`idEvenement`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`idProjet`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `idDiscussion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `idEquipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `etapes`
--
ALTER TABLE `etapes`
  MODIFY `idEtape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT pour la table `ip_bannies`
--
ALTER TABLE `ip_bannies`
  MODIFY `idBannissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT pour la table `messages_groupes`
--
ALTER TABLE `messages_groupes`
  MODIFY `idMessageGroupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
>>>>>>> 89a37272283f7803ed0c1caab1a665c6ac9e12cc
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
