<?php
require('../FPDF/fpdf.php');

class CommandeGaecPDF extends FPDF
{
	
	//En-tête
	function Header()
	{
		
		$hauteur = 25;
		$dec_gauche_coord = 60;
		//Logo
		$this->Image('../img/logo.gif',10,10,0,$hauteur);
		//Police Arial gras 15
		$this->SetFont('Arial','B',12);
		//Décalage à droite
		$this->Cell(50,$hauteur,'',0,0,'L',false);
		//Titre
		//$this->MultiCell(30,$hauteur,'Titre\ncoucou',0,0,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,utf8_decode("Gaec à 3 voix"),0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"L'Olivet",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"35530 SERVON-SUR-VILAINE",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Tel : 06 62 09 27 62",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Mail : fermeolivet@free.fr",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Site web : http://fermeolivet.free.fr",0,0,'L',false);
		$this->Ln(15);//espace vertical
	}
	function BanniereFacture()
	{
		$this->SetFont('Arial','B',25);
		$this->Cell(0,10,'COMMANDE',0,0,'C',false);
		$this->Ln(15);//espace vertical
	}
	function TableClient($id_commande, $email)
	{
		$larg_colonne = 95;
		$haut_line = 16;
		//Police Arial gras 15
		$this->SetFont('Arial','',10);

		//$tmpres = bddClientInfoFromCommande($id_commande);
		$tmpres = bddClientInfoFromEmail($email);
		while ($row = mysql_fetch_array($tmpres)){
			$client_reference = $row[0];
			$client_nom = $row[1]; 
			$client_prenom = $row[2];
			$client_adresse = $row[3]; 
			$client_code_postal = $row[4];
			$client_commune = $row[5];
			$client_email = $row[6];
			$client_code = $row[6];
		}
		
		setlocale (LC_TIME, 'fr_FR','fra');
		
		$ladate = strftime("%A %d %B %Y");
		
		$this->Cell($larg_colonne,$haut_line,"Servon-Sur-Vilaine",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line,utf8_decode(
			"Référence Client : $client_reference" ),1,1,'L',false);
		$this->Cell($larg_colonne,$haut_line,"le $ladate",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,utf8_decode(
			"$client_nom $client_prenom"),'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,utf8_decode(
			"$client_adresse"),'LR',1,'L',false);
		$this->Cell($larg_colonne,$haut_line,utf8_decode(
			"Commande N° $id_commande"),1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,utf8_decode(
			"$client_code_postal $client_commune"),'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"",'LRB',1,'L',false);
		$this->Ln(15);//espace vertical
		
	}
	function DetailCommandeConds($idCommande)
	{
		$produitsCond = bddCommandeProdsConds($idCommande);
		$nbProduitsCond = mysql_num_rows($produitsCond);
		if ($nbProduitsCond>0) {
			$larg_page = 190;
			$haut_line = 8;
			$larg_col=array(
			10*$larg_page/20,
			5*$larg_page/20,
			2*$larg_page/20,
			3*$larg_page/20);
			
			//Police Arial gras 15
			$this->SetFont('Arial','',10);
			//Headers
			$this->Cell($larg_page,$haut_line,utf8_decode("Produits commandés"),1,2,'C',false);
			$this->Cell($larg_col[0],$haut_line,utf8_decode("Produits"),1,0,'C',false);
			$this->Cell($larg_col[1],$haut_line,utf8_decode("Prix unitaire"),1,0,'C',false);
			$this->Cell($larg_col[2],$haut_line,utf8_decode("Quantité"),1,0,'C',false);
			$this->Cell($larg_col[3],$haut_line,utf8_decode("Prix"),1,1,'C',false);
			//Commandes conditionnements
			$prixTotalToutCond = 0;
			
			while ($row = mysql_fetch_array($produitsCond)){
				$produit_libelle = $row[0];
				$cond_nom = $row[1];
				$cond_prix = $row[2];
				$cond_remise = $row[3];
				$lcc_quantite = $row[4];
				$prixUnitaireCond = number_format($cond_prix - $cond_remise, 2, '.', '');
				$prixTotalCond = number_format($lcc_quantite * $prixUnitaireCond, 2, '.', '');
				$prixTotalToutCond += $prixTotalCond; 
				$this->Cell($larg_col[0],$haut_line,
					utf8_decode("$produit_libelle"),'LTR',1,'C',false);
				$this->Cell($larg_col[0],$haut_line,
					utf8_decode("$cond_nom"),'LBR',0,'C',false);
				$this->SetXY($this->GetX(),$this->GetY()-$haut_line);
				$this->Cell($larg_col[1],2*$haut_line,
					utf8_decode("$prixUnitaireCond". ' ' . chr(128)),1,0,'C',false);
				$this->Cell($larg_col[2],2*$haut_line,
					utf8_decode("$lcc_quantite "),1,0,'C',false);
				$this->Cell($larg_col[3],2*$haut_line,
					utf8_decode("$prixTotalCond ". ' ' . chr(128)),1,1,'C',false);		
			}
			$this->Cell(($larg_col[0]+$larg_col[1]+$larg_col[2]),$haut_line,
					utf8_decode("Prix total"),1,0,'C',false);
				
			$euroSymb = chr(128);
			$this->Cell($larg_col[3],$haut_line,
					utf8_decode(number_format($prixTotalToutCond, 2, '.', '')." $euroSymb"),1,1,'C',false);
			
			$this->Ln(15);//espace vertical
			
			$tmpres = bddCommandeDateRecup($idCommande);
			while ($row = mysql_fetch_array($tmpres)){
				$commande_daterecuperation = $row[0];
			}
			if ($commande_daterecuperation!=null) {
				$this->Text($this->GetX(),$this->GetY(), 
					utf8_decode("Merci pour votre commande, nous vous attendons à la ferme d'Olivet le : "));
				$this->Ln(5);//espace vertical
				$outputAff = "%A %d %B %Y";
				$this->Text($this->GetX(),$this->GetY(), 
					strftime($outputAff,strtotime($commande_daterecuperation)));
				$this->Ln(15);//espace vertical
			}
			
			
		}
	}
	
	function DetailCommandeResa($idCommande)
	{
		$produitsResa = bddCommandeProdsResa($idCommande);
		$nbProduitsResa = mysql_num_rows($produitsResa);
		if ($nbProduitsResa>0) {
			$larg_page = 190;
			$haut_line = 10;
			$larg_col=array(
			7*$larg_page/20,
			11*$larg_page/20,
			2*$larg_page/20);
	
			//Police Arial gras 15
			$this->SetFont('Arial','',10);
			//Headers
			$this->Cell($larg_page,$haut_line,utf8_decode("Produits réservés"),1,2,'C',false);
			/*$this->Cell($larg_col[0]+$larg_col[1],$haut_line,utf8_decode("Libellé"),1,0,'C',false);*/
			/*$this->Cell($larg_col[1],$haut_line,utf8_decode("Description"),1,0,'C',false);*/
			
			$this->Cell($larg_col[0],$haut_line,utf8_decode("Libellé"),1,0,'C',false);
			$this->Cell($larg_col[1],$haut_line,utf8_decode("Dates de retrait *"),1,0,'C',false);
			$this->Cell($larg_col[2],$haut_line,utf8_decode("Quantité"),1,1,'C',false);
			//Commandes sur réservation
			while ($row = mysql_fetch_array($produitsResa)){
				$produit_resa_libelle= $row[0];
				$produit_resa_descriptif_production = $row[1];
				$lcpr_quantite = $row[2];
				$datesRetrait = "du ".dateUsFr($row[3])." au ".dateUsFr($row[4])." inclu";
				/*$this->Cell($larg_col[0]+$larg_col[1],$haut_line,
					utf8_decode("$produit_resa_libelle"),1,0,'C',false);*/
				/*$this->Cell($larg_col[1],$haut_line,
					utf8_decode("$produit_resa_descriptif_production"),1,0,'C',false);*/
					
				$this->Cell($larg_col[0],$haut_line,
					utf8_decode("$produit_resa_libelle"),1,0,'C',false);	
				$this->Cell($larg_col[1],$haut_line,
					utf8_decode("$datesRetrait"),1,0,'C',false);
				$this->Cell($larg_col[2],$haut_line,
					utf8_decode("$lcpr_quantite"),1,1,'C',false);
			}
			$this->Ln(15);//espace vertical
			$this->Ln(5);//espace vertical
			$this->Text($this->GetX(),$this->GetY(), 
				utf8_decode("* Attention : pour vos produits sur réservation, veuillez prendre note des dates de retrait en magasin."));
		}
	}
	
	//Pied de page
	function Footer()
	{
		//Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		$this->Cell(0,5,utf8_decode("GAEC à 3 voix - L'Olivet - 35530 SERVON SUR VILAINE"),0,2,'C');
		$this->Cell(0,5,"SIRET 492 503 438 00011",0,0,'C');
		//Numéro de page
		$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	
}

function genererUneCommande($idCommande, $email){
	
	$pdf=new CommandeGaecPDF();
	
	$pdf->AliasNbPages();
	//construction page
	$pdf->AddPage();
	$pdf->BanniereFacture();
	$pdf->TableClient($idCommande, $email);
	$pdf->DetailCommandeConds($idCommande);
	$pdf->DetailCommandeResa($idCommande);
	$filename = '../tmp/recap'.$idCommande.'.pdf';
	$pdf->Output($filename,'F');
	return $filename;
}
function envoyerMail($nouveauClient, $email, $idCommande, $pdfFilename  ){
	require_once ("../Swift-4.0.4/lib/swift_required.php");
	
	$client_reference = "";
	$client_nom = "";
	$client_prenom = "";
	$client_adresse = "";
	$client_code_postal = "";
	$client_commune = "";
	$client_email = "";
	$client_code = "";
	
	//$tmpres = bddClientInfoFromCommande($idCommande);
	
	$tmpres = bddClientInfoFromEmail($email);
	
	while ($row = mysql_fetch_array($tmpres)){
		$client_reference = $row[0];
		$client_nom = $row[1];
		$client_prenom = $row[2];
		$client_adresse = $row[3];
		$client_code_postal = $row[4];
		$client_commune = $row[5];
		$client_email = $row[6];
		$client_code = $row[7];
	}
	$tmpres = bddCommandeDateRecup($idCommande);
	while ($row = mysql_fetch_array($tmpres)){
		$commande_daterecuperation = $row[0];
	}
		
	
	$message_body = "Bonjour ".$client_prenom. " ".$client_nom.",\n\n";
	if($nouveauClient == true){
		$message_body .= " Nous vous confirmons votre première commande à la Ferme d'Olivet. \n";
		$message_body .= " Vous pourrez désormais vous identifier avec les identifiants : \n";
	}else{
		$message_body .= " Nous vous confirmons votre nouvelle commande à la ferme d'olivet. \n";
		$message_body .= " Pour rappel vous pouvez vous identifer avec les identifiants : \n";
	}
	$message_body .= "     Email : ".$client_email." \n";
	$message_body .= "     Mot de passe : ".$client_code." \n\n";
	
	$message_body .= "Au nom de la ferme d'Olivet, merci pour votre commande.\n";
	$outputAff = "%A %d %B %Y";
	
	//dans le cas d'une commande ne contenant que des produits sur réservation, la date de récupération peut être null
	if ($commande_daterecuperation!=null) {
		$message_body .= "Nous vous y attendons le ".
			strftime($outputAff,strtotime($commande_daterecuperation))."\n\n";
	}
		
	$message_body .= " A bientôt, \n";
	$message_body .= "La ferme d'Olivet";
	
	
	//MAIL
	
	//Create a message
	$message = Swift_Message::newInstance('Récapitulatif commande '.$idCommande);
	$message->setFrom(array('fermeolivet@free.fr' => 'Ferme d\'Olivet'));
	//$message->setTo(array('rtrepos@gmail.com', 'ronan.trepos@neuf.fr' => 'Ferme d\'Olivet'));//TODO
	$message->setTo(array($client_email));//TODO
	$message->setBcc(array('fermeolivet@free.fr', 'gwenael.trepos@gmail.com'));
//	$message->setContentType("text/html");
	$message->setBody($message_body);
	
	//Create the attachment
	$message->attach(Swift_Attachment::fromPath($pdfFilename));
	//Create the Transport
	$transport = Swift_MailTransport::newInstance();
	//Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);
	//Send the message
	$result = $mailer->send($message);
	//remove tmp
	if(file_exists('tmpSWIFT')){
		unlink('tmpSWIFT');
	}	
}


function envoiMailRecapCommande($nouveauClient, $email, $idCommande){
	$pdfFilename = genererUneCommande($idCommande, $email);
	envoyerMail($nouveauClient, $email, $idCommande, $pdfFilename  );
}

function envoiMailConfirmAbonnementNewslettter($emailAbonnement, $token){
	require_once ("../Swift-4.0.4/lib/swift_required.php");
	
	$message_body = "Bonjour,\n\n";
	$message_body .= " Nous vous confirmons votre abonnement à la newsletter de la Ferme d'Olivet. \n";
	$message_body .= " Vous pourrez à tout moment vous désabonner en en faisant la demande à l'adresse 'fermeolivet@free.fr'. \n\n";
	$message_body .= " Au nom de la Ferme d'Olivet, merci pour votre abonnement.";
	
	
	//MAIL
	
	//Create a message
	$message = Swift_Message::newInstance('Confirmation d\'abonnement à la newsletter');
	$message->setFrom(array('fermeolivet@free.fr' => 'Ferme d\'Olivet'));
	$message->setTo(array($emailAbonnement));
	$message->setBcc(array('fermeolivet@free.fr', 'gwenael.trepos@gmail.com'));
	$message->setBody($message_body);
	
	//Create the Transport
	$transport = Swift_MailTransport::newInstance();
	//Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);
	//Send the message
	$result = $mailer->send($message);
	//remove tmp
	if(file_exists('tmpSWIFT')){
		unlink('tmpSWIFT');
	}	
}

?>