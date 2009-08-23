<?php

function panierCreation(){
	$ret=false;

	if (isset( $_SESSION['panier'])){
		$ret = true;
	}else{
		$_SESSION['panier']=array();
		$_SESSION['panier']['idproduit'] = array();
		$_SESSION['panier']['nbarticles'] = array();
		$ret=true;
	}
	return $ret;
}



function panierSetNbArticles($idproduit,$nbarticles){
	if (panierCreation()){
		$indexProduit = array_search($idproduit,  $_SESSION['panier']['idproduit']);
		if ($indexProduit !== false){
			$_SESSION['panier']['nbarticles'][$indexProduit] = $nbarticles ;
		}else{
			array_push( $_SESSION['panier']['idproduit'],$idproduit);
			array_push( $_SESSION['panier']['nbarticles'],$nbarticles);
		}
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}


function panierMontantTotal(){
	$total = 0;
	if (panierCreation()){
		for($i=0;$i<count($_SESSION['panier']['idproduit']);$i++){
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			if($nbarticles>0){
				$tmpres = bddLigneProduit($_SESSION['panier']['idproduit'][$i]);
				while ($row = mysql_fetch_array($tmpres)){
					$total  = $total +  $row[8] * $nbarticles ;
				}
			}
		}
		return $total;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierNbArticles($idproduit){
	if (panierCreation()){
		$indexProduit = array_search($idproduit, $_SESSION['panier']['idproduit']);
		if ($indexProduit !== false){
			return $_SESSION['panier']['nbarticles'][$indexProduit];
		}else{
			return 0;
		}
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}
function panierNbProduits(){
	if (panierCreation()){
		$nbproduits = 0;
		for($i=0;$i<count($_SESSION['panier']['idproduit']);$i++){
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			if($nbarticles>0){
				$nbproduits++;
			}
		}
		return $nbproduits;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}
function panierCommande(){
	$recap = array();
	if (panierCreation()){
		$nbproduit=-1;
		for($i=0;$i<count($_SESSION['panier']['idproduit']);$i++){
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			if($nbarticles>0){
				$nbproduit++;
				$recap[$nbproduit] = array();
				$tmpres = bddLigneProduit($_SESSION['panier']['idproduit'][$i]);
				while ($row = mysql_fetch_array($tmpres)){
					array_push($recap[$nbproduit],$row[2]);
					array_push($recap[$nbproduit],$nbarticles);
					array_push($recap[$nbproduit],$row[7]);
					array_push($recap[$nbproduit],$row[8]);
					$soustot = $row[8] * $nbarticles ;
					array_push($recap[$nbproduit],$soustot);
				}
			}
		}
		return $recap;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}

}

function panierVider(){
	if (panierCreation()){
		$_SESSION['panier']=array();
		$_SESSION['panier']['idproduit'] = array();
		$_SESSION['panier']['nbarticles'] = array();
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

?>