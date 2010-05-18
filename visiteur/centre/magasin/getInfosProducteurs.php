<?php
require_once("../../../tools/JSON.php");
require_once("../../../tools/config.php");
ouverture();
  
  
    
    $requete=
		"SELECT producteur_id, producteur_libelle, producteur_adresse, producteur_latitude, producteur_longitude, " .
		"producteur_descriptif, producteur_rang, producteur_etat, producteur_picto, producteur_photo " .
		"FROM producteur WHERE producteur_etat = 1 ORDER by producteur_rang";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  // Create the array
    $producteurs = array();

	while ($row = mysql_fetch_array($resultats))  {
		
		$id = $row[0]; 
		$libelle = $row[1];
		$adresse = $row[2];
		$latitude = $row[3];
		$longitude = $row[4];
		$descriptif = $row[5];
		$rang = $row[6];	
		$etat = $row[7];  
		$picto = $row[8];
		$photo = $row[9];
    
    	$producteurs[] = array("id" => $id, "libelle" => $libelle, "adresse" => $adresse, "latitude" => $latitude, 
							   "longitude" => $longitude, "descriptif" => $descriptif, "rang" => $rang, "etat" => $etat, 
							   "picto" => $picto, "photo" => $photo);    	
  	}
  	
    // Encode the array in JSON format
    //$producteursJSON = json_encode($producteurs);
    $json = new Services_JSON(); 
    $producteursJSON = $json->encode($producteurs);
    

    // Return the data to the caller
    echo $producteursJSON;
  
  
  
?>