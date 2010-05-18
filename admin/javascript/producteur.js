function checkProducteur(){
	if (valideFormProducteur()) {
		$('libelle').value = $('libelle').value.trim();
		$('adresse').value = $('adresse').value.trim();
		$('latitude').value = $('latitude').value.trim();
		$('longitude').value = $('longitude').value.trim();
		$('descriptif').value = $('descriptif').value.trim();
		$('rang').value = $('rang').value.trim();
		$('picto').value = $('picto').value.trim();
		$('photo').value = $('photo').value.trim();
		document.form_producteur.submit();
	}
}

function valideFormProducteur(){

	var libelle = $('libelle').value.trim();
	var latitude = $('latitude').value.trim();
	var longitude = $('longitude').value.trim();
	var descriptif = $('descriptif').value.trim(); 
	var rang = $('rang').value.trim();
	var picto = $('picto').value.trim();
	
	if (libelle == '') {
		alert("Vous devez renseigner un libellé.");
		$('libelle').focus();
		return false;
	}
	
	if (latitude == '') {
		alert("Vous devez renseigner une latitude.");
		$('latitude').focus();
		return false;
	}
	
	if (longitude == '') {
		alert("Vous devez renseigner une longitude.");
		$('longitude').focus();
		return false;
	}
	
	if (descriptif == '') {
		alert("Vous devez renseigner un descriptif.");
		$('descriptif').focus();
		return false;
	}
	
	if (rang == ''){
		alert("Vous devez renseigner le rang.");
		$('rang').focus();
		return false;
	}
	
	if (rang != ''){
		if (!verifieNombre($('rang'))){
			alert("Le rang doit être un nombre.");
			return false;
		}
	}
	
	if (picto == ''){
		alert("Vous devez renseigner un picto.");
		$('picto').focus();
		return false;
	}
	
	return true;
}

function alerteSuppressionProducteur(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le producteur \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=producteurs&action=supprimer&id='+id;
	}
}