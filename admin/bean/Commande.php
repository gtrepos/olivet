<?php

class Commande {
	var $id;
	var $dateCreation;
	var $etat;
	var $idClient;

	function InitCommande($idCommande) {
		$requete = "SELECT commande_id, commande_datecreation, commande_etat, commande_id_client FROM commande WHERE commande_id = " . $idCommande . "";
		$resultats=mysql_query($requete) or die (mysql_error());
		while ($row = mysql_fetch_array($resultats)) 
  		{
  			$this->id = $row[0];
  			$this->dateCreation = $row[1];
  			$this->etat = $row[2];
  			$this->idClient = $row[3];
  		}
	}

}


?>
