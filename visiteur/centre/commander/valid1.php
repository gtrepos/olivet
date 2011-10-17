<h3>Valider ma commande</h3>

<form onsubmit='return false;'>

<div>

<div class="mesinformations inscrit">
<p style='font-size:1.5em;'>D&eacute;j&agrave; inscrit ?</p>
<p><label>Email * :</label><input type=text id=client_mail size=25 value= <?php if(isset($ajax_client_mail)){echo "$ajax_client_mail";}?>></p>
<p><label>Mot de passe * :</label><input type=password id=client_mdp size=25 value= <?php if(isset($ajax_client_mdp)){echo "$ajax_client_mdp";}?>></p>
<p><a href="javascript:clickNavigation('mesinfos')">Modifier mes informations</a></p>
</div>

<div class="mesinformations pasinscrit">
<p style='font-size:1.5em;'>Pas encore inscrit ?</p>
<p><label>E-mail * :</label><input type=text id=nclient_mail size=25 value= <?php if(isset($ajax_nclient_mail)){echo "$ajax_nclient_mail";}?>></p>
<p><label>Mot de passe * :</label><input type=password id=nclient_mdp1 size=25 value= <?php if(isset($ajax_nclient_mdp1)){echo "$ajax_nclient_mdp1";}?>></p>
<p><label>Confirmation * : </label><input type=password id=nclient_mdp2 size=25 value= <?php if(isset($ajax_nclient_mdp2)){echo "$ajax_nclient_mdp2";}?>></p>
<p><label>Nom * :</label><input type=text id=nclient_nom size=25 value= <?php if(isset($ajax_nclient_nom)){echo "$ajax_nclient_nom";}?>></p>
<p><label>Pr&eacute;nom * :</label><input type=text id=nclient_prenom size=25 value= <?php if(isset($ajax_nclient_prenom)){echo "$ajax_nclient_prenom";}?>></p>
<p><label>N&deg; Tel * :</label><input type=text id=nclient_tel size=25 value= <?php if(isset($ajax_nclient_tel)){echo "$ajax_nclient_tel";}?>></p>
<p><label>Civilité  :</label>
	<select name=nclient_civilite id=nclient_civilite size=1>
		<option value='-1'>-- Choisir une civilité --</option>
		<option value='mme'>Madame</option>
		<option value='melle'>Mademoiselle</option>
		<option value='mr'>Monsieur</option>
	</select></p>
<p><label>Adresse :</label><input type=text id=nclient_adresse size=25 value= <?php if(isset($ajax_nclient_adresse)){echo "$ajax_nclient_adresse";}?>></p> 
<p><label>Code Postal :</label><input type=text id=nclient_postal size=25 value= <?php if(isset($ajax_nclient_postal)){echo "$ajax_nclient_postal";}?>></p> 
<p><label>Commune :</label><input type=text id=nclient_commune size=25 value= <?php if(isset($ajax_nclient_commune)){echo "$ajax_nclient_commune";}?>></p>
</div>

</div>

<div class='separateurPointille'>&nbsp;</div>

<?php echo afficheDateRecup()?> 

<div style='float:left;'>
<p>Code de sécurité * :  <input type="text" name="code" id="securimage_code"/></p>
</div>
<div id="commander-captcha" style="float:left;margin-left:1em;margin-bottom:1em;">
<?php include('captcha.php');?> 
</div>

<div class='separateurPointille'>&nbsp;</div>

<p>
  <a href="javascript:clickValid1();" id="bouton_valider_commande" class="bouton">Valider la commande</a>
</p>

</form>	

<?php 
function afficheDateRecup() {
	
	if (panierNbProdsCond() > 0) {
		echo "<div style='clear:both;margin-bottom:1em;margin-top:1em;' ><table><tr>" .
			 "<td>Date de récupération de la commande * :";
		if (panierNbProdsResa() > 0) {
			echo "<br /><p style='font-size:0.7em;''>(hors produits sur réservation)<p>";	
		}	 
		echo "</td>";
		echo "<td style='vertical-align:top;'>";
		$daterecup = "";
		if(isset($ajax_daterecup_commande)){
			$daterecup = $ajax_daterecup_commande;
		}
		echo "<input type='text' id='daterecup_commande' readonly='readonly'>";
		echo "</td></tr></table></div>";
	}

}

?>
