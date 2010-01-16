

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
	var client_code = $F('client_code');
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
					 client_mail: client_mail, client_code: client_code, nclient_mail: nclient_mail,
					 nclient_nom: nclient_nom, nclient_prenom: nclient_prenom,
					 nclient_adresse: nclient_adresse, nclient_postal: nclient_postal,
					 nclient_commune: nclient_commune, nclient_tel: nclient_tel
		            },
		onComplete: manageClickValid1,
		onFailure : function(){ alert('Something went wrong...') }
			});
	
	
}

function clickCheckClient(){
	
	var client_mail = $F('client_mail');
	var client_code = $F('client_code');
	
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickCheckClient', 
					 client_mail: client_mail, 
					 client_code: client_code
		            },
		onComplete: manageClickCheckClient,
		onFailure : function(){ alert('Something went wrong...') }
			});
	
	
}

function clickCheckClient(){
	
	var client_mail = $F('client_mail');
	var client_code = $F('client_code');
	
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickCheckClient', 
					 client_mail: client_mail, 
					 client_code: client_code
		            },
		onComplete: manageClickCheckClient,
		onFailure : function(){ alert('Something went wrong...') }
			});
	
	
}

function manageClickCheckClient(transport){
	if(transport.responseText.match("Erreur dans le formulaire")){
		alert(transport.responseText);		
	}else{
		$('mesinfos').innerHTML= transport.responseText;
	}
}

function clickCheckModifClient(){
	
	var client_mail = $F('client_mail');
	var client_nom = $F('client_nom');
	var client_prenom = $F('client_prenom');
	var client_adresse = $F('client_adresse');
	var client_postal = $F('client_postal');
	var client_commune = $F('client_commune');
	var client_tel = $F('client_tel');
	var client_ref = $F('client_ref');
	
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickCheckModifClient', 
						client_mail: client_mail,
						client_nom: client_nom, 
						client_prenom: client_prenom,		 
						client_adresse: client_adresse, 
						client_postal: client_postal,
						client_commune: client_commune, 
						client_tel: client_tel,
						client_ref: client_ref
						
		            },
		onComplete: manageClickCheckModifClient,
		onFailure : function(){ alert('Something went wrong...') }
			});	
}

function manageClickCheckModifClient(transport){
	if(transport.responseText.match("Erreur dans le formulaire")){
		alert(transport.responseText);
	}else{
		$('mesinfos').innerHTML= transport.responseText;
	}
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

function clickSetNbArticles(cond, id){
	var nb_articles;
	if(cond == 1){
		nb_articles = $F('nbarticles_1_'+id);
	}else{
		nb_articles = $F('nbarticles_0_'+id)
	}
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'clickSetNbArticles', 
		  id: id, cond: cond, 
		  nb_articles: nb_articles},
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
	
	new Ajax.Request("tools/visitor_ajax.php", 
			{ 
		method: 'post', 
		parameters:{event: 'produits_dispo'},
		onComplete: function(transport){
			$('produits_dispo').innerHTML= transport.responseText;
			//close all items in MenuProduitsDispo
		    all_cat = "ul.categories";
			all_prod = "div.products";
			jQuery(all_prod).hide();
			jQuery(all_cat).attr("open","false");
		}
			});
}


function clickMenuProditsDispo(id_cat){
	sel_cat = "ul#MenuProduitsDispoCat"+id_cat;
	sel_prod = "div.MenuProduitsDispoProd"+id_cat;
	all_cat = "ul.categories";
	all_prod = "div.products";
	if(jQuery(sel_cat).attr("open") == "true"){
		//close sel
		jQuery(sel_prod).hide();
		jQuery(sel_prod).slideUp("normal");
		jQuery(sel_cat).attr("open","false");
		
	}else{
		//close all
		jQuery(all_prod).hide();
		jQuery(all_cat).attr("open","false");
		//open sel
		jQuery(sel_prod).slideDown("normal");
		jQuery(sel_cat).attr("open","true");
	}
	
}



jQuery.noConflict();

jQuery(document).ready( function () {
	/*************************
	* menu_deroulant1, partenaires
	**************************/
    // On cache les sous-menus
    // sauf celui qui porte la classe "open_at_load" :
    jQuery("ul.subMenu1:not('.open_at_load')").hide();
    // On selectionne tous les items de liste portant la classe "toggleSubMenu"

    // et on remplace l'element span qu'ils contiennent par un lien :
    jQuery("li.toggleSubMenu1 span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = jQuery(this).text();
        jQuery(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '</a>') ;
    } ) ;

    // On modifie l'evenement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    jQuery("li.toggleSubMenu1 > a").click( function () {
        // Si le sous-menu etait deja ouvert, on le referme :
        if (jQuery(this).next("ul.subMenu1:visible").length != 0) {
            jQuery(this).next("ul.subMenu1").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
        }
        // Si le sous-menu est cache, on ferme les autres et on l'affiche :
        else {
            jQuery("ul.subMenu1").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
            jQuery(this).next("ul.subMenu1").slideDown("normal", function () { jQuery(this).parent().addClass("open") } );
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });

    /***********************
     * menu_deroulant2, produits dispo
	**************************/
    //at initialisation close all
    all_cat = "ul.categories";
	all_prod = "div.products";
	jQuery(all_prod).hide();
	jQuery(all_cat).attr("open","false");
} ) ;
