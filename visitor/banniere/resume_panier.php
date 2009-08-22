
<?php
foreach ($_POST as $key => $value) {
	if($key == "ajax_req"){
		require_once("../../tools/visitor_panier_functions.php");
		require_once("../../tools/visitor_bdd_functions.php");
		require_once("../../tools/config.php");
		ouverture();
		session_start();
	}    
}
?>

<table>
<tr>
<td>
Mon panier
</td>
</tr>
<tr>
<td>
nombre de produits = <?php  echo panierNbProduits()?>
</td>
</tr>
<tr>
<td>
montant TTC = <?php  echo panierMontantTotal()?>
</td>
</tr>
</table>
