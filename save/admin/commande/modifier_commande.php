<form name="modifier_commande" action='index.php?page=commandes&action=enregistrer&mode=modification' method="post" return="false">
	<div style='border-size:1px;position:relative;'>
		<table>
			<tr>
				<td colspan="2">Modification de la commande <?php echo $_GET['idCommande'];?>
				<input type="hidden" name="idCommande" id="idCommande" value="<?php echo $_GET['idCommande']?>"/> 
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>Client : </td><td><?php liste_clients($_GET['refClient'], false);?></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>Produit � ajouter :</td><td><?php affiche_produits_pour_commande('-1', true);?></td></tr>
		</table>
		<br/>
		<div class="listeQuantites">
		<table id="tableau" cellspacing="0">
			<tr>
				<td class=caption>Produit</td>
				<td class=caption>Quantit�</td>
				<td class=caption>&nbsp;</td>
			</tr>
			<?php affiche_detail_commande($_GET['idCommande']);?>
		</table>
		</div>
	</div>
	<br>
	<input type="hidden" name="recapCommande" id="recapCommande"/> 
	<input type="button" name="annuler" title="Annuler" value="Annuler" onclick="window.location='index.php?page=commandes'">
	<input type="reset">
	<input type="submit" value="Enregistrer" onclick="javascript:checkCommande()">
	
</form>