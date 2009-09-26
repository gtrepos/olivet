


<table>
<tr>
<td>
<a href="index.php?page=commander&page_comm=valid1">Mon panier</a>
</td>
</tr>
<tr>
<td>
nombre de produits = <?php  echo panierNbProduits()?>
</td>
</tr>
<tr>
<td>
montant TTC = <?php  echo panierMontantTotal()?>
</td>
</tr>
</table>
<div align=center style="font-size: 15pt;">
	<input type=submit id=vidermonpanier value="Vider mon panier" onClick="javascript:clickViderPanier()">
</div>
