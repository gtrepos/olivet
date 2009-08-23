<?php
$ajax_req = "none";
foreach ($_POST as $key => $value) {
	if($key == "ajax_req"){
		require_once("visitor_panier_functions.php");
		require_once("visitor_bdd_functions.php");
		require_once("config.php");
		ouverture();
		session_start();
		$ajax_req = $value;
	}else if($key == "nbarticles"){
		$nbarticles = $_POST["nbarticles"];
	}else if($key == "idproduit"){
		$idproduit = $_POST["idproduit"];	
	}    
}
if($ajax_req == 'setNbArticles'){
	panierSetNbArticles($idproduit,$nbarticles);
}else if($ajax_req == 'panierVider'){
	panierVider();
}
?>