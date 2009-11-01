<?php

require ('Commande.php');
require ('Client.php');
require ('Produit.php');

class Facture {
	
	var $commande;
	var $client;
	var $produits;
	
	function InitFacture ($idCommande) {
		//init de la commande
		$laCommande = new Commande();
		$laCommande->InitCommande($idCommande);
		$this->commande = $laCommande;
		
		//init du client
		$leClient = new Client();
		$leClient->InitClient($laCommande->idClient);
		$this->client = $leClient;
		
		//init des produits : tableau qui porte comme indice 0, 1, 2... 
		//et comme valeur un objet 'Produit'. On fait un setQuantite avant de le mettre dans le tableau.
		$lesProduits = array();
		$requete = "SELECT lcp_id_produit, lcp_quantite FROM lien_commande_produit WHERE lcp_id_commande = " . $idCommande . "";
		$resultats=mysql_query($requete) or die (mysql_error());
  		$i = 0;
		while ($row = mysql_fetch_array($resultats)) 
  		{
  			$leProduit = new Produit();
  			$leProduit->InitProduit($row[0]);
  			$leProduit->setQuantite($row[1]);
  			$lesProduits[$i] = $leProduit;
  			$i++;
  		}
		$this->produits = $lesProduits;
	}
	
}
?>
