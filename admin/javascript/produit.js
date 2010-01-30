function checkProduit(){
	if (valideFormProduit()){
		document.form_produit.submit();
	}
}

function valideFormProduit(){
	
	var idCategorie = $('idCategorie').value;
	var libelle = $('libelle').value.trim();
	var descriptif = $('descriptif').value.trim();
	var photo = $('photo').value.trim();
	
	if (idCategorie == -1){
		alert("Vous devez renseigner une catégorie de produits.");
		$('idCategorie').focus();
		return false;
	}
	
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

function alerteSuppressionProduit(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produits&action=supprimer&id='+id;
	}
}
