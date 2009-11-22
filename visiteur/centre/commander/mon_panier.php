<?php
foreach ($_POST as $key => $value) {
	if($key == "ajax_req"){
		require_once("../../../tools/visitor_panier_functions.php");
		require_once("../../../tools/visitor_bdd_functions.php");
		require_once("../../../tools/config.php");
		ouverture();
	}    
}
?>

<?php
echo "<table border='1' align=center
	style='border-collapse: separate; empty-cells: show;'>";
echo "<tr>";
echo "<td>Produit";
echo "</td>";
echo "<td> Prix unitaire";
echo "</td>";
echo "<td> Quantit&eacute; ";
echo "</td>";
echo "<td> Prix";
echo "</td>";
echo "</tr>";
$tmpres = bddProduitsConditionnesTous();
while ($row = mysql_fetch_array($tmpres)){
	$condId = $row[0];
	$condNom = $row[1];
	$condPrix = $row[2];
	$condQuantiteProduit = $row[3];
	$produitLibelle = $row[4];
	$produitUnite = $row[5];
	$produitPrixUnite = $row[6];
	$produitIdCategorie = $row[7];
	$conNbStock = $row[8];
	$prixUnitaireProduit = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
	$nbarticles = panierNbArticles($condId);
	$prixParProduit = $nbarticles * $prixUnitaireProduit;
		
	echo "<tr>";
	echo "<td>".html_entity_decode($condNom)."[".html_entity_decode($produitLibelle)."]</td>" .
   				 "<td align=right>$prixUnitaireProduit &euro;</td>";

	echo "<td>";
	echo "<SELECT  id='nbarticles_$row[0]' onChange='javascript:clickSetNbArticles($row[0]);'>";
	for($i=0;$i<$conNbStock;$i++){
		if($nbarticles == $i){
			$selected = " SELECTED";
		}else{
			$selected = "";
		}
		echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "</td>";
	echo "<td align=right>$prixParProduit &euro;</td>";
	echo "</tr>";
}
echo "<tr>";
echo "<td colspan=3> Prix total </td>" ;
echo "<td colspan=1>".panierMontantTotal()." &euro;</td>";
echo "</tr>";
echo "</table>";
?>




<!--  <table border="1" align=center style="border-collapse: separate;  empty-cells: show;">
<tr>
	<td colspan="5" align=center>Mon panier</td>
</tr>
<tr>
	<td>Produit</td>
	<td>Quantit&eacute;</td>
	<td>Prix unitaire TTC</td>
	<td>Prix TTC</td>
</tr>
<?php 
//$recap = panierCommande();
//for($i=0;$i<count($recap);$i++){
//	echo "<tr>";
//	for($j=0;$j<count($recap[$i]);$j++){
//		echo "<td>".$recap[$i][$j]."</td>";
//	}
//	echo "</tr>";
//}
?>
<tr>
<td colspan="3" align=right>Total </td>
<td>
<?php /*echo panierMontantTotal();*/ ?> &euro;
</td>
</tr>
</table>
 -->