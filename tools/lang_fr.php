<?php

// ADMINISTRATION

// Setup

define("SETUP_HOST_NAME","Host name");
define("SETUP_DATABASE","Nom de la base de donnée");
define("SETUP_LOGIN","Identifiant");
define("SETUP_PASSWORD","Mot de passe");
define("SETUP_TYPE","Type d'installation");
define("SETUP_NORMALE","Installation normale");
define("SETUP_MAJ","Mise à jour de la version 0.71");
define("SETUP_TITRE_SITE","Titre de votre site");
define("SETUP_URL_SITE","Adresse de votre site");
define("SETUP_PSEUDO","Login (pour l'administration et pour les pronostics)");
define("SETUP_MDP","Mot de passe (pour l'administration et pour les pronostics)");
define("SETUP_MAIL","Votre e-mail");
define("SETUP_ERREUR","Impossible d'effectuer la requête pour");
define("SETUP_ERREUR_2","Voici le message d'erreur renvoyé par la base de données");
define("SETUP_ID_INCORRECTS","Vos Identifiants sont incorrects !");
define("SETUP_TABLE","La table des");
define("SETUP_TABLE_2","a été correctement créée");
define("SETUP_TABLE_3","Créer la table des");
define("SETUP_TABLE_4","créer le compte de l'administrateur pour la gestion et les pronostics");
define("SETUP_TABLE_5","Le compte de l'administrateur a été correctement créé");
define("SETUP_CONFIRMATION","Vous avez bien configurez le script !");
define("SETUP_FIN","Pour plus de sécurité, vous devez à présent supprimer le fichiers install.php3 !
                    Ensuite rendez-vous dans l'<a href=\"admin\">administration</a> pour commencer à utiliser PhpLeague !");
define("SETUP_REMPLIR_CHAMP","Veuillez remplir tous les champs !");

//gestion des clients
define("ADMIN_CLIENT_GESTION","Gestion des clients");
define("ADMIN_CLIENT_REFERENCE","Référence");
define("ADMIN_CLIENT_CIVILITE","Civilité");
define("ADMIN_CLIENT_NOM","Nom");
define("ADMIN_CLIENT_PRENOM","Prénom");
define("ADMIN_CLIENT_ADRESSE","Adresse");
define("ADMIN_CLIENT_TEL","Téléphone");
define("ADMIN_CLIENT_MAIL","Mail");
define("ADMIN_CLIENT_CREER","Créer un client");
define("ADMIN_CLIENT_MODIFIER","Modifier");
define("ADMIN_CLIENT_SUPPRIMER","Supprimer");
define("ADMIN_CLIENT_RECHERCHER","Rechercher");

//gestion des actualités
define("ADMIN_ACTUALITE_GESTION","Gestion des actualités");
define("ADMIN_ACTUALITE_ID","Identifiant");
define("ADMIN_ACTUALITE_LIBELLE","Libellé");
define("ADMIN_ACTUALITE_DESCRIPTIF","Descriptif");
define("ADMIN_ACTUALITE_DATECREATION","Date de création");
define("ADMIN_ACTUALITE_DATEMODIFICATION","Date de modification");
define("ADMIN_ACTUALITE_ETAT","Etat");
define("ADMIN_ACTUALITE_TYPE","Type");
define("ADMIN_ACTUALITE_NOUVEAUTE","Nouveauté");
define("ADMIN_ACTUALITE_CREER","Créer une actualité");
define("ADMIN_ACTUALITE_ACTIVER","Activer");
define("ADMIN_ACTUALITE_DESACTIVER","Désactiver");
define("ADMIN_ACTUALITE_MODIFIER","Modifier");
define("ADMIN_ACTUALITE_SUPPRIMER","Supprimer");
define("ADMIN_ACTUALITE_GAEC","Actualité du GAEC");
define("ADMIN_ACTUALITE_LOMA","Actualité locale et/ou du monde agricole"); 

//gestion des catégories de produits
define("ADMIN_CATEGORIE_GESTION","Gestion des catégories de produits");
define("ADMIN_CATEGORIE_ID","Identifiant");
define("ADMIN_CATEGORIE_LIBELLE","Libellé");
define("ADMIN_CATEGORIE_ETAT","Etat");
define("ADMIN_CATEGORIE_CREER","Créer une catégorie");
define("ADMIN_CATEGORIE_ACTIVER","Activer");
define("ADMIN_CATEGORIE_DESACTIVER","Désactiver");
define("ADMIN_CATEGORIE_MODIFIER","Modifier");
define("ADMIN_CATEGORIE_SUPPRIMER","Supprimer");

//gestion des produits
define("ADMIN_PRODUIT_GESTION","Gestion des produits");
define("ADMIN_PRODUIT_ID","Identifiant");
define("ADMIN_PRODUIT_CATEGORIE","Catégorie");
define("ADMIN_PRODUIT_LIBELLE","Libellé");
define("ADMIN_PRODUIT_DESCRIPTIF","Descriptif");
define("ADMIN_PRODUIT_PRIX_UNITE","Prix à l'unité");
define("ADMIN_PRODUIT_ETAT","Etat");
define("ADMIN_PRODUIT_UNITE","Unité");
define("ADMIN_PRODUIT_CREER","Créer un produit");
define("ADMIN_PRODUIT_ACTIVER","Activer");
define("ADMIN_PRODUIT_DESACTIVER","Désactiver");
define("ADMIN_PRODUIT_MODIFIER","Modifier");
define("ADMIN_PRODUIT_SUPPRIMER","Supprimer");

//gestion des produits à la réservation
define("ADMIN_PRODUIT_RESA_GESTION","Gestion des produits à la réservation");
define("ADMIN_PRODUIT_RESA_ID","Identifiant");
define("ADMIN_PRODUIT_RESA_CATEGORIE","Catégorie");
define("ADMIN_PRODUIT_RESA_LIBELLE","Libellé");
define("ADMIN_PRODUIT_RESA_NBSTOCK","Stock");
define("ADMIN_PRODUIT_RESA_DESCRIPTIF","Descriptif");
define("ADMIN_PRODUIT_RESA_ETAT","Etat");
define("ADMIN_PRODUIT_RESA_NOUVEAUTE","Nouveauté");
define("ADMIN_PRODUIT_RESA_CREER","Créer un produit à la réservation");
define("ADMIN_PRODUIT_RESA_ACTIVER","Activer");
define("ADMIN_PRODUIT_RESA_DESACTIVER","Désactiver");
define("ADMIN_PRODUIT_RESA_MODIFIER","Modifier");
define("ADMIN_PRODUIT_RESA_SUPPRIMER","Supprimer");

//gestion des conditionnements
define("ADMIN_CONDITIONNEMENT_GESTION","Gestion des conditionnements");
define("ADMIN_CONDITIONNEMENT_ID","Id.");
define("ADMIN_CONDITIONNEMENT_PRODUIT","Produit");
define("ADMIN_CONDITIONNEMENT_NBSTOCK","Stock");
define("ADMIN_CONDITIONNEMENT_NOUVEAUTE","Nouveauté");
define("ADMIN_CONDITIONNEMENT_DIVISIBLE","Divisible");
define("ADMIN_CONDITIONNEMENT_ETAT","Etat");
define("ADMIN_CONDITIONNEMENT_PRIX_GLOBAL","Prix global");
define("ADMIN_CONDITIONNEMENT_NOM","Nom conditionnement");
define("ADMIN_CONDITIONNEMENT_QUANTITEPRODUIT","Quantité produit");
define("ADMIN_CONDITIONNEMENT_PRIX","Prix conditionnement");
define("ADMIN_CONDITIONNEMENT_REMISE","Remise");
define("ADMIN_CONDITIONNEMENT_CREER","Créer un conditionnement");
define("ADMIN_CONDITIONNEMENT_ACTIVER","Activer");
define("ADMIN_CONDITIONNEMENT_DESACTIVER","Désactiver");
define("ADMIN_CONDITIONNEMENT_MODIFIER","Modifier");
define("ADMIN_CONDITIONNEMENT_SUPPRIMER","Supprimer");

//gestion des partenaires
define("ADMIN_PARTENAIRE_GESTION","Gestion des partenaires");
define("ADMIN_PARTENAIRE_ID","Identifiant");
define("ADMIN_PARTENAIRE_LIBELLE","Libellé");
define("ADMIN_PARTENAIRE_DESCRIPTIF","Descriptif");
define("ADMIN_PARTENAIRE_SITEWEB","Site web");
define("ADMIN_PARTENAIRE_ETAT","Etat");
define("ADMIN_PARTENAIRE_RANG","Rang");
define("ADMIN_PARTENAIRE_CREER","Créer un partenaire");
define("ADMIN_PARTENAIRE_ACTIVER","Activer");
define("ADMIN_PARTENAIRE_DESACTIVER","Désactiver");
define("ADMIN_PARTENAIRE_MODIFIER","Modifier");
define("ADMIN_PARTENAIRE_SUPPRIMER","Supprimer");

//gestion des commandes
define("ADMIN_COMMANDE_GESTION","Gestion des commandes");
define("ADMIN_COMMANDE_ID","Identifiant");
define("ADMIN_COMMANDE_CLIENT","Client");
define("ADMIN_COMMANDE_RESUME","Résumé");
define("ADMIN_COMMANDE_DATE_CREATION","Date de commande");
define("ADMIN_COMMANDE_DATE_RECUPERATION","Date de récupération");
define("ADMIN_COMMANDE_DATE_ANNULATION","Date d'annulation");
define("ADMIN_COMMANDE_ETAT","Etat");
define("ADMIN_COMMANDE_SOMME","Somme");
define("ADMIN_COMMANDE_CREER","Créer une commande");
define("ADMIN_COMMANDE_RECHERCHER","Rechercher");
define("ADMIN_COMMANDE_ANNULER","Annuler");
define("ADMIN_COMMANDE_REPRENDRE","Reprendre");
define("ADMIN_COMMANDE_MODIFIER","Modifier");
define("ADMIN_COMMANDE_SUPPRIMER","Supprimer");
define("ADMIN_COMMANDE_FACTUREE","Facturée ?");
define("ADMIN_COMMANDE_ENCOURS","En cours ?");
?>
