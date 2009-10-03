function checkPartenaire(){
	if (valideFormPartenaire()) {
		$('libelle').value = $('libelle').value.trim(); 
		$('descriptif').value = $('descriptif').value.trim();
		$('imglogo').value = $('imglogo').value.trim(); 
		$('siteweb').value = $('siteweb').value.trim(); 
		document.form_partenaire.submit();
	}
}

function valideFormPartenaire(){

	var libelle = $('libelle').value.trim(); 
	var descriptif = $('descriptif').value.trim(); 
	var imglogo = $('imglogo').value.trim();
	var siteweb = $('siteweb').value.trim();
	var rang = $('rang').value.trim();
	
	if (libelle == '') {
		alert("Vous devez renseigner un libellé.");
		$('libelle').focus();
		return false;
	}
	
	if (descriptif == '') {
		alert("Vous devez renseigner un descriptif.");
		$('descriptif').focus();
		return false;
	}
	
	if (imglogo == '') {
		alert("Vous devez renseigner un logo.");
		$('imglogo').focus();
		return false;
	}
	
	if (siteweb == '') {
		alert("Vous devez renseigner un site web.");
		$('siteweb').focus();
		return false;
	}
	
	if (siteweb != ''){
		if (!verifieSiteweb($('siteweb'))){
			alert("Le site web est incorrect.");
			return false;
		}
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
	
	return true;
}

function verifieSiteweb(champ){
	var verif = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	if (verif.exec(champ.value) == null){
		champ.focus();
		return false;
	}
	return true;
}

function alerteSuppressionPartenaire(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le partenaire \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=partenaires&action=supprimer&id='+id;
	}
}