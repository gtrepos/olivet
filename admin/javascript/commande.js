function addProduitCommande()
{
  $('tableau').show();
	
  var Cell;
  var idProduit = $('idProduit').value;
  
  var idtestPresenceProduit = "tr_prod_" + idProduit;
  
  if (idProduit!=-1 && $(idtestPresenceProduit)==null){
  
	  var tableau = $('tableau');
	  var ligne = tableau.insertRow(-1);
	  ligne.id = "tr_prod_" + idProduit;
	  
	  Cell = ligne.insertCell(0);
	  var libelleProduit = get_current_option_text('idProduit');
	  Cell.innerHTML = libelleProduit;
	  
	  Cell = ligne.insertCell(1);
	  var inputQuantite = document.createElement("input");
	  inputQuantite.type = "text";
	  inputQuantite.id = "input_qte_prod_" + idProduit;
	  inputQuantite.name = "input_qte_prod_" + idProduit;
	  Cell.appendChild(inputQuantite);
	  
	  Cell = ligne.insertCell(2);	
	  var bouton = document.createElement("input");
	  bouton.type = "button";
	  bouton.value = "Retirer '" + libelleProduit + "'";
	  bouton.onclick = function(){retraitProduitCommande(ligne)};
	  Cell.appendChild(bouton);
  }
}

function retraitProduitCommande(ligne)
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
		if (id!=null && id.startsWith("input_qte_prod_")){
			concatQte = concatQte + id + ":" + quantites[i].value + ";";
		}
	}
	$('recapCommande').value = concatQte;
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
		$('idProduit').focus();
		return false;
	}	
	
	if (quantites != '') {
		var quantite = '';
		for (var i = 0; i < quantites.length; i++) {
			var id = quantites[i].id;
			if (id!=null && id.startsWith("input_qte_prod_")){
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
		&& $('idProduit').value == -1 && $('etat').value == -1){
		alert('Vous devez renseigner un crit�re de recherche.');
		return;
	}
	$('formRechercheCommande').submit();
	
}

