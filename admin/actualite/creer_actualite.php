<form name="creer_actualite" action='index.php?page=actualites&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'une nouvelle actualité<td></tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/><td></tr>
			<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
			<tr><td valign="top">Descriptif : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'></textarea></td></tr>
			<tr><td>Type : </td><td><?php liste_type_actualite('-1');?></td></tr>
			<tr><td>Nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute'/></td></tr>	
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="submit" onclick="javascript:checkActu()">
</form>



 
