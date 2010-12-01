function checkProduitResa(){
	if (valideFormProduitResa()){
		document.form_produit_resa.submit();
	}
}

function valideFormProduitResa(){
	
	var idCategorie = $('idCategorie').value;
	var libelle = $('libelle').value.trim();
	var descriptif = $('descriptif').value.trim();
	var photo = $('photo').value.trim();
	var nb_stock = $('nb_stock').value.trim();
	var rang = $('rang').value.trim();
	var dateRecup = $('dateRecup').value.trim();
	var dateLimite = $('dateLimite').value.trim();
	
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
	
	if ($('a_stock').checked) {
		if (nb_stock == ''){
			alert("Vous devez renseigner un stock.");
			$('nb_stock').focus();
			return false;
		}
		if (nb_stock != ''){
			if (!verifieNombre($('nb_stock'))){
				alert("Le stock doit être un nombre.");
				return false;
			}
		}
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
	
	if (rang == '' || isNaN(rang)){
		alert("Le rang n'est pas renseigné ou ce n'est pas un nombre.");
		$('rang').focus();
		return false;
	}
	
	if (dateRecup == '') {
		alert("La date de livraison n'est pas renseignée.");
		$('dateRecup').focus();
		return false;
	}
	
	if (!validateDate(dateRecup,'W','A')) {
		alert("La date de livraison n'est pas une date valide");
		$('dateRecup').focus();
		return false;
	}
	
	if (dateLimite == '') {
		alert("La date limite de récupération n'est pas renseignée.");
		$('dateLimite').focus();
		return false;
	}
	
	if (!validateDate(dateLimite,'W','A')) {
		alert("La date limite de récupération n'est pas une date valide");
		$('dateLimite').focus();
		return false;
	}
	
	if (!estDateSuperieure(dateRecup,dateLimite)) {
		alert("La date limite de récupération est inférieure ou égale à la date de livraison.");
		$('dateLimite').focus();
		return false;
	}
	
	return true;
	
}

function alerteSuppressionProduitResa(id, libelle){
	if (confirm('Ëtes vous sûr de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produitsresa&action=supprimer&id='+id;
	}
}
