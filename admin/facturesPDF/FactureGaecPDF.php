<?php
require('../../FPDF/fpdf.php');
require ('../../tools/config.php') ;
ouverture ();
require('../bean/Facture.php');

class FactureGaecPDF extends FPDF
{
	
	//En-tête
	function Header()
	{
		
		$hauteur = 30;
		$dec_gauche_coord = 60;
		//Logo
		$this->Image('../../img/logoexploit.gif',10,10,0,$hauteur);
		//Police Arial gras 15
		$this->SetFont('Arial','B',12);
		//Décalage à droite
		$this->Cell(50,$hauteur,'',0,0,'L',false);
		//Titre
		//$this->MultiCell(30,$hauteur,'Titre\ncoucou',0,0,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Gaec à 3 voies",0,2,'L',false);
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
	function TableClient($facture)
	{
		$larg_colonne = 95;
		$haut_line = 16;
		//Police Arial gras 15
		$this->SetFont('Arial','',10);
		
		$client = $facture->client;
		$commande = $facture->commande;
		
		setlocale (LC_TIME, 'fr_FR','fra');
		
		$ladate = strftime("%A %d %B %Y %T %H:%M:%S"); 
		
		$this->Cell($larg_colonne,$haut_line,"Servon-Sur-Vilaine, le $ladate",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line,"Référence Client : " . $client->id,1,1,'L',false);
		$this->Cell($larg_colonne,$haut_line,"MOIS - ANNEE",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,$client->nom . " " . $client->prenom,'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,$client->adresse,'LR',1,'L',false);
		$this->Cell($larg_colonne,$haut_line,"Facture N°".$commande->id,1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,$client->codePostal." ".$client->commune,'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"",'LRB',1,'L',false);
		$this->Ln(15);//espace vertical
		
	}
	function DetailFacture($facture)
	{
		$larg_page = 190;
		$haut_line = 10;
		$larg_col=array(5*$larg_page/20,
		5*$larg_page/20,3*$larg_page/20,3*$larg_page/20,
		2*$larg_page/20,2*$larg_page/20);
		
		$conditionnements = $facture->conditionnements;
		$commande = $facture->commande;
		
		//Police Arial gras 15
		$this->SetFont('Arial','',10);
		//Headers
		$this->Cell($larg_page,$haut_line,"DETAIL FACTURE",1,2,'C',false);
		$this->Cell($larg_col[0],$haut_line,"Catégorie Produit",1,0,'C',false);
		$this->Cell($larg_col[1],$haut_line,"Nom Produit",1,0,'C',false);
		$this->Cell($larg_col[2],$haut_line,"Quantité",1,0,'C',false);
		$this->Cell($larg_col[3],$haut_line/2,"Prix unitaire",'LRT',2,'C',false);
		$this->Cell($larg_col[3],$haut_line/2,"HT",'LRB',0,'C',false);
		$this->SetXY($this->getX(),$this->getY()-$haut_line/2);
		$this->Cell($larg_col[4],$haut_line,"Unité",1,0,'C',false);
		$this->Cell($larg_col[5],$haut_line/2,"Prix total",'LRT',2,'C',false);
		$this->Cell($larg_col[5],$haut_line/2,"HT",'LRB',1,'C',false);
		//Commandes
		$nbConditionnements = count($conditionnements);//10 c'est un peu pourave
		
		$i = 0;		
		
		foreach ( $conditionnements as $conditionnement ) {
       		$border = 'LR';
			if($i == $nbConditionnements-1){
				$border = 'LRB';	
			}
			$prixUnite = $conditionnement->prixConditionnement + $conditionnement->produitPrixUnite * $conditionnement->quantiteProduit;
			
			$this->Cell($larg_col[0],$haut_line,$conditionnement->libelleCategorie,$border,0,'C',false);
			$this->Cell($larg_col[1],$haut_line,$conditionnement->nomConditionnement . ' ' . $conditionnement->libelleProduit,$border,0,'C',false);
			$this->Cell($larg_col[2],$haut_line,$conditionnement->quantiteConditionnement,$border,0,'C',false);
			$this->Cell($larg_col[3],$haut_line,$prixUnite . ' €',$border,0,'C',false);
			$this->Cell($larg_col[4],$haut_line,$conditionnement->produitUnite,$border,0,'C',false);
			$this->Cell($larg_col[5],$haut_line,$prixUnite * $conditionnement->quantiteConditionnement . ' €',$border,1,'C',false);
			$i++;
		}
		
		$this->Ln(15);//espace vertical
		
	}
	function Totaux($facture)
	{
		$larg_page = 190;
		$haut_line = 5; 
		$dec_droite = 13*$larg_page/20 + 10;//compliqué : decal sur Prix unitaire TTC 
		$larg_col=array(5*$larg_page/20,2*$larg_page/20);
		//Police Arial gras 15
		$this->SetFont('Arial','',10);
		
		
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL HT",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,$facture->prixTotal . ' €',1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"Taux TVA",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"19,6 %",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TVA",1,0,'L',false);
		$tvaFinale = number_format( ($facture->prixTotal * 19.6)/100 . ' €', 2 );
		$this->Cell($larg_col[1],$haut_line,$tvaFinale . ' €',1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL TTC",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,$facture->prixTotal + $tvaFinale . ' €',1,1,'C',false);
		/*$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"REMISE",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"Que dalle",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL TTC après remise",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"emprunte!",1,1,'C',false);*/
		$this->Ln(15);//espace vertical
	}
	function DatePaiement($facture)
	{
		//Police Arial gras 15
		$this->SetFont('Arial','',8);
		$larg_col = 30;
		$haut_line = 10;
		$this->Cell($larg_col,$haut_line,"A REGLER",1,0,'L',false);
		$tvaFinale = number_format( ($facture->prixTotal * 19.6)/100 . ' €', 2 );
		$this->Cell($larg_col,$haut_line,$facture->prixTotal + $tvaFinale . ' €',1,0,'L',false);
		$this->Cell($larg_col,$haut_line,"avant le : ",1,0,'L',false);
		$dans18jours = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d")+18,  date("Y")));
		$this->Cell($larg_col,$haut_line,$dans18jours,1,0,'L',false);
		$this->Ln(15);//espace vertical
	 	
	}
	function Agio()
	{
		$larg_col = 190;
		$haut_line = 5;
		
		$message = "RAPPEL : en cas de dépassement de délai de règlement de facture, le GAEC à 3 voies se verra dans l'obligation de compter 2% d'agio sur la facture totale par jour de retard";
		$this->MultiCell($larg_col,$haut_line,$message,0,'L',false);
		
	}
	//Pied de page
	function Footer()
	{
		//Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		$this->Cell(0,5,"GAEC à 3 voies - L'Olivet - 35530 SERVON SUR VILAINE",0,2,'C');
		$this->Cell(0,5,"SIRET 000000000",0,0,'C');
		//Numéro de page
		$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

function GenererUneFacture($idCommande){
	
	$pdf=new FactureGaecPDF();
	
	$facture=new Facture();
	$facture->InitFacture($idCommande);
	
	$pdf->AliasNbPages();
	//construction page
	$pdf->AddPage();
	$pdf->BanniereFacture();
	$pdf->TableClient($facture);
	$pdf->DetailFacture($facture);
	$pdf->Totaux($facture);
	$pdf->DatePaiement($facture);
	$pdf->Agio();
	
	$pdf->Output('./factures/facture'.$idCommande.'.pdf','F');
}

?>