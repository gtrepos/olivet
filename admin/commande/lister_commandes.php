<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_COMMANDE_ID; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_CLIENT; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_RESUME; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_DATE_CREATION; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_DATE_ANNULATION; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_SOMME; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_commandes (); ?>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="8"><a href="?page=commandes&action=creer"><?php echo ADMIN_COMMANDE_CREER;?></a></td>
	</tr>
</table>