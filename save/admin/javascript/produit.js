function checkProduit(){
	alert('check_produit');
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
		$('cond_fixe').enable();
		$('cond_variable').enable();
	}
	else {
		$('tr_conditionnement_nom').hide();
		$('tr_conditionnement_fixe').hide();
		$('tr_conditionnement_variable').hide();
		$('cond_fixe').disable();
		$('cond_fixe').checked = false;
		$('cond_variable').disable();
		$('cond_variable').checked = false;
		$('cond_taille').disable();
		$('cond_taille_inf').disable();
		$('cond_taille_sup').disable();
	}	
}

function selectionneConditionnementFixe(){
	if ($('cond_fixe').checked){
		$('cond_taille').enable();
		$('cond_variable').checked = false;
		$('cond_taille_inf').disable();
		$('cond_taille_sup').disable();
	}
	else {
		$('cond_taille').disable();
		$('cond_variable').checked = true;
		$('cond_taille_inf').enable();
		$('cond_taille_sup').enable();
	}	
}

function selectionneConditionnementVariable(){
	if ($('cond_variable').checked){
		$('cond_taille_inf').enable();
		$('cond_taille_sup').enable();
		$('cond_fixe').checked = false;
		$('cond_taille').disable();
	}
	else {
		$('cond_taille_inf').disable();
		$('cond_taille_sup').disable();
		$('cond_fixe').checked = true;
		$('cond_taille').enable();
	}	
}