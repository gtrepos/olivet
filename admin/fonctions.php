<?php

function affich_clients ($nom, $prenom, $commune)
{
  $select="SELECT client_reference, client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email ";
  $from="FROM client ";
  $order=" ORDER by client_reference DESC";
  
  $where = "WHERE 1=1";
  
  if ($nom!=null) $where = $where . " AND client_nom like '$nom%'";
  if ($prenom!=null) $where = $where . " AND client_prenom like '$prenom%'";
  if ($commune!=null) $where = $where . " AND client_commune like '%$commune%'";
  
  $requete = $select.$from.$where.$order;
  
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
  	
  	$adresse = ($row[3]!=null || $row[4]!=null || $row[5]!=null)? $row[3]. ' ' .$row[4]. ' ' .$row[5]:'&nbsp;';
  	
    echo "<tr id='client_$row[0]' onmouseout=\"restaureLigne('client_$row[0]');\" onmouseover=\"survolLigne('client_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$adresse</td>";
    echo "<td>$row[6]</td>";
    echo "<td>$row[7]</td>";
    echo "<td align=\"right\">";
    echo " <a href=\"?page=clients&action=modifier&ref=$row[0]\">[".ADMIN_CLIENT_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionClient('$row[0]','$row[1]','$row[2]')\">[".ADMIN_CLIENT_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affich_modif_client ($ref)
{
  $requete="SELECT client_reference, client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email FROM client where client_reference = '$ref'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du client <b>'$row[1] $row[2]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='ref' name='ref' value='$row[0]'/></tr>";
	echo "<tr><td>Référence : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Nom : </td><td><input type='text' id='nom' name='nom' value='$row[1]' size='30'/></td></tr>";
	echo "<tr><td>Prénom : </td><td><input type='text' id='prenom' name='prenom' value='$row[2]' size='30'/></td></tr>";
	echo "<tr><td valign='top'>Adresse : </td><td><textarea id='adresse' name='adresse' cols='25'>$row[3]</textarea></td></tr>";
	echo "<tr><td>Code postal : </td><td><input type='text' id='cp' name='cp' value='$row[4]' size='30'/></td></tr>";
	echo "<tr><td>Commune : </td><td><input type='text' id='commune' name='commune' value='$row[5]' size='30'/></td></tr>";
	echo "<tr><td>N° Téléphone : </td><td><input type='text' id='tel' name='tel' value='$row[6]' size='30'/></td></tr>";
	echo "<tr><td>Email : </td><td><input type='text' id='email' name='email' value='$row[7]' size='30'/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_client($mode, $reference, $nom, $prenom, $adresse, $codepostal, $commune, $numerotel, $email){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO client (client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email) VALUES ('$nom', '$prenom', '$adresse', '$codepostal', '$commune', '$numerotel', '$email')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE client SET client_nom = '$nom', client_prenom = '$prenom', client_adresse = '$adresse', client_code_postal = '$codepostal', client_commune = '$commune', client_numero_tel = '$numerotel', client_email = '$email' WHERE client_reference = '$reference'";
	}
	$result=mysql_query($requete) or die (mysql_error());	
}

function supprimer_client($ref){
	$requete = "DELETE FROM client where client_reference = '$ref'";
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_clients($select, $toDisabled){
	
	$requete="SELECT client_reference, client_nom, client_prenom FROM client ORDER by client_nom";
	$resultats=mysql_query($requete) or die (mysql_error());
	
	$disabled = "";
	if ($toDisabled) $disabled = "disabled"; 
	
	echo "<SELECT id='refClient' name='refClient' ".$disabled.">";
	echo "<OPTION value='-1'>-- Sélectionner un client --</OPTION>";
	while ($row = mysql_fetch_array($resultats))
  	{
  		$selected = "";
  		if ($row[0] == $select) $selected = "selected"; 
    	echo "<OPTION value='$row[0]' $selected>$row[1] $row[2] (ref : $row[0])</OPTION>";
  	}
  	echo "</SELECT>";
}

function affich_actualites ()
{
  $requete="SELECT actualite_id, actualite_libelle, CONCAT(SUBSTRING(actualite_descriptif, 1, 20),'...'), actualite_datecreation, actualite_datemodification, actualite_type, actualite_nouveaute, actualite_etat FROM actualite ORDER by actualite_id DESC";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $typeLibelle = "";
    if ($row[5]=='GAEC') $typeLibelle = ADMIN_ACTUALITE_GAEC;
    if ($row[5]=='LOMA') $typeLibelle = ADMIN_ACTUALITE_LOMA; 
    
    $nouveauteLibelle = ($row[6]==0) ? 'Non' : 'Oui';
    
    $etatLibelle = ($row[7]==0) ? 'Inactif' : 'Actif';
    
    echo "<tr id='actu_$row[0]' onmouseout=\"restaureLigne('actu_$row[0]');\" onmouseover=\"survolLigne('actu_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$typeLibelle</td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td align=\"right\">";
  	if ($row[7]==0) {
    	echo " <a href=\"?page=actualites&action=activer&id=$row[0]\">[".ADMIN_ACTUALITE_ACTIVER."]</a>";	
    }
    if ($row[7]==1) {
    	echo " <a href=\"?page=actualites&action=desactiver&id=$row[0]\">[".ADMIN_ACTUALITE_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=actualites&action=modifier&id=$row[0]\">[".ADMIN_ACTUALITE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionActu('$row[0]','$row[1]')\">[".ADMIN_ACTUALITE_SUPPRIMER."]</a>";
    echo "</tr>";
    
  }
}

function affich_modif_actu ($id)
{
  $requete="SELECT actualite_id, actualite_libelle, actualite_descriptif, actualite_datecreation, actualite_datemodification, actualite_type, actualite_nouveaute FROM actualite where actualite_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification de l'actualité <b>'$row[1]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value=\"$row[1]\"></td></tr>";
	echo "<tr><td valign='top'>Descriptif : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$row[2]</textarea></td></tr>";
	echo "<tr><td>Type d'actualité : </td><td>"; echo liste_type_actualite($row[5]); echo "</td></tr>";
	$nouveauteChecked = "";
	if ($row[6]==1) $nouveauteChecked = "checked";
	echo "<tr><td>Nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $nouveauteChecked/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_actu($mode, $id, $libelle, $descriptif, $type, $nouveaute){
	$requete = "";
	$nouveaute = ($nouveaute=='on') ? 1 : 0 ; 
	
	$libelle = addslashes($libelle); 
	$descriptif = addslashes($descriptif);
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO actualite (actualite_libelle, actualite_descriptif, actualite_datecreation, actualite_type, actualite_nouveaute) VALUES ('$libelle', '$descriptif', now(), '$type', '$nouveaute')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE actualite SET actualite_libelle = '$libelle', actualite_descriptif = '$descriptif', actualite_type = '$type', actualite_nouveaute = '$nouveaute' WHERE actualite_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_type_actualite($select){
	echo "<SELECT id='type' name='type'>";
	echo "<OPTION value='-1'>-- Sélectionner un type d'actualité --</OPTION>";
	echo "<OPTION value='GAEC' " ; if ('GAEC' == $select) echo "selected"; echo ">".ADMIN_ACTUALITE_GAEC."</OPTION>";
    echo "<OPTION value='LOMA' " ; if ('LOMA' == $select) echo "selected"; echo ">".ADMIN_ACTUALITE_LOMA."</OPTION>";
  	echo "</SELECT>";
}

function activer_actualite($id) {
	$requete = "UPDATE actualite SET actualite_etat = 1 WHERE actualite_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_actualite($id) {
	$requete = "UPDATE actualite SET actualite_etat = 0 WHERE actualite_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_actu($id){
	$requete = "DELETE FROM actualite where actualite_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function affich_categories ()
{
  $requete="SELECT categorie_produit_id, categorie_produit_libelle, categorie_produit_etat FROM categorie_produit ORDER by categorie_produit_id DESC";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $etatLibelle = ($row[2]==0) ? 'Inactif' : 'Actif';
    
    echo "<tr id='cat_$row[0]' onmouseout=\"restaureLigne('cat_$row[0]');\" onmouseover=\"survolLigne('cat_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td align=\"right\">";
    
    if ($row[2]==0) {
    	echo " <a href=\"?page=categories&action=activer&id=$row[0]\">[".ADMIN_CATEGORIE_ACTIVER."]</a>";	
    }
    if ($row[2]==1) {
    	echo " <a href=\"?page=categories&action=desactiver&id=$row[0]\">[".ADMIN_CATEGORIE_DESACTIVER."]</a>";
    }
    
    echo " <a href=\"?page=categories&action=modifier&id=$row[0]\">[".ADMIN_CATEGORIE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionCategorie('$row[0]','$row[1]')\">[".ADMIN_CATEGORIE_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affich_modif_categorie ($id)
{
  $requete="SELECT categorie_produit_id, categorie_produit_libelle FROM categorie_produit where categorie_produit_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification de la catégorie <b>'$row[1]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value='$row[1]'/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_categorie($mode, $id, $libelle){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO categorie_produit (categorie_produit_libelle) VALUES ('$libelle')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE categorie_produit SET categorie_produit_libelle = '$libelle' WHERE categorie_produit_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_categorie($id) {
	$requete = "UPDATE categorie_produit SET categorie_produit_etat = 1 WHERE categorie_produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_categorie($id) {
	$requete = "UPDATE categorie_produit SET categorie_produit_etat = 0 WHERE categorie_produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_categorie($id){
	$requete = "DELETE FROM categorie_produit where categorie_produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function liste_categories($select){
	$requete="SELECT categorie_produit_id, categorie_produit_libelle FROM categorie_produit WHERE categorie_produit_etat = 1 ORDER by categorie_produit_libelle";
	$resultats=mysql_query($requete) or die (mysql_error());
	echo "<SELECT id='idCategorie' name='idCategorie'>";
	echo "<OPTION value='-1'>-- Sélectionner une catégorie --</OPTION>";
	while ($row = mysql_fetch_array($resultats))
  	{
  		$selected = "";
  		if ($row[0] == $select) $selected = "selected"; 
    	echo "<OPTION value='$row[0]' $selected>$row[1]</OPTION>";
  	}
  	echo "</SELECT>";
}

function affich_produits ()
{
  $requete=
		"SELECT p.produit_id, c.categorie_produit_libelle, p.produit_libelle, p.produit_nb_stock, p.produit_unite, p.produit_prix_unite, p.produit_conditionnement,  " . 
		"p.produit_conditionnement_nom, p.produit_conditionnement_taille_fixe, p.produit_conditionnement_taille, p.produit_conditionnement_taille_sup, p.produit_nouveaute, p.produit_etat " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " .
  		"ORDER by p.produit_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    
    $stockLibelle = ($row[3]==-1) ? 'Aucun' : $row[3]; 
    $nouveauteLibelle = ($row[11]==0) ? 'Non' : 'Oui';
	$etatLibelle = ($row[12]==0) ? 'Inactif' : 'Actif';
	
	if ($row[6]==0){
		$conditionnement = 'vendu à l\'unité';	
		$prixConditionnement = '&nbsp;';
	}
	else {
		//cas d'un conditionnement à taille fixe
		if ($row[8]==1){
			$conditionnement = $row[7] . ' (' . $row[9] . ' ' . $row[4] . ')';
			$prixConditionnement = 'Fixe : '.$row[9]*$row[5].' €';
		}
		//cas d'un conditionnement à taille variable
		else {
			$conditionnement = $row[7] . ' (' . $row[9] . ' à '  . $row[10] . ' ' . $row[4] . ')';
			$prixConditionnement = 'Variable : '.$row[9]*$row[5].' à '.$row[10]*$row[5].' €';
		}
	}
	
	//affichage de la ligne prodit
    echo "<tr id='prod_$row[0]' onmouseout=\"restaureLigne('prod_$row[0]');\" onmouseover=\"survolLigne('prod_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$stockLibelle</td>";
    echo "<td>$row[5] € / $row[4]</td>";
    echo "<td>$conditionnement</td>";
    echo "<td>$prixConditionnement</td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td align=\"right\">";
    if ($row[12]==0) {
    	echo " <a href=\"?page=produits&action=activer&id=$row[0]\">[".ADMIN_PRODUIT_ACTIVER."]</a>";	
    }
    if ($row[12]==1) {
    	echo " <a href=\"?page=produits&action=desactiver&id=$row[0]\">[".ADMIN_PRODUIT_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=produits&action=modifier&id=$row[0]\">[".ADMIN_PRODUIT_MODIFIER."]</a>";
    
    if (checkProduitInCommande($row[0])) {
    	echo " [Command]";
    }
    else {
    	echo " <a href=\"\" onclick=\"alerteSuppressionProduit('$row[0]','$row[1]')\">[".ADMIN_PRODUIT_SUPPRIMER."]</a>";	
    }
    
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_produit ($id)
{
  $requete=
		"SELECT produit_id, produit_id_categorie, produit_libelle, produit_nouveaute, produit_descriptif_production, produit_unite, produit_prix_unite, produit_conditionnement, " .
  		"produit_conditionnement_nom, produit_conditionnement_taille_fixe, produit_conditionnement_taille, produit_conditionnement_taille_sup, produit_nb_stock " .
		"FROM produit " .
		"WHERE produit_id = '$id' ";
  
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	//est-ce une nouveauté ?
  	$nouveauteChecked = "";
	if ($row[3]==1) $nouveauteChecked = "checked";
	
	//y a t il un conditionnement ?
  	$conditionnementChecked = "";
	if ($row[7]==1) $conditionnementChecked = "checked";
	
	//style css si pas de conditionnement ?
	$styleConditionnement = "";
	if ($row[7]==0) $styleConditionnement = 'style=\'display: none\'';
	
	//si conditionnement de taille fixe
	if ($row[9]==1) {
		$checkedFixe = 'checked';
		$readonlyFixe = "";
		$checkedVariable = '';	
		$readonlyVariable = "readonly='readonly'";
	}
	//si conditionnement de taille variable
	else {
		$checkedFixe = '';
		$readonlyFixe = "readonly='readonly'";
		$checkedVariable = 'checked';			
		$readonlyVariable = "";		
	}
	
	//détermine la taille du conditionnement
	$taille = "";
	$tailleInf = "";
	$tailleSup = "";
	if ($row[9]==1) {
		$taille = $row[10];
	}
  	else {
		$tailleInf = $row[10];
		$tailleSup = $row[11];
	}
	
	//si nbstock vide ou 0 
	$stock = $row[12];
	$stockChecked = '';
	if ($stock>0) {
		$stockChecked = 'checked';
	}
	else {
		$stock = '';
	}
	
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du produit <b>'$row[2]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Catégorie : </td><td>";echo liste_categories($row[1]);echo "</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value='$row[2]'/></td></tr>";
	echo "<tr><td>Stock : </td><td><input type='checkbox' id='is_stock' name='is_stock' value='is_stock' $stockChecked onclick=\"selectionneStock()\"/> : <input type='text' id='nb_stock' name='nb_stock' readonly='readonly' value='$stock'/></td></tr>";
	echo "<tr><td>Nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $nouveauteChecked/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$row[4]</textarea></td></tr>";
	echo "<tr><td>Unité (kg ? litre ?) : </td><td><input type='text' id='unite' name='unite' value='$row[5]'/></td></tr>";
	echo "<tr><td>Prix à l'unité : </td><td><input type='text' id='prix_unite' name='prix_unite' value='$row[6]'/> €</td></tr>";
	echo "<tr><td>Conditionnement ? </td><td><input type='checkbox' id='conditionnement' name='conditionnement' onclick='selectionneConditionnement()' $conditionnementChecked/></td></tr>";
	echo "<tr id='tr_conditionnement_nom' $styleConditionnement><td>Nom du conditionnement : </td><td><input type='text' id='cond_nom' name='cond_nom' value='$row[8]'/></td></tr>";
	echo "<tr id='tr_conditionnement_fixe' $styleConditionnement>";
	echo "<td>Conditionnement de taille fixe : </td>";
	echo "<td><input type='checkbox' id='cond_fixe' name='cond_fixe' $checkedFixe onclick='selectionneConditionnementFixe()'/> Précisez la taille : <input type='text' id='cond_taille' name='cond_taille' value='$taille' $readonlyFixe /> unités</td>";
	echo "</tr>";
	echo "<tr id='tr_conditionnement_variable' $styleConditionnement>";
	echo "<td>Conditionnement de taille variable : </td>";
	echo "<td><input type='checkbox' id='cond_variable' name='cond_variable' $checkedVariable onclick='selectionneConditionnementVariable()'/> Précisez la taille : de <input type='text' id='cond_taille_inf' name='cond_taille_inf' value='$tailleInf' $readonlyVariable /> unités à <input type='text' id='cond_taille_sup' name='cond_taille_sup' value='$tailleSup' $readonlyVariable/> unités</td>";
	echo "</tr>";	
	echo "</table>";
  }
}

function enregistrer_produit($mode, $id, $idCategorie, $libelle, $nb_stock, $nouveaute, $descriptif, $unite, $prix_unite, $conditionnement, $condNom, $condFixe, $condTaille, $condTailleInf, $condTailleSup){
	$requete = "";
	$nouveaute = ($nouveaute=='on') ? 1 : 0 ; 
	$conditionnement = ($conditionnement=='on') ? 1 : 0 ;
	
	if ($conditionnement==0){
		$condTailleInf = 'null';
		$condTailleSup = 'null';
	}
	
	if ($condFixe=='on') {
		$condFixe = 1;
		$condTailleInf = $condTaille;
		$condTailleSup = 'null';
	}
	else {
		$condFixe = 0;		
	}	
	
	if ($nb_stock=='' || $nb_stock==null) {
		$nb_stock = -1;
	}
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO produit (produit_id_categorie, produit_lien_photo, produit_libelle, produit_nb_stock, produit_nouveaute, produit_descriptif_production, produit_unite, produit_prix_unite, " . 
				   "produit_conditionnement, produit_conditionnement_nom, produit_conditionnement_taille_fixe, produit_conditionnement_taille, produit_conditionnement_taille_sup) " .
				   "VALUES ($idCategorie, 'lien_vide', '$libelle', $nb_stock, $nouveaute, '$descriptif', '$unite', '$prix_unite', " .  
				   "$conditionnement, '$condNom', $condFixe, $condTailleInf, $condTailleSup)";
	}
	
	else if ($mode == 'modification'){
		$requete = "UPDATE produit SET produit_id_categorie = $idCategorie, produit_libelle = '$libelle', produit_nb_stock = $nb_stock, produit_nouveaute = $nouveaute, produit_descriptif_production = '$descriptif', produit_unite = '$unite', " . 
				   "produit_prix_unite = $prix_unite, produit_conditionnement = $conditionnement, produit_conditionnement_nom = '$condNom', produit_conditionnement_taille_fixe = $condFixe, " . 
				   "produit_conditionnement_taille = $condTailleInf, produit_conditionnement_taille_sup = $condTailleSup " .
				   "WHERE produit_id = '$id'";
	}
	
	echo $requete;
	
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_produit($id) {
	$requete = "UPDATE produit SET produit_etat = 1 WHERE produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_produit($id) {
	$requete = "UPDATE produit SET produit_etat = 0 WHERE produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_produit($id){
	
	checkProduitInCommande($id);
	
	$requete = "DELETE FROM produit where produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function checkProduitInCommande($id) {
	//on ne peut pas supprimer un produit qui a été référencé dans une commande.
	$requeteCheckInCommande = "SELECT distinct p.produit_libelle, p.produit_id FROM lien_commande_produit lcp, commande c, produit p WHERE lcp.lcp_id_commande = c.commande_id AND lcp.lcp_id_produit = p.produit_id and p.produit_id = '$id'";
	
	$result=mysql_query($requeteCheckInCommande) or die (mysql_error());
	
	while ($row = mysql_fetch_array($result)){
		return true;
	}
	
	return false;
}

function affiche_produits_pour_commande($select, $remonteInactif){
  
  $sqlRemonteInactif = ($remonteInactif == true) ? '' : ' and p.produit_etat = 1 ';	
	
  $requete=
		"SELECT p.produit_id, p.produit_libelle, p.produit_unite, p.produit_prix_unite, produit_conditionnement, " .
  		"produit_conditionnement_nom, produit_conditionnement_taille_fixe, produit_conditionnement_taille, produit_conditionnement_taille_sup " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " . $sqlRemonteInactif .
  		"ORDER by c.categorie_produit_id, p.produit_libelle DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  
  echo "<SELECT id='idProduit' name='idProduit' onChange='addProduitCommande()'>";
  echo "<OPTION value='-1'>-- Sélectionner un produit --</OPTION>";
  while ($row = mysql_fetch_array($resultats))
  {
  	$selected = "";
  	if ($row[0] == $select) $selected = "selected";
  	
  	if ($row[4]==0){
		$conditionnement = 'à l\'unité';	
		//$prixConditionnement = '';
	}
	else {
		//cas d'un conditionnement à taille fixe
		if ($row[6]==1){
			$conditionnement = $row[5] . ' (' . $row[7] . ' ' . $row[2] . ')';
			//$prixConditionnement = 'Fixe : '.$row[7]*$row[3].' €';
		}
		//cas d'un conditionnement à taille variable
		else {
			$conditionnement = $row[5] . ' (' . $row[7] . ' à '  . $row[8] . ' ' . $row[2] . ')';
			//$prixConditionnement = 'Variable : '.$row[7]*$row[3].' à '.$row[8]*$row[3].' €';
		}
	}
  	echo "<OPTION value='$row[0]' $selected>$row[1] - $conditionnement</OPTION>";
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
	$resultLcp = false;	
	
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
			$quantiteEtProduit = split(":",$tableau[$i]);
			$idproduit = substr ($quantiteEtProduit[0], strlen("input_qte_prod_"), strlen($quantiteEtProduit[0]));
			$quantite = $quantiteEtProduit[1];
			$requeteLcp = "INSERT INTO lien_commande_produit (lcp_id_commande, lcp_id_produit, lcp_quantite) VALUES ($idCommande, $idproduit, $quantite)";
			$resultLcp = @mysql_query($requeteLcp);
			if (!$resultLcp) break;
		}
	}
	
	if ($resultCommande && $resultLcp){
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
	$resultDeleteLcp = false;
	$resultLcp = false;	
	
	begin(); // début de transaction
	
	//insert dans la table commandes
	$requeteCommande = "UPDATE commande SET commande_id_client = $refClient WHERE commande_id = $idCommande "  ;
	$resultCommande = @mysql_query($requeteCommande);
	
	if ($resultCommande){
		
		$requeteDeleteLcp = "DELETE FROM lien_commande_produit WHERE lcp_id_commande = " . $idCommande;
		$resultDeleteLcp = @mysql_query($requeteDeleteLcp);
		
		if ($resultDeleteLcp) {		
			//pour chaque produit insert dans la table lien_commande_produit
			$tableau = split(";", $recapCommande);
			for($i=0; $i < count($tableau); $i++){
				$quantiteEtProduit = split(":",$tableau[$i]);
				$idproduit = substr ($quantiteEtProduit[0], strlen("input_qte_prod_"), strlen($quantiteEtProduit[0]));
				$quantite = $quantiteEtProduit[1];
				$requeteLcp = "INSERT INTO lien_commande_produit (lcp_id_commande, lcp_id_produit, lcp_quantite) VALUES ($idCommande, $idproduit, $quantite)";
				$resultLcp = @mysql_query($requeteLcp);
				if (!$resultLcp) break;
			}
		}
	}
	
	if ($resultCommande && $resultDeleteLcp && $resultLcp){
		commit(); // transaction is committed				
	}
	else {
		rollback(); // transaction rolls back
	}
}

function affich_commandes ($idClient,  $dateInf, $dateSup, $idProduit, $etat)
{
  $select = "SELECT commande_id, client_nom, client_prenom, commande_datecreation, commande_dateannulation, commande_etat, commande_somme, client_reference ";
  $from = "FROM commande, client ";
  $where = "WHERE commande_id_client = client_reference ";
  
  
  if ($idClient==-1) $idClient = null;
  if ($idProduit==-1) $idProduit = null;
  if ($etat==-1) $etat = null;
  
  if ($idClient!=null) $where = $where . " AND client_reference='$idClient'"; 
  if ($dateInf!=null) $where = $where . " AND commande_datecreation>='$dateInf. 00:00:00'";
  if ($dateSup!=null) $where = $where . " AND commande_datecreation<'$dateSup. 23:59:59'";
  if ($idProduit!=null) {
  	$from = $from . ", lien_commande_produit, produit ";
  	$where = $where . " AND lcp_id_commande = commande_id AND lcp_id_produit = produit_id AND produit_id = '$idProduit'";
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
    echo "<td>$row[0]</td>";
    echo "<td>$row[1] $row[2]</td>";
    echo "<td>".affiche_resume_commande($row[0])."</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$dateAnnulation</td>";
    echo "<td>$libelleEtat</td>";
    echo "<td>".affiche_somme_commande($row[0])."</td>";
    echo "<td align=\"right\">";
    echo "<a href=\"?page=commandes&action=modifier&idCommande=$row[0]&refClient=$row[7]\">[".ADMIN_COMMANDE_MODIFIER."]</a>";
    echo "<a href=\"\" onclick=\"alerteSuppressionCommande('$row[0]')\">[".ADMIN_COMMANDE_SUPPRIMER."]</a>";
    echo "</tr>";
  }
}

function affiche_detail_commande($idCommande){
	
  $requete=
		"SELECT p.produit_id, p.produit_libelle, p.produit_unite, p.produit_prix_unite, produit_conditionnement, " .
  		"produit_conditionnement_nom, produit_conditionnement_taille_fixe, produit_conditionnement_taille, produit_conditionnement_taille_sup, " .
		"lcp.lcp_quantite " .
		"FROM produit p, lien_commande_produit lcp " .
		"WHERE p.produit_id = lcp.lcp_id_produit AND lcp.lcp_id_commande = " . $idCommande . "";  		

  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
  	
  	if ($row[4]==0){
		$conditionnement = 'à l\'unité';	
	}
	else {
		//cas d'un conditionnement à taille fixe
		if ($row[6]==1){
			$conditionnement = $row[5] . ' (' . $row[7] . ' ' . $row[2] . ')';
		}
		//cas d'un conditionnement à taille variable
		else {
			$conditionnement = $row[5] . ' (' . $row[7] . ' à '  . $row[8] . ' ' . $row[2] . ')';
		}
	}
	
	echo "<tr id='tr_prod_$row[0]'>
			<td>$row[1] - $conditionnement</td>
			<td><input name='input_qte_prod_$row[0]' id='input_qte_prod_$row[0]' type='text' value='$row[9]'></td>
			<td><input value=\"Retirer '$row[1] - $conditionnement'\" type='button' onclick=\"retraitProduitCommande($('tr_prod_$row[0]'))\"></td>
		 </tr>";
	
  }
	
}

function affiche_somme_commande($idCommande){
	
  $requete=
		"SELECT p.produit_id, p.produit_libelle, p.produit_unite, p.produit_prix_unite, produit_conditionnement, " .
  		"produit_conditionnement_nom, produit_conditionnement_taille_fixe, produit_conditionnement_taille, produit_conditionnement_taille_sup, " .
		"lcp.lcp_quantite " .
		"FROM produit p, lien_commande_produit lcp " .
		"WHERE p.produit_id = lcp.lcp_id_produit AND lcp.lcp_id_commande = " . $idCommande . "";

  $resultats=mysql_query($requete) or die (mysql_error());
  
  $prix = 0;
  $prixhaut = 0;
  
  while ($row = mysql_fetch_array($resultats))
  {
  	
  	if ($row[4]==0){
  		//calcul du prix à l'unité : 
  		//quantite * prix_unite
  		$prix += $row[9]*$row[3];
  		$prixhaut += $row[9]*$row[3];
  		
	}
	else {
		//cas d'un conditionnement à taille fixe
		if ($row[6]==1){
			//prix += quantite * prix_unite * produit_conditionnement_taille 
			$prix += $row[9]*$row[3]*$row[7];
			$prixhaut += $row[9]*$row[3]*$row[7];
		}
		//cas d'un conditionnement à taille variable
		else {
			//prix += quantite * prix_unite * produit_conditionnement_taille
			$prix += $row[9]*$row[3]*$row[7];
			
			//prixhaut += quantite * prix_unite * produit_conditionnement_taille_sup
			$prixhaut += $row[9]*$row[3]*$row[8];			
		}
	}
	
  }
	
  if ($prix!=$prixhaut) {
	return "Prix variable de " . $prix . " à " . $prixhaut . " €";
  }
  else {
	return $prix . " €";
  }
}

function supprimer_commande($idCommande) {
	
	$resultDeleteLcp = false;
	$resultDeleteCommande = false;
	
	begin(); // début de transaction
	
	$requeteDeleteLcp = "DELETE FROM lien_commande_produit where lcp_id_commande = '$idCommande'";
	$resultDeleteLcp=mysql_query($requeteDeleteLcp) or die (mysql_error());
	
	$requeteDeleteCommande = "DELETE FROM commande where commande_id = '$idCommande'";
	$resultDeleteCommande=mysql_query($requeteDeleteCommande) or die (mysql_error());
	
	if ($resultDeleteLcp && $resultDeleteCommande) {
		commit();
	}
	else {
		rollback();	
	}
}

function affiche_resume_commande($idCommande){
	$resume = "";
	$requete = "SELECT lcp_quantite, produit_libelle FROM produit, lien_commande_produit WHERE lcp_id_produit = produit_id AND lcp_id_commande = " . $idCommande ;
	
	$resultats=mysql_query($requete) or die (mysql_error());
  	while ($row = mysql_fetch_array($resultats))
  	{
  	 $resume = $resume . $row[0] . " " . $row[1] . ", "; 
  	}
  	$resume = substr ($resume, 0, strlen($resume)-2);
  	return $resume;
}

function affich_partenaires ()
{
  $requete=
		"SELECT partenaire_id, partenaire_libelle, CONCAT(SUBSTRING(partenaire_descriptif, 1, 20),'...'), partenaire_img_logo, partenaire_siteweb, partenaire_rang, partenaire_etat " .
		"FROM partenaire ORDER by partenaire_rang";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	$etatLibelle = ($row[6]==0) ? 'Inactif' : 'Actif';
	
    echo "<tr id='part_$row[0]' onmouseout=\"restaureLigne('part_$row[0]');\" onmouseover=\"survolLigne('part_$row[0]');\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$etatLibelle</td>";
    
    echo "<td align=\"right\">";
    if ($row[6]==0) {
    	echo " <a href=\"?page=partenaires&action=activer&id=$row[0]\">[".ADMIN_PARTENAIRE_ACTIVER."]</a>";	
    }
    if ($row[6]==1) {
    	echo " <a href=\"?page=partenaires&action=desactiver&id=$row[0]\">[".ADMIN_PARTENAIRE_DESACTIVER."]</a>";
    }
    echo " <a href=\"?page=partenaires&action=modifier&id=$row[0]\">[".ADMIN_PARTENAIRE_MODIFIER."]</a>";
    echo " <a href=\"\" onclick=\"alerteSuppressionPartenaire('$row[0]','$row[1]')\">[".ADMIN_PARTENAIRE_SUPPRIMER."]</a>";
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_partenaire ($id)
{
  $requete="SELECT partenaire_id, partenaire_libelle, partenaire_descriptif, partenaire_img_logo, partenaire_siteweb, partenaire_rang FROM partenaire where partenaire_id = '$id'";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du partenaire <b>'$row[1]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value='$row[1]'/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif du partenaire : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$row[2]</textarea></td></tr>";
	echo "<tr><td>Logo (nom de l'image) : </td><td><input type='text' id='imglogo' name='imglogo' value='$row[3]'/></td></tr>";
	echo "<tr><td>Site web : </td><td><input type='text' id='siteweb' name='siteweb' value='$row[4]'/></td></tr>";
	echo "<tr><td>Rang : </td><td><input type='text' id='rang' name='rang' value='$row[5]'/></td></tr>";
	echo "</table>";
  }
}

function enregistrer_partenaire($mode, $id, $libelle, $descriptif, $imglogo, $siteweb, $rang){
	$requete = "";
	if ($mode == 'creation'){
		$requete = "INSERT INTO partenaire (partenaire_libelle, partenaire_descriptif, partenaire_img_logo, partenaire_siteweb, partenaire_rang) VALUES ('$libelle', '$descriptif', '$imglogo', '$siteweb', '$rang')";		 
	}
	else if ($mode == 'modification'){
		$requete = 
			"UPDATE partenaire SET partenaire_libelle = '$libelle', partenaire_descriptif = '$descriptif', partenaire_img_logo = '$imglogo', partenaire_siteweb = '$siteweb', partenaire_rang = '$rang' " .
			"WHERE partenaire_id = '$id'";
	}
	$result=mysql_query($requete) or die (mysql_error());
}

function activer_partenaire($id) {
	$requete = "UPDATE partenaire SET partenaire_etat = 1 WHERE partenaire_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function desactiver_partenaire($id) {
	$requete = "UPDATE partenaire SET partenaire_etat = 0 WHERE partenaire_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function supprimer_partenaire($id){
	$requete = "DELETE FROM partenaire where partenaire_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}