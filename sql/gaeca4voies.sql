-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 04 Août 2009 à 23:20
-- Version du serveur: 5.1.30
-- Version de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gaeca4voies`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE IF NOT EXISTS `actualite` (
  `actualite_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de l''actualite',
  `actualite_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle de l''actualite',
  `actualite_descriptif` text COLLATE latin1_general_ci NOT NULL COMMENT 'descriptif de l''actualite',
  `actualite_etat` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'etat de l''actualite, 0 = inactif, 1 = actif ',
  `actualite_datecreation` datetime NOT NULL COMMENT 'date de creation de l''actualite',
  `actualite_datemodification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date de modification de l''actualite',
  PRIMARY KEY (`actualite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des actualitÃ©s' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`actualite_id`, `actualite_libelle`, `actualite_descriptif`, `actualite_etat`, `actualite_datecreation`, `actualite_datemodification`) VALUES
(6, 'my actuality', 'c''est la premiere actu héhé it works better and better', 1, '2009-07-09 12:13:38', '2009-07-09 12:29:37'),
(7, 'Deuxième actu', '12345678910111213141516171819', 1, '2009-07-09 12:28:55', '2009-07-09 12:56:49');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `categorie_produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la categorie',
  `categorie_produit_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle de la categorie',
  `categorie_produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat de la categorie 0 = inactif, 1 = actif',
  PRIMARY KEY (`categorie_produit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='list des categories de produits' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie_produit`
--

INSERT INTO `categorie_produit` (`categorie_produit_id`, `categorie_produit_libelle`, `categorie_produit_etat`) VALUES
(3, 'Viandes', 1),
(4, 'Produits laitiers', 1),
(6, 'Légumes', 1),
(7, 'Fruits', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_reference` int(11) NOT NULL AUTO_INCREMENT COMMENT 'reference du client',
  `client_nom` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'nom du client',
  `client_prenom` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'prenom du client',
  `client_adresse` varchar(500) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'adresse du client',
  `client_code_postal` varchar(10) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'code postal de la commune du client',
  `client_commune` varchar(100) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'commune du client',
  `client_numero_tel` varchar(20) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'numero de telephone du client',
  `client_email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'email du client',
  PRIMARY KEY (`client_reference`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='liste des clients' AUTO_INCREMENT=5 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`client_reference`, `client_nom`, `client_prenom`, `client_adresse`, `client_code_postal`, `client_commune`, `client_numero_tel`, `client_email`) VALUES
(4, 'Trepos', 'Gwen', '18 avenue André Mussat', '35000', 'Rennes', '06 17 35 00 01', 'gwenael.trepos@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la commande',
  `commande_id_client` int(11) NOT NULL COMMENT 'identifiant du client',
  `commande_datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de creation de la commande',
  `commande_dateannulation` datetime NOT NULL COMMENT 'date d''annulation eventuelle de la commande',
  `commande_somme` int(11) NOT NULL COMMENT 'somme total de la commande',
  PRIMARY KEY (`commande_id`),
  KEY `commande_client_fk` (`commande_id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des commandes' AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commande`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `facture`
--


-- --------------------------------------------------------

--
-- Structure de la table `lien_commande_produit`
--

CREATE TABLE IF NOT EXISTS `lien_commande_produit` (
  `lcp_id_commande` int(11) NOT NULL COMMENT 'identifiant de commande',
  `lcp_id_produit` int(11) NOT NULL COMMENT 'identifiant de produit',
  `lcp_quantite` int(11) NOT NULL COMMENT 'quantite du produit dans la commande',
  PRIMARY KEY (`lcp_id_commande`,`lcp_id_produit`),
  KEY `lcp_produit_fk` (`lcp_id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

--
-- Contenu de la table `lien_commande_produit`
--


-- --------------------------------------------------------

--
-- Structure de la table `parametrage`
--

CREATE TABLE IF NOT EXISTS `parametrage` (
  `parametre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `valeur` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`parametre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `parametrage`
--

INSERT INTO `parametrage` (`parametre`, `valeur`) VALUES
('condition_vente', 'Merci de passer vos commandes avant le mardi soir et de venir les chercher sur lâ€™exploitation Ã  partir du vendredi midi jusquâ€™au samedi midi.\r\nMerci pour votre comprÃ©hension.');

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE IF NOT EXISTS `partenaire` (
  `partenaire_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du partenaire',
  `partenaire_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle du partenaire',
  `partenaire_descriptif` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'descriptif du partenaire',
  `partenaire_img_logo` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'nom de l''image du logo du partenaire',
  `partenaire_siteweb` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'adresse du site web du partenaire',
  `partenaire_rang` int(11) NOT NULL COMMENT 'rang d''affichage du partenaire',
  `partenaire_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du partenaire 0 = inactif, 1 = actif ',
  PRIMARY KEY (`partenaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `partenaire`
--

INSERT INTO `partenaire` (`partenaire_id`, `partenaire_libelle`, `partenaire_descriptif`, `partenaire_img_logo`, `partenaire_siteweb`, `partenaire_rang`, `partenaire_etat`) VALUES
(2, 'Partenaire 2', 'sa description est sommaire mais il fait du bon pâté ', 'pates.gif', 'www.pate.fr', 1, 0),
(3, 'test 2', 'desc', 'qsd', 'qds', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du produit',
  `produit_id_categorie` int(11) NOT NULL COMMENT 'identifiant de la categorie',
  `produit_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle du produit',
  `produit_lien_photo` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'lien vers la photo du produit',
  `produit_descriptif_production` text COLLATE latin1_general_ci NOT NULL COMMENT 'descriptif de fabrication/production du produit',
  `produit_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'est-ce que le produit est une nouveaute ? 0 = non, 1 = oui',
  `produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du produit 0 = inactif 1 = actif ',
  `produit_unite` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'unite du produit (kg, litre etc...)',
  `produit_prix` int(11) NOT NULL DEFAULT '0' COMMENT 'prix a l''unite',
  PRIMARY KEY (`produit_id`),
  KEY `produit_categorie_fk` (`produit_id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des produits' AUTO_INCREMENT=14 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_id_categorie`, `produit_libelle`, `produit_lien_photo`, `produit_descriptif_production`, `produit_nouveaute`, `produit_etat`, `produit_unite`, `produit_prix`) VALUES
(1, 6, 'Patates', 'lien_vide', 'En pleine terre avec des cailloux', 1, 0, 'kg', 0),
(2, 4, 'Lait', 'lien_vide', 'Direct de la vache', 1, 0, 'litre', 0),
(7, 3, 'Mouton', 'lien_vide', 'Elevé avec soins par Clarisse', 1, 0, 'kg', 0),
(8, 3, 'Viande de boeuf', 'lien_vide', 'Elevé avec soins par Gérard', 1, 0, 'kg', 0),
(13, 6, 'Haricots', 'lien_vide', 'coco', 1, 0, 'kg', 12);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_client_fk` FOREIGN KEY (`commande_id_client`) REFERENCES `client` (`client_reference`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_comande_fk` FOREIGN KEY (`facture_id_commande`) REFERENCES `commande` (`commande_id`);

--
-- Contraintes pour la table `lien_commande_produit`
--
ALTER TABLE `lien_commande_produit`
  ADD CONSTRAINT `lcp_commande_fk` FOREIGN KEY (`lcp_id_commande`) REFERENCES `commande` (`commande_id`),
  ADD CONSTRAINT `lcp_produit_fk` FOREIGN KEY (`lcp_id_produit`) REFERENCES `produit` (`produit_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_fk` FOREIGN KEY (`produit_id_categorie`) REFERENCES `categorie_produit` (`categorie_produit_id`);
