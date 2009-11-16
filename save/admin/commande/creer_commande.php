<form name="creer_commande" action='index.php?page=commandes&action=enregistrer&mode=creation' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr><td colspan="2">Création d'une nouvelle commande</td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>Choix du client : </td><td><?php liste_clients('-1', false);?></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>Produit à ajouter :</td><td><?php affiche_produits_pour_commande('-1', false);?></td></tr>
		</table>
		<br/>
		<div class="listeQuantites">
		<table id="tableau" cellspacing="0" style="display: none;" >
			<tr>
				<td class=caption>Produit</td>
				<td class=caption>Quantité</td>
				<td class=caption>&nbsp;</td>
			</tr>
		</table>
		</div>
	</div>
	<br>
	<input type="hidden" name="recapCommande" id="recapCommande"/> 
	<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=commandes'">
	<input type="reset">
	<input type="submit" value="Enregistrer" onclick="javascript:checkCommande()">
	
</form>