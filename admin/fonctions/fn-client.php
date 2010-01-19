<?php
function affich_clients ($nom, $prenom, $commune)
{
  $select="SELECT client_reference, client_civilite, client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email ";
  $from="FROM client ";
  $order=" ORDER by client_reference DESC";
  
  $where = "WHERE 1=1";
  
  if ($nom!=null) $where = $where . " AND client_nom like '$nom%'";
  if ($prenom!=null) $where = $where . " AND client_prenom like '$prenom%'";
  if ($commune!=null) $where = $where . " AND client_commune like '%$commune%'";
  
  $requete = $select.$from.$where.$order;
  
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	$reference = $row[0];
  	$civilite = $row[1];
  	if ($civilite == '-1' || $civilite == '') $civilite = '&nbsp;';
  	if ($civilite == 'mme') $civilite = 'Madame';
  	if ($civilite == 'melle') $civilite = 'Mademoiselle';
  	if ($civilite == 'mr') $civilite = 'Monsieur';
  	$nom = $row[2];
  	$prenom = $row[3];
  	$adresse = ($row[4]!=null || $row[5]!=null || $row[6]!=null)? $row[4]. ' ' .$row[5]. ' ' .$row[6]:'&nbsp;';
  	$numerotel =  $row[7];
  	$email =  $row[8];
  	
    echo "<tr id='client_$reference' onmouseout=\"restaureLigne('client_$reference');\" onmouseover=\"survolLigne('client_$reference');\">";
    echo "<td>$reference</td>";
    echo "<td>$civilite</td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$adresse</td>";
    echo "<td>$numerotel</td>";
    echo "<td>$email</td>";
    echo "<td align=\"right\">";
    echo " <a href=\"?page=clients&action=modifier&ref=$row[0]\">[".ADMIN_CLIENT_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionClient('$row[0]','" . addslashes($nom) . "','" . addslashes($prenom) . "')\">[".ADMIN_CLIENT_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affich_modif_client ($ref)
{
  $requete="SELECT client_reference, client_nom, client_prenom, client_civilite, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email FROM client where client_reference = '$ref'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	$ref = $row[0];
  	$nom = $row[1];
  	$prenom = $row[2];
  	$civilite = $row[3];
  	$adresse = $row[4];
  	$codepostal = $row[5];
  	$commune = $row[6];
  	$numerotel = $row[7];
  	$email = $row[8];
  	
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du client <b>'$nom $prenom'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='ref' name='ref' value='$ref'/></tr>";
	echo "<tr><td>Référence : </td><td>$ref</td></tr>";
	echo "<tr><td>Civilité : </td><td>";
	echo "<select name='civilite' id='civilite' size='1'>";
	echo "<option value='-1'"; if ($civilite == '-1') echo " selected "; echo ">-- Choisir une civilité --</option>";
	echo "<option value='mme'"; if ($civilite == 'mme') echo " selected "; echo ">Madame</option>";
	echo "<option value='melle'"; if ($civilite == 'melle') echo " selected "; echo ">Mademoiselle</option>";
	echo "<option value='mr'"; if ($civilite == 'mr') echo " selected "; echo ">Monsieur</option>";
	echo "</select></td></tr>";
	echo "<tr><td>Nom * : </td><td><input type='text' id='nom' name='nom' value=\"$nom\" size='30'/></td></tr>";
	echo "<tr><td>Prénom * : </td><td><input type='text' id='prenom' name='prenom' value=\"$prenom\" size='30'/></td></tr>";
	echo "<tr><td>N° Téléphone * : </td><td><input type='text' id='tel' name='tel' value=\"$numerotel\" size='30'/></td></tr>";
	echo "<tr><td>Email * : </td><td><input type='text' id='email' name='email' value=\"$email\" size='30'/></td></tr>";
	echo "<tr><td valign='top'>Adresse : </td><td><textarea id='adresse' name='adresse' cols='25'>$adresse</textarea></td></tr>";
	echo "<tr><td>Code postal : </td><td><input type='text' id='cp' name='cp' value=\"$codepostal\" size='30'/></td></tr>";
	echo "<tr><td>Commune : </td><td><input type='text' id='commune' name='commune' value=\"$commune\" size='30'/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_client($mode, $reference, $nom, $prenom, $civilite, $adresse, $codepostal, $commune, $numerotel, $email){
	$requete = "";
	if ($mode == 'creation'){
		$codeClient = random(10);
		$requete = "INSERT INTO client (client_nom, client_prenom, client_civilite, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email, client_code) " .
				"VALUES ('$nom', '$prenom', '$civilite', '$adresse', '$codepostal', '$commune', '$numerotel', '$email', '$codeClient')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE client SET client_nom = '$nom', client_prenom = '$prenom', client_civilite = '$civilite', client_adresse = '$adresse', client_code_postal = '$codepostal', client_commune = '$commune', client_numero_tel = '$numerotel', client_email = '$email' WHERE client_reference = '$reference'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_client($ref){
	$requete = "DELETE FROM client where client_reference = '$ref'";
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_clients($select, $toDisabled){
	
	$requete="SELECT client_reference, client_nom, client_prenom FROM client ORDER by client_nom";
	$resultats=mysql_query($requete) or die (mysql_error());
	
	$disabled = "";
	if ($toDisabled) $disabled = "disabled"; 
	
	echo "<SELECT id='refClient' name='refClient' ".$disabled.">";
	echo "<OPTION value='-1'>-- Sélectionner un client --</OPTION>";
	while ($row = mysql_fetch_array($resultats))
  	{
  		$selected = "";
  		if ($row[0] == $select) $selected = "selected"; 
    	echo "<OPTION value='$row[0]' $selected>$row[1] $row[2] (ref : $row[0])</OPTION>";
  	}
  	echo "</SELECT>";
}
?>
