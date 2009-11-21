<?
require ("../tools/config.php");;
ouverture();
$expire = 365*24*3600; 
setcookie("user","",time()-$expire,"/","");
setcookie("mot_de_passe","",time()-$expire,"/","");
include ("deconnexion.htm");
?>
<META HTTP-EQUIV="refresh"; CONTENT="0; URL=index.php">

