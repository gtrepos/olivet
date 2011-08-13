function checkCategorie(){
	if (valideFormCategorie()) {
		$('libelle').value = $('libelle').value.trim(); 
		document.form_categorie.submit();
	}
}

function valideFormCategorie(){
	var libelle = $('libelle').value.trim(); 
	
	if (libelle == '') {
		alert("Vous devez renseigner un libellé.");
		$('libelle').focus();
		return false;
	}
	return true;
}

function alerteSuppressionCategorie(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer la catégorie \'' + libelle + '\' ('+id+') ?')){
		new Ajax.Request("./fonctions/ajax.php", {
			method : 'post',
			parameters : {
				event : 'supprimeCategorie',
				id : id,
			},
			onComplete : function(transport) {
				location.href = "./?page=categories";
			}
		});
	}
}