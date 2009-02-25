<table align=center cellspacing=0 cellpadding=0 border=0 width='98%'>
  <tr>
  <td colspan=2 valign=top align=center>
  	<div align=left class="centerpage_contents_conditions"> 
  		<div align=center class="centerpage_contents_conditions_title"> 
  		CONDITIONS DE VENTE 
  		</div>
  		<div align=left class="centerpage_contents_conditions_subtitle"> 
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
if (isset($_GET['page_comm']))
	$page = $_GET['page_comm'];
else
	$page = 'viande';
switch ($page) {
	case 'viande' :
		include('commands_menu.php');
		include('commands_viande.php');
		echo '<a href="index.php?page=commander&page_comm=valid1"> >> Valider la commande</a>';
		break;
	case 'lait' :
		include('commands_menu.php');
		include('commands_lait.php');
		echo '<a href="index.php?page=commander&page_comm=valid1"> >> Valider la commande</a>';
		break;
	case 'fruit' :
		include('commands_menu.php');
		include('commands_fruits.php');
		echo '<a href="index.php?page=commander&page_comm=valid1"> >> Valider la commande</a>';
		break;
	case 'autre' :
		include('commands_menu.php');
		include('commands_autre.php');
		echo '<a href="index.php?page=commander&page_comm=valid1"> >> Valider la commande</a>';
		break;
	case 'valid1' :
		include('commands_valid1.php');
		break;
	case 'valid2' :
		include('commands_valid2.php');
		break;	
	case 'valid3' :
		include('commands_valid3.php');
		break;							
	break;
}
?>
