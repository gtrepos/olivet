<font class=olivet><?php echo ADMIN_COMMANDE_GESTION; ?></font><br><br>
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

if ($action=='enregistrer' && $_GET['mode']=='creation') {
	creer_commande($_POST['recapCommandeCond'], $_POST['recapCommandeProduitResa'], $_POST['refClient'], $_POST['daterecup']);
}

if ($action=='enregistrer' && $_GET['mode']=='modification') {
	modifier_commande($_POST['recapCommandeCond'], $_POST['recapCommandeProduitResa'], $_POST['idCommande'], $_POST['refClient'], $_POST['daterecup']);
}

if ($action=='enregistrer') echo "<script type='text/javascript'>window.location='./?page=commandes';</script>";

?>



