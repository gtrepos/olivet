function alerteSuppressionAbonne(email){
	if (confirm('Êtes vous sûr de vouloir supprimer l\'abonné \'' + email + '\' ?')){
		new Ajax.Request("./fonctions/ajax.php", {
			method : 'post',
			parameters : {
				event : 'supprimerAbonneNewsletter',
				email : email
			},
			onComplete : function(transport) {
				location.href = "./?page=abonnesNewsletter";
			}
		});
	}
}