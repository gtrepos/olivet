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
	var rang = $('rang').value.trim();
	
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
	
	if (!prepareJoursDispo()){
		alert("Vous devez choisir au moins un jour dispo.");
		return false;
	}
	
	return true;
	
}

function prepareJoursDispo(){
	var valeur = document.form_produit.jourDispo;
    var tmp="";
    for (var i=0;i < valeur.length; i++) {    
    	if ( valeur[i].checked ) {
    		tmp+=valeur[i].value+"|";
    	}
    }
    if (tmp!="") {
    	$('concatJoursDispos').value=tmp;
    	return true;
    }
    else {
    	return false;
    }
    
}

function alerteSuppressionProduit(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produits&action=supprimer&id='+id;
	}
}
