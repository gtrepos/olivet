function estDateSuperieure(pDateDebut, pDateFin) {
	debut = getDate(pDateDebut);
	fin = getDate(pDateFin);
	return debut > fin;
}

function estDateInferieure(pDateDebut, pDateFin) {
	debut = getDate(pDateDebut);
	fin = getDate(pDateFin);
	return debut < fin;
}

function getDate(dateString){
	var tabDateDebut = dateString.split("/");
	var jour = tabDateDebut[0];
	var mois = tabDateDebut[1]-1;
	var annee = tabDateDebut[2];
	d = new Date(0);
	d.setFullYear(annee, mois, jour);
	return d;
}

/*
 * 
// Mise en place de la première date
d1 = new Date(0);
d1.setFullYear(2006, 11, 27)

// Mise en place de la seconde date
d2 = new Date(0);
d2.setFullYear(2006, 0, 18)

if(d1 > d2)
alert("d1 est après d2");
else if(d1 < d2)
alert("d1 est avant d2");
else
alert("d1 et d2 sont la même date");
 * 
 * Attention, les mois vont de 0 (janvier) à 11 (décembre). 
 * 
 * */

