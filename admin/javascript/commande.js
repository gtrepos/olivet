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
  /*
  //Recomptage des lignes...
  var tableau = $('tableau');
  var trs = tableau.rows;
  var n = trs.length;
  var i;

  for (i=1; i<n; i++) //on commence à 1 et non à 0 ;)
  {
    trs[i].cells[0].innerHTML = trs[i].rowIndex;
  }*/
}


function get_current_option_text(select_id) {
	var select = $(select_id);
	var options = select.getElementsByTagName('option');
	return options[select.selectedIndex].text;
}

function checkCommande(){
	
	alert('checkCommande');
	
	if(true) {
		prepareEnvoie();
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

function alerteSuppressionCommande(idCommande){
	if (confirm('Êtes vous sûr de vouloir supprimer la commande '+idCommande+' ?')){
		location.href = 'index.php?page=commandes&action=supprimer&idCommande='+idCommande;
	}	
}
