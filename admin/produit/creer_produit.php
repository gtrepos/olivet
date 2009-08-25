<form name="creer_produit" action='index.php?page=produits&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau produit</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/></tr>
			<tr><td>Catégorie : </td><td><?php liste_categories('-1',false);?></td></tr> 
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
			<tr><td>Afficher en tant que nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute'/></td></tr>
			<tr><td valign="top">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr><td>Unité (kg ? litre ?) : </td><td><input type='text' id='unite' name='unite'/></td></tr>
			<tr><td>Prix à l'unité : </td><td><input type='text' id='prix_unite' name='prix_unite'/> €</td></tr>
			<tr><td>Conditionnement ? </td><td><input type='checkbox' id='conditionnement' name='conditionnement' onclick="selectionneConditionnement()"/></td></tr>
			<tr id="tr_conditionnement_nom" style="display: none;"><td>Nom du conditionnement : </td><td><input type='text' id='cond_nom' name='cond_nom'/></td></tr>
			<tr id="tr_conditionnement_fixe" style="display: none;">
				<td>Conditionnement de taille fixe : </td>
				<td><input type='checkbox' id='cond_fixe' name='cond_fixe' disabled="disabled" onclick="selectionneConditionnementFixe()"/> Précisez la taille : <input type='text' id='cond_taille' name='cond_taille' disabled="disabled"/> unités</td>
			</tr>
			<tr id="tr_conditionnement_variable" style="display: none;">
				<td>Conditionnement de taille variable : </td>
				<td><input type='checkbox' id='cond_variable' name='cond_variable' disabled="disabled" onclick="selectionneConditionnementVariable()"/> Précisez la taille : de <input type='text' id='cond_taille_inf' name='cond_taille_inf' disabled="disabled"/> unités à <input type='text' id='cond_taille_sup' name='cond_taille_sup' disabled="disabled"/> unités</td>
			</tr>			
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="submit" onclick="javascript:checkProduit()">
</form>