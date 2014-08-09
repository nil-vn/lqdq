<?php
define('FRONTEND_APP_DIR', dirname(__FILE__).'/../../../wp-content/plugins/immobilier/front-end/application/');
require_once(FRONTEND_APP_DIR.'components/tcpdf/tcpdf.php');

/**
 * Generate Premium Facture PDF
 * @author huytbt
 */
class PremiumFacturePDF extends TCPDF
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

		$facture_id = $attrs['facture_id'];
		$data = $attrs['data'];
		if (!$data->nb_days == null) {
			$nbj = $data->nb_days;
			$NBS = round($nbj/7.5, 0);
			$NBM = round($NBS/4,0);
		}
		$ladate	= date('d/m/Y', strtotime($data->payment_date));
		$pttc	= $data->ttc_amount/100;
		$pht	= round($pttc/1.196,2);
		$tva	= round($pttc-$pht,2);
		$pttc	= number_format($pttc,2);

		$this->SetTitle("Immobilier.fr - Facture n°".$facture_id);
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
		$this->SetY($aspYDebut+6);

		$this->Image(Yii::getPathOfAlias('webroot')."/pdf/images/immobilier.fr.jpg",15,3,180,25);

		$this->SetDrawColor(239,239,239);
		$this->SetLineWidth(0.5);
		$this->Line(10, 27, 200, 27);

		// $this->SetFillColor(253,167,102);
		$this->RoundedRect(10, $aspYDebut+2, 68, 32, 2, '1111', 'DF');
		// $this->SetFillColor(239,239,239);

		$this->SetFont($aspTypo, "B",$aspTailleTexte);
		$this->SetX(12);
		$this->Cell(80,$aspTailleLigne, "Facture du " . $ladate, 0,1,"L", 0);
		$this->SetX(12);
		$this->Cell(80,$aspTailleLigne, "n° de facture : V".$data->id, 0,1,"L", 0);
		$this->SetX(12);
		$this->Cell(80,$aspTailleLigne, "n° de client : " . $data->postProperty->user_id, 0,1,"L", 0);
		$this->SetX(12);
		$this->Cell(80,$aspTailleLigne, "Référence annonce : " . $data->post_property_id, 0,1,"L", 0);

		// cadre droite
		// CADRE INFORMATIONS CLIENT
		$this->SetFillColor(255,255,255);
		$x=82;
		$this->SetXY($x,46);

		$this->RoundedRect(80, $aspYDebut+2, 120, 32, 2, '1111', "DF");
		$this->Cell(80,$aspTailleLigne, strtoupper(WpUserMeta::model()->getMetaValues($data->postProperty->user_id, 'first_name') . ' ' . WpUserMeta::model()->getMetaValues($data->postProperty->user_id, 'last_name')), 0,1,"L", 0);

		$userAddress = WpUserMeta::model()->getMetaValues($data->postProperty->user_id, 'address');
		if ($userAddress!="") {
			$this->SetX($x);
			$this->Cell(80,$aspTailleLigne, $userAddress, 0,1,"L", 0);
		}
		$mypostville = WpUserMeta::model()->getMetaValues($data->postProperty->user_id, 'mypostville');
		if (strlen($mypostville) > 1) {
			$this->SetX ($x);
			$cp = WpUserMeta::model()->getMetaValues($data->postProperty->user_id, 'mypostcode');
			if ($cp != null && strlen($cp) > 2) {
				$this->Cell (80,$aspTailleLigne,$cp." ".$mypostville, 0,1,"L", 0 );
			} else {
				$this->Cell (80,$aspTailleLigne,$mypostville, 0,1,"L", 0 );
			}
		}
		$this->SetX ($x);

		// 'DETAIL FACTURE
		// '--------------
		$this->SetY(83);

		$this->SetFont ($aspTypo, "B", $aspTailleTitre);
		$this->Cell (190,$aspTailleLigneTitre, "Votre facture en détail", 0,1,"L", 0);

		// 'MODE DE PAIEMENT
		// '----------------
		$this->SetXY($x,86);
		$this->SetY($this->GetY()+$aspTailleLigneTitre);
		$this->SetFont ($aspTypo, "",$aspTailleSousTitre);
		$this->Text (10, $this->GetY()-2, "Mode de paiement");

		$x=10;
		$this->SetXY($x,99);
		$this->Line ($this->GetX(), $this->GetY(),200, $this->GetY());

		$this->RoundedRect ($this->GetX(), $this->GetY()-7, 190, 30, 2);

		$this->SetDrawColor (0,0,0);
		$this->SetLineWidth(0.3);

		$this->Rect (15, $this->GetY()+$aspTailleLigne+1, 2, 2);
		$this->Rect (15, $this->GetY()+$aspTailleLigne*2+2, 2, 2);

		$this->SetFont ($aspTypo, "",$aspTailleTexte);
		$this->Text (20, $this->GetY()+$aspTailleLigne-1, "Chèque");

		if ($data->check==1) {
			$this->Line (15, $this->GetY()+$aspTailleLigne-7+3, 17, $this->GetY()+$aspTailleLigne-7+5);
			$this->Line (15, $this->GetY()+$aspTailleLigne-7+5, 17, $this->GetY()+$aspTailleLigne-7+3);
		}
		$this->Text (20, $this->GetY()+$aspTailleLigne+1, "Carte de crédit");
		if ($data->check==0) {
			$this->Line (15, $this->GetY()+$aspTailleLigne-7+3, 17, $this->GetY()+$aspTailleLigne-7+5);
			$this->Line (15, $this->GetY()+$aspTailleLigne-7+5, 17, $this->GetY()+$aspTailleLigne-7+3);
		}

		$this->SetDrawColor (239,239,239);
		$this->SetLineWidth(0.5);

		// 'titre colonnes
		$this->SetY($this->GetY()+$aspTailleLigne*4+$aspTailleInterLigne-12);

		$this->SetFillColor (239,239,239);	//'Fond gris
		$this->RoundedRect ($this->GetX(), $this->GetY(), 190, 34, 2, "1111");
		$this->RoundedRect ($this->GetX()+0.1, $this->GetY()+0.1, 189.8, 8, 2, '1111', "F");
		$this->SetFillColor (255,255,255);	//'Fond blanc

		$this->SetY($this->GetY()+1);
		$this->SetFont( $aspTypo, "B", $aspTailleSousTitre);
		$this->Cell (136,$aspTailleLigne, "Désignation", 0,0,"L", 0);
		$this->Cell (22,$aspTailleLigne, "Quantité", 0,0,"C", 0);
		$this->SetX($this->GetX()+2);
		$this->Cell (32,$aspTailleLigne, "Total HT", 0,0,"C", 0);

		$this->SetY($this->GetY()+$aspTailleLigne+$aspTailleInterLigne);

		$this->SetFont ($aspTypo, "", $aspTailleSousTitre);

		if ($NBS>1) {
			$this->Cell (136,$aspTailleLigne, "Abonnement Premium :", 0,0,"L", 0);
			$this->SetFont ($aspTypo, "B", $aspTailleSousTitre);
			$this->Cell (22,$aspTailleLigne, "1", 0,0,"C", 0);
			$this->SetX($this->GetX()-4);
			$this->Cell (27,$aspTailleLigne, $pht, 0,0,"R", 0);
			$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);

			$this->SetY($this->GetY()+2);
			$this->SetFont ($aspTypo, "", 9);
			$this->Cell (136,$aspTailleLigne, "Diffusion de votre annonce pour une durée de ".$NBM." mois", 0,0,"L", 0);

			$this->Cell (190,$aspTailleLigne*3, "", 0,1,"L", 0);	//'ligne vide

		} else {
			$this->Cell (136,$aspTailleLigne, "Abonnement Premium :", 0,0,"L", 0);
			$this->SetFont( $aspTypo, "B", $aspTailleSousTitre);
			$this->Cell (22,$aspTailleLigne, "1", 0,0,"C", 0);
			$this->Cell (27,$aspTailleLigne, "11,71", 0,0,"R", 0);
			$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);
			
			$this->SetY($this->GetY()+2);
			$this->SetFont ($aspTypo, "", 9);
			$this->Cell (136,$aspTailleLigne, "Diffusion de votre annonce pour une durée d'une semaine", 0,0,"L", 0);
			
			$this->Cell (190,$aspTailleLigne*3, "", 0,1,"L", 0);	//'ligne vide
		}

		// 'Separations
		$this->Line (145, 129, 145, 129+34);
		$this->Line (170, 129, 170, 129+34);

		// 'CADRE TOTAL
		// 'total ht
		$this->SetFillColor (239,239,239);	//'Fond gris
		$this->RoundedRect ($this->GetX(), $this->GetY()-1, 190, 21.1, 2, "1111");
		$this->RoundedRect ($this->GetX()+0.1, $this->GetY()+12, 189.8, 8, 2, '1111', "F");
		$this->Line (170, $this->GetY()-1, 170, $this->GetY()+20);
		$this->SetFillColor (255,255,255);	//'Fond gris

		$this->SetFont ($aspTypo, "", $aspTailleSousTitre);
		$this->Cell (135,$aspTailleLigne, "", 0,0,"L", 0);
		$this->Cell (23,$aspTailleLigne, "Total H.T", 0,0,"L", 0);
		$this->Cell (23,$aspTailleLigne, $pht, 0,0,"R", 0);
		$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);

		// 'tva
		$this->SetFont ($aspTypo, "", $aspTailleSousTitre);
		$this->Cell (124,$aspTailleLigne, "", 0,0,"L", 0);
		$this->Cell (21,$aspTailleLigne, "T.V.A. (19,6%)", 0,0,"L", 0);
		$this->Cell (13,$aspTailleLigne*2, "", 0,0,"L", 0);	//'ligne vide
		$this->Cell (23,$aspTailleLigne, $tva, 0,0,"R",0);
		$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);
		// 'total ttc
		$this->SetY($this->GetY()+1);
		$this->SetFont ($aspTypo, "B", $aspTailleSousTitre);
		$this->Cell (130,$aspTailleLigne, "", 0,0,"L", 0);
		$this->Cell (23,$aspTailleLigne, "Total T.T.C.", 0,0,"L", 0);
		$this->Cell (5,$aspTailleLigne*2, "", 0,0,"L", 0);	//'ligne vide
		$this->Cell (23,$aspTailleLigne, $pttc, 0,0,"R", 0);
		$this->Cell (5,$aspTailleLigne, "€", 0,1,"L", 0);

		$this->SetTextColor (151,0,0);
		$this->SetFont ("Helvetica", "U", 62);
		// if (strtolower($data->result) == 'failure' || strtolower($data->result) == 'g5') {
		// 	// 'MARQUE LA FACTURE COMME SUPPRIMEE
		// 	$this->RotatedText (55,210,"Facture annulée",45	);
		// } elseif (strtolower($data->result) == 'rembourse') {
		// 	$this->RotatedText (45,210,"Facture remboursée",45	);
		// }
		$this->SetTextColor (0,0,0);

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
				$this->Output(Yii::getPathOfAlias('webroot')."/compta/premium_facture_".$facture_id.".pdf","F");
				return array(
					'path'		=> Yii::getPathOfAlias('webroot')."/compta/",
					'filename'	=> "premium_facture_".$facture_id.".pdf",
				);
			}catch(Exception $e){
				return false;
			}
		} else {
			$this->Output(Yii::getPathOfAlias('webroot')."/compta/premium_facture_".$facture_id.".pdf","F");
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
