<form name="form_client" action='index.php?page=clients&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkClient);">
<?php
$ref = $_GET['ref'];
affich_modif_client($ref);
?>
<br>
<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=clients'">
<input type="button" name="Enregistrer" title="Enregistrer" value="Enregistrer" onclick="javascript:checkClient()">
</form>
