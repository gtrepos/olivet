<br><font class=olivet><?php echo ADMIN_CONDITIONNEMENT_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_ID; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRODUIT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NOM; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NBSTOCK; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NOUVEAUTE; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRIX_GLOBAL; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_QUANTITEPRODUIT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRIX; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_conditionnements(); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="10"><a href="?page=conditionnements&action=creer"><?php echo ADMIN_CONDITIONNEMENT_CREER;?></a></td>
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
if ($action=='creer') {include("creer_conditionnement.php");}

if ($action=='modifier') {include("modifier_conditionnement.php");}

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
	
	enregistrer_conditionnement($_GET['mode'], $id, $_POST['idProduit'], $_POST['nom'], $nouveaute, 
								$_POST['prix_cond'], $_POST['quantite_produit'], $aStock, $nbStock);
}

if ($action=='activer') {
	activer_conditionnement($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_conditionnement($_GET['id']);
}

if ($action=='supprimer') {
	supprimer_conditionnement($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') echo "<script type='text/javascript'>window.location='index.php?page=conditionnements';</script>";

?>



