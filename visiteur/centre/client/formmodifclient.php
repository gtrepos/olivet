<form onsubmit='return false;'>
<p>
	<label>Email * :</label>
	<input type=text id=client_mail size=30
					   value= <?php echo $tmpCheckClient->email;?>> 
</p>
<p>
	<label>Nom : </label>
	<input type=text id=client_nom size=30
					   value= <?php echo $tmpCheckClient->nom;?>>
</p>
<p>
	<label>Prénom : </label>
	<input type=text id=client_prenom size=30
					   value= <?php echo $tmpCheckClient->prenom;?>>
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
<p>
	<label>N&deg; Tel : </label>
	<input type=text id=client_tel size=30
					   value= "<?php echo $tmpCheckClient->numeroTel;?>">
</p>

<input type=hidden id=client_ref value="<?php echo $tmpCheckClient->id;?>">

<input type="button" value="envoyer"  onclick='javascript:clickCheckModifClient();'/>
</form>