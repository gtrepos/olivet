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

<table id="recap" cellspacing="0">
  <tbody>
  <tr>
    <th scope="col">Produits</th>
    <th scope="col">Prix unitaire</th>
    <th scope="col">Quantité</th>
	<th scope="col">Prix</th>
  </tr>

<?php
/***
 *Produits conditionnes
 */
$tmpres1 = bddProdsCondDispo();

$nbprod = 0;

while ($row1 = mysql_fetch_array($tmpres1)){
	$categorie_produit_id = $row1[0];
	$categorie_produit_libelle = $row1[1];
	$produit_id = $row1[2];
	$produit_libelle = $row1[3];
	$cond_id = $row1[4];
	$cond_nom = $row1[5];
	$produit_photo = $row1[6];
	$produit_descriptif_production = $row1[7];
	$cond_prix = $row1[8];
	$cond_remise = $row1[9];
	$cond_a_stock = $row1[10];
	$cond_nb_stock = $row1[11];
	$cond_divisible = $row1[12];
	$nbprod++;
	
	if ($nbprod%2 == 1) {
    	$classth = 'specalt';
    	$classtd = 'alt';    	
	} else {
    	$classth = 'spec';
    	$classtd = '';
	}
	
	$quantite_panier = panierQuantiteProdsCond($cond_id);
	if($quantite_panier > 0){

		if($cond_a_stock = 1 ){
			$nbstock = $cond_nb_stock;
		}else{
			$nbstock = 20;
		}
		$prixUnitaireCond = number_format($cond_prix - $cond_remise, 2, '.', '');
		$prixTotalCond = $quantite_panier * $prixUnitaireCond;
		echo "<tr>";
		echo "<th class='$classth'><a href='javascript:clickSelectCatProduit($categorie_produit_id)'>"
		.$produit_libelle."<br>".$cond_nom."</a></td>";
		
		//echo "<td>".$produit_libelle."[".$cond_nom."]</td>";
		echo "<td class='$classtd'> $prixUnitaireCond  &euro;</td>";
		echo "<td class='$classtd'>";
		echo "<input value=$quantite_panier id='qtProd_1_$cond_id' type='text' maxlength='5'
				     onBlur='javascript:if(checkDivisible($cond_divisible, 1, $cond_id)){clickSetQuantite(1,$cond_id);}'/>";

		echo "</td>";
		echo "<td class='$classtd'>". number_format($prixTotalCond, 2, '.', '') . "&euro;</td>";
		echo "</tr>";
	}
	
	
	
}
echo "<tr>";
echo "<th class='spec' colspan=3> Prix total </td>" ;
echo "<td colspan=1>".number_format(panierMontantTotalProdsCond(), 2, '.', '')." &euro;</td>";
echo "</tr>";

?>
</tbody>
</table>

<br>


<table id="recap" cellspacing="0">
  <tbody>
  <tr>
    <th scope="col">Produits sur réservation</th>
    <th scope="col">Description</th>
    <th scope="col">Quantité</th>	
  </tr>

<?php
/***
 * Produits a la reservation
 */

$tmpres2 = bddProdsResaDispo();

$nbresa = 0;

while ($row2 = mysql_fetch_array($tmpres2)){
	$categorie_produit_id =  $row2[0];
	$categorie_produit_libelle =  $row2[1];
	$produit_resa_id =  $row2[2];
	$produit_resa_libelle =  $row2[3];
	$produit_resa_photo =  $row2[4];
	$produit_resa_descriptif_production =  $row2[5];
	$produit_resa_a_stock =  $row2[6];
	$produit_resa_nb_stock =  $row2[7];
	
	if ($nbresa%2 == 1) {
    	$classth = 'specalt';
    	$classtd = 'alt';    	
	} else {
    	$classth = 'spec';
    	$classtd = '';
	}
	

	$quantite_panier = panierQuantiteProdsResa($produit_resa_id);
	if($quantite_panier > 0){
		if($produit_resa_a_stock = 1 ){
			$nbstock = $produit_resa_nb_stock;
		}else{
			$nbstock = 20;
		}
		echo "<tr>";
		echo "<th class='$classth'>$produit_resa_libelle</td>";
		echo "<td class='$classtd'>$produit_resa_descriptif_production</td>";
		echo "<td class='$classtd'>";
		echo "<input value=$quantite_panier id='qtProd_0_$produit_resa_id' type='text' maxlength='5'
			     onBlur='javascript:if(checkDivisible(0, 0, $produit_resa_id)){clickSetQuantite(0,$produit_resa_id);}'/>";
		echo "</td>";
		echo "</tr>";
	}
}

?>
</tbody>
</table>