function checkProduit(){
	if (valideFormProduit()){
		document.form_produit.submit();
	}
}

function valideFormProduit(){
	
	var idCategorie = $('idCategorie').value;
	var libelle = $('libelle').value.trim();
	var nb_stock = $('nb_stock').value.trim();
	var descriptif = $('descriptif').value.trim();
	var unite = $('unite').value.trim();
	var prix_unite = $('prix_unite').value.trim();
	var cond_nom = $('cond_nom').value.trim();
	var cond_taille = $('cond_taille').value.trim();
	var cond_taille_inf = $('cond_taille_inf').value.trim();
	var cond_taille_sup = $('cond_taille_sup').value.trim();
	
	
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
	
	if ($('conditionnement').checked) {
		if (cond_nom == ''){
			alert("Vous devez renseigner le nom du conditionnement.");
			$('cond_nom').focus();
			return false;
		}
		
		if (!$('cond_fixe').checked && !$('cond_variable').checked){
			alert("Vous devez préciser si le conditionnement est fixe ou variable.");
			return false;
		}
		
		else {
			
			if ($('cond_fixe').checked){
				if (cond_taille == ''){
					alert("Vous devez renseigner la taille du conditionnement fixe.");
					$('cond_taille').focus();
					return false;
				}
				else {
					if (!verifieNombre($('cond_taille'))){
						alert("La taille doit être un nombre.");
						return false;
					}
				}
			}
			
			if ($('cond_variable').checked){
				if (cond_taille_inf == ''){
					alert("Vous devez renseigner la taille inférieure du conditionnement variable.");
					$('cond_taille_inf').focus();
					return false;
				}
				else {
					if (!verifieNombre($('cond_taille_inf'))){
						alert("La taille inférieure doit être un nombre.");
						return false;
					}
				}
				
				if (cond_taille_sup == ''){
					alert("Vous devez renseigner la taille supérieure du conditionnement variable.");
					$('cond_taille_sup').focus();
					return false;
				}
				else {
					if (!verifieNombre($('cond_taille_sup'))){
						alert("La taille suppérieure doit être un nombre.");
						return false;
					}
				}
			}
		}
	}
	
	return true;
	
}

function alerteSuppressionProduit(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produits&action=supprimer&id='+id;
	}
}

function selectionneConditionnement(){
	if ($('conditionnement').checked){
		$('tr_conditionnement_nom').show();
		$('tr_conditionnement_fixe').show();
		$('tr_conditionnement_variable').show();
		$('cond_fixe').readOnly = "";
		$('cond_variable').readOnly = "";
	}
	else {
		$('tr_conditionnement_nom').hide();
		$('tr_conditionnement_fixe').hide();
		$('tr_conditionnement_variable').hide();
		$('cond_fixe').readOnly = "readonly";
		$('cond_fixe').checked = false;
		$('cond_variable').readOnly = "readonly";
		$('cond_variable').checked = false;
		$('cond_taille').readOnly = "readonly";
		$('cond_taille_inf').readOnly = "readonly";
		$('cond_taille_sup').readOnly = "readonly";
	}	
}

function selectionneConditionnementFixe(){
	if ($('cond_fixe').checked){
		$('cond_taille').readOnly = "";
		$('cond_variable').checked = false;
		$('cond_taille_inf').readOnly = "readonly";
		$('cond_taille_sup').readOnly = "readonly";
	}
	else {
		$('cond_taille').readOnly = "readonly";
		$('cond_variable').checked = true;
		$('cond_taille_inf').readOnly = "";
		$('cond_taille_sup').readOnly = "";
	}	
}

function selectionneConditionnementVariable(){
	if ($('cond_variable').checked){
		$('cond_taille_inf').readOnly = "";
		$('cond_taille_sup').readOnly = "";
		$('cond_fixe').checked = false;
		$('cond_taille').readOnly = "readonly";
	}
	else {
		$('cond_taille_inf').readOnly = "readonly";
		$('cond_taille_sup').readOnly = "readonly";
		$('cond_fixe').checked = true;
		$('cond_taille').readOnly = "";
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