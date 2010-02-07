<?php


function affich_produits ()
{
  $requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, p.produit_libelle, p.produit_etat, p.produit_photo, p.produit_descriptif_production, c.categorie_produit_id " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " .
  		"ORDER by c.categorie_produit_id DESC, p.produit_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $idproduit = $row[0];
    $libelleCategorie = $row[1];
    $libelleProduit = $row[2];
    $etat = $row[3];
    $photo = $row[4];
    $desc = $row[5];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	
	
	//affichage de la ligne produit
    echo "<tr id='prod_$idproduit' onmouseout=\"restaureLigne('prod_$idproduit');\" onmouseover=\"survolLigne('prod_$idproduit');\">";
    echo "<td>$idproduit</td>";
    echo "<td>$libelleCategorie</td>";
    echo "<td>$libelleProduit</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    echo "<td>$photo</td>";
    echo "<td>$desc</td>";
    echo "<td align=\"right\">";
    
    $isInCommande = checkProduitInCommande($row[0]);
    $isInConditionnement = checkProduitInConditionnement($row[0]);
    
    if ($isInCommande) echo "[Commande]";
    if ($isInConditionnement) echo " [conditionnement]";
    if ($etat==0) {
    	echo " <a href=\"?page=produits&action=activer&id=$idproduit\">[".ADMIN_PRODUIT_ACTIVER."]</a>";	
    }
    if ($etat==1) {
    	echo " <a href=\"?page=produits&action=desactiver&id=$idproduit\">[".ADMIN_PRODUIT_DESACTIVER."]</a>";
    }
    
    echo " <a href=\"?page=produits&action=modifier&id=$idproduit\">[".ADMIN_PRODUIT_MODIFIER."]</a>";
    
    if (!$isInCommande && !$isInConditionnement) {
    	echo " <a href=\"\" onclick=\"alerteSuppressionProduit('$idproduit','".addslashes($libelleProduit)."')\">[".ADMIN_PRODUIT_SUPPRIMER."]</a>";	
    }
    
    echo "</td>";
    echo "</tr>";
  }
}


function affich_modif_produit ($id)
{
  $requete=
		"SELECT produit_id, produit_id_categorie, produit_libelle, produit_descriptif_production, produit_photo " .
		"FROM produit " .
		"WHERE produit_id = '$id' ";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$idproduit = $row[0];
  	$idCategorie = $row[1];
  	$libelle = $row[2];
  	$descriptif = $row[3];
  	$photo = $row[4];
  	
  	echo "<table>";
	echo "<tr><td colspan='2'>Modification du produit <b>'$libelle'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$idproduit'/></tr>";
	echo "<tr><td colspan='2'><img src='../img/upload/$photo'/></td></tr>";
	echo "<tr><td>Identifiant : </td><td>$idproduit</td></tr>";
	echo "<tr><td>Catégorie : </td><td>";echo liste_categories($idCategorie);echo "</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$libelle\" size=70/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$descriptif</textarea></td></tr>";
	echo "<tr><td>Nom photo : </td><td><input type='text' id='photo' name='photo' value='$photo'/> <a href=\"#\" onclick=\"popupActivate(document.forms['form_produit'].photo,'anchor');return false;\" name=\"anchor\" id=\"anchor\">Choisir un fichier</a></td></tr>";
	echo "</table>";
  }
}

function enregistrer_produit($mode, $id, $idCategorie, $libelle, $descriptif, $photo){
	$requete = "";
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO produit (produit_id_categorie, produit_libelle, produit_descriptif_production, produit_photo)" . 
				   "VALUES ($idCategorie, '$libelle', '$descriptif', '$photo')";
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE produit SET produit_id_categorie = $idCategorie, produit_libelle = '$libelle', produit_descriptif_production = '$descriptif', produit_photo = '$photo' " .
				   "WHERE produit_id = '$id'";
	}
	
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_produit($id) {
	$requete = "UPDATE produit SET produit_etat = 1 WHERE produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_produit($id) {
	$requete = "UPDATE produit SET produit_etat = 0 WHERE produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_produit($id){
	if (!checkProduitInCommande($id)) {
		$requete = "DELETE FROM produit where produit_id = '$id'";
		$result=mysql_query($requete) or die (mysql_error());
	}
}

function checkProduitInCommande($id) {
	//on ne peut pas supprimer un produit qui a été référencé dans une commande.
	$requeteCheckInCommande = "SELECT distinct p.produit_libelle, p.produit_id FROM lien_commande_cond lcc, commande com, produit p, conditionnement cond " .
			"WHERE lcc.lcc_id_commande = com.commande_id AND lcc.lcc_id_cond = cond.cond_id AND p.produit_id = cond.cond_id_produit AND p.produit_id = '$id' " .
			"and now() < com.commande_daterecuperation";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

function checkProduitInConditionnement($id) {
	//on ne peut pas supprimer un produit qui a été référencé dans un conditionnement.
	$requeteCheckInCommande = "SELECT distinct p.produit_id FROM produit p, conditionnement cond " .
			"WHERE p.produit_id = cond.cond_id_produit AND p.produit_id = '$id'";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

?>
