<html>
<head>
	<meta http-equiv="Content-Language" content="fr">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="css/dhtmlgoodies_calendar.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="./javascript/commun.js"></script>
	<script type="text/javascript" src="./javascript/client.js"></script>
	<script type="text/javascript" src="./javascript/actualite.js"></script>
	<script type="text/javascript" src="./javascript/categorie.js"></script>
	<script type="text/javascript" src="./javascript/produit.js"></script>
	<script type="text/javascript" src="./javascript/partenaire.js"></script>
	<script type="text/javascript" src="./javascript/commande.js"></script>
	<script type="text/javascript" src="../js/prototype.js"></script>
	<script type="text/javascript" src="./javascript/dhtmlgoodies_calendar.js"></script>
</head>

<body topmargin="0" leftmargin="0" class="olivet">

<?php
require ("../tools/config.php") ;
require ("fonctions.php");
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
      	<a href="?page=partenaires">Partenaires</a><br><br>
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
     if ($page=="partenaires") {include ("partenaire/partenaires.php");}
     
     elseif ($page=="accueil") {include ("accueil.htm");}
     else {include ("accueil.htm");}
       
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
