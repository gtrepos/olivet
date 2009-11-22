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
	<!--  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />  -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8" />
	<meta http-equiv='language' content='fr'>
	<meta name='Description' content='La ferme d''Olivet - Site officiel - Servon, Olivet, Ferme, Bio, Actualit�s, Produits'>
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
	<script type="text/javascript" src="js/prototype.js" ></script>
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/menuderoulant.js"></script>
</head>

<body>

<div id="global">

	<div id="entete">
		<h1>
		<img  src="img/logoexploit.gif" alt="logoexploit" title="logoexploit" border="0" width='110' height='70'>
			<span>"GAEC à 3 voix" ferme d'Olivet</span>
		</h1>
		<p class="sous-titre">
			<strong>Vous nourrir mais pas seulement...</strong>
			agriculture biologique,
			lutte anti Mal bouffe
		</p>
	</div><!-- #entete -->

	<div id="navigation">
		<ul>
			<li class="gauche"><a href="index.php">Accueil</a></li>
			<li class="gauche"><a href="index.php?page=ferme">La Ferme</a></li>
			<li class="gauche"><a href="index.php?page=produits_dispo">Nos produits</a></li>
			<li class="gauche"><a href="index.php?page=commande">Commander</a></li>
			<li class="droite"><a href="index.php?page=contact">Nous contacter</a></li>
		</ul>
	</div><!-- #navigation -->

	<div id="centre">

		<div id="principal">
		
		
				<?php
					if (isset($_GET['page']))
						$page = $_GET['page'];
	 				else
					 	$page = 'actu';
					switch ($page) {
							case 'actu' :
								include('visiteur/centre/accueil.php');
								break;
							case 'produits_dispo' :
								echo "<div id=produits_dispo>";
								include('visiteur/centre/produits_dispo.php');
								echo "</div>";
								break;
							case 'ferme' :
								include('visiteur/centre/ferme.php');
								break;	
							case 'commande' :
								include('visiteur/centre/commander.php');
								break;	
							case 'contact' :
								include('visiteur/centre/contacts.php');
								break;	
	   						default :
	   						    include('visiteur/centre/accueil.php');
	   						    break;
						}
				?>
			
		</div><!-- #principal -->

		<div id="secondaire">
			
			<h3>Mon panier</h3>
			<?php include('visiteur/banniere/resume_panier.php'); ?>
			
			<h3>Partenaires</h3>
			
			<ul class="menu_deroulant1"> 
			    <li class="toggleSubMenu1"><span>Accueil paysan</span> 
			        <ul class="subMenu1"> 
			            <li>
			            <a href="#" title="Aller à la page 1">
			            	<img src='img/accueilpaysan.gif'  width='100' height='100' border=0>
			            </a>
			            </li>
			        </ul> 
			    </li> 
			    <li class="toggleSubMenu1"><span>Partenaire 2</span> 
			        <ul class="subMenu1"> 
			            <li><a href="#" title="Aller à la page 2">Partenaire 2</a></li> 
			        </ul> 
			    </li> 
			    <li class="toggleSubMenu1"><span>Partenaire 3</span> 
			        <ul class="subMenu1"> 
			            <li><a href="#" title="Aller à la page 3">Partenaire 3</a></li> 
			        </ul> 
			    </li> 
			</ul>
			
			<h3>Quoi de neuf à l'Olivet ?</h3>
			<ul>		
				<li>Commandes spéciales</li>
				<li>Evénements</li>
				<li>Fermeture du magasin</li>
			</ul>		
			
			<h3>Agriculture biologique</h3>
			<img src="img/ab2.gif" alt="ab" title="Agriculture biologique" border="0" >
			
			<p id="copyright">
				<a href="http://www.elephorm.com">Elephorm</a> et
				<a href="http://www.alsacreations.com">Alsacr�ations</a>
			</p>
		</div><!-- #secondaire -->

	</div><!-- #centre -->

</div><!-- #global -->

</body>
</html>
