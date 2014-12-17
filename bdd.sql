# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Hôte: 127.0.0.1 (MySQL 5.6.22)
# Base de données: racoin
# Temps de génération: 2014-12-17 09:50:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table annonce
# ------------------------------------------------------------

DROP TABLE IF EXISTS `annonce`;

CREATE TABLE `annonce` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `id_sous_categorie` int(11) DEFAULT NULL,
  `id_annonceur` int(11) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` text,
  `ville` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `id_sous_categorie_idxfk` (`id_sous_categorie`),
  KEY `id_annonceur_idxfk` (`id_annonceur`),
  KEY `id_departement_idxfk` (`id_departement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Affichage de la table annonceur
# ------------------------------------------------------------

DROP TABLE IF EXISTS `annonceur`;

CREATE TABLE `annonceur` (
  `id_annonceur` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `nom_annonceur` varchar(255) DEFAULT NULL,
  `telephone` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_annonceur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Affichage de la table categorie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Affichage de la table departement
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departement`;

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) DEFAULT NULL,
  `nom_departement` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_departement`),
  KEY `id_region_idxfk` (`id_region`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Affichage de la table photo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) DEFAULT NULL,
  `url_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `id_annonce_idxfk` (`id_annonce`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Affichage de la table region
# ------------------------------------------------------------

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Affichage de la table sous_categorie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sous_categorie`;

CREATE TABLE `sous_categorie` (
  `id_sous_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) DEFAULT NULL,
  `nom_sous_categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sous_categorie`),
  KEY `id_categorie_idxfk` (`id_categorie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
