<?php

require_once("../../tools/config.php");
require_once("../../tools/transaction.php");
require_once("fn-commande.php");
require_once("fn-client.php");
require_once("fn-actualite.php");
require_once("fn-categorie_produit.php");
require_once("fn-produit.php");
require_once("fn-conditionnement.php");
require_once("fn-partenaire.php");
require_once("fn-produit-resa.php");
require_once("fn-producteur.php");
require_once("fn-abonnes-newsletter.php");

ouverture();


$ajax_event = "$_POST[event]";

switch($ajax_event){
  	case 'supprimeActualite' :
  		$id = "$_POST[id]";
  		supprimer_actu($id);
		break;
	case 'supprimeCategorie' :
  		$id = "$_POST[id]";
  		supprimer_categorie($id);
		break;
	case 'supprimeClient' :
  		$id = "$_POST[id]";
  		supprimer_client($id);
		break;	
	case 'supprimeConditionnement' :
  		$idcond = "$_POST[idcond]";
  		supprimer_conditionnement($idcond);
  		break;
	case 'updateNouveauteConditionnement' :
  		$idcond = "$_POST[idcond]";
  		$nouveaute = "$_POST[nouveaute]";
  		updateNouveauteConditionnement($idcond,$nouveaute);
  		break;  		
  	case 'facturerCommande':
  		$id = "$_POST[id]";
  		facturer_commande($id);
		break;
	case 'defacturerCommande':
  		$id = "$_POST[id]";
  		defacturer_commande($id);
		break;  		
  	case 'supprimerCommande' :
  		$id = "$_POST[id]";
  		supprimer_commande($id);
		break;
	case 'supprimerPartenaire' :
  		$id = "$_POST[id]";
  		supprimer_partenaire($id);
		break;
	case 'supprimerProducteur' :
  		$id = "$_POST[id]";
  		supprimer_producteur($id);
		break;
	case 'supprimerProduit' :
  		$id = "$_POST[id]";
  		supprimer_produit($id);
		break;
	case 'supprimerProduitResa' :
  		$id = "$_POST[id]";
  		supprimer_produit_resa($id);
		break;	
	case 'supprimerAbonneNewsletter' :
  		$email = "$_POST[email]";
  		supprimer_abonne_newsletter($email);
		break;		
}


?>


