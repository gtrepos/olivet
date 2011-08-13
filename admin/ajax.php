<?php

require_once("../tools/config.php");
ouverture();

$ajax_event = "$_POST[event]";

switch($ajax_event){
	
	case 'updateNouveauteConditionnement' :
  		$idcond = "$_POST[idcond]";
  		$nouveaute = "$_POST[nouveaute]";
  		updateNouveauteConditionnement($idcond,$nouveaute);
  		
  		
  		
		break;
}

function updateNouveauteConditionnement($idcond,$nouveaute){
	$requete=$requete = "UPDATE conditionnement SET cond_nouveaute = $nouveaute WHERE cond_id = '$idcond'";
	$resultats=mysql_query($requete) or die (mysql_error());
}

?>


