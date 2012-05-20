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
	$redirect = 'produitsresa';
?>

<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td>
		<form name="filtreCategorie" id="filtreCategorie" method="post">
		Catégorie : <?php liste_categories($idCategorieFiltre, $redirect);?>
		</form></td>
	</tr>
	<tr>
		<td align="right" colspan="8"><a href="?page=produitsresa&action=creer"><?php echo ADMIN_PRODUIT_RESA_CREER;?></a></td>
	</tr>
</table>

<table id=tableau cellspacing="0" cellspacing="0">
	<tr>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_CATEGORIE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_PRODUCTEUR; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_NOUVEAUTE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_RANG; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_DATE_LIMITE_COMMANDE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_DATE_RETRAIT; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_DATE_LIMITE; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_produits_resa($idCategorieFiltre); ?>
	<tr>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_ID; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_CATEGORIE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_LIBELLE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_PRODUCTEUR; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_NOUVEAUTE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_RANG; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_DATE_LIMITE_COMMANDE; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_DATE_RETRAIT; ?></td>
		<td class=caption><?php echo ADMIN_PRODUIT_RESA_DATE_LIMITE; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
</table>
<table class=olivet width="90%" cellspacing="1" cellspacing="0">
	<tr>
		<td align="right" colspan="11"><a href="?page=produitsresa&action=creer"><?php echo ADMIN_PRODUIT_RESA_CREER;?></a></td>
	</tr>
</table>