<div>Commander nos Produits</div>

<table align=center cellspacing=0 cellpadding=0 border=0 width='98%'>
  <tr>
  <td colspan=2 valign=top align=center>
  	<div align=left class="conditions"> 
  		<div align=center class="conditions_titre"> 
  		CONDITIONS DE VENTE 
  		</div>
  		<div align=left class="conditions_sous_titre"> 
  		Pour les commandes :
  		</div>
  		<div>
  			Merci de passer vos commandes avant le mardi soir et de venir les chercher
  		 	sur l'exploitation à partir du vendredi midi jusqu'au samedi midi.
  			Merci pour votre compréhension.
  		</div>
  	</div>
  </td>
  </tr>
</table>

<?php
if (isset($_GET['page_comm'])){
	$page_comm = $_GET['page_comm'];
}else{
	$page_comm = '3';
}
switch($page_comm){
	case 'valid1' :
		include('commander/valid1.php');
		break;
	case 'valid2' :
		include('commander/valid2.php');
		break;
	case 'valid3' :
		include('commander/valid3.php');
		break;
	default:
		include('commander/selection_produits.php');
		break;
}
?>
