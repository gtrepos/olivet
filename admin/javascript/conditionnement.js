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
	
	return true;
	
}

function alerteSuppressionConditionnement(id, nom){
	if (confirm('Êtes vous sûr de vouloir supprimer le conditionnement \'' + nom + '\' ('+id+') ?')){
		new Ajax.Request("./fonctions/ajax.php", {
			method : 'post',
			parameters : {
				event : 'supprimeConditionnement',
				idcond : id
			},
			onComplete : function(transport) {
				location.href = "./?page=conditionnements&action=lister";
			}
		});
	}
}

function selectionneStock(){
	if ($('a_stock').checked){
		$('nb_stock').readOnly = "";
	}
	else {
		$('nb_stock').readOnly = "readonly";
	}	
}

function updateNouveauteConditionnement(idcond, nouveaute) {
	new Ajax.Request("./fonctions/ajax.php", {
		method : 'post',
		parameters : {
			event : 'updateNouveauteConditionnement',
			idcond : idcond,
			nouveaute : nouveaute
		},
		onComplete : function(transport) {
			location.href = "./?page=conditionnements&action=lister";
		}
	});
}

