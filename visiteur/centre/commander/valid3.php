

<?php
if (isset($_POST['nom'])){
	$nom = $_POST['nom'];
	if($nom==""){
		echo "<br> Pas de nom donné (1) !!  <br>";	
	}else{
		echo "<br> NOM FOURNI = $nom <br>";
	}
}else{
	echo "<br> Pas de nom donné (2) !!  <br>";
}


$to      = 'ronan.trepos@neuf.fr';
$subject = 'le sujet';
$message = 'Bonjour !';
$headers = 'From: rtrepos@gmail.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

//mail($to, $subject, $message, $headers);
 //Config mail
// C:\Program Files\EasyPHP 3.0\conf_files\php.ini
     
//
//include('Mail.php');
//
//$recipients = 'rtrepos@gmail.com';
//
//$headers['From']    = 'rtrepos@gmail.com';
//$headers['To']      = 'rtrepos@gmail.com';
//$headers['Subject'] = 'Test message';
//
//$body = 'Test message';
//
//$params['sendmail_path'] = '/usr/lib/sendmail';
//
//// Create the mail object using the Mail::factory method
//$mail_object =& Mail::factory('sendmail', $params);
//
//$ret = $mail_object->send($recipients, $headers, $body);
//
//if (PEAR::isError($ret)) { print($ret->getMessage());} 
//echo "$ret";
//echo "CHIOTTE";


//phpinfo();

//$to = "rtrepos@gmail.com";
//$subject = "czeczec!";
//$body = "Hi,\n\nHow are you?";
//
//ini_set('sendmail_from', 'ronan.trepos@toulouse.inra.fr');
//
//if (mail($to, $subject, $body)) {
//  echo("<p>Message successfully sent!</p>");
// } else {
//  echo("<p>Message delivery failed...</p>");
// }


////
//$Name = "Da Duder"; //senders name
//$email = "ronan.trepos@toulouse.inra.fr"; //senders e-mail adress
//$recipient = "ronan.trepos@toulouse.inra.fr"; //recipient
//$mail_body = "The text for the mail..."; //mail body
//$subject = "Subject for reviever"; //subject
//$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
//
//ini_set('sendmail_from', 'rtrepos@gmail.com'); //Suggested by "Some Guy"
//
//if (mail($recipient, $subject, $mail_body, $header)) {
//  echo("<p>Message successfully sent!</p>");
// } else {
//  echo("<p>Message delivery failed...</p>");
// }


////
//$ret_mail = mail("rtrepos@gmail.com"  , "subject 2"  , "coucou");
//echo "$ret_mail";
//bool mail( string $to  , string $subject  , string $message  [, string $additional_headers  [, string $additional_parameters  ]] )

?>



<div style="font-family: arial, sans-serif; font-size: 12pt;">
Bonjour Mr Robert Dupont, <br>
ceci est votre première commande, un mail vous a été envoyé
avec une référence client pour les commandes suivantes. <br>
</div>

<table border="1" align=center style="border-collapse: separate;  empty-cells: show;">
<tr>
	<td colspan="6" align=center>Récapitulatif commande</td>
</tr>
<tr>
	<td>Catégorie Produit</td>
	<td>Nom Produit</td>
	<td> Quantité</td>
	<td>Prix unitaire TTC</td>
	<td>Unité</td>
	<td>Prix total TTC</td>
</tr>
<tr>
	<td>Lait</td>
	<td>Crême fraîche</td>
	<td>1Kg</td>
	<td>pas cher</td>
	<td>35</td>
	<td>pas cher</td>
</tr>
<tr>
	<td>TOTAL Commande</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>

	<div align=center style="font-size: 15pt;">
		<a href="index.php" style="font-family: arial, sans-serif; font-size: 15pt;">
		Merci pour l'achat, retour à l'index'
		</a>
	</div>
	
	

                         

