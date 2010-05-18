/**
* Permet de retrouver le style appliqué à un élément
* @param string Identifiant de l'élément dont on recherche le style
* @return object Style recherché
*/
function trouvestyle(idf) {
  if (document.getElementById) {
    return document.getElementById(idf).style;
  } else if (document.all) {
    return document.all[idf].style;
  } else if (document.layers) {
    return document.layers[idf];
  } else return null
}

/**
* Change la couleur de fond appliquée à un bloc
* @param string Identifiant de l'élément dont on recherche le style
* @return aucun
*/
function survolLigne(idf) {
  var stylem=trouvestyle(idf);
  if(stylem) {
  		stylem.backgroundColor='#E2BAD9';
  }
}

/**
* Restaure la couleur de fond appliquée à un bloc
* @param string Identifiant de l'élément dont on recherche le style
* @return aucun
*/
function restaureLigne(idf) {
	var stylem=trouvestyle(idf);
	if(stylem) {
			stylem.backgroundColor='#FFFFFF';
	}
}

/*appelée sur l'évenement onKeyPress des formulaires*/
function gestionToucheEntree(event,callBack){
	if (!event) {event = window.event ;}  //cas IE
	
	if(event.keyCode == 13){
		callBack();
	}
}

function verifieNombre(champ){
	var verif = /^[0-9]+$/;
	if (verif.exec(champ.value) == null){
		champ.focus();
		return false;
	}
	champ.value = parseInt(champ.value);
	return true;
}

String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, "");
}

String.prototype.startsWith = function(str)
{return (this.match("^"+str)==str)}

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str)}

function verifieSiteweb(champ){
	var verif = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	if (verif.exec(champ.value) == null){
		champ.focus();
		return false;
	}
	return true;
}
