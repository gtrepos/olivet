<?php
function affich_partenaires ()
{
  $requete=
		"SELECT partenaire_id, partenaire_libelle, CONCAT(SUBSTRING(partenaire_descriptif, 1, 20),'...'), partenaire_img_logo, partenaire_siteweb, partenaire_rang, partenaire_etat " .
		"FROM partenaire ORDER by partenaire_rang";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	$etat = $row[6];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	
    echo "<tr id='part_$row[0]' onmouseout=\"restaureLigne('part_$row[0]');\" onmouseover=\"survolLigne('part_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]&nbsp;</td>";
    echo "<td>$row[5]</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    
    echo "<td align=\"right\">";
    if ($row[6]==0) {
    	echo " <a href=\"?page=partenaires&action=activer&id=$row[0]\">[".ADMIN_PARTENAIRE_ACTIVER."]</a>";	
    }
    if ($row[6]==1) {
    	echo " <a href=\"?page=partenaires&action=desactiver&id=$row[0]\">[".ADMIN_PARTENAIRE_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=partenaires&action=modifier&id=$row[0]\">[".ADMIN_PARTENAIRE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionPartenaire('$row[0]','".addslashes($row[1])."')\">[".ADMIN_PARTENAIRE_SUPPRIMER."]</a>";
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_partenaire ($id)
{
  $requete="SELECT partenaire_id, partenaire_libelle, partenaire_descriptif, partenaire_img_logo, partenaire_siteweb, partenaire_rang FROM partenaire where partenaire_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du partenaire <b>'$row[1]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$row[1]\"/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif du partenaire : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$row[2]</textarea></td></tr>";
	echo "<tr><td>Logo (nom de l'image) : </td><td><input type='text' id='imglogo' name='imglogo' value=\"$row[3]\"/></td></tr>";
	echo "<tr><td>Site web : </td><td><input type='text' id='siteweb' name='siteweb' value=\"$row[4]\"/></td></tr>";
	echo "<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' value='$row[5]'/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_partenaire($mode, $id, $libelle, $descriptif, $imglogo, $siteweb, $rang){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO partenaire (partenaire_libelle, partenaire_descriptif, partenaire_img_logo, partenaire_siteweb, partenaire_rang) VALUES ('$libelle', '$descriptif', '$imglogo', '$siteweb', '$rang')";		 
	}
	else if ($mode == 'modification'){
		$requete = 
			"UPDATE partenaire SET partenaire_libelle = '$libelle', partenaire_descriptif = '$descriptif', partenaire_img_logo = '$imglogo', partenaire_siteweb = '$siteweb', partenaire_rang = '$rang' " .
			"WHERE partenaire_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_partenaire($id) {
	$requete = "UPDATE partenaire SET partenaire_etat = 1 WHERE partenaire_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_partenaire($id) {
	$requete = "UPDATE partenaire SET partenaire_etat = 0 WHERE partenaire_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_partenaire($id){
	$requete = "DELETE FROM partenaire where partenaire_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}
?>
