<h3>Bienvenue !</h3>
<p>Depuis le <b>30 janvier 2010</b>, la ferme d'Olivet met  ouverture de son magasin de vente directe. 
Cette date correspond naturellement à la date de mise en ligne de ce site web. 
Celui ci vous permettera de commander les produits disponibles. blablabla... Expliquer le fonctionnement des commandes.</p> 

<h3>Nouveaux produits : </h3>

<p>
<?php
	$tmpres = bddNouveauxProduits();
	while ($row = mysql_fetch_array($tmpres)){
		echo $row[1] . " > " . $row[3] . " > " . $row[2];
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
		echo $row[2] . " : " . $row[1];
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
		echo $row[2] . " : " . $row[1];
		echo "<br/>";
	}
?>
</p>
