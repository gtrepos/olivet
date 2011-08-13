<?php 
	if ( session_id() == '' ) { // no session has been started yet, which is needed for validation
		session_start();
	}
	$idCategorieFiltre = -1;
	if (isset($_SESSION['idCategorie'])){
		$idCategorieFiltre=$_SESSION['idCategorie'];
	}
	else if (isset($_POST['idCategorie'])){
		$idCategorieFiltre=$_POST['idCategorie'];
	}
	$redirect = 'produits';
?>

<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td>
		<form name="filtreCategorie" id="filtreCategorie" method="post">
		Catégorie : <?php liste_categories($idCategorieFiltre, $redirect);?>
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