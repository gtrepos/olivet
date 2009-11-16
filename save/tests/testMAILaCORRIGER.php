<html>
	<head>
		<title>La ferme de l'Olivet</title>
		<!-- <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'> -->
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
		<meta http-equiv='language' content='fr'>
		<meta name='Description' content='La ferme de l''Olivet - Site officiel - Servon, Olivet, Ferme, Bio, Actualités, Produits'>
		<meta name='Keywords' content='Servon, Olivet, Site officiel, Ferme, Bio, Actualités, Produits'>
		<meta name='robots' content='index,follow'>
		<meta name='author' content='Ferme de l''Olivet'>
		<meta name='revisit-after' content='7 days'>
		<meta name="rating" content="general" />
		<link href="http://gaeca4voies.free.fr/favicon.ico" rel="SHORTCUT ICON" />
		<link href="css/style.css" type="text/css" rel="stylesheet"> 
		<!--  <script src="js/global_load.js" type="text/javascript"></script>  -->
	</head>
	<body leftmargin="0" topmargin="0" background="gimp_img/fond2.jpg" onload="loadGoogleMap()" onunload="GUnload()" onResize="location.reload();">		
		<div> 
		Fichier à mettre sur Free.fr et a renommer index.php.
		Crée un fichier tmp/facture.pdf et pourrait l'envoyer à rtrepos@gmail.com.
		
		<?php
		//PDF generation
		require('FactureGaecPDF.php');
		GenererUneFacture();
		
//		//MAIL
//		require_once 'Swift-4.0.4/lib/swift_required.php';
//		//Create a message
//		$message = Swift_Message::newInstance('Wonderful Subject')
//		->setFrom(array('john@doe.com' => 'John Doe'))
//		->setTo(array('rtrepos@gmail.com'))
//		->setBody('Here is the message itself')
//		;
//		//Create the attachment
//		$message->attach(Swift_Attachment::fromPath('tmp/facture.pdf'));
//		//Create the Transport
//		$transport = Swift_MailTransport::newInstance();
//		//Create the Mailer using your created Transport
//		$mailer = Swift_Mailer::newInstance($transport);
//		//Send the message
//		$result = $mailer->send($message);
//		//remove tmp
//		unlink('tmp/tmpSWIFT');
		?>
		</div>
	</body>
</html>