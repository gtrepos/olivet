<?php
function affich_abonnes_newsletter()
{
  $requete=
		"SELECT email_abonnement, date_abonnement FROM abonnement_newsletter ORDER by email_abonnement";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	$email = $row[0]; 
	$date = $row[1];
	
    echo "<tr id='$email' onmouseout=\"restaureLigne('$email');\" onmouseover=\"survolLigne('$email');\">";
    echo "<td>$email</td>";
    echo "<td>$date</td>";
    echo "<td align=\"right\">";
    echo "<a href=\"\" onclick=\"alerteSuppressionAbonne('$email')\">Supprimer</a>";
    echo "</td>";
    echo "</tr>";
  }
}

function supprimer_abonne_newsletter($email){
	$requete = "DELETE FROM abonnement_newsletter where email_abonnement = '$email'";
	$result=mysql_query($requete) or die (mysql_error());
}


?>