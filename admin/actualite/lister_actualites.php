<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_ACTUALITE_ID; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_DESCRIPTIF; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_DATECREATION; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_DATEMODIFICATION; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_TYPE; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_NOUVEAUTE; ?></td>
		<td class=caption><?php echo ADMIN_ACTUALITE_ETAT; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_actualites(); ?>
</table>	
<table class=olivet width="90%" cellspacing="1" cellspacing="0">	
	<tr>
		<td align="right" colspan="9"><a href="?page=actualites&action=creer"><?php echo ADMIN_ACTUALITE_CREER;?></a></td>
	</tr>
</table>