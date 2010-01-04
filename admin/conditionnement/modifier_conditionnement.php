<form name="form_conditionnement" action='index.php?page=conditionnements&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkConditionnement);">
<?php
$id = $_GET['id'];
affich_modif_conditionnement($id);
?>
<br>
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkConditionnement()">
</form>