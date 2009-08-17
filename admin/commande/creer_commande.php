<form name="creer_commande" action='index.php?page=commandes&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'une nouvelle commande</td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>Choix du client : </td><td><?php liste_clients('-1',false);?></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2">Choix des produits :</td></tr>
			<tr><td colspan="2"><?php affiche_produits_pour_commande();?></td></tr>
		</table>
	</div>
	<br>
	<input type="button" name="annulerCommande" title="Annuler" value="Annuler" onclick="window.location='index.php?page=commandes'">
	<input type="reset">
	<input type="submit" value="Enregistrer" onclick="javascript:checkCommande()">
</form>



 
