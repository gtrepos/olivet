<?php
function affiche_produits_pour_selection($select, $remonteInactif, $fnOnChange){
  
  $sqlRemonteInactif = ($remonteInactif == true) ? '' : ' and p.produit_etat = 1 ';	
	
  $requete=
		"SELECT p.produit_id, p.produit_libelle, p.produit_id_producteur " .
  		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " . $sqlRemonteInactif .
  		"ORDER by c.categorie_produit_id DESC, p.produit_libelle DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  $onChange = '';
  if ($fnOnChange!=null) $onChange = "onChange='" . $fnOnChange . "'"; 
  
  echo "<SELECT id='idProduit' name='idProduit' $onChange>";
  echo "<OPTION value='-1'>-- Sélectionner un produit --</OPTION>";
  while ($row = mysql_fetch_array($resultats))
  {
  	$selected = "";
  	if ($row[0] == $select) $selected = "selected";
  	$libelleProd = $row[1];
  	$idProducteur = $row[2];
  	$libelleProducteur = getLibelleProducteur($idProducteur);
	$libelleCompletProduit = $libelleProd;
  	if ($idProducteur!=null) {
		$libelleCompletProduit = $libelleCompletProduit . " - " . $libelleProducteur;
	}
  	echo "<OPTION value='$row[0]' $selected>$libelleCompletProduit</OPTION>";
  }
  echo "</SELECT>";  
}

//Générer une chaine de caractère unique et aléatoire

function random($car) {
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxy0123456789";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}

function affiche_tva($select){
  $selected55 = "";
  $selected196 = "";
  if ($select == '5.50') $selected55 = "selected";
  if ($select == '19.60') $selected196 = "selected";
  echo "<SELECT id='tva' name='tva'>";
  echo "<OPTION value='5.5' $selected55>5.5 %</OPTION>";
  echo "<OPTION value='19.6' $selected196>19.6 %</OPTION>";
  echo "</SELECT>";  
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

?>
