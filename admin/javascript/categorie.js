function checkCategorie(){
	alert('check');
}

function alerteSuppressionCategorie(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer la cat�gorie \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=categories&action=supprimer&id='+id;
	}
}