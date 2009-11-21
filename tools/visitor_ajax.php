<?php
if ( session_id() == '' ) { // no session has been started yet, which is needed for validation
	session_start();
}
require_once("visitor_panier_functions.php");
require_once("visitor_bdd_functions.php");
require_once("config.php");
require_once("../securimage/securimage.php");
ouverture();


//foreach ($_POST as $key => $value) {
//		echo "$key --- $value <br/>";
//}

$ajax_event = "$_POST[event]";


switch($ajax_event){
	case 'clickEntete' :
		$ajax_menu = "$_POST[menu]";
		switch($ajax_menu){
			case 'accueil' :
				include('../visiteur/centre/accueil.php');
				break;
			case 'ferme' :
				include('../visiteur/centre/ferme.php');
				break;
			case 'produits' :
				include('../visiteur/centre/produits.php');
				break;
			case 'commander' :
				include('../visiteur/centre/commander.php');
				break;
			case 'contacts' :
				include('../visiteur/centre/contacts.php');
				break;
		}		
		break;
	case 'clickCategorieProduits' :
		$ajax_id_cat_prod = "$_POST[id_cat_prod]";
		include('../visiteur/centre/commander/selection_produits/liste_produits.php'); 
		break;
	case 'clickSetNbArticles' :
		$ajax_id_prod = "$_POST[id_prod]";
		$ajax_nb_articles = "$_POST[nb_articles]";
		panierSetNbArticles($ajax_id_prod,$ajax_nb_articles);
		include('../visiteur/banniere/resume_panier.php');
		break;
	case 'clickVoirCommande' :
		include('../visiteur/centre/commander/valid1.php');
		break;
	case 'clickValid1' :
		
		//$ajax_securimage_code = "$_POST[securimage_code]";
		//include("securimage.php");
  		$img = new Securimage();
  		$tmpvalid = $img->check("$_POST[securimage_code]");
  		
  		if($tmpvalid == false) {
  			echo "Erreur dans le formulaire : le code antispam n'est pas le bon";
  			break;
  		}
  		
  		$ajax_client_mail = "$_POST[client_mail]";
  		$ajax_client_ref = "$_POST[client_ref]";
  		$ajax_nclient_mail = "$_POST[nclient_mail]";
  		$ajax_nclient_nom = "$_POST[nclient_nom]";
  		$ajax_nclient_prenom = "$_POST[nclient_prenom]";
  		$ajax_nclient_adresse = "$_POST[nclient_adresse]";
  		$ajax_nclient_postal = "$_POST[nclient_postal]";
  		$ajax_nclient_commune = "$_POST[nclient_commune]";
  		$ajax_nclient_tel = "$_POST[nclient_tel]";

  		if(($ajax_client_mail != "")&&($ajax_client_ref != "")){
  			$tmpCheckClient = bddCheckClient($ajax_client_mail,$ajax_client_ref);
  			if(!$tmpCheckClient){
  				echo "Erreur dans le formulaire : le client n'est pas reconnu";
  				break;
  			}
  		}else{
  			if($ajax_nclient_mail == ""){
  				echo "Erreur dans le formulaire : un nouveau client doit au moins avoir un mail";
  				break;
  			}
  		}
  		if(panierNbProduits()==0){
  			echo "Erreur dans le formulaire : le panier est vide";
  			break;
  		}
  		include('../visiteur/centre/commander/valid2.php');
		break;
	case 'clickViderPanier' :
		panierVider();
		include('../visiteur/banniere/resume_panier.php');
		break;
	case 'updateCaptcha' :
		include('../visiteur/centre/commander/valid/captcha.php');
		break;
	case 'updateCommanderPanier' :
		include('../visiteur/centre/commander/mon_panier.php');
		break;
		
	
}
?>

