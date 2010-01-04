<br><font class=olivet><?php echo ADMIN_PRODUIT_RESA_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_ETAT; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_produits_resa(); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="5"><a href="?page=produitsresa&action=creer"><?php echo ADMIN_PRODUIT_RESA_CREER;?></a></td>
	</tr>
</table>

<?php 
if (isset($_GET['action'])){
	$action=$_GET['action'];
}
else {
	$action='creer';
}
?>

<br><br>

<?php
if ($action=='creer') {include("creer_produit_resa.php");}

if ($action=='modifier') {include("modifier_produit_resa.php");}

if ($action=='enregistrer') {
	
	$id = "";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	};
	
	enregistrer_produit_resa($_GET['mode'], $id, $_POST['libelle'], $_POST['descriptif'], $_POST['photo']);	
}

if ($action=='activer') {
	activer_produit_resa($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_produit_resa($_GET['id']);
}

if ($action=='supprimer') {
	supprimer_produit_resa($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') echo "<script type='text/javascript'>window.location='index.php?page=produitsresa';</script>";

?>



