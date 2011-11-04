<font class=olivet><?php echo ADMIN_ABONNE_NEWSLETTER_GESTION; ?></font><br><br>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_ABONNE_NEWSLETTER_EMAIL; ?></td>
		<td class=caption><?php echo ADMIN_ABONNE_NEWSLETTER_DATE; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_abonnes_newsletter(); ?>
</table>

<?php 
if (isset($_GET['action'])){
	$action=$_GET['action'];
}
else {
	$action="";
}
?>

<br><br>

<?php

if ($action=='supprimer') {
	supprimer_abonne_newsletter($_GET['email']);
}

?>