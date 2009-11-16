<table border='1' align=center
	style='border-collapse: separate; empty-cells: show;'>
	<tr>
		<td>Produits</td>
		<td>Prix unitaire TTC</td>
		<td>Nombre</td>
		<td style='border-left: 3px solid #000;'>Prix total TTC</td>
		
	</tr>
	<?php
	if(isset($ajax_id_cat_prod)){
		$tmpres = bddProduitsConditionnes($ajax_id_cat_prod);
		while ($row = mysql_fetch_array($tmpres)){
			$condId = $row[0];
			$condNom = $row[1];
			$condPrix = $row[2];
			$condQuantiteProduit = $row[3];
			$produitLibelle = $row[4];
			$produitUnite = $row[5];
			$produitPrixUnite = $row[6];
			$produitIdCategorie = $row[7];
			$prixUnitaireProduit = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
			$nbarticles = panierNbArticles($condId);
			$prixParProduit = $nbarticles * $prixUnitaireProduit;
			
						
			echo "<tr>";
			echo "<td>$condNom [$produitLibelle]</td>" .
   				 "<td align=right>$prixUnitaireProduit &euro;</td>";
   			
			echo "<td>" .
				 "<SELECT  id='nbarticles_$row[0]' onChange='javascript:clickSetNbArticles($row[0]);'>";
				 for($i=0;$i<10;$i++){
				 	if($nbarticles == $i){
						$selected = " SELECTED";
					}else{
						$selected = "";
					}
					echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
				 }
			echo "</SELECT></td>";	   				 
   			echo "<td align=right>$prixParProduit &euro;</td>";
   			echo "</tr>";
			
			
		}
		
	}
	
	?>
</table>