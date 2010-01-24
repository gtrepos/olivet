<?php

class Client {
	
	var $id;
	var $nom;
	var $prenom;
	var $adresse;
	var $codePostal;
	var $commune;
	var $numeroTel;
	var $email;
	var $civilite;
	
	function InitClient($idClient) {
		$requete = "SELECT client_reference, client_nom, client_prenom, client_adresse, client_code_postal," .
				"client_commune, client_numero_tel, client_email, client_civilite FROM client WHERE client_reference = " . $idClient . "";
		$resultats=mysql_query($requete) or die (mysql_error());
		while ($row = mysql_fetch_array($resultats)) 
  		{
  			$this->id = $row[0];
  			$this->nom = $row[1];
  			$this->prenom = $row[2];	
  			$this->adresse = $row[3];
  			$this->codePostal = $row[4];
  			$this->commune = $row[5];
  			$this->numeroTel = $row[6];
  			$this->email = $row[7];
  			$this->civilite = $row[8];
  			
  			
  		}
	}
	
}

?>
