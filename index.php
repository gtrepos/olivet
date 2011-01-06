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
<title>La ferme d'Olivet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv='language' content='fr'>
	<meta name='Description' content="La ferme d'Olivet - Site officiel - Servon, Olivet, Ferme, Bio, Actualités, Produits">
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
	<!-- google map API key : 
	http://fermeolivet.free.fr/ :	ABQIAAAASki4stJtJM6pFLg7NiCJSBSFNPR8qUy5LlztrteYkgDBd3SwJhT0xjOg_KyOByCOxNK7aYDpFTzPoQ
	http://gaecolivet.free.fr : ABQIAAAA0Pdh_8EET-n72xP7OCU9VRTFDZFcyfLWBobWIx1qDZjkNxE3HBTPI13wNF6BYVEaxM-0X9xjzs0Acg
	-->
	<script	src="http://maps.google.com/?file=api&amp;v=2.x&amp;key=ABQIAAAA0Pdh_8EET-n72xP7OCU9VRTFDZFcyfLWBobWIx1qDZjkNxE3HBTPI13wNF6BYVEaxM-0X9xjzs0Acg" type="text/javascript"></script>  
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/commun.js"></script>
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
	<li class="gauche"><a href="javascript:clickNavigation('commander')">Commander</a></li>
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

<?php include('visiteur/centre/partenaires.php'); ?>

<h3>Agriculture biologique</h3>
<div style="text-align:center">
<img src="img/ab.gif" alt="ab" title="Agriculture biologique"
	border="0">
<img src="img/abeuro.gif" alt="abeuro" title="Agriculture biologique"
	border="0">
</div>

<h3>Horaires d'ouverture</h3>
<p style='color:black;'>Du mardi au vendredi<br>de 16h30 à 19h30<br>
Le samedi<br>de 10h à 12h30<br>
Fermé dimanche, lundi et jours fériés<br></p>
</div>
<!-- #secondaire --></div>
<!-- ombre --></div>
<!-- #centre --></div>
<!-- #global -->

</body>
</html>
