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

$globStruc = bddProdsDispo();


echo "<h3>Produits conditionnés actuellement disponibles</h3>";
echo "<ul class='menu_deroulant2'>";
while (list($categorie_produit_id, $catStruct) = each($globStruc)) {
	echo "<li>";
	echo "<a href='javascript:clickMenuProditsDispo($categorie_produit_id)'>";
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




/*
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

 $globStruc[$categorie_produit_id]["categorie_produit_libelle"] = $categorie_produit_libelle;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["produit_libelle"] = $produit_libelle;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["produit_photo"] = $produit_photo;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["produit_unite"] = $produit_unite;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["produit_prix_unite"] = $produit_prix_unite;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["produit_descriptif_production"] = $produit_descriptif_production;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["conditionnements"][$cond_id]["cond_nom"] = $cond_nom;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["conditionnements"][$cond_id]["cond_prix"] = $cond_prix;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["conditionnements"][$cond_id]["cond_quantite_produit"] = $cond_quantite_produit;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["conditionnements"][$cond_id]["cond_a_stock"] = $cond_a_stock;
 $globStruc[$categorie_produit_id]["produits"][$produit_id]["conditionnements"][$cond_id]["cond_nb_stock"] = $cond_nb_stock;


 }


 echo "<h3>Produits conditionnés actuellement disponibles</h3>";
 echo "<ul class='menu_deroulant2'>";
 while (list($categorie_produit_id, $catStruct) = each($globStruc)) {
 echo "<li>";
 echo "<a href='javascript:clickMenuProditsDispo($categorie_produit_id)'>";
 echo $catStruct["categorie_produit_libelle"];
 echo "</a>";
 echo "<div id='MenuProduitsDispoCat$categorie_produit_id' class='categories' open=false>";
 while (list($produit_id, $prodStruct) = each($catStruct["produits"])) {
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
 $nbarticles_panier = panierNbArticlesProdsCond($cond_id);
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
 echo "<SELECT  id='nbarticles_1_$cond_id' onChange='javascript:clickSetNbArticles(1,$cond_id);'>";
 for($i=0;$i<=$nbstock;$i++){
 if($nbarticles_panier == $i){
 $selected = " SELECTED";
 }else{
 $selected = "";
 }
 echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
 }
 echo "</SELECT>";
 echo "</td>";
 echo "</tr>";
 }
 echo "</table>";
 echo "</td>";
 echo "</tr>";
 echo "</table>";
 echo "</div>";
 }
 echo "</div>";
 echo "</li>";
 }
 echo "</ul>";*/
?>




