function checkProduit(){
	alert('check_produit');
}

function alerteSuppressionProduit(id, libelle){
	if (confirm('�tes vous s�r de vouloir supprimer le produit \'' + libelle + '\' ('+id+') ?')){
		location.href = 'index.php?page=produits&action=supprimer&id='+id;
	}
}