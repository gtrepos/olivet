<form name="form_produit" action='index.php?page=produits&action=enregistrer&mode=modification' method="post"
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkProduit);">
<?php
$id = $_GET['id'];
affich_modif_produit($id);
?>
<br>
<input type="button" name="Enregistrer" value="Enregistrer" title="Enregistrer" onclick="javascript:checkProduit()">
</form>
