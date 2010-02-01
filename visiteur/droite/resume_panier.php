<?php if (panierNbProdsCond() == 0 && panierNbProdsResa() == 0) {
	echo "Votre panier est vide";
	echo "<br/><br/><div><a href=\"javascript:clickNavigation('nos_produits')\">Ajouter des produits</a></div>";
}
else {
	if (panierNbProdsCond()>0) {
		echo "produits : " . panierNbProdsCond() . "<br>";
		echo "montant TTC : " .number_format(panierMontantTotalProdsCond(), 2, '.', ''). " &nbsp;&euro; <br>";
	}
	if (panierNbProdsResa()>0) {
		echo "produits sur réservation : " . panierNbProdsResa() . "";
	}
}
?>
<?php if (panierNbProdsCond() > 0 || panierNbProdsResa() > 0) {
echo "<div>";
echo "<a href='javascript:clickViderPanier()'>Vider</a> |"; 
echo "<a href=\"javascript:clickNavigation('commander')\">Voir</a><br />";
echo "</div>";
}?>



