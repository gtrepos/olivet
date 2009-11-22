

function manageClickValid1(transport){
	if(transport.responseText.match("Erreur dans le formulaire")){
		alert(transport.responseText);
		new Ajax.Request('tools/visitor_ajax.php', 
				{ 
			method: 'post', 
			parameters: {event: 'updateCaptcha'},
			onComplete: function(transport){
				$('commander-captcha').innerHTML= transport.responseText;
			},
			onFailure : function(){ alert('Something went wrong...') }
				});
	}else{
		$('centre-commander').innerHTML= transport.responseText;
	}
}



function clickEntete(menu){
	
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickEntete', menu: menu},
		onComplete: function(transport){
			switch(menu){
			case 'accueil' :
			case 'produits' :
			case 'commander' :
			case 'contacts' :
			case 'ferme' :
				$('centre').innerHTML= transport.responseText;
				break;
			default :
				alert('Something went wrong... '+menu)
				break;
			}


		},
		onFailure : function(){ alert('Something went wrong...') }
			});
	
}

function clickValid1(){
	
	var securimage_code = $F('securimage_code');
	var client_mail = $F('client_mail');
	var client_ref = $F('client_ref');
	var nclient_mail = $F('nclient_mail');
	var nclient_nom = $F('nclient_nom');
	var nclient_prenom = $F('nclient_prenom');
	var nclient_adresse = $F('nclient_adresse');
	var nclient_postal = $F('nclient_postal');
	var nclient_commune = $F('nclient_commune');
	var nclient_tel = $F('nclient_tel');
	
	
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickValid1', securimage_code: securimage_code,
					 client_mail: client_mail, client_ref: client_ref, nclient_mail: nclient_mail,
					 nclient_nom: nclient_nom, nclient_prenom: nclient_prenom,
					 nclient_adresse: nclient_adresse, nclient_postal: nclient_postal,
					 nclient_commune: nclient_commune, nclient_tel: nclient_tel
		            },
		onComplete: manageClickValid1,
		onFailure : function(){ alert('Something went wrong...') }
			});
	
	
}



function clickCategorieProduits(id_cat_prod){
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickCategorieProduits', id_cat_prod: id_cat_prod},
		onComplete: function(transport){
			$('centre-commander-mon_panier').innerHTML= transport.responseText;
		},
		onFailure : function(){ alert('Something went wrong...') }
			});

}

function clickSetNbArticles(id_prod){
	var nb_articles = $F('nbarticles_'+id_prod);	
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'clickSetNbArticles', id_prod: id_prod, nb_articles: nb_articles},
		onComplete: function(transport){
			$('banniere-resume_panier').innerHTML= transport.responseText;
		}
			});
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'updateCommanderPanier'},
		onComplete: function(transport){
			$('centre-commander-mon_panier').innerHTML= transport.responseText;
		}
			});
}


function clickVoirCommande(){
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'clickVoirCommande'},
		onComplete: function(transport){
			$('centre-commander').innerHTML= transport.responseText;
		}
			});
}


function clickViderPanier(){
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'clickViderPanier'},
		onComplete: function(transport){
			$('banniere-resume_panier').innerHTML= transport.responseText;
		}
			});
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'updateCommanderPanier'},
		onComplete: function(transport){
			$('centre-commander-mon_panier').innerHTML= transport.responseText;
		}
			});
	
	
	jQuery("ul.subMenu2").hide();
}


