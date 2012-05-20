<font class=olivet><?php echo ADMIN_PRODUIT_RESA_GESTION; ?></font>

<?php 
if (isset($_GET['action'])){
	$action=$_GET['action'];
}
else {
	$action='lister';
}
?>

<br><br>

<?php

if ($action=='lister') {
	if (isset($_GET['idCategorie'])){
		$_SESSION['idCategorie'] = $_GET['idCategorie'];
	}
	include("lister_produits_resa.php");
}

if ($action=='creer') {include("creer_produit_resa.php");}

if ($action=='modifier') {include("modifier_produit_resa.php");}

if ($action=='enregistrer') {
	
	$id = "";
	$nouveaute = "off";
	$nbStock = -1;
	$aStock = "off";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	};
	
	if (isset($_POST['nouveaute'])) {
		$nouveaute = $_POST['nouveaute'];
	};
	
	if (isset($_POST['a_stock'])) {
		$aStock = $_POST['a_stock'];				
	}
	
	if (isset($_POST['nb_stock'])) {
		if (trim($_POST['nb_stock'])!='')
		$nbStock = $_POST['nb_stock'];				
	}
	
	enregistrer_produit_resa($_GET['mode'], $id, $_POST['idCategorie'], $_POST['libelle'], $_POST['descriptif'], $_POST['photo'], $nouveaute, $aStock, $nbStock, 
		$_POST['rang'], $_POST['dateRecup'], $_POST['dateLimite'], $_POST['dateLimiteCommande'], $_POST['idProducteur']);	
}

if ($action=='activer') {
	activer_produit_resa($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_produit_resa($_GET['id']);
}

if ($action=='enregistrer' || $action=='activer' || $action=='desactiver') {
	
	$id = "";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	};
	
	echo "<script type='text/javascript'>window.location='index.php?page=produitsresa#ancre_".$id."';</script>";
}

?>



