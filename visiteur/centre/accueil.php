<h2>Nouveaux produits : </h2>

<p>
<?php
	$tmpres = bddNouveauxProduits();
	while ($row = mysql_fetch_array($tmpres)){
		echo "$row[2] [$row[3]] : $row[4]";
		echo "<br/>";
	}
?>
</p>

<h2>Actualités du GAEC :</h2>
<p>
<?php 
	$tmpres = bddActusGaec();	
	while ($row = mysql_fetch_array($tmpres)){
		echo htmlentities("$row[1] : $row[2]");
		echo "<br/>";
	}
?>
</p>
	
<h2>Actualités locales et du monde agricole :</h2>
<p>
<?php 
	$tmpres = bddActusLoma();
	while ($row = mysql_fetch_array($tmpres)){
		echo htmlentities("$row[1]: $row[2]");
		echo "<br/>";
	}
?>
</p>
