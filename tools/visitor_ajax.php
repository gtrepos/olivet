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
			case 'magasin' :
				include('../visiteur/centre/magasin.php');
				break;	
			case 'nous_contacter' :
				include('../visiteur/centre/contacts.php');
				break;
			case 'mesinfos' :
				include('../visiteur/centre/client/mesinfos.php');
				break;
			case 'abonnement_newsletter' :
				include('../visiteur/centre/abonnement_newsletter.php');
				break;	
		}		
		break;
	
	case 'clickSetQuantite' :
		$ajax_cond = "$_POST[cond]";
		$ajax_id = "$_POST[id]";
		$ajax_quantite = "$_POST[quantite]";
		panierSetQuantite($ajax_cond, $ajax_id, $ajax_quantite);
		include('../visiteur/droite/resume_panier.php');
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
		
		$img = new Securimage();
  		$tmpvalid = $img->check("$_POST[securimage_code]");

  		$ajax_client_mail = trim("$_POST[client_mail]");
  		$ajax_client_mdp = trim("$_POST[client_mdp]");
  		$ajax_nclient_mail = trim("$_POST[nclient_mail]");
  		$ajax_nclient_nom = trim("$_POST[nclient_nom]");
  		$ajax_nclient_prenom = trim("$_POST[nclient_prenom]");
  		$ajax_nclient_mdp1 = trim("$_POST[nclient_mdp1]");
  		$ajax_nclient_mdp2 = trim("$_POST[nclient_mdp2]");
  		$ajax_nclient_adresse = trim("$_POST[nclient_adresse]");
  		$ajax_nclient_postal = trim("$_POST[nclient_postal]");
  		$ajax_nclient_commune = trim("$_POST[nclient_commune]");
  		$ajax_nclient_tel = trim("$_POST[nclient_tel]");
  		$ajax_daterecup_commande = "$_POST[daterecup_commande]";
		$ajax_nclient_civilite = "$_POST[nclient_civilite]";
		
  		$addClient = false;
  		$addCommande = false;
  		$mail = "";
  		
  		if(($ajax_client_mail != "")||($ajax_client_mdp != "")){
  			
  			if ($ajax_client_mail == "") {
  				echo "Erreur dans le formulaire : veuillez préciser votre mail";
  				break;
  			}
  			
  			if ($ajax_client_mdp == "") {
  				echo "Erreur dans le formulaire : veuillez préciser votre mot de passe";
  				break;
  			}
  			
  			$tmpCheckClient = bddCheckClient($ajax_client_mail,$ajax_client_mdp);

  			if(!$tmpCheckClient){
  				echo "Erreur dans le formulaire : le client n'est pas reconnu";
  				break;
  			}
  			
  			$addCommande = true;
  			$mail = $ajax_client_mail;
  		}else{
  			if($ajax_nclient_mail == ""){
  				echo "Erreur dans le formulaire : veuillez préciser votre mail";
  				break;
  			}
  			if($ajax_nclient_nom == ""){
  				echo "Erreur dans le formulaire : veuillez préciser votre nom";
  				break;
  			}
  			if($ajax_nclient_prenom == ""){
  				echo "Erreur dans le formulaire : veuillez préciser votre prénom";
  				break;
  			}
  			if($ajax_nclient_tel == ""){
  				echo "Erreur dans le formulaire : veuillez préciser votre numéro de téléphone";
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
  			
  			
  		}
  		
  		if(panierNbProduits()==0){
  			echo "Impossible de commander, le panier est vide";
  			break;
  		}
  		
  		if($ajax_daterecup_commande == "" && panierNbProdsCond()>0){
  			echo "Erreur dans le formulaire : veuillez préciser une date de récupération de la commande '" . $ajax_daterecup_commande . "'";
  			break;
  		}
  		
  		if($tmpvalid == false) {
  			echo "Erreur dans le formulaire : le code de sécurité n'est pas le bon";
  			break;
  		}
  		
  		$ajax_daterecup_commande = dateFrUs($ajax_daterecup_commande);
  		
  		$messageDateRecupIncompatible = bddCheckDateRecupVsJoursDispos($ajax_daterecup_commande);
  		if($messageDateRecupIncompatible!=null) {
  			echo "Erreur dans le formulaire : ".$messageDateRecupIncompatible;
  			break;
  		}
  		
  		$messageDateRecupIncompatible = bddCheckDateRecupVsDateLimiteCommande();
  		if($messageDateRecupIncompatible!=null) {
  			echo "Erreur dans le formulaire : ".$messageDateRecupIncompatible;
  			break;
  		}
  		
  		if($addClient){
  			bddAddClient($ajax_nclient_nom, $ajax_nclient_prenom, $ajax_nclient_adresse, $ajax_nclient_postal, 
  				$ajax_nclient_commune, $ajax_nclient_tel, $ajax_nclient_mail, $ajax_nclient_mdp1, $ajax_nclient_civilite);
  		}
  		if($addCommande){
  			$idCommande = bddAddCommande($mail, $ajax_daterecup_commande);
  			if($idCommande == false){
  				echo "Erreur dans le formulaire : probleme interne pour l'ajout de la commande ";
  				break;
  			}
  			envoiMailRecapCommande($addClient, $mail, $idCommande);
  			panierVider();
  		}
  		
  		include('../visiteur/centre/commander/valid2.php');
		break;
	case 'clickViderPanier' :
		panierVider();
		include('../visiteur/droite/resume_panier.php');
		break;
	case 'updateResumePanier':
		include('../visiteur/droite/resume_panier.php');
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
		
		$ajax_client_mail = trim("$_POST[client_mail]");
  		$ajax_client_code = trim("$_POST[client_code]");
  		
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
  		else {
  			echo "Erreur dans le formulaire : vous devez spécifier un mail et un mot de passe";
  			break;
  		}
		break;
	case 'clickCheckAbonnementNewsletter' :
		$ajax_email_abonnement = trim("$_POST[email_abonnement]");
		if($ajax_email_abonnement != ""){
			$isAbonne = bddCheckAbonnementExist($ajax_email_abonnement);
			if (!$isAbonne) {
				$cleAbonnement = bddAddAbonnementNewsletter($ajax_email_abonnement);
				envoiMailConfirmAbonnementNewslettter($ajax_email_abonnement, $cleAbonnement);
			}
			else {
				echo "Erreur dans le formulaire : vous êtes déjà abonné avec l'email " . $ajax_email_abonnement;
				break;
			}
		}
		else {
			echo "Erreur dans le formulaire : vous devez spécifier un email d'abonnement";
			break;
		}
		
		include('../visiteur/centre/confirmAbonnementNewsletter.php');
		
		break;
		
	case 'clickCheckModifClient' :
		
  		$ajax_client_civilite = "$_POST[client_civilite]";
  		$ajax_client_nom = trim("$_POST[client_nom]");
  		$ajax_client_prenom = trim("$_POST[client_prenom]");
  		$ajax_client_mail = trim("$_POST[client_mail]");
  		$ajax_client_adresse = trim("$_POST[client_adresse]");
  		$ajax_client_postal = trim("$_POST[client_postal]");
  		$ajax_client_commune = trim("$_POST[client_commune]");
  		$ajax_client_tel = trim("$_POST[client_tel]");
  		$ajax_client_ref = "$_POST[client_ref]";
  		$ajax_client_motpasse = trim("$_POST[client_motpasse]");
  		$ajax_client_confmotpasse = trim("$_POST[client_confmotpasse]");
  		
  		if(($ajax_client_nom == "")){
  			echo "Erreur dans le formulaire : vous devez spécifier un nom";
  				break;
  		}
  		if(($ajax_client_prenom == "")){
  			echo "Erreur dans le formulaire : vous devez spécifier un prenom";
  				break;
  		}
		if(($ajax_client_mail == "")){
  			echo "Erreur dans le formulaire : vous devez spécifier un email";
  				break;
  		}
  		if(($ajax_client_tel == "")){
  			echo "Erreur dans le formulaire : vous devez spécifier un numéro de téléphone";
  				break;
  		}
  		if(($ajax_client_motpasse == "")){
  			echo "Erreur dans le formulaire : vous devez spécifier un mot de passe";
  				break;
  		}
  		if(($ajax_client_confmotpasse == "")){
  			echo "Erreur dans le formulaire : vous devez spécifier une confirmation de mot de passe";
  				break;
  		}
  		if(($ajax_client_confmotpasse != $ajax_client_motpasse)){
  			echo "Erreur dans le formulaire : la confirmation n'est pas équivalente au mot de passe";
  				break;
  		}
  		
  			
  		bddUpdateClient($ajax_client_ref,$ajax_client_civilite,$ajax_client_nom,$ajax_client_prenom,$ajax_client_mail,
  					$ajax_client_adresse,$ajax_client_postal,$ajax_client_commune,$ajax_client_tel,$ajax_client_motpasse);
  		include('../visiteur/centre/client/confirmmodifclient.php');
  		
		break;		
		
		
	
}
?>

