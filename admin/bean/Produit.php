<?php

class Produit {
	
	var $id;
	var $libelle;
	var $nbStock;
	var $lienPhoto;
	var $descriptifProduction;
	var $nouveaute;
	var $etat;
	var $unite;
	var $prixUnite;
	var $conditionnement;
	var $conditionnementNom;
	var $conditionnementTailleFixe;
	var $conditionnementTaille;
	var $conditionnementTailleSup;
	var $libelleCategorie;
	var $etatCategorie;
	var $quantite;
	
	function InitProduit($idProduit){
		
		$requete = "select produit_id, produit_libelle, produit_nb_stock, produit_lien_photo, produit_descriptif_production, produit_nouveaute, " .
				"produit_etat, produit_unite, produit_prix_unite, produit_conditionnement, produit_conditionnement_nom, produit_conditionnement_taille_fixe, " .
				"produit_conditionnement_taille, produit_conditionnement_taille_sup, categorie_produit_libelle, categorie_produit_etat " .
				"FROM produit, categorie_produit WHERE produit_id_categorie = categorie_produit_id and produit_id = $idProduit";
		
		$resultats=mysql_query($requete) or die (mysql_error());
  
		while ($row = mysql_fetch_array($resultats)) 
	  	{
	  		$this->id = $row[0];
	  		$this->libelle = $row[1];
	  		$this->nbStock = $row[2];	
	  		$this->lienPhoto = $row[3];
	  		$this->descriptifProduction = $row[4];
	  		$this->nouveaute = $row[5];
	  		$this->etat = $row[6];
	  		$this->unite = $row[7];
	  		$this->prixUnite = $row[8];
	  		$this->conditionnement = $row[9];
	  		$this->conditionnementNom = $row[10];
	  		$this->conditionnementTailleFixe = $row[11];
	  		$this->conditionnementTaille = $row[12];
	  		$this->conditionnementTailleSup = $row[13];
	  		$this->libelleCategorie = $row[14];
	  		$this->etatCategorie = $row[15];
	  	}
	}

	function setQuantite($newQuantite){
		$this->quantite = $newQuantite;
	}
	
}

?>

