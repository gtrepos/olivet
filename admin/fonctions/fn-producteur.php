<?php
function affich_producteurs()
{
  $requete=
		"SELECT producteur_id, producteur_libelle, producteur_adresse, producteur_latitude, producteur_longitude, " .
		"producteur_descriptif, producteur_rang, producteur_etat " .
		"FROM producteur ORDER by producteur_rang";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	$id = $row[0]; 
	$libelle = $row[1];
	$adresse = $row[2];
	$latitude = $row[3];
	$longitude = $row[4];
	$descriptif = $row[5];
	$rang = $row[6];
	$etat = $row[7];
    $etatLibelle = ($etat==0) ? 'Inactif' : 'Actif';
	$etatImage = ($etat==0) ? 'picto_not-ok.gif' : 'picto_ok.gif';
	
    echo "<tr id='part_$id' onmouseout=\"restaureLigne('part_$id');\" onmouseover=\"survolLigne('part_$id');\">";
    echo "<td>$id</td>";
    echo "<td>$libelle</td>";
    echo "<td>$adresse</td>";
    //echo "<td>$latitude</td>";
    //echo "<td>$longitude</td>";
    echo "<td>$descriptif</td>";
    echo "<td>$rang</td>";
    echo "<td><img src='images/$etatImage' title='$etatLibelle'/></td>";
    
    echo "<td align=\"right\">";
    if ($etat==0) {
    	echo " <a href=\"?page=producteurs&action=activer&id=$id\">[".ADMIN_PRODUCTEUR_ACTIVER."]</a>";	
    }
    if ($etat==1) {
    	echo " <a href=\"?page=producteurs&action=desactiver&id=$id\">[".ADMIN_PRODUCTEUR_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=producteurs&action=modifier&id=$id\">[".ADMIN_PRODUCTEUR_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionProducteur('$id','".addslashes($libelle)."')\">[".ADMIN_PRODUCTEUR_SUPPRIMER."]</a>";
    echo "<A NAME='ancre_$id'></td>";
    echo "</tr>";
  }
}

function affich_modif_producteur ($id)
{
  $requete="SELECT producteur_id, producteur_libelle, producteur_adresse, producteur_latitude, producteur_longitude, " .
  		"producteur_descriptif, producteur_rang, producteur_picto, producteur_photo FROM producteur where producteur_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	$id = $row[0]; 
	$libelle = $row[1];
	$adresse = $row[2];
	$latitude = $row[3];
	$longitude = $row[4];	
	$descriptif = $row[5];
	$rang = $row[6];  	
	$picto = $row[7];
	$photo = $row[8];
  	
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du producteur <b>'$libelle'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$id'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$id</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$libelle\" size=50/></td></tr>";
	echo "<tr><td>Adresse : </td><td><input type='text' id='adresse' name='adresse' value=\"$adresse\" size=50/></td></tr>";
	echo "<tr><td>Latitude google map : </td><td><input type='text' id='latitude' name='latitude' value=\"$latitude\" size=20/></td></tr>";
	echo "<tr><td>Longitude google map : </td><td><input type='text' id='longitude' name='longitude' value=\"$longitude\" size=20/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif du producteur : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$descriptif</textarea></td></tr>";
	echo "<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' value='$rang'/></td></tr>";
	echo "<tr><td>Picto : </td><td><input type='text' id='picto' name='picto' value='$picto'/> <a href=\"#\" onclick=\"popupActivate(document.forms['form_producteur'].picto,'anchor');return false;\" name=\"anchor\" id=\"anchor\">Choisir un fichier</a></td></tr>";
	echo "<tr><td>Photo : </td><td><input type='text' id='photo' name='photo' value='$photo'/> <a href=\"#\" onclick=\"popupActivate(document.forms['form_producteur'].photo,'anchor');return false;\" name=\"anchor\" id=\"anchor\">Choisir un fichier</a></td></tr>";
	echo "</table>";
  }
}

function enregistrer_producteur($mode, $id, $libelle, $adresse, $latitude, $longitude, $descriptif, $rang, $picto, $photo){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO producteur (producteur_libelle, producteur_adresse, producteur_latitude, producteur_longitude, producteur_descriptif, producteur_rang, producteur_picto, producteur_photo) " .
				"VALUES ('$libelle', '$adresse', '$latitude', '$longitude', '$descriptif', '$rang', '$picto', '$photo')";		 
	}
	else if ($mode == 'modification'){
		$requete = 
			"UPDATE producteur SET producteur_libelle = '$libelle', producteur_adresse = '$adresse', producteur_latitude = '$latitude', producteur_longitude = '$longitude', " .
			"producteur_descriptif = '$descriptif', producteur_rang = '$rang', producteur_picto = '$picto', producteur_photo = '$photo' " .
			"WHERE producteur_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_producteur($id) {
	$requete = "UPDATE producteur SET producteur_etat = 1 WHERE producteur_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_producteur($id) {
	$requete = "UPDATE producteur SET producteur_etat = 0 WHERE producteur_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_producteur($id){
	$requete = "DELETE FROM producteur where producteur_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_producteurs($select){
	$requete="SELECT producteur_id, producteur_libelle FROM producteur WHERE producteur_etat = 1 ORDER by producteur_libelle";
	$resultats=mysql_query($requete) or die (mysql_error());
	echo "<SELECT id='idProducteur' name='idProducteur'>";
	echo "<OPTION value='-1'>-- Sélectionner un producteur --</OPTION>";
	while ($row = mysql_fetch_array($resultats))
  	{
  		$selected = "";
  		if ($row[0] == $select) $selected = "selected"; 
    	echo "<OPTION value='$row[0]' $selected>$row[1]</OPTION>";
  	}
  	echo "</SELECT>";
}

?>
