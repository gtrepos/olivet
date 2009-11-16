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
		alert("Vous devez renseigner une cat�gorie de produits.");
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
		alert("Vous devez renseigner une unit�.");
		$('unite').focus();
		return false;
	}
	
	if (prix_unite == ''){
		alert("Vous devez renseigner un prix � l'unit�.");
		$('prix_unite').focus();
		return false;
	}
	
	else {
		var isAFloat = ""+parseFloat(prix_unite);
		if(isAFloat == 'NaN'){
			alert("Le prix � l'unit� doit �tre d�cimal.\nExemple : 1.50");
			$('prix_unite').focus();
			return false;
		}
	}
	
	return true;
	
}

function alerteSuppressionProduit(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produits&action=supprimer&id='+id;
	}
}