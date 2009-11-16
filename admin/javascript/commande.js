function addCondCommande()
{
  $('tableau').show();
	
  var Cell;
  var idCond = $('idConditionnement').value;
  
  var idtestPresenceCond = "tr_cond_" + idCond;
  
  if (idCond!=-1 && $(idtestPresenceCond)==null){
  
	  var tableau = $('tableau');
	  var ligne = tableau.insertRow(-1);
	  ligne.id = "tr_cond_" + idCond;
	  
	  Cell = ligne.insertCell(0);
	  var libelleCond = get_current_option_text('idConditionnement');
	  Cell.innerHTML = libelleCond;
	  
	  Cell = ligne.insertCell(1);
	  var inputQuantite = document.createElement("input");
	  inputQuantite.type = "text";
	  inputQuantite.id = "input_qte_cond_" + idCond;
	  inputQuantite.name = "input_qte_cond_" + idCond;
	  Cell.appendChild(inputQuantite);
	  
	  Cell = ligne.insertCell(2);	
	  var bouton = document.createElement("input");
	  bouton.type = "button";
	  bouton.value = "Retirer '" + libelleCond + "'";
	  bouton.onclick = function(){retraitCondCommande(ligne)};
	  Cell.appendChild(bouton);
  }
}

function retraitCondCommande(ligne)
{
  $('tableau').deleteRow(ligne.rowIndex);  
}


function get_current_option_text(select_id) {
	var select = $(select_id);
	var options = select.getElementsByTagName('option');
	return options[select.selectedIndex].text;
}

function checkCommande(){
	if(valideCommande()) {
		prepareEnvoie();
		document.form_commande.submit();
	}
}

function prepareEnvoie(){
	var quantites = $$('.listeQuantites input');
	var concatQte = "";
	for (var i = 0; i < quantites.length; i++) {
		var id = quantites[i].id;
		if (id!=null && id.startsWith("input_qte_cond_")){
			concatQte = concatQte + id + ":" + quantites[i].value + ";";
		}
	}
	$('recapCommande').value = concatQte;
	
	alert ($('recapCommande').value);
	
}

function valideCommande(){
	
	var refClient = $('refClient').value;
	var quantites = $$('.listeQuantites input');
	
	if (refClient == -1) {
		alert("Vous devez renseigner le client concern� par la commande.");
		$('refClient').focus();
		return false;
	}
	
	if (quantites == ''){
		alert("Vous devez ajouter au moins un produit � la commande.");
		$('idConditionnement').focus();
		return false;
	}	
	
	if (quantites != '') {
		var quantite = '';
		for (var i = 0; i < quantites.length; i++) {
			var id = quantites[i].id;
			if (id!=null && id.startsWith("input_qte_cond_")){
				quantite = quantites[i].value.trim();
				if (quantite == '') {
					alert("Vous avez oubli� de renseigner la quantit� pour au moins un des produits s�lectionn�s.");
					$(quantites[i].id).focus();
					return false;
				}
				else {
					if (!verifieNombre($(quantites[i].id))){
						alert("La quantit� doit �tre un nombre.");
						$(quantites[i].id).focus();
						return false;
					}					
				}	
			}
		}
	}
	
	return true;
}

function alerteSuppressionCommande(idCommande){
	if (confirm('�tes vous s�r de vouloir supprimer la commande '+idCommande+' ?')){
		location.href = 'index.php?page=commandes&action=supprimer&idCommande='+idCommande;
	}	
}

function checkRechercheCommande(){
	if ($('refClient').value == -1 && $('datedeb').value.trim() == '' && $('datefin').value.trim() == '' 
		&& $('idConditionnement').value == -1 && $('etat').value == -1){
		alert('Vous devez renseigner un crit�re de recherche.');
		return;
	}
	$('formRechercheCommande').submit();
	
}

function genererFacture(idCommande){
	new Ajax.Request(
            './facturesPDF/index.php?idCommande='+idCommande,
            {
                method: 'get',
                onSuccess: function() { alert('Facture g�n�r�e.');window.open('./facturesPDF/factures/facture'+idCommande+'.pdf');},
                onFailure: function() { alert('Erreur � la g�n�ration de la facture.') }
            }
    );	
}

