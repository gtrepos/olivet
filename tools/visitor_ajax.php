<?php
if ( session_id() == '' ) { // no session has been started yet, which is needed for validation
	session_start();
}
require_once("visitor_panier_functions.php");
require_once('../visiteur/bean/Client.php');
require_once("visitor_bdd_functions.php");
require_once("visitor_mail_functions.php");
require_once("config.php");
require_once("../securimage/securimage.php");
ouverture();


$ajax_event = "$_POST[event]";



switch($ajax_event){
	case 'clickNavigation' :
		$ajax_menu = "$_POST[menu]";
		switch($ajax_menu){
			case 'accueil' :
				include('../visiteur/centre/accueil.php');
				break;
			case 'la_ferme' :
				include('../visiteur/centre/ferme.php');
				break;
			case 'nos_produits' :
				include('../visiteur/centre/nos_produits.php');
				break;
			case 'commander' :
				include('../visiteur/centre/commander.php');
				break;
			case 'actualites' :
				include('../visiteur/centre/actualites.php');
				break;
			case 'nous_contacter' :
				include('../visiteur/centre/contacts.php');
				break;
			case 'mesinfos' :
				include('../visiteur/centre/client/mesinfos.php');
				break;
		}		
		break;
	case 'clickCategorieProduits' :
		$ajax_id_cat_prod = "$_POST[id_cat_prod]";
		include('../visiteur/centre/commander/selection_produits/liste_produits.php'); 
		break;
	case 'clickSetQuantite' :
		$ajax_cond = "$_POST[cond]";
		$ajax_id = "$_POST[id]";
		$ajax_quantite = "$_POST[quantite]";
		panierSetQuantite($ajax_cond, $ajax_id, $ajax_quantite);
		include('../visiteur/banniere/resume_panier.php');
		break;
	case 'clickVoirCommande' :
		include('../visiteur/centre/commander/valid1.php');
		break;
	case 'clickPasserCommande' :
		if(panierNbProduits() == 0){
			echo "Erreur dans le formulaire : votre panier est vide";
		}else{
			include('../visiteur/centre/commander/valid1.php');
		}
		break;
	case 'clickValid1' :
		
		//$ajax_securimage_code = "$_POST[securimage_code]";
		//include("securimage.php");
  		$img = new Securimage();
  		$tmpvalid = $img->check("$_POST[securimage_code]");
  		
  		
  		
  		$ajax_client_mail = "$_POST[client_mail]";
  		$ajax_client_mdp = "$_POST[client_mdp]";
  		$ajax_nclient_mail = "$_POST[nclient_mail]";
  		$ajax_nclient_nom = "$_POST[nclient_nom]";
  		$ajax_nclient_mdp1 = "$_POST[nclient_mdp1]";
  		$ajax_nclient_mdp2 = "$_POST[nclient_mdp2]";
  		$ajax_nclient_prenom = "$_POST[nclient_prenom]";
  		$ajax_nclient_adresse = "$_POST[nclient_adresse]";
  		$ajax_nclient_postal = "$_POST[nclient_postal]";
  		$ajax_nclient_commune = "$_POST[nclient_commune]";
  		$ajax_nclient_tel = "$_POST[nclient_tel]";

  		$addClient = false;
  		$addCommande = false;
  		$mail = "";
  		$nouveauClient = false;
  		
  		if(($ajax_client_mail != "")&&($ajax_client_mdp != "")){
  			$tmpCheckClient = bddCheckClient($ajax_client_mail,$ajax_client_mdp);
  			if(!$tmpCheckClient){
  				echo "Erreur dans le formulaire : le client n'est pas reconnu";
  				break;
  			}
  			$addCommande = true;
  			$mail = $ajax_client_mail;
  			$nouveauClient = false;
  		}else{
  			if($ajax_nclient_mail == ""){
  				echo "Erreur dans le formulaire : un nouveau client doit au moins avoir un mail";
  				break;
  			}
  			if($ajax_nclient_mdp1 == ""){
  				echo "Erreur dans le formulaire : veuillez rentrer un mot de passe";
  				break;
  			}
  			if($ajax_nclient_mdp1 != $ajax_nclient_mdp2){
  				echo "Erreur dans le formulaire : la répétition du mot de passe n'est pas correcte";
  				break;
  			}
  			if(bddCheckExistClient($ajax_nclient_mail)){
  				echo "Erreur dans le formulaire : un client a déjà été enregistré avec ce mail";
  				break;
  			}
  			$addClient = true;
  			$addCommande = true;
  			$mail = $ajax_nclient_mail;
  			$nouveauClient = true;
  			
  			
  			//TODO ajout autres champs obligatoires
  			
  		}
  		if(panierNbProduits()==0){
  			echo "Erreur dans le formulaire : le panier est vide";
  			break;
  		}
		if($tmpvalid == false) {
  			echo "Erreur dans le formulaire : le code antispam n'est pas le bon";
  			break;
  		}
  		if($addClient){
  			bddAddClient($ajax_nclient_nom, $ajax_nclient_prenom, $ajax_nclient_adresse, $ajax_nclient_postal, 
  				$ajax_nclient_commune, $ajax_nclient_tel, $ajax_nclient_mail, $ajax_nclient_mdp1);
  		}
  		if($addCommande){
  			if(!bddAddCommande($mail)){
  				echo "Erreur dans le formulaire : probleme interne pour l'ajout de la commande ";
  				break;
  			}
  			envoiMailRecapCommande($nouveauClient);
  			
  		}
  		
  		include('../visiteur/centre/commander/valid2.php');
		break;
	case 'clickViderPanier' :
		panierVider();
		include('../visiteur/banniere/resume_panier.php');
		break;
	case 'updateCaptcha' :
		include('../visiteur/centre/commander/captcha.php');
		break;
	case 'updateCommanderPanier' :
		include('../visiteur/centre/commander/mon_panier.php');
		break;
	case 'updateProduitsDispo' :
		include('../visiteur/centre/nos_produits/produits_dispo.php');
		break;
	case 'clickCheckClient' :
		
		$ajax_client_mail = "$_POST[client_mail]";
  		$ajax_client_code = "$_POST[client_code]";
  		
		if(($ajax_client_mail != "")&&($ajax_client_code != "")){
  			$tmpCheckClient = bddCheckClient($ajax_client_mail,$ajax_client_code);
  			if(!$tmpCheckClient){
  				echo "Erreur dans le formulaire : le client n'est pas reconnu";
  				break;
  			}
  			else {
  				include('../visiteur/centre/client/formmodifclient.php');
  			}
  		}
  		
		break;
		
	case 'clickCheckModifClient' :
		
  		$ajax_client_mail = "$_POST[client_mail]";
  		$ajax_client_nom = "$_POST[client_nom]";
  		$ajax_client_prenom = "$_POST[client_prenom]";
  		$ajax_client_adresse = "$_POST[client_adresse]";
  		$ajax_client_postal = "$_POST[client_postal]";
  		$ajax_client_commune = "$_POST[client_commune]";
  		$ajax_client_tel = "$_POST[client_tel]";
  		$ajax_client_ref = "$_POST[client_ref]";
  		
		if(($ajax_client_mail != "")){
  			bddUpdateClient($ajax_client_ref,$ajax_client_mail,$ajax_client_nom,$ajax_client_prenom,
  					$ajax_client_adresse,$ajax_client_postal,$ajax_client_commune,$ajax_client_tel);
  			include('../visiteur/centre/client/confirmmodifclient.php');
  		}
  		else {
  			echo "Erreur dans le formulaire : vous devez spécifier un email";
  				break;
  		}
  		
		break;		
		
		
	
}
?>

