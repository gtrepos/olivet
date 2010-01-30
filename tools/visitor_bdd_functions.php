<?php

function bddNouveauxProduits(){
	$requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, cond.cond_nom, p.produit_libelle, c.categorie_produit_id " .
		"FROM produit p, categorie_produit c, conditionnement cond " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id AND cond.cond_id_produit = p.produit_id " .
		"AND cond.cond_nouveaute = TRUE AND p.produit_etat = TRUE AND cond.cond_etat = TRUE ORDER by cond.cond_id DESC";

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
	$requete = "INSERT INTO commande (commande_id_client, commande_daterecuperation) " .
				"VALUES ('$client_id', '$daterecup')";
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

	echo " COMMANDE $commande_id -- ";

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
	"conditionnement.cond_divisible ".
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
	"produit_resa.produit_resa_nb_stock ".
	"FROM produit_resa ".
	"LEFT JOIN	categorie_produit ".
	"ON produit_resa.produit_resa_id_categorie = categorie_produit.categorie_produit_id ".
	"WHERE categorie_produit.categorie_produit_etat = 1 AND ".
	"produit_resa.produit_resa_etat = 1 AND ".
	"(produit_resa.produit_resa_nb_stock > 0 OR produit_resa.produit_resa_a_stock = 0) ".
	"ORDER BY categorie_produit.categorie_produit_libelle, ".
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
		$cond_prix = $row1[8];
		$cond_remise = $row1[9];
		$cond_a_stock = $row1[10];
		$cond_nb_stock = $row1[11];
		$cond_divisible = $row1[12];
		
		$globStruc[$categorie_produit_id]["categorie_produit_libelle"] = $categorie_produit_libelle;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_libelle"] = $produit_libelle;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_photo"] = $produit_photo;
		$globStruc[$categorie_produit_id]["produits_cond"][$produit_id]["produit_descriptif_production"] = $produit_descriptif_production;
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
		$produit_resa_a_stock =  $row2[6];
		$produit_resa_nb_stock =  $row2[7];

		$globStruc[$categorie_produit_id]["categorie_produit_libelle"] = $categorie_produit_libelle;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_libelle"] = $produit_resa_libelle;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_photo"] = $produit_resa_photo;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_descriptif_production"] = $produit_resa_descriptif_production;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_a_stock"] = $produit_resa_a_stock;
		$globStruc[$categorie_produit_id]["produits_resa"][$produit_resa_id]["produit_resa_nb_stock"] = $produit_resa_nb_stock;
	}
	return $globStruc;
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

function bddUpdateClient($reference,$civilite,$nom,$prenom,$mail,$adresse,$codepostal,$commune,$numerotel,$motdepasse){
	$requete=$requete = "UPDATE client SET client_nom = '$nom', client_prenom = '$prenom', " .
			"client_adresse = '$adresse', client_code_postal = '$codepostal', client_commune = '$commune', " .
			"client_numero_tel = '$numerotel', client_email = '$mail', client_civilite = '$civilite', client_code = '$motdepasse' WHERE client_reference = '$reference'";
	$resultats=mysql_query($requete) or die (mysql_error());
}

function bddPartenaires(){
	$requete=
		"SELECT partenaire_libelle, partenaire_descriptif, partenaire_siteweb ". 
		"FROM  partenaire " .
    	"WHERE partenaire_etat = 1 ".
		"ORDER BY partenaire_rang, partenaire_libelle ";	
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}


?>