<br><font class=olivet><?php echo ADMIN_CLIENT_GESTION; ?></font>

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

if ($action=='lister') {include("lister_clients.php");}

if ($action=='creer') {include("creer_client.php");}

if ($action=='modifier') {include("modifier_client.php");}

if ($action=='enregistrer') {
	
	$ref = "";
	if (isset($_POST['ref'])) {
		$ref = $_POST['ref'];
	}
	
	enregistrer_client($_GET['mode'], $ref, $_POST['nom'], $_POST['prenom'], $_POST['civilite'], $_POST['adresse'], $_POST['cp'], $_POST['commune'], $_POST['tel'], $_POST['email']);	
}

if ($action=='supprimer') {
	supprimer_client($_GET['ref']);
}

if ($action=='enregistrer' || $action=='supprimer') echo "<script type='text/javascript'>window.location='index.php?page=clients';</script>";
?>



