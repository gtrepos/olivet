function checkCategorie(){
	alert('check');
}

function alerteSuppressionCategorie(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer la catégorie \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=categories&action=supprimer&id='+id;
	}
}