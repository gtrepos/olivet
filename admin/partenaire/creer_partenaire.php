<form name="form_partenaire" action='index.php?page=partenaires&action=enregistrer&mode=creation' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkPartenaire);">
	<div style='position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau partenaire</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/></tr>
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
			<tr><td valign="top">Descriptif du partenaire : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr><td>Rang : </td><td><input type='text' id='rang' name='rang'/></td></tr>
			<tr><td>Site web : </td><td><input type='text' id='siteweb' name='siteweb'/></td></tr>			
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkPartenaire()">
</form>



 
