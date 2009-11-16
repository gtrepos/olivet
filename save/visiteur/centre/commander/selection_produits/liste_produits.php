<table border='1' align=center
	style='border-collapse: separate; empty-cells: show;'>
	<tr>
		<td>Produits</td>
		<td align=right>Conditionnement</td>
		<td>Unité</td>
		<td>Quantité</td>
		<td>Prix unitaire TTC</td>
		<td>Unité</td>
		<td style='border-left: 3px solid #000;'>Prix total TTC</td>
	</tr>
	<?php
	if(isset($ajax_id_cat_prod)){
		$tmpres = bddProduits($ajax_id_cat_prod);
		while ($row = mysql_fetch_array($tmpres)){
			echo "<tr>";
			echo "
   				<td>$row[1]</td><td align=right>TODO</td><td></td><td>$row[2]</td>
   				<td>$row[3] -- TODO</td><td>euros</td><td style='border-left : 3px solid #000;'> </td>";
			$nbarticles = panierNbArticles($row[0]);
			echo"<td>
				<form  onsubmit='return false;'>
				<SELECT  id='nbarticles_$row[0]' onChange='javascript:clickSetNbArticles($row[0]);'>";
			for($i=0;$i<10;$i++){
				if($nbarticles == $i){
					$selected = " SELECTED";
				}else{
					$selected = "";
				}
				echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
			}
			echo "</SELECT></form></td>";
		}
		
	}
	
	?>
</table>