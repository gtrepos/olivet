<form name="creer_categorie" action='index.php?page=categories&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Cr�ation d'une nouvelle cat�gorie de produits</tr>
			<tr><td colspan="2">&nbsp;<input type='hidden' id='id' name='id'/></tr>
			<tr><td>Libell� : </td><td><input type='text' id='libelle' name='libelle'/></td></tr>
		</table>
	</div>
	<br>
	<input type="reset">
	<input type="submit" onclick="javascript:checkCategorie()">
</form>



 
