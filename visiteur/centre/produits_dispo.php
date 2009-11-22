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
echo "<h2>Produits actuellement disponibles</h2>";
echo "<ul class='menu_deroulant2'>";

$tmpres0 = bddCategorieMenu();
while ($row0 = mysql_fetch_array($tmpres0)){
	$cat_id = $row0[0];
	$cat_name = $row0[1];
	echo " <li>";
	echo "<a href='javascript:clickMenuProditsDispo($cat_id)'>$cat_name</a>";
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

