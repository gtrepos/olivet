<form name="creer_produit" action='index.php?page=produits&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Cr�ation d'un nouveau produit</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/></tr>
			<tr><td>Cat�gorie : </td><td><?php liste_categories('-1',false);?></td></tr> 
			<tr><td>Libell� : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
			<tr><td valign="top">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr><td>Conditionnement : </td><td><input type='text' id='conditionnement' name='conditionnement'/></td></tr>
			<tr><td>Unit� : </td><td><input type='text' id='unite' name='unite'/></td></tr>
			<tr><td>Prix : </td><td><input type='text' id='prix' name='prix'/></td></tr>
			<tr><td>Nouveaut� ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute'/></td></tr>
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="submit" onclick="javascript:checkProduit()">
</form>



 
