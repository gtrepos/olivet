<?php
foreach ($_POST as $key => $value) {
	if($key == "ajax_req"){
		require_once("../../../tools/visitor_panier_functions.php");
		require_once("../../../tools/visitor_bdd_functions.php");
		require_once("../../../tools/config.php");
		ouverture();
	}
}
?><?php//panierPlot()?>
<h3>Nos produits</h3>
<p>Vous pouvez consulter et commander nos produits, en cliquant sur une des catégorie présentées ci-dessous.</p>
<p>Des produits 'sur réservation' vous seront proposés de manière périodique. Typiquement, les caissettes de viande sont des produits sur réservation. Pour ceux-ci, le GAEC vous informera de leur date de disponibilté directement par mail.</p>  

<?php
$globStruc = bddProdsDispo();
echo "<h3>Produits actuellement disponibles</h3><a href=\"javascript:clickNavigation('nos_produits');\">Voir toutes les catégories.</a>";
echo "<ul class='menu_deroulant2'>";
while (list($categorie_produit_id, $catStruct) = each($globStruc)) {
	echo "<li>";
	echo "<a href='javascript:clickMenuProduitsDispo($categorie_produit_id)'>";
	echo $catStruct["categorie_produit_libelle"];
	echo "</a>";
	echo "<div id='MenuProduitsDispoCat$categorie_produit_id' class='categories' open=false>";
	//produits conditionnés
	if(array_key_exists("produits_cond",$catStruct)){
		while (list($produit_id, $prodStruct) = each($catStruct["produits_cond"])) {
			$produit_photo = $prodStruct["produit_photo"];
			$produit_libelle = $prodStruct['produit_libelle'];
			$produit_descriptif_production = $prodStruct['produit_descriptif_production'];
			echo "<div class='MenuProduitsDispoProd$categorie_produit_id products'>";
			echo "<table style='border: 1px solid #F40707; margin-bottom:1em;' width=100% height='200'>";
			echo "<tr>";
			echo "<td rowspan=6 width='200px;'>";
			echo "<img src='img/upload/$produit_photo' alt='texte alternatif' width='200' height='200'/>";
			echo "</td>";
			echo "<td valign = 'middle' align=center>";
			echo "$produit_libelle : $produit_descriptif_production ";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "<table align=center CELLPADDING=10px CELLSPACING=10px>";
			while (list($cond_id, $condStruct) = each($prodStruct["conditionnements"])) {
				$cond_nom = $condStruct["cond_nom"];
				$cond_prix = $condStruct["cond_prix"];
				$cond_remise = $condStruct["cond_remise"];
				$cond_a_stock = $condStruct["cond_a_stock"];
				$cond_nb_stock = $condStruct["cond_nb_stock"];
				$cond_divisible = $condStruct["cond_divisible"];
				$quantite_panier = panierQuantiteProdsCond($cond_id);
				if($cond_a_stock = 1 ){
					$nbstock = $cond_nb_stock;
				}else{
					$nbstock = 20;
				}
				echo "<tr>";
				echo "<td style='border: 1px solid #CCFF99;'>";
				echo $cond_nom ."<br>";
				echo "prix : " . number_format($cond_prix - $cond_remise, 2, '.', '')." &euro;<br>" ;
				echo "quantité : <input value=$quantite_panier id='qtProd_1_$cond_id' type='text' maxlength='5'
				     onBlur='javascript:if(checkDivisible($cond_divisible, 1, $cond_id)){clickSetQuantite(1,$cond_id,0);}'/>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
		}
	}

	//Produits resa
	if(array_key_exists("produits_resa",$catStruct)){
		while (list($produit_resa_id, $prodResaStruct) = each($catStruct["produits_resa"])) {
			$produit_resa_photo = $prodResaStruct["produit_resa_photo"];
			$produit_resa_libelle = $prodResaStruct['produit_resa_libelle'];
			$produit_resa_descriptif_production = $prodResaStruct['produit_resa_descriptif_production'];
			$produit_resa_a_stock= $prodResaStruct['produit_resa_a_stock'];
			$produit_resa_nb_stock= $prodResaStruct['produit_resa_nb_stock'];

			echo "<div class='MenuProduitsDispoProd$categorie_produit_id products'>";
			echo "<table style='border: 1px solid #F40707; margin-bottom:1em;' width=100% height='200'>";
			echo "<tr>";
			echo "<td rowspan=6 width='200px;'>";
			echo "<img src='img/upload/$produit_resa_photo' alt='GAEC Olivet' width='200' height='200'/>";
			echo "</td>";
			echo "<td align=center valign = 'middle'>";
			echo "$produit_resa_libelle : $produit_resa_descriptif_production."."<br><b>Sur réservation uniquement</b>";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "<table align=center CELLPADDING=10px CELLSPACING=10px'>";

			$quantite_panier = panierQuantiteProdsResa($produit_resa_id);
			if($produit_resa_a_stock = 1 ){
				$nbstock = $produit_resa_nb_stock;
			}else{
				$nbstock = 20;
			}
			echo "<tr>";
			echo "<td>";
										
			echo "quantité : <input value=$quantite_panier id='qtProd_0_$produit_resa_id' type='text' maxlength='5'
			     onBlur='javascript:if(checkDivisible(0, 0, $produit_resa_id)){clickSetQuantite(0,$produit_resa_id,0);}'/>";
			echo "</td>";
			echo "</tr>";

			echo "</table>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
		}
	}
	echo "</div>";
	echo "</li>";
}
echo "</ul>";
