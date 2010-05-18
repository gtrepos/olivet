<?php 
$tmpres = bddActusGaec(false, true);
if (mysql_num_rows($tmpres)>0) {
	setlocale (LC_TIME, 'fr_FR','fra');
	$outputAffDatePost = "%A %d %B %Y";
	echo "<h3>Actualités du GAEC :</h3>";
	echo "<p>";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<b>".$row[1]."</b> (postée le " . utf8_encode(strftime($outputAffDatePost,strtotime($row[2]))) . ")";
		echo "<br/>";
		echo "<div class='encadreActu'>".nl2br($row[4])."</div>";
		echo "<br/>";
	}
	echo "</p>";
}

$tmpres = bddActusLoma(false, true);
if (mysql_num_rows($tmpres)>0) {
	setlocale (LC_TIME, 'fr_FR','fra');
	$outputAffDatePost = "%A %d %B %Y";	
	echo "<h3>Actualités locales et du monde agricole :</h3>";
	echo "<p>";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<b>".$row[1]."</b> (postée le ". utf8_encode(strftime($outputAffDatePost,strtotime($row[2]))) .")";
		echo "<br/>";
		echo "<div class='encadreActu'>".nl2br($row[4])."</div>";
		echo "<br/>";
	}
	echo "</p>";
}
?>
