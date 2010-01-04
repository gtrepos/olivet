<form name="form_client" action='index.php?page=clients&action=enregistrer&mode=creation' method="post" 
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkClient);">
	<div style='position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau client</tr>
			<tr><td colspan="2">&nbsp;</tr>
			<tr><td>Nom : </td><td><input type='text' id='nom' name='nom' size="30"/></td></tr>
			<tr><td>Prénom : </td><td><input type='text' id='prenom' name='prenom' size="30"/></td></tr>
			<tr><td valign="top">Adresse : </td><td><textarea id='adresse' name='adresse' cols="25"></textarea></td></tr>
			<tr><td>Code postal : </td><td><input type='text' id='cp' name='cp' size="30"/></td></tr>
			<tr><td>Commune : </td><td><input type='text' id='commune' name='commune' size="30"/></td></tr>
			<tr><td>N° Téléphone : </td><td><input type='text' id='tel' name='tel' size="30"/></td></tr>
			<tr><td>Email : </td><td><input type='text' id='email' name='email' size="30"/></td></tr>
		</table>
	</div>
	<br>
	<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=clients'">
	<input type="reset">
	<input type="button" name="Enregistrer" title="Enregistrer" value="Enregistrer" onclick="javascript:checkClient()">
</form>



 
