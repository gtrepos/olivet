<h3>Modifier vos informations personnelles</h3>

<div id="mesinfos" class="mesinformations">
<p>Veuillez préciser votre email et votre code client</p>

<form onsubmit='return false;'>
<p>
	<label>Email * :</label>
	<input type='text' id='client_mail' name='client_mail'/>
</p>
<p>
	<label>Code client * : </label>
	<input type='password' id='client_code' name='client_code' size='10' maxlength="10"/>
</p>
<input type="button" value="envoyer"  onclick='javascript:clickCheckClient();'/>	
</form>

</div>


