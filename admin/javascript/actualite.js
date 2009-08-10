function checkActu(){
	alert('check');
}

function alerteSuppressionActu(id, libelle){
	if (confirm('Êtes vous sûr de vouloir supprimer l\'actualité \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=actualites&action=supprimer&id='+id;
	}
}