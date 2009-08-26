

<div id = 'mon_panier'>
<?php 
include('mon_panier.php')
?>
</div>

<form method="post" action="index.php?page=commander&page_comm=valid2">
<table  border="1" align=center cellspacing=0 cellpadding=3 border=0 width='80%'>
<tr>

	<td colspan=2 valign=top align=center>
<?php
if(isset($_SESSION["valid2error"])){
	switch($_SESSION["valid2error"]){
		case "captcha" :
			echo "bad captcha";
			break;
		case "panier" :
			echo "panier vide";
			break;
		case "mail" :
			echo "pb mail";
			break;
		case "" :
			echo "Veuillez Remplir ce formulaire";
			break;
	}
}else{
	echo "Veuillez Remplir ce formulaire";
}
?>
	</td>
</tr>
<tr>
	<td valign=top>E-mail* : </td><td><input type=text id=mail name=mail size=30></td>
</tr>
<tr>
	<td valign=top>Code antispam*</td>
	<td>
<?php
require_once("recaptcha-php-1.10/recaptchalib.php");
$publickey = "6Ld1-AcAAAAAAAXQFo_XTSzx__U0Jkb5T9lCEUXh"; // you got this from the signup page
echo recaptcha_get_html($publickey);
?>
	</td>
</tr>
<tr>
<td align="center" colspan=2>
<div align=center style="font-size: 15pt;">
	<input type=submit id=continuer name=continuer value="Valider la commande">
</div>
</td>
</tr>
</table>
</form>	


<!--  
<table  border="1">
<tr>
<td>
<table align=center cellspacing=0 cellpadding=3 border=0 width='98%'>
<tr><td valign=top align=center>&nbsp;</td></tr>
<tr><td>
<table  style="" align=center cellspacing=0 cellpadding=3 border=0 width='50%'>  
  <tr><td colspan=2 valign=top><img src='img/pucechapo.gif'> Veuillez saisir vos coordonnées</td></tr>
  <tr><td valign=top>Nom : </td><td><input type=text value ="Duponnntt" id=nom name=nom1 size=30></td></tr>
  <tr><td valign=top>Prénom : </td><td><input type=text id=prenom name=prenom size=30></td></tr>
  <tr><td valign=top>Adresse : </td><td><input type=text id=adresse name=adresse size=30></td></tr>
  <tr><td valign=top>Code postal : </td><td><input type=text id=codepostal name=codepostal></td></tr>
  <tr><td valign=top>Commune : </td><td><input type=text id=commune name=commune size=30></td></tr>
  <tr><td valign=top>N° Tel : </td><td><input type=text id=numerotel name=numerotel size=30></td></tr>
  <tr><td valign=top>E-mail : </td><td><input type=text id=email name=emailtemp size=30></td></tr>
  <tr><td valign=top align=center>&nbsp;</td></tr>
</table>    
</td></tr>
</table>       
</td>

<td>
<table style="">
<tr><td colspan=2 valign=top align=center>Déjà client ?</td></tr>
<tr><td valign=top>E-mail* : </td><td><input type=text id=email name=email size=30></td></tr>
<tr><td valign=top>Ref client : </td><td><input type=text id=email name=email size=30></td></tr>
</tr>
</table>
</td>
</tr>
</table>
-->