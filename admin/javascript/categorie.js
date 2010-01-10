function checkCategorie(){
	if (valideFormCategorie()) {
		$('libelle').value = $('libelle').value.trim(); 
		document.form_categorie.submit();
	}
}

function valideFormCategorie(){
	var libelle = $('libelle').value.trim(); 
	
	if (libelle == '') {
		alert("Vous devez renseigner un libellé.");
		$('libelle').focus();
		return false;
	}
	return true;
}

function alerteSuppressionCategorie(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer la catégorie \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=categories&action=supprimer&id='+id;
	}
}