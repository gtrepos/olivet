<?php

function bddNouveauxProduits(){
	$requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, cond.cond_nom, p.produit_libelle, " .
		"CONCAT(SUBSTRING(p.produit_descriptif_production, 1, 50),'...'), p.produit_etat, " .
		"p.produit_unite FROM produit p, categorie_produit c, conditionnement cond " .
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
function bddProduitsConditionnes($cat_prod){
	$requete=
		"SELECT cond.cond_id, cond.cond_nom, cond.cond_prix, cond.cond_quantite_produit, " .
		"p.produit_libelle, p.produit_unite, p.produit_prix_unite, p.produit_id_categorie ". 
		"FROM  produit p, conditionnement cond ". 
    	"WHERE p.produit_etat = true AND cond.cond_etat = true AND cond.cond_id_produit = p.produit_id and p.produit_id_categorie = $cat_prod ".
		"ORDER by cond.cond_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddProduitsConditionnesTous(){
	$requete=
		"SELECT cond.cond_id, cond.cond_nom, cond.cond_prix, cond.cond_quantite_produit, " .
		"p.produit_libelle, p.produit_unite, p.produit_prix_unite, ".
		"p.produit_id_categorie, cond.cond_nb_stock ". 
		"FROM  produit p, conditionnement cond " .
    	"WHERE p.produit_etat = true AND cond.cond_etat = true AND cond.cond_id_produit = p.produit_id ".
		"ORDER by cond.cond_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddConditionnements($id_prod){
	$requete=
		"SELECT cond.cond_nb_stock, cond.cond_nom, cond.cond_prix, cond.cond_quantite_produit, ".
		"cond.cond_id ".
		"FROM conditionnement cond " .
    	"WHERE cond.cond_id_produit = $id_prod ".
		"ORDER by cond.cond_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

function bddProduitsDispo($id_cat){
	$requete=
		"SELECT DISTINCT p.produit_libelle, p.produit_unite, ". 
		"p.produit_prix_unite, p.produit_id_categorie, ".
	    "p.produit_descriptif_production, p.produit_photo, p.produit_id ".
		"FROM produit p ".
		"LEFT JOIN conditionnement cond ".
		"ON p.produit_id=cond.cond_id_produit ".
		"WHERE p.produit_etat = true and cond.cond_etat = true ".
		"and cond.cond_nb_stock > 0 and  p.produit_id_categorie = $id_cat ".
		"ORDER BY cond.cond_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}
function bddLigneProduit($idproduitcond){
	$requete=
		"SELECT cond.cond_id, cond.cond_nom, cond.cond_prix, cond.cond_quantite_produit, " .
		"p.produit_libelle, p.produit_unite, p.produit_prix_unite, p.produit_id_categorie ". 
		"FROM  produit p, conditionnement cond " .
    	"WHERE cond.cond_id_produit = p.produit_id AND cond.cond_id = $idproduitcond ";	
	 
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}

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

function bddUpdateClient($reference,$mail,$nom,$prenom,$adresse,$codepostal,$commune,$numerotel){
	$requete=$requete = "UPDATE client SET client_nom = '$nom', client_prenom = '$prenom', " .
			"client_adresse = '$adresse', client_code_postal = '$codepostal', client_commune = '$commune', " .
			"client_numero_tel = '$numerotel', client_email = '$mail' WHERE client_reference = '$reference'";
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