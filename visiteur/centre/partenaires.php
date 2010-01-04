<?php
	$tmpres = bddPartenaires();
	while ($row = mysql_fetch_array($tmpres)){
		$siteweb = $row[2];
		$target = "target=_blank";
		if ($siteweb==null || strlen($siteweb)==0) {
			$siteweb = "#";
			$target = "";	
		}
		echo "<a href=\"$siteweb\" $target title=\"$row[1]\">". $row[0] ."</a>";
		echo "<br/>";
	}
?>