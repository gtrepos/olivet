/**
* Permet de retrouver le style appliqu? ? un ?l?ment
* @param string Identifiant de l'?l?ment dont on recherche le style
* @return object Style recherch?
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
* Change la couleur de fond appliqu?e ? un bloc
* @param string Identifiant de l'?l?ment dont on recherche le style
* @return aucun
*/
function survolLigne(idf) {
  var stylem=trouvestyle(idf);
  if(stylem) {
  		stylem.backgroundColor='#EBEBEB';
  }
}

/**
* Restaure la couleur de fond appliqu?e ? un bloc
* @param string Identifiant de l'?l?ment dont on recherche le style
* @return aucun
*/
function restaureLigne(idf) {
	var stylem=trouvestyle(idf);
	if(stylem) {
			stylem.backgroundColor='#FFFFFF';
	}
}


String.prototype.trim = function(){return
	(this.replace(/^[\s\xA0]+/, "").replace(/[\s\xA0]+$/, ""))}

String.prototype.startsWith = function(str)
{return (this.match("^"+str)==str)}

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str)}