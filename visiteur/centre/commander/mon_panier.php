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
$tmpres1 = bddProdsCondDispo();
while ($row1 = mysql_fetch_array($tmpres1)){
	$categorie_produit_id = $row1[0];
	$categorie_produit_libelle = $row1[1];
	$produit_id = $row1[2];
	$produit_libelle = $row1[3];
	$cond_id = $row1[4];
	$cond_nom = $row1[5];
	$produit_photo = $row1[6];
	$produit_descriptif_production = $row1[7];
	$produit_unite = $row1[8];
	$produit_prix_unite = $row1[9];
	$cond_prix = $row1[10];
	$cond_quantite_produit = $row1[11];
	$cond_a_stock = $row1[12];
	$cond_nb_stock = $row1[13];

	$nbarticles_panier = panierNbArticlesProdsCond($cond_id);
	if($nbarticles_panier > 0){

		if($cond_a_stock = 1 ){
			$nbstock = $cond_nb_stock;
		}else{
			$nbstock = 20;
		}
		$prixUnitaireCond = $cond_prix + ($cond_quantite_produit + $produit_prix_unite);
		$prixTotalCond = $nbarticles_panier * $prixUnitaireCond;


		echo "<tr>";
		echo "<td>".$cond_nom."[".$produit_libelle."]</td>";
		echo "<td align=right> $prixUnitaireCond  &euro;</td>";

		echo "<td>";
		echo "<SELECT  id='nbarticles_1_$cond_id' onChange='javascript:clickSetNbArticles(1,$cond_id);'>";
		for($i=0;$i<$cond_nb_stock ;$i++){
			if($nbarticles_panier == $i){
				$selected = " SELECTED";
			}else{
				$selected = "";
			}
			echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
		}
		echo "</SELECT>";
		echo "</td>";
		echo "<td align=right>$prixTotalCond &euro;</td>";
		echo "</tr>";
	}
}
echo "<tr>";
echo "<td colspan=3> Prix total </td>" ;
echo "<td colspan=1>".panierMontantTotalProdsCond()." &euro;</td>";
echo "</tr>";
echo "</table>";
?>


<?php

/** Produits à la réservation **/
?>

