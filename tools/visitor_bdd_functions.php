<?php


function bddCommandeDateRecup($id_commande){
	$requete = 
	"SELECT commande.commande_daterecuperation " .
	"FROM commande ".
	"WHERE commande.commande_id = $id_commande ";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}


function bddCommandeProdsResa($id_commande){
	$requete = 
	"SELECT produit_resa.produit_resa_libelle" .
	" , produit_resa.produit_resa_descriptif_production ".
	" , lien_commande_produit_resa.lcpr_quantite, produit_resa.produit_resa_date_recuperation, produit_resa_date_limite_recuperation ".
	"FROM produit_resa, lien_commande_produit_resa ".
	"WHERE lien_commande_produit_resa.lcpr_id_commande = $id_commande ".
	"AND lien_commande_produit_resa.lcpr_id_produit_resa = produit_resa.produit_resa_id ";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddCommandeProdsConds($id_commande){
	$requete = 
	"SELECT produit.produit_libelle, conditionnement.cond_nom ".
	" , conditionnement.cond_prix, conditionnement.cond_remise ".
	" , lien_commande_cond.lcc_quantite ".
	"FROM produit, conditionnement, lien_commande_cond ".
	"WHERE lien_commande_cond.lcc_id_commande = $id_commande ".
	"AND lien_commande_cond.lcc_id_cond = conditionnement.cond_id ".
	"AND conditionnement.cond_id_produit = produit.produit_id ";
	 
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function SAVEbddClientInfoFromCommande($id_commande){
//	$requete = 
//	"SELECT client.client_reference, client.client_nom, client.client_prenom".
//	" ,client.client_adresse, client.client_code_postal, client.client_commune ".
//	" ,client.client_email , client.client_code  ".
//	"FROM client, commande ".
//	"WHERE client.client_reference = commande.commande_id_client ".
//	"AND commande.commande_id = $id_commande";
//	
//	
//	$resultats=mysql_query($requete) or die (mysql_error());
//	return $resultats;
}

function bddClientInfoFromCommande($id_commande){
//	$requete = 
//	"SELECT c.client_reference, c.client_nom, c.client_prenom, ".
//	"c.client_adresse, c.client_code_postal, c.client_commune, ".
//	"c.client_email , c.client_code , co.commande_id, ".
//	"FROM client c, commande co ".
//	"WHERE c.client_reference = co.commande_id_client ".
//	"AND co.commande_id = $id_commande";
	
	$requete=
		"SELECT c.client_reference, c.client_nom, c.client_prenom, ".
		"c.client_adresse, c.client_code_postal, c.client_commune, ".
		"c.client_email , c.client_code, co.commande_id ".
		"FROM client c, commande co ".
		"WHERE co.commande_id = $id_commande ";
		"AND c.client_reference = co.commande_id_client ";
	$resultats=mysql_query($requete) or die (mysql_error());
	

	
	return $resultats;
}

function bddClientInfoFromEmail($email){
//	$requete = 
//	"SELECT c.client_reference, c.client_nom, c.client_prenom, ".
//	"c.client_adresse, c.client_code_postal, c.client_commune, ".
//	"c.client_email , c.client_code , co.commande_id, ".
//	"FROM client c, commande co ".
//	"WHERE c.client_reference = co.commande_id_client ".
//	"AND co.commande_id = $id_commande";
	
	$requete=
		"SELECT c.client_reference, c.client_nom, c.client_prenom, ".
		"c.client_adresse, c.client_code_postal, c.client_commune, ".
		"c.client_email , c.client_code ".
		"FROM client c ".
		"WHERE c.client_email = '$email' ";
	$resultats=mysql_query($requete) or die (mysql_error());
	

	
	return $resultats;
}


function afficheAccueil(){
	$requete=
		"SELECT valeur FROM parametrage where parametre='accueil'";
	$resultats=mysql_query($requete) or die (mysql_error());
	$row = mysql_fetch_array($resultats);
	return $row[0];
}


function bddNouveauxProduits(){
	$requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, cond.cond_nom, p.produit_libelle, c.categorie_produit_id " .
		"FROM produit p, categorie_produit c, conditionnement cond " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id AND cond.cond_id_produit = p.produit_id " .
		"AND cond.cond_nouveaute = TRUE AND p.produit_etat = TRUE AND cond.cond_etat = TRUE ORDER by cond.cond_id DESC";

	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddNouveauxProduitsResa(){
	$requete = 
		"SELECT p.produit_resa_id, c.categorie_produit_libelle, p.produit_resa_libelle, c.categorie_produit_id " .
		"FROM produit_resa p, categorie_produit c " .
		"WHERE p.produit_resa_id_categorie = c.categorie_produit_id " .
		"AND p.produit_resa_nouveaute = TRUE AND p.produit_resa_etat = TRUE ORDER by p.produit_resa_id DESC";
	
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddActusGaec($nouveaute, $descriptif){
	$select = "SELECT actualite_id, actualite_libelle, ".
				 "actualite_datecreation, actualite_datemodification ";
	$from = " FROM actualite ";
	$where = " WHERE actualite_type = 'GAEC' and actualite_etat = 1 ";
	$order = " ORDER by actualite_datecreation DESC ";

	if ($nouveaute) {
		$where = $where . " and actualite_nouveaute = 1";
	}

	if ($descriptif) {
		$select = $select . " , actualite_descriptif ";
	}

	$requete = $select . $from . $where . $order;
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddAddClient($nom, $prenom, $adresse, $codepostal, $commune, $numerotel, $email, $mdp, $civilite){
	$requete = "INSERT INTO client (client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email, client_code, client_civilite) " .
				"VALUES ('$nom', '$prenom', '$adresse', '$codepostal', '$commune', '$numerotel', '$email', '$mdp', '$civilite')";		 
	$result=mysql_query($requete) or die (mysql_error());
}

function bddAddAbonnementNewsletter($emailAbonnement){
	$token = md5 (uniqid());
	$requete = "INSERT INTO abonnement_newsletter (email_abonnement, token) VALUES ('$emailAbonnement', '$token')";
	$result=mysql_query($requete) or die (mysql_error());
	return $token;
}


/**
 * add a command for client which mail is given.
 * The client is required to be already registered.
 * @param $mail
 * @return unknown_type
 */
function bddAddCommande($mail, $daterecup){
	//recup id client
	$select = "SELECT client.client_reference ".
		"FROM client ".
		"WHERE client.client_email = '$mail'";
	$client_id = "";
	$tmpres1 = mysql_query($select) or die (mysql_error());
	while ($row1 = mysql_fetch_array($tmpres1)){
		$client_id = $row1[0];
	}
	if($client_id == ""){
		return false;
	}
	//add commande
	
	$requete = null;
	if ($daterecup != null) {
		$requete = "INSERT INTO commande (commande_id_client, commande_daterecuperation) " .
				"VALUES ('$client_id', '$daterecup')";	
	}
	else {
		$requete = "INSERT INTO commande (commande_id_client) " .
				"VALUES ('$client_id')";
	}
	$tmpres2 = mysql_query($requete) or die (mysql_error());
	if($tmpres2 == ""){
		return false;
	}

	//recup id commande
	$select = "SELECT LAST_INSERT_ID(commande_id) FROM commande";
	$tmpres3 = mysql_query($select) or die (mysql_error());
	$commande_id = "";
	while ($row3 = mysql_fetch_array($tmpres3)){
		$commande_id = $row3[0];
	}
	if($commande_id == ""){
		return false;
	}

	
	//add prod conditionnes
	$prodsConds = panierSelProdsCond();
	if($prodsConds != false){
		for($i=0;$i<count($prodsConds);$i++){
			$idCond = $prodsConds[$i]["id"];
			$qtite = $prodsConds[$i]["qtite"];

			$requete =  "INSERT INTO lien_commande_cond (lcc_id_commande, lcc_id_cond, lcc_quantite) " .
				"VALUES ('$commande_id', '$idCond', '$qtite')";
			$tmpres4 = mysql_query($requete) or die (mysql_error());
			if($tmpres4 == ""){
				return false;
			}
		}
	}

	//add prod resa
	$prodsResa = panierSelProdsResa();
	if($prodsResa != false){
		for($i=0;$i<count($prodsResa);$i++){
			$idResa = $prodsResa[$i]["id"];
			$qtite = $prodsResa[$i]["qtite"];

			$requete =  "INSERT INTO lien_commande_produit_resa (lcpr_id_commande, lcpr_id_produit_resa, lcpr_quantite) " .
				"VALUES ('$commande_id', '$idResa', '$qtite')";
			$tmpres5 = mysql_query($requete) or die (mysql_error());
			if($tmpres5 == ""){
				return false;
			}
		}
	}

	return $commande_id;

}

function bddActusLoma($nouveaute, $descriptif){
	$select = "SELECT actualite_id, actualite_libelle, ".
				 "actualite_datecreation, actualite_datemodification ";
	$from = " FROM actualite ";
	$where = " WHERE actualite_type = 'LOMA' and actualite_etat = 1 ";
	$order = " ORDER by actualite_datecreation DESC ";

	if ($nouveaute) {
		$where = $where . " and actualite_nouveaute = 1";
	}

	if ($descriptif) {
		$select = $select . " , actualite_descriptif ";
	}

	$requete = $select . $from . $where . $order;
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddCategorieMenu(){
	$requete=
		"SELECT c.categorie_produit_id, c.categorie_produit_libelle ". 
		"FROM categorie_produit c " .
		"ORDER by c.categorie_produit_libelle DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;

}


function bddLigneProdCond($idproduitcond){
	$requete=
		"SELECT cond.cond_id, 
		cond.cond_nom, 
		cond.cond_prix, cond.cond_remise, 
		p.produit_libelle, 
		p.produit_id_categorie ". 
		"FROM  produit p, conditionnement cond " .
    	"WHERE cond.cond_id_produit = p.produit_id AND cond.cond_id = $idproduitcond ";	

	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}


/**
 * @brief Un conditionnement est disponible si tout est respecte :
 *   la categorie du produit est actif
 *   le produit est actif
 *   le conditionnement est actif
 *   (le stock est > 0) OU (le conditionnement n'est pas gere par stock)
 */
function bddProdsCondDispo(){
	$requete =
	"SELECT DISTINCT ".
	"categorie_produit.categorie_produit_id, ". 
	"categorie_produit.categorie_produit_libelle, ".
	"produit.produit_id, ".
	"produit.produit_libelle, ".
	"conditionnement.cond_id, ".
	"conditionnement.cond_nom, ".
	"produit.produit_photo, ".
	"produit.produit_descriptif_production, ".
	"conditionnement.cond_prix, ".
	"conditionnement.cond_remise, ".
	"conditionnement.cond_a_stock, ".
	"conditionnement.cond_nb_stock, ".
	"conditionnement.cond_divisible, ".
	"produit.produit_rang," .
	"produit.produit_jours_dispos, ".
	"produit.produit_id_producteur ".
	"FROM produit ".
	"LEFT JOIN	categorie_produit ".
	"ON produit.produit_id_categorie = categorie_produit.categorie_produit_id ".
	"LEFT JOIN conditionnement ".
	"ON conditionnement.cond_id_produit = produit.produit_id ".
	"WHERE categorie_produit.categorie_produit_etat = 1 AND ".
	"produit.produit_etat = 1 AND ".
	"conditionnement.cond_etat = 1 AND ".
	"(conditionnement.cond_nb_stock > 0 OR conditionnement.cond_a_stock = 0) ".
	"ORDER BY categorie_produit.categorie_produit_libelle, ".
	"produit.produit_rang, ".
	"produit.produit_libelle, ".
	"conditionnement.cond_nom ";

	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}


/**
 * @brief Un produit à la réservation est dispo si tout est respecte :
 *   la categorie du produit_resa est actif
 *   le produit_resa est actif
 *   (le stock est > 0) OU (le produit_resa n'est pas gere par stock)
 */
function bddProdsResaDispo(){
	$requete =
	"SELECT DISTINCT ".
	"categorie_produit.categorie_produit_id, ". 
	"categorie_produit.categorie_produit_libelle, ".
	"produit_resa.produit_resa_id, ".
	"produit_resa.produit_resa_libelle, ".
	"produit_resa.produit_resa_photo, ".
	"produit_resa.produit_resa_descriptif_production, ".
	"produit_resa.produit_resa_a_stock, ".
	"produit_resa.produit_resa_nb_stock, ".
	"produit_resa.produit_resa_rang, ".
	"produit_resa.produit_resa_date_recuperation, ".
	"produit_resa.produit_resa_date_limite_recuperation, ".
	"produit_resa.produit_resa_date_limite_commande," .
	"produit_resa.produit_resa_id_producteur ".
	"FROM produit_resa ".
	"LEFT JOIN	categorie_produit ".
	"ON produit_resa.produit_resa_id_categorie = categorie_produit.categorie_produit_id ".
	"WHERE categorie_produit.categorie_produit_etat = 1 AND ".
	"produit_resa.produit_resa_etat = 1 AND ".
	"(produit_resa.produit_resa_nb_stock > 0 OR produit_resa.produit_resa_a_stock = 0) ".
	"ORDER BY categorie_produit.categorie_produit_libelle, ".
	"produit_resa.produit_resa_rang, ".
	"produit_resa.produit_resa_libelle";

	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}
/**
 * @brief donne une structure contenant tous les produits dispo (Cond ou Resa)
 * @return structure globale facile à parcourir
 */
function bddProdsDispo(){


	$tmpres1 = bddProdsCondDispo();
	while ($row1 = mysql_fetch_array($tmpres1)){
		$categorie_produit_id = $row1[0];
		$categorie_produit_libelle = $row1[1];
		$produit_id = $row1[2];
		$produit_libelle = $row1[3];
		$cond_id = $row1[4];
		$cond_nom = $row1[5];
		$produit_photo = $row1[6];
		$produit_descriptif_production = $row1[7];
		$produit_descriptif_production = nl2br($produit_descriptif_production);
		$cond_prix = $row1[8];
		$cond_remise = $row1[9];
		$cond_a_stock = $row1[10];
		$cond_nb_stock = $row1[11];
		$cond_divisible = $row1[12];
		$produit_jours_dispos = $row1[14];
		$idProducteur = $row1[15];
		$libelleProducteur = getLibelleProducteur($idProducteur);
		
		$globStruc[$categorie_produit_id]["categorie_produit_libelle"] = $categorie_produit_libelle;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_libelle"] = $produit_libelle;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_photo"] = $produit_photo;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_descriptif_production"] = $produit_descriptif_production;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_jours_dispos"] = $produit_jours_dispos;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_producteur"] = $libelleProducteur;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["conditionnements"][$cond_id]["cond_nom"] = $cond_nom;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["conditionnements"][$cond_id]["cond_prix"] = $cond_prix;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["conditionnements"][$cond_id]["cond_remise"] = $cond_remise;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["conditionnements"][$cond_id]["cond_a_stock"] = $cond_a_stock;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["conditionnements"][$cond_id]["cond_nb_stock"] = $cond_nb_stock;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["conditionnements"][$cond_id]["cond_divisible"] = $cond_divisible;

	}


	$tmpres2 = bddProdsResaDispo();
	while ($row2 = mysql_fetch_array($tmpres2)){
		$categorie_produit_id =  $row2[0];
		$categorie_produit_libelle =  $row2[1];
		$produit_resa_id =  $row2[2];
		$produit_resa_libelle =  $row2[3];
		$produit_resa_photo =  $row2[4];
		$produit_resa_descriptif_production =  $row2[5];
		$produit_resa_descriptif_production = nl2br($produit_resa_descriptif_production);
		$produit_resa_a_stock =  $row2[6];
		$produit_resa_nb_stock =  $row2[7];
		$produit_resa_date_recuperation = dateUsFr($row2[9]) ;
		$produit_resa_date_limite_recuperation = dateUsFr($row2[10]);
		$produit_resa_date_limite_commande = dateUsFr($row2[11]);
		$idProducteur = $row2[12];
		$libelleProducteur = getLibelleProducteur($idProducteur);

		$globStruc[$categorie_produit_id]["categorie_produit_libelle"] = $categorie_produit_libelle;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_libelle"] = $produit_resa_libelle;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_photo"] = $produit_resa_photo;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_descriptif_production"] = $produit_resa_descriptif_production;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_a_stock"] = $produit_resa_a_stock;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_nb_stock"] = $produit_resa_nb_stock;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_date_recuperation"] = $produit_resa_date_recuperation;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_date_limite_recuperation"] = $produit_resa_date_limite_recuperation;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_date_limite_commande"] = $produit_resa_date_limite_commande;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_producteur"] = $libelleProducteur;
	}
	return $globStruc;
}

function getLibelleProducteur($idProducteur){
	if ($idProducteur!=null) {
		$requete = "SELECT producteur_libelle FROM producteur where producteur_id = $idProducteur";
		$resultats=mysql_query($requete) or die (mysql_error());
		while ($row = mysql_fetch_array($resultats)){
			return $row[0];	
		}
	}
	else {
		return null;
	}
}


/**
 *
 * @param $mail
 * @param $code
 * @return unknown_type
 */

function bddCheckClient($mail,$code){
	$requete=
		"SELECT c.client_reference ". 
		"FROM  client c " .
    	"WHERE c.client_code = '$code' ".
		"AND c.client_email = '$mail' ";
	$resultats=mysql_query($requete) or die (mysql_error());

	$retour = false;

	while ($row = mysql_fetch_array($resultats))
	{
		$retour = new Client();
		$retour->InitClient($row[0]);
	}

	return $retour;
}

/**
 * return true if a client with given mail is
 * already registered
 * @param $mail
 * @return unknown_type
 */
function bddCheckExistClient($mail){
	$requete=
		"SELECT c.client_reference ". 
		"FROM  client c " .
    	"WHERE c.client_email = '$mail' ";
	$resultats=mysql_query($requete) or die (mysql_error());
	$retour = false;
	while ($row = mysql_fetch_array($resultats))
	{
		$retour = true;
	}
	return $retour;
}

/**
 * return true if a client with given mail is
 * already registered
 * @param $mail
 * @return unknown_type
 */
function bddCheckAbonnementExist($email_abonnement){
	$requete=
		"SELECT email_abonnement FROM abonnement_newsletter WHERE email_abonnement = '$email_abonnement' ";
	$resultats=mysql_query($requete) or die (mysql_error());
	$retour = false;
	while ($row = mysql_fetch_array($resultats))
	{
		$retour = true;
	}
	return $retour;
}


function bddUpdateClient($reference,$civilite,$nom,$prenom,$mail,$adresse,$codepostal,$commune,$numerotel,$motdepasse){
	$requete=$requete = "UPDATE client SET client_nom = '$nom', client_prenom = '$prenom', " .
			"client_adresse = '$adresse', client_code_postal = '$codepostal', client_commune = '$commune', " .
			"client_numero_tel = '$numerotel', client_email = '$mail', client_civilite = '$civilite', client_code = '$motdepasse' WHERE client_reference = '$reference'";
	$resultats=mysql_query($requete) or die (mysql_error());
}

function bddPartenaires(){
	$requete=
		"SELECT partenaire_libelle, partenaire_descriptif, partenaire_siteweb, partenaire_logo ". 
		"FROM  partenaire " .
    	"WHERE partenaire_etat = 1 ".
		"ORDER BY partenaire_rang, partenaire_libelle ";	
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddProducteurs(){
	$requete=
		"SELECT producteur_libelle, producteur_descriptif, producteur_siteweb, producteur_logo ". 
		"FROM  producteur " .
    	"WHERE producteur_etat = 1 ".
		"ORDER BY producteur_rang, producteur_libelle ";	
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function isCommandePossible(){
	
	$requete=
		"SELECT parametre, valeur from parametrage where parametre = 'commande_possible' and valeur = 'oui' ";
	$resultats=mysql_query($requete) or die (mysql_error());
	$retour = false;
	while ($row = mysql_fetch_array($resultats))
	{
		$retour = true;
	}
	return $retour;
}


function dateUsFr($dateUs) {
	if ($dateUs != null) {
		$dateUsExplode = explode("-", $dateUs);
		return $dateUsExplode[2] . "/" . $dateUsExplode[1] . "/" . $dateUsExplode[0];
	}
}

function dateFrUs($dateFr) {
	if ($dateFr != null) {
		$dateFrExplode = explode("/", $dateFr);
		return $dateFrExplode[2] . "-" . $dateFrExplode[1] . "-" . $dateFrExplode[0];
	}
}

function afficheJoursDispos($concat) {
	$retour = "";
	if ($concat!=null) {
		$joursDispoExplode = explode("|",$concat);
		foreach ( $joursDispoExplode as $jourDispo ) {
			switch ($jourDispo) {
			case 2:
			    $retour = $retour."mardi ";
			    break;
			case 3:
			    $retour = $retour."mercredi ";
			    break;
			case 4:
			    $retour = $retour."jeudi ";
			    break;
			case 5:
			    $retour = $retour."vendredi ";
			    break;
			case 6:
			    $retour = $retour."samedi ";
			    break; 
			 default:
    			$retour = $retour."";
			}
		 
		}
	}
	
	if ($retour == 'mardi mercredi jeudi vendredi samedi ') {
		return "";
	}
	
	return $retour;	
}

function bddCheckDateRecupVsJoursDispos($dateRecup) {
	$jourSemaine = getJourSemaine($dateRecup);
	$nbJourSemaine = date('w', strtotime($dateRecup));
	$produitsCond = panierSelProdsCond();
	if ($produitsCond!=null) {
		$requeteBaseCond=
		"SELECT p.produit_jours_dispos, p.produit_libelle, c.cond_nom FROM produit p, conditionnement c " .
		"WHERE p.produit_id = c.cond_id_produit AND c.cond_id = ";	
		foreach ( $produitsCond as $prod) {
			$requeteCond = $requeteBaseCond.$prod["id"];
			$resultatsCond=mysql_query($requeteCond) or die (mysql_error());
			if (mysql_num_rows($resultatsCond)>0) {
				while ($row = mysql_fetch_array($resultatsCond)){
					$joursDisposTab=explode("|",$row[0]);
					if (!in_array($nbJourSemaine,$joursDisposTab)) {
						return "Le produit '".$row[1]."' n'est pas disponible le ".$jourSemaine.".\nDisponibilité : " . getDisponibilite($joursDisposTab);
					}
				}
			}
		}
		return null;
	}
	return null;
}

function bddCheckDateRecupVsDateLimiteCommande() {
	$aujourdhui = mktime(0,0,0,date("m" ),date("d" ),date("Y"));//demain
	$produitsResa = panierSelProdsResa();
	if ($produitsResa!=null) {
		$requeteResaBase="SELECT p.produit_resa_date_limite_commande, p.produit_resa_libelle FROM produit_resa p WHERE p.produit_resa_id = ";
		foreach ( $produitsResa as $prodResa ) {
			$requeteResa = $requeteResaBase.$prodResa["id"];
			$resultatsResa=mysql_query($requeteResa) or die (mysql_error());
			if (mysql_num_rows($resultatsResa)>0) {
				while ($row = mysql_fetch_array($resultatsResa)){
					$dateLimiteCommandeTs = strtotime($row[0]);
					if ($aujourdhui > $dateLimiteCommandeTs) {
						return "Le produit '".$row[1]."' ne peut pas être réservé. \nIl a une date limite de commande fixée au ".dateUsFr($row[0])." inclu.";
					}				
				}
			}
		}
		return null;
	}
	return null;
}


function getJourSemaine($dateUs) {
	$leJour = date('l', strtotime($dateUs));
	
	switch ($leJour) {
		case "Monday":
    		return "lundi";
    		break;
		case "Tuesday":
    		return "mardi";
    		break;
		case "Wednesday":
			return "mercredi";
    		break;
    	case "Thursday":
    		return "jeudi";
    		break;	
		case "Friday":
    		return "vendredi";
    		break;
    	case "Saturday":
    		return "samedi";
    		break;	
		case "Sunday":
    		return "dimanche";
    		break;
    	default:
    		return "";	
	}
}

function getDisponibilite($arrayJoursDispo) {
	$retour = "";
	if ($arrayJoursDispo!=null) {
		foreach ( $arrayJoursDispo as $jourDispo ) {
			switch ($jourDispo) {
			case 2:
			    $retour = $retour."mardi ";
			    break;
			case 3:
			    $retour = $retour."mercredi ";
			    break;
			case 4:
			    $retour = $retour."jeudi ";
			    break;
			case 5:
			    $retour = $retour."vendredi ";
			    break;
			case 6:
			    $retour = $retour."samedi ";
			    break; 
			 default:
    			$retour = $retour."";
			}
		 
		}
	}
	return $retour;
}

?>