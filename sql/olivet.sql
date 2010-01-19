-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 17 Janvier 2010 à 15:36
-- Version du serveur: 5.1.37
-- Version de PHP: 5.3.0

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
  `actualite_libelle` varchar(100) NOT NULL COMMENT 'libelle de l''actualite',
  `actualite_descriptif` text NOT NULL COMMENT 'descriptif de l''actualite',
  `actualite_etat` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'etat de l''actualite, 0 = inactif, 1 = actif ',
  `actualite_datecreation` datetime NOT NULL COMMENT 'date de creation de l''actualite',
  `actualite_datemodification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date de modification de l''actualite',
  `actualite_type` varchar(4) NOT NULL DEFAULT 'GAEC' COMMENT 'type de l''actualite (GAEC pour gaec, LOMA pour local et/ou monde agricole',
  `actualite_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Est-ce que l''actualité est une nouveauté',
  PRIMARY KEY (`actualite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des actualites' AUTO_INCREMENT=14 ;

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`actualite_id`, `actualite_libelle`, `actualite_descriptif`, `actualite_etat`, `actualite_datecreation`, `actualite_datemodification`, `actualite_type`, `actualite_nouveaute`) VALUES
(6, 'my actuality', 'c''est la cote qui tue mon p''tit pote ?''''''', 1, '2009-07-09 12:13:38', '2009-12-30 17:51:48', 'GAEC', 0),
(7, 'Deuxiême actu', '12345678910111213141516171819', 1, '2009-07-09 12:28:55', '2010-01-09 19:32:59', 'GAEC', 0),
(9, 'new actu', 'description héhé', 1, '2009-08-17 10:32:40', '2010-01-09 19:32:53', 'LOMA', 0),
(10, 'lib', 'sans apostrophe', 1, '2009-08-17 10:48:01', '2009-12-30 17:51:46', 'GAEC', 1),
(11, 'libelle''coté', 'desc''coté''''''', 1, '2009-08-17 11:35:21', '2010-01-09 19:32:47', 'GAEC', 1),
(12, 'test', 'desc', 1, '2009-09-19 17:48:31', '2009-12-30 17:51:43', 'GAEC', 1),
(13, 'accentué''s', 'dtes', 1, '2009-12-28 18:12:22', '2010-01-09 19:32:38', 'LOMA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `categorie_produit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la categorie',
  `categorie_produit_libelle` varchar(100) NOT NULL COMMENT 'libelle de la categorie',
  `categorie_produit_etat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'etat de la categorie 0 = inactif, 1 = actif',
  PRIMARY KEY (`categorie_produit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des categories de produits' AUTO_INCREMENT=8 ;

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
  `client_nom` varchar(100) NOT NULL COMMENT 'nom du client',
  `client_prenom` varchar(100) NOT NULL COMMENT 'prenom du client',
  `client_adresse` varchar(500) DEFAULT NULL COMMENT 'adresse du client',
  `client_code_postal` varchar(10) DEFAULT NULL COMMENT 'code postal de la commune du client',
  `client_commune` varchar(100) DEFAULT NULL COMMENT 'commune du client',
  `client_numero_tel` varchar(20) DEFAULT NULL COMMENT 'numero de telephone du client',
  `client_email` varchar(100) NOT NULL COMMENT 'email du client',
  `client_code` varchar(10) NOT NULL COMMENT 'code aleatoire du client',
  PRIMARY KEY (`client_reference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='liste des clients' AUTO_INCREMENT=11 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`client_reference`, `client_nom`, `client_prenom`, `client_adresse`, `client_code_postal`, `client_commune`, `client_numero_tel`, `client_email`, `client_code`) VALUES
(4, 'Trepos', 'Gwen', '2 rue des Vignes', '35530', 'Servon sur Vilaine', '06 17 35 00 01', 'gwenael.trepos@gmail.com', 'abcdefghij'),
(5, 'Guillemin', 'Sandra', '2 rue des Vignes', '35530', 'Servon sur Vilaine', '02 15 45  45 48', 's_guillemin@hotmail.com', '1234567890'),
(6, 'Trepos', 'Ronan', '8 r St Ferréol', '31000', 'Toulouse', '02 15 45  45 48', 'ronan.trepos@gmail.com', '1a2b3c4d5e'),
(8, 'Guillemin', 'Nicole', '', '', '', '02 12 12 12 12', 'nicole.guillemin@test.fr', 'rbghefklib'),
(9, 'Trepos', 'Raymond', '38 rue du clos des vignes', '35690', 'Acigné', '02 99 62 25 24', 'raymond.trepos@test.fr', 'uc98dgwv9r'),
(10, 'TREPOS', 'Michèle', '38 rue du clos des vignes', '35690', 'Acigné', '02 99 62 25 24', 'michele.trepos@test.fr', 'thx78sa9k1');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la commande',
  `commande_id_client` int(11) NOT NULL COMMENT 'identifiant du client',
  `commande_datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de creation de la commande',
  `commande_etat` varchar(2) NOT NULL DEFAULT 'EC' COMMENT 'etat de la commande : EC = en cours, FA = facturee',
  PRIMARY KEY (`commande_id`),
  KEY `commande_client_fk` (`commande_id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des commandes' AUTO_INCREMENT=42 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`commande_id`, `commande_id_client`, `commande_datecreation`, `commande_etat`) VALUES
(37, 5, '2010-01-10 10:21:49', 'EC'),
(38, 4, '2010-01-10 10:22:15', 'EC'),
(39, 6, '2010-01-10 10:40:35', 'EC'),
(40, 8, '2010-01-10 11:17:47', 'EC'),
(41, 10, '2010-01-11 23:32:14', 'EC');

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
  `cond_quantite_produit` decimal(6,3) NOT NULL COMMENT 'quantite de produit contenue dans le conditionnement',
  `cond_a_stock` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'conditionnement soumis à stock 0 = non 1 = oui ',
  `cond_nb_stock` int(11) NOT NULL DEFAULT '0' COMMENT 'nombre de ce conditionnement en stock',
  PRIMARY KEY (`cond_id`),
  KEY `cond_produit_fk` (`cond_id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des produits conditionnes' AUTO_INCREMENT=45 ;

--
-- Contenu de la table `conditionnement`
--

INSERT INTO `conditionnement` (`cond_id`, `cond_id_produit`, `cond_nouveaute`, `cond_etat`, `cond_prix`, `cond_nom`, `cond_quantite_produit`, `cond_a_stock`, `cond_nb_stock`) VALUES
(38, 33, 1, 1, 0.20, 'pot 50 cl', 0.500, 1, 59),
(39, 32, 0, 1, 0.10, 'sac de 10', 1.000, 1, 76),
(40, 34, 1, 1, 0.20, 'sac de 100', 1.000, 1, 148),
(41, 31, 0, 1, 0.30, '3 choux', 0.600, 1, 28),
(42, 31, 0, 0, 0.30, '2 choux', 0.400, 1, 25),
(43, 31, 0, 1, 0.30, '1 choux', 0.200, 1, 0),
(44, 31, 0, 1, 0.30, '4 choux', 0.800, 1, 24);

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
  `lcc_quantite` int(11) NOT NULL COMMENT 'quantite du conditionnement dans la commande',
  PRIMARY KEY (`lcc_id_commande`,`lcc_id_cond`),
  KEY `lcc_cond_fk` (`lcc_id_cond`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `lien_commande_cond`
--

INSERT INTO `lien_commande_cond` (`lcc_id_commande`, `lcc_id_cond`, `lcc_quantite`) VALUES
(37, 39, 1),
(38, 38, 1),
(39, 40, 2),
(40, 39, 1),
(41, 39, 12);

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
(37, 36, 1),
(38, 35, 1),
(39, 37, 4),
(40, 36, 1),
(40, 37, 1);

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
('condition_vente', 'Merci de passer vos commandes avant le mardi soir et de venir les chercher sur l''exploitation à partir du vendredi midi jusqu''au samedi midi.\r\nMerci pour votre compréhension.');

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
  PRIMARY KEY (`partenaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `partenaire`
--

INSERT INTO `partenaire` (`partenaire_id`, `partenaire_libelle`, `partenaire_descriptif`, `partenaire_siteweb`, `partenaire_rang`, `partenaire_etat`) VALUES
(2, 'Partenaire 2', 'sa description est sommaire mais il fait du bon pâté', 'http://www.website1.fr', 1, 1),
(3, 'test 2', 'desc', 'http://www.website2.com', 3, 1),
(4, 'test', 'desc', 'http://www.website.com', 4, 1),
(5, 'dsdq', 'qsd', 'http://www.website.com', 6, 1),
(6, 'cote''s 21', 'desxcwwxcwxc', 'http://www.website.com', 5, 1),
(8, 'parténaire', 'desc', 'http://www.pate2.fr', 7, 1),
(9, 'newone', 'la desc', 'http://www.fromage.fr', 2, 1);

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
  `produit_unite` varchar(100) NOT NULL COMMENT 'unite du produit (kg, litre etc...)',
  `produit_prix_unite` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'prix du produit a l''unite',
  `produit_photo` varchar(100) NOT NULL COMMENT 'photo du produit',
  PRIMARY KEY (`produit_id`),
  KEY `produit_categorie_fk` (`produit_id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des produits' AUTO_INCREMENT=35 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_id_categorie`, `produit_libelle`, `produit_descriptif_production`, `produit_etat`, `produit_unite`, `produit_prix_unite`, `produit_photo`) VALUES
(31, 6, 'choux fleur', 'à balancer sur les bâtiments administratifs de Rennes', 1, 'kg', 1.00, 'choux-fleur.JPG'),
(32, 6, 'carrottes', 'poussent grâce au temps et au maraîcher', 1, 'kg', 0.20, '20.jpg'),
(33, 4, 'creme fraiche', 'desc', 1, 'litre', 0.50, 'cremefraiche.gif'),
(34, 7, 'pommes''caramel', 'pommier', 1, 'kg', 1.50, 'pomme_caramalisee.jpg');

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
  `produit_resa_a_stock` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'produit soumis à stock 0 = non 1 = oui ',
  `produit_resa_nb_stock` int(11) NOT NULL DEFAULT '0' COMMENT 'nombre de ce produit en stock',
  `produit_resa_nouveaute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'est-ce que le produit est une nouveaute ? 0 = non, 1 = oui',
  PRIMARY KEY (`produit_resa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='liste des produits a la reservation' AUTO_INCREMENT=38 ;

--
-- Contenu de la table `produit_resa`
--

INSERT INTO `produit_resa` (`produit_resa_id`, `produit_resa_id_categorie`, `produit_resa_libelle`, `produit_resa_descriptif_production`, `produit_resa_etat`, `produit_resa_photo`, `produit_resa_a_stock`, `produit_resa_nb_stock`, `produit_resa_nouveaute`) VALUES
(35, 3, 'caissette d''agneau', 'c''est clarisse qui fait', 1, 'Anima-Peluche-agneau-blanc-1702.jpg', 1, 9, 1),
(36, 3, 'caissette de boeuf', 'c''est gérard le boss', 1, '323-tete-boeuf.jpg', 1, 13, 1),
(37, 3, 'caissette de porc', 'la on sait pas trop d''où ca vient ?', 1, 'Photo-porc.gif', 1, 0, 0);

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
  
