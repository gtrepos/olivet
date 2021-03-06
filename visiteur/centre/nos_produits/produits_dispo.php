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
echo "<h3>Où trouver les produits du GAEC à 3 voix</h3>";
echo html_entity_decode(afficheProduitsGAEC()); 
?>

<h3>Produits actuellement disponibles en magasin</h3>
<p>Vous pouvez consulter et commander nos produits, en cliquant sur une des catégories présentées ci-dessous.</p>
<p>Il vous suffit de saisir une quantité pour alimenter votre panier.</p>
<p>Des produits 'sur réservation' vous seront proposés de manière périodique. Typiquement, les caissettes de viande sont des produits sur réservation. Pour ceux-ci, le GAEC vous informera via son site web de leur date de disponibilté.</p>  

<?php
$globStruc = bddProdsDispo();
echo "<a href=\"javascript:clickNavigation('nos_produits');\">Voir toutes les catégories.</a>";
echo "<ul class='menu_deroulant2'>";
while (list($categorie_produit_id, $catStruct) = each($globStruc)) {
	echo "<li>";
	echo "<a href='javascript:clickMenuProduitsDispo($categorie_produit_id)'>";
	echo $catStruct["categorie_produit_libelle"];
	echo "</a>";
	echo "<div id='MenuProduitsDispoCat$categorie_produit_id' class='categories' open=false>";
	
	//Produits resa
	if(array_key_exists("produits_resa",$catStruct)){
		while (list($produit_resa_id, $prodResaStruct) = each($catStruct["produits_resa"])) {
			$produit_resa_photo = $prodResaStruct["produit_resa_photo"];
			$produit_resa_libelle = $prodResaStruct['produit_resa_libelle'];
			$produit_resa_descriptif_production = $prodResaStruct['produit_resa_descriptif_production'];
			$produit_resa_a_stock= $prodResaStruct['produit_resa_a_stock'];
			$produit_resa_nb_stock= $prodResaStruct['produit_resa_nb_stock'];
			$produit_resa_date_recuperation= $prodResaStruct['produit_resa_date_recuperation'];
			$produit_resa_date_limite_recuperation= $prodResaStruct['produit_resa_date_limite_recuperation'];
			$produit_resa_date_limite_commande= $prodResaStruct['produit_resa_date_limite_commande'];
			$produit_resa_producteur= $prodResaStruct['produit_resa_producteur'];
			
			$libelle = $produit_resa_libelle;
			if ($produit_resa_producteur!=null) {
				$libelle = $libelle . " : " . $produit_resa_producteur;
			}

			echo "<div class='MenuProduitsDispoProd$categorie_produit_id products'>";
			echo "<table style='border: 1px solid #F40707; margin-bottom:1em;' width=100% height='200'>";
			echo "<tr>";
			echo "<td rowspan=6 width='200px;' align='center'>";
			echo "<img src='img/upload/$produit_resa_photo' alt=\"$libelle\" title=\"$libelle\"/>";
			echo "</td>";
			echo "<td align=center valign = 'middle'>";
			echo "$libelle";
			if ($produit_resa_descriptif_production!=null) {
				echo "<br>$produit_resa_descriptif_production";
			}
			echo "<br><b>Sur réservation uniquement</b>";
			echo "<br>Date limite de commande : $produit_resa_date_limite_commande inclu";
			echo "<br>Dates de retrait en magasin : du $produit_resa_date_recuperation <br>au $produit_resa_date_limite_recuperation inclu";
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
	
	//produits conditionnés
	if(array_key_exists("produits_cond",$catStruct)){
		while (list($produit_id, $prodStruct) = each($catStruct["produits_cond"])) {
			$produit_photo = $prodStruct["produit_photo"];
			$produit_libelle = $prodStruct['produit_libelle'];
			$produit_descriptif_production = $prodStruct['produit_descriptif_production'];
			$produit_jours_dispos = $prodStruct['produit_jours_dispos'];
			$produit_producteur = $prodStruct['produit_producteur'];
			
			$libelle = $produit_libelle;
			if ($produit_producteur!=null) {
				$libelle = $libelle . " : " . $produit_producteur;
			}
			
			echo "<div class='MenuProduitsDispoProd$categorie_produit_id products'>";
			echo "<table style='border: 1px solid #F40707; margin-bottom:1em;' width=100% height='200'>";
			echo "<tr>";
			echo "<td rowspan=6 width='200px;' align='center'>";
			echo "<img src='img/upload/$produit_photo' alt=\"$libelle\" title=\"$libelle\"/>";
			echo "</td>";
			echo "<td valign = 'middle' align=center>";
			echo "$libelle";
			if ($produit_descriptif_production!=null) {
				echo "<br>$produit_descriptif_production";
			}
			$dispo = afficheJoursDispos($produit_jours_dispos);
			if ($dispo!="") {
			echo "<br>Disponibilité : ".afficheJoursDispos($produit_jours_dispos);
			}
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
	
	echo "</div>";
	echo "</li>";
}
echo "</ul>";
