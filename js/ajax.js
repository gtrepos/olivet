//pour ne pas avoir de conflit avec prototype.js qui notamment propose 
//une fonction $ qui remplace document.getElementById, alors que jQuery la propose également
jQuery.noConflict();

// Adresse sur laquelle le carte sera centrer et ou sera placer le marqueur
var cfg_adress = 'Olivet, 35000 Servon Sur Vilaine';

// Largeur de la carte
var cfg_largeur = '500px';

// Hauteur de la carte
var cfg_hauteur = '400px';

// Niveau de zoom, entre 1 (niveau globe) et 17 (niveau rue)
var cfg_zoomLevel = 13;

// Texte pour le popup
// Si vous ne souahitez pas de poupup laisser mettre simplement "" comme valeur
var cfg_description = ""
		+ "<table border='0' width='207' cellpadding='3' cellspacing='0'>"
		+ "<tr><td valign='top'>"
		+ "<div style='color: blue; font-size: 14px; font-weight:bold;'>"
		+ "Ferme D'olivet" + "</div><br/>" + "Gaec à 3 voix, L'Olivet<br/>"
		+ "35530 SERVON-SUR-VILAINE<br/>" + "02 99 55 28 69<br/>"
		+ "<a href='http://fermeolivet.free.fr'>http://fermeolivet.free.fr</a>"
		+ "</td>" +
		// "<td>"+
		// "<img
		// src='http://www.business-in-europe.com/fr/visuals/new-voie-express.gif'"
		// +
		// "border='0' alt='Photo' vspace='5' align='right' />"+
		// "</td>"+
		"</tr></table>";

// Variable globale pour l'objet GMAP2
var map;

// Variable global pour l'objet GClientGeocoder qui traduit une adresse en
// longitude,latitude
var geocoder;

// Function appellée au chargement de la page web
// Créee et configure la carte
function loadMyMap() {

	// Teste si le navigateur est compatible avec l'API Gmaps

	// Affecte la carte à la div  "map_olivet" (voir tout en bas)
     var divMap    = document.getElementById("map_olivet");
             
 if (GBrowserIsCompatible()) {
        
     // Redimensionne la carte
     divMap.style.width    = cfg_largeur;
     divMap.style.height    = cfg_hauteur;
    
     // Création des objets princiapux
     map         = new GMap2(divMap); 
     geocoder     = new GClientGeocoder();
    
     // Pour zoomer avec la molette de la souris
     // Pour le désactiver ajouter // devant la ligne suivante ou bien la supprimer :)
     map.enableScrollWheelZoom();
    
     // Grande barre de zoom
     map.addControl(new GLargeMapControl());
    
     // Ou bien : Deux boutons zoom + 4 directions
     //map.addControl(new GSmallMapControl());
    
     // Ou bien : Juste deux boutons pour zoomer et dézoomer
     //map.addControl(new GSmallZoomControl());
    
     //Pour switcher entre les différentes vues (sattelite, plan, hybride)
     map.addControl(new GMapTypeControl());                       
    
     // On centre la carte sur votre adresse
     centerMapOnAdress(cfg_adress);
 }else{
 	divMap.innerHTML = "Votre navigateur ne permet pas l\'affichage de carte Google Maps : ";
 }

}

// Centre une carte sur une adresse
// Geocode l'adresse
// Message d'erreur si adresse non trouvé
function centerMapOnAdress(adresse) {

	if (!adresse.length)
		alert('Remplir la variable adresse');

	// Décodage de l'adresse
	geocoder.getLatLng(adresse, function(point) {

		// Adresse introuvable
			if (!point) {
				alert('Adresse : ' + addresse + " introuvable");
			} else {

				// Centre la carte sur l'adresse
			map.setCenter(point, cfg_zoomLevel);

			// On créer un marqueur à l'adresse spécifiée
			var marker = new GMarker(point);

			var textePopUp = cfg_description;

			// Si il y a une description
			if (textePopUp.length) {

				// Affiche un popup lors du clic sur le marqueur
				GEvent.addListener(marker, "click", function() {
					marker.openInfoWindowHtml(textePopUp);
				});
				// Affiche le marqueur
				map.addOverlay(marker);

				// Par défaut on affiche le popup tout de suite sans attendre un
				// clic
				// Désactiver en commentant la ligne
				marker.openInfoWindowHtml(textePopUp);
			} else
				map.addOverlay(marker); // Affiche le marqueur
		}
	});

}

function manageClickValid1(transport) {
	if (transport.responseText.match("Erreur dans le formulaire")) {
		alert(transport.responseText);
		new Ajax.Request('tools/visitor_ajax.php', {
			method : 'post',
			parameters : {
				event : 'updateCaptcha'
			},
			onComplete : function(transport) {
				$('commander-captcha').innerHTML = transport.responseText;
			},
			onFailure : function() {
				alert('Something went wrong...')
			}
		});
	} else {
		$('principal').innerHTML = transport.responseText;
	}
}

function clickNavigation(menu) {

	new Ajax.Request('tools/visitor_ajax.php', {

		method : 'post',
		parameters : {
			event : 'clickNavigation',
			menu : menu
		},
		onComplete : function(transport) {
			switch (menu) {
			case 'accueil':
			case 'la_ferme':
			case 'commander':
			case 'actualites':
			case 'mesinfos':
				$('principal').innerHTML = transport.responseText;
				break;
			case 'nos_produits':
				$('principal').innerHTML = transport.responseText;
				closeAllProducts();
				break;
			case 'nous_contacter':
				$('principal').innerHTML = transport.responseText;
				// Au chargement de la page on affiche la carte
		loadMyMap();
		// window.onload=loadMyMap;
		// A la fermeture de la page on libère la mémoire allouée à la carte
		// window.onunload=GUnload;
		break;
	default:
		alert('Something went wrong... ' + menu);

		break;
	}

},
onFailure : function() {
	alert('Something went wrong...');
}
	});

}

function clickValid1() {

	var securimage_code = $F('securimage_code');
	var client_mail = $F('client_mail');
	var client_mdp = $F('client_mdp');
	var nclient_mail = $F('nclient_mail');
	var nclient_mdp1 = $F('nclient_mdp1');
	var nclient_mdp2 = $F('nclient_mdp2');
	var nclient_nom = $F('nclient_nom');
	var nclient_prenom = $F('nclient_prenom');
	var nclient_adresse = $F('nclient_adresse');
	var nclient_postal = $F('nclient_postal');
	var nclient_commune = $F('nclient_commune');
	var nclient_tel = $F('nclient_tel');
	var daterecup_commande = $F('daterecup_commande');
	
	new Ajax.Request('tools/visitor_ajax.php', {
		method : 'post',
		parameters : {
			event : 'clickValid1',
			securimage_code : securimage_code,
			client_mail : client_mail,
			client_mdp : client_mdp,
			nclient_mail : nclient_mail,
			nclient_mdp1 : nclient_mdp1,
			nclient_mdp2 : nclient_mdp2,
			nclient_nom : nclient_nom,
			nclient_prenom : nclient_prenom,
			nclient_adresse : nclient_adresse,
			nclient_postal : nclient_postal,
			nclient_commune : nclient_commune,
			nclient_tel : nclient_tel,
			daterecup_commande : daterecup_commande
		},
		onComplete : manageClickValid1,
		onFailure : function() {
			alert('Something went wrong...')
		}
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

function clickPasserCommande() {
	new Ajax.Request('tools/visitor_ajax.php', {
		method : 'post',
		parameters : {
			event : 'clickPasserCommande'
		},
		onComplete : function(transport) {
			if (transport.responseText.match("Erreur dans le formulaire")) {
				alert(transport.responseText);
			} else {
				$('principal').innerHTML = transport.responseText;
			}
		}
	// onFailure : function() {
			// alert('Something went wrong...');
			// }
			});
}

function manageClickCheckClient(transport) {
	if (transport.responseText.match("Erreur dans le formulaire")) {
		alert(transport.responseText);
	} else {
		$('mesinfos').innerHTML = transport.responseText;
	}
}

function clickCheckModifClient(){
	
	var client_civilite = $F('client_civilite');
	var client_nom = $F('client_nom');
	var client_prenom = $F('client_prenom');
	var client_mail = $F('client_mail');
	var client_adresse = $F('client_adresse');
	var client_postal = $F('client_postal');
	var client_commune = $F('client_commune');
	var client_tel = $F('client_tel');
	var client_ref = $F('client_ref');
	
	new Ajax.Request('tools/visitor_ajax.php', 
			{ 
		method: 'post', 
		parameters: {event: 'clickCheckModifClient', 
						client_civilite: client_civilite,
						client_nom: client_nom, 
						client_prenom: client_prenom,
						client_mail: client_mail,
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

function manageClickCheckModifClient(transport) {
	if (transport.responseText.match("Erreur dans le formulaire")) {
		alert(transport.responseText);
	} else {
		$('mesinfos').innerHTML = transport.responseText;
	}
}

function clickSelectCatProduit(categorie_produit_id) {
	
	new Ajax.Request('tools/visitor_ajax.php', {

		method : 'post',
		parameters : {
			event : 'clickNavigation',
			menu : 'nos_produits'
		},
		onComplete : function(transport) {
			$('principal').innerHTML = transport.responseText;
			clickMenuProduitsDispo(categorie_produit_id);
		},
		onFailure : function() {
			alert('Something went wrong...');
		}
	});
}

function clickActualite() {
	clickNavigation('actualites');
}

function clickSetNbArticles(cond, id) {

	var nb_articles;
	if (cond == 1) {
		nb_articles = $F('nbarticles_1_' + id);
	} else {
		nb_articles = $F('nbarticles_0_' + id)
	}
	new Ajax.Request("tools/visitor_ajax.php", {
		method : 'post',
		parameters : {
			event : 'clickSetNbArticles',
			id : id,
			cond : cond,
			nb_articles : nb_articles
		},
		onComplete : function(transport) {
			$('banniere-resume_panier').innerHTML = transport.responseText;
		}
	});
	new Ajax.Request(
			"tools/visitor_ajax.php",
			{
				method : 'post',
				parameters : {
					event : 'updateCommanderPanier'
				},
				onComplete : function(transport) {
					$('centre-commander-mon_panier').innerHTML = transport.responseText;
				}
			});
}

function clickSetQuantite(cond, id) {
	var idInput;
	var qtProd;
	if (cond == 1) {
		idInput = 'qtProd_1_' + id;

	} else {
		idInput = 'qtProd_0_' + id;
	}
	qtProd = $F(idInput);

	if (!isNaN(qtProd) && qtProd >= 0 && qtProd <= 100) {
		// alert('ok pour '+qtProd);
		new Ajax.Request("tools/visitor_ajax.php", {
			method : 'post',
			parameters : {
				event : 'clickSetQuantite',
				id : id,
				cond : cond,
				quantite : qtProd
			},
			onComplete : function(transport) {
				$('banniere-resume_panier').innerHTML = transport.responseText;
			}
		});
		new Ajax.Request(
				"tools/visitor_ajax.php",
				{
					method : 'post',
					parameters : {
						event : 'updateCommanderPanier'
					},
					onComplete : function(transport) {
						$('centre-commander-mon_panier').innerHTML = transport.responseText;
					}
				});
	} else {
		alert('Vous devez saisir un nombre entre  0 et 100');
		var moninput = document.getElementById(idInput);
		moninput.focus();
		moninput.value = '0';
	}
}

function clickVoirCommande() {
	new Ajax.Request("tools/visitor_ajax.php", {
		method : 'post',
		parameters : {
			event : 'clickVoirCommande'
		},
		onComplete : function(transport) {
			$('centre-commander').innerHTML = transport.responseText;
		}
	});
}

function clickViderPanier() {
	
	//enchainement 2 requete asynchrones en reponse du vidage de panier
	new Ajax.Request(
			"tools/visitor_ajax.php",
			{
				method : 'post',
				parameters : {
					event : 'clickViderPanier'
				},
				onComplete : function(transport) {
					//alert('revenu de clickViderPanier');
					$('banniere-resume_panier').innerHTML = transport.responseText;
					new Ajax.Request(
							"tools/visitor_ajax.php",
							{
								method : 'post',
								parameters : {
									event : 'updateCommanderPanier'
								},
								onComplete : function(transport) {
									$('centre-commander-mon_panier').innerHTML = transport.responseText;
									//alert('revenu de updateCommanderPanier');
									
								}
							});
					new Ajax.Request(
							"tools/visitor_ajax.php",
							{
								method : 'post',
								parameters : {
									event : 'updateProduitsDispo'
								},
								onComplete : function(transport) {
									$('centre-nos_produits-produits_dispo').innerHTML = transport.responseText;
									closeAllProducts();
									//alert('revenu de updateProduitsDispo');
								}
								
							});
				}
			});

	

}

function clickMenuProduitsDispo(id_cat) {
	
	//alert(' CatProd ');
	
	sel_cat = "ul#MenuProduitsDispoCat" + id_cat;
	sel_prod = "div.MenuProduitsDispoProd" + id_cat;
	all_cat = "ul.categories";
	all_prod = "div.products";
	if (jQuery(sel_cat).attr("open") == "true") {
		// close sel
		jQuery(sel_prod).hide();
		jQuery(sel_prod).slideUp("normal");
		jQuery(sel_cat).attr("open", "false");

	} else {
		// close all
		jQuery(all_prod).hide();
		jQuery(all_cat).attr("open", "false");
		// open sel
		jQuery(sel_prod).slideDown("normal");
		jQuery(sel_cat).attr("open", "true");
	}

}

function closeAllProducts() {
	// close all items in MenuProduitsDispo
	all_cat = "ul.categories";
	all_prod = "div.products";
	jQuery(all_prod).hide();
	jQuery(all_cat).attr("open", "false");
}

jQuery(document)
		.ready(function() {
			/*******************************************************************
			 * menu_deroulant1, partenaires
			 ******************************************************************/
			// On cache les sous-menus
				// sauf celui qui porte la classe "open_at_load" :
				jQuery("ul.subMenu1:not('.open_at_load')").hide();
				// On selectionne tous les items de liste portant la classe
				// "toggleSubMenu"

				// et on remplace l'element span qu'ils contiennent par un lien
				// :
				jQuery("li.toggleSubMenu1 span")
						.each(function() {
							// On stocke le contenu du span :
								var TexteSpan = jQuery(this).text();
								jQuery(this)
										.replaceWith(
												'<a href="" title="Afficher le sous-menu">' + TexteSpan + '</a>');
							});

				// On modifie l'evenement "click" sur les liens dans les items
				// de liste
				// qui portent la classe "toggleSubMenu" :
				jQuery("li.toggleSubMenu1 > a")
						.click(function() {
							// Si le sous-menu etait deja ouvert, on le referme
								// :
								if (jQuery(this).next("ul.subMenu1:visible").length != 0) {
									jQuery(this).next("ul.subMenu1").slideUp(
											"normal",
											function() {
												jQuery(this).parent()
														.removeClass("open")
											});
								}
								// Si le sous-menu est cache, on ferme les
								// autres et on l'affiche :
								else {
									jQuery("ul.subMenu1").slideUp(
											"normal",
											function() {
												jQuery(this).parent()
														.removeClass("open")
											});
									jQuery(this).next("ul.subMenu1").slideDown(
											"normal",
											function() {
												jQuery(this).parent().addClass(
														"open")
											});
								}
								// On empêche le navigateur de suivre le lien :
								return false;
							});

				/***************************************************************
				 * menu_deroulant2, produits dispo
				 **************************************************************/
				// at initialisation close all
				all_cat = "ul.categories";
				all_prod = "div.products";
				jQuery(all_prod).hide();
				jQuery(all_cat).attr("open", "false");
			});
