<?php


function affich_produits_resa ()
{
  $requete=
		"SELECT p.produit_resa_id, p.produit_resa_libelle, p.produit_resa_etat " .
		"FROM produit_resa p " .
		"ORDER by p.produit_resa_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $idproduit = $row[0];
    $libelleProduit = $row[1];
    $etat = $row[2];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	
	//affichage de la ligne produit
    echo "<tr id='prod_$idproduit' onmouseout=\"restaureLigne('prod_$idproduit');\" onmouseover=\"survolLigne('prod_$idproduit');\">";
    echo "<td>$idproduit</td>";
    echo "<td>$libelleProduit</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
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
    
    echo "</td>";
    echo "</tr>";
  }
}


function affich_modif_produit_resa ($id)
{
  $requete=
		"SELECT produit_resa_id, produit_resa_libelle, produit_resa_descriptif_production, produit_resa_photo " .
		"FROM produit_resa " .
		"WHERE produit_resa_id = '$id' ";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$idproduit = $row[0];
  	$libelle = $row[1];
  	$descriptif = $row[2];
  	$photo = $row[3];
  	
  	echo "<table>";
	echo "<tr><td colspan='2'>Modification du produit <b>'$libelle'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$idproduit'/></tr>";
	echo "<tr><td colspan='2'><img src='../img/upload/$photo'/></td></tr>";
	echo "<tr><td>Identifiant : </td><td>$idproduit</td></tr>";
	echo "<tr><td>Libell� : </td><td><input type='text' id='libelle' name='libelle' value=\"$libelle\"/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$descriptif</textarea></td></tr>";
	echo "<tr><td>Nom photo : </td><td><input type='text' id='photo' name='photo' value='$photo'/> <a href=\"#\" onclick=\"popupActivate(document.forms['form_produit_resa'].photo,'anchor');return false;\" name=\"anchor\" id=\"anchor\">Choisir un fichier</a></td></tr>";
	echo "</table>";
  }
}

function enregistrer_produit_resa($mode, $id, $libelle, $descriptif, $photo){
	$requete = "";
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO produit_resa (produit_resa_libelle, produit_resa_descriptif_production, produit_resa_photo)" . 
				   "VALUES ('$libelle', '$descriptif', '$photo')";
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE produit_resa SET produit_resa_libelle = '$libelle', produit_resa_descriptif_production = '$descriptif', produit_resa_photo = '$photo' " .
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
	//on ne peut pas supprimer un produit qui a �t� r�f�renc� dans une commande.
	$requeteCheckInCommande = "SELECT distinct p.produit_resa_libelle, p.produit_resa_id FROM lien_commande_produit_resa lcpr, commande com, produit_resa p " .
			"WHERE lcpr.lcpr_id_commande = com.commande_id AND lcpr.lcpr_id_produit_resa = p.produit_resa_id AND p.produit_resa_id = '$id'";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

?>