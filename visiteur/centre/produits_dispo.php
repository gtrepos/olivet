

<?php
echo "<h3>Produits actuellement disponibles</h3>";
echo "<ul class='navigation2'>";

$tmpres0 = bddCategorieMenu();
while ($row0 = mysql_fetch_array($tmpres0)){
	$cat_id = $row0[0];
	$cat_name = $row0[1];
	echo " <li class='toggleSubMenu'><span>$cat_name</span> ";
	echo "<ul class='subMenu'>";
	echo "<li>";

	$tmpres1 = bddProduitsDispo($cat_id);
	
	echo "<table>";
	
	while ($row1 = mysql_fetch_array($tmpres1)){
		$produit_libelle = $row1[0];
		$produit_unite = $row1[1];
		$produit_prix_unite = $row1[2];
		$produit_id_categorie = $row1[3];
		$produit_description = $row1[4];
		$lien_photo = $row1[5];
		$produit_id = $row1[6];


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
	}
	echo "</table>";
	echo "</li>";
	echo "</ul>";
	echo "</li>";
}
echo "</ul>";





//		while ($row = mysql_fetch_array($tmpres)){
//			$condId = $row[0];
//			$condNom = $row[1];
//			$condPrix = $row[2];
//			$condQuantiteProduit = $row[3];
//			$produitLibelle = $row[4];
//			$produitUnite = $row[5];
//			$produitPrixUnite = $row[6];
//			$produitIdCategorie = $row[7];
//			$prixUnitaireProduit = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
//			$nbarticles = panierNbArticles($condId);
//			$prixParProduit = $nbarticles * $prixUnitaireProduit;
//
//
//			echo "<tr>";
//			echo "<td>$condNom [$produitLibelle]</td>" .
//   				 "<td align=right>$prixUnitaireProduit &euro;</td>";
//
//			echo "<td>" .
//				 "<SELECT  id='nbarticles_$row[0]' onChange='javascript:clickSetNbArticles($row[0]);'>";
//				 for($i=0;$i<10;$i++){
//				 	if($nbarticles == $i){
//						$selected = " SELECTED";
//					}else{
//						$selected = "";
//					}
//					echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
//				 }
//			echo "</SELECT></td>";
//   			echo "<td align=right>$prixParProduit &euro;</td>";
//   			echo "</tr>"
//
//		}



?>


<?php
/*echo "<div class='myinfobulle'>";
 echo 	"<ul>";
 echo 	"	<li>";
 echo 	"	<img src=\"img/upload/10.jpg\" alt=\"\">";
 echo "	<p>";
 echo 	"		<strong>Info:</strong>";
 echo 	"		Lorem ipsum dolor";
 echo 		"	</p> ";
 echo 	"</li>";
 echo "	</ul>";
 echo "</div> ";*/
?>
<!--

<infoimg href="url-du-lien" class="tooltip">
<img src="img/upload/20.jpg" alt="texte alternatif" />
<em><span></span>texte de l'infobulle</em></infoimg>


<table cellspacing=0 cellpadding=0 border=0 width='100%'>
<tr>
<td>
<div id="produits_gaucheID">
 <ul class="produits_menu1CL">	
		<li>Les produits laitiers bio</li>
		<ul class="produits_menu2CL">	
			<li>Le lait bio cru ou pasteurisé</li>
			<br>Photo Produit
			<br>Descriptif produit, moyen de production...
			<br> 	
			<li>La crème bio fraîche ou fleurette</li>
			<li>Les yaourts bio nature, aromatisés, aux fruits, spéciaux</li>
			<li>Le fromage blanc bio</li>
			<li>La faisselle bio</li>
			<li>Les petits suisses bio</li>
			<li>Les crèmes desserts bio</li>
			<li>Les petits frais bio</li>
			<li>Le fromage frais bio à tartiner</li>
		</ul>		
 </ul>
</div>
</td>
<td>
<div id="produits_droiteID">
 <ul class="produits_menu1CL">	
		<li>Les autres produits disponibles toute l'année</li>
		<ul class="produits_menu2CL">	
			<li>Légumes de saison</li>
			<li>Fruits de saison</li>
			<li>Les oeufs bio fermiers</li>
			
		</ul>
		<li>Les produits disponibles à certaines périodes</li>
		<ul class="produits_menu2CL">	
			<li>Les volailles bio fermières</li>
			<li>Le mouton bio en caissette ( 8 à 9 Kg), tout type de morceaux</li>
			<li>Le boeuf bio en caissette (17 à 18 Kg), tout type de morceaux</li>
			<li>Le cochon et charcuterie bio en caissette (10 à 12 Kg), tout type de morceaux</li>
		</ul>		
 </ul>
</div>
</td>
</tr>
</table>
-->
