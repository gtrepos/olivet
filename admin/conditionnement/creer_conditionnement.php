<form name="form_conditionnement" action='index.php?page=conditionnements&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;">
	<div style='position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau conditionnement</tr>
			<tr><td colspan="2">&nbsp;</tr>
			<tr><td>Produit : </td><td><?php affiche_produits_pour_selection('-1',false, null);?></td></tr> 
			<tr><td>Nom du conditionnement : </td><td><input type='text' id='nom' name='nom'/></td></tr>
			<tr><td>Stock : </td><td><input type="checkbox" id="a_stock" name="a_stock" onclick="selectionneStock()"/> : <input type='text' id='nb_stock' name='nb_stock' readonly="readonly"/></td></tr>
			<tr><td>Afficher en tant que nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute'/></td></tr>
			<tr><td>Divisble ? </td><td><input type='checkbox' id='divisible' name='divisible'/></td></tr>
			<tr><td>Prix vente TTC : </td><td><input type='text' id='prix_cond' name='prix_cond'/> &euro; (Exemple : 1.50)</td></tr>
			<tr><td>Remise : </td><td><input type='text' id='remise' name='remise'/> &euro; (Exemple : 0.20)</td></tr>
			<tr><td>TVA : </td><td><?php affiche_tva('5.50'); ?></td></tr>
		</table>
	</div>
	<br>
	<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=conditionnements'">
	<input type="reset">
	<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkConditionnement()">
</form>
