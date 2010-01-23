<?php
function affich_conditionnements ()
{
  $requete=
		"SELECT cond.cond_id, cat.categorie_produit_libelle, prod.produit_libelle, prod.produit_unite, prod.produit_prix_unite, cond.cond_nouveaute, cond.cond_etat, " .
		"cond.cond_prix, cond.cond_nom, cond.cond_quantite_produit, cond.cond_a_stock, cond.cond_nb_stock, cond.cond_divisible " .
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
    $nouveaute = $row[5];
    $etat = $row[6];
    $condPrix = $row[7];
	$condNom = $row[8];
	$condQuantiteProduit = $row[9];
	$condAStock = $row[10];
	$condNbStock = $row[11];
	$divisible = $row[12];
	
	$etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	$stockLibelle = ($condAStock==0) ? 'Aucun' : $condNbStock;
    $nouveauteLibelle = ($nouveaute==0) ? 'Non' : 'Oui';
    $divisibleLibelle = ($divisible==0) ? 'Non' : 'Oui';
    $prixCondLibelle = '(' . $condQuantiteProduit . '*' . $produitPrixUnite . ') + ' . $condPrix;
	$prixGlobal = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
	
	//affichage de la ligne prodit
    echo "<tr id='prod_$idCond' onmouseout=\"restaureLigne('prod_$idCond');\" onmouseover=\"survolLigne('prod_$idCond');\">";
    echo "<td>$idCond</td>";
    echo "<td>$libelleCat - $libelleProd</td>";
    echo "<td>$condNom</td>";
    echo "<td>$stockLibelle</td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$divisibleLibelle</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
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
    	echo " <a href=\"\" onclick=\"alerteSuppressionConditionnement('$row[0]','".addslashes($condNom)."')\">[".ADMIN_CONDITIONNEMENT_SUPPRIMER."]</a>";
    }
    
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_conditionnement ($id)
{
  $requete=
		"SELECT cond_id, cond_id_produit, cond_nouveaute, cond_prix, cond_nom, produit_photo, cond_quantite_produit, produit_libelle, cond_a_stock, cond_nb_stock, cond_divisible " .
		"FROM conditionnement, produit " .
		"WHERE cond_id = '$id' and cond_id_produit = produit_id";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$idcond = $row[0];
  	$idproduit = $row[1];
  	$nouveaute = $row[2];
  	$prixCond = $row[3];
  	$nom = $row[4];
  	$photo = $row[5];
  	$quantiteProduit = $row[6];
  	$produitLibelle = $row[7];
  	$aStock = $row[8];
  	$nbStock = $row[9];
  	$divisible = $row[10];
  	
  	$checkedStock = '';
  	$readOnlyStock = '';
  	
  	if ($aStock==1) {
  		$checkedStock = 'checked';
  	}	
  	else {
  		$readOnlyStock = 'readonly="readonly"';  		
  	}
  	
  	$checkedNouveaute = '';
  	if ($nouveaute == 1) $checkedNouveaute = 'checked';
  	
  	$checkedDivisible = '';
  	if ($divisible == 1) $checkedDivisible = 'checked';
  	
  	echo "<table>";
	echo "<tr><td colspan='2'>Modification du conditionnement <b>'$nom' [$produitLibelle]</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$idcond'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$idcond</td></tr>";
	echo "<tr><td>Produit : </td><td>";echo affiche_produits_pour_selection($idproduit, false, null);echo "</td></tr>";
	echo "<tr><td>Nom : </td><td><input type='text' id='nom' name='nom' value=\"$nom\"/></td></tr>";
	echo "<tr><td>Stock : </td><td><input type='checkbox' $checkedStock id='a_stock' name='a_stock' onclick='selectionneStock()'/> : " .
		 "<input type='text' id='nb_stock' name='nb_stock' $readOnlyStock value='$nbStock'/></td></tr>";
	echo "<tr><td>Afficher en tant que nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $checkedNouveaute/></td></tr>";
	echo "<tr><td>Divisble ? </td><td><input type='checkbox' id='divisible' name='divisible' $checkedDivisible/></td></tr>";
	echo "<tr><td>Prix du conditionnement : </td><td><input type='text' id='prix_cond' name='prix_cond' value='$prixCond'/> € (Exemple : 1.50)</td></tr>";
	echo "<tr><td>Quantite de produit : </td><td><input type='text' id='quantite_produit' name='quantite_produit' value='$quantiteProduit'/></td></tr>";
	echo "</table>";
  }
  
}

function enregistrer_conditionnement($mode, $id, $idProduit, $nom, $nouveaute, $prix_cond, $quantiteProduit, $aStock, $nbStock, $divisible){
	
	if ($aStock == 'on') {
		$aStock = 1;
	} else {
		$aStock = 0;
	}
	
	if ($nouveaute == 'on') {
		$nouveaute = 1;
	}else {
		$nouveaute = 0;
	}
	
	if ($divisible == 'on') {
		$divisible = 1;
	}else {
		$divisible = 0;
	}
	
	$requete = "";
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO conditionnement (cond_id_produit, cond_nom, cond_nouveaute, cond_prix, cond_quantite_produit, cond_a_stock, cond_nb_stock, cond_divisible)" . 
				   "VALUES ($idProduit, '$nom', $nouveaute, $prix_cond, $quantiteProduit, $aStock, $nbStock, $divisible)";
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE conditionnement SET cond_id_produit = $idProduit, cond_nom = '$nom', cond_nouveaute = $nouveaute, " . 
				   "cond_prix = $prix_cond, cond_quantite_produit = $quantiteProduit, cond_a_stock = $aStock, cond_nb_stock = $nbStock, cond_divisible = $divisible " .
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

function supprimer_conditionnement($id) {
	$requete = "DELETE FROM conditionnement WHERE cond_id = '$id'";
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
