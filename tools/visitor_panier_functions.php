<?php

/**
 * @brief création du panier. La structure signifie :
 * Pour un produit_resa ou un conditionnement i :
 * $_SESSSION['panier']['cond'][i] est à 0 si c'est produit_resa ou 1 sinon
 * $_SESSSION['panier']['id'][i] est l'id du produit_resa ou l'id du conditionnement
 * $_SESSSION['panier']['nbarticles'][i] est le nmbre d'articles pris
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
		$_SESSION['panier']['nbarticles'] = array();
		$ret=true;
	}
	return $ret;
}

/**
 * met à jour le panier
 * @param $cond 0 si c'est un produit_resa, 1 sinon
 * @param $id id produit_resa ou conditionnement
 * @param $nbarticles le nbre d'articles
 * @return void
 */
function panierSetNbArticles($cond, $id, $nbarticles){
	if (panierCreation()){
		$indexCondOuResa = array_search($id,  $_SESSION['panier']['id']);
		if ($indexCondOuResa !== false){
			if($cond !==  $_SESSION['panier']['cond'][$indexCondOuResa]){
				echo "Un problème est survenu veuillez contacter l'administrateur du site.";
			}
			$_SESSION['panier']['nbarticles'][$indexCondOuResa] = $nbarticles ;
		}else{
			array_push( $_SESSION['panier']['cond'],$cond);
			array_push( $_SESSION['panier']['id'],$id);
			array_push( $_SESSION['panier']['nbarticles'],$nbarticles);
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
				$nbarticles_panier = $_SESSION['panier']['nbarticles'][$i];
				if($nbarticles_panier>0){
					$tmpres = bddLigneProdCond($_SESSION['panier']['id'][$i]);
					while ($row = mysql_fetch_array($tmpres)){
						$cond_id = $row[0];
						$cond_nom = $row[1];
						$cond_prix= $row[2];
						$cond_quantite_produit= $row[3];
						$produit_libelle= $row[4];
						$produit_unite= $row[5];
						$produit_prix_unite= $row[6];
						$produit_id_categorie= $row[7];
						$prixUnitaireCond = $cond_prix + ($cond_quantite_produit + $produit_prix_unite);
						$prixTotalCond = $nbarticles_panier * $prixUnitaireCond;
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
				if($_SESSION['panier']['nbarticles'][$i] > 0){
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
				if($_SESSION['panier']['nbarticles'][$i] > 0){
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

function panierNbArticlesProdsCond($id_cond){
	if (panierCreation()){
		$indexCondOuResa = array_search($id_cond, $_SESSION['panier']['id']);
		if ($indexCondOuResa !== false){
			if($_SESSION['panier']['cond'][$indexCondOuResa] !== 1){
				echo "ERROR panierNbArticlesProdsCond--1";
			}
			return $_SESSION['panier']['nbarticles'][$indexCondOuResa];
		}else{
			return 0;
		}
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

function panierVider(){
	if (panierCreation()){
		$_SESSION['panier']=array();
		$_SESSION['panier']['cond'] = array();
		$_SESSION['panier']['id'] = array();
		$_SESSION['panier']['nbarticles'] = array();
	}else{
		echo "Un problème est survenu veuillez contacter l'administrateur du site.";
	}
}

?>