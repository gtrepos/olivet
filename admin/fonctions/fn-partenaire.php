<?php
function affich_partenaires ()
{
  $requete=
		"SELECT partenaire_id, partenaire_libelle, CONCAT(SUBSTRING(partenaire_descriptif, 1, 20),'...'), partenaire_siteweb, partenaire_rang, partenaire_etat " .
		"FROM partenaire ORDER by partenaire_rang";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	$id = $row[0]; 
	$libelle = $row[1];
	$descriptif = $row[2];
	$siteweb = $row[3];
	$rang = $row[4];	
	$etat = $row[5];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	
    echo "<tr id='part_$id' onmouseout=\"restaureLigne('part_$id');\" onmouseover=\"survolLigne('part_$id');\">";
    echo "<td>$id</td>";
    echo "<td>$libelle</td>";
    echo "<td>$descriptif</td>";
    echo "<td>$siteweb&nbsp;</td>";
    echo "<td>$rang</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    
    echo "<td align=\"right\">";
    if ($etat==0) {
    	echo " <a href=\"?page=partenaires&action=activer&id=$id\">[".ADMIN_PARTENAIRE_ACTIVER."]</a>";	
    }
    if ($etat==1) {
    	echo " <a href=\"?page=partenaires&action=desactiver&id=$id\">[".ADMIN_PARTENAIRE_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=partenaires&action=modifier&id=$id\">[".ADMIN_PARTENAIRE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionPartenaire('$id','".addslashes($libelle)."')\">[".ADMIN_PARTENAIRE_SUPPRIMER."]</a>";
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_partenaire ($id)
{
  $requete="SELECT partenaire_id, partenaire_libelle, partenaire_descriptif, partenaire_siteweb, partenaire_rang, partenaire_logo FROM partenaire where partenaire_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	$id = $row[0]; 
	$libelle = $row[1];
	$descriptif = $row[2];
	$siteweb = $row[3];
	$rang = $row[4];  	
	$photo = $row[5];
  	
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du partenaire <b>'$libelle'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$id'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$id</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$libelle\"/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif du partenaire : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$descriptif</textarea></td></tr>";
	echo "<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' value='$rang'/></td></tr>";
	echo "<tr><td>Site web : </td><td><input type='text' id='siteweb' name='siteweb' value=\"$siteweb\"/></td></tr>";
	echo "<tr><td>Nom logo : </td><td><input type='text' id='photo' name='photo' value='$photo'/> <a href=\"#\" onclick=\"popupActivate(document.forms['form_partenaire'].photo,'anchor');return false;\" name=\"anchor\" id=\"anchor\">Choisir un fichier</a></td></tr>";
	echo "</table>";
  }
}

function enregistrer_partenaire($mode, $id, $libelle, $descriptif, $siteweb, $rang, $photo){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO partenaire (partenaire_libelle, partenaire_descriptif, partenaire_siteweb, partenaire_rang, partenaire_logo) VALUES ('$libelle', '$descriptif', '$siteweb', '$rang', '$photo')";		 
	}
	else if ($mode == 'modification'){
		$requete = 
			"UPDATE partenaire SET partenaire_libelle = '$libelle', partenaire_descriptif = '$descriptif', partenaire_siteweb = '$siteweb', partenaire_rang = '$rang', partenaire_logo = '$photo' " .
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
