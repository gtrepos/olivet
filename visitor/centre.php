<div id="centreID">
<?php

switch ($page) {
	case 'accueil' :
		include('centre/accueil.php');
		break;
	case 'ferme' :
		include('centre/ferme.php');
		break;
	case 'produits' :
		include('centre/produits.php');
		break;
	case 'commander' :
		include('centre/commander.php');
		break;
	case 'contacts' :
		include('centre/contacts.php');
		break;
		break;
}
?>
</div>
