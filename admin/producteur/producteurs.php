<br><font class=olivet><?php echo ADMIN_PRODUCTEUR_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_PRODUCTEUR_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUCTEUR_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUCTEUR_ADRESSE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUCTEUR_DESCRIPTIF; ?></td>
		<td class=caption><?php echo ADMIN_PRODUCTEUR_RANG; ?></td>
		<td class=caption><?php echo ADMIN_PRODUCTEUR_ETAT; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_producteurs(); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="9"><a href="?page=producteurs&action=creer"><?php echo ADMIN_PRODUCTEUR_CREER;?></a></td>
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
if ($action=='creer') {include("creer_producteur.php");}

if ($action=='modifier') {include("modifier_producteur.php");}

if ($action=='enregistrer') {
	enregistrer_producteur($_GET['mode'], $_POST['id'], $_POST['libelle'], $_POST['adresse'], $_POST['latitude'], $_POST['longitude'], 
							$_POST['descriptif'], $_POST['rang'], $_POST['picto'], $_POST['photo']);	
}

if ($action=='activer') {
	activer_producteur($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_producteur($_GET['id']);
}

if ($action=='supprimer') {
	supprimer_producteur($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') echo "<script type='text/javascript'>window.location='index.php?page=producteurs';</script>";
?>