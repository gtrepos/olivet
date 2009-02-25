<div id="centerpageID">		
<?php
if (isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = 'accueil';
switch ($page) {
	case 'accueil' :
		include('centerpage_welcome.php');
		break;
	case 'ferme' :
		include('centerpage_farm.php');
		break;
	case 'produits' :
		include('centerpage_products.php');
		break;
	case 'commander' :
		include('centerpage_commands.php');
		break;							
	case 'contacts' :
		include('centerpage_contacts.php');
		break;
	break;
}
?>
</div>
