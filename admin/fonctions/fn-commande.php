<?php
function affiche_conditionnements_pour_selection($select, $remonteInactif, $fnOnChange){
  
  $sqlRemonteInactif = ($remonteInactif == true) ? '' : ' and c.cond_etat = 1 ';	
	
  $requete=
		"SELECT c.cond_id, c.cond_nom, p.produit_libelle, p.produit_id " .
  		"FROM produit p, conditionnement c " .
		"WHERE c.cond_id_produit = p.produit_id " . $sqlRemonteInactif .
  		"ORDER by p.produit_id, c.cond_nom DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  $onChange = '';
  if ($fnOnChange!=null) $onChange = "onChange='" . $fnOnChange . "'"; 
  
  echo "<SELECT id='idConditionnement' name='idConditionnement' $onChange>";
  echo "<OPTION value='-1'>-- Sélectionner un produit conditionné --</OPTION>";
  while ($row = mysql_fetch_array($resultats))
  {
  	$selected = "";
  	$condId = $row[0];
  	$condNom = $row[1];
  	$libelleProduit = $row[2];
  	
  	if ($condId == $select) $selected = "selected";
  	echo "<OPTION value='$condId' $selected>$libelleProduit [$condNom]</OPTION>";
  }
  echo "</SELECT>";  
}

function affiche_etat_pour_commande($select){
	echo "<SELECT id='etat' name='etat'>";
	echo "<OPTION value='-1'>-- Sélectionner un état --</OPTION>";
	$selected = "";
	if ( "EC" == $select ) $selected = "selected";
	echo "<OPTION value='EC' $selected>en cours</OPTION>";
	$selected = "";
	if ( "FA" == $select ) $selected = "selected";
	echo "<OPTION value='FA' $selected>facturée</OPTION>";
	echo "</SELECT>";
}

function creer_commande ($recapCommandeCond, $recapCommandeProduitResa, $refClient, $dateRecup){
	
	//booleens nécessaires pour le commit
	$resultCommande = false;
	$resultLcc = false;
	$resultLcpr = false;
	$resultStockCond = false;
	$resultStockResa = false;
	
	if ($recapCommandeCond!=null && strlen($recapCommandeCond)>0) {
		//suppression du dernier caractère de recapCommandeCond
		$recapCommandeCond = substr ($recapCommandeCond, 0, strlen($recapCommandeCond)-1);
	}
	else {
		$resultLcc = true;
		$resultStockCond = true;
	}
	
	if ($recapCommandeProduitResa!=null && strlen($recapCommandeProduitResa)>0) {
		//suppression du dernier caractère de recapCommandeProduitResa
		$recapCommandeProduitResa = substr ($recapCommandeProduitResa, 0, strlen($recapCommandeProduitResa)-1);
	}
	else {
		$resultLcpr = true;
		$resultStockResa = true;
	}
	
	begin(); // début de transaction
	
	//insert dans la table commande
	$requeteCommande = "INSERT INTO commande (commande_id_client, commande_daterecuperation) VALUES ($refClient, '$dateRecup')";
	$resultCommande = @mysql_query($requeteCommande);
	
	if ($resultCommande){
		$reqLastIdCommande = "SELECT LAST_INSERT_ID(commande_id) FROM commande";
		$resultat = @mysql_query($reqLastIdCommande); 
		$idCommande = -1;
		while ($row = mysql_fetch_array($resultat))
  		{
  			$idCommande = $row[0];
  		}
  		
		//pour chaque produit conditonné insert dans la table lien_commande_cond
		if ($recapCommandeCond!=null && strlen($recapCommandeCond)>0) {
			$tableauCond = split(";", $recapCommandeCond);
			for($i=0; $i < count($tableauCond); $i++){
				$quantiteEtCond = split(":",$tableauCond[$i]);
				$idcond = substr ($quantiteEtCond[0], strlen("input_qte_cond_"), strlen($quantiteEtCond[0]));
				$quantite = $quantiteEtCond[1];
				//met à jour les stocks si soumis à stock
				$requeteStockCond = "UPDATE conditionnement set cond_nb_stock = cond_nb_stock - $quantite where cond_id = $idcond and cond_a_stock = 1";	
				$resultStockCond = @mysql_query($requeteStockCond);
				if (!$resultStockCond) break;
				//insert dans table lien_commande_cond
				$requeteLcc = "INSERT INTO lien_commande_cond (lcc_id_commande, lcc_id_cond, lcc_quantite) VALUES ($idCommande, $idcond, $quantite)";
				$resultLcc = @mysql_query($requeteLcc);
				if (!$resultLcc) break;
			}
		}
		
		//pour chaque produit à la réservation insert dans la table lien_commande_produit_resa
		if ($recapCommandeProduitResa!=null && strlen($recapCommandeProduitResa)>0) {
			$tableauProduitResa = split(";", $recapCommandeProduitResa);
			for($j=0; $j < count($tableauProduitResa); $j++){
				$quantiteEtProduitResa = split(":",$tableauProduitResa[$j]);
				$idProduitResa = substr ($quantiteEtProduitResa[0], strlen("input_qte_produitresa_"), strlen($quantiteEtProduitResa[0]));
				$quantiteResa = $quantiteEtProduitResa[1];
				//met à jour les stocks si soumis à stock
				$requeteStockResa = "UPDATE produit_resa set produit_resa_nb_stock = produit_resa_nb_stock - $quantiteResa where produit_resa_id = $idProduitResa and produit_resa_a_stock = 1";
				$resultStockResa = @mysql_query($requeteStockResa);
				if (!$resultStockResa) break;
				//insert dans table lien_commande_produit_resa
				$requeteLcpr = "INSERT INTO lien_commande_produit_resa (lcpr_id_commande, lcpr_id_produit_resa, lcpr_quantite) VALUES ($idCommande, $idProduitResa, $quantiteResa)";
				$resultLcpr = @mysql_query($requeteLcpr);
				if (!$resultLcpr) break;
			}
		}
	}
	
	if ($resultCommande && $resultLcc && $resultLcpr && $resultStockCond && $resultStockResa){
		commit(); // transaction is committed				
	}
	else {
		rollback(); // transaction rolls back
	}	
}

function modifier_commande ($recapCommandeCond, $recapCommandeProduitResa, $idCommande, $refClient, $dateRecup) {
	
	//booleens nécessaires pour le commit
	$resultCommande = false;
	$resultLcc = false;
	$resultLcpr = false;
	$resultStockCond = false;
	$resultStockResa = false;
	$resultDeleteLcc = false;
	$resultDeleteLcpr = false;
	$resultMajStocksPrecedents = false;
	
	if ($recapCommandeCond!=null && strlen($recapCommandeCond)>0) {
		//suppression du dernier caractère de recapCommandeCond
		$recapCommandeCond = substr ($recapCommandeCond, 0, strlen($recapCommandeCond)-1);
	}
	else {
		$resultLcc = true;
		$resultStockCond = true;
	}
	
	if ($recapCommandeProduitResa!=null && strlen($recapCommandeProduitResa)>0) {
		//suppression du dernier caractère de recapCommandeProduitResa
		$recapCommandeProduitResa = substr ($recapCommandeProduitResa, 0, strlen($recapCommandeProduitResa)-1);
	}
	else {
		$resultLcpr = true;
		$resultStockResa = true; 
	}
	
	begin(); // début de transaction
	
	//insert dans la table commandes
	$requeteCommande = "UPDATE commande SET commande_id_client = $refClient, commande_daterecuperation = '$dateRecup' WHERE commande_id = $idCommande "  ;
	$resultCommande = @mysql_query($requeteCommande);
	
	if ($resultCommande){
		
		//mise à jour des stocks (ajouts) comme pour une suppression de commande.
		$resultMajStocksPrecedents = majStockSuppressionCommande($idCommande);			
			
		$requeteDeleteLcc = "DELETE FROM lien_commande_cond WHERE lcc_id_commande = " . $idCommande;
		$resultDeleteLcc = @mysql_query($requeteDeleteLcc);
		
		if ($resultDeleteLcc) {
			
			if ($recapCommandeCond!=null && strlen($recapCommandeCond)>0) {
			
				//pour chaque produit conditionné insert dans la table lien_commande_cond
				$tableauCond = split(";", $recapCommandeCond);
				for($k=0; $k < count($tableauCond); $k++){
					$quantiteEtCond = split(":",$tableauCond[$k]);
					$idcond = substr ($quantiteEtCond[0], strlen("input_qte_cond_"), strlen($quantiteEtCond[0]));
					$quantite = $quantiteEtCond[1];
					//met à jour les stocks si soumis à stock
					$requeteStockCond = "UPDATE conditionnement set cond_nb_stock = cond_nb_stock - $quantite where cond_id = $idcond and cond_a_stock = 1";	
					$resultStockCond = @mysql_query($requeteStockCond);
					if (!$resultStockCond) break;
					//insert dans la table lien_commande_cond
					$requeteLcc = "INSERT INTO lien_commande_cond (lcc_id_commande, lcc_id_cond, lcc_quantite) VALUES ($idCommande, $idcond, $quantite)";
					$resultLcc = @mysql_query($requeteLcc);
					if (!$resultLcc) break;
				}
				
			}
		}
		
		$requeteDeleteLcpr = "DELETE FROM lien_commande_produit_resa WHERE lcpr_id_commande = " . $idCommande;
		$resultDeleteLcpr = @mysql_query($requeteDeleteLcpr);
		
		if ($resultDeleteLcpr) {
			
			if ($recapCommandeProduitResa!=null && strlen($recapCommandeProduitResa)>0) {
				
				//pour chaque produit à la réservation insert dans la table lien_commande_produit_resa
				$tableauProduitResa = split(";", $recapCommandeProduitResa);
				for($l=0; $l < count($tableauProduitResa); $l++){
					$quantiteEtProduitResa = split(":",$tableauProduitResa[$l]);
					$idproduitresa = substr ($quantiteEtProduitResa[0], strlen("input_qte_produitresa_"), strlen($quantiteEtProduitResa[0]));
					$quantiteResa = $quantiteEtProduitResa[1];
					//met à jour les stocks si soumis à stock
					$requeteStockResa = "UPDATE produit_resa set produit_resa_nb_stock = produit_resa_nb_stock - $quantiteResa where produit_resa_id = $idproduitresa and produit_resa_a_stock = 1";
					$resultStockResa = @mysql_query($requeteStockResa);
					if (!$resultStockResa) break;
					//insert dans la table lien_commande_produit_resa
					$requeteLcpr = "INSERT INTO lien_commande_produit_resa (lcpr_id_commande, lcpr_id_produit_resa, lcpr_quantite) VALUES ($idCommande, $idproduitresa, $quantiteResa)";
					$resultLcpr = @mysql_query($requeteLcpr);
					if (!$resultLcpr) break;
				}
				
			}
			
		}
				
	}
	
	if ($resultCommande && $resultMajStocksPrecedents && $resultDeleteLcc && $resultLcc && $resultDeleteLcpr && $resultLcpr){
		commit(); // transaction is committed				
	}
	else {
		rollback(); // transaction rolls back
	}
}

function liste_commandes ($idClient, $idCommande, $dateInf, $dateSup, $idConditionnement, $idProduitResa, $etat)
{
  $select = "SELECT distinct commande_id, client_nom, client_prenom, commande_datecreation, commande_etat, client_reference, commande_daterecuperation ";
  $from = "FROM commande, client ";
  $where = "WHERE commande_id_client = client_reference ";
	  
  if ($idClient==-1) $idClient = null;
  if ($idConditionnement==-1) $idConditionnement = null;
  if ($idProduitResa==-1) $idProduitResa = null;
  if ($etat==-1) $etat = null;
  
  if ($idClient!=null) $where = $where . " AND client_reference='$idClient'";
  if ($idCommande!=null) $where = $where . " AND commande_id='$idCommande'";
  if ($dateInf!=null) $where = $where . " AND commande_datecreation>='$dateInf. 00:00:00'";
  if ($dateSup!=null) $where = $where . " AND commande_datecreation<'$dateSup. 23:59:59'";
  if ($idConditionnement!=null) {
  	$from = $from . ", lien_commande_cond, produit, conditionnement ";
  	$where = $where . " AND lcc_id_commande = commande_id AND lcc_id_cond = cond_id AND cond_id_produit = produit_id AND cond_id = '$idConditionnement'";
  }
  if ($idProduitResa!=null) {
  	$from = $from . ", lien_commande_produit_resa, produit_resa ";
  	$where = $where . " AND lcpr_id_commande = commande_id AND lcpr_id_produit_resa = produit_resa_id AND produit_resa_id = '$idProduitResa'";
  }
   
  if ($etat!=null) $where = $where . " AND commande_etat = '$etat'";
  
  $order = " ORDER by commande_id DESC";
  
  $requete = $select.$from.$where.$order;
  
  $idsCommandes = array();
  $i = 0;
  
  
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	$idsCommandes[$i] = $row[0];
  	$i++;
  	
  	$libelleEtat = "";
  	$imgEtat = "";
  	
  	$etat = $row[4]; 
  	
  	switch ($etat) {
	case 'EC':
	    $libelleEtat = "en cours";
	    $imgEtat = "encours.gif";
	    break;
	case 'FA':
	    $libelleEtat = "facturée";
	    $imgEtat = "picto_ok.gif";
	    break;
	}

	$dateCreation = $row[3];
	$laDateRecup = $row[6];

	setlocale (LC_TIME, 'fr_FR','fra');
		
	$outputAffDateCreation = "%A %d %B %Y %T";
	$outputAffDateRecup = "%A %d %B %Y";
	
	$dateCreation = strftime($outputAffDateCreation,strtotime($dateCreation));
	
	if ($laDateRecup!=null) {
		$dateRecup = utf8_encode(strftime($outputAffDateRecup,strtotime($laDateRecup)));
	} else {
		$dateRecup = "cf dates produits sur réservation";
	}
  	echo "<tr id='commande_$row[0]' onmouseout=\"restaureLigne('commande_$row[0]');\" onmouseover=\"survolLigne('commande_$row[0]');\">";
  	echo "<td>$row[0]</td>";
    echo "<td>$row[1] $row[2]</td>";
    echo "<td>" . utf8_encode($dateCreation) . "</td>";
    echo "<td>" . $dateRecup . "</td>";
    echo "<td align='center'><a title='$libelleEtat' href='#'><image src='images/$imgEtat' border=0/></a></td>";
    $resume = affiche_resume_commande($row[0]);
    $resumeLight = substr ($resume, 0, 100);
    if (strlen($resume)>100) $resumeLight = $resumeLight . '...'; 
    echo "<td>" .
  			"<a href='javascript:void(0);' onmouseover=\"return overlib('" .addslashes($resume). "');\" onmouseout='return nd();''>$resumeLight</a>" .
  		 "</td>";
	echo "<td>".affiche_somme_commande($row[0]). " " . affiche_presence_produit_resa($row[0]) .  "</td>";  		 
  	echo "<td align=\"right\">";
    echo "<a title='générer la facture' href='javascript:genererFacture($row[0])'><image src='images/pdf.gif' border=0/></a> ";
    if ($etat == 'EC') {
    	echo "<a href=\"?page=commandes&action=modifier&idCommande=$row[0]&refClient=$row[5]&daterecup=$row[6]\">[".ADMIN_COMMANDE_MODIFIER."]</a>";
    }
    if ($etat == 'EC') {
    	echo "<a href=\"\" onclick=\"alerteFacturationCommande('$row[0]')\">[".ADMIN_COMMANDE_FACTUREE."]</a>";
    }
    else if ($etat == 'FA'){
    	echo "<a href=\"\" onclick=\"alerteDefacturationCommande('$row[0]')\">[".ADMIN_COMMANDE_ENCOURS."]</a>";
    }
    echo "<a href=\"\" onclick=\"alerteSuppressionCommande('$row[0]')\">[".ADMIN_COMMANDE_SUPPRIMER."]</a>";
    echo "</td>"; 
    echo "</tr>";
  }
  
  echo "<tr><td colspan=7>Totaux</td></tr>";
  echo "<tr><td colspan=7>".affiche_totaux_conditionnements($idsCommandes).affiche_totaux_resa($idsCommandes)."</td></tr>";
  
}

function affiche_detail_commande($idCommande){
	
  $requeteCond = "SELECT cond_id, cond_nom, cond_prix, produit_libelle, lcc_quantite FROM conditionnement, produit, lien_commande_cond " .
			"WHERE lcc_id_cond = cond_id AND cond_id_produit = produit_id AND lcc_id_commande = " . $idCommande ;	

  $resultatsCond=mysql_query($requeteCond) or die (mysql_error());
  
  while ($rowCond = mysql_fetch_array($resultatsCond))
  {
  	
  	$condId = $rowCond[0];
  	$condNom = $rowCond[1];
  	$condPrix = $rowCond[2];
  	$produitLibelle = $rowCond[3];
  	$quantiteCondCommande = $rowCond[4];
  	
	echo "<tr id='tr_cond_$condId'>
			<td>$produitLibelle [$condNom]</td>
			<td><input name='input_qte_cond_$condId' id='input_qte_cond_$condId' type='text' value='$quantiteCondCommande'></td>
			<td><input value=\"Retirer '$produitLibelle [$condNom]'\" type='button' onclick=\"retraitCondCommande($('tr_cond_$condId'))\"></td>
		 </tr>";
	
  }
	
  $requeteProduitResa = "SELECT produit_resa_id, produit_resa_libelle, lcpr_quantite FROM produit_resa, lien_commande_produit_resa " .
			"WHERE lcpr_id_produit_resa = produit_resa_id AND lcpr_id_commande = " . $idCommande ;
			
  $resultatsProduitResa=mysql_query($requeteProduitResa) or die (mysql_error());
  	
  while ($rowProduitResa = mysql_fetch_array($resultatsProduitResa))
  {
  	$produitResaId = $rowProduitResa[0];
  	$produitResaLibelle = $rowProduitResa[1];
  	$quantiteProduitResaCommande = $rowProduitResa[2];
  	
  	echo "<tr id='tr_produitresa_$produitResaId'>
			<td>$produitResaLibelle</td>
			<td><input name='input_qte_produitresa_$produitResaId' id='input_qte_produitresa_$produitResaId' type='text' value='$quantiteProduitResaCommande'></td>
			<td><input value=\"Retirer '$produitResaLibelle'\" type='button' onclick=\"retraitProduitResaCommande($('tr_produitresa_$produitResaId'))\"></td>
		 </tr>";
  	
  }	
}

function affiche_somme_commande($idCommande){
	
  $requete=
		"SELECT cond.cond_prix, cond.cond_remise, " .
		"lcc.lcc_quantite " .
		"FROM produit p, lien_commande_cond lcc, conditionnement cond " .
		"WHERE p.produit_id = cond.cond_id_produit AND cond.cond_id = lcc.lcc_id_cond AND lcc.lcc_id_commande = " . $idCommande . "";

  $resultats=mysql_query($requete) or die (mysql_error());
  
  $prix = 0;
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$condPrix = $row[0];
  	$condRemise = $row[1];
  	$quantiteCondCommande = $row[2];
  	
  	$prix += $quantiteCondCommande * ($condPrix - $condRemise);  	
  }
  
  return number_format($prix, 2, '.', '') . " €";
  
}

function affiche_presence_produit_resa($idCommande){
  $requete=
		"SELECT resa.produit_resa_libelle, lcpr_quantite " .
		"FROM produit_resa resa, lien_commande_produit_resa lcpr " .
		"WHERE resa.produit_resa_id = lcpr.lcpr_id_produit_resa AND lcpr.lcpr_id_commande = " . $idCommande . "";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  $retour = "";
  
  while ($row = mysql_fetch_array($resultats))
  {
  	$libelleResa = $row[0];
  	$quantiteResa = $row[1];
  	
  	$retour = $retour . " " . $libelleResa . " x " . $quantiteResa . "<br>";
  	
  }
  if (strlen($retour)>0)
  return "<span style='color:red'> + <br>" . $retour . "</span>" ;
  
}

function supprimer_commande($idCommande) {
	
	$resultDeleteLcc = false;
	$resultDeleteLcpr = false;
	$resultDeleteCommande = false;
	
	begin(); // début de transaction
	
	$resultStock = majStockSuppressionCommande($idCommande);
	
	$requeteDeleteLcc = "DELETE FROM lien_commande_cond where lcc_id_commande = '$idCommande'";
	$resultDeleteLcc=mysql_query($requeteDeleteLcc) or die (mysql_error());
	
	$requeteDeleteLcpr = "DELETE FROM lien_commande_produit_resa where lcpr_id_commande = '$idCommande'";
	$resultDeleteLcpr=mysql_query($requeteDeleteLcpr) or die (mysql_error());
	
	$requeteDeleteCommande = "DELETE FROM commande where commande_id = '$idCommande'";
	$resultDeleteCommande=mysql_query($requeteDeleteCommande) or die (mysql_error());
	
	echo $resultStock;
	echo $resultDeleteLcc;
	echo $resultDeleteCommande;
	echo $resultDeleteLcpr;
	
	if ($resultDeleteLcc && $resultDeleteCommande && $resultDeleteLcpr) {
		commit();
	}
	else {
		rollback();	
	}
}

function majStockSuppressionCommande($idCommande) {
	
	$resultMajStockCond = true;
	$resultMajStockResa = true;
	
	$requeteCond = "SELECT lcc_id_cond, lcc_quantite FROM lien_commande_cond WHERE lcc_id_commande = " . $idCommande ;
	$resultatsCond=mysql_query($requeteCond) or die (mysql_error());
	
  	while ($rowCond = mysql_fetch_array($resultatsCond))
  	{
  	  $idCond = $rowCond[0];
  	  $quantiteCond = $rowCond[1];
  	  $requeteMajStockCond = "UPDATE conditionnement set cond_nb_stock = cond_nb_stock + $quantiteCond where cond_id = $idCond and cond_a_stock = 1";
  	  $resultMajStockCond=mysql_query($requeteMajStockCond) or die (mysql_error());  	   
  	}
  	
  	$requeteResa = "SELECT lcpr_id_produit_resa, lcpr_quantite FROM lien_commande_produit_resa WHERE lcpr_id_commande = " . $idCommande ;
  	$resultatsResa=mysql_query($requeteResa) or die (mysql_error());
  	
  	while ($rowResa = mysql_fetch_array($resultatsResa))
  	{
  	  //met à jour les stocks si soumis à stock
  	  $idProduitResa = $rowResa[0];
  	  $quantiteResa = $rowResa[1];
	  $requeteMajStockResa = "UPDATE produit_resa set produit_resa_nb_stock = produit_resa_nb_stock + $quantiteResa where produit_resa_id = $idProduitResa and produit_resa_a_stock = 1";
	  $resultMajStockResa=mysql_query($requeteMajStockResa) or die (mysql_error());  
  	}
  	
  	return $resultMajStockCond && $resultMajStockResa;
	
}


function facturer_commande($idCommande) {
	
	$resultUpdateEtat = false;
	$resultInsertFacture = false;
	
	begin(); // début de transaction
	
	$requeteUpdateEtat = "UPDATE commande SET commande_etat = 'FA' WHERE commande_id = '$idCommande'";
	$resultUpdateEtat=mysql_query($requeteUpdateEtat) or die (mysql_error());
	
	$requeteInsertFacture = "INSERT INTO facture (facture_id_commande) values ($idCommande)";
	$resultInsertFacture=mysql_query($requeteInsertFacture) or die (mysql_error());
	
	if ($resultUpdateEtat && $resultInsertFacture) {
		commit();
	}
	else {
		rollback();	
	}
}

function defacturer_commande($idCommande) {
	$resultUpdateEtat = false;
	$resultDeleteFacture = false;
	
	begin(); // début de transaction
	
	$requeteUpdateEtat = "UPDATE commande SET commande_etat = 'EC' WHERE commande_id = $idCommande";
	$resultUpdateEtat=mysql_query($requeteUpdateEtat) or die (mysql_error());
	
	$requeteDeleteFacture = "DELETE FROM facture where facture_id_commande = $idCommande";
	$resultDeleteFacture=mysql_query($requeteDeleteFacture) or die (mysql_error());
	
	if ($resultUpdateEtat && $resultDeleteFacture) {
		commit();
	}
	else {
		rollback();	
	}
}

function affiche_resume_commande($idCommande){
	$resume = "";
	$requeteCond = "SELECT cond_nom, produit_libelle, lcc_quantite FROM conditionnement, produit, lien_commande_cond " .
			"WHERE lcc_id_cond = cond_id AND cond_id_produit = produit_id AND lcc_id_commande = " . $idCommande ;
	
	$resultatsCond=mysql_query($requeteCond) or die (mysql_error());
  	while ($rowCond = mysql_fetch_array($resultatsCond))
  	{
  	 $resume = $resume . $rowCond[0] . " " . $rowCond[1] . " x " . $rowCond[2] . "<br>"; 
  	}
  	
  	$requeteResa = "SELECT produit_resa_libelle, lcpr_quantite FROM produit_resa, lien_commande_produit_resa " .
			"WHERE lcpr_id_produit_resa = produit_resa_id AND lcpr_id_commande = " . $idCommande ;
  	
  	$resultatsResa=mysql_query($requeteResa) or die (mysql_error());
  	while ($rowResa = mysql_fetch_array($resultatsResa))
  	{
  	 $resume = $resume . $rowResa[0] . " x " . $rowResa[1] . "<br>"; 
  	}
  	
  	$resume = substr ($resume, 0, strlen($resume)-4);
  	return $resume;
}

function affiche_totaux_conditionnements($idsCommandes){
	
	if (sizeof($idsCommandes)==0 ) return;
	
	$requete = "select cond_id, cond_nom, produit_libelle, lcc_quantite from conditionnement, produit, lien_commande_cond " .
			"where lcc_id_cond = cond_id AND cond_id_produit = produit_id AND lcc_id_commande in ";
	
	$condition = "(";
		
	foreach ( $idsCommandes as $idCommande ) {
		$condition = $condition . $idCommande . ", ";
	}
	$condition = substr ($condition, 0, strlen($condition)-2);
	$condition = $condition . ")";
	
	$requete = $requete . $condition;
	
	$totaux = array();
	$i=0;
	
	$resultats=mysql_query($requete) or die (mysql_error());
	while ($row = mysql_fetch_array($resultats))
  	{
  		$conditionnement = $row[1] . " " . $row[2];
  		$quantiteConditionnement = $row[3];
  		
  		if (isset($totaux[$conditionnement])) {
  			$totaux[$conditionnement] = $totaux[$conditionnement] + $quantiteConditionnement; 
  		} 
  		else {
  			$totaux[$conditionnement] = $quantiteConditionnement;
  		}  		
  	}
  	
  	$retour = "";
  	
  	foreach ( $totaux as $key => $value ) {
       $retour = $retour . $value  . " x " . $key . "<br>";
	}
  	
  	return $retour;
  	
}

function affiche_totaux_resa($idsCommandes){
	
	if (sizeof($idsCommandes)==0 ) return;
	
	$requete = "select produit_resa_id, produit_resa_libelle, lcpr_quantite from produit_resa, lien_commande_produit_resa " .
			"where lcpr_id_produit_resa = produit_resa_id AND lcpr_id_commande in ";
	
	$condition = "(";
		
	foreach ( $idsCommandes as $idCommande ) {
		$condition = $condition . $idCommande . ", ";
	}
	$condition = substr ($condition, 0, strlen($condition)-2);
	$condition = $condition . ")";
	
	$requete = $requete . $condition;
	
	$totaux = array();
	$i=0;
	
	$resultats=mysql_query($requete) or die (mysql_error());
	while ($row = mysql_fetch_array($resultats))
  	{
  		$produitResa = $row[1];
  		$quantiteProduitResa = $row[2];
  		
  		if (isset($totaux[$produitResa])) {
  			$totaux[$produitResa] = $totaux[$produitResa] + $quantiteProduitResa; 
  		} 
  		else {
  			$totaux[$produitResa] = $quantiteProduitResa;
  		}  		
  	}
  	
  	$retour = "";
  	
  	foreach ( $totaux as $key => $value ) {
       $retour = $retour . $value  . " x " . $key . "<br>";
	}
  	
  	return $retour;
  	
}

function affiche_produitsresa_pour_selection($select, $remonteInactif, $fnOnChange){
  
  $sqlRemonteInactif = ($remonteInactif == true) ? '' : ' WHERE produit_resa_etat = 1 ';	
	
  $requete=
		"SELECT produit_resa_id, produit_resa_libelle " .
  		"FROM produit_resa " .
  		"ORDER by produit_resa_libelle DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  $onChange = '';
  if ($fnOnChange!=null) $onChange = "onChange='" . $fnOnChange . "'"; 
  
  echo "<SELECT id='idProduitResa' name='idProduitResa' $onChange>";
  echo "<OPTION value='-1'>-- Sélectionner un produit à la réservation --</OPTION>";
  while ($row = mysql_fetch_array($resultats))
  {
  	$selected = "";
  	$prodResaId = $row[0];
  	$prodResaLibelle = $row[1];
  	
  	if ($prodResaId == $select) $selected = "selected";
  	echo "<OPTION value='$prodResaId' $selected>$prodResaLibelle</OPTION>";
  }
  echo "</SELECT>";  
}


?>
