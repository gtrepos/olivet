<?php 
function supprimerArticle($libelleProduit){

if (creationPanier())
{
  $tmp=array();
  $tmp['libelleProduit'] = array();
  $tmp['qteProduit'] = array();      
  $tmp['prixProduit'] = array();
      
  for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) 
  {
   if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
   {
    array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
    array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]); 
    array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
   }
      
  }
      
   
$_SESSION['panier'] =  $tmp;
unset($tmp);      
       
}
else
  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


function modifierQTeArticle($libelleProduit,$qteProduit){
if (creationPanier())
{

  if ($qteProduit > 0)
  {
   $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
            
   if ($positionProduit !== false)
   {
    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
   }
  }
  else
   supprimerArticle($libelleProduit);
      
}
else
  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}
function MontantGlobal(){

$total=0;

  for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) 
  {            
   $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i]; 
  }
      
return $total;
}

?>