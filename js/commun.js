function showHide(idDiv){
	if ($(idDiv).style.display=='none'){
		$(idDiv).show();
	}
	else {
		$(idDiv).hide();
	}
}

function isDateEquivalente(date1, date2) {
	return (!(date1>date2) && !(date1<date2));
}