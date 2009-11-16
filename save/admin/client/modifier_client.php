<form name="modifier_client" action='index.php?page=clients&action=enregistrer&mode=modification' method="post">
<?php
$ref = $_GET['ref'];
affich_modif_client($ref);
?>
<br>
<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=clients'">
<input type="submit" onclick="javascript:checkClient()">
</form>
