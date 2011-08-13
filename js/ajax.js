//pour ne pas avoir de conflit avec prototype.js qui notamment propose 
//une fonction $ qui remplace document.getElementById, alors que jQuery la propose également
jQuery.noConflict();

// Adresse sur laquelle le carte sera centrer et ou sera placer le marqueur, dans la page Infos pratiques
var cfg_adress = 'Olivet, 35000 Servon Sur Vilaine';

//Adresse sur laquelle le carte sera centrer et ou sera placer le marqueur, dans la page Producteurs
var cfg_adress_prod = 'Liffré, 35';

// Largeur de la carte
var cfg_largeur = '600px';

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
		+ "35530 SERVON-SUR-VILAINE<br/>" + "06 62 09 27 62<br/>"
		+ "<a href='http://fermeolivet.free.fr'>http://fermeolivet.free.fr</a>"
		+ "</td></tr>"
		+ "</table>";

// Variable globale pour l'objet GMAP2
var map;

// Variable global pour l'objet GClientGeocoder qui traduit une adresse en
// longitude,latitude
var geocoder;

// Function appellée au chargement de la page web
// Créee et configure la carte
function loadMyMap(hideOlivet) {

	// Teste si le navigateur est compatible avec l'API Gmaps

	// Affecte la carte à la div  "map_olivet" (voir tout en bas)
     var divMap = document.getElementById("map_olivet");
             
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
    
     // On centre la carte sur une adresse
     if (hideOlivet) {
    	 centerMapOnAdress(cfg_adress_prod, hideOlivet); 	 
     }
     else {
    	 centerMapOnAdress(cfg_adress, hideOlivet);
     }
     
 }else{
 	divMap.innerHTML = "Votre navigateur ne permet pas l\'affichage de carte Google Maps : ";
 }

}

// Centre une carte sur une adresse
// Geocode l'adresse
// Message d'erreur si adresse non trouvé
function centerMapOnAdress(adresse, hideOlivet) {

	if (!adresse.length)
		alert('Remplir la variable adresse');

	// Décodage de l'adresse
	geocoder.getLatLng(adresse, function(point) {

		// Adresse introuvable
			if (!point) {
				alert('Adresse : ' + addresse + " introuvable");
			} else {
				
			// Centre la carte sur l'adresse
				
			if (!hideOlivet) {	
				point = new GLatLng('48.106636','-1.465368');
				map.setCenter(point, cfg_zoomLevel);
			} else { 
				map.setCenter(point, 9);
			}	
			
			if (!hideOlivet) {
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
		new Ajax.Request("tools/visitor_ajax.php", {
			method : 'post',
			parameters : {
				event : 'updateResumePanier'
			},
			onComplete : function(transport) {
				$('banniere-resume_panier').innerHTML = transport.responseText;
			}
		});
	}
}

function clickFerme() {
	clickNavigation('la_ferme');
}

function clickProduits() {
	clickNavigation('nos_produits');
}

function clickCommander() {
	clickNavigation('commander');
}

function clickNousContacter() {
	clickNavigation('nous_contacter');
}

function clickNavigation(menu) {

	new Ajax.Request('tools/visitor_ajax.php', {

		method : 'post',
		parameters : {
			event : 'clickNavigation',
			menu : menu
		},
		onLoading : function(){$('principal').innerHTML = 'Chargement en cours, merci de patienter quelques instants ...';}, 
		onComplete : function(transport) {
			switch (menu) {
			case 'accueil':
				$('principal').innerHTML = transport.responseText;
				break;
			case 'la_ferme':
				$('principal').innerHTML = transport.responseText;
				break;
			case 'magasin':
				$('principal').innerHTML = transport.responseText;
				loadMyMap(true);
				addProducteursMarkers();
				break;
			case 'commander':
				$('principal').innerHTML = transport.responseText;
				break;
			case 'actualites':
				$('principal').innerHTML = transport.responseText;
				break;
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
				loadMyMap(false);
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
	var daterecup_commande = $('daterecup_commande')!=null ? $F('daterecup_commande') : null;
	var nclient_civilite = $F('nclient_civilite');
	
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
			daterecup_commande : daterecup_commande,
			nclient_civilite : nclient_civilite
		},
		onComplete : manageClickValid1,
		onFailure : function() {
			alert('Something went wrong...')
		}
	});

}

function clickCheckClient(){
	
	var client_mail = $('client_mail').value;
	var client_code = $('client_code').value;
	
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
				
				var maintenant = new Date(); 
				minDatePicker = "0";
				
				//si commande après 15h30 le vendredi, date de récupération possible seulement le lendemain.
				if (maintenant.getDay()==5) {
					if ((maintenant.getHours()==15 && maintenant.getMinutes()>30) || maintenant.getHours()>15) {
						minDatePicker = "+1";
					}
				}
				
				//si commande le samedi, date de récupération possible le vendredi suivant
				if (maintenant.getDay()==6) {
					minDatePicker = "+6";
				}
				
				jQuery(function() {
					jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ "fr" ] );
					jQuery( "#daterecup_commande" ).datepicker({ minDate: minDatePicker, maxDate: "+2M", beforeShowDay:filtreJoursRecup });
				});
			}
		}
	// onFailure : function() {
			// alert('Something went wrong...');
			// }
			});
}

/*jour compris entre vendredi et samedi
 * pas un jour ferie */

function filtreJoursRecup(datePicker) {
	var day = datePicker.getDay();
	var retour = (day>4&&day<=6) && !isJourFerie(datePicker); 
	return[retour,""];
}

function isJourFerie(datePicker){
	var joursFeries = JoursFeries(datePicker.getFullYear());
	for (i=0;i<joursFeries.length;i++) {
		if (isDateEquivalente(datePicker,joursFeries[i])) {
			return true;
		}
	}
	return false;
}

function JoursFeries (an){
    var JourAn = new Date(an, "00", "01");
    var FeteTravail = new Date(an, "04", "01");
    var Victoire1945 = new Date(an, "04", "08");
    var FeteNationale = new Date(an,"06", "14");
    var Assomption = new Date(an, "07", "15");
    var Toussaint = new Date(an, "10", "01");
    var Armistice = new Date(an, "10", "11");
    var Noel = new Date(an, "11", "25");
    
    var G = an%19;
    var C = Math.floor(an/100);
    var H = (C - Math.floor(C/4) - Math.floor((8*C+13)/25) + 19*G + 15)%30;
    var I = H - Math.floor(H/28)*(1 - Math.floor(H/28)*Math.floor(29/(H + 1))*Math.floor((21 - G)/11));
    var J = (an*1 + Math.floor(an/4) + I + 2 - C + Math.floor(C/4))%7;
    var L = I - J;
    var MoisPaques = 3 + Math.floor((L + 40)/44);
    var JourPaques = L + 28 - 31*Math.floor(MoisPaques/4);
    var Paques = new Date(an, MoisPaques-1, JourPaques);
    var LundiPaques = new Date(an, MoisPaques-1, JourPaques+1);
    var Ascension = new Date(an, MoisPaques-1, JourPaques+39);
    var Pentecote = new Date(an, MoisPaques-1, JourPaques+49);
    var LundiPentecote = new Date(an, MoisPaques-1, JourPaques+50);
    
    return new Array(JourAn, Paques, LundiPaques, FeteTravail, Victoire1945, Ascension, Pentecote, LundiPentecote, FeteNationale, Assomption, Toussaint, Armistice, Noel);
    
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
	var client_motpasse = $F('client_motpasse');
	var client_confmotpasse = $F('client_confmotpasse');
	
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
						client_ref: client_ref,
						client_motpasse: client_motpasse,
						client_confmotpasse: client_confmotpasse						
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

/**
 * @deprecated
 * @param cond
 * @param id
 * @return
 */
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

function checkDivisible(divisible, cond, id) {
	var idInput;
	var qtProd;
	if (cond == 1) {
		idInput = 'qtProd_1_' + id;

	} else {
		idInput = 'qtProd_0_' + id;
	}
	qtProd = $F(idInput);
	
	//impossible de saisir une virgule
	if (qtProd.lastIndexOf(',')>0) {
		alert("Veuillez remplacer la virgule (,) par un point (.)");
		var moninput = $(idInput);
		moninput.focus();
		moninput.value = '0';
		return false;
	}
	
	//cas non divisible
	if (!isNaN(qtProd) && qtProd.lastIndexOf('.')>0 && divisible == '0') {
		alert('Ce produit n\'est pas divisible');
		var moninput = $(idInput);
		moninput.focus();
		moninput.value = '0';
		return false;
	}
	//cas divisible
	if (!isNaN(qtProd) && qtProd.indexOf('.')>0 && divisible == '1') {
		var decimales = qtProd.substr(qtProd.lastIndexOf('.')+1,qtProd.length);
		if (decimales.length>2) {
			alert('Ce produit est divisible mais votre saisie n\'est pas bonne.\nElle contient plus de 2 décimales.');
			var moninput = $(idInput);
			moninput.focus();
			moninput.value = '0';
			return false;
		}
	}
	
	return true;
}

/**
 * met a jour la quantite d'un produit pour 
 * dans le panier
 * @param cond  egal 1 sic'est un produit conditionne 
 * @param id l'id du produit 
 * @param pageCommander egal 1 si la requete vient de la page commander
 * @return
 */
function clickSetQuantite(cond, id, pageCommander) {

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
				if(pageCommander){
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
			}
		});
	} else {
		alert('Vous devez saisir un nombre entre 0 et 100');
		var moninput = $(idInput);
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

//Creates a marker whose info window displays the given number
function createMarker(point, html, title, image)
{
	var icon = new GIcon(); 
	icon.image = image;
	icon.iconSize = new GSize(12, 20);
	icon.iconAnchor = new GPoint(6, 20);
	icon.infoWindowAnchor = new GPoint(5, 1);
	var options = { 
			title: title,
			icon: icon
	};
	var marker = new GMarker(point, options);
	GEvent.addListener(marker, "click", function() {marker.openInfoWindowHtml(html);});
	return marker;
};

function addProducteursMarkers(){
	var url = './visiteur/centre/magasin/getInfosProducteurs.php';
	jQuery.getJSON(url, gestionProducteursMarkers);
}

function gestionProducteursMarkers(data)
{
    var length = data.length;
    var str = '';
    for (var x = 0; x < length; x += 1) {
        str += "<p><img hspace=5 align=left src='img/upload/" + data[x].picto + "'></p><a href='javascript:showHide(\"producteur_" + data[x].id + "\")'>"+data[x].libelle+"</a>";
        str += "<div class='fermeparagraphe' style='display:none' id='producteur_"+data[x].id+"'><table width=100%><tr><td><b>Adresse : </b>" + data[x].adresse + "<br>" + data[x].descriptif + "</td><td>"; 
        if (data[x].photo != '') {
        	str += "<img hspace=5 align=right src='img/upload/" + data[x].photo + "'>";
        }
        str += "</td></tr></table></div>";
        str += "<br>" 
        var content = data[x].libelle + "<br>" + data[x].adresse + "<br>" + data[x].descriptif; 
    	var point = new GLatLng(data[x].latitude,data[x].longitude);
    	var title = data[x].libelle;
    	var image = 'img/upload/' + data[x].picto;
    	var marker = createMarker(point, content, title, image);
    	
    	map.addOverlay(marker);
    }
    jQuery('#resultat').append(str);    
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