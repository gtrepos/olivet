function checkActu(){
	if (valideFormActu()) {
		$('libelle').value = $('libelle').value.trim();
		$('descriptif').value = $('descriptif').value.trim();
		document.form_actualite.submit();
	}
}

function valideFormActu(){

	var libelle = $('libelle').value.trim(); 
	var descriptif = $('descriptif').value.trim(); 
	var type = $('type').value;
	
	if (libelle == '') {
		alert("Vous devez renseigner un libell�.");
		$('libelle').focus();
		return false;
	}
	
	if (descriptif == '') {
		alert("Vous devez renseigner un descriptif.");
		$('descriptif').focus();
		return false;
	}
	
	if (type == -1) {
		alert("Vous devez renseigner le type d'actualit�.");
		$('type').focus();
		return false;
	}
	
	return true;
}

function alerteSuppressionActu(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer l\'actualit� \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=actualites&action=supprimer&id='+id;
	}
}