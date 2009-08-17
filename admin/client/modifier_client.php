<form name="modifier_commande" action='index.php?page=commandes&action=enregistrer&mode=modification' method="post">
<?php
$id = $_GET['id'];
affich_modif_commande($id);
?>
<br>
<input type="submit" onclick="javascript:checkCommande()">
</form>
