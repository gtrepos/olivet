function checkConditionnement(){
	if (valideFormConditionnement()){
		document.form_conditionnement.submit();
	}
}

function valideFormConditionnement(){
	
	var idProduit = $('idProduit').value;
	var nom = $('nom').value.trim();
	var nb_stock = $('nb_stock').value.trim();
	var prix_cond = $('prix_cond').value.trim();
	var quantite_produit = $('quantite_produit').value.trim();
	
	if (idProduit == -1){
		alert("Vous devez renseigner un produit.");
		$('idProduit').focus();
		return false;
	}
	
	if (nom == ''){
		alert("Vous devez renseigner un nom.");
		$('nom').focus();
		return false;
	}
	
	if ($('is_stock').checked) {
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
	
	if (prix_cond == ''){
		alert("Vous devez renseigner un prix de conditionnement.");
		$('prix_cond').focus();
		return false;
	}
	
	else {
		var isAFloat = ""+parseFloat(prix_cond);
		if(isAFloat == 'NaN'){
			alert("Le prix du conditionnement doit être décimal.\nExemple : 1.50");
			$('prix_cond').focus();
			return false;
		}
	}
	
	if (quantite_produit == ''){
		alert("Vous devez renseigner une quantite de produit.");
		$('quantite_produit').focus();
		return false;
	}
	
	else {
		var isAFloat = ""+parseFloat(quantite_produit);
		if(isAFloat == 'NaN'){
			alert("La quantité de produit doit être décimale.\nExemple : 1.50");
			$('quantite_produit').focus();
			return false;
		}
	}
	
	return true;
	
}

function alerteSuppressionConditionnement(id, nom){
	if (confirm('Êtes vous sûr de vouloir supprimer le conditionnement \'' + nom + '\' ('+id+') ?')){
		location.href = 'index.php?page=conditionnements&action=supprimer&id='+id;
	}
}

function selectionneStock(){
	if ($('is_stock').checked){
		$('nb_stock').readOnly = "";
	}
	else {
		$('nb_stock').readOnly = "readonly";
	}	
}