

	<?php
	
	echo "<h3>Produits actuellement disponibles</h3>";
	echo "<ul class='navigation2'>";
	
	$tmpres0 = bddCategorieMenu();
	while ($row0 = mysql_fetch_array($tmpres0)){
		$cat_id = $row0[0];
		$cat_name = $row0[1];
		echo " <li class='toggleSubMenu'><span>$cat_name</span> ";
		echo "<ul class='subMenu'>";
		echo "<div id='infobulle'>";
		$tmpres = bddProduitsDispo();
		while ($row = mysql_fetch_array($tmpres)){
			$produit_libelle = $row[0];
			$produit_unite = $row[1];
			$produit_prix_unite = $row[2];
			$produit_id_categorie = $row[3];
			$produit_description = $row[4];
			$lien_photo = $row[5];
			echo " $produit_id_categorie vs $cat_id <br>";
			if($produit_id_categorie == $cat_id){	
				echo "<ul>";
				echo "<li>";
				echo "<img src=\"img/upload/$lien_photo\" alt=\"\">";
				echo "<p>";
				echo "<strong>Info:</strong>";
				echo "Lorem ipsum dolor";
				echo "</p>";
				echo "</li>";
				echo "<li>";
				echo " $produit_libelle --- $produit_description <br>";
				echo "</li>";
				echo "</ul>";
			}
		}
		echo "</div>";
		echo "</ul>";
		echo "</li>";
	}	
	echo "</ul>";
	
	
	


		/*while ($row = mysql_fetch_array($tmpres)){
			$condId = $row[0];
			$condNom = $row[1];
			$condPrix = $row[2];
			$condQuantiteProduit = $row[3];
			$produitLibelle = $row[4];
			$produitUnite = $row[5];
			$produitPrixUnite = $row[6];
			$produitIdCategorie = $row[7];
			$prixUnitaireProduit = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
			$nbarticles = panierNbArticles($condId);
			$prixParProduit = $nbarticles * $prixUnitaireProduit;
			
						
			echo "<tr>";
			echo "<td>$condNom [$produitLibelle]</td>" .
   				 "<td align=right>$prixUnitaireProduit &euro;</td>";
   			
			echo "<td>" .
				 "<SELECT  id='nbarticles_$row[0]' onChange='javascript:clickSetNbArticles($row[0]);'>";
				 for($i=0;$i<10;$i++){
				 	if($nbarticles == $i){
						$selected = " SELECTED";
					}else{
						$selected = "";
					}
					echo "<OPTION VALUE='$i'$selected>$i</OPTION>";
				 }
			echo "</SELECT></td>";	   				 
   			echo "<td align=right>$prixParProduit &euro;</td>";
   			echo "</tr>"	
			
		}*/
		
	
	
	?>


<!--  <table border='1' align=center
	style='border-collapse: separate; empty-cells: show;'>
	<tr>
		<td>Produits</td>
		<td>Prix unitaire TTC</td>
		<td>Nombre</td>
		<td style='border-left: 3px solid #000;'>Prix total TTC</td>
		
	</tr>

</table>  
<div id='infobulle'>
	<ul> 
		<li> 
			<img src="img/upload/10.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/20.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/30.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/40.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/50.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/60.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/70.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/80.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
		<li> 
			<img src="visiteur/centre/infobulles_fichiers/90.jpg" alt=""> 
			<p> 
				<strong>Info:</strong> 
				Lorem ipsum dolor
			</p> 
		</li> 
	</ul>
</div> 

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
