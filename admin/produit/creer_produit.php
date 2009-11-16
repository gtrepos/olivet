<form name="form_produit" action='index.php?page=produits&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkProduit);">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau produit</tr>
			<tr><td colspan="2">&nbsp;</tr>
			<tr><td>Catégorie : </td><td><?php liste_categories('-1',false);?></td></tr> 
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
			<tr><td valign="top">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr><td>Unité (kg ? litre ?) : </td><td><input type='text' id='unite' name='unite'/></td></tr>
			<tr><td>Prix à l'unité : </td><td><input type='text' id='prix_unite' name='prix_unite'/> € (Exemple : 1.50)</td></tr>
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkProduit()">
</form>