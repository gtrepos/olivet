<br><font class=olivet><?php echo ADMIN_PRODUIT_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_PRODUIT_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_CATEGORIE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_UNITE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_PRIX_UNITE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_ETAT; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_produits(); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="8"><a href="?page=produits&action=creer"><?php echo ADMIN_PRODUIT_CREER;?></a></td>
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
if ($action=='creer') {include("creer_produit.php");}

if ($action=='modifier') {include("modifier_produit.php");}

if ($action=='enregistrer') {
	
	$id = "";
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	};
	
	enregistrer_produit($_GET['mode'], $id, $_POST['idCategorie'], $_POST['libelle'], $_POST['descriptif'], $_POST['unite'], $_POST['prix_unite']);	
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

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') echo "<script type='text/javascript'>window.location='index.php?page=produits';</script>";

?>



