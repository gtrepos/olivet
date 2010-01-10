<?php
function affich_categories ()
{
  $requete="SELECT categorie_produit_id, categorie_produit_libelle, categorie_produit_etat FROM categorie_produit ORDER by categorie_produit_id DESC";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    
    $etat = $row[2];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
    
    echo "<tr id='cat_$row[0]' onmouseout=\"restaureLigne('cat_$row[0]');\" onmouseover=\"survolLigne('cat_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    echo "<td align=\"right\">";
    
    if ($row[2]==0) {
    	echo " <a href=\"?page=categories&action=activer&id=$row[0]\">[".ADMIN_CATEGORIE_ACTIVER."]</a>";	
    }
    if ($row[2]==1) {
    	echo " <a href=\"?page=categories&action=desactiver&id=$row[0]\">[".ADMIN_CATEGORIE_DESACTIVER."]</a>";
    }
    
    echo " <a href=\"?page=categories&action=modifier&id=$row[0]\">[".ADMIN_CATEGORIE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionCategorie('$row[0]','" . addslashes($row[1]) . "')\">[".ADMIN_CATEGORIE_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affich_modif_categorie ($id)
{
  $requete="SELECT categorie_produit_id, categorie_produit_libelle FROM categorie_produit where categorie_produit_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification de la catégorie <b>'$row[1]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$row[1]\"/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_categorie($mode, $id, $libelle){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO categorie_produit (categorie_produit_libelle) VALUES ('$libelle')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE categorie_produit SET categorie_produit_libelle = '$libelle' WHERE categorie_produit_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_categorie($id) {
	$requete = "UPDATE categorie_produit SET categorie_produit_etat = 1 WHERE categorie_produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_categorie($id) {
	$requete = "UPDATE categorie_produit SET categorie_produit_etat = 0 WHERE categorie_produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_categorie($id){
	$requete = "DELETE FROM categorie_produit where categorie_produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_categories($select){
	$requete="SELECT categorie_produit_id, categorie_produit_libelle FROM categorie_produit WHERE categorie_produit_etat = 1 ORDER by categorie_produit_libelle";
	$resultats=mysql_query($requete) or die (mysql_error());
	echo "<SELECT id='idCategorie' name='idCategorie'>";
	echo "<OPTION value='-1'>-- Sélectionner une catégorie --</OPTION>";
	while ($row = mysql_fetch_array($resultats))
  	{
  		$selected = "";
  		if ($row[0] == $select) $selected = "selected"; 
    	echo "<OPTION value='$row[0]' $selected>$row[1]</OPTION>";
  	}
  	echo "</SELECT>";
}
?>
