<font class=olivet><?php echo ADMIN_CATEGORIE_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_CATEGORIE_ID; ?></td>
		<td class=caption><?php echo ADMIN_CATEGORIE_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_CATEGORIE_ETAT; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_categories(); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">	
	<tr>
		<td align="right" colspan="4"><a href="?page=categories&action=creer"><?php echo ADMIN_CATEGORIE_CREER;?></a></td>
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
if ($action=='creer') {include("creer_categorie.php");}

if ($action=='modifier') {include("modifier_categorie.php");}

if ($action=='enregistrer') {
	enregistrer_categorie($_GET['mode'], $_POST['id'], $_POST['libelle']);	
}

if ($action=='activer') {
	activer_categorie($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_categorie($_GET['id']);
}

if ($action=='enregistrer' || $action=='activer' || $action=='desactiver') echo "<script type='text/javascript'>window.location='index.php?page=categories';</script>";

?>



