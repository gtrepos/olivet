<html>
	<head>
		<title>La ferme de l'Olivet</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
		<meta http-equiv='language' content='fr'>
		<meta name='Description' content='La ferme de l''Olivet - Site officiel - Servon, Olivet, Ferme, Bio, Actualités, Produits'>
		<meta name='Keywords' content='Servon, Olivet, Site officiel, Ferme, Bio, Actualités, Produits'>
		<meta name='robots' content='index,follow'>
		<meta name='author' content='Ferme de l''Olivet'>
		<meta name='revisit-after' content='7 days'>
		<meta name="rating" content="general" />
		<link href="http://gaeca4voies.free.fr/favicon.ico" rel="SHORTCUT ICON" />
		<link href="css/style.css" type="text/css" rel="stylesheet"> 
		<script src="js/global_load.js" type="text/javascript"></script>
	</head>
	<!--body leftmargin="0" topmargin="0" background="gimp_img/fond2.jpg" onload="loadGoogleMap()" onunload="GUnload()" onResize="location.reload();"-->
	<body leftmargin="0" topmargin="0" background="gimp_img/fond2.jpg">		
		<div>
		<?php 
		
		require_once("tools/config.php") ;
		ouverture();
		require_once("tools/visitor_bdd_functions.php") ;
		require_once('tools/visitor_panier_functions.php');
		session_start();
		
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 'accueil';
		}
		include('visitor/gauche.php');
		include('visitor/banniere.php');
		include('visitor/entete.php');
		include('visitor/centre.php');
		include('visitor/bas.php');
	
		?>
		</div>
	</body>
</html>
