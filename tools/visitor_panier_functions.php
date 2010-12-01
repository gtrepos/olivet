<?php

/**
 * @brief création du panier. La structure signifie :
 * Pour un produit_resa ou un conditionnement i :
 * $_SESSSION['panier']['cond'][i] est à 0 si c'est produit_resa ou 1 sinon
 * $_SESSSION['panier']['id'][i] est l'id du produit_resa ou l'id du conditionnement
 * $_SESSSION['panier']['quantite'][i] est la quantite de produit selectionnee
 *
 * @return true si le panier existe ou la creation n'a pas posée de probleme
 */
function panierCreation(){
	$ret=false;

	if (isset( $_SESSION['panier'])){
		$ret = true;
	}else{
		$_SESSION['panier']=array();
		$_SESSION['panier']['cond'] = array();
		$_SESSION['panier']['id'] = array();
		$_SESSION['panier']['quantite'] = array();
		$ret=true;
	}
	return $ret;
}


/**
 * 
 */
function panierPlot(){
	echo(" panier : <br> ");
	for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
		
		$cond = $_SESSION['panier']['cond'][$i];
		$id = $_SESSION['panier']['id'][$i];
		$quantite = $_SESSION['panier']['quantite'][$i];
		
		echo(" $cond , $id , $quantite <br>");  
//		$_SESSION['panier']['id'][$i] , $_SESSION['panier']['quantite'][$i] <br>");
	}
}
/**
 * met à jour le panier
 * @param $cond 0 si c'est un produit_resa, 1 sinon
 * @param $id id produit_resa ou conditionnement
 * @param $quantite la quantite de produit
 * @return void
 */
function panierSetQuantite($cond, $id, $quantite){
	if (panierCreation()){
		$found = false;
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if(($_SESSION['panier']['cond'][$i] == $cond) &&
			($_SESSION['panier']['id'][$i] == $id)){
				$_SESSION['panier']['quantite'][$i] = $quantite ;
				$found = true;
			} 
		}
		if(!$found){
			array_push( $_SESSION['panier']['cond'],$cond);
			array_push( $_SESSION['panier']['id'],$id);
			array_push( $_SESSION['panier']['quantite'],$quantite);
		}
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

/**
 *
 * @return unknown_type
 */
function panierMontantTotalProdsCond(){
	if (panierCreation()){
		$total = 0;
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if($_SESSION['panier']['cond'][$i] == 1){
				$quantite_panier = $_SESSION['panier']['quantite'][$i];
				if($quantite_panier>0){
					$tmpres = bddLigneProdCond($_SESSION['panier']['id'][$i]);
					while ($row = mysql_fetch_array($tmpres)){
						$cond_id = $row[0];
						$cond_nom = $row[1];
						$cond_prix= $row[2];
						$cond_remise= $row[3];
						$produit_libelle= $row[4];
						$produit_id_categorie= $row[5];
						$prixUnitaireCond = $cond_prix - $cond_remise;
						$prixTotalCond = $quantite_panier * $prixUnitaireCond;
						$total  = $total +  $prixTotalCond ;
					}
				}
			}
		}
		return $total;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierNbProdsCond(){
	if (panierCreation()){
		$nb = 0;
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if($_SESSION['panier']['cond'][$i] == 1){
				if($_SESSION['panier']['quantite'][$i] > 0){
					$nb++;
				}
			}
		}
		return $nb;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}



function panierNbProdsResa(){
	if (panierCreation()){
		$nb = 0;
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if($_SESSION['panier']['cond'][$i] == 0){
				if($_SESSION['panier']['quantite'][$i] > 0){
					$nb++;
				}
			}
		}
		return $nb;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}



function panierNbProduits(){
	return panierNbProdsResa() + panierNbProdsCond();
}

function panierSelProdsCond(){
	if (panierCreation()){
		$prodsConds = false;
		$nb = 0;
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if($_SESSION['panier']['cond'][$i] == 1){
				if($_SESSION['panier']['quantite'][$i] > 0){
					$id = $_SESSION['panier']['id'][$i];
					$qtite = $_SESSION['panier']['quantite'][$i];
					$prodsConds[$nb]["id"]= $id;
					$prodsConds[$nb]["qtite"]= $qtite;
					$nb ++;
				}
			}
		}
		return $prodsConds;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierSelProdsResa(){
	if (panierCreation()){
		$prodsResa = false;
		$nb = 0;
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if($_SESSION['panier']['cond'][$i] == 0){
				if($_SESSION['panier']['quantite'][$i] > 0){
					$id = $_SESSION['panier']['id'][$i];
					$qtite = $_SESSION['panier']['quantite'][$i];
					$prodsResa[$nb]["id"]= $id;
					$prodsResa[$nb]["qtite"]= $qtite;
					$nb ++;
				}
			}
		}
		return $prodsResa;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

/**
 * @param $id_cond le conditonnement 
 * @return le nombre d'articles selectionnés pour un
 * produit conditionné
 */

function panierQuantiteProdsCond($id_cond){
	if (panierCreation()){
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if(($_SESSION['panier']['cond'][$i] == 1) &&
			($_SESSION['panier']['id'][$i] == $id_cond)){
				return $_SESSION['panier']['quantite'][$i];
			} 
		}
		return 0;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

/**
 * @param $id_prod_resa l'id d'un produit a la reservation
 * @return le nombre d'article selectionnes pour $id_prod_resa
 */
function panierQuantiteProdsResa($id_prod_resa){
	if (panierCreation()){
		for($i=0;$i<count($_SESSION['panier']['cond']);$i++){
			if(($_SESSION['panier']['cond'][$i] == 0) &&
			($_SESSION['panier']['id'][$i] == $id_prod_resa)){
				return $_SESSION['panier']['quantite'][$i];
			} 
		}
		return 0;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}


function panierVider(){
	if (panierCreation()){
		$_SESSION['panier']=array();
		$_SESSION['panier']['cond'] = array();
		$_SESSION['panier']['id'] = array();
		$_SESSION['panier']['quantite'] = array();
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

?>