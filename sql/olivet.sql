-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 04 Janvier 2010 à 20:59
-- Version du serveur: 5.1.30
-- Version de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `olivet`
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
  `actualite_type` varchar(4) COLLATE latin1_general_ci NOT NULL DEFAULT 'GAEC' COMMENT 'type de l''actualite (GAEC pour gaec, LOMA pour local et/ou monde agricole',
  `actualite_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Est-ce que l''actualité est une nouveauté',
  PRIMARY KEY (`actualite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des actualites' AUTO_INCREMENT=14 ;

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`actualite_id`, `actualite_libelle`, `actualite_descriptif`, `actualite_etat`, `actualite_datecreation`, `actualite_datemodification`, `actualite_type`, `actualite_nouveaute`) VALUES
(6, 'my actuality', 'c''est la cote qui tue mon p''tit pote é''''''', 1, '2009-07-09 12:13:38', '2009-12-30 17:51:48', 'GAEC', 0),
(7, 'Deuxième actu', '12345678910111213141516171819', 1, '2009-07-09 12:28:55', '2009-12-30 17:51:47', 'GAEC', 0),
(9, 'new actu', 'description héhé', 1, '2009-08-17 10:32:40', '2009-12-30 17:51:46', 'LOMA', 0),
(10, 'lib', 'sans apostrophe', 1, '2009-08-17 10:48:01', '2009-12-30 17:51:46', 'GAEC', 1),
(11, 'libelle''coté', 'desc''coté''''''', 1, '2009-08-17 11:35:21', '2009-12-30 17:51:44', 'GAEC', 1),
(12, 'test', 'desc', 1, '2009-09-19 17:48:31', '2009-12-30 17:51:43', 'GAEC', 1),
(13, 'accentué''s', 'dtes', 1, '2009-12-28 18:12:22', '2009-12-28 18:18:40', 'LOMA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `categorie_produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la categorie',
  `categorie_produit_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle de la categorie',
  `categorie_produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat de la categorie 0 = inactif, 1 = actif',
  PRIMARY KEY (`categorie_produit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des categories de produits' AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='liste des clients' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`client_reference`, `client_nom`, `client_prenom`, `client_adresse`, `client_code_postal`, `client_commune`, `client_numero_tel`, `client_email`) VALUES
(4, 'Trepos', 'Gwen', '2 rue des Vignes', '35530', 'Servon sur Vilaine', '06 17 35 00 01', 'gwenael.trepos@gmail.com'),
(5, 'Guillemin', 'Sandra', '2 rue des Vignes', '35530', 'Servon sur Vilaine', '02 15 45  45 48', 's_guillemin@hotmail.com'),
(6, 'Trepos', 'Ronan', 'toulouse', '34000', 'Toulouse', '02 15 45  45 48', 'ronan.trepos@gmail.com'),
(7, 'Trepos', 'Raymond', '38 rue du clos des vignes', '35690', 'Acigné', '02 99 62 25 24', 'raymond.trepos@free.fr');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la commande',
  `commande_id_client` int(11) NOT NULL COMMENT 'identifiant du client',
  `commande_datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de creation de la commande',
  `commande_etat` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT 'EC' COMMENT 'etat de la commande : EC = en cours, FA = facturee',
  PRIMARY KEY (`commande_id`),
  KEY `commande_client_fk` (`commande_id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des commandes' AUTO_INCREMENT=35 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`commande_id`, `commande_id_client`, `commande_datecreation`, `commande_etat`) VALUES
(23, 7, '2009-12-28 18:01:02', 'FA'),
(24, 6, '2009-12-28 18:01:58', 'FA'),
(26, 5, '2009-12-29 10:40:26', 'EC'),
(32, 5, '2009-12-29 10:47:31', 'EC'),
(34, 5, '2009-12-29 11:15:07', 'EC');

-- --------------------------------------------------------

--
-- Structure de la table `conditionnement`
--

CREATE TABLE IF NOT EXISTS `conditionnement` (
  `cond_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du conditionnement',
  `cond_id_produit` int(11) NOT NULL COMMENT 'identifiant du produit',
  `cond_nb_stock` int(11) NOT NULL DEFAULT '-1' COMMENT 'nombre de ce conditionnement en stock',
  `cond_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'est-ce que le conditionnement est une nouveaute ? 0 = non, 1 = oui',
  `cond_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du conditionnement 0 = inactif 1 = actif ',
  `cond_prix` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'prix a ajouter pour le conditionnement',
  `cond_nom` varchar(50) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'nom du conditionnemment',
  `cond_quantite_produit` decimal(6,3) NOT NULL COMMENT 'quantite de produit contenue dans le conditionnement',
  PRIMARY KEY (`cond_id`),
  KEY `cond_produit_fk` (`cond_id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des produits conditionnes' AUTO_INCREMENT=38 ;

--
-- Contenu de la table `conditionnement`
--

INSERT INTO `conditionnement` (`cond_id`, `cond_id_produit`, `cond_nb_stock`, `cond_nouveaute`, `cond_etat`, `cond_prix`, `cond_nom`, `cond_quantite_produit`) VALUES
(35, 32, 60, 1, 1, '0.50', 'sac de 10 carotte', '10.000'),
(36, 33, 50, 0, 1, '1.50', 'pot 50 cl', '0.500'),
(37, 32, 60, 1, 0, '0.60', 'sac de 100''cote', '100.000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`facture_ref`, `facture_id_commande`, `facture_date_facture`) VALUES
(5, 24, '2009-12-29 12:14:33'),
(7, 23, '2009-12-29 14:52:16');

-- --------------------------------------------------------

--
-- Structure de la table `lien_commande_cond`
--

CREATE TABLE IF NOT EXISTS `lien_commande_cond` (
  `lcc_id_commande` int(11) NOT NULL COMMENT 'identifiant de commande',
  `lcc_id_cond` int(11) NOT NULL COMMENT 'identifiant de conditionnement',
  `lcc_quantite` int(11) NOT NULL COMMENT 'quantite du conditionnement dans la commande',
  PRIMARY KEY (`lcc_id_commande`,`lcc_id_cond`),
  KEY `lcc_cond_fk` (`lcc_id_cond`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

--
-- Contenu de la table `lien_commande_cond`
--

INSERT INTO `lien_commande_cond` (`lcc_id_commande`, `lcc_id_cond`, `lcc_quantite`) VALUES
(23, 35, 165),
(24, 36, 2),
(26, 36, 2),
(32, 36, 2),
(34, 35, 15),
(34, 36, 12);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

--
-- Contenu de la table `lien_commande_produit_resa`
--

INSERT INTO `lien_commande_produit_resa` (`lcpr_id_commande`, `lcpr_id_produit_resa`, `lcpr_quantite`) VALUES
(26, 34, 1),
(34, 34, 1);

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
('condition_vente', 'Merci de passer vos commandes avant le mardi soir et de venir les chercher sur lâ€™exploitation Ã  partir du vendredi midi jusquâ€™au samedi midi.\r\nMerci pour votre comprÃ©hension.');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `partenaire`
--

INSERT INTO `partenaire` (`partenaire_id`, `partenaire_libelle`, `partenaire_descriptif`, `partenaire_img_logo`, `partenaire_siteweb`, `partenaire_rang`, `partenaire_etat`) VALUES
(2, 'Partenaire 2', 'sa description est sommaire mais il fait du bon pâté', 'pates.gif', 'http://www.website1.fr', 1, 1),
(3, 'test 2', 'desc', 'qsd', 'http://www.website2.com', 2, 1),
(4, 'test', 'desc', 'logo', 'http://www.website.com', 3, 1),
(5, 'dsdq', 'qsd', 'ds', 'http://www.website.com', 4, 1),
(6, 'cote''s 21', 'desxcwwxcwxc', 'tetedeveau.gif', 'http://www.website.com', 3, 1),
(7, 'part', 'desc', 'temp', '', 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du produit',
  `produit_id_categorie` int(11) NOT NULL COMMENT 'identifiant de la categorie',
  `produit_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle du produit',
  `produit_descriptif_production` text COLLATE latin1_general_ci NOT NULL COMMENT 'descriptif de fabrication/production du produit',
  `produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du produit 0 = inactif 1 = actif ',
  `produit_unite` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'unite du produit (kg, litre etc...)',
  `produit_prix_unite` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'prix du produit a l''unite',
  `produit_photo` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'photo du produit',
  PRIMARY KEY (`produit_id`),
  KEY `produit_categorie_fk` (`produit_id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des produits' AUTO_INCREMENT=35 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_id_categorie`, `produit_libelle`, `produit_descriptif_production`, `produit_etat`, `produit_unite`, `produit_prix_unite`, `produit_photo`) VALUES
(32, 6, 'carrottes', 'poussent grâce au temps et au maraîcher', 1, 'kg', '0.20', '20.jpg'),
(33, 4, 'creme fraiche', 'desc', 1, 'litre', '0.50', 'cremefraiche.gif'),
(34, 7, 'pommes''caramel', 'pommier', 1, 'kg', '1.50', 'pomme_caramalisee.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produit_resa`
--

CREATE TABLE IF NOT EXISTS `produit_resa` (
  `produit_resa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du produit',
  `produit_resa_libelle` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'libelle du produit',
  `produit_resa_descriptif_production` text COLLATE latin1_general_ci NOT NULL COMMENT 'descriptif de fabrication/production du produit',
  `produit_resa_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat du produit 0 = inactif 1 = actif ',
  `produit_resa_photo` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'photo du produit',
  PRIMARY KEY (`produit_resa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT COMMENT='liste des produits a la reservation' AUTO_INCREMENT=35 ;

--
-- Contenu de la table `produit_resa`
--

INSERT INTO `produit_resa` (`produit_resa_id`, `produit_resa_libelle`, `produit_resa_descriptif_production`, `produit_resa_etat`, `produit_resa_photo`) VALUES
(34, 'caissette d''agneau', 'Les agneaux sont élevés par Clarisse à la dure. Ensuite on les zigouille mais pas devant Sandra parce qu''elle pleure sinon, alors on le fait à l''abattoir. C''est dur la vie. Enfin la mort plutôt...', 1, 'Anima-Peluche-agneau-blanc-1702.jpg');

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
