<form onsubmit='return false;'>
<p>
	<label>Civilité  :</label>
	<select name='client_civilite' id='client_civilite' size='1'>
		<option value='-1' <?php if ($tmpCheckClient->civilite == '-1') echo " selected ";?> >-- Choisir une civilité --</option>
		<option value='mme' <?php if ($tmpCheckClient->civilite == 'mme') echo " selected ";?> >Madame</option>
		<option value='melle' <?php if ($tmpCheckClient->civilite == 'melle') echo " selected ";?> >Mademoiselle</option>
		<option value='mr' <?php if ($tmpCheckClient->civilite == 'mr') echo " selected ";?> >Monsieur</option>
	</select>		   
</p>
<p>
	<label>Nom * : </label>
	<input type=text id=client_nom size=30
					   value= <?php echo $tmpCheckClient->nom;?>>
</p>
<p>
	<label>Prénom * : </label>
	<input type=text id=client_prenom size=30
					   value= <?php echo $tmpCheckClient->prenom;?>>
</p>
<p>
	<label>Email * :</label>
	<input type=text id=client_mail size=30
					   value= <?php echo $tmpCheckClient->email;?>> 
</p>
<p>
	<label>N&deg; Tel * : </label>
	<input type=text id=client_tel size=30
					   value= "<?php echo $tmpCheckClient->numeroTel;?>">
</p>
<p>
	<label>Adresse : </label>
	<textarea id=client_adresse cols='25'><?php echo $tmpCheckClient->adresse;?></textarea>	
</p>
<p>
	<label>Code postal : </label>
	<input type=text id=client_postal size=30
					   value= "<?php echo $tmpCheckClient->codePostal;?>"> 
</p>
<p>
	<label>Commune : </label>
	<input type=text id=client_commune size=30
					   value= "<?php echo $tmpCheckClient->commune;?>"> 
</p>

<input type=hidden id=client_ref value="<?php echo $tmpCheckClient->id;?>">

<input type="button" value="envoyer"  onclick='javascript:clickCheckModifClient();'/>
</form>