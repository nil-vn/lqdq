<?php
define('FRONTEND_APP_DIR', dirname(__FILE__).'/../../../wp-content/plugins/immobilier/front-end/application/');
require_once(FRONTEND_APP_DIR.'components/tcpdf/tcpdf.php');

/**
 * Generate Premium Facture PDF
 * @author huytbt
 */
class PrivilegeAvoirPDF extends TCPDF
{
	public $footer_line_color = array(255,255,255);

	public function __construct()
	{
		parent::__construct();
	}

	public function exportPDF($attrs=array())
	{
		$aspTypo						= "helvetica";
		$aspTailleTitre 				= 16;
		$aspTailleSousTitre				= 14;
		$aspTailleTexte 				= 12;
		$aspTailleLigne 				= 6;
		$aspTailleInterLigne			= $aspTailleLigne;
		$aspTailleLigneTitre			= 8;
		$aspYDebut						= 40;

		$id = $attrs['id'];
		$fid = $attrs['fid'];
		$data = $attrs['data'];

		$id_avoir		= $data["id"];
		$id_facture		= $data["bill_id"];
		$ladate			= $data["creation_date"];
		$avoir_ttc		= $data["avoir_ttc"];
		$honoraire_ttc	= $data["honorary_ttc"];
		$client_nom		= $data["client_firstname"];
		$acquereur_nom	= $data["purchaser_firstname"];

		// '***********************
		// '* DONNEES DU PAIEMENT *
		// '***********************
		// 'PRIX T.T.C.
		$pttc	= $avoir_ttc;
		// 'PRIX H.T.
		$pht		= round($pttc/1.196,2);
		// 'T.V.A.
		$tva		= round($pttc-$pht,2);
		// 'TOTAL TTC
		$pttc = number_format($pttc,2);

		// '----------------------------------------------------------------------
		// ' DEBUT FICHIER PDF
		// ' Définition des constantes de la page
		// '    - taille du texte
		// '    - taille de l'interligne (ligne vide)
		// '    - etc.
		$aspTypo						= "helvetica";
		$aspTailleTitre 				= 10;
		$aspTailleSousTitre				= 9;
		$aspTailleTexte 				= 9;
		$aspTailleLigne 				= 4;
		$aspTailleInterligne			= $aspTailleLigne;
		$aspTailleLigneTitre			= 6;
		$aspYdebut						= 40;

		$this->SetTitle("Immobilier.fr - Facture Privilège n°".$id);
		$this->SetAuthor("Immobilier.fr");
		$this->SetPrintHeader(false);
		$this->SetFooterMargin(13);
		$this->SetAuthor("Immobilier.fr");
		$this->SetSubject("Accord de diffusion d'une annonce de vente immobilière sur Internet");
		$this->Open();
		$this->AddPage();

		$this->SetFont($aspTypo,"",$aspTailleTexte);
		$this->SetTextColor(0,0,0);

		$this->SetFillColor(239,239,239);
		$this->SetY($aspYdebut+6);

		$this->Image(Yii::getPathOfAlias('webroot')."/pdf/images/immobilier.fr.jpg",15,3,180,25);

		$this->SetDrawColor(239,239,239);
		$this->SetLineWidth(0.5);
		$this->Line(10, 27, 200, 27);

		// 'CADRE ADRESSE DU DESTINATAIRE
		$this->SetFillColor (255,255,255);
		$this->RoundedRect (10, 43, 190, 90, 2, '1111', "FD");	// 'cadre blanc interne

		$this->SetFont ($aspTypo, "B", $aspTailleTitre);
		// '$this->Ln(aspTailleLigne*4)
		$this->SetX(25);
		$this->SetY(36);
		$this->Text ($this->GetX(), $this->GetY(), "AVOIR N°A".$id_avoir."-".$id_facture);

		// '*************************
		// 'SOCIETE
		$this->SetY(46);
		$this->Text ($this->GetX()+3, $this->GetY(), "Société");

		$this->SetFont ($aspTypo, "", $aspTailleTexte);

		$this->Ln($aspTailleLigne);
		$this->Text( $this->GetX()+3, $this->GetY(), "Immobilier.fr");
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "11 rue des Arts et Métiers");
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "Lotissement Dillon");
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "97200 Fort de France");

		$this->Ln($aspTailleLigne*2);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+3, $this->GetY(), "Téléphones");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "05 96 42 57 90 (13h - 21h)");
		$this->Ln($aspTailleLigne);
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Text ($this->GetX()+3, $this->GetY(), "Service France Métropolitaine");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "09 65 31 31 79 (8h - 19h)");
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "Fax");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "05 96 42 57 58");
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "04 76 25 02 19");

		$this->Ln($aspTailleLigne*2);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+3, $this->GetY(), "SIRET");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "47765403200010");

		$this->Ln($aspTailleLigne);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+3, $this->GetY(), "APE");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "744B");

		$this->Ln($aspTailleLigne);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+3, $this->GetY(), "CARTE TRANSACTION");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne);
		$this->Text ($this->GetX()+3, $this->GetY(), "T 187 transaction sur immeuble et fonds de commerce");

		// '*************************************
		// 'INFO CLIENT
		$this->SetY(50);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+107, $this->GetY(), "AVOIR SUR FACTURE N°".$id_facture);
		$this->SetFont ($aspTypo, "", $aspTailleTexte);

		$this->Ln($aspTailleLigne*2);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+107, $this->GetY(), "VENTE : " . strtoupper($client_nom) ." / ". strtoupper($acquereur_nom));
		$this->SetFont ($aspTypo, "", $aspTailleTexte);

		$this->Ln($aspTailleLigne*16);
		$this->SetFont ($aspTypo, "B", $aspTailleTexte);
		$this->Text ($this->GetX()+107, $this->GetY(), "Date :");
		$this->SetFont ($aspTypo, "", $aspTailleTexte);
		$this->Ln($aspTailleLigne-4);
		$this->Text ($this->GetX()+117, $this->GetY(), substr($ladate,0,10));

		$this->Ln($aspTailleLigne*4);

		// '***************************************************************************************
		$this->SetFillColor (239,239,239);

		$this->RoundedRect ($this->GetX()+0.1, $this->GetY()+0.1, 189.8, 8, 2, '1111', "F");
		$this->RoundedRect ($this->GetX(), $this->GetY(), 190, 26, 2, '1111', "");

		$this->SetY($this->GetY()+2);
		$this->SetFont ($aspTypo, "BI", $aspTailleSousTitre);
		$this->Cell (90,$aspTailleLigne, "Désignation", 0,0,"L", 0);
		$this->Cell (32,$aspTailleLigne, "", 0,0,"R", 0);
		$this->SetX($this->GetX()+2);
		$this->Cell (32,$aspTailleLigne, "", 0,0,"C", 0);
		$this->SetX($this->GetX()+2);
		$this->Cell (32,$aspTailleLigne, "Montant TTC", 0,0,"C", 0);

		$this->SetY($this->GetY()+$aspTailleLigne+$aspTailleInterLigne-1);

		$this->SetFont ($aspTypo, "", $aspTailleSousTitre);

		// ' Montant des honoraires de base
		$this->Cell (90,$aspTailleLigne, "Montant facture n°".$id_facture." « Honoraire TTC »", 0,0,"L", 0);
		// '$this->SetFont aspTypo, "B", aspTailleSousTitre
		$this->Cell (32,$aspTailleLigne, "", 0,0,"R", 0);
		$this->SetX($this->GetX()+2);
		$this->Cell (32,$aspTailleLigne, "", 0,0,"C", 0);
		$this->SetX($this->GetX()+2);
		$this->Cell (23,$aspTailleLigne, number_format($honoraire_ttc,2), 0,1,"R", 0);
		// '$this->Cell 10,aspTailleLigne, "€", 0,1,"R", 0

		$this->Cell (190,$aspTailleLigne, "", 0,1,"L", 0);	//'ligne vide*2

		// ' avoir_ttc
		if ($avoir_ttc<>0) {
			$this->Cell (90,$aspTailleLigne, "Avoir exceptionnel", 0,0,"L", 0);
			// '$this->SetFont aspTypo, "B", aspTailleSousTitre
			$this->Cell (32,$aspTailleLigne, "", 0,0,"R", 0);
			$this->SetX($this->GetX()+2);

			$this->Cell (32,$aspTailleLigne, "", 0,0,"C", 0);
			$this->SetX($this->GetX()+2);

			$this->Cell (23,$aspTailleLigne, number_format($avoir_ttc,2), 0,1,"R", 0);
			// '$this->Cell 10,aspTailleLigne, "€", 0,1,"R", 0

			$this->Cell (190,$aspTailleLigne*2, "", 0,1,"L", 0);	//'ligne vide*2
		}

		// '*******************************************************************************************
		// 'CADRE TOTAL
		// 'total ht
		$this->RoundedRect ($this->GetX(), $this->GetY()-1, 190, 15, 2, '1111', "");
		$this->RoundedRect ($this->GetX()+0.1, $this->GetY()+$aspTailleLigne*2, 189.8, $aspTailleLigne+2, 2, '1111', "F");
		// 'separation
		$this->Line (170, $this->GetY()-1, 170, $this->GetY()+14);

		$this->SetFont ($aspTypo, "", $aspTailleSousTitre);
		$this->Cell (132,$aspTailleLigne, "", 0,0,"L", 0);
		$this->Cell (26,$aspTailleLigne, "Avoir H.T", 0,0,"R", 0);
		$this->Cell (23,$aspTailleLigne, number_format($pht,2), 0,0,"R", 0);
		$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);

		// 'tva
		$this->SetFont ($aspTypo, "", $aspTailleSousTitre);
		$this->Cell (132,$aspTailleLigne, "", 0,0,"L", 0);
		$this->Cell (26,$aspTailleLigne, "T.V.A. sur Avoir (19,6%)", 0,0,"R", 0);
		$this->Cell (23,$aspTailleLigne, number_format($tva,2), 0,0,"R",0);
		$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);
		// 'total ttc
		$this->SetY($this->GetY()+1);
		$this->SetFont ($aspTypo, "B", $aspTailleSousTitre);
		$this->Cell (132,$aspTailleLigne, "", 0,0,"L", 0);
		$this->Cell (26,$aspTailleLigne, "Avoir T.T.C.", 0,0,"R", 0);
		$this->Cell (23,$aspTailleLigne, number_format($pttc,2), 0,0,"R", 0);
		$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);

		// 'pied de page
		// '**********************************************************************************************
		// 'FOOTER
		$this->SetLineWidth(0.5);
		$this->Line (10, 258, 200, 258);
		$this->SetY(260);
		$this->SetFont ($aspTypo, "", 7);

		$this->Cell (0, $aspTailleLigne-2, "Immobilier.fr - 11, rue des Arts et Métiers - Lot. Dillon-Stade - 97200 Fort de France - MARTINIQUE", 0,1,"C", 0);
		$this->Cell (0, $aspTailleLigne-2, "SIRET : 477 654 032 00010 - APE : 744 B - Carte Transactions : 187T (délivrée par la préfecture de la Martinique)", 0,1,"C", 0);
		$this->Cell (0, $aspTailleLigne-2, "Capital Social : 20 001 euros - Tél : 09.70.40.50.55 - E-mail : ServiceClients@immobilier.fr", 0,1,"C", 0);

		$this->Line (10, 278, 200, 278);

		$this->Close();
		if (isset($attrs['return'])) {
			try{
				$this->Output(Yii::getPathOfAlias('webroot')."/compta/avoir_privilege_A".$id_avoir."-".$id_facture.".pdf","F");
				return array(
					'path'		=> Yii::getPathOfAlias('webroot')."/compta/",
					'filename'	=> "avoir_privilege_A".$id_avoir."-".$id_facture.".pdf",
				);
			}catch(Exception $e){
				return false;
			}
		} else {
			$this->Output(Yii::getPathOfAlias('webroot')."/compta/avoir_privilege_A".$id_avoir."-".$id_facture.".pdf","F");
		}
	}

	public function Footer()
	{
		$aspTypo = "helvetica";
		$cur_y = $this->y;
		$this->SetTextColorArray($this->footer_text_color);
		$this->SetFontSize(9);
		$this->SetFont ($aspTypo, "i", 8);
		//set style for cell border
		$line_width = (0.85 / $this->k);
		$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
		//print document barcode
		$barcode = $this->getBarcode();
		if (!empty($barcode)) {
			$this->Ln($line_width);
			$barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
			$style = array(
				'position' => $this->rtl?'R':'L',
				'align' => $this->rtl?'R':'L',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				'border' => false,
				'padding' => 0,
				'fgcolor' => array(0,0,0),
				'bgcolor' => false,
				'text' => false
			);
			$this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
		}
		$w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
		if (empty($this->pagegroups)) {
			$pagenumtxt = 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages();
		} else {
			$pagenumtxt = 'Page '.$this->getPageNumGroupAlias().'/'.$this->getPageGroupAlias();
		}
		$this->SetY($cur_y);
		//Print page number
		if ($this->getRTL()) {
			$this->Cell(90, 0, "immobilier.fr", 'T', 0, 'L');
			$this->Cell(50, 0, $pagenumtxt, 'T', 1, 'C');
			$this->Cell(50, 0, $this->date_createdPDF(), 'T', 1, 'R');
		} else {
			$this->Cell(90, 0, "immobilier.fr", 'T', 0, 'L');
			$this->Cell(50, 0, $pagenumtxt, 'T', 0, 'L');
			$this->Cell(50, 0, $this->date_createdPDF(), 'T', 0, 'R');
		}
	}

	protected function date_createdPDF()
	{
		switch(date('D')) {
			case "Mon" : $day = "lundi"; break;
			case "Tue" : $day = "mardi"; break;
			case "Wed" : $day = "mercredi"; break;
			case "Thu" : $day = "jeudi";  break;
			case "Fri" : $day = "vendredi"; break;
			case "Sat" : $day = "samedi"; break;
			case "Sun" : $day = "dimanche";  break;
		}
		switch(date('M')) {
			case "Jan" : $month = "janvier"; break;
			case "Feb" : $month = "février"; break;
			case "Mar" : $month = "mars"; break;
			case "Apr" : $month = "quatre mois"; break;
			case "May" : $month = "mai"; break;
			case "Jun" : $month = "juin"; break;
			case "Jul" : $month = "juillet"; break;
			case "Aug" : $month = "août"; break;
			case "Sep" : $month = "septembre"; break;
			case "Oct" : $month = "octobre"; break;
			case "Nov" : $month = "novembre"; break;
			case "Dec" : $month = "décembre"; break;
		}
		$date = $day." ".date('d')." ".$month." ".date('Y')." ".date('H:i:s');
		return $date;
	}
}
