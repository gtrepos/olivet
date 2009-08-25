<br><font class=olivet><?php echo ADMIN_PARTENAIRE_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_PARTENAIRE_ID; ?></td>
		<td class=caption><?php echo ADMIN_PARTENAIRE_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PARTENAIRE_DESCRIPTIF; ?></td>
		<td class=caption><?php echo ADMIN_PARTENAIRE_IMGLOGO; ?></td>
		<td class=caption><?php echo ADMIN_PARTENAIRE_SITEWEB; ?></td>
		<td class=caption><?php echo ADMIN_PARTENAIRE_RANG; ?></td>
		<td class=caption><?php echo ADMIN_PARTENAIRE_ETAT; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_partenaires(); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">	
	<tr>
		<td align="right" colspan="8"><a href="?page=partenaires&action=creer"><?php echo ADMIN_PARTENAIRE_CREER;?></a></td>
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
if ($action=='creer') {include("creer_partenaire.php");}

if ($action=='modifier') {include("modifier_partenaire.php");}

if ($action=='enregistrer') {
	enregistrer_partenaire($_GET['mode'], $_POST['id'], $_POST['libelle'], $_POST['descriptif'], $_POST['imglogo'], $_POST['siteweb'], $_POST['rang']);	
}

if ($action=='activer') {
	activer_partenaire($_GET['id']);
}

if ($action=='desactiver') {
	desactiver_partenaire($_GET['id']);
}

if ($action=='supprimer') {
	supprimer_partenaire($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer' || $action=='activer' || $action=='desactiver') echo "<script type='text/javascript'>window.location='index.php?page=partenaires';</script>";
?>



