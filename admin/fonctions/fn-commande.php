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
	$selected = "";
	if ( "AN" == $select ) $selected = "selected";
	echo "<OPTION value='AN' $selected>annulée</OPTION>";
  	echo "</SELECT>";
}

function creer_commande ($recapCommande, $refClient){
	
	//suppression du dernier caractère de recapCommande
	$recapCommande = substr ($recapCommande, 0, strlen($recapCommande)-1);
	$resultCommande = false;
	$resultLcc = false;	
	
	begin(); // début de transaction
	
	//insert dans la table commandes
	$requeteCommande = "INSERT INTO commande (commande_id_client) VALUES ($refClient)";
	$resultCommande = @mysql_query($requeteCommande);
	
	if ($resultCommande){
		$reqLastIdCommande = "SELECT LAST_INSERT_ID(commande_id) FROM commande";
		$resultat = @mysql_query($reqLastIdCommande); 
		$idCommande = -1;
		while ($row = mysql_fetch_array($resultat))
  		{
  			$idCommande = $row[0];
  		}
  		
		//pour chaque produit insert dans la table lien_commande_produit
		$tableau = split(";", $recapCommande);
		for($i=0; $i < count($tableau); $i++){
			$quantiteEtCond = split(":",$tableau[$i]);
			$idcond = substr ($quantiteEtCond[0], strlen("input_qte_cond_"), strlen($quantiteEtCond[0]));
			$quantite = $quantiteEtCond[1];
			$requeteLcc = "INSERT INTO lien_commande_cond (lcc_id_commande, lcc_id_cond, lcc_quantite) VALUES ($idCommande, $idcond, $quantite)";
			$resultLcc = @mysql_query($requeteLcc);
			if (!$resultLcc) break;
		}
	}
	
	if ($resultCommande && $resultLcc){
		commit(); // transaction is committed				
	}
	else {
		rollback(); // transaction rolls back
	}	
}

function modifier_commande ($recapCommande, $idCommande, $refClient) {
	
	//suppression du dernier caractère de recapCommande
	$recapCommande = substr ($recapCommande, 0, strlen($recapCommande)-1);
	
	$resultCommande = false;
	$resultDeleteLcc = false;
	$resultLcc = false;	
	
	begin(); // début de transaction
	
	//insert dans la table commandes
	$requeteCommande = "UPDATE commande SET commande_id_client = $refClient WHERE commande_id = $idCommande "  ;
	$resultCommande = @mysql_query($requeteCommande);
	
	if ($resultCommande){
		
		$requeteDeleteLcc = "DELETE FROM lien_commande_cond WHERE lcc_id_commande = " . $idCommande;
		$resultDeleteLcc = @mysql_query($requeteDeleteLcc);
		
		if ($resultDeleteLcc) {
			//pour chaque produit conditionné insert dans la table lien_commande_cond
			$tableau = split(";", $recapCommande);
			for($i=0; $i < count($tableau); $i++){
				$quantiteEtCond = split(":",$tableau[$i]);
				$idcond = substr ($quantiteEtCond[0], strlen("input_qte_cond_"), strlen($quantiteEtCond[0]));
				$quantite = $quantiteEtCond[1];
				$requeteLcc = "INSERT INTO lien_commande_cond (lcc_id_commande, lcc_id_cond, lcc_quantite) VALUES ($idCommande, $idcond, $quantite)";
				$resultLcc = @mysql_query($requeteLcc);
				if (!$resultLcc) break;
			}
		}
	}
	
	if ($resultCommande && $resultDeleteLcc && $resultLcc){
		commit(); // transaction is committed				
	}
	else {
		rollback(); // transaction rolls back
	}
}

function liste_commandes ($idClient,  $dateInf, $dateSup, $idConditionnement, $etat)
{
  $select = "SELECT distinct commande_id, client_nom, client_prenom, commande_datecreation, commande_dateannulation, commande_etat, client_reference ";
  $from = "FROM commande, client, lien_commande_cond, produit, conditionnement  ";
  $where = "WHERE commande_id_client = client_reference AND lcc_id_commande = commande_id AND lcc_id_cond = cond_id AND cond_id_produit = produit_id ";
  
  
  if ($idClient==-1) $idClient = null;
  if ($idConditionnement==-1) $idConditionnement = null;
  if ($etat==-1) $etat = null;
  
  if ($idClient!=null) $where = $where . " AND client_reference='$idClient'"; 
  if ($dateInf!=null) $where = $where . " AND commande_datecreation>='$dateInf. 00:00:00'";
  if ($dateSup!=null) $where = $where . " AND commande_datecreation<'$dateSup. 23:59:59'";
  if ($idConditionnement!=null) {
  	$from = $from . "";
  	$where = $where . " AND cond_id = '$idConditionnement'";
  }
  if ($etat!=null) $where = $where . " AND commande_etat = '$etat'";
  
  $order = " ORDER by commande_id DESC";
  
  $requete = $select.$from.$where.$order;
  
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	$libelleEtat = "";
  	switch ($row[5]) {
	case 'EC':
	    $libelleEtat = "en cours";
	    break;
	case 'AN':
	    $libelleEtat = "annulée";
	    break;
	case 'FA':
	    $libelleEtat = "facturée";
	    break;
	}

	$dateAnnulation = ($row[4]!=null)? $row[4] : '&nbsp;';
	
  	echo "<tr id='commande_$row[0]' onmouseout=\"restaureLigne('commande_$row[0]');\" onmouseover=\"survolLigne('commande_$row[0]');\">";
    echo "<td><a title='générer la facture' href='javascript:genererFacture($row[0])'><image src='images/pdf.gif' border=0/></a> $row[0]</td>";
    echo "<td>$row[1] $row[2]</td>";
    echo "<td>".affiche_resume_commande($row[0])."</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$dateAnnulation</td>";
    echo "<td>$libelleEtat</td>";
    echo "<td>".affiche_somme_commande($row[0])."</td>";
    echo "<td align=\"right\">";
    echo "<a href=\"?page=commandes&action=modifier&idCommande=$row[0]&refClient=$row[6]\">[".ADMIN_COMMANDE_MODIFIER."]</a>";
    echo "<a href=\"\" onclick=\"alerteSuppressionCommande('$row[0]')\">[".ADMIN_COMMANDE_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affiche_detail_commande($idCommande){
	
  $requete = "SELECT cond_id, cond_nom, cond_prix, produit_libelle, produit_prix_unite, lcc_quantite FROM conditionnement, produit, lien_commande_cond " .
			"WHERE lcc_id_cond = cond_id AND cond_id_produit = produit_id AND lcc_id_commande = " . $idCommande ;	

  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	
  	$condId = $row[0];
  	$condNom = $row[1];
  	$condPrix = $row[2];
  	$produitLibelle = $row[3];
  	$produitPrixUnite = $row[4];
  	$quantiteCondCommande = $row[5];
  	
	echo "<tr id='tr_cond_$condId'>
			<td>$produitLibelle [$condNom]</td>
			<td><input name='input_qte_cond_$condId' id='input_qte_cond_$condId' type='text' value='$quantiteCondCommande'></td>
			<td><input value=\"Retirer '$produitLibelle [$condNom]'\" type='button' onclick=\"retraitCondCommande($('tr_cond_$condId'))\"></td>
		 </tr>";
	
  }
	
}

function affiche_somme_commande($idCommande){
	
  $requete=
		"SELECT p.produit_prix_unite, cond.cond_prix, cond.cond_quantite_produit, " .
		"lcc.lcc_quantite " .
		"FROM produit p, lien_commande_cond lcc, conditionnement cond " .
		"WHERE p.produit_id = cond.cond_id_produit AND cond.cond_id = lcc.lcc_id_cond AND lcc.lcc_id_commande = " . $idCommande . "";

  $resultats=mysql_query($requete) or die (mysql_error());
  
  $prix = 0;
  
  while ($row = mysql_fetch_array($resultats))
  {
  	
  	$prixProduitUnite = $row[0];
  	$condPrix = $row[1];
  	$condQuantiteProduit = $row[2];
  	$quantiteCondCommande = $row[3];
  	
  	$prix += $quantiteCondCommande * ($prixProduitUnite * $condQuantiteProduit) 
  			 + $quantiteCondCommande * $condPrix;  	
  }
  
  return $prix . " €";
  
}

function supprimer_commande($idCommande) {
	
	$resultDeleteLcc = false;
	$resultDeleteCommande = false;
	
	begin(); // début de transaction
	
	$requeteDeleteLcc = "DELETE FROM lien_commande_cond where lcc_id_commande = '$idCommande'";
	$resultDeleteLcc=mysql_query($requeteDeleteLcc) or die (mysql_error());
	
	$requeteDeleteCommande = "DELETE FROM commande where commande_id = '$idCommande'";
	$resultDeleteCommande=mysql_query($requeteDeleteCommande) or die (mysql_error());
	
	if ($resultDeleteLcc && $resultDeleteCommande) {
		commit();
	}
	else {
		rollback();	
	}
}

function affiche_resume_commande($idCommande){
	$resume = "";
	$requete = "SELECT cond_nom, produit_libelle, lcc_quantite  FROM conditionnement, produit, lien_commande_cond " .
			"WHERE lcc_id_cond = cond_id AND cond_id_produit = produit_id AND lcc_id_commande = " . $idCommande ;
	
	$resultats=mysql_query($requete) or die (mysql_error());
  	while ($row = mysql_fetch_array($resultats))
  	{
  	 $resume = $resume . $row[0] . " " . $row[1] . " x " . $row[2] . ", "; 
  	}
  	$resume = substr ($resume, 0, strlen($resume)-2);
  	return substr ($resume, 0, 50) . "...";
}
?>
