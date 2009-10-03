<form name="form_partenaire" action='index.php?page=partenaires&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkPartenaire);">
<?php
$id = $_GET['id'];
affich_modif_partenaire($id);
?>
<br>
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkPartenaire()">
</form>
