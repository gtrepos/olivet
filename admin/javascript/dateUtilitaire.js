function fCompareDate(pDateDebut,pDateFin) {
var DureeDebut = Date.parse(pDateDebut);
var DureeFin = Date.parse(pDateFin);

var iComparaison= DureeFin - DureeDebut;

return iComparaison;
} 

function estDateSuperieure(pDateDebut, pDateFin) {
	if (fCompareDate(pDateDebut,pDateFin)>0) {
		return true;
	}
	return false;
}

function estDateEgale(pDateDebut, pDateFin) {
	if (fCompareDate(pDateDebut,pDateFin)==0) {
		return true;
	}
	return false;
	
}

function formatDateSql(pDate) {
	pDate.splite('/');
}