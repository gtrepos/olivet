<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_CLIENT_REFERENCE; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_NOM; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_PRENOM; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_ADRESSE; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_TEL; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_MAIL; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_clients (); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">	
	<tr>
		<td align="right" colspan="7"><a href="?page=clients&action=creer"><?php echo ADMIN_CLIENT_CREER;?></a></td>
	</tr>
</table>