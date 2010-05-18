-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 18 Mai 2010 à 23:37
-- Version du serveur: 5.1.30
-- Version de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `olivet`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE IF NOT EXISTS `actualite` (
  `actualite_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de l''actualite',
  `actualite_libelle` varchar(100) NOT NULL COMMENT 'libelle de l''actualite',
  `actualite_descriptif` text NOT NULL COMMENT 'descriptif de l''actualite',
  `actualite_etat` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'etat de l''actualite, 0 = inactif, 1 = actif ',
  `actualite_datecreation` datetime NOT NULL COMMENT 'date de creation de l''actualite',
  `actualite_datemodification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date de modification de l''actualite',
  `actualite_type` varchar(4) NOT NULL DEFAULT 'GAEC' COMMENT 'type de l''actualite (GAEC pour gaec, LOMA pour local et/ou monde agricole',
  `actualite_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Est-ce que l''actualitÃ© est une nouveautÃ©',
  PRIMARY KEY (`actualite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des actualites' AUTO_INCREMENT=7 ;

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`actualite_id`, `actualite_libelle`, `actualite_descriptif`, `actualite_etat`, `actualite_datecreation`, `actualite_datemodification`, `actualite_type`, `actualite_nouveaute`) VALUES
(3, 'Actu GAEC', 'Actu GAEC\r\nActu GAEC\r\nActu GAEC', 1, '2010-02-01 20:05:56', '2010-04-23 10:49:51', 'GAEC', 1),
(4, 'Actu locale', 'Actu locale\r\nActu locale\r\nActu locale\r\nActu locale', 1, '2010-02-01 20:06:13', '2010-04-23 10:49:45', 'LOMA', 1),
(5, 'Actu GAEC 2', 'Actu GAEC 2\r\nActu GAEC 2\r\nActu GAEC 2', 1, '2010-02-01 20:09:11', '2010-04-23 10:49:34', 'GAEC', 1),
(6, 'Actu locale2', 'localÃ©\r\nlocale\r\nlocale', 1, '2010-02-01 20:09:40', '2010-04-23 10:48:41', 'LOMA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `categorie_produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la categorie',
  `categorie_produit_libelle` varchar(100) NOT NULL COMMENT 'libelle de la categorie',
  `categorie_produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat de la categorie 0 = inactif, 1 = actif',
  PRIMARY KEY (`categorie_produit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des categories de produits' AUTO_INCREMENT=27 ;

--
-- Contenu de la table `categorie_produit`
--

INSERT INTO `categorie_produit` (`categorie_produit_id`, `categorie_produit_libelle`, `categorie_produit_etat`) VALUES
(17, 'Huile', 1),
(18, 'Farine', 1),
(19, 'Miel', 1),
(20, 'Boissons', 1),
(21, 'Pain', 1),
(22, 'Oeufs', 1),
(23, 'Viandes', 1),
(24, 'Fruits', 1),
(25, 'LÃ©gumes', 1),
(26, 'Produits laitiers', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_reference` int(11) NOT NULL AUTO_INCREMENT COMMENT 'reference du client',
  `client_civilite` varchar(5) DEFAULT NULL COMMENT 'civilite du client',
  `client_nom` varchar(100) NOT NULL COMMENT 'nom du client',
  `client_prenom` varchar(100) NOT NULL COMMENT 'prenom du client',
  `client_adresse` varchar(500) DEFAULT NULL COMMENT 'adresse du client',
  `client_code_postal` varchar(10) DEFAULT NULL COMMENT 'code postal de la commune du client',
  `client_commune` varchar(100) DEFAULT NULL COMMENT 'commune du client',
  `client_numero_tel` varchar(20) DEFAULT NULL COMMENT 'numero de telephone du client',
  `client_email` varchar(100) NOT NULL COMMENT 'email du client',
  `client_code` varchar(10) NOT NULL COMMENT 'code aleatoire du client',
  PRIMARY KEY (`client_reference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='liste des clients' AUTO_INCREMENT=13 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`client_reference`, `client_civilite`, `client_nom`, `client_prenom`, `client_adresse`, `client_code_postal`, `client_commune`, `client_numero_tel`, `client_email`, `client_code`) VALUES
(4, 'mr', 'Trepos', 'Gwen', '2 rue des Vignes', '35530', 'Servon sur Vilaine', '06 17 35 00 01', 'gwenael.trepos@gmail.com', 'azerty'),
(5, 'melle', 'Guillemin', 'Sandra', '2 rue des Vignes', '35530', 'Servon sur Vilaine', '02 15 45  45 48', 's_guillemin@hotmail.com', '1234567890'),
(6, 'mr', 'Trepos', 'Ronan', '8 r St FerrÃ©ol', '31000', 'Toulouse', '02 15 45  45 48', 'ronan.trepos@gmail.com', '1a2b3c4d5e'),
(8, 'mme', 'Guillemin', 'Nicole', '', '', '', '02 12 12 12 12', 'nicole.guillemin@test.fr', 'rbghefklib'),
(9, 'mr', 'Trepos', 'Raymond', '38 rue du clos des vignes', '35690', 'AcignÃ©', '02 99 62 25 24', 'raymond.trepos@test.fr', 'uc98dgwv9r'),
(10, 'mme', 'TREPOS', 'MichÃ¨le', '38 rue du clos des vignes', '35690', 'AcignÃ©', '02 99 62 25 24', 'michele.trepos@test.fr', 'thx78sa9k1'),
(11, NULL, 'qsd', 'qd', '', '', '', 'qds', 'gt', 'azerty'),
(12, 'mr', 'TREPOS', 'gt', '', '', '', '0617350001', 'gt@test.fr', 'azerty');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la commande',
  `commande_id_client` int(11) NOT NULL COMMENT 'identifiant du client',
  `commande_datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de creation de la commande',
  `commande_etat` varchar(2) NOT NULL DEFAULT 'EC' COMMENT 'etat de la commande : EC = en cours, FA = facturee',
  `commande_daterecuperation` timestamp NULL DEFAULT NULL COMMENT 'date de recuperation de la commande',
  PRIMARY KEY (`commande_id`),
  KEY `commande_client_fk` (`commande_id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des commandes' AUTO_INCREMENT=18 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`commande_id`, `commande_id_client`, `commande_datecreation`, `commande_etat`, `commande_daterecuperation`) VALUES
(12, 4, '2010-01-29 19:15:08', 'EC', '2010-02-02 00:00:00'),
(14, 12, '2010-01-30 10:12:22', 'EC', '2010-02-03 00:00:00'),
(15, 4, '2010-01-31 18:47:04', 'EC', '2010-02-02 00:00:00'),
(16, 4, '2010-01-31 18:48:11', 'EC', '2010-02-02 00:00:00'),
(17, 4, '2010-01-31 18:52:09', 'EC', '2010-02-03 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `conditionnement`
--

CREATE TABLE IF NOT EXISTS `conditionnement` (
  `cond_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du conditionnement',
  `cond_id_produit` int(11) NOT NULL COMMENT 'identifiant du produit',
  `cond_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'est-ce que le conditionnement est une nouveaute ? 0 = non, 1 = oui',
  `cond_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du conditionnement 0 = inactif 1 = actif ',
  `cond_prix` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'prix a ajouter pour le conditionnement',
  `cond_nom` varchar(50) DEFAULT NULL COMMENT 'nom du conditionnemment',
  `cond_a_stock` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'conditionnement soumis Ã  stock 0 = non 1 = oui ',
  `cond_nb_stock` int(11) NOT NULL DEFAULT '0' COMMENT 'nombre de ce conditionnement en stock',
  `cond_divisible` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'est ce que le conditionnement est divisible ?',
  `cond_remise` decimal(5,3) NOT NULL DEFAULT '0.000' COMMENT 'remise',
  `cond_tva` decimal(4,2) NOT NULL DEFAULT '5.50' COMMENT 'tva',
  PRIMARY KEY (`cond_id`),
  KEY `cond_produit_fk` (`cond_id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des produits conditionnes' AUTO_INCREMENT=162 ;

--
-- Contenu de la table `conditionnement`
--

INSERT INTO `conditionnement` (`cond_id`, `cond_id_produit`, `cond_nouveaute`, `cond_etat`, `cond_prix`, `cond_nom`, `cond_a_stock`, `cond_nb_stock`, `cond_divisible`, `cond_remise`, `cond_tva`) VALUES
(47, 36, 0, 0, '0.00', 'bouteille d''un litre', 0, -1, 0, '0.000', '5.50'),
(48, 37, 0, 0, '0.00', 'paquet', 0, -1, 0, '0.000', '5.50'),
(49, 38, 0, 0, '0.00', 'paquet', 0, -1, 0, '0.000', '5.50'),
(50, 39, 0, 0, '0.00', 'paquet', 0, -1, 0, '0.000', '5.50'),
(51, 40, 1, 1, '7.00', 'pot 1 kg.', 0, -1, 0, '0.000', '5.50'),
(52, 40, 0, 1, '3.50', 'pot 500 gr.', 0, -1, 0, '0.000', '5.50'),
(53, 41, 0, 1, '0.00', 'bouteille 1 litre', 0, -1, 0, '0.000', '5.50'),
(54, 42, 0, 1, '2.20', 'bouteille 75 cl', 0, -1, 0, '0.000', '19.60'),
(55, 43, 0, 1, '3.80', 'bouteille 75 cl', 0, -1, 0, '0.000', '19.60'),
(56, 44, 0, 1, '3.60', 'bouteille 75 cl', 0, -1, 0, '0.000', '19.60'),
(57, 45, 0, 1, '3.60', 'bouteille 75 cl', 0, -1, 0, '0.000', '19.60'),
(58, 46, 0, 1, '3.70', 'bouteille 75 cl', 0, -1, 0, '0.000', '19.60'),
(59, 47, 0, 1, '3.90', '1 kg', 0, -1, 0, '0.000', '5.50'),
(60, 47, 0, 1, '2.00', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(61, 118, 0, 1, '3.80', '900 gr.', 0, -1, 0, '0.000', '5.50'),
(62, 118, 0, 1, '1.70', '400 gr.', 0, -1, 0, '0.000', '5.50'),
(63, 48, 0, 0, '0.00', '300 gr.', 0, -1, 0, '0.000', '5.50'),
(64, 49, 0, 0, '0.00', '300 gr.', 0, -1, 0, '0.000', '5.50'),
(65, 50, 0, 0, '0.00', '300 gr.', 0, -1, 0, '0.000', '5.50'),
(66, 51, 0, 0, '0.00', '300 gr.', 0, -1, 0, '0.000', '5.50'),
(67, 52, 0, 1, '1.80', '6 oeufs', 0, -1, 0, '0.000', '5.50'),
(68, 52, 0, 1, '3.60', '12 oeufs', 0, -1, 0, '0.000', '5.50'),
(69, 52, 0, 1, '0.30', 'vrac', 0, -1, 0, '0.000', '5.50'),
(70, 53, 0, 1, '12.70', 'pot 1kg', 0, -1, 0, '0.000', '5.50'),
(73, 55, 0, 1, '5.50', 'pot 180 gr.', 0, -1, 0, '0.000', '5.50'),
(74, 56, 0, 1, '5.40', 'pot 180 gr.', 0, -1, 0, '0.000', '5.50'),
(75, 57, 0, 1, '5.40', 'pot 190 gr.', 0, -1, 0, '0.000', '5.50'),
(76, 58, 0, 1, '6.20', 'pot 200 gr.', 0, -1, 0, '0.000', '5.50'),
(77, 59, 0, 1, '5.50', 'pot 200 gr.', 0, -1, 0, '0.000', '5.50'),
(78, 60, 0, 1, '2.00', 'vrac au kg', 0, -1, 1, '0.000', '5.50'),
(79, 61, 0, 1, '2.00', 'vrac au kg', 0, -1, 1, '0.000', '5.50'),
(80, 62, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(81, 63, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(82, 64, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(83, 65, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(84, 66, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(85, 67, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(86, 68, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(87, 69, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(88, 70, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(89, 71, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(90, 72, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(91, 73, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(92, 74, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(93, 75, 0, 0, '0.00', 'vrac', 0, -1, 1, '0.000', '5.50'),
(94, 76, 0, 0, '0.00', 'vrac', 0, -1, 0, '0.000', '5.50'),
(96, 81, 0, 1, '4.50', 'vrac au kg', 0, -1, 1, '0.000', '5.50'),
(97, 79, 0, 1, '1.20', 'vrac au kg', 0, -1, 1, '0.000', '5.50'),
(98, 80, 0, 1, '1.20', 'vrac au kg', 0, -1, 1, '0.000', '5.50'),
(99, 82, 0, 1, '0.70', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(100, 83, 0, 1, '0.70', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(101, 84, 0, 1, '0.70', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(102, 85, 0, 1, '0.70', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(103, 86, 0, 1, '0.65', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(104, 87, 0, 1, '0.50', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(105, 88, 0, 1, '0.65', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(106, 90, 0, 1, '0.45', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(107, 91, 0, 1, '2.80', '200 gr.', 0, -1, 0, '0.000', '5.50'),
(108, 92, 0, 1, '2.80', '200 gr.', 0, -1, 0, '0.000', '5.50'),
(109, 93, 0, 1, '2.80', '200 gr.', 0, -1, 0, '0.000', '5.50'),
(110, 94, 0, 1, '2.20', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(111, 95, 0, 1, '2.10', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(112, 96, 0, 1, '2.15', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(113, 97, 0, 1, '2.10', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(114, 98, 0, 1, '2.00', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(115, 99, 0, 1, '0.50', '100 gr.', 0, -1, 0, '0.000', '5.50'),
(117, 100, 0, 1, '1.60', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(118, 100, 0, 1, '3.10', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(119, 100, 0, 1, '6.00', '1 kg', 0, -1, 0, '0.000', '5.50'),
(120, 101, 0, 1, '1.90', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(121, 101, 0, 1, '3.70', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(122, 101, 0, 1, '7.20', '1 kg', 0, -1, 0, '0.000', '5.50'),
(123, 102, 0, 1, '2.20', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(124, 102, 0, 1, '4.30', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(125, 102, 0, 1, '8.30', '1 kg', 0, -1, 0, '0.000', '5.50'),
(126, 103, 0, 1, '1.60', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(127, 103, 0, 1, '3.00', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(128, 103, 0, 1, '5.80', '1 kg', 0, -1, 0, '0.000', '5.50'),
(129, 116, 0, 1, '2.40', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(130, 116, 0, 1, '4.60', '1 kg', 0, -1, 0, '0.000', '5.50'),
(131, 104, 0, 1, '1.80', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(132, 104, 0, 1, '3.60', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(133, 104, 0, 1, '7.00', '1 kg', 0, -1, 0, '0.000', '5.50'),
(134, 105, 0, 1, '2.10', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(135, 105, 0, 1, '4.20', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(136, 105, 0, 1, '8.20', '1 kg', 0, -1, 0, '0.000', '5.50'),
(137, 106, 0, 1, '2.10', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(138, 106, 0, 1, '4.20', '500 gr.', 0, -1, 0, '0.000', '5.50'),
(139, 106, 0, 1, '8.20', '1 kg', 0, -1, 0, '0.000', '5.50'),
(140, 107, 0, 1, '2.20', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(141, 107, 0, 1, '4.25', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(142, 108, 0, 1, '2.10', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(143, 108, 0, 1, '4.20', '250 gr.', 0, -1, 0, '0.000', '5.50'),
(144, 109, 0, 1, '3.60', '25 cl', 0, -1, 0, '0.000', '5.50'),
(145, 109, 0, 1, '7.00', '50 cl', 0, -1, 0, '0.000', '5.50'),
(146, 109, 0, 1, '13.80', '1 l', 0, -1, 0, '0.000', '5.50'),
(147, 110, 0, 1, '3.60', '25 cl', 0, -1, 0, '0.000', '5.50'),
(148, 89, 0, 1, '0.55', '125 gr.', 0, -1, 0, '0.000', '5.50'),
(149, 110, 0, 1, '7.00', '50 cl', 0, -1, 0, '0.000', '5.50'),
(150, 110, 0, 1, '14.00', '1 litre', 0, -1, 0, '0.000', '5.50'),
(151, 117, 0, 1, '1.00', '1 litre', 0, -1, 0, '0.000', '5.50'),
(153, 111, 0, 1, '1.80', '1 litre', 0, -1, 0, '0.000', '5.50'),
(154, 113, 0, 1, '0.90', 'vrac au litre', 0, -1, 0, '0.000', '5.50'),
(155, 113, 0, 1, '0.80', '1 litre', 0, -1, 0, '0.000', '5.50'),
(156, 112, 0, 1, '0.85', 'vrac au litre', 0, -1, 0, '0.000', '5.50'),
(157, 112, 0, 1, '1.70', '1 litre', 0, -1, 0, '0.000', '5.50'),
(158, 114, 0, 1, '0.80', 'vrac au litre', 0, -1, 0, '0.000', '5.50'),
(159, 114, 1, 1, '1.60', '1 litre', 0, -1, 0, '0.000', '5.50'),
(160, 53, 0, 1, '10.70', '750 gr.', 0, -1, 0, '0.000', '5.50'),
(161, 119, 0, 0, '0.00', '1 kg', 0, -1, 0, '0.000', '5.50');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `facture_ref` int(11) NOT NULL AUTO_INCREMENT COMMENT 'reference de la facture',
  `facture_id_commande` int(11) NOT NULL COMMENT 'identifiant de la commande',
  `facture_date_facture` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date d''edition de la facture',
  PRIMARY KEY (`facture_ref`),
  KEY `facture_comande_fk` (`facture_id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `facture`
--


-- --------------------------------------------------------

--
-- Structure de la table `lien_commande_cond`
--

CREATE TABLE IF NOT EXISTS `lien_commande_cond` (
  `lcc_id_commande` int(11) NOT NULL COMMENT 'identifiant de commande',
  `lcc_id_cond` int(11) NOT NULL COMMENT 'identifiant de conditionnement',
  `lcc_quantite` decimal(5,2) NOT NULL COMMENT 'quantite du conditionnement dans la commande',
  PRIMARY KEY (`lcc_id_commande`,`lcc_id_cond`),
  KEY `lcc_cond_fk` (`lcc_id_cond`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `lien_commande_cond`
--

INSERT INTO `lien_commande_cond` (`lcc_id_commande`, `lcc_id_cond`, `lcc_quantite`) VALUES
(12, 58, '2.00'),
(14, 96, '0.20'),
(15, 58, '1.00'),
(16, 58, '1.00'),
(17, 78, '2.50');

-- --------------------------------------------------------

--
-- Structure de la table `lien_commande_produit_resa`
--

CREATE TABLE IF NOT EXISTS `lien_commande_produit_resa` (
  `lcpr_id_commande` int(11) NOT NULL COMMENT 'identifiant de commande',
  `lcpr_id_produit_resa` int(11) NOT NULL COMMENT 'identifiant du produit a la reservation',
  `lcpr_quantite` int(11) NOT NULL COMMENT 'quantite de ce produit dans la commande',
  PRIMARY KEY (`lcpr_id_commande`,`lcpr_id_produit_resa`),
  KEY `lcpr_produit_resa_fk` (`lcpr_id_produit_resa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `lien_commande_produit_resa`
--

INSERT INTO `lien_commande_produit_resa` (`lcpr_id_commande`, `lcpr_id_produit_resa`, `lcpr_quantite`) VALUES
(12, 45, 3);

-- --------------------------------------------------------

--
-- Structure de la table `parametrage`
--

CREATE TABLE IF NOT EXISTS `parametrage` (
  `parametre` varchar(100) NOT NULL,
  `valeur` text NOT NULL,
  PRIMARY KEY (`parametre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parametrage`
--

INSERT INTO `parametrage` (`parametre`, `valeur`) VALUES
('condition_vente', 'Merci de passer vos commandes avant le mardi soir et de venir les chercher sur l''exploitation Ã  partir du vendredi midi jusqu''au samedi midi.\r\nMerci pour votre comprÃ©hension.');

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE IF NOT EXISTS `partenaire` (
  `partenaire_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du partenaire',
  `partenaire_libelle` varchar(100) NOT NULL COMMENT 'libelle du partenaire',
  `partenaire_descriptif` varchar(100) NOT NULL COMMENT 'descriptif du partenaire',
  `partenaire_siteweb` varchar(100) NOT NULL COMMENT 'adresse du site web du partenaire',
  `partenaire_rang` int(11) NOT NULL COMMENT 'rang d''affichage du partenaire',
  `partenaire_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du partenaire 0 = inactif, 1 = actif ',
  `partenaire_logo` varchar(100) DEFAULT NULL COMMENT 'logo du partenaire',
  PRIMARY KEY (`partenaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `partenaire`
--

INSERT INTO `partenaire` (`partenaire_id`, `partenaire_libelle`, `partenaire_descriptif`, `partenaire_siteweb`, `partenaire_rang`, `partenaire_etat`, `partenaire_logo`) VALUES
(2, 'Accueil Paysan', 'Accueil paysan', 'http://www.accueil-paysan.com/', 1, 1, 'Logo_accueil_paysan.gif '),
(3, 'FRAB', 'Agrobio Bretagne', 'http://www.agrobio-bretagne.org/', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

CREATE TABLE IF NOT EXISTS `producteur` (
  `producteur_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du producteur',
  `producteur_libelle` varchar(100) NOT NULL COMMENT 'libelle du producteur',
  `producteur_adresse` varchar(100) DEFAULT NULL COMMENT 'adresse du producteur',
  `producteur_latitude` varchar(20) NOT NULL COMMENT 'latitude google map',
  `producteur_longitude` varchar(20) NOT NULL COMMENT 'longitude google map',
  `producteur_descriptif` text NOT NULL COMMENT 'descriptif du producteur',
  `producteur_rang` int(11) NOT NULL COMMENT 'rang d''affichage du producteur',
  `producteur_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du producteur 0 = inactif, 1 = actif ',
  `producteur_picto` varchar(100) NOT NULL COMMENT 'Photo du producteur',
  `producteur_photo` varchar(100) DEFAULT NULL COMMENT 'photo du producteur',
  PRIMARY KEY (`producteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `producteur`
--

INSERT INTO `producteur` (`producteur_id`, `producteur_libelle`, `producteur_adresse`, `producteur_latitude`, `producteur_longitude`, `producteur_descriptif`, `producteur_rang`, `producteur_etat`, `producteur_picto`, `producteur_photo`) VALUES
(3, 'Beucher Henry', 'Les Forges	53240 Montflours', '48.177956', '-0.728906', '<b>Jour livraison : </b>mardi<br><b>Produits : </b>pommes de terre', 1, 1, 'mm_20_black.png', ''),
(4, 'Blin Michel / SantÃ´s Johny', 'La BaronniÃ¨re - St Melaine 35220 Chateaubourg', '48.11814', '-1.373388', '<hr>Blin Michel<br><b>Produits : </b>jus de pommes - farine - huile<br><hr>Santos Johny<br><b>Jour de livraison : </b>vendredi ou samedi<br><b>Produits : </b>pain', 2, 1, 'mm_20_blue.png', ''),
(5, 'Daligault Arnaud', 'La Janaie 35520 Montreuil le gast', '48.255113', '-1.722493', '<b>Produits : </b>lÃ©gumes', 3, 1, 'mm_20_brown.png', ''),
(6, 'Ferme de la Cour (Gauthier Laurent, Langlois Nathalie) / Gauthier Sylvain', 'ChaumÃ©rÃ© 35113 DomagnÃ©', '48.041017', '-1.423486', '<hr>Ferme de la cour<br>Gauthier Laurent <b>Jour de livraison : </b>jeudi aprÃ¨s midi <b>Produits : </b>pain<br>Langlois Nathalie <b>Produits : </b>caissette veaux<br><hr>Gauthier Sylvain <b>Jour de livraison : </b>mardi aprÃ¨s midi <b>Produits : </b>pain', 4, 1, 'mm_20_gray.png', ''),
(8, 'Guerillon LoÃ¯c', 'La MolliÃ¨re 35580 Guignen', '47.95737', '-1.897368', '<b>Produits : </b>terrine - rillettes', 6, 1, 'mm_20_green.png', ''),
(9, 'Brasserie de l''Ombre (Guyader Steven)', 'L''Ombre 35750 Iffendic', '48.145766', '-2.019089', '<b>Produits : </b>biÃ¨res', 7, 1, 'mm_20_orange.png', ''),
(10, 'EARL les Vergers de l''Ille (Lehuger Etienne)', 'La FouinardiÃ¨re 35760 St GrÃ©goire', '48.166436', '-1.704812', '<b>Produits : </b>cidre - pommes', 9, 1, 'mm_20_red.png', ''),
(11, 'PelÃ© Jean-Yves', '3 rue de Coquerelle 35690 AcignÃ©', '48.136924', '-1.527035', '<b>Produits : </b>miel', 10, 1, 'mm_20_white.png', ''),
(12, 'GAEC du Pressoir (Piel StÃ©phanie)', '2 Place de la poste 22830 Plouasne', '48.300357', '-2.006641', '<b>Produits : </b>charcuterie', 11, 1, 'mm_20_yellow.png', ''),
(13, 'PriÃ© Jean-FranÃ§ois', 'La RuÃ©e 35360 Boisgervilly', '48.152681', '-2.070633', '<b>Produits : </b>lÃ©gumes', 12, 1, 'mm_20_black.png', ''),
(14, 'Renault Marie-Bernard', 'Le grand chÃ¨ne - ChaumÃ©rÃ©	35113 DomagnÃ©', '48.042265', '-1.419082', '<b>Produits : </b>volailles - panier', 13, 1, 'mm_20_blue.png', ''),
(15, 'Ronsoux Laurence', 'La Bazouge du dÃ©sert', '48.443664', '-1.106014', '<b>Jour de livraison : </b>mercredi<br><b>Produits : </b>oeufs', 14, 1, 'mm_20_brown.png', ''),
(16, 'Rupin Paul', 'Les Monts 35150 PirÃ© sur Seiche', '48.035913', '-1.441022', '<b>Produits : </b>rillettes', 15, 1, 'mm_20_orange.png', ''),
(18, 'Testard Alan', 'La PerriÃ¨re 35690 AcignÃ©', '48.146088', '-1.558503', '<b>Jour de livraison : </b>mercredi<br><b>Produits : </b>lÃ©gumes', 17, 1, 'mm_20_gray.png', ''),
(19, 'La galette BrÃ©cÃ©enne - Vincent Chantal', 'Centre commercial ''Le Tilleul'' 35530 BrÃ©cÃ©', '48.110762', '-1.483251', '<b>Jour de livraison : </b>vendredi<br><b>Produits : </b>galettes - crÃªpes', 18, 1, 'mm_20_red.png', ''),
(20, 'Persehais Sophie', '35580 Baulon', '47.984981', '-1.93265', '<b>Produits : </b>plantes aromatiques et mÃ©dicinales', 19, 1, 'mm_20_white.png', ''),
(21, 'Bertin Annie', '35140 Vendel', '48.29924', '-1.309862', '<b>Produits : </b>lÃ©gumes', 20, 1, 'mm_20_yellow.png', '');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du produit',
  `produit_id_categorie` int(11) NOT NULL COMMENT 'identifiant de la categorie',
  `produit_libelle` varchar(100) NOT NULL COMMENT 'libelle du produit',
  `produit_descriptif_production` text NOT NULL COMMENT 'descriptif de fabrication/production du produit',
  `produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du produit 0 = inactif 1 = actif ',
  `produit_photo` varchar(100) NOT NULL COMMENT 'photo du produit',
  `produit_rang` int(11) NOT NULL COMMENT 'rang d affichage du produit',
  PRIMARY KEY (`produit_id`),
  KEY `produit_categorie_fk` (`produit_id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des produits' AUTO_INCREMENT=120 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_id_categorie`, `produit_libelle`, `produit_descriptif_production`, `produit_etat`, `produit_photo`, `produit_rang`) VALUES
(36, 17, 'Huile chanvre', 'Michel Blain', 1, 'logo200.gif', 0),
(37, 18, 'Farine blÃ©', 'Michel Blain', 1, 'logo200.gif', 0),
(38, 18, 'Farine blÃ© noir', 'Michel Blain', 1, 'logo200.gif', 0),
(39, 18, 'Farine seigle', 'Michel Blain', 1, 'logo200.gif', 0),
(40, 19, 'Miel', 'Jean-Yves PelÃ©', 1, 'logo200.gif', 0),
(41, 20, 'Jus de pomme', 'Michel Blain', 1, 'jus pomme.jpg', 0),
(42, 20, 'Cidre', 'Etienne Lehuger', 1, 'cidre.jpg', 2),
(43, 20, 'BiÃ¨re Rouge (ambrÃ©e)', 'Steven Guyader', 1, 'logo200.gif', 0),
(44, 20, 'BiÃ¨re Jaune (blonde)', 'Steven Guyader', 1, 'logo200.gif', 0),
(45, 20, 'BiÃ¨re Bleue (rousse)', 'Steven Guyader\r\navec un saut de ligne', 1, 'logo200.gif', 0),
(46, 20, 'BiÃ¨re Blanche (blanche)', 'Steven Guyader', 1, 'logo200.gif', 1),
(47, 21, 'Pain semi complet', 'Sylvain Gauthier', 1, 'logo200.gif', 0),
(48, 21, 'Pain sÃ©same', 'Laurent Gauthier et Nathalie Langlois\r\n', 1, 'logo200.gif', 0),
(49, 21, 'Pain noisette', 'Laurent Gauthier et Nathalie Langlois \r\n', 1, 'logo200.gif', 0),
(50, 21, 'Pain raisin', 'Laurent Gauthier et Nathalie Langlois \r\n', 1, 'logo200.gif', 0),
(51, 21, 'Paint pÃ©pittes chocolat', 'Laurent Gauthier et Nathalie Langlois\r\n', 1, 'logo200.gif', 0),
(52, 22, 'Oeufs', 'Laurence Ronsoux', 1, 'logo200.gif', 0),
(53, 23, 'Cassoulet', 'GAEC du Pressoir\r\n', 1, 'logo200.gif', 0),
(55, 23, 'PÃ¢tÃ© Ã  l''ail', 'GAEC du Pressoir\r\n', 1, 'logo200.gif', 0),
(56, 23, 'PÃ¢tÃ© de campagne', 'GAEC du Pressoir\r\n', 1, 'logo200.gif', 0),
(57, 23, 'Rillettes de porc', 'GAEC du Pressoir\r\n', 1, 'logo200.gif', 0),
(58, 23, 'Rillettes de canard', 'LoÃ¯c GuÃ©rillon\r\n\r\n', 1, 'logo200.gif', 0),
(59, 23, 'Terrine volaille poivre vert', 'LoÃ¯c GuÃ©rillon\r\n\r\n', 1, 'logo200.gif', 0),
(60, 24, 'Pommes 1', 'Etienne Lehuger\r\n', 1, 'logo200.gif', 0),
(61, 24, 'Pommes 2', 'Etienne Lehuger\r\n', 1, 'logo200.gif', 0),
(62, 25, 'Oignons', 'Alan Testard\r\n', 0, 'logo200.gif', 0),
(63, 25, 'Echalotte', 'Alan Testard\r\n', 0, 'logo200.gif', 0),
(64, 25, 'Ail', 'Alan Testard\r\n', 0, 'logo200.gif', 0),
(65, 25, 'Courge musquÃ©e de Provences', 'GAEC Olivet\r\n', 0, 'logo200.gif', 0),
(66, 25, 'Potiron', 'GAEC Olivet\r\n', 0, 'logo200.gif', 0),
(67, 25, 'Potimaron', 'Alan Testard\r\n', 0, 'logo200.gif', 0),
(68, 25, 'Butter nut', 'Alan Testard\r\n', 0, 'logo200.gif', 0),
(69, 25, 'Carotte', 'Alan Testard\r\n', 0, 'logo200.gif', 0),
(70, 25, 'Poivron', 'Arnaud Daligault\r\n', 0, 'logo200.gif', 0),
(71, 25, 'Aubergine', 'Arnaud Daligault\r\n', 0, 'logo200.gif', 0),
(72, 25, 'Concombre', 'Arnaud Daligault\r\n', 0, 'logo200.gif', 0),
(73, 25, 'Tomate', 'Arnaud Daligault\r\n', 0, 'logo200.gif', 0),
(74, 25, 'Epinard', 'Arnaud Daligault\r\n', 0, 'logo200.gif', 0),
(75, 25, 'MÃ¢che', 'Arnaud Daligault\r\n', 0, 'logo200.gif', 0),
(76, 25, 'Salade', 'Arnaud Daligault\r\n\r\n', 0, 'logo200.gif', 0),
(79, 25, 'Pomme de terre DÃ©sirÃ©e', 'Henry Beucher\r\n', 1, 'logo200.gif', 0),
(80, 25, 'Pomme de terre Charlotte', 'Henry Beucher\r\n', 1, 'logo200.gif', 0),
(81, 25, 'Poireaux', 'Jean-Charles Gruel\r\n', 1, 'logo200.gif', 0),
(82, 26, 'CrÃ¨me dessert caramel', 'GAEC Olivet', 1, 'logo200.gif', 0),
(83, 26, 'CrÃ¨me dessert cafÃ©', 'GAEC Olivet', 1, 'logo200.gif', 0),
(84, 26, 'CrÃ¨me dessert vanille', 'GAEC Olivet', 1, 'logo200.gif', 0),
(85, 26, 'CrÃ¨me dessert chocolat', 'GAEC Olivet', 1, 'logo200.gif', 0),
(86, 26, 'Yaourt brassÃ© fruits', 'GAEC Olivet', 1, 'logo200.gif', 0),
(87, 26, 'Yaourt brassÃ© nature', 'GAEC Olivet', 1, 'logo200.gif', 0),
(88, 26, 'Yaourt ferme fruits', 'GAEC Olivet', 1, 'logo200.gif', 0),
(89, 26, 'Yaourt ferme vanille', 'GAEC Olivet', 1, 'logo200.gif', 0),
(90, 26, 'Yaourt ferme nature', 'GAEC Olivet', 1, 'logo200.gif', 0),
(91, 26, 'Fromage apÃ©ro orient', 'GAEC Olivet', 1, 'AperOlivet Orient.JPG', 0),
(92, 26, 'Fromage apÃ©ro mexicain', 'GAEC Olivet', 1, 'AperOlivet Mexicain.JPG', 0),
(93, 26, 'Fromage apÃ©ro ail et fines herbes', 'GAEC Olivet', 1, 'AperOlivet Ail & Fines Herbes.JPG', 0),
(94, 26, 'Fromage frais paprika', 'GAEC Olivet', 1, 'logo200.gif', 0),
(95, 26, 'Fromage frais cendrÃ©', 'GAEC Olivet', 1, 'logo200.gif', 0),
(96, 26, 'Fromage frais herbes Provences', 'GAEC Olivet', 1, 'logo200.gif', 0),
(97, 26, 'Fromage frais poivre', 'GAEC Olivet', 1, 'logo200.gif', 0),
(98, 26, 'Fromage frais nature', 'GAEC Olivet', 1, 'logo200.gif', 0),
(99, 26, 'P''tit olivet', 'GAEC Olivet', 1, 'Ptit Olivet.JPG', 0),
(100, 26, 'Fromage blanc lisse 0%', 'GAEC Olivet', 1, 'logo200.gif', 0),
(101, 26, 'Fromage blanc lisse 20%', 'GAEC Olivet', 1, 'logo200.gif', 0),
(102, 26, 'Fromage blanc lisse 40%', 'GAEC Olivet', 1, 'logo200.gif', 0),
(103, 26, 'Fromage blanc campagne 0%', 'GAEC Olivet', 1, 'logo200.gif', 0),
(104, 26, 'Fromage blanc campagne 20%', 'GAEC Olivet', 1, 'logo200.gif', 0),
(105, 26, 'Fromage blanc campagne 40%', 'GAEC Olivet', 1, 'logo200.gif', 0),
(106, 26, 'Faisselle', 'GAEC Olivet', 1, 'Faisselle.JPG', 0),
(107, 26, 'Beurre Â½ sel', 'GAEC Olivet', 1, 'logo200.gif', 0),
(108, 26, 'Beurre doux', 'GAEC Olivet', 1, 'logo200.gif', 0),
(109, 26, 'CrÃ¨me liquide', 'GAEC Olivet', 1, 'logo200.gif', 0),
(110, 26, 'CrÃ¨me Ã©paisse', 'GAEC Olivet', 1, 'logo200.gif', 0),
(111, 26, 'Lait ribot', 'GAEC Olivet', 1, 'logo200.gif', 0),
(112, 26, 'Lait Ã©crÃ©mÃ©', 'GAEC Olivet', 1, 'logo200.gif', 0),
(113, 26, 'Lait 1/2 Ã©crÃ©mÃ©', 'GAEC Olivet', 1, 'logo200.gif', 0),
(114, 26, 'Lait entier', 'GAEC Olivet', 1, 'logo200.gif', 0),
(116, 21, 'Pain 6 cÃ©rÃ©ales', 'Sylvain Gauthier', 1, 'logo200.gif', 0),
(117, 26, 'Bouteille verre', 'GAEC Olivet', 1, 'logo200.gif', 0),
(118, 21, 'Pain semi complet', 'Johny Santo', 1, 'logo200.gif', 0),
(119, 21, 'Pain semi complet', 'Laurent Gauthier', 1, 'logo200.gif', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit_resa`
--

CREATE TABLE IF NOT EXISTS `produit_resa` (
  `produit_resa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du produit',
  `produit_resa_id_categorie` int(11) NOT NULL COMMENT 'identifiant de la categorie',
  `produit_resa_libelle` varchar(100) NOT NULL COMMENT 'libelle du produit',
  `produit_resa_descriptif_production` text NOT NULL COMMENT 'descriptif de fabrication/production du produit',
  `produit_resa_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du produit 0 = inactif 1 = actif ',
  `produit_resa_photo` varchar(100) NOT NULL COMMENT 'photo du produit',
  `produit_resa_a_stock` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'produit soumis Ã  stock 0 = non 1 = oui ',
  `produit_resa_nb_stock` int(11) NOT NULL DEFAULT '0' COMMENT 'nombre de ce produit en stock',
  `produit_resa_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'est-ce que le produit est une nouveaute ? 0 = non, 1 = oui',
  `produit_resa_rang` int(11) NOT NULL COMMENT 'rang d affichage du produit',
  PRIMARY KEY (`produit_resa_id`),
  KEY `produit_resa_categorie_fk` (`produit_resa_id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des produits a la reservation' AUTO_INCREMENT=47 ;

--
-- Contenu de la table `produit_resa`
--

INSERT INTO `produit_resa` (`produit_resa_id`, `produit_resa_id_categorie`, `produit_resa_libelle`, `produit_resa_descriptif_production`, `produit_resa_etat`, `produit_resa_photo`, `produit_resa_a_stock`, `produit_resa_nb_stock`, `produit_resa_nouveaute`, `produit_resa_rang`) VALUES
(39, 23, 'Chapon (0 â‚¬ le kg)', 'Marie-B Renault\r\n', 0, 'logo200.gif', 0, -1, 0, 0),
(40, 23, 'Oie (0 â‚¬ le kg) ', 'Marie-B Renault\r\n', 0, 'logo200.gif', 0, -1, 0, 0),
(41, 23, 'Dinde (0 â‚¬ le kg)', 'Marie-B Renault\r\n', 0, 'logo200.gif', 0, -1, 0, 0),
(42, 23, 'Pintade (0 â‚¬ le kg)', 'Marie-B Renault\r\n', 0, 'logo200.gif', 0, -1, 0, 0),
(43, 23, 'Poulet (0 â‚¬ le kg)', 'Marie-B Renault\r\n', 0, 'logo200.gif', 0, -1, 0, 0),
(44, 23, 'Caissette d''agneau (12,32 â‚¬ le kg)', 'GAEC Olivet', 1, 'logo200.gif', 0, -1, 0, 2),
(45, 23, 'Caissette de boeuf (10,90 â‚¬ le kg)', 'GAEC Olivet', 1, 'logo200.gif', 0, -1, 0, 1),
(46, 19, 'qsdqsd', 'qsdqsd', 0, 'sqd', 0, -1, 0, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_client_fk` FOREIGN KEY (`commande_id_client`) REFERENCES `client` (`client_reference`);

--
-- Contraintes pour la table `conditionnement`
--
ALTER TABLE `conditionnement`
  ADD CONSTRAINT `cond_produi_fk` FOREIGN KEY (`cond_id_produit`) REFERENCES `produit` (`produit_id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_comande_fk` FOREIGN KEY (`facture_id_commande`) REFERENCES `commande` (`commande_id`);

--
-- Contraintes pour la table `lien_commande_cond`
--
ALTER TABLE `lien_commande_cond`
  ADD CONSTRAINT `lcc_commande_fk` FOREIGN KEY (`lcc_id_commande`) REFERENCES `commande` (`commande_id`),
  ADD CONSTRAINT `lcc_cond_fk` FOREIGN KEY (`lcc_id_cond`) REFERENCES `conditionnement` (`cond_id`);

--
-- Contraintes pour la table `lien_commande_produit_resa`
--
ALTER TABLE `lien_commande_produit_resa`
  ADD CONSTRAINT `lcpr_commande_fk` FOREIGN KEY (`lcpr_id_commande`) REFERENCES `commande` (`commande_id`),
  ADD CONSTRAINT `lcpr_produit_resa_fk` FOREIGN KEY (`lcpr_id_produit_resa`) REFERENCES `produit_resa` (`produit_resa_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_fk` FOREIGN KEY (`produit_id_categorie`) REFERENCES `categorie_produit` (`categorie_produit_id`);

--
-- Contraintes pour la table `produit_resa`
--
ALTER TABLE `produit_resa`
  ADD CONSTRAINT `produit_resa_categorie_fk` FOREIGN KEY (`produit_resa_id_categorie`) REFERENCES `categorie_produit` (`categorie_produit_id`);
