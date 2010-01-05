<?php

function panierCreation(){
	$ret=false;

	if (isset( $_SESSION['panier'])){
		$ret = true;
	}else{
		$_SESSION['panier']=array();
		$_SESSION['panier']['idproduitcond'] = array();
		$_SESSION['panier']['nbarticles'] = array();
		$ret=true;
	}
	return $ret;
}



function panierSetNbArticles($idproduitcond,$nbarticles){
	if (panierCreation()){
		$indexProduit = array_search($idproduitcond,  $_SESSION['panier']['idproduitcond']);
		if ($indexProduit !== false){
			$_SESSION['panier']['nbarticles'][$indexProduit] = $nbarticles ;
		}else{
			array_push( $_SESSION['panier']['idproduitcond'],$idproduitcond);
			array_push( $_SESSION['panier']['nbarticles'],$nbarticles);
		}
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}


function panierMontantTotal(){
	$total = 0;
	if (panierCreation()){
		for($i=0;$i<count($_SESSION['panier']['idproduitcond']);$i++){
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			if($nbarticles>0){
				$tmpres = bddLigneProduit($_SESSION['panier']['idproduitcond'][$i]);
				while ($row = mysql_fetch_array($tmpres)){
					$condPrix = $row[2];
					$condQuantiteProduit = $row[3];
					$produitPrixUnite = $row[6];
					$prixUnitaireProduit = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
					$total  = $total +  $prixUnitaireProduit * $nbarticles ;
				}
			}
		}
		return $total;
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierNbProduitsConditionnes(){
	
}

function panierNbArticles($idproduitcond){
	if (panierCreation()){
		$indexProduit = array_search($idproduitcond, $_SESSION['panier']['idproduitcond']);
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
		for($i=0;$i<count($_SESSION['panier']['idproduitcond']);$i++){
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
		for($i=0;$i<count($_SESSION['panier']['idproduitcond']);$i++){
			$nbarticles = $_SESSION['panier']['nbarticles'][$i];
			if($nbarticles>0){
				$nbproduit++;
				$recap[$nbproduit] = array();
				$tmpres = bddLigneProduit($_SESSION['panier']['idproduitcond'][$i]);
				while ($row = mysql_fetch_array($tmpres)){
					array_push($recap[$nbproduit],$row[1] . " [$row[4]]" );
					array_push($recap[$nbproduit],$nbarticles);
					$condPrix = $row[2];
					$condQuantiteProduit = $row[3];
					$produitPrixUnite = $row[6];
					$prixUnitaireProduit = ($condQuantiteProduit * $produitPrixUnite) + $condPrix;
					array_push($recap[$nbproduit],$prixUnitaireProduit . " &euro;" );
					$soustot = $prixUnitaireProduit * $nbarticles ;
					array_push($recap[$nbproduit],$soustot . " &euro;" );
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
		$_SESSION['panier']['idproduitcond'] = array();
		$_SESSION['panier']['nbarticles'] = array();
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

?>