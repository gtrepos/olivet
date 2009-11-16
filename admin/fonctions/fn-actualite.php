<?php
function affich_actualites ()
{
  $requete="SELECT actualite_id, actualite_libelle, CONCAT(SUBSTRING(actualite_descriptif, 1, 20),'...'), actualite_datecreation, actualite_datemodification, actualite_type, actualite_nouveaute, actualite_etat FROM actualite ORDER by actualite_id DESC";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $typeLibelle = "";
    if ($row[5]=='GAEC') $typeLibelle = ADMIN_ACTUALITE_GAEC;
    if ($row[5]=='LOMA') $typeLibelle = ADMIN_ACTUALITE_LOMA; 
    
    $nouveauteLibelle = ($row[6]==0) ? 'Non' : 'Oui';
    
    $etatLibelle = ($row[7]==0) ? 'Inactif' : 'Actif';
    
    echo "<tr id='actu_$row[0]' onmouseout=\"restaureLigne('actu_$row[0]');\" onmouseover=\"survolLigne('actu_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$typeLibelle</td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td align=\"right\">";
  	if ($row[7]==0) {
    	echo " <a href=\"?page=actualites&action=activer&id=$row[0]\">[".ADMIN_ACTUALITE_ACTIVER."]</a>";	
    }
    if ($row[7]==1) {
    	echo " <a href=\"?page=actualites&action=desactiver&id=$row[0]\">[".ADMIN_ACTUALITE_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=actualites&action=modifier&id=$row[0]\">[".ADMIN_ACTUALITE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionActu('$row[0]','$row[1]')\">[".ADMIN_ACTUALITE_SUPPRIMER."]</a>";
    echo "</tr>";
    
  }
}

function affich_modif_actu ($id)
{
  $requete="SELECT actualite_id, actualite_libelle, actualite_descriptif, actualite_datecreation, actualite_datemodification, actualite_type, actualite_nouveaute FROM actualite where actualite_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification de l'actualité <b>'$row[1]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$row[1]\"></td></tr>";
	echo "<tr><td valign='top'>Descriptif : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$row[2]</textarea></td></tr>";
	echo "<tr><td>Type d'actualité : </td><td>"; echo liste_type_actualite($row[5]); echo "</td></tr>";
	$nouveauteChecked = "";
	if ($row[6]==1) $nouveauteChecked = "checked";
	echo "<tr><td>Nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $nouveauteChecked/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_actu($mode, $id, $libelle, $descriptif, $type, $nouveaute){
	$requete = "";
	$nouveaute = ($nouveaute=='on') ? 1 : 0 ; 
	
	$libelle = addslashes($libelle); 
	$descriptif = addslashes($descriptif);
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO actualite (actualite_libelle, actualite_descriptif, actualite_datecreation, actualite_type, actualite_nouveaute) VALUES ('$libelle', '$descriptif', now(), '$type', '$nouveaute')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE actualite SET actualite_libelle = '$libelle', actualite_descriptif = '$descriptif', actualite_type = '$type', actualite_nouveaute = '$nouveaute' WHERE actualite_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_type_actualite($select){
	echo "<SELECT id='type' name='type'>";
	echo "<OPTION value='-1'>-- Sélectionner un type d'actualité --</OPTION>";
	echo "<OPTION value='GAEC' " ; if ('GAEC' == $select) echo "selected"; echo ">".ADMIN_ACTUALITE_GAEC."</OPTION>";
    echo "<OPTION value='LOMA' " ; if ('LOMA' == $select) echo "selected"; echo ">".ADMIN_ACTUALITE_LOMA."</OPTION>";
  	echo "</SELECT>";
}

function activer_actualite($id) {
	$requete = "UPDATE actualite SET actualite_etat = 1 WHERE actualite_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_actualite($id) {
	$requete = "UPDATE actualite SET actualite_etat = 0 WHERE actualite_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_actu($id){
	$requete = "DELETE FROM actualite where actualite_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}
?>
