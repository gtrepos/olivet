<form name="form_conditionnement" action='index.php?page=conditionnements&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;">
<?php
$id = $_GET['id'];
affich_modif_conditionnement($id);
?>
<br>
<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=conditionnements'">
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkConditionnement()">
</form>