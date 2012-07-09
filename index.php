<?php
if ( session_id() == '' ) { // no session has been started yet, which is needed for validation
	session_start();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
require_once("tools/config.php") ;
ouverture();
require_once("tools/visitor_bdd_functions.php") ;
require_once('tools/visitor_panier_functions.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>La Ferme d'Olivet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv='language' content='fr'>
	<meta name='Description' content="La Ferme d'Olivet - Site officiel - Servon, Olivet, Ferme, Bio, Actualités, Produits">
	<meta name='Keywords' content="Servon, Olivet, Site officiel, Ferme, Bio, Actualités, Produits">
	<meta name="GOOGLEBOT" content="index,follow">
	<meta name='robots' content='index,follow'>
	<meta name='author' content='Ferme d''Olivet'>
	<meta name='revisit-after' content='7 days'>
	<meta name="rating" content="general" />
	<link href="http://fermeolivet.free.fr/favicon.ico" rel="SHORTCUT ICON" />
	<!-- La feuille de styles "base.css" doit etre appelle en premier. -->
	<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
	<link rel="stylesheet" type="text/css" href="styles/modele08.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/partenaires.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/recapitulatif.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/ferme.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.11.custom.css" media="screen" />
	<?php include("googleMap.php"); ?>
	<script	src="http://maps.google.com/?file=api&amp;v=2.x&amp;key=ABQIAAAASki4stJtJM6pFLg7NiCJSBSFNPR8qUy5LlztrteYkgDBd3SwJhT0xjOg_KyOByCOxNK7aYDpFTzPoQ" type="text/javascript"></script>  
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker.min.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker-fr.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/commun.js"></script>
	<script type="text/javascript" src="js/dateUtilitaire.js"></script>
</head>

<body>

<div id="global">

<div id="entete">
<div id="sur-titre">
<p>agriculture biologique, lutte anti mal bouffe</p>
</div>

</div>
<!-- #entete -->

<div class="ombre ombrenavigation">

<div id="navigation">
<ul>
	<li class="gauche"><a href="javascript:clickNavigation('accueil')">Accueil</a></li>
	<li class="gauche"><a href="javascript:clickNavigation('la_ferme')">La Ferme</a></li>
	<li class="gauche"><a href="javascript:clickNavigation('magasin')">Le magasin</a></li>
	<li class="gauche"><a href="javascript:clickNavigation('nos_produits')">Les	Produits</a></li>
	<?php if (isCommandePossible()) {?>
	<li class="gauche"><a href="javascript:clickNavigation('commander')">Commander</a></li>
	<?php } ?>
	<?php if (mysql_num_rows(bddActusGaec(false,false))>0 || mysql_num_rows(bddActusLoma(false,false))>0) { ?>
	<li class="gauche"><a href="javascript:clickNavigation('actualites')">Actualités</a></li>
	<?php } ?>
	<li class="droite"><a href="javascript:clickNavigation('nous_contacter')">Infos pratiques</a></li>
</ul>
</div>
<!-- #navigation --></div>

<div id="centre">

<div id="principal"><?php include('visiteur/centre/accueil.php');?> </div>
<!-- #principal -->

<div class="ombre ombresecondaire">

<div id="secondaire">

<h3>Mon panier</h3>
<div id='banniere-resume_panier'><?php include('visiteur/droite/resume_panier.php'); ?>
</div>

<div><h4><a href="#" onclick='clickAbonnementNewsletter()'>S'abonner à la newsletter</a></h4></div>

<?php
$tmpres = bddNouveauxProduits();
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Zoom produits</h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		$categorie_produit_libelle = $row[1];
		$cond_nom = $row[2];
		$produit_libelle = $row[3];
		$categorie_produit_id = $row[4];
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<a href='javascript:clickSelectCatProduit($categorie_produit_id)'>"
		.$produit_libelle."</a>";
		echo "<br/>";
	}
	echo "</p>";	
}	
?>

<?php
$tmpres = bddNouveauxProduitsResa();
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Zoom produits sur réservation</h3><p>";
	while ($row = mysql_fetch_array($tmpres)){
		$categorie_produit_libelle = $row[1];
		$produit_resa_libelle = $row[2];
		$categorie_produit_id = $row[3];
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<a href='javascript:clickSelectCatProduit($categorie_produit_id)'>"
		.$produit_resa_libelle."</a>";
		echo "<br/>";
	}
	echo "</p>";	
}	
?>


<?php 
$tmpres = bddActusGaec(true, false);
if (mysql_num_rows($tmpres)>0) {
	echo "<h3>Actualités du GAEC</h3><p>";
	setlocale (LC_TIME, 'fr_FR','fra');
	$outputAffDatePost = "%A %d %B %Y";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
	echo "</p>";
}	
?>

<?php 
$tmpres = bddActusLoma(true, false);
if (mysql_num_rows($tmpres)>0) {	
	echo "<h3>Actualités locales et du monde agricole</h3><p>";
	setlocale (LC_TIME, 'fr_FR','fra');
	$outputAffDatePost = "%A %d %B %Y";
	while ($row = mysql_fetch_array($tmpres)){
		echo "<img src='img/flecheactu.gif'/> ";
		echo "<a href='javascript:clickActualite()'>$row[1]</a>";
		echo "<br/>";
	}
	echo "</p>";
}

$tmpres = bddDatesFermeture();
if (mysql_num_rows($tmpres)>0) {
	while ($row = mysql_fetch_array($tmpres)){
		if ($row[0]=='date_fermeture_min') {
			echo "<input type='hidden' id='dateMinFermeture' name='dateMinFermeture' value='$row[1]'/>";
		}
		else if ($row[0]=='date_fermeture_max') {		
			echo "<input type='hidden' id='dateMaxFermeture' name='dateMaxFermeture' value='$row[1]'/>";
		}
	}
}
	
?>

<h3>Horaires d'ouverture</h3>
<p style='color:black;'>Le vendredi<br>de 16h00 à 19h30<br>
Le samedi<br>de 10h à 12h30<br>
Fermé les jours fériés<br></p>

<h3>Agriculture biologique</h3>
<div style="text-align:center">
<img src="img/ab.gif" alt="ab" title="Agriculture biologique"
	border="0">
<img src="img/abeuro.gif" alt="abeuro" title="Agriculture biologique"
	border="0">
</div>

<?php include('visiteur/centre/partenaires.php'); ?>


</div>
<!-- #secondaire --></div>
<!-- ombre --></div>
<!-- #centre --></div>
<!-- #global -->

</body>
</html>
