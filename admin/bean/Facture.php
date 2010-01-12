<?php

require_once('Commande.php');
require_once('../../visiteur/bean/Client.php');
require_once('Conditionnement.php');

class Facture {
	
	var $commande;
	var $client;
	var $conditionnements;
	var $prixTotal;
	
	function InitFacture ($idCommande) {
		//init de la commande
		$laCommande = new Commande();
		$laCommande->InitCommande($idCommande);
		$this->commande = $laCommande;
		
		//init du client
		$leClient = new Client();
		$leClient->InitClient($laCommande->idClient);
		$this->client = $leClient;
		
		//init des conditionnements : tableau qui porte comme indice 0, 1, 2... 
		//et comme valeur un objet 'Conditionnement'. On fait un setQuantite avant de le mettre dans le tableau.
		$lesConditionnements = array();
		$requete = "SELECT lcc_id_cond, lcc_quantite FROM lien_commande_cond WHERE lcc_id_commande = " . $idCommande . "";
		$resultats=mysql_query($requete) or die (mysql_error());
  		$i = 0;
  		$prix = 0;
  		while ($row = mysql_fetch_array($resultats)) 
  		{
  			$leConditionnement = new Conditionnement();
  			$leConditionnement->InitConditionnement($row[0]);
  			$leConditionnement->setQuantite($row[1]);
  			$lesConditionnements[$i] = $leConditionnement;
  			$prixUnite = $leConditionnement->prixConditionnement + $leConditionnement->produitPrixUnite * $leConditionnement->quantiteProduit;
  			$prix = $prix + $prixUnite * $leConditionnement->quantiteConditionnement;
  			$i++;
  		}
		$this->conditionnements = $lesConditionnements;
		$this->prixTotal = $prix;
		
		
	}
	
}
?>
