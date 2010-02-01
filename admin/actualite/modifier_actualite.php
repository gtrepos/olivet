<form name="form_actualite" action='index.php?page=actualites&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;">
<?php
$id = $_GET['id'];
affich_modif_actu($id);
?>
<br>
<input type="button" name="Enregistrer" title="Enregistrer" value="Enregistrer" onclick="javascript:checkActu()">
</form>
