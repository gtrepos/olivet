<?php
function affiche_produits_pour_selection($select, $remonteInactif, $fnOnChange){
  
  $sqlRemonteInactif = ($remonteInactif == true) ? '' : ' and p.produit_etat = 1 ';	
	
  $requete=
		"SELECT p.produit_id, p.produit_libelle, p.produit_unite, p.produit_prix_unite " .
  		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " . $sqlRemonteInactif .
  		"ORDER by c.categorie_produit_id, p.produit_libelle DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  $onChange = '';
  if ($fnOnChange!=null) $onChange = "onChange='" . $fnOnChange . "'"; 
  
  echo "<SELECT id='idProduit' name='idProduit' $onChange>";
  echo "<OPTION value='-1'>-- Sélectionner un produit --</OPTION>";
  while ($row = mysql_fetch_array($resultats))
  {
  	$selected = "";
  	if ($row[0] == $select) $selected = "selected";
  	echo "<OPTION value='$row[0]' $selected>$row[1]</OPTION>";
  }
  echo "</SELECT>";  
}
?>
