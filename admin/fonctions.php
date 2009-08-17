<?php

function affich_clients ()
{
  $requete="SELECT client_reference, client_nom, client_prenom, client_adresse, client_code_postal, client_commune, client_numero_tel, client_email FROM client ORDER by client_reference DESC";
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $gras_fin="</b>";

    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3] $row[4] $row[5]</td>";
    echo "<td>$row[6]</td>";
    echo "<td>$row[7]</td>";
    echo "<td align=\"right\">";
    echo " <a href=\"?page=clients&action=modifier&ref=$row[0]\">[".ADMIN_CLIENT_MODIFIER."]</a>$gras_fin";
    echo " <a href=\"\" onclick=\"alerteSuppressionClient('$row[0]','$row[1]','$row[2]')\">[".ADMIN_CLIENT_SUPPRIMER."]</a>$gras_fin";
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
	echo "<tr><td>Nom : </td><td><input type='text' id='nom' name='nom' value='$row[1]'/></td></tr>";
	echo "<tr><td>Prénom : </td><td><input type='text' id='prenom' name='prenom' value='$row[2]'/></td></tr>";
	echo "<tr><td valign='top'>Adresse : </td><td><textarea id='adresse' name='adresse'>$row[3]</textarea></td></tr>";
	echo "<tr><td>Code postal : </td><td><input type='text' id='cp' name='cp' value='$row[4]'/></td></tr>";
	echo "<tr><td>Commune : </td><td><input type='text' id='commune' name='commune' value='$row[5]'/></td></tr>";
	echo "<tr><td>N° Téléphone : </td><td><input type='text' id='tel' name='tel' value='$row[6]'/></td></tr>";
	echo "<tr><td>Email : </td><td><input type='text' id='email' name='email' value='$row[7]'/></td></tr>";
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

function liste_clients($select){
	$requete="SELECT client_reference, client_nom, client_prenom FROM client ORDER by client_nom";
	$resultats=mysql_query($requete) or die (mysql_error());
	echo "<SELECT id='refClient' name='refClient'>";
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
    
    echo "<tr>";
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
    $gras_fin="</b>";
    $etatLibelle = ($row[2]==0) ? 'Inactif' : 'Actif';
    
    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td align=\"right\">";
    
    if ($row[2]==0) {
    	echo " <a href=\"?page=categories&action=activer&id=$row[0]\">[".ADMIN_CATEGORIE_ACTIVER."]</a>$gras_fin";	
    }
    if ($row[2]==1) {
    	echo " <a href=\"?page=categories&action=desactiver&id=$row[0]\">[".ADMIN_CATEGORIE_DESACTIVER."]</a>$gras_fin";
    }
    
    echo " <a href=\"?page=categories&action=modifier&id=$row[0]\">[".ADMIN_CATEGORIE_MODIFIER."]</a>$gras_fin";
    echo " <a href=\"\" onclick=\"alerteSuppressionCategorie('$row[0]','$row[1]')\">[".ADMIN_CATEGORIE_SUPPRIMER."]</a>$gras_fin";
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
		"SELECT p.produit_id, c.categorie_produit_libelle, p.produit_libelle, CONCAT(SUBSTRING(p.produit_descriptif_production, 1, 20),'...'), p.produit_conditionnement, p.produit_unite, p.produit_prix, p.produit_nouveaute, p.produit_etat " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " .
  		"ORDER by p.produit_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $gras_fin="</b>";
	$nouveauteLibelle = ($row[7]==0) ? 'Non' : 'Oui';
	$etatLibelle = ($row[8]==0) ? 'Inactif' : 'Actif';
	
    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[6] € / $row[5]</td>";
    echo "<td>$nouveauteLibelle</td>";
    echo "<td>$etatLibelle</td>";
    echo "<td align=\"right\">";
    if ($row[8]==0) {
    	echo " <a href=\"?page=produits&action=activer&id=$row[0]\">[".ADMIN_PRODUIT_ACTIVER."]</a>$gras_fin";	
    }
    if ($row[8]==1) {
    	echo " <a href=\"?page=produits&action=desactiver&id=$row[0]\">[".ADMIN_PRODUIT_DESACTIVER."]</a>$gras_fin";
    }
    echo " <a href=\"?page=produits&action=modifier&id=$row[0]\">[".ADMIN_PRODUIT_MODIFIER."]</a>$gras_fin";
    echo " <a href=\"\" onclick=\"alerteSuppressionProduit('$row[0]','$row[1]')\">[".ADMIN_PRODUIT_SUPPRIMER."]</a>$gras_fin";
    echo "</td>";
    echo "</tr>";
  }
}

function affich_modif_produit ($id)
{
  $requete=
		"SELECT produit_id, produit_id_categorie, produit_libelle, produit_descriptif_production, produit_conditionnement, produit_unite, produit_prix, produit_nouveaute " .
		"FROM produit " .
		"WHERE produit_id = '$id' ";
  $resultats=mysql_query($requete) or die (mysql_error());
  
  while ($row = mysql_fetch_array($resultats))
  {
	echo "<table>";
	echo "<tr><td colspan='2'>Modification du produit <b>'$row[2]'</b></tr>";
	echo "<tr><td colspan='2'>&nbsp;<input type='hidden' id='id' name='id' value='$row[0]'/></tr>";
	echo "<tr><td>Identifiant : </td><td>$row[0]</td></tr>";
	echo "<tr><td>Catégorie : </td><td>";echo liste_categories($row[1]);echo "</td></tr>";
	echo "<tr><td>Libellé : </td><td><input type='text' id='libelle' name='libelle' value='$row[2]'/></td></tr>";
	echo "<tr><td valign=\"top\">Descriptif de production : </td><td><textarea rows=10 cols=70 id='descriptif' name='descriptif'>$row[3]</textarea></td></tr>";
	echo "<tr><td>Condtionnement : </td><td><input type='text' id='conditionnement' name='conditionnement' value='$row[4]'/></td></tr>";
	echo "<tr><td>Unité : </td><td><input type='text' id='unite' name='unite' value='$row[5]'/></td></tr>";
	echo "<tr><td>Prix à l'unité : </td><td><input type='text' id='prix' name='prix' value='$row[6]'/> €</td></tr>";
	
	$nouveauteChecked = "";
	if ($row[7]==1) $nouveauteChecked = "checked";
	echo "<tr><td>Nouveauté ? </td><td><input type='checkbox' id='nouveaute' name='nouveaute' $nouveauteChecked/></td></tr>";
	
	echo "</table>";
  }
}

function enregistrer_produit($mode, $id, $idCategorie, $libelle, $descriptif, $conditionnement, $nouveaute, $unite, $prix){
	$requete = "";
	$nouveaute = ($nouveaute=='on') ? 1 : 0 ; 
	
	if ($mode == 'creation'){
		$requete = "INSERT INTO produit (produit_id_categorie, produit_lien_photo, produit_libelle, produit_descriptif_production, produit_conditionnement, produit_nouveaute, produit_unite, produit_prix) " .
				   "VALUES ($idCategorie, 'lien_vide', '$libelle', '$descriptif', '$conditionnement', $nouveaute, '$unite', '$prix')";		 
	}
	else if ($mode == 'modification'){
		$requete = "UPDATE produit SET produit_id_categorie = $idCategorie, produit_libelle = '$libelle', produit_descriptif_production = '$descriptif', produit_conditionnement = '$conditionnement', produit_nouveaute = $nouveaute, produit_unite = '$unite', produit_prix = $prix " .
				   "WHERE produit_id = '$id'";
	}
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
	$requete = "DELETE FROM produit where produit_id = '$id'";
	$result=mysql_query($requete) or die (mysql_error());
}

function affiche_produits_pour_commande(){
  $requete=
		"SELECT p.produit_id, p.produit_libelle, p.produit_unite, p.produit_prix " .
		"FROM produit p, categorie_produit c " .
		"WHERE p.produit_id_categorie = c.categorie_produit_id " .
  		"ORDER by c.categorie_produit_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  echo "<table cellspacing=0 cellpadding=2>";
  while ($row = mysql_fetch_array($resultats))
  {
    echo "<tr>";
    echo "<td>$row[1]</td>";
    echo "<td>&nbsp;</td>";
    echo "<td><input type=text id='nb$row[0]' name='nb$row[0]'/></td>";
    echo "<td> x $row[3] € / $row[2]</td>";
    echo "</tr>";
  }
  echo "</table>";
}


function affich_partenaires ()
{
  $requete=
		"SELECT partenaire_id, partenaire_libelle, CONCAT(SUBSTRING(partenaire_descriptif, 1, 20),'...'), partenaire_img_logo, partenaire_siteweb, partenaire_rang, partenaire_etat " .
		"FROM partenaire ORDER by partenaire_id DESC";
  		
  $resultats=mysql_query($requete) or die (mysql_error());
  while ($row = mysql_fetch_array($resultats))
  {
    $gras_fin="</b>";
	$etatLibelle = ($row[6]==0) ? 'Inactif' : 'Actif';
	
    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$etatLibelle</td>";
    
    echo "<td align=\"right\">";
    if ($row[6]==0) {
    	echo " <a href=\"?page=partenaires&action=activer&id=$row[0]\">[".ADMIN_PARTENAIRE_ACTIVER."]</a>$gras_fin";	
    }
    if ($row[6]==1) {
    	echo " <a href=\"?page=partenaires&action=desactiver&id=$row[0]\">[".ADMIN_PARTENAIRE_DESACTIVER."]</a>$gras_fin";
    }
    echo " <a href=\"?page=partenaires&action=modifier&id=$row[0]\">[".ADMIN_PARTENAIRE_MODIFIER."]</a>$gras_fin";
    echo " <a href=\"\" onclick=\"alerteSuppressionPartenaire('$row[0]','$row[1]')\">[".ADMIN_PARTENAIRE_SUPPRIMER."]</a>$gras_fin";
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