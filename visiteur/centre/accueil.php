<h3>Bienvenue !</h3>
<p>Depuis le <b>30 janvier 2010</b>, la ferme d'Olivet met  ouverture de son magasin de vente directe. 
Cette date correspond naturellement à la date de mise en ligne de ce site web. 
Celui ci vous permettera de commander les produits disponibles. blablabla... Expliquer le fonctionnement des commandes.</p> 

<h3>Nouveaux produits : </h3>

<p>
<?php
	$tmpres = bddNouveauxProduits();
	while ($row = mysql_fetch_array($tmpres)){
		$produit_id = $row[0];
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
?>
</p>

<h3>Actualités du GAEC :</h3>
<p>
<?php 
	$tmpres = bddActusGaec(true, false);	
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo $row[2]." : "
		."<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
?>
</p>
	
<h3>Actualités locales et du monde agricole :</h3>
<p>
<?php 
	$tmpres = bddActusLoma(true, false);
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo $row[2]." : "
		."<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
?>
</p>
