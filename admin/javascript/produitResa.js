function checkProduitResa(){
	if (valideFormProduitResa()){
		document.form_produit_resa.submit();
	}
}

function valideFormProduitResa(){
	
	var libelle = $('libelle').value.trim();
	var descriptif = $('descriptif').value.trim();
	var photo = $('photo').value.trim();
	
	if (libelle == ''){
		alert("Vous devez renseigner un libelle.");
		$('libelle').focus();
		return false;
	}
	
	if (descriptif == ''){
		alert("Vous devez renseigner un descriptif.");
		$('descriptif').focus();
		return false;
	}
	
	if (photo == ''){
		alert("Vous devez renseigner une photo.");
		$('photo').focus();
		return false;
	}
	
	return true;
	
}

function alerteSuppressionProduitResa(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produitsresa&action=supprimer&id='+id;
	}
}
