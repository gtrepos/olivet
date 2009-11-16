function checkProduit(){
	if (valideFormProduit()){
		document.form_produit.submit();
	}
}

function valideFormProduit(){
	
	var idCategorie = $('idCategorie').value;
	var libelle = $('libelle').value.trim();
	var descriptif = $('descriptif').value.trim();
	var unite = $('unite').value.trim();
	var prix_unite = $('prix_unite').value.trim();
	
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
	
	if (unite == ''){
		alert("Vous devez renseigner une unité.");
		$('unite').focus();
		return false;
	}
	
	if (prix_unite == ''){
		alert("Vous devez renseigner un prix à l'unité.");
		$('prix_unite').focus();
		return false;
	}
	
	else {
		var isAFloat = ""+parseFloat(prix_unite);
		if(isAFloat == 'NaN'){
			alert("Le prix à l'unité doit être décimal.\nExemple : 1.50");
			$('prix_unite').focus();
			return false;
		}
	}
	
	return true;
	
}

function alerteSuppressionProduit(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produits&action=supprimer&id='+id;
	}
}