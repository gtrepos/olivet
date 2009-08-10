<br><font class=olivet><?php echo ADMIN_ACTUALITE_GESTION; ?></font><br><br>

<table class=olivet cellspacing="0" width="90%">
	<tr>
		<td class=olivet2><?php echo ADMIN_ACTUALITE_ID; ?></td>
		<td class=olivet2><?php echo ADMIN_ACTUALITE_LIBELLE; ?></td>
		<td class=olivet2><?php echo ADMIN_ACTUALITE_DESCRIPTIF; ?></td>
		<td class=olivet2><?php echo ADMIN_ACTUALITE_DATECREATION; ?></td>
		<td class=olivet2><?php echo ADMIN_ACTUALITE_DATEMODIFICATION; ?></td>
		<td class=olivet2></td>
	</tr>
	<?php affich_actualites(); ?>
	<tr>
		<td align="right" colspan="6"><a href="?page=actualites&action=creer"><?php echo ADMIN_ACTUALITE_CREER;?></a></td>
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
if ($action=='creer') {include("creer_actualite.php");}

if ($action=='modifier') {include("modifier_actualite.php");}

if ($action=='enregistrer') {
	enregistrer_actu($_GET['mode'], $_POST['id'], $_POST['libelle'], $_POST['descriptif']);	
}

if ($action=='supprimer') {
	supprimer_actu($_GET['id']);
}

if ($action=='enregistrer' || $action=='supprimer') echo "<script type='text/javascript'>window.location='index.php?page=actualites';</script>";
?>



