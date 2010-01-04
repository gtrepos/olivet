<?php

class Conditionnement {
	
	var $idConditionnement;
	var $nbStock;
	var $nouveauteConditionnement;
	var $etatConditionnement;
	var $prixConditionnement;
	var $nomConditionnement;
	var $quantiteProduit;
	var $quantiteConditionnement;
	var $libelleCategorie;
	var $libelleProduit;
	var $produitPrixUnite;
	var $produitUnite;
	
	function InitConditionnement($idConditionnement){
		
		$requete = "select cond_id, cond_nb_stock, cond_nouveaute, cond_etat, cond_prix, cond_nom, cond_quantite_produit, " .
				"categorie_produit_libelle, produit_libelle, produit_prix_unite, produit_unite " .
				"FROM categorie_produit, produit, conditionnement WHERE produit_id_categorie = categorie_produit_id " .
				"and cond_id_produit = produit_id and cond_id = $idConditionnement";
		
		$resultats=mysql_query($requete) or die (mysql_error());
  
		while ($row = mysql_fetch_array($resultats)) 
	  	{
	  		$this->idConditionnement = $row[0];
	  		$this->nbStock = $row[1];	
	  		$this->nouveauteConditionnement = $row[2];
	  		$this->etatConditionnement = $row[3];
	  		$this->prixConditionnement = $row[4];
	  		$this->nomConditionnement = $row[5];
	  		$this->quantiteProduit = $row[6];
	  		$this->libelleCategorie = $row[7];
	  		$this->libelleProduit = $row[8];
	  		$this->produitPrixUnite = $row[9];
	  		$this->produitUnite = $row[10];
	  	}
	}

	function setQuantite($newQuantite){
		$this->quantiteConditionnement = $newQuantite;
	}
	
}

?>

