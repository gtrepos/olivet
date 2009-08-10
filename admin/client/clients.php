<br><font class=olivet><?php echo ADMIN_CLIENT_GESTION; ?></font><br><br>

<table class=olivet cellspacing="0" width="90%">
	<tr>
		<td class=olivet2><?php echo ADMIN_CLIENT_REFERENCE; ?></td>
		<td class=olivet2><?php echo ADMIN_CLIENT_NOM; ?></td>
		<td class=olivet2><?php echo ADMIN_CLIENT_PRENOM; ?></td>
		<td class=olivet2><?php echo ADMIN_CLIENT_ADRESSE; ?></td>
		<td class=olivet2><?php echo ADMIN_CLIENT_TEL; ?></td>
		<td class=olivet2><?php echo ADMIN_CLIENT_MAIL; ?></td>
		<td class=olivet2></td>
	</tr>
	<?php affich_clients (); ?>
	<tr>
		<td align="right" colspan="7"><a href="?page=clients&action=creer"><?php echo ADMIN_CLIENT_CREER;?></a></td>
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
if ($action=='creer') {include("creer_client.php");}

if ($action=='modifier') {include("modifier_client.php");}

if ($action=='enregistrer') {
	enregistrer_client($_GET['mode'], $_POST['ref'], $_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['commune'], $_POST['tel'], $_POST['email']);	
}

if ($action=='supprimer') {
	supprimer_client($_GET['ref']);
}

if ($action=='enregistrer' || $action=='supprimer') echo "<script type='text/javascript'>window.location='index.php?page=clients';</script>";
?>



