function checkClient(){
	if (valideFormClient()) {
		$('nom').value = $('nom').value.trim(); 
		$('prenom').value = $('prenom').value.trim();
		$('adresse').value = $('adresse').value.trim();
		$('cp').value = $('cp').value.trim();
		$('commune').value = $('commune').value.trim();
		$('tel').value = $('tel').value.trim();
		$('email').value = $('email').value.trim();
		document.form_client.submit();
	}
}

function valideFormClient(){

	var nom = $('nom').value.trim(); 
	var prenom = $('prenom').value.trim();
	var tel = $('tel').value.trim(); 
	var email = $('email').value.trim();
	
	if (nom == '') {
		alert("Vous devez renseigner un nom.");
		$('nom').focus();
		return false;
	}
	
	if (prenom == '') {
		alert("Vous devez renseigner un prenom.");
		$('prenom').focus();
		return false;
	}
	
	if (tel == '') {
		alert("Vous devez renseigner un numéro de telephone.");
		$('tel').focus();
		return false;
	}
	
	if (email == '') {
		alert("Vous devez renseigner une adresse email.");
		$('email').focus();
		return false;
	}
	
	if (email != '' && !checkEmail(email)){
		alert("L'adresse email renseignée n'est pas valide.");
		$('email').focus();
		return false;
	}
	
	return true;
}

function alerteSuppressionClient(ref, nom, prenom){
	if (confirm('Êtes vous sûr de vouloir supprimer le client \'' + nom + ' ' + prenom + '\' ('+ref+') ?')){
		location.href = 'index.php?page=clients&action=supprimer&ref='+ref;
	}	
}

function checkEmail(email) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return filter.test(email);
}

function checkRechercheClient(){
	if ($('nom').value.trim() == '' && $('prenom').value.trim() == '' && $('commune').value.trim() == ''){
		alert('Vous devez renseigner un critère de recherche.');
		return;
	}
	$('formRechercheClient').submit();
	
}