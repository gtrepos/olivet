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
//panierPlot() 
?>

<?php
$globStruc = bddProdsDispo();
echo "<h3>Produits actuellement disponibles</h3>";
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
			$produit_unite = $prodStruct['produit_unite'];
			$produit_prix_unite = $prodStruct['produit_prix_unite'];
			echo "<div class='MenuProduitsDispoProd$categorie_produit_id products'>";
			echo "<table border='1' style='border-collapse: separate; empty-cells: show;'>";
			echo "<tr>";
			echo "<td rowspan=6>";
			echo "<img src='img/upload/$produit_photo' alt='texte alternatif' width='200' height='200'/>";
			echo "</td>";
			echo "<td valign = 'middle'>";
			echo "$produit_libelle : $produit_descriptif_production ";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "<table border='1' style='border-collapse: separate; empty-cells: show;'>";
			while (list($cond_id, $condStruct) = each($prodStruct["conditionnements"])) {
				$cond_nom = $condStruct["cond_nom"];
				$cond_quantite_produit = $condStruct["cond_quantite_produit"];
				$cond_prix = $condStruct["cond_prix"];
				$cond_a_stock = $condStruct["cond_a_stock"];
				$cond_nb_stock = $condStruct["cond_nb_stock"];
				$quantite_panier = panierQuantiteProdsCond($cond_id);
				if($cond_a_stock = 1 ){
					$nbstock = $cond_nb_stock;
				}else{
					$nbstock = 20;
				}
				echo "<tr>";
				echo "<td>";
				echo $cond_nom;
				echo "</td>";
				echo "<td>";
				echo $cond_quantite_produit." ".$produit_unite ;
				echo "</td>";
				echo "<td>";
				echo ($cond_prix + ($cond_quantite_produit + $produit_prix_unite))." &euro;" ;
				echo "</td>";
				echo "<td>";
				echo "<input value=$quantite_panier id='qtProd_1_$cond_id' type='text' maxlength='5'
				     onBlur='javascript:clickSetQuantite(1,$cond_id);'/>";
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
			echo "<table border='1' style='border-collapse: separate; empty-cells: show;'>";
			echo "<tr>";
			echo "<td rowspan=6>";
			echo "<img src='img/upload/$produit_resa_photo' alt='texte alternatif' width='200' height='200'/>";
			echo "</td>";
			echo "<td valign = 'middle'>";
			echo "$produit_resa_libelle : $produit_resa_descriptif_production."." A la réservation uniquement..";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "<table border='1' style='border-collapse: separate; empty-cells: show;'>";

			$quantite_panier = panierQuantiteProdsResa($produit_resa_id);
			if($produit_resa_a_stock = 1 ){
				$nbstock = $produit_resa_nb_stock;
			}else{
				$nbstock = 20;
			}
			echo "<tr>";
			echo "<td>";
				
			echo "<input value=$quantite_panier id='qtProd_0_$produit_resa_id' type='text' maxlength='5'
			     onBlur='javascript:clickSetQuantite(0,$produit_resa_id);'/>";
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
