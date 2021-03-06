<?php
function affich_conditionnements ($idCategorie)
{
  $requete=
		"SELECT cond.cond_id, cat.categorie_produit_libelle, prod.produit_libelle, cond.cond_nouveaute, cond.cond_etat, " .
		"cond.cond_prix, cond.cond_nom, cond.cond_a_stock, cond.cond_nb_stock, cond.cond_divisible, cond.cond_remise, " .
		"cond.cond_tva, cat.categorie_produit_id, prod.produit_id_producteur, cond.cond_rang " .
		"FROM produit prod, categorie_produit cat, conditionnement cond " .
		"WHERE prod.produit_id_categorie = cat.categorie_produit_id AND prod.produit_id = cond.cond_id_produit ";
  
  if ($idCategorie != null && $idCategorie != -1) {
  	$requete = $requete . " AND cat.categorie_produit_id = '" . $idCategorie . "'" ;
  }
  	
  $requete = $requete . " ORDER by cat.categorie_produit_id DESC, prod.produit_libelle, cond.cond_rang, cond.cond_nom";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  echo mysql_num_rows($resultats) . " conditionnement(s)" . "<br><br>";
  
  while ($row = mysql_fetch_array($resultats))
  {
    
    $idCond = $row[0];
    $libelleCat = $row[1];
    $libelleProd = $row[2];
    $nouveaute = $row[3];
    $etat = $row[4];
    $condPrix = $row[5];
	$condNom = $row[6];
	$condAStock = $row[7];
	$condNbStock = $row[8];
	$divisible = $row[9];
	$remise = $row[10];
	$tva = $row[11];
	$idProducteur = $row[13];
	$rang = $row[14];
	$libelleProducteur = getLibelleProducteur($idProducteur);
	$libelleCompletProduit = $libelleProd;
	
	if ($idProducteur!=null) {
		$libelleCompletProduit = $libelleCompletProduit . " - " . $libelleProducteur;
	}
	
	$etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	$stockLibelle = ($condAStock==0) ? 'Aucun' : $condNbStock;
	$nouveauteLibelle = ($nouveaute==0) ? 'Non' : 'Oui';
    $nouveauteImage = ($nouveaute==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
    $nouveauteSelect0 = ($nouveaute==0) ? 'selected' : '';
    $nouveauteSelect1 = ($nouveaute==1) ? 'selected' : '';
    $divisibleLibelle = ($divisible==0) ? 'Non' : 'Oui';
    $prixGlobal = number_format($condPrix - $remise, 2, '.', '');
	
	//affichage de la ligne prodit
    echo "<tr id='prod_$idCond' onmouseout=\"restaureLigne('prod_$idCond');\" onmouseover=\"survolLigne('prod_$idCond');\">";
    echo "<td>$idCond</td>";
    echo "<td>$libelleCompletProduit</td>";
    echo "<td>$condNom</td>";
    echo 
		"<td><img src='images/$nouveauteImage' title='$nouveauteLibelle'/>&nbsp;" .
    		"<select onChange=\"updateNouveauteConditionnement('$idCond', this.value)\">" .
    		"<option value=1 $nouveauteSelect1>Oui</option>" .
    		"<option value=0 $nouveauteSelect0>Non</option>" .
    		"</select>" .
    	"</td>";
    echo "<td>$divisibleLibelle</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    echo "<td>$condPrix €</td>";
    /*echo "<td>$remise €</td>";*/
    echo "<td>$prixGlobal €</td>";
    echo "<td>$tva</td>";
    echo "<td>$rang</td>";
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
    
    echo "<A NAME='ancre_$row[0]'></A></td>";
    echo "</tr>";
  }
}

function affich_modif_conditionnement ($id)
{
  $requete=
		"SELECT cond_id, cond_id_produit, cond_nouveaute, cond_prix, cond_nom, produit_photo, produit_libelle, cond_a_stock, " .
		"cond_nb_stock, cond_divisible, cond_remise, cond_tva, cond_rang " .
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
  	$produitLibelle = $row[6];
  	$aStock = $row[7];
  	$nbStock = $row[8];
  	$divisible = $row[9];
  	$remise = $row[10];
  	$tva = $row[11];
  	$rang = $row[12];
  	
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
	echo "<tr><td>Prix vente TTC : </td><td><input type='text' id='prix_cond' name='prix_cond' value='$prixCond'/> &euro; (Exemple : 1.50)</td></tr>";
	echo "<tr><td>Remise : </td><td><input type='text' id='remise' name='remise' value='$remise'/> &euro; (Exemple : 0.20)</td></tr>";
	echo "<tr><td>TVA : </td><td>"; echo affiche_tva($tva); echo "</td></tr>";
	echo "<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' size=10 value=\"$rang\"/></td></tr>";
	echo "</table>";
  }
  
}

function enregistrer_conditionnement($mode, $id, $idProduit, $nom, $nouveaute, $prix_cond, $aStock, $nbStock, 
	$divisible, $remise, $tva, $rang){
	
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
		$requete = "INSERT INTO conditionnement (cond_id_produit, cond_nom, cond_nouveaute, cond_prix, " .
				   "cond_a_stock, cond_nb_stock, cond_divisible, cond_remise, cond_tva, cond_rang)" . 
				   "VALUES ($idProduit, '$nom', $nouveaute, $prix_cond, $aStock, $nbStock, $divisible, $remise, $tva, $rang)";
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE conditionnement SET cond_id_produit = $idProduit, cond_nom = '$nom', cond_nouveaute = $nouveaute, " . 
				   "cond_prix = $prix_cond, cond_a_stock = $aStock, cond_nb_stock = $nbStock, " .
				   "cond_divisible = $divisible, cond_remise = $remise, cond_tva = $tva, cond_rang = $rang " .
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
			"WHERE lcc.lcc_id_commande = com.commande_id AND lcc.lcc_id_cond = cond.cond_id AND cond.cond_id = '$id' and now() < com.commande_daterecuperation";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

function updateNouveauteConditionnement($idcond,$nouveaute){
	$requete=$requete = "UPDATE conditionnement SET cond_nouveaute = $nouveaute WHERE cond_id = '$idcond'";
	$resultats=mysql_query($requete) or die (mysql_error());
}

function supprimer_conditionnement($idcond) {
	$requete = "DELETE FROM conditionnement WHERE cond_id = '$idcond'";
	$result=mysql_query($requete) or die (mysql_error());
}

?>
