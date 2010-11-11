<?php
function affich_accueil ()
{
  $requete="SELECT valeur from parametrage where parametre='accueil'";
  $resultats=mysql_query($requete) or die (mysql_error());
  $row = mysql_fetch_array($resultats);
  echo $row[0];
}

function enregistrer_accueil() {
	if ( isset( $_POST ) )
	$postArray = &$_POST ;			// 4.1.0 or later, use $_POST
	else
	$postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS
	$postedValue = null; 
	foreach ( $postArray as $sForm => $value )
	{
		if ( get_magic_quotes_gpc() )
			$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
		else
			$postedValue = htmlspecialchars( $value ) ;
		
	}
	$requete="UPDATE parametrage set valeur = '" . $postedValue . "' where parametre='accueil'";
	$result=mysql_query($requete) or die (mysql_error());
}
?>
