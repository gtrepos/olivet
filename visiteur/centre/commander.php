<h3>Conditions</h3>
<div align=left class="conditions"> 
	<p>Les commandes sont a récupérer à la ferme d'Olivet. Vous pouvez choisir une date de récupération dans un délai de deux mois à compter de la date de commande.</p> 
	<p>Pour des raisons de logistique, merci de prendre en compte les contraintes suivantes :</p>
	<p><img src='img/flecheactu.gif'/> Il vous sera <u>impossible</u> de récupérer votre commande pendant les jours de fermeture (dimanche, lundi, mardi, mercredi, jeudi, jours fériés).</p>
	<p><img src='img/flecheactu.gif'/> Si votre commande est passée <u>avant 12h</u> le vendredi, la récupération sera possible le jour j. Dans le cas contraire la récupération sera possible dès le lendemain.</p>
	<p><img src='img/flecheactu.gif'/> Si votre commande est passée le samedi, la récupération sera seulement possible le vendredi de la semaine suivante.</p>
	<p>Merci de votre compréhension.</p>
</div>

<h3>Récapitulatif de la commande</h3>

<div id='centre-commander-mon_panier'>
<?php include('commander/mon_panier.php'); ?>
</div>

<div style='float:right;margin-top:1em;'><a href="javascript:clickNavigation('nos_produits')">Ajouter des produits</a></div>

<div style='clear:both;'>&nbsp;</div>
<p>
<?php if (isCommandePossible()) {?>
<a href="javascript:clickPasserCommande();" class="bouton">Passer la commande</a> |
<?php } ?> 
<a href="javascript:clickNavigation('mesinfos');" class="bouton">Modifier mes informations</a>
</p>
