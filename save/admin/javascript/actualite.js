function checkActu(){
	alert('check');
}

function alerteSuppressionActu(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer l\'actualit� \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=actualites&action=supprimer&id='+id;
	}
}