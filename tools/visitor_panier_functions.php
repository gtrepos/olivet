<?php

function creationPanier(){
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



function setNbArticles($idproduit,$nbarticles){
	if (creationPanier()){
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

function getPanier(){
	$resume = array();

	if (creationPanier()){
		for($i=0;$i<count($_SESSION['panier']['idproduit']);$i++){
			$libelle = $_SESSION['panier']['idproduit'][$i];
			$nb = $_SESSION['panier']['nbarticles'][$i];
			$resume[$i]= array();
			array_push($resume[$i],$libelle);
			array_push($resume[$i],$nb);
		}
		return $resume;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierMontantTotal(){
	$total = 0;
	if (creationPanier()){
		for($i=0;$i<count($_SESSION['panier']['idproduit']);$i++){
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			$tmpres = bddLigneProduit($_SESSION['panier']['idproduit'][$i]);
			while ($row = mysql_fetch_array($tmpres)){
				$total  = $total +  $row[8] * $nbarticles ;
			}
		}
		return $total;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierNbProduits(){
	if (creationPanier()){
		return count($_SESSION['panier']['idproduit']);
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}
function panierCommande(){
	$recap = array();
	if (creationPanier()){
		
		for($i=0;$i<count($_SESSION['panier']['idproduit']);$i++){
			$tmpres = bddLigneProduit($_SESSION['panier']['idproduit'][$i]);
			$recap[$i] = array();
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			while ($row = mysql_fetch_array($tmpres)){
				array_push($recap[$i],$row[2]);
				array_push($recap[$i],$nbarticles);
				array_push($recap[$i],$row[7]);
				array_push($recap[$i],$row[8]);
				$soustot = $row[8] * $nbarticles ;
				array_push($recap[$i],$soustot);	
			}
		}
		return $recap;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}

}

function panierVider(){
	if (creationPanier()){
		$_SESSION['panier']=array();
		$_SESSION['panier']['idproduit'] = array();
		$_SESSION['panier']['nbarticles'] = array();
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

?>