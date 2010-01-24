<?php

function envoiMailRecapCommande($nouveauClient){
	//MAIL
	require_once ("../Swift-4.0.4/lib/swift_required.php");
	//Create a message
	$message = Swift_Message::newInstance('Wonderful Subject');
	$message->setFrom(array('john@doe.com' => 'John Doe'));
	$message->setTo(array('rtrepos@gmail.com'));
	$message->setBody('Here is the message itself');
	;
	//Create the attachment
	//$message->attach(Swift_Attachment::fromPath('tmp/facture.pdf'));
	//Create the Transport
	$transport = Swift_MailTransport::newInstance();
	//Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);
	//Send the message
	$result = $mailer->send($message);
	//remove tmp
	unlink('tmp/tmpSWIFT');
}


?>