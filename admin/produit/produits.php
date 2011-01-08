<font class=olivet><?php echo ADMIN_PRODUIT_GESTION; ?></font>

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
if ($action=='lister') {include("lister_produits.php");}

if ($action=='creer') {include("creer_produit.php");}

if ($action=='modifier') {include("modifier_produit.php");}

if ($action=='enregistrer') {
	
	$id = "";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	};
	
	enregistrer_produit($_GET['mode'], $id, $_POST['idCategorie'], $_POST['libelle'], $_POST['descriptif'], $_POST['photo'], 
		$_POST['rang'], $_POST['concatJoursDispos'], $_POST['idProducteur']);	
}

if ($action=='activer') {
	activer_produit($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_produit($_GET['id']);
}

if ($action=='supprimer') {
	supprimer_produit($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') {
	
	$id = "";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	};
	
	echo "<script type='text/javascript'>window.location='index.php?page=produits#ancre_".$id."';</script>";
}

?>



