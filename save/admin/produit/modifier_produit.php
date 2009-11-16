<form name="modifier_client" action='index.php?page=produits&action=enregistrer&mode=modification' method="post">
<?php
$id = $_GET['id'];
affich_modif_produit($id);
?>
<br>
<input type="submit" onclick="javascript:checkProduit()">
</form>
