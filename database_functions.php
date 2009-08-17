<?php
function affiche_nouveautes(){
	require_once("tools/config.php") ;
	ouverture();
	echo "<p style=\"text-align:left; border-style: solid\">";

	///---------- ACTU GAEC :
	
	echo "NOUVEAUX PRODUITS :";
	echo "<br/>";
	$requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, p.produit_libelle,". 
		"CONCAT(SUBSTRING(p.produit_descriptif_production, 1, 50),'...'), p.produit_nouveaute, p.produit_etat, p.produit_unite " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " .
		"AND p.produit_nouveaute = TRUE ".
  		"ORDER by p.produit_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	while ($row = mysql_fetch_array($resultats)){
		echo "=>$row[2] : $row[3]";
		echo "<br/>";
	}

	///---------- ACTU GAEC :
	
	echo "ACTU GAEC :";
	echo "<br/>";
	$requete="SELECT actualite_id, actualite_libelle,
	CONCAT(SUBSTRING(actualite_descriptif, 1, 20),'...'), 
	actualite_datecreation, actualite_datemodification 
	FROM actualite ORDER by actualite_id DESC";
	$resultats=mysql_query($requete) or die (mysql_error());
	while ($row = mysql_fetch_array($resultats)){
		echo "=>$row[1]: $row[2]";
		echo "<br/>";
	}
	
	///---------- ACTU LOCALES/MONDE AGRICOLE :
	
	echo "ACTU LOCALES/MONDE AGRICOLE :";
	echo "<br/>";
	 
	echo "=>TODO : pour le moment qu'une table Actualités..";
	echo "<br/>";
	
	///-----------
	
	echo "</p>";

}
?>