<div>
<table>
	<tr align=center>
	<?php 
		$tmpres = bddCategorieMenu();
		while ($row = mysql_fetch_array($tmpres)){
			echo "<td>";
			echo "<input type='button' value='".htmlentities($row[1])."' onclick='clickCategorieProduits($row[0]);'/>";
			echo "</td>";
		}
	?>
	</tr>
</table>
</div>


<div id='selection_produits-liste_produits'>
<?php include("selection_produits/liste_produits.php");?>
</div>


<input type='button' value='Voir la commande' onclick='clickVoirCommande();'/>

		