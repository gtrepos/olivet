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

function addProduitResaCommande()
{
  $('tableau').show();
	
  var Cell;
  var idProduitResa = $('idProduitResa').value;
  
  var idtestPresenceProduitResa = "tr_produitresa_" + idProduitResa;
  
  if (idProduitResa!=-1 && $(idtestPresenceProduitResa)==null){
  
	  var tableau = $('tableau');
	  var ligne = tableau.insertRow(-1);
	  ligne.id = "tr_produitresa_" + idProduitResa;
	  
	  Cell = ligne.insertCell(0);
	  var libelleProduitResa = get_current_option_text('idProduitResa');
	  Cell.innerHTML = libelleProduitResa;
	  
	  Cell = ligne.insertCell(1);
	  var inputQuantite = document.createElement("input");
	  inputQuantite.type = "text";
	  inputQuantite.id = "input_qte_produitresa_" + idProduitResa;
	  inputQuantite.name = "input_qte_produitresa_" + idProduitResa;
	  Cell.appendChild(inputQuantite);
	  
	  Cell = ligne.insertCell(2);
	  var bouton = document.createElement("input");
	  bouton.type = "button";
	  bouton.value = "Retirer '" + libelleProduitResa + "'";
	  bouton.onclick = function(){retraitProduitResaCommande(ligne)};
	  Cell.appendChild(bouton);
  }
	
}


function retraitCondCommande(ligne)
{
  $('tableau').deleteRow(ligne.rowIndex);  
}

function retraitProduitResaCommande(ligne)
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
	var concatQteCond = "";
	var concatQteProduitResa = "";
	for (var i = 0; i < quantites.length; i++) {
		var id = quantites[i].id;
		if (id!=null && id.startsWith("input_qte_cond_")){
			concatQteCond = concatQteCond + id + ":" + quantites[i].value + ";";
		}
		if (id!=null && id.startsWith("input_qte_produitresa_")){
			concatQteProduitResa = concatQteProduitResa + id + ":" + quantites[i].value + ";";
		}
	}
	$('recapCommandeCond').value = concatQteCond;
	$('recapCommandeProduitResa').value = concatQteProduitResa;	
}

function valideCommande(){
	
	var refClient = $('refClient').value;
	var quantites = $$('.listeQuantites input');
	
	if (refClient == -1) {
		alert("Vous devez renseigner le client concerné par la commande.");
		$('refClient').focus();
		return false;
	}
	
	if (quantites == ''){
		alert("Vous devez ajouter au moins un produit à la commande.");
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
					alert("Vous avez oublié de renseigner la quantité pour au moins un des produits sélectionnés.");
					$(quantites[i].id).focus();
					return false;
				}
				else {
					if (!verifieNombre($(quantites[i].id))){
						alert("La quantité doit être un nombre.");
						$(quantites[i].id).focus();
						return false;
					}					
				}	
			}
			if (id!=null && id.startsWith("input_qte_produitresa_")){
				quantite = quantites[i].value.trim();
				if (quantite == '') {
					alert("Vous avez oublié de renseigner la quantité pour au moins un des produits sélectionnés.");
					$(quantites[i].id).focus();
					return false;
				}
				else {
					if (!verifieNombre($(quantites[i].id))){
						alert("La quantité doit être un nombre.");
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
	if (confirm('Ëtes vous sûr de vouloir supprimer la commande '+idCommande+' ?')){
		location.href = 'index.php?page=commandes&action=supprimer&idCommande='+idCommande;
	}	
}

function alerteFacturationCommande(idCommande){
	if (confirm('Ëtes vous sûr d\'avoir facturé la commande '+idCommande+' ?')){
		location.href = 'index.php?page=commandes&action=facturer&idCommande='+idCommande;
	}	
}

function alerteDefacturationCommande(idCommande){
	if (confirm('Ëtes vous sûr de vouloir changer l\'état de la commande '+idCommande+' en \'en cours\' ?')){
		location.href = 'index.php?page=commandes&action=defacturer&idCommande='+idCommande;
	}	
}

function checkRechercheCommande(){
	if ($('refClient').value == -1 && $('idCommande').value.trim() == '' && $('datedeb').value.trim() == '' && $('datefin').value.trim() == '' 
		&& $('idConditionnement').value == -1 && $('idProduitResa').value == -1 && $('etat').value == -1){
		alert('Vous devez renseigner un critère de recherche.');
		return;
	}
	$('formRechercheCommande').submit();
	
}

function genererFacture(idCommande){
	new Ajax.Request(
            './facturesPDF/index.php?idCommande='+idCommande,
            {
                method: 'get',
                onSuccess: function() { alert('Facture générée.');window.open('./facturesPDF/factures/facture'+idCommande+'.pdf');},
                onFailure: function() { alert('Erreur à la génération de la facture.') }
            }
    );	
}

