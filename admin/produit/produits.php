<br><font class=olivet><?php echo ADMIN_PRODUIT_GESTION; ?></font><br><br>

<table class=olivet cellspacing="0" width="90%">
	<tr>
		<td class=olivet2><?php echo ADMIN_PRODUIT_ID; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_CATEGORIE; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_LIBELLE; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_DESCRIPTIF; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_CONDITIONNEMENT; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_PRIX_UNITE; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_NOUVEAUTE; ?></td>
		<td class=olivet2><?php echo ADMIN_PRODUIT_ETAT; ?></td>
		<td class=olivet2></td>
	</tr>
	<?php affich_produits(); ?>
	<tr>
		<td align="right" colspan="10"><a href="?page=produits&action=creer"><?php echo ADMIN_PRODUIT_CREER;?></a></td>
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
	enregistrer_produit($_GET['mode'], $_POST['id'], $_POST['idCategorie'], $_POST['libelle'], $_POST['descriptif'], $_POST['conditionnement'], $_POST['nouveaute'], $_POST['unite'], $_POST['prix']);	
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



