<?php
		$nom = null;
		$prenom = null;
		$commune = null;
		
		if (isset($_POST['nom'])) $nom = $_POST['nom'];
		if (isset($_POST['prenom'])) $prenom = $_POST['prenom'];
		if (isset($_POST['commune'])) $commune = $_POST['commune'];
?>	
<form name="formRechercheClient" id="formRechercheClient" action='index.php?page=clients' method="post"
	  onkeypress="javascript:gestionToucheEntree(event,checkRechercheClient);">
	<div id=recherche>
	<div class=caption>Rechercher des clients</div>
	<div class=critere>Nom : <input type="text" name="nom" id="nom" value="<?php echo $nom;?>"/></div>
	<div class=critere>Prénom : <input type="text" name="prenom" id="prenom" value="<?php echo $prenom;?>"/></div>
	<div class=critere>Commune : <input type="text" name="commune" id="commune" value="<?php echo $commune;?>"/></div>
	
	<table class=olivet width="100%" cellspacing="1" cellspacing="0">
		<tr>
			<td align="center"><a href="javascript:checkRechercheClient();" ><?php echo ADMIN_CLIENT_RECHERCHER;?></a>
			<a href="?page=clients&action=creer"><?php echo ADMIN_CLIENT_CREER;?></a></td>
		</tr>
	</table>
	</div>
</form>

<div id=resultatRecherche>
<div class=caption>Liste des clients</div>
<table id=tableauRech cellspacing="0" cellspacing="0" align=center>
	<tr>
		<td class=caption><?php echo ADMIN_CLIENT_REFERENCE; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_CIVILITE; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_NOM; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_PRENOM; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_ADRESSE; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_TEL; ?></td>
		<td class=caption><?php echo ADMIN_CLIENT_MAIL; ?></td>
		<td class=caption>&nbsp;</td>
	</tr>
	<?php affich_clients ($nom, $prenom, $commune); ?>
</table>
</div>