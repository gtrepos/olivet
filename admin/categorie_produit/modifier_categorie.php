<form name="form_categorie" action='index.php?page=categories&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkCategorie);">
<?php
$id = $_GET['id'];
affich_modif_categorie($id);
?>
<br>
<input type="button" name="Enregistrer" title="Enregistrer" value="Enregistrer" onclick="javascript:checkCategorie()">
</form>
