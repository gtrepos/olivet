<div id='banniere-resume_panier' style='background-color:#CCFF99;color:black;'>
<p>nombre de produits : <?php  echo panierNbProduits()?><br>
montant TTC : <?php  echo panierMontantTotal()?>&nbsp;&euro;<br>
produits non conditionnes : <?php  echo panierNbProduitsConditionnes()?>&nbsp;&euro;
</p>
<p>
<a href="javascript:clickViderPanier()">Vider</a> | 
<a href="index.php?page=commande">Voir</a>
</p>
</div>

