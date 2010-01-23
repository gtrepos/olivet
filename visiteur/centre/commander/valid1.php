<h3>Valider ma commande</h3>

<form onsubmit='return false;'>

<div>

<div class="mesinformations inscrit">
<p style='font-size:1.5em;'>D&eacute;j&agrave; inscrit ?</p>
<p><label>Email * :</label><input type=text id=client_mail size=30 value= <?php if(isset($ajax_client_mail)){echo "$ajax_client_mail";}?>></p>
<p><label>Code client * :</label><input type=text id=client_code size=30 value= <?php if(isset($ajax_client_code)){echo "$ajax_client_code";}?>></p>
<p><a href="javascript:clickNavigation('mesinfos')">Modifier mes informations</a></p>
</div>

<div class="mesinformations pasinscrit">
<p style='font-size:1.5em;'>Pas encore inscrit ?</p>
<p><label>E-mail * :</label><input type=text id=nclient_mail size=30 value= <?php if(isset($ajax_nclient_mail)){echo "$ajax_nclient_mail";}?>></p>
<p><label>Nom * :</label><input type=text id=nclient_nom size=30 value= <?php if(isset($ajax_nclient_nom)){echo "$ajax_nclient_nom";}?>></p>
<p><label>Pr&eacute;nom * :</label><input type=text id=nclient_prenom size=30 value= <?php if(isset($ajax_nclient_prenom)){echo "$ajax_nclient_prenom";}?>></p>
<p><label>N&deg; Tel * :</label><input type=text id=nclient_tel size=30 value= <?php if(isset($ajax_nclient_tel)){echo "$ajax_nclient_tel";}?>></p>
<p><label>Adresse :</label><input type=text id=nclient_adresse size=30 value= <?php if(isset($ajax_nclient_adresse)){echo "$ajax_nclient_adresse";}?>></p> 
<p><label>Code Postal :</label><input type=text id=nclient_postal size=30 value= <?php if(isset($ajax_nclient_postal)){echo "$ajax_nclient_postal";}?>></p> 
<p><label>Commune :</label><input type=text id=nclient_commune size=30 value= <?php if(isset($ajax_nclient_commune)){echo "$ajax_nclient_commune";}?>></p>
</div>

</div>

<div class='separateurPointille'>&nbsp;</div>

<div style='clear:both;margin-bottom:1em;margin-top:1em;' >
Date de récupération de la commande * :
<?php 
	$daterecup = "";
	if(isset($ajax_daterecup_commande)){
		$daterecup = $ajax_daterecup_commande;
	}
	echo selectDateRecup($daterecup);
?>
</div>

<div id="commander-captcha" style="float:left;margin-right:1em;margin-bottom:1em;">
<?php include('captcha.php');?> 
</div>
<div style='float:left;'>
<p>Code antispam * :  <input type="text" name="code" id="securimage_code"/></p>
</div>

<div class='separateurPointille'>&nbsp;</div>

<p>
  <a href="javascript:clickValid1();" class="bouton">Valider la commande</a>
</p>

</form>	

<?php 
function selectDateRecup($daterecup){
	
	setlocale (LC_TIME, 'fr_FR','fra');
	
	/*commande passée le lundi : récupération du mardi au samedi de la semaine en cours.
	commande passée le mardi, mercredi, jeudi : récupération du vendredi au samedi de la semaine en cours.
	commande passée le vendredi, samedi, dimanche : récupération du mardi au samedi de la semaine d'après.*/
	
	$cejour = strftime("%A");
	$outputAff = "%A %d %B %Y %T";
	$outputVal = "%Y-%m-%d";
	
	$retour = "<select size=1 id=daterecup_commande>";
	$retour = $retour."<option value='-1'>-- Indiquez une date --</option>";
	
	if ($cejour == 'lundi') {
		
		for ($i=1;$i<=5;$i++){
			$retour = $retour."<option value='" . strftime($outputVal, strtotime('+$i day')) . "'> " . strftime($outputAff, strtotime('+$i day')) . "</option>";	
		}
		
		
		/*$retour = $retour."<option value='" . strftime($outputVal, strtotime('+2 day')) . "'> " . strftime($outputAff, strtotime('+2 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+3 day')) . "'> " . strftime($outputAff, strtotime('+3 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+4 day')) . "'> " . strftime($outputAff, strtotime('+4 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+5 day')) . "'> " . strftime($outputAff, strtotime('+5 day')) . "</option>";*/
		
	}
	
	if ($cejour == 'mardi') {
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+3 day')) . "'> " . strftime($outputAff, strtotime('+3 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+4 day')) . "'> " . strftime($outputAff, strtotime('+4 day')) . "</option>";				
	}
	
	if ($cejour == 'mercredi') {
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+2 day')) . "'> " . strftime($outputAff, strtotime('+2 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+3 day')) . "'> " . strftime($outputAff, strtotime('+3 day')) . "</option>";		
	}
	
	if ($cejour == 'jeudi') {
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+1 day')) . "'> " . strftime($outputAff, strtotime('+1 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+2 day')) . "'> " . strftime($outputAff, strtotime('+2 day')) . "</option>";		
	}
	
	if ($cejour == 'vendredi') {
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+4 day')) . "'> " . strftime($outputAff, strtotime('+4 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+5 day')) . "'> " . strftime($outputAff, strtotime('+5 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+6 day')) . "'> " . strftime($outputAff, strtotime('+6 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+7 day')) . "'> " . strftime($outputAff, strtotime('+7 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+8 day')) . "'> " . strftime($outputAff, strtotime('+8 day')) . "</option>";		
	}
	
	if ($cejour == 'samedi') {
		
		for ($i=3;$i<=7;$i++){
			$expr = '+'.$i.' day';
			$retour = $retour."<option value='" . strftime($outputVal, strtotime($expr)) . "'> " . strftime($outputAff, strtotime($expr)) . "</option>";	
		}
		
		/*$retour = $retour."<option value='" . strftime($outputVal, strtotime('+3 day')) . "'> " . strftime($outputAff, strtotime('+3 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+4 day')) . "'> " . strftime($outputAff, strtotime('+4 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+5 day')) . "'> " . strftime($outputAff, strtotime('+5 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+6 day')) . "'> " . strftime($outputAff, strtotime('+6 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+7 day')) . "'> " . strftime($outputAff, strtotime('+7 day')) . "</option>";*/
	}
	
	if ($cejour == 'dimanche') {
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+2 day')) . "'> " . strftime($outputAff, strtotime('+2 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+3 day')) . "'> " . strftime($outputAff, strtotime('+3 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+4 day')) . "'> " . strftime($outputAff, strtotime('+4 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+5 day')) . "'> " . strftime($outputAff, strtotime('+5 day')) . "</option>";
		$retour = $retour."<option value='" . strftime($outputVal, strtotime('+6 day')) . "'> " . strftime($outputAff, strtotime('+6 day')) . "</option>";		
	}	
	
	$retour = $retour . "</select>";
	
	return $retour;
	
}
?>
