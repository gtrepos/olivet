<?php
require('FPDF/fpdf.php');


class FactureGaecPDF extends FPDF
{
	
	//En-tête
	function Header()
	{
		
		$hauteur = 30;
		$dec_gauche_coord = 60;
		//Logo
		$this->Image('img/logoexploit.gif',10,10,0,$hauteur);
		//Police Arial gras 15
		$this->SetFont('Arial','B',12);
		//Décalage à droite
		$this->Cell(50,$hauteur,'',0,0,'L',false);
		//Titre
		//$this->MultiCell(30,$hauteur,'Titre\ncoucou',0,0,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Gaec à 4 voies",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"L'Olivet",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"35530 SERVON-SUR-VILAINE",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Tel",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Mail",0,2,'L',false);
		$this->Cell($dec_gauche_coord,$hauteur/6,"Site web",0,0,'L',false);
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
		
		
		$this->Cell($larg_colonne,$haut_line,"Servon-Sur-Vilaine, le jour/mois/année",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line,"Référence Client",1,1,'L',false);
		$this->Cell($larg_colonne,$haut_line,"MOIS - ANNEE",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"NOM PRENOM",'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"ADRESSE",'LR',1,'L',false);
		$this->Cell($larg_colonne,$haut_line,"Facture N°",1,0,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"COMPLEMENT ADRESSE",'LR',2,'L',false);
		$this->Cell($larg_colonne,$haut_line/2,"CODE POSTAL COMMUNE",'LRB',1,'L',false);
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
		$this->Cell($larg_col[0],$haut_line,"Categorie Produit",1,0,'C',false);
		$this->Cell($larg_col[1],$haut_line,"Nom Produit",1,0,'C',false);
		$this->Cell($larg_col[2],$haut_line,"Quantité",1,0,'C',false);
		$this->Cell($larg_col[3],$haut_line/2,"Prix unitaire",'LRT',2,'C',false);
		$this->Cell($larg_col[3],$haut_line/2,"TTC",'LRB',0,'C',false);
		$this->SetXY($this->getX(),$this->getY()-$haut_line/2);
		$this->Cell($larg_col[4],$haut_line,"Unité",1,0,'C',false);
		$this->Cell($larg_col[5],$haut_line/2,"Prix total",'LRT',2,'C',false);
		$this->Cell($larg_col[5],$haut_line/2,"TTC",'LRB',1,'C',false);
		//Commandes
		$nb_commandes = 4;//10 c'est un peu pourave
		for($i=0;$i<$nb_commandes;$i++){
			$border = 'LR';
			if($i == $nb_commandes-1){
				$border = 'LRB';	
			}
			$this->Cell($larg_col[0],$haut_line,"cat $i",$border,0,'C',false);
			$this->Cell($larg_col[1],$haut_line,"prod $i",$border,0,'C',false);
			$this->Cell($larg_col[2],$haut_line,"qtité $i",$border,0,'C',false);
			$this->Cell($larg_col[3],$haut_line,number_format($i+0.52,2,',',' ').'€',$border,0,'C',false);
			$this->Cell($larg_col[4],$haut_line,"unit $i",$border,0,'C',false);
			$this->Cell($larg_col[5],$haut_line,"prix total $i",$border,1,'C',false);
		}
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
		$this->Cell($larg_col[1],$haut_line,"Cher",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"Taux TVA",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"100%",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TVA",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"Tout pareil",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL TTC",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"Tres cher",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"REMISE",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"Que dalle",1,1,'C',false);
		$this->SetXY($dec_droite,$this->getY());
		$this->Cell($larg_col[0],$haut_line,"TOTAL TTC après remise",1,0,'L',false);
		$this->Cell($larg_col[1],$haut_line,"emprunte!",1,1,'C',false);
		$this->Ln(15);//espace vertical
	}
	function DatePaiement()
	{
		//Police Arial gras 15
		$this->SetFont('Arial','',8);
		
		$larg_col = 30;
		$haut_line = 10;
		$this->Cell($larg_col,$haut_line,"A REGLER",1,0,'L',false);
		$this->Cell($larg_col,$haut_line,"TOTAL TTC",1,0,'L',false);
		$this->Cell($larg_col,$haut_line,"avant le:",1,0,'L',false);
		$this->Cell($larg_col,$haut_line,"J+18 jours",1,0,'L',false);
		$this->Ln(15);//espace vertical
	 	
	}
	function Agio()
	{
		$larg_col = 190;
		$haut_line = 5;
		
		$message = "RAPPEL: en cas de dépassement de délai de règlement de facture, le GAEC à 4 voies se verra dans l'obligation de compter 2% d'agio sur la facture totale par jour de retard";
		$this->MultiCell($larg_col,$haut_line,$message,0,'L',false);
		
	}
	//Pied de page
	function Footer()
	{
		//Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		$this->Cell(0,5,"GAEC à 4 voies - L'Olivet - 35530 SERVON SUR VILAINE",0,2,'C');
		$this->Cell(0,5,"SIRET 000000000",0,0,'C');
		//Numéro de page
		$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

function GenererUneFacture(){
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
	$pdf->Output('tmp/facture.pdf');
}

?>