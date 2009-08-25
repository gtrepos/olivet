<form name="creer_client" action='index.php?page=clients&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'un nouveau client</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='ref' name='ref'/></tr>
			<tr><td>Nom : </td><td><input type='text' id='nom' name='nom'/></td></tr>
			<tr><td>Prénom : </td><td><input type='text' id='prenom' name='prenom'/></td></tr>
			<tr><td valign="top">Adresse : </td><td><textarea id='adresse' name='adresse'></textarea></td></tr>
			<tr><td>Code postal : </td><td><input type='text' id='cp' name='cp'/></td></tr>
			<tr><td>Commune : </td><td><input type='text' id='commune' name='commune'/></td></tr>
			<tr><td>N° Téléphone : </td><td><input type='text' id='tel' name='tel'/></td></tr>
			<tr><td>Email : </td><td><input type='text' id='email' name='email'/></td></tr>
		</table>
	</div>
	<br>
	<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=clients'">
	<input type="reset">
	<input type="submit" onclick="javascript:checkClient()">
</form>



 
