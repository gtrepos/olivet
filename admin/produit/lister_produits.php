<?php
	$idCategorieFiltre = -1;
	if (isset($_POST['idCategorie'])){
		$idCategorieFiltre=$_POST['idCategorie'];
	}
?>

<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td>
		<form name="filtreProduit" id="filtreProduit" method="post" action="?page=produits&action=lister">
		Catégorie : <?php liste_categories($idCategorieFiltre);?>
		<input type="submit" class="button" name="submitFiltreProduit" value="Filtrer" />
		</form></td>
	</tr>
	<tr>
		<td align="right" colspan="8"><a href="?page=produits&action=creer"><?php echo ADMIN_PRODUIT_CREER;?></a></td>
	</tr>
	
</table>
<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_PRODUIT_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_CATEGORIE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_PRODUCTEUR; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RANG; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_JOURS_DISPOS; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_produits($idCategorieFiltre); ?>
	<tr>
		<td class=caption><?php echo ADMIN_PRODUIT_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_CATEGORIE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_PRODUCTEUR; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RANG; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_JOURS_DISPOS; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="7"><a href="?page=produits&action=creer"><?php echo ADMIN_PRODUIT_CREER;?></a></td>
	</tr>
</table>