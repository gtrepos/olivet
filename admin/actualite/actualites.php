<font class=olivet><?php echo ADMIN_ACTUALITE_GESTION; ?></font>

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

if ($action=='lister') {include ("lister_actualites.php");}

if ($action=='creer') {include("creer_actualite.php");}

if ($action=='modifier') {include("modifier_actualite.php");}

if ($action=='enregistrer') {
	
	$nouveaute = "";
	
	if (isset($_POST['nouveaute'])) {
		$nouveaute = $_POST['nouveaute'];
	};
	
	enregistrer_actu($_GET['mode'], $_POST['id'], $_POST['libelle'], $_POST['descriptif'], $_POST['type'], $nouveaute);	
}

if ($action=='activer') {
	activer_actualite($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_actualite($_GET['id']);
}

if ($action=='supprimer') {
	supprimer_actu($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') 
	echo "<script type='text/javascript'>window.location='index.php?page=actualites';</script>";

?>



