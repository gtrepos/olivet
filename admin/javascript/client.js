function checkClient(){
	alert('check');
}

function alerteSuppressionClient(ref, nom, prenom){
	if (confirm('�tes vous s�r de vouloir supprimer le client \'' + nom + ' ' + prenom + '\' ('+ref+') ?')){
		location.href = 'index.php?page=clients&action=supprimer&ref='+ref;
	}	
}