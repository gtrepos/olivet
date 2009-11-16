<form name="modifier_actualite" action='index.php?page=actualites&action=enregistrer&mode=modification' method="post">
<?php
$id = $_GET['id'];
affich_modif_actu($id);
?>
<br>
<input type="submit" onclick="javascript:checkActu()">
</form>
