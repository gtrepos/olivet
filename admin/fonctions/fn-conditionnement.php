<?php
function affich_conditionnements ()
{
  $requete=
		"SELECT cond.cond_id, cat.categorie_produit_libelle, prod.produit_libelle, prod.produit_unite, prod.produit_prix_unite, cond.cond_nb_stock, cond.cond_nouveaute, cond.cond_etat, " .
		"cond.cond_prix, cond.cond_nom, cond.cond_quantite_produit " .
		"FROM produit prod, categorie_produit cat, conditionnement cond " .
		"WHERE prod.produit_id_categorie = cat.categorie_produit_id AND prod.produit_id = cond.cond_id_produit " .
  		"ORDER by cond.cond_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    
    $idCond = $row[0];
    $libelleCat = $row[1];
    $libelleProd = $row[2];
    $produitUnite = $row[3];
    $produitPrixUnite = $row[4];
    $stockLibelle = ($row[5]==-1) ? 'Aucun' : $row[5];
    $nouveauteLibelle = ($row[6]==0) ? 'Non' : 'Oui';
    $etat = $row[7];
    $etatLibelle = ($row[7]==0) ? 'Inactif' : 'Actif'; 
    $condPrix = $row[8];
	$condNom = $row[9];
	$condQuantiteProduit = $row[10];
	
	$prixCondLibelle = '(' . $condQuantiteProduit . '*' . $produitPrixUnite . ') + ' . $condPrix;
	$prixGlobal = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
	
	//affichage de la ligne prodit
    echo "<tr id='prod_$idCond' onmouseout=\"restaureLigne('prod_$idCond');\" onmouseover=\"survolLigne('prod_$idCond');\">";
    echo "<td>$idCond</td>";
    echo "<td>$libelleCat - $libelleProd</td>";
    echo "<td>$condNom</td>";
    echo "<td>$stockLibelle</td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td>$prixGlobal €</td>";
    echo "<td>$condQuantiteProduit $produitUnite</td>";
    echo "<td>$condPrix €</td>";
    echo "<td align=\"right\">";
    
    $isInCommande = checkCondInCommande($idCond);
    
    if ($isInCommande) echo "[Commande]";
    
    if ($etat==0) {
    	echo " <a href=\"?page=conditionnements&action=activer&id=$row[0]\">[".ADMIN_CONDITIONNEMENT_ACTIVER."]</a>";	
    }
    if ($etat==1) {
    	echo " <a href=\"?page=conditionnements&action=desactiver&id=$row[0]\">[".ADMIN_CONDITIONNEMENT_DESACTIVER."]</a>";
    }
    
    if (!$isInCommande) {
    	echo " <a href=\"?page=conditionnements&action=modifier&id=$row[0]\">[".ADMIN_CONDITIONNEMENT_MODIFIER."]</a>";
    	echo " <a href=\"\" onclick=\"alerteSuppressionConditionnement('$row[0]','$row[1]')\">[".ADMIN_CONDITIONNEMENT_SUPPRIMER."]</a>";	
    }
    
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_conditionnement ($id)
{
  $requete=
		"SELECT cond_id, cond_id_produit, cond_nb_stock, cond_nouveaute, cond_prix, cond_nom, cond_lien_photo, cond_quantite_produit, produit_libelle " .
		"FROM conditionnement, produit " .
		"WHERE cond_id = '$id' and cond_id_produit = produit_id";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$idcond = $row[0];
  	$idproduit = $row[1];
  	$nbStock = $row[2];
  	
  	$checkedStock = '';
  	$readOnlyStock = '';
  	
  	if ($nbStock>-1) {
  		$checkedStock = 'checked';
  	}	
  	else {
  		$readOnlyStock = 'readonly="readonly"';
  		$nbStock = '';
  	}
  	
  	$nouveaute = $row[3];
  	
  	$checkedNouveaute = '';
  	if ($nouveaute == 1) $checkedNouveaute = 'checked';
  	
  	$prixCond = $row[4];
  	$nom = $row[5];
  	$photo = $row[6];
  	$quantiteProduit = $row[7];
  	$produitLibelle = $row[8];
  	
  	echo "<table>";
	echo "<tr><td colspan='2'>Modification du conditionnement <b>'$nom' [$produitLibelle]</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$idcond'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$idcond</td></tr>";
	echo "<tr><td>Produit : </td><td>";echo affiche_produits_pour_selection($idproduit, false, null);echo "</td></tr>";
	echo "<tr><td>Nom : </td><td><input type='text' id='nom' name='nom' value='$nom'/></td></tr>";
	echo "<tr><td>Stock : </td><td><input type='checkbox' $checkedStock id='is_stock' name='is_stock' onclick='selectionneStock()'/> : " .
		 "<input type='text' id='nb_stock' name='nb_stock' $readOnlyStock value='$nbStock'/></td></tr>";
	echo "<tr><td>Afficher en tant que nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $checkedNouveaute/></td></tr>";
	echo "<tr><td>Prix du conditionnement : </td><td><input type='text' id='prix_cond' name='prix_cond' value='$prixCond'/> € (Exemple : 1.50)</td></tr>";
	echo "<tr><td>Quantite de produit : </td><td><input type='text' id='quantite_produit' name='quantite_produit' value='$quantiteProduit'/></td></tr>";
	echo "<tr><td>Nom photo : </td><td><input type='text' id='lien_photo' name='lien_photo' value='$photo'/></td></tr>";
	
	echo "</table>";
  }
  
}

function enregistrer_conditionnement($mode, $id, $idProduit, $nom, $nbStock, $nouveaute, $prix_cond, $quantiteProduit, $lienPhoto){
	
	if ($nbStock == '') $nbStock = -1;
	
	if ($nouveaute == 'on') {
		$nouveaute = 1;
	}else {
		$nouveaute = 0;
	}
	
	$requete = "";
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO conditionnement (cond_id_produit, cond_nom, cond_nb_stock, cond_nouveaute, cond_prix, cond_quantite_produit, cond_lien_photo)" . 
				   "VALUES ($idProduit, '$nom', $nbStock, $nouveaute, $prix_cond, $quantiteProduit, '$lienPhoto')";				  
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE conditionnement SET cond_id_produit = $idProduit, cond_nom = '$nom', cond_nb_stock = $nbStock, cond_nouveaute = $nouveaute, " . 
				   "cond_prix = $prix_cond, cond_quantite_produit = $quantiteProduit, cond_lien_photo = '$lienPhoto' " .
				   "WHERE cond_id = '$id'";		
	}
	
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_conditionnement($id) {
	$requete = "UPDATE conditionnement SET cond_etat = 1 WHERE cond_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_conditionnement($id) {
	$requete = "UPDATE conditionnement SET cond_etat = 0 WHERE cond_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function checkCondInCommande($id) {
	//on ne peut pas supprimer ou modifier un conditionnement qui a été référencé dans une commande.
	$requeteCheckInCommande = "SELECT distinct cond.cond_nom, cond.cond_id FROM lien_commande_cond lcc, commande com, conditionnement cond " .
			"WHERE lcc.lcc_id_commande = com.commande_id AND lcc.lcc_id_cond = cond.cond_id AND cond.cond_id = '$id'";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

?>
