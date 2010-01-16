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
echo "<div id=produits_dispo>";
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
			$nbarticles_panier = panierNbArticles($cond_id);
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
			echo "<SELECT  id='nbarticles_$produit_id' onChange='javascript:clickSetNbArticles($produit_id);'>";
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
echo "</ul>";
echo "</div>";
?>




<?php
/******
 echo "<h3>Produits conditionnés actuellement disponibles</h3>";
 echo "<div id=produits_dispo>";
 echo "<ul class='menu_deroulant2'>";

 $tmpres0 = bddCategorieMenu();
 while ($row0 = mysql_fetch_array($tmpres0)){
 $cat_id = $row0[0];
 $cat_name = $row0[1];

 echo " <li>";
 echo "<a href='javascript:clickMenuProditsDispo($cat_id)'>";
 echo $cat_name;
 echo "</a>";
 echo "<div id='MenuProduitsDispoCat$cat_id' class='categories' open=false>";

 $tmpres1 = bddProduitsDispo($cat_id);
 while ($row1 = mysql_fetch_array($tmpres1)){
 $produit_libelle = $row1[0];
 $produit_unite = $row1[1];
 $produit_prix_unite = $row1[2];
 $produit_id_categorie = $row1[3];
 $produit_description = $row1[4];
 $lien_photo = $row1[5];
 $produit_id = $row1[6];

 echo "<div class='MenuProduitsDispoProd$cat_id products'>";
 echo "<table>";
 echo "<tr>";
 echo "<td>";
 echo "<img src='img/upload/$lien_photo' alt='texte alternatif' />";
 echo "</td>";

 echo "<td>";
 echo " $produit_libelle : $produit_description <br> -> Conditionnement : <br> ";
 $tmpres2 = bddConditionnements($produit_id);
 while ($row2 = mysql_fetch_array($tmpres2)){
 $nb_stock = $row2[0];
 $nom_conditionnement = $row2[1];
 $prix_conditionnement = $row2[2];
 $qtite_cond = $row2[3];
 $ID_cond = $row2[4];
 $nbarticles_panier = panierNbArticles($ID_cond);
 echo " $nom_conditionnement : prix = $prix_conditionnement,
 quantité = $qtite_cond ";
 echo "<SELECT  id='nbarticles_$produit_id' onChange='javascript:clickSetNbArticles($produit_id);'>";
 for($i=0;$i<=$nb_stock;$i++){
 if($nbarticles_panier == $i){
 $selected = " SELECTED";
 }else{
 $selected = "";
 }
 echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
 }
 echo "</SELECT> <br>";
 }
 echo "</td>";
 echo "</table>";
 echo "</div>";
 }

 echo "</div>";
 echo "</li>";
 }
 echo "</ul>";
 echo "</div>";


 echo "<h3>Produits non conditionnés actuellement disponibles (pour réservation)</h3>";
 echo "<div id=produits_dispo>";
 echo "<ul class='menu_deroulant2'>";

 $tmpres0 = bddCategorieMenu();
 while ($row0 = mysql_fetch_array($tmpres0)){
 $cat_id = $row0[0];
 $cat_name = $row0[1];

 echo " <li>";
 echo "<a href='javascript:clickMenuProditsDispo($cat_id)'>";
 echo $cat_name;
 echo "</a>";
 echo "<div id='MenuProduitsDispoCat$cat_id' class='categories' open=false>";

 $tmpres1 = bddProduitsDispo($cat_id);
 while ($row1 = mysql_fetch_array($tmpres1)){
 $produit_libelle = $row1[0];
 $produit_unite = $row1[1];
 $produit_prix_unite = $row1[2];
 $produit_id_categorie = $row1[3];
 $produit_description = $row1[4];
 $lien_photo = $row1[5];
 $produit_id = $row1[6];

 echo "<div class='MenuProduitsDispoProd$cat_id products'>";
 echo "<table>";
 echo "<tr>";
 echo "<td>";
 echo "<img src='img/upload/$lien_photo' alt='texte alternatif' />";
 echo "</td>";

 echo "<td>";
 echo " $produit_libelle : $produit_description <br> -> Conditionnement : <br> ";
 $tmpres2 = bddConditionnements($produit_id);
 while ($row2 = mysql_fetch_array($tmpres2)){
 $nb_stock = $row2[0];
 $nom_conditionnement = $row2[1];
 $prix_conditionnement = $row2[2];
 $qtite_cond = $row2[3];
 $ID_cond = $row2[4];
 $nbarticles_panier = panierNbArticles($ID_cond);
 echo " $nom_conditionnement : prix = $prix_conditionnement,
 quantité = $qtite_cond ";
 echo "<SELECT  id='nbarticles_$produit_id' onChange='javascript:clickSetNbArticles($produit_id);'>";
 for($i=0;$i<=$nb_stock;$i++){
 if($nbarticles_panier == $i){
 $selected = " SELECTED";
 }else{
 $selected = "";
 }
 echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
 }
 echo "</SELECT> <br>";
 }
 echo "</td>";
 echo "</table>";
 echo "</div>";
 }

 echo "</div>";
 echo "</li>";
 }
 echo "</ul>";
 echo "</div>";
 */

?>









<?php
//echo "<h2>Produits actuellement disponibles</h2>";
//echo "<ul class='menu_deroulant2'>";
//
//$tmpres0 = bddCategorieMenu();
//while ($row0 = mysql_fetch_array($tmpres0)){
//	$cat_id = $row0[0];
//	$cat_name = $row0[1];
//	echo " <li class='toggleSubMenu2'><span>$cat_name</span> ";
//	echo "<ul class='subMenu2'>";
//	echo "<li>";
//
//	$tmpres1 = bddProduitsDispo($cat_id);
//
//	echo "<table>";
//
//	while ($row1 = mysql_fetch_array($tmpres1)){
//		$produit_libelle = $row1[0];
//		$produit_unite = $row1[1];
//		$produit_prix_unite = $row1[2];
//		$produit_id_categorie = $row1[3];
//		$produit_description = $row1[4];
//		$lien_photo = $row1[5];
//		$produit_id = $row1[6];
//
//
//		echo "<tr>";
//		echo "<td>";
//		echo "<img src='img/upload/$lien_photo' alt='texte alternatif' />";
//		echo "</td>";
//
//		echo "<td>";
//		echo " $produit_libelle : $produit_description <br> -> Conditionnement : <br> ";
//		$tmpres2 = bddConditionnements($produit_id);
//		while ($row2 = mysql_fetch_array($tmpres2)){
//			$nb_stock = $row2[0];
//			$nom_conditionnement = $row2[1];
//			$prix_conditionnement = $row2[2];
//			$qtite_cond = $row2[3];
//			$ID_cond = $row2[4];
//			$nbarticles_panier = panierNbArticles($ID_cond);
//			echo " $nom_conditionnement : prix = $prix_conditionnement,
// 				quantité = $qtite_cond ";
//			echo "<SELECT  id='nbarticles_$produit_id' onChange='javascript:clickSetNbArticles($produit_id);'>";
//			for($i=0;$i<=$nb_stock;$i++){
//				if($nbarticles_panier == $i){
//					$selected = " SELECTED";
//				}else{
//					$selected = "";
//				}
//				echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
//			}
//			echo "</SELECT> <br>";
//		}
//		echo "</td>";
//	}
//	echo "</table>";
//	echo "</li>";
//	echo "</ul>";
//	echo "</li>";
//}
//echo "</ul>";
//
//

?>

