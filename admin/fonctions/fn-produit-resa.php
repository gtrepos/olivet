<?php

function affich_produits_resa ($idCategorie)
{
  $requete=
		"SELECT produit_resa_id, produit_resa_libelle, produit_resa_etat, produit_resa_a_stock, produit_resa_nb_stock, produit_resa_nouveaute, " .
		"categorie_produit_libelle, produit_resa_rang, categorie_produit_id, produit_resa_date_recuperation, produit_resa_date_limite_recuperation, " .
		"produit_resa_date_limite_commande, produit_resa_id_producteur " .
		"FROM produit_resa, categorie_produit " .
		"WHERE produit_resa_id_categorie = categorie_produit_id ";
		
  if ($idCategorie != null && $idCategorie != -1) {
  	$requete = $requete . " AND categorie_produit_id = '" . $idCategorie . "'" ;
  }				
		
  $requete = $requete . " ORDER BY categorie_produit_libelle, produit_resa_libelle ";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  echo mysql_num_rows($resultats) . " produit(s) à la réservation" . "<br><br>";
  
  while ($row = mysql_fetch_array($resultats))
  {
    $idproduit = $row[0];
    $libelleProduit = $row[1];
    $etat = $row[2];
    $aStock = $row[3];
    $nbStock = $row[4];
    $nouveaute = $row[5];
    $libelleCategorie = $row[6];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	$nouveauteLibelle = ($nouveaute==0) ? 'Non' : 'Oui';
	$stockLibelle = ($aStock==0) ? 'Aucun' : $nbStock;
	$rang = $row[7];
	$dateRecup = $row[9];
	$dateLimite = $row[10];
	$dateLimiteCommande = $row[11];
	$idProducteur = $row[12];
	$libelleProducteur = getLibelleProducteur($idProducteur);
	
	if ($idProducteur==null){
		$libelleProducteur = 'Aucun producteur désigné';
	}
	//affichage de la ligne produit
    echo "<tr id='prod_$idproduit' onmouseout=\"restaureLigne('prod_$idproduit');\" onmouseover=\"survolLigne('prod_$idproduit');\">";
    echo "<td>$idproduit</td>";
    echo "<td>$libelleCategorie</td>";
    echo "<td>$libelleProduit</td>";
    echo "<td>$libelleProducteur</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$rang</td>";
    echo "<td>".dateUsFr($dateLimiteCommande)." inclu</td>";
    echo "<td>".dateUsFr($dateRecup)."</td>";
    echo "<td>".dateUsFr($dateLimite)." inclu</td>";
    echo "<td align=\"right\">";
    
    $isInCommande = checkProduitResaInCommande($row[0]);
    
    if ($isInCommande) echo "[Commande]";
    
    if ($etat==0) {
    	echo " <a href=\"?page=produitsresa&action=activer&id=$idproduit\">[".ADMIN_PRODUIT_RESA_ACTIVER."]</a>";	
    }
    if ($etat==1) {
    	echo " <a href=\"?page=produitsresa&action=desactiver&id=$idproduit\">[".ADMIN_PRODUIT_RESA_DESACTIVER."]</a>";
    }
    
    echo " <a href=\"?page=produitsresa&action=modifier&id=$idproduit\">[".ADMIN_PRODUIT_RESA_MODIFIER."]</a>";
    
    if (!$isInCommande) {
    	echo " <a href=\"\" onclick=\"alerteSuppressionProduitResa('$idproduit','". addslashes($libelleProduit) ."')\">[".ADMIN_PRODUIT_RESA_SUPPRIMER."]</a>";	
    }
    
    echo "<A NAME='ancre_$idproduit'></A></td>";
    echo "</tr>";
  }
}


function affich_modif_produit_resa ($id)
{
  $requete=
		"SELECT produit_resa_id, produit_resa_libelle, produit_resa_descriptif_production, produit_resa_photo, produit_resa_a_stock, produit_resa_nb_stock, " .
		"produit_resa_nouveaute, produit_resa_id_categorie, produit_resa_rang, produit_resa_date_recuperation, produit_resa_date_limite_recuperation, produit_resa_date_limite_commande," .
		"produit_resa_id_producteur " .
		"FROM produit_resa " .
		"WHERE produit_resa_id = '$id' ";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$idproduit = $row[0];
  	$libelle = $row[1];
  	$descriptif = $row[2];
  	$photo = $row[3];
  	$aStock = $row[4];
  	$nbStock = $row[5];
  	$nouveaute = $row[6];
  	$idCategorie = $row[7];
  	$rang = $row[8];
  	$dateRecup = $row[9];
  	$dateLimite = $row[10];
  	$dateLimiteCommande = $row[11];
  	$idProducteur = $row[12];
  	
  	$dateRecup = dateUsFr($dateRecup);
	$dateLimite = dateUsFr($dateLimite);
  	$dateLimiteCommande = dateUsFr($dateLimiteCommande);
  	
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
  	
  	
  	echo "<table>";
	echo "<tr><td colspan='2'>Modification du produit <b>'$libelle'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$idproduit'/></tr>";
	echo "<tr><td colspan='2'><img src='../img/upload/$photo'/></td></tr>";
	echo "<tr><td>Identifiant : </td><td>$idproduit</td></tr>";
	echo "<tr><td>Catégorie : </td><td>";echo liste_categories($idCategorie, null);echo "</td></tr>";
	echo "<tr><td>Producteur : </td><td>";echo liste_producteurs($idProducteur);echo "</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$libelle\"/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$descriptif</textarea></td></tr>";
	echo "<tr><td>Stock : </td><td><input type='checkbox' $checkedStock id='a_stock' name='a_stock' onclick='selectionneStock()'/> : " .
		 "<input type='text' id='nb_stock' name='nb_stock' $readOnlyStock value='$nbStock'/></td></tr>";
	echo "<tr><td>Afficher en tant que nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $checkedNouveaute/></td></tr>";
	echo "<tr><td>Nom photo : </td><td><input type='text' id='photo' name='photo' value='$photo'/> <a href=\"#\" onclick=\"popupActivate(document.forms['form_produit_resa'].photo,'anchor');return false;\" name=\"anchor\" id=\"anchor\">Choisir un fichier</a></td></tr>";
	echo "<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' value=\"$rang\"/></td></tr>";
	echo "<tr><td>Date limite de commande : </td><td><input type='text' id='dateLimiteCommande' name='dateLimiteCommande' value=\"$dateLimiteCommande\"/>&nbsp;format : JJ/MM/AAAA</td></tr>";
	echo "<tr><td>Date de retrait en magasin : </td><td><input type='text' id='dateRecup' name='dateRecup' value=\"$dateRecup\"/>&nbsp;format : JJ/MM/AAAA</td></tr>";
	echo "<tr><td>Date limite de retrait : </td><td><input type='text' id='dateLimite' name='dateLimite' value=\"$dateLimite\"/>&nbsp;format : JJ/MM/AAAA</td></tr>";
	echo "</table>";
  }
}

function enregistrer_produit_resa($mode, $id, $idCategorie, $libelle, $descriptif, $photo, $nouveaute, $aStock, $nbStock, $rang, 
		$dateRecup, $dateLimite, $dateLimiteCommande, $idProducteur){
	
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
	
	$dateRecup = dateFrUs($dateRecup);
	$dateLimite = dateFrUs($dateLimite);
	$dateLimiteCommande = dateFrUs($dateLimiteCommande);
	
	if ($idProducteur == '-1') {
		$idProducteur = 'NULL';
	}
	
	$requete = "";
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO produit_resa (produit_resa_id_categorie, produit_resa_libelle, produit_resa_descriptif_production, produit_resa_photo, " .
				   "produit_resa_a_stock, produit_resa_nb_stock, produit_resa_nouveaute, produit_resa_rang, produit_resa_date_recuperation, produit_resa_date_limite_recuperation, " .
				   "produit_resa_date_limite_commande, produit_resa_id_producteur)" . 
				   "VALUES ($idCategorie, '$libelle', '$descriptif', '$photo', $aStock, $nbStock, $nouveaute, $rang, '$dateRecup', '$dateLimite', '$dateLimiteCommande', $idProducteur)";
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE produit_resa SET produit_resa_id_categorie = $idCategorie, produit_resa_libelle = '$libelle', produit_resa_descriptif_production = '$descriptif', produit_resa_photo = '$photo', " .
				   "produit_resa_a_stock = $aStock, produit_resa_nb_stock = $nbStock, produit_resa_nouveaute = $nouveaute, produit_resa_rang = $rang, " .
				   "produit_resa_date_recuperation = '$dateRecup', produit_resa_date_limite_recuperation = '$dateLimite', produit_resa_date_limite_commande = '$dateLimiteCommande', " .
				   "produit_resa_id_producteur = $idProducteur " . 
				   "WHERE produit_resa_id = '$id'";
	}
	
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_produit_resa($id) {
	$requete = "UPDATE produit_resa SET produit_resa_etat = 1 WHERE produit_resa_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_produit_resa($id) {
	$requete = "UPDATE produit_resa SET produit_resa_etat = 0 WHERE produit_resa_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_produit_resa($id){
	if (!checkProduitResaInCommande($id)) {
		$requete = "DELETE FROM produit_resa where produit_resa_id = '$id'";
		$result=mysql_query($requete) or die (mysql_error());
	}
}

function checkProduitResaInCommande($id) {
	//on ne peut pas supprimer un produit qui a été référencé dans une commande.
	$requeteCheckInCommande = "SELECT distinct p.produit_resa_libelle, p.produit_resa_id FROM lien_commande_produit_resa lcpr, commande com, produit_resa p " .
			"WHERE lcpr.lcpr_id_commande = com.commande_id AND lcpr.lcpr_id_produit_resa = p.produit_resa_id AND p.produit_resa_id = '$id' " .
			"and now() < com.commande_daterecuperation";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

?>
