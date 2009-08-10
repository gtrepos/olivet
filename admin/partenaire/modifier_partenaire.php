<form name="modifier_partenaire" action='index.php?page=partenaires&action=enregistrer&mode=modification' method="post">
<?php
$id = $_GET['id'];
affich_modif_partenaire($id);
?>
<br>
<input type="submit" onclick="javascript:checkPartenaire()">
</form>
