<?php
foreach ($_POST as $key => $value) {
	if($key == "ajax_req"){
		require_once("../../../tools/visitor_panier_functions.php");
		require_once("../../../tools/visitor_bdd_functions.php");
		require_once("../../../tools/config.php");
		ouverture();
		session_start();
	}    
}
?>


<table border="1" align=center style="border-collapse: separate;  empty-cells: show;">
<tr>
	<td colspan="5" align=center>Mon panier</td>
</tr>
<tr>
	<td>Nom Produit</td>
	<td>Quantit&eacute;</td>
	<td>Unit&eacute;</td>
	<td>Prix unitaire TTC</td>
	<td>Prix TTC</td>
</tr>
<?php 
$recap = panierCommande();
for($i=0;$i<count($recap);$i++){
	echo "<tr>";
	for($j=0;$j<count($recap[$i]);$j++){
		echo "<td>".$recap[$i][$j]."</td>";
	}
	echo "</tr>";
}
?>
<tr>
<td colspan="4" align=right>Total </td>
<td>
<?php 
echo panierMontantTotal();
?>
</td>
</tr>
</table>
