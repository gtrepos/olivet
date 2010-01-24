<?php
		$refClient = null;
		$datedeb = null;
		$datefin = null;
		$idConditionnement = null;
		$idProduitResa = null;
		$etat = null;
		$idCommande = null;
		$dateRecupCommande = null;
		
		
		if (isset($_POST['refClient'])) $refClient = $_POST['refClient'];
		if (isset($_POST['datedeb'])) $datedeb = $_POST['datedeb'];
		if (isset($_POST['datefin'])) $datefin = $_POST['datefin'];
		if (isset($_POST['idConditionnement'])) $idConditionnement = $_POST['idConditionnement'];
		if (isset($_POST['idProduitResa'])) $idProduitResa = $_POST['idProduitResa'];
		if (isset($_POST['etat'])) $etat = $_POST['etat'];
		if (isset($_POST['idCommande'])) $idCommande = $_POST['idCommande'];
		if (isset($_POST['dateRecupCommande'])) $dateRecupCommande = $_POST['dateRecupCommande'];
?>		

<form name="formRechercheCommande" id="formRechercheCommande" action='index.php?page=commandes' method="post"
	  onkeypress="javascript:gestionToucheEntree(event,checkRechercheCommande);">
	<div id=recherche>
	<div class=caption>Rechercher des commandes</div>
	<div class=critere>Client : <?php liste_clients($refClient, false);?> 
					   Identifiant de commande : <input type="text" name="idCommande" id="idCommande" value="<?php echo $idCommande;?>"/>
					   Etat : <?php affiche_etat_pour_commande($etat);?></div>
	<div class=critere>Dates : du <input type="text" name="datedeb" id="datedeb" value="<?php echo $datedeb;?>"/>
								  <input type="button" value="?" onclick="displayCalendar(document.forms[0].datedeb,'yyyy-mm-dd',this)"> 
							   au <input type="text" name="datefin" id="datefin" value="<?php echo $datefin;?>"/>
							   	  <input type="button" value="?" onclick="displayCalendar(document.forms[0].datefin,'yyyy-mm-dd',this)"></div>
	<div class=critere>Produit conditionné : <?php affiche_conditionnements_pour_selection($idConditionnement, true, null);?> 
	Produit à la réservation : <?php affiche_produitsresa_pour_selection($idProduitResa, true, null);?></div>
	<table class=olivet width="100%" cellspacing="1" cellspacing="0">
		<tr>
			<td align="center"><a href="javascript:checkRechercheCommande();" ><?php echo ADMIN_COMMANDE_RECHERCHER;?></a>
			<a href="?page=commandes&action=creer"><?php echo ADMIN_COMMANDE_CREER;?></a></td>
		</tr>
	</table>
	</div>
</form>

<div id=resultatRecherche>
<div class=caption>Liste des commandes</div>
<table id=tableauRech cellspacing="0" cellspacing="0" align=center>
	<tr>
		<td class=caption><?php echo ADMIN_COMMANDE_ID; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_CLIENT; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_DATE_CREATION; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_DATE_RECUPERATION; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_ETAT; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_RESUME; ?></td>
		<td class=caption><?php echo ADMIN_COMMANDE_SOMME; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php	  
		liste_commandes ($refClient, $idCommande, $datedeb, $datefin, $idConditionnement, $idProduitResa, $etat);
	?>
</table>
</div>
