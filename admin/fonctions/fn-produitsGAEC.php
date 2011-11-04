<?php
function affich_produitsGAEC()
{
  $requete="SELECT valeur from parametrage where parametre='produitsGAEC'";
  $resultats=mysql_query($requete) or die (mysql_error());
  $row = mysql_fetch_array($resultats);
  echo $row[0];
}

function enregistrer_produitsGAEC() {
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
	$requete="UPDATE parametrage set valeur = '" . $postedValue . "' where parametre='produitsGAEC'";
	$result=mysql_query($requete) or die (mysql_error());
}
?>
