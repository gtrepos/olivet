<form name="form_conditionnement" action='index.php?page=conditionnements&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkConditionnement);">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau conditionnement</tr>
			<tr><td colspan="2">&nbsp;</tr>
			<tr><td>Produit : </td><td><?php affiche_produits_pour_selection('-1',false, null);?></td></tr> 
			<tr><td>Nom du conditionnement : </td><td><input type='text' id='nom' name='nom'/></td></tr>
			<tr><td>Stock : </td><td><input type="checkbox" id="is_stock" name="is_stock" onclick="selectionneStock()"/> : <input type='text' id='nb_stock' name='nb_stock' readonly="readonly"/></td></tr>
			<tr><td>Afficher en tant que nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute'/></td></tr>
			<tr><td>Prix du conditionnement : </td><td><input type='text' id='prix_cond' name='prix_cond'/> € (Exemple : 1.50)</td></tr>
			<tr><td>Quantite de produit : </td><td><input type='text' id='quantite_produit' name='quantite_produit'/></td></tr>
			<tr><td>Nom photo : </td><td><input type='text' id='lien_photo' name='lien_photo'/></td></tr>
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkConditionnement()">
</form>