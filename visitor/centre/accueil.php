
<table align=center cellspacing=0 cellpadding=0 border=0 width='100%'>
	<tr>
		<td colspan=2 valign=top align=center><img
			src='img/accueilbienvenue.gif' border=0></td>
	</tr>
	<tr>
		<td align=left width="30%">
		<div style='margin-top: 2em;'><img src='img/accueilillustration.gif'
			border=0></div>
		</td>
		<td align=left width="70%">
		<p style="text-align: left; border-style: solid">
		NOUVEAUX PRODUITS : <br />
		<?php
		$tmpres = bddNouveauxProduits();
		while ($row = mysql_fetch_array($tmpres)){
			echo "=>$row[2] : $row[3]";
			echo "<br/>";
		}
		?>
		ACTU GAEC :<br />
		<?php 
		$tmpres = bddActusGaec();	
		while ($row = mysql_fetch_array($tmpres)){
			echo "=>$row[1]: $row[2]";
			echo "<br/>";
		}
		?>
		ACTU LOCALE/MONDE AGRICOLE :<br />
		<?php 
		$tmpres = bddActusLoma();
		while ($row = mysql_fetch_array($tmpres)){
			echo "=>$row[1]: $row[2]";
			echo "<br/>";
		}
		?>
</p>
		</td>
	</tr>
	<tr>
		<td colspan=2 align=center>
		<div style='margin-top: 2em;'><img src='img/accueilaccroche.gif'
			border=0></div>
		</td>
	</tr>
</table>