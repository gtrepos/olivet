function checkActu(){
	if (valideFormActu()) {
		$('libelle').value = $('libelle').value.trim();
		$('descriptif').value = $('descriptif').value.trim();
		document.form_actualite.submit();
	}
}

function valideFormActu(){

	var libelle = $('libelle').value.trim(); 
	var descriptif = $('descriptif').value.trim(); 
	var type = $('type').value;
	
	if (libelle == '') {
		alert("Vous devez renseigner un libellé.");
		$('libelle').focus();
		return false;
	}
	
	if (descriptif == '') {
		alert("Vous devez renseigner un descriptif.");
		$('descriptif').focus();
		return false;
	}
	
	if (type == -1) {
		alert("Vous devez renseigner le type d'actualité.");
		$('type').focus();
		return false;
	}
	
	return true;
}

function alerteSuppressionActu(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer l\'actualité \'' + libelle + '\' ('+id+') ?')){
		new Ajax.Request("./fonctions/ajax.php", {
			method : 'post',
			parameters : {
				event : 'supprimeActualite',
				id : id,
			},
			onComplete : function(transport) {
				location.href = "./?page=actualites&action=lister";
			}
		});
	}
}