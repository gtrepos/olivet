<form name="form_categorie" action='index.php?page=categories&action=enregistrer&mode=creation' 
	  method="post" onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkCategorie);">
	<div style='position:relative;'>
		<table>
			<tr><td colspan="2">Cr�ation d'une nouvelle cat�gorie de produits</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/></tr>
			<tr><td>Libell� : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="button" name="Enregistrer" title="Enregistrer" value="Enregistrer" onclick="javascript:checkCategorie()">
</form>



 
