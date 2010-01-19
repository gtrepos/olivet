
<h3>Valider ma commande</h3>

<form onsubmit='return false;'>
	<table  border="1" align=center cellspacing=0 cellpadding=3 border=0 width='80%'>
		<tr>
			<td valign=top align=center> D&eacute;j&agrave; inscrit ? <br><a href="index.php?page=mesinfos">Modifier mes informations</a></td>
			<td valign=top align=center> Pas encore inscrit ? </td>
		</tr>
		<tr>
			<td valign="middle"> 
				E-mail* : 
				<input type=text id=client_mail size=30 
					   value= <?php if(isset($ajax_client_mail)){echo "$ajax_client_mail";}?>> 
			</td>
			<td valign="middle"> 
				E-mail* : 
				<input type=text id=nclient_mail size=30
					   value= <?php if(isset($ajax_nclient_mail)){echo "$ajax_nclient_mail";}?>> 
			</td>
		</tr>
		<tr>
			<td valign="middle" rowspan=6> 
				Code client* : 
				<input type=text id=client_code size=30 
					   value= <?php if(isset($ajax_client_code)){echo "$ajax_client_code";}?>>					    
			</td>
			<td valign="middle"> 
				Nom : 
				<input type=text id=nclient_nom size=30
					   value= <?php if(isset($ajax_nclient_nom)){echo "$ajax_nclient_nom";}?>> 
			</td>
		</tr>
		<tr>
			<td valign="middle"> 
				Pr&eacute;nom : 
				<input type=text id=nclient_prenom size=30
					   value= <?php if(isset($ajax_nclient_prenom)){echo "$ajax_nclient_prenom";}?>> 
			</td>
		</tr>
		<tr>
			<td valign="middle"> 
				Adresse : 
				<input type=text id=nclient_adresse size=30
					   value= <?php if(isset($ajax_nclient_adresse)){echo "$ajax_nclient_adresse";}?>> 
			</td>
		</tr>
		<tr>
			<td valign="middle"> 
				Code Postal : 
				<input type=text id=nclient_postal size=30
					   value= <?php if(isset($ajax_nclient_postal)){echo "$ajax_nclient_postal";}?>> 
			</td>
		</tr>
		<tr>
			<td valign="middle"> 
				Commune : 
				<input type=text id=nclient_commune size=30
					   value= <?php if(isset($ajax_nclient_commune)){echo "$ajax_nclient_commune";}?>> 
			</td>
		</tr>
		<tr>
			<td valign="middle"> 
				N&deg; Tel : 
				<input type=text id=nclient_tel size=30
					   value= <?php if(isset($ajax_nclient_tel)){echo "$ajax_nclient_tel";}?>> 
			</td>
		</tr>
		<tr>
			<td align="center" colspan=1>
				<div id="commander-captcha">
					<?php include('captcha.php');?>
				</div>
			</td>
			<td align="center" colspan=1>	
				Code antispam* :  <input type="text" name="code" id="securimage_code"/><br />
				<input type=button value="Valider la commande" onclick='javascript:clickValid1();'>
			</td>
		</tr>
</table>
</form>	