<form name="form_commande" action='index.php?page=commandes&action=enregistrer&mode=modification' method="post" 
	  onsubmit="return false;" onkeypress="javascript:gestionToucheEntree(event,checkCommande);">
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
			<tr><td>Produit conditionn� � ajouter :</td><td><?php affiche_conditionnements_pour_selection('-1', true, 'addCondCommande()');?></td></tr>
		</table>
		<br/>
		<div class="listeQuantites">
		<table id="tableau" cellspacing="0">
			<tr>
				<td class=caption>Produit conditionn�</td>
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
	<input type="button" name="Enregistrer" title="Enregistrer" value="Enregistrer" onclick="javascript:checkCommande()">
	
</form>