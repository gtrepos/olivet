<?php
function ouverture()
{
	include("data_connect.php");
	if(($idconnect = @mysql_connect($hostname, $login, $password)) == false)
	{
		$error = "Impossible de creer une connexion persistante !";
		return(0);
	}
	if(@mysql_select_db($database, $idconnect) == false)
	{
		$error = "Impossible de selectionner la base !";
		return(0);
	}
	return($idconnect);
}

include("transaction.php");
include("data_connect.php");
include("lang_fr.php");



?>
