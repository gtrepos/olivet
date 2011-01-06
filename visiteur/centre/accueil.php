<?php 
 echo html_entity_decode(afficheAccueil());
?>

<?php
$tmpres = bddNouveauxProduits();
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Zoom produits : </h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		$categorie_produit_libelle = $row[1];
		$cond_nom = $row[2];
		$produit_libelle = $row[3];
		$categorie_produit_id = $row[4];
		echo "<a href='javascript:clickSelectCatProduit($categorie_produit_id)'>"
		.$categorie_produit_libelle. " > " 
		.$produit_libelle. " > " 
		.$cond_nom."</a>";
		echo "<br/>";
	}
	echo "</p>";	
}	
?>

<?php
$tmpres = bddNouveauxProduitsResa();
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Zoom produits sur réservation : </h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		$categorie_produit_libelle = $row[1];
		$produit_resa_libelle = $row[2];
		$categorie_produit_id = $row[3];
		echo "<a href='javascript:clickSelectCatProduit($categorie_produit_id)'>"
		.$categorie_produit_libelle. " > " 
		.$produit_resa_libelle."</a>";
		echo "<br/>";
	}
	echo "</p>";	
}	
?>


<?php 
$tmpres = bddActusGaec(true, false);
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Actualités du GAEC :</h3><p>";
	setlocale (LC_TIME, 'fr_FR','fra');
	$outputAffDatePost = "%A %d %B %Y";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "postée le " . utf8_encode(strftime($outputAffDatePost,strtotime($row[2]))) . " : "
		."<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
	echo "</p>";
}	
?>

<?php 
$tmpres = bddActusLoma(true, false);
if (mysql_num_rows($tmpres)>0) {	
	echo "<h3>Actualités locales et du monde agricole :</h3><p>";
	setlocale (LC_TIME, 'fr_FR','fra');
	$outputAffDatePost = "%A %d %B %Y";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "postée le " . utf8_encode(strftime($outputAffDatePost,strtotime($row[2]))) . " : "
		."<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
	echo "</p>";
}	
?>