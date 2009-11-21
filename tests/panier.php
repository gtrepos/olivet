<?php
if ( session_id() == '' ) { // no session has been started yet, which is needed for validation
      //session_start();
}
include_once("fonctions-panier.php");

echo '<?xml version="1.0" encoding="iso-8859-1"?>';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr"> 
<head>
<title>Votre panier</title>
</head>
<body>

<form method="post" action="panier.php">
<table style="width: 400px">
<tr>
      <td colspan="4">Votre panier</td >
</tr>
<tr>
      <td>Libellé</td>
      <td>Quantité</td>
      <td>Prix Unitaire</td>
      <td>Action</td>
</tr>


<?php
if (creationPanier())
{
$nbArticles=count($_SESSION['panier']['libelleProduit']);
  if ($nbArticles <= 0)
   echo "<tr><td>Votre panier est vide </ td></tr>";
  else
  {
   for ($i=0 ;$i < $nbArticles ; $i++)
   {
    echo "<tr>";
    echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
    echo "<td><input type=\"text\" size=\"4\" name=\"QteArticle[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
    echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
    echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
    echo "</tr>";
   }
            
  echo "<tr><td colspan=\"2\"> </td>";
  echo "<td colspan=\"2\">";
  echo "Total : ".MontantGlobal();
  echo "</td></tr>";
            
  echo "<tr><td colspan=\"4\">";
  echo "<input type=\"submit\" value=\"Rafraichir\"/>";
  echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
  echo "</td></tr>";
  }
}
?>
</table>
</form>
</body>
</html>
