<?php
require('../FPDF/fpdf.php');

class FactureGaecPDF extends FPDF
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
		$this->Cell($dec_gauche_coord,$hauteur/6,"Tel",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Mail",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Site web : http://fermeolivet.free.fr",0,0,'L',false);
		$this->Ln(15);//espace vertical
	}
	function BanniereFacture()
	{
		$this->SetFont('Arial','B',25);
		$this->Cell(0,10,'FACTURE',0,0,'C',false);
		$this->Ln(15);//espace vertical
	}
	function TableClient()
	{
		$larg_colonne = 95;
		$haut_line = 16;
		//Police Arial gras 15
		$this->SetFont('Arial','',10);

		
		setlocale (LC_TIME, 'fr_FR','fra');
		
		$ladate = strftime("%A %d %B %Y %T %H:%M:%S"); 
		
		$this->Cell($larg_colonne,$haut_line,"Servon-Sur-Vilaine",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line,utf8_decode(
			"Référence Client : " . "TODO clientID"),1,1,'L',false);
		$this->Cell($larg_colonne,$haut_line,"le $ladate",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,utf8_decode(
			"TODO clientNOM" . " " . "TODO clientPRENOM"),'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,utf8_decode(
			"TODO clientADDR"),'LR',1,'L',false);
		$this->Cell($larg_colonne,$haut_line,utf8_decode(
			"Facture N°"."TODO COMMANDEID"),1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,utf8_decode(
			"TODO clientCODE"." "."TODO clientCOMMUNE"),'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"",'LRB',1,'L',false);
		$this->Ln(15);//espace vertical
		
	}
	function DetailFacture()
	{
		$larg_page = 190;
		$haut_line = 10;
		$larg_col=array(5*$larg_page/20,
		5*$larg_page/20,3*$larg_page/20,3*$larg_page/20,
		2*$larg_page/20,2*$larg_page/20);
	
		//Police Arial gras 15
		$this->SetFont('Arial','',10);
		//Headers
		$this->Cell($larg_page,$haut_line,"DETAIL FACTURE",1,2,'C',false);
		$this->Cell($larg_col[0],$haut_line,utf8_decode("Catégorie Produit"),1,0,'C',false);
		$this->Cell($larg_col[1],$haut_line,"Nom Produit",1,0,'C',false);
		$this->Cell($larg_col[2],$haut_line,utf8_decode("Quantité"),1,0,'C',false);
		$this->Cell($larg_col[3],$haut_line/2,"Prix unitaire",'LRT',2,'C',false);
		$this->Cell($larg_col[3],$haut_line/2,"HT",'LRB',0,'C',false);
		$this->SetXY($this->getX(),$this->getY()-$haut_line/2);
		$this->Cell($larg_col[4],$haut_line,utf8_decode("Unité"),1,0,'C',false);
		$this->Cell($larg_col[5],$haut_line/2,"Prix total",'LRT',2,'C',false);
		$this->Cell($larg_col[5],$haut_line/2,"HT",'LRB',1,'C',false);
		//Commandes
//		$nbConditionnements = count($conditionnements);//10 c'est un peu pourave
		
		$i = 0;		
		
//		foreach ( $conditionnements as $conditionnement ) {
//       		$border = 'LR';
//			if($i == $nbConditionnements-1){
				$border = 'LRB';	
//			}
//			$prixUnite = $conditionnement->prixConditionnement + 
//				$conditionnement->produitPrixUnite * $conditionnement->quantiteProduit;
			$prixUnite = "-11";
			
			$this->Cell($larg_col[0],$haut_line,
				utf8_decode("TODO LibCat"),$border,0,'C',false);
			$this->Cell($larg_col[1],$haut_line,
				utf8_decode("TODO condNom" . ' ' . "TODO Libprod"),$border,0,'C',false);
			$this->Cell($larg_col[2],$haut_line,
				"TODO condQt",$border,0,'C',false);
			$this->Cell($larg_col[3],$haut_line,iconv("UTF-8", "CP1252", 
				$prixUnite . ' €'),$border,0,'C',false);
			$this->Cell($larg_col[4],$haut_line,
				utf8_decode("TOTO prodUNITE"),$border,0,'C',false);
			$this->Cell($larg_col[5],$haut_line,iconv("UTF-8", "CP1252", 
				"TODO QTITR COND" . ' €'),$border,1,'C',false);
			$i++;
//		}
		
		$this->Ln(15);//espace vertical
		
	}
	function Totaux()
	{
		$larg_page = 190;
		$haut_line = 5; 
		$dec_droite = 13*$larg_page/20 + 10;//compliqué : decal sur Prix unitaire TTC 
		$larg_col=array(5*$larg_page/20,2*$larg_page/20);
		//Police Arial gras 15
		$this->SetFont('Arial','',10);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL HT",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,iconv("UTF-8", "CP1252", "TODO prix TOT" . ' €'),1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"Taux TVA",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"19,6 %",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TVA",1,0,'L',false);
		$tvaFinale = -11 ; //number_format( (-11 * 19.6)/100 . ' €', 2 );
		$this->Cell($larg_col[1],$haut_line,iconv("UTF-8", "CP1252", $tvaFinale . ' €'),1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL TTC",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,iconv("UTF-8", "CP1252", "TODO prix TOT" + $tvaFinale . ' €'),1,1,'C',false);
		
		$this->Ln(15);//espace vertical
	}
	function DatePaiement()
	{
		//Police Arial gras 15
		$this->SetFont('Arial','',8);
		$larg_col = 30;
		$haut_line = 10;
		$this->Cell($larg_col,$haut_line,"A REGLER",1,0,'L',false);
		$tvaFinale = -11; //number_format( (-11 * 19.6)/100 . ' €', 2 );
		$this->Cell($larg_col,$haut_line,iconv("UTF-8", "CP1252", "TODO prix TOT" + $tvaFinale . ' €'),1,0,'L',false);
		$this->Cell($larg_col,$haut_line,"avant le : ",1,0,'L',false);
		$dans18jours = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d")+18,  date("Y")));
		$this->Cell($larg_col,$haut_line,$dans18jours,1,0,'L',false);
		$this->Ln(15);//espace vertical
	 	
	}
	function Agio()
	{
		$larg_col = 190;
		$haut_line = 5;
		
		$message = utf8_decode("RAPPEL : en cas de dépassement de délai de règlement de facture, le GAEC à 3 voix se verra dans l'obligation de compter 2% d'agio sur la facture totale par jour de retard");
		$this->MultiCell($larg_col,$haut_line,$message,0,'L',false);
		
	}
	//Pied de page
	function Footer()
	{
		//Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		$this->Cell(0,5,utf8_decode("GAEC à 3 voix - L'Olivet - 35530 SERVON SUR VILAINE"),0,2,'C');
		$this->Cell(0,5,"SIRET 000000000",0,0,'C');
		//Numéro de page
		$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

function GenererUneFacture($idCommande){
	
	$pdf=new FactureGaecPDF();
	
	$pdf->AliasNbPages();
	//construction page
	$pdf->AddPage();
	$pdf->BanniereFacture();
	$pdf->TableClient();
	$pdf->DetailFacture();
	$pdf->Totaux();
	$pdf->DatePaiement();
	$pdf->Agio();
	
	$pdf->Output('../tmp/recap'.$idCommande.'.pdf','F');
}

function envoiMailRecapCommande($nouveauClient, $idCommande){
	
	GenererUneFacture($idCommande);
	
//	//MAIL
//	require_once ("../Swift-4.0.4/lib/swift_required.php");
//	//Create a message
//	$message = Swift_Message::newInstance('Récapitulatif commande');
//	$message->setFrom(array('john@doe.com' => 'Ferme d\'Olivet'));
//	$message->setTo(array('rtrepos@gmail.com'));
//	$message->setContentType("text/html");
//	$message->setBody('');
//	
//	//Create the attachment
//	//$message->attach(Swift_Attachment::fromPath('tmp/facture.pdf'));
//	//Create the Transport
//	$transport = Swift_MailTransport::newInstance();
//	//Create the Mailer using your created Transport
//	$mailer = Swift_Mailer::newInstance($transport);
//	//Send the message
//	$result = $mailer->send($message);
//	//remove tmp
//	if(file_exists('tmpSWIFT')){
//		unlink('tmpSWIFT');
//	}
}


?>