<h3>Actualit�s du GAEC :</h3>
<p>
<?php 
	$tmpres = bddActusGaec(false, true);	
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<b>".htmlentities($row[1])."</b> (post�e le $row[2])";
		echo "<br/>";
		echo "<div style='border:1px solid #D7DCD2;margin:10px 20px;padding:1px;'>".htmlentities($row[4])."</div>";
		echo "<br/>";
	}
?>
</p>
	
<h3>Actualit�s locales et du monde agricole :</h3>
<p>
<?php 
	$tmpres = bddActusLoma(false, true);
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo htmlentities("$row[2]: $row[1]");
		echo "<br/>";
		echo "<div style='border:1px solid #D7DCD2;margin:10px 20px;padding:1px;'>".htmlentities($row[4])."</div>";
		echo "<br/>";
	}
?>
</p>
