<br><font class=olivet><?php echo ADMIN_COMMANDE_GESTION; ?></font><br><br>

<?php 
if (isset($_GET['action'])){
	$action=$_GET['action'];
}
else {
	$action='lister';
}
?>

<?php

if ($action=='lister') {include ("lister_commandes.php");}

if ($action=='creer') {include("creer_commande.php");}

if ($action=='modifier') {include("modifier_commande.php");}

if ($action=='enregistrer') {
	enregistrer_commande();	
}

if ($action=='supprimer') {
	supprimer_commande($_GET['ref']);
}

if ($action=='enregistrer' || $action=='supprimer') echo "<script type='text/javascript'>window.location='index.php?page=clients';</script>";
?>



