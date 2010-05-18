<html>
<head>
	<meta http-equiv="Content-Language" content="fr">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="css/dhtmlgoodies_calendar.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="./javascript/commun.js"></script>
	<script type="text/javascript" src="./javascript/client.js"></script>
	<script type="text/javascript" src="./javascript/actualite.js"></script>
	<script type="text/javascript" src="./javascript/categorie.js"></script>
	<script type="text/javascript" src="./javascript/produit.js"></script>
	<script type="text/javascript" src="./javascript/produitResa.js"></script>
	<script type="text/javascript" src="./javascript/partenaire.js"></script>
	<script type="text/javascript" src="./javascript/producteur.js"></script>
	<script type="text/javascript" src="./javascript/commande.js"></script>
	<script type="text/javascript" src="./javascript/conditionnement.js"></script>
	<script type="text/javascript" src="../js/prototype.js"></script>
	<script type="text/javascript" src="./javascript/dhtmlgoodies_calendar.js"></script>
	<script type="text/javascript" src="./javascript/AnchorPosition.js"></script>
	<script type="text/javascript" src="./javascript/PopupWindow.js"></script>
	<script type="text/javascript" src="./javascript/overlib.js"></script>
</head>

<body topmargin="0" leftmargin="0" class="olivet">
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<?php
require ("../tools/config.php") ;
require ("fonctions/fn-commun.php"); 
require ("fonctions/fn-commande.php");
require ("fonctions/fn-client.php");
require ("fonctions/fn-actualite.php");
require ("fonctions/fn-categorie_produit.php");
require ("fonctions/fn-produit.php");
require ("fonctions/fn-conditionnement.php");
require ("fonctions/fn-partenaire.php");
require ("fonctions/fn-produit-resa.php");
require ("fonctions/fn-producteur.php");
?>

<div align="center">
  		
  <center>
  <table cellspacing="0" width="100%" height="100%" cellpadding="0">
    <tr>
      <td colspan="1" align="center" height="100"  bgcolor="#C0C0C0"></td>
      <td colspan="1" valign="middle" align="center" style="border-bottom-style: dashed;border-bottom-width : 1px; border-color:#3b487f"><font class="olivet">Administration</font></td>
    </tr>
    <tr>
      <td class="olivet" width="17%" valign="top" style="border-right-style: dashed;border-right-width : 1px; border-color:#3b487f">
      	<div><?php ouverture ();?></div>
      	<a href="?page=commandes">Commandes</a> | <a href="?page=commandes&action=creer"><?php echo ADMIN_COMMANDE_CREER;?></a><br><br>
      	<a href="?page=clients">Clients</a> | <a href="?page=clients&action=creer"><?php echo ADMIN_CLIENT_CREER;?></a><br><br>
      	<a href="?page=actualites">Actualités</a> | <a href="?page=actualites&action=creer"><?php echo ADMIN_ACTUALITE_CREER;?></a><br><br>
      	<a href="?page=categories">Catégories de produits</a><br><br>
      	<a href="?page=produits">Liste des produits</a><br><br>
      	<a href="?page=conditionnements">Liste des conditionnements</a><br><br>
      	<a href="?page=produitsresa">Liste des produits à la réservation</a><br><br>
      	<a href="?page=partenaires">Partenaires</a><br><br>
      	<a href="?page=producteurs">Producteurs</a><br><br>
      </td>
      <td valign="top" colspan="2"><div align="center">

     <?php
     
     if (isset($_GET['page'])){$page=$_GET['page'];}
     else {$page="commandes";}

	 if ($page=="clients") {include ("client/clients.php");}
	 if ($page=="commandes") {include ("commande/commandes.php");}
     if ($page=="actualites") {include ("actualite/actualites.php");}
     if ($page=="categories") {include ("categorie_produit/categories.php");}
     if ($page=="produits") {include ("produit/produits.php");}
     if ($page=="conditionnements") {include ("conditionnement/conditionnements.php");}
     if ($page=="produitsresa") {include ("produit/produits_resa.php");}
     if ($page=="partenaires") {include ("partenaire/partenaires.php");}
     if ($page=="producteurs") {include ("producteur/producteurs.php");}
     
     ?>
      </div></td>
      <td  width="1%" style="border-left-style: dashed;border-left-width : 1px; border-color:#3b487f">&nbsp;</td>
    </tr>
    <tr>
    <td bgcolor="C0C0C0"></td>
      <td width="100%" colspan="2" height="10" style="border-top-style: dashed;border-top-width : 1px; border-color:#3b487f">&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td class="olivet" colspan="3" width="70%" height="10" colspan="2" align="right"><br>
        </td>
    </tr>
  </table>
  </center>
</div>

</body>

</html>
