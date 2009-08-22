

<div id = 'mon_panier'>
<?php 
include('mon_panier.php')
?>
</div>

<form method="post" action="index.php?page=commander&page_comm=valid2">
<table  border="1">
<tr>
<td>
<table align=center cellspacing=0 cellpadding=3 border=0 width='98%'>
<tr><td valign=top align=center>&nbsp;</td></tr>
<tr><td>
<table  style="" align=center cellspacing=0 cellpadding=3 border=0 width='50%'>  
  <tr><td colspan=2 valign=top><img src='img/pucechapo.gif'> Veuillez saisir vos coordonnées</td></tr>
  <tr><td valign=top>Nom : </td><td><input type=text id=nom name=nom size=30></td></tr>
  <tr><td valign=top>Prénom : </td><td><input type=text id=prenom name=prenom size=30></td></tr>
  <tr><td valign=top>Adresse : </td><td><input type=text id=adresse name=adresse size=30></td></tr>
  <tr><td valign=top>Code postal : </td><td><input type=text id=codepostal name=codepostal></td></tr>
  <tr><td valign=top>Commune : </td><td><input type=text id=commune name=commune size=30></td></tr>
  <tr><td valign=top>N° Tel : </td><td><input type=text id=numerotel name=numerotel size=30></td></tr>
  <tr><td valign=top>E-mail : </td><td><input type=text id=email name=email size=30></td></tr>
  <tr><td valign=top align=center>&nbsp;</td></tr>
</table>    
</td></tr>
</table>       
</td>

<td>
<table style="">
<tr><td colspan=2 valign=top align=center>Déjà client ?</td></tr>
<tr><td valign=top>E-mail : </td><td><input type=text id=email name=email size=30></td></tr>
<tr><td valign=top>Ref client : </td><td><input type=text id=email name=email size=30></td></tr>
</tr>
</table>
</td>
</tr>
</table>
<div style="font-family: arial, sans-serif; font-size: 10pt;">
NOTE pour Gwen et Sandra : en général 
la référence arrive au préalable non ? .. et on se sert de la ref des la première
commande.  Ici on sera dans un cas particulier pour la première commande, 
puis les autres se dérouleront autrement.. J'aurai 
tendance à penser que c'est mieux de récupérer la ref avant la 
1ere commande. Evite qussi les malfrats qui emplissent n'importe quoi, non ?
</div>
<div align=center style="font-size: 15pt;">
	<input type=submit id=continuer name=continuer value="Valider la commande">
</div>
</form>	

