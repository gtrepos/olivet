function checkCategorie(){
	if (valideFormCategorie()) {
		$('libelle').value = $('libelle').value.trim(); 
		document.form_categorie.submit();
	}
}

function valideFormCategorie(){
	var libelle = $('libelle').value.trim(); 
	
	if (libelle == '') {
		alert("Vous devez renseigner un libell�.");
		$('libelle').focus();
		return false;
	}
	return true;
}

function alerteSuppressionCategorie(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer la cat�gorie \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=categories&action=supprimer&id='+id;
	}
}