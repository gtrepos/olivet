function checkPartenaire(){
	alert('check');
}

function alerteSuppressionPartenaire(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer le partenaire \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=partenaires&action=supprimer&id='+id;
	}
}