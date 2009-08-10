<form name="modifier_categorie" action='index.php?page=categories&action=enregistrer&mode=modification' method="post">
<?php
$id = $_GET['id'];
affich_modif_categorie($id);
?>
<br>
<input type="submit"  onclick="javascript:checkCategorie()">
</form>
