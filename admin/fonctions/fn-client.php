<?php
function affich_clients ($nom, $prenom, $commune)
{
  $select="SELECT client_reference, client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email ";
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
  	
  	$adresse = ($row[3]!=null || $row[4]!=null || $row[5]!=null)? $row[3]. ' ' .$row[4]. ' ' .$row[5]:'&nbsp;';
  	
    echo "<tr id='client_$row[0]' onmouseout=\"restaureLigne('client_$row[0]');\" onmouseover=\"survolLigne('client_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$adresse</td>";
    echo "<td>$row[6]</td>";
    echo "<td>$row[7]</td>";
    echo "<td align=\"right\">";
    echo " <a href=\"?page=clients&action=modifier&ref=$row[0]\">[".ADMIN_CLIENT_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionClient('$row[0]','$row[1]','$row[2]')\">[".ADMIN_CLIENT_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affich_modif_client ($ref)
{
  $requete="SELECT client_reference, client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email FROM client where client_reference = '$ref'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du client <b>'$row[1] $row[2]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='ref' name='ref' value='$row[0]'/></tr>";
	echo "<tr><td>Référence : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Nom : </td><td><input type='text' id='nom' name='nom' value='$row[1]' size='30'/></td></tr>";
	echo "<tr><td>Prénom : </td><td><input type='text' id='prenom' name='prenom' value='$row[2]' size='30'/></td></tr>";
	echo "<tr><td valign='top'>Adresse : </td><td><textarea id='adresse' name='adresse' cols='25'>$row[3]</textarea></td></tr>";
	echo "<tr><td>Code postal : </td><td><input type='text' id='cp' name='cp' value='$row[4]' size='30'/></td></tr>";
	echo "<tr><td>Commune : </td><td><input type='text' id='commune' name='commune' value='$row[5]' size='30'/></td></tr>";
	echo "<tr><td>N° Téléphone : </td><td><input type='text' id='tel' name='tel' value='$row[6]' size='30'/></td></tr>";
	echo "<tr><td>Email : </td><td><input type='text' id='email' name='email' value='$row[7]' size='30'/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_client($mode, $reference, $nom, $prenom, $adresse, $codepostal, $commune, $numerotel, $email){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO client (client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email) VALUES ('$nom', '$prenom', '$adresse', '$codepostal', '$commune', '$numerotel', '$email')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE client SET client_nom = '$nom', client_prenom = '$prenom', client_adresse = '$adresse', client_code_postal = '$codepostal', client_commune = '$commune', client_numero_tel = '$numerotel', client_email = '$email' WHERE client_reference = '$reference'";
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
