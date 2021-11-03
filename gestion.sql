-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 oct. 2021 à 07:56
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `idDepense` int(11) NOT NULL AUTO_INCREMENT,
  `nomDepense` varchar(100) NOT NULL,
  `depense` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idDepense`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`idDepense`, `nomDepense`, `depense`, `date`) VALUES
(11, 'glace', 44, '2021-03-19'),
(12, 'Charges salariales', 4, '2021-03-27');

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

DROP TABLE IF EXISTS `discussions`;
CREATE TABLE IF NOT EXISTS `discussions` (
  `idDiscussion` int(11) NOT NULL AUTO_INCREMENT,
  `idEnvoyeur` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  PRIMARY KEY (`idDiscussion`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `discussions`
--

INSERT INTO `discussions` (`idDiscussion`, `idEnvoyeur`, `idDestinataire`) VALUES
(1, 2, 1),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `idSecteur` int(11) NOT NULL,
  `nomEquipe` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idEquipe`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `idSecteur`, `nomEquipe`) VALUES
(1, 1, 'infra');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `backgroundColor` varchar(7) NOT NULL DEFAULT '#007bff',
  `borderColor` varchar(7) NOT NULL DEFAULT '#007bff',
  `textColor` varchar(7) NOT NULL DEFAULT '#ffffff',
  `url` varchar(255) DEFAULT NULL,
  `nom_url` varchar(255) DEFAULT NULL,
  `idCreateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `title`, `description`, `start`, `end`, `backgroundColor`, `borderColor`, `textColor`, `url`, `nom_url`, `idCreateur`) VALUES
(1, 'Rassemblement AAAAAAAAAA', 'Reunion maAAAAAAAAA', '2021-10-18 09:30:00', '2021-10-18 11:30:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 1),
(2, 'Présentation de azur v.1.4.2', 'Présentation de l\'outil', '2021-10-18 14:00:00', '2021-10-18 16:00:00', '#007bff', '#007bff', '#ffffff', NULL, NULL, 2),
(3, 'E-learning C#', 'Apprentissage du C# avec Openclassrooms', '2021-10-19 10:00:00', '2021-10-18 12:30:00', '#007bff', '#007bff', '#ffffff', 'https://openclassrooms.com/fr/courses/3178966-apprendre-a-coder-pour-les-vrais-debutants/3181011-mise-en-place-du-code-c', 'lien openclassrooms', 1);

-- --------------------------------------------------------

--
-- Structure de la table `financepar`
--

DROP TABLE IF EXISTS `financepar`;
CREATE TABLE IF NOT EXISTS `financepar` (
  `idUtilisateur` int(11) NOT NULL,
  `idDepense` int(11) NOT NULL,
  `pourcentageAlloue` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idDepense`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

DROP TABLE IF EXISTS `horaires`;
CREATE TABLE IF NOT EXISTS `horaires` (
  `idUtilisateur` int(11) NOT NULL,
  `idSecteur` int(11) NOT NULL,
  `heureDebut` int(11) NOT NULL,
  `heureFin` int(11) NOT NULL,
  `jour` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idDiscussion` int(11) NOT NULL,
  `contenu` varchar(1500) NOT NULL,
  `date` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateModif` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idMessage`, `idDiscussion`, `contenu`, `date`, `idUtilisateur`, `dateModif`) VALUES
(1, 1, 'Bonjour Ano!', '2021-04-02 15:06:30', 1, '2021-10-10 10:11:13'),
(2, 1, 'Bonjour Raph :)', '2021-04-02 15:20:17', 2, NULL),
(3, 1, 'AAAAAAAAAAAAAAAAA', '2021-04-02 15:24:40', 1, '2021-10-15 15:50:17'),
(16, 6, 'WAH !', '2021-10-18 14:34:52', 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messagesgroupe`
--

DROP TABLE IF EXISTS `messagesgroupe`;
CREATE TABLE IF NOT EXISTS `messagesgroupe` (
  `idMessageGroupe` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipe` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
  `dateModif` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessageGroupe`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messagesgroupe`
--

INSERT INTO `messagesgroupe` (`idMessageGroupe`, `idEquipe`, `idUtilisateur`, `contenu`, `date`, `dateModif`) VALUES
(1, 1, 2, 'test modif réussi', '2021-10-18 13:24:54', '2021-10-18 14:32:57');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipe` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `fini` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `importance` int(11) DEFAULT NULL,
  `illustration` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idProjet`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`idProjet`, `idEquipe`, `dateDebut`, `dateFin`, `fini`, `nom`, `importance`, `illustration`) VALUES
(1, 1, '2021-09-23 00:00:00', '2021-10-10 00:00:00', 0, 'marchand', 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `revenus`
--

DROP TABLE IF EXISTS `revenus`;
CREATE TABLE IF NOT EXISTS `revenus` (
  `idRevenu` int(11) NOT NULL AUTO_INCREMENT,
  `nomRevenu` varchar(100) NOT NULL,
  `gains` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idRevenu`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `revenus`
--

INSERT INTO `revenus` (`idRevenu`, `nomRevenu`, `gains`, `date`) VALUES
(5, '1', 7, '0007-07-07');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRole` int(11) NOT NULL,
  `nomRole` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `nomRole`) VALUES
(1, 'Membre'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `salaire`
--

DROP TABLE IF EXISTS `salaire`;
CREATE TABLE IF NOT EXISTS `salaire` (
  `idSalaire` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `salaire` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idSalaire`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salaire`
--

INSERT INTO `salaire` (`idSalaire`, `idUtilisateur`, `salaire`, `date`) VALUES
(1, 2, 2000, '2021-09-23 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `secteurs`
--

DROP TABLE IF EXISTS `secteurs`;
CREATE TABLE IF NOT EXISTS `secteurs` (
  `idSecteur` int(11) NOT NULL AUTO_INCREMENT,
  `nomSecteur` varchar(100) NOT NULL,
  `budget` int(11) NOT NULL,
  PRIMARY KEY (`idSecteur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `secteurs`
--

INSERT INTO `secteurs` (`idSecteur`, `nomSecteur`, `budget`) VALUES
(1, 'Développement', 0),
(2, 'R&D', 0),
(3, 'Marketing', 0),
(4, 'Ressources humaines', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `poste` varchar(100) NOT NULL,
  `idEquipe` int(11) DEFAULT NULL,
  `identifiant` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `idRole` int(11) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `poste`, `idEquipe`, `identifiant`, `mdp`, `idRole`, `avatar`) VALUES
(1, 'Tisba', 'Raphael', 'Développeur web', 1, 'raphael.tisba', '$2y$10$5rUnYHVmnNqunSVRKvMf1uMngIj50yyX9WLmex2Hu9x6UXOdjc4Ji', 1, '../images/avatar/avatar_raphael.tisba.png'),
(2, 'Nyme', 'Ano', 'Secret', 2, 'ano.nyme', '$2y$10$XnTrWL529Z.ST2wmUuPpTeB/sQmGFJU8nb5vzRGMjeUD3CwBOIyLS', 1, '../images/avatar/avatarUtilisateur2'),
(3, 'Entine', 'Clem', 'Développeur web', 1, 'clem.entine', '$2y$10$9VLF2sBZWY8VLVKBBiWOkOo7KktwJ3nG6Ul8LlygTtluWduh2q3be', 1, '../images/avatar/avatar_clem.entine.png'),
(5, 'test', 'test', 'test', 2, 'test.test', '$2y$10$wimsBKhuwWuiBz1ci4HdneINV/b8flVo.cDRtmwIGF4HcXtMgSZo.', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
