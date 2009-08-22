<?php

function bddNouveauxProduits(){
	$requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, p.produit_libelle,". 
		"CONCAT(SUBSTRING(p.produit_descriptif_production, 1, 50),'...'), p.produit_nouveaute, p.produit_etat, p.produit_unite " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " .
		"AND p.produit_nouveaute = TRUE ".
  		"ORDER by p.produit_id DESC";
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
function bddProduits($cat_prod){
	$requete=
		"SELECT p.produit_id ,p.produit_libelle,p.produit_unite,p.produit_prix,p.produit_id,p.produit_id_categorie    ". 
		"FROM  produit p " .
    	"WHERE p.produit_id_categorie = $cat_prod ".
		"ORDER by p.produit_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}
function bddLigneProduit($idproduit){
	$requete=
		"SELECT * ". 
		"FROM  produit p " .
    	"WHERE p.produit_id = $idproduit ";
	$resultats=mysql_query($requete) or die (mysql_error());
	return $resultats;
}
?>