<font class=olivet><?php echo ADMIN_CONDITIONNEMENT_GESTION; ?></font>

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
	include("lister_conditionnements.php");
}

if ($action=='creer') {include("creer_conditionnement.php");}

if ($action=='modifier') {include("modifier_conditionnement.php");}

if ($action=='enregistrer') {
	
	$id = "";
	$nouveaute = "off";
	$divisible = "off";
	$nbStock = -1;
	$aStock = "off";
	$remise = 0;
	$tva = $_POST['tva'];
	$rang = $_POST['rang'];
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	};
	
	if (isset($_POST['nouveaute'])) {
		$nouveaute = $_POST['nouveaute'];
	};
	
	if (isset($_POST['divisible'])) {
		$divisible = $_POST['divisible'];
	};
	
	if (isset($_POST['a_stock'])) {
		$aStock = $_POST['a_stock'];				
	}
	
	if (isset($_POST['nb_stock'])) {
		if (trim($_POST['nb_stock'])!='')
		$nbStock = $_POST['nb_stock'];				
	}
	
	if (isset($_POST['remise'])) {
		if (trim($_POST['remise'])!='')
		$remise = $_POST['remise'];
	}
	
	enregistrer_conditionnement($_GET['mode'], $id, $_POST['idProduit'], $_POST['nom'], $nouveaute, 
								$_POST['prix_cond'], $aStock, $nbStock, $divisible, $remise, $tva, $rang);
}

if ($action=='activer') {
	activer_conditionnement($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_conditionnement($_GET['id']);
}

if ($action=='enregistrer' || $action=='activer' || $action=='desactiver') { 
	
	$id = "";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	};
	
	echo "<script type='text/javascript'>window.location='index.php?page=conditionnements#ancre_".$id."'</script>";
}

?>



