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
<title>GAEC à 3 voix, la ferme d'Olivet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv='language' content='fr'>
	<meta name='Description' content='La ferme d''Olivet - Siteofficiel - Servon, Olivet, Ferme, Bio, Actualités, Produits'>
	<meta name='Keywords' content='Servon, Olivet, Site officiel, Ferme, Bio, Actualités, Produits'>
	<meta name='robots' content='index,follow'>
	<meta name='author' content='Ferme d''Olivet'>
	<meta name='revisit-after' content='7 days'>
	<meta name="rating" content="general" />
	<link href="http://fermeolivet.free.fr/favicon.ico" rel="SHORTCUT ICON" />
	<!-- La feuille de styles "base.css" doit etre appelle en premier. -->
	<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
	<link rel="stylesheet" type="text/css" href="styles/modele08.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/infobulle.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/myinfobulle.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/partenaires.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/recapitulatif.css" media="screen">	
	<!-- google map API key : pour uniquement (?): http://www.fermeolivet.net/
	ABQIAAAA0Pdh_8EET-n72xP7OCU9VRQMBzOkXylWza1-3on8o8mwezh4PRTp2Xq8TqJZmdjX43w2K_JJ0BFd6w
	pour http://gaecolivet.free.fr
	ABQIAAAA0Pdh_8EET-n72xP7OCU9VRTFDZFcyfLWBobWIx1qDZjkNxE3HBTPI13wNF6BYVEaxM-0X9xjzs0Acg
	-->
	<script	src=" http://maps.google.com/?file=api&amp;v=2.x&amp;key=ABQIAAAAW9GyMK3xmJic7HkkJ6_FKhRgqac2kDoat0qdh_Gp70xojZjKPBS0aYcbexH1s9cAbRM8T_PeZX9xrg" type="text/javascript"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/menuderoulant.js"></script>
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
	<li class="gauche"><a href="javascript:clickNavigation('nos_produits')">Nos	Produits</a></li>
	<li class="gauche"><a href="javascript:clickNavigation('commander')">Commander</a></li>
	<li class="gauche"><a href="javascript:clickNavigation('actualites')">Actualités</a></li>
	<li class="droite"><a href="javascript:clickNavigation('nous_contacter')">Nous contacter</a></li>
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
<h3>Partenaires</h3>

<?php include('visiteur/centre/partenaires.php'); ?>

<h3>Agriculture biologique</h3>
<img src="img/ab2.gif" alt="ab" title="Agriculture biologique"
	border="0">


<p id="copyright"><a href="http://www.elephorm.com">Elephorm</a> et <a
	href="http://www.alsacreations.com">Alsacréations</a></p>
</div>
<!-- #secondaire --></div>
<!-- ombre --></div>
<!-- #centre --></div>
<!-- #global -->

</body>
</html>
