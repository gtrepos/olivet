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
	$redirect = 'conditionnements';
?>

<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td>
		<form name="filtreCategorie" id="filtreCategorie" method="post">
		Catégorie : <?php liste_categories($idCategorieFiltre, $redirect);?>
		</form></td>
	</tr>
	<tr>
		<td align="right" colspan="12"><a href="?page=conditionnements&action=creer"><?php echo ADMIN_CONDITIONNEMENT_CREER;?></a></td>
	</tr>
</table>
<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_ID; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRODUIT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NOM; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NOUVEAUTE; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_DIVISIBLE; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRIX; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRIX_GLOBAL; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_TVA; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_conditionnements($idCategorieFiltre); ?>
	<tr>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_ID; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRODUIT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NOM; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_NOUVEAUTE; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_DIVISIBLE; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRIX; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_PRIX_GLOBAL; ?></td>
		<td class=caption><?php echo ADMIN_CONDITIONNEMENT_TVA; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="13"><a href="?page=conditionnements&action=creer"><?php echo ADMIN_CONDITIONNEMENT_CREER;?></a></td>
	</tr>
</table>
