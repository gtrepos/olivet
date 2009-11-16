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
function bddActusGaec(){
	$requete="SELECT actualite_id, actualite_libelle,".
				 "CONCAT(SUBSTRING(actualite_descriptif, 1, 20),'...'),". 
				 "actualite_datecreation, actualite_datemodification ".
				 "FROM actualite ".
				 "WHERE actualite_type = 'GAEC' ".
				 "ORDER by actualite_id DESC ";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}
function bddActusLoma(){
	$requete="SELECT actualite_id, actualite_libelle,".
				 "CONCAT(SUBSTRING(actualite_descriptif, 1, 20),'...'),". 
				 "actualite_datecreation, actualite_datemodification ".
				 "FROM actualite ".
				 "WHERE actualite_type = 'LOMA' ".
				 "ORDER by actualite_id DESC ";
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
		"FROM  produit p, conditionnement cond " .
    	"WHERE p.produit_etat = true AND cond.cond_etat = true AND cond.cond_id_produit = p.produit_id and p.produit_id_categorie = $cat_prod ".
		"ORDER by cond.cond_id DESC";
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

function bddCheckClient($mail,$ref){
	$requete=
		"SELECT * ". 
		"FROM  client c " .
    	"WHERE c.client_reference = '$ref' ".
		"AND c.client_email = '$mail' ";	
	$resultats=mysql_query($requete) or die (mysql_error());
	return (mysql_num_rows($resultats) == 1);
}

?>