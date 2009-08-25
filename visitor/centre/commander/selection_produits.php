<div>
<table>
	<tr align=center>
	<?php 
		$tmpres = bddCategorieMenu();
		while ($row = mysql_fetch_array($tmpres)){
			echo "<td><a href=\"index.php?page=commander&page_comm=$row[0]\">";
			echo "$row[1]";
			echo "</td>";
		}
	?>
	</tr>
</table>
</div>

<div>
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
	$tmpres = bddProduits($page_comm);
	while ($row = mysql_fetch_array($tmpres)){
		echo "<tr>";
		echo "
   		<td>$row[1]</td><td align=right>TODO</td><td></td><td>$row[2]</td>
   		<td>$row[3] -- TODO</td><td>euros</td><td style='border-left : 3px solid #000;'> </td>";
		$nbarticles = panierNbArticles($row[0]);
		echo"<td>
		<form  onsubmit='return false;'>
			<SELECT  id='nbarticles_$row[0]' onChange='javascript:setNbArticles($row[0]);'>";
		for($i=0;$i<10;$i++){
			if($nbarticles == $i){
				$selected = " SELECTED";
			}else{
				$selected = "";
			}
			echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
		}	
		
				
		echo "</SELECT>	
		</form></td>";
	}
	?>
</table>
</div>

<td><a href='index.php?page=commander&page_comm=valid1'>Valider Commande</td>
		