<?php
	$tmpres = bddPartenaires();	
	if (mysql_num_rows($tmpres)>0) {
		echo "<h3>Partenaires</h3>";
		while ($row = mysql_fetch_array($tmpres)){
			$siteweb = $row[2];
			$logo = $row[3];
			$target = "target=_blank";
			if ($siteweb==null || strlen($siteweb)==0) {
				$siteweb = "#";
				$target = "";
			}
			echo "<p>";
			echo "<a href=\"$siteweb\" $target title=\"$row[1]\">". $row[0] ."</a>";
			if ($logo!=null && strlen($logo)>0) {
				echo "<div>";	
				echo "<img src='img/upload/$logo' width=50 height=50/>";
				echo "</div>";
			}
			echo "</p>";
		}
	}
?>