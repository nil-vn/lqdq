<?php
define('FRONTEND_APP_DIR', dirname(__FILE__).'/../../../wp-content/plugins/immobilier/front-end/application/');
require_once(FRONTEND_APP_DIR.'components/tcpdf/tcpdf.php');

/**
 * Generate Courrier Simple PDF
 * @author thanhnt
 */
class CourrierRecomandePDF extends TCPDF
{
	public $footer_line_color = array(255,255,255);

	public function __construct()
	{
		parent::__construct();
	}

	public function exportPDF($attrs=array())
	{
		$aspTypo						= "helvetica";
		$aspTailleTitre 				= 10;
		$aspTailleSousTitre				= 9;
		$aspTailleTexte 				= 9;
		$aspTailleLigne 				= 4;
		$aspTailleInterLigne			= $aspTailleLigne;
		$aspTailleLigneTitre			= 6;
		$aspYDebut						= 43;
		
		$property_id = $attrs['property_id'];
		$mandat = PrivilegeMandat::model()->findbyAttributes(array('post_property_id' => $property_id));
		$id_mendat = $mandat->id;
		$data = $attrs['data'];
		
		$subject = "Courrier recommandé BTK".$property_id." (Mandat ".$id_mendat.")";
			
		$this->SetTitle("Immobilier.fr - Lettre recommandé mandat ".$id_mendat);
		$this->SetAuthor("Immobilier.fr");
		$this->SetSubject($subject);
		$this->SetPrintHeader(false);
		$this->SetFooterMargin(13);
		$this->Open();
		$this->AddPage();
		
		$this->SetFont($aspTypo, "", $aspTailleTexte);
		$this->SetTextColor(0,0,0);
		$this->Image(Yii::getPathOfAlias('webroot')."/pdf/images/immobilier.fr.jpg",15,3,180,25);

		$this->SetDrawColor(239,239,239);
		$this->SetLineWidth(0.5);
		$this->Line(10, 27, 200, 27);

		$this->SetFillColor(239,239,239);
		$this->SetY($aspYDebut+6);
		$this->RoundedRect(104, $aspYDebut+2, 96, 33, 2, '1111', 'DF');
		
		
		$postProperty = WpPostProperty::model()->findByPk($property_id);
	
		if (substr($postProperty->postal_code, 0, 2)  > 95)
			$SERVICE = "Outre-Mer";			
		else		
			$SERVICE = "France Metropolitaine";				
		
		$this->SetFont ($aspTypo, "B", $aspTailleTitre);
		
		$this->SetY(43 + $aspTailleTitre);
		$this->SetX(102 + 3);
		$this->Text($this->GetX(), $this->GetY(), strtoupper(WpUserMeta::model()->getMetaValues($postProperty->user_id, 'first_name') . ' ' . WpUserMeta::model()->getMetaValues($postProperty->user_id, 'last_name')));

		
		$userAddress = WpUserMeta::model()->getMetaValues($postProperty->user_id, 'address');
		if ($userAddress!="") {
			$this->Ln($aspTailleLigne);
			$this->SetX(102 + 3);
			$this->Text($this->GetX(), $this->GetY(),$userAddress);
		}
		if($postProperty->postal_code > 2){
			$this->Ln($aspTailleTitre);
			$this->SetX(102 + 3);
			$mypostville = WpUserMeta::model()->getMetaValues($postProperty->user_id, 'mypostville');
			$this->Text($this->GetX(), $this->GetY(), $postProperty->postal_code." ".$mypostville);
			
			$this->Ln($aspTailleTitre);
			$this->SetX(102 + 3);
			$this->Text($this->GetX(), $this->GetY(), 'FRANCE');
		}
		$this->SetFont($aspTypo, "", 9);
		$this->SetY(43 + $aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "IMMOBILIER.FR / Internet sarl");
		$this->Text($this->GetX(), $this->GetY(), "IMMOBILIER.FR");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(),"Suivi des contrats Privilège " .$SERVICE);		
		// $this->Text($this->GetX(), $this->GetY(),"105 Route des Pommiers " .$SERVICE);
		$this->Text($this->GetX(), $this->GetY(),"105 Route des Pommiers ");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "4, Rue Galvani");
		$this->Text($this->GetX(), $this->GetY(), "Centre UBIDOCA, 6287");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "75017 PARIS");
		$this->Text($this->GetX(), $this->GetY(), "74370 Saint Martin Bellevue");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "FRANCE");
		$this->SetFont($aspTypo, "B", $aspTailleTexte);
		$this->Ln($aspTailleLigne*3);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Paris, le ". date('Y-m-m'));
		
		$this->SetY(100);
		$this->SetX(25);
		$this->SetFont($aspTypo, "B", $aspTailleTexte);
		$this->Text($this->GetX(), $this->GetY(), "Recommandé avec Accusé de Réception (RAR)");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Objet : Vente de votre bien immobilier référence BTK".$property_id);
		
		$this->SetFont($aspTypo, "", $aspTailleTexte);		
		$this->Ln($aspTailleLigne*4);
		$this->SetX(30);
		$this->Text($this->GetX(), $this->GetY(), "Madame, Monsieur,");
		
		$this->Ln($aspTailleLigne*2);
		$this->SetX(30);
		
		$date_signature = $mandat->signature_date;
		if($date_signature > 0){
			$this->Text($this->GetX(), $this->GetY(), "Vous avez régularisé avec la société Immobilier.fr un contrat de diffusion en formule Privilège en date du ".$date_signature);
		} else{
			$this->Text($this->GetX(), $this->GetY(), "Vous avez régularisé avec la société Immobilier.fr un contrat de diffusion en formule Privilège");
		}
		
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "pour votre annonce immobilière [".$postProperty->type_property." de ".$postProperty->surface." m² à ".$postProperty->city."].");

		$this->Ln($aspTailleLigne);
		$this->SetX(25)	;
		$this->Text($this->GetX(), $this->GetY(), "Votre annonce a été désactivée de notre support www.immobilier.fr car votre bien a été vendu.");
					
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Selon les termes de ce contrat, vous devez communiquer l'intégralité des coordonnées du ou des acquéreur(s) à notre première");
		
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "demande et ce même si vous avez vendu votre bien à un client ne provenant pas du site www.immobilier.fr, que ce soit par");
		
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "vous-même ou par une agence.");
		
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Malgré plusieurs demandes par e-mail et par courrier simple, vous ne nous avez pas fourni ces informations.");
		
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Sachez que cette omission peut entraîner l'application de la clause pénale prévue au contrat.");
		
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Merci donc de nous adresser par retour de courrier:");
		
		$this->SetFont($aspTypo, "B", $aspTailleTexte);
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "A) Une copie de la page de votre compromis faisant apparaître l'état civil du ou des acquéreur(s) en précisant");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "au dos de la feuille les coordonnées complètes du notaire en charge de votre vente.");
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "B) Uniquement si vous avez déjà signé l'acte authentique, une attestation de votre notaire indiquant l'état civil ");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "du ou des acquéreur(s) de votre bien.");
		$this->SetFont($aspTypo, "", $aspTailleTexte);
		
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Encore une fois si votre ou vos acquéreur(s) ne proviennent pas du site www.immobilier.fr, il s'agit d'une simple formalité");
		
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "qui permettra de clore définitivement votre dossier.");
		
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Votre courrier accompagné des documents est à adresser à:");
		
		
		$this->SetFont($aspTypo, "B", $aspTailleTexte);
			
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "IMMOBILIER.FR / Internet sarl");
		$this->Text($this->GetX(), $this->GetY(), "IMMOBILIER.FR");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "Suivi des Contrats Privilège " .$SERVICE);
		$this->Text($this->GetX(), $this->GetY(), "105 Route des Pommiers " .$SERVICE);
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "4, Rue Galvani");
		$this->Text($this->GetX(), $this->GetY(), "Centre UBIDOCA, 6287");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		// $this->Text($this->GetX(), $this->GetY(), "75017 PARIS");
		$this->Text($this->GetX(), $this->GetY(), "74370 Saint Martin Bellevue");
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "FRANCE");
		
		$this->SetFont($aspTypo, "", $aspTailleTexte);
			
		$this->Ln($aspTailleLigne*2);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Pour toute(s) question(s) relative(s) à ce courrier vous pouvez nous contacter par e-mail à l'adresse suivante:");	
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "juridique@immobilier.fr, en indiquant dans l'objet de votre message la référence de votre annonce BTK".$property_id.".");
		
		$this->Ln($aspTailleLigne);
		$this->SetX(25);
		$this->Text($this->GetX(), $this->GetY(), "Ou par téléphone au ".'09.70.40.50.55'."(14h->20h L->S) - votre annonce BTK".$property_id.".");

		$this->SetLineWidth(0.5);
		$this->Line(10, 262, 200, 262);
		$this->Ln($aspTailleLigne*3);
		$this->SetFont($aspTypo, "B", $aspTailleTexte);
		$this->SetX(10);
		$this->Cell(0, $aspTailleLigne, "Immobilier.fr - 11, rue des Arts et Métiers - Lot. Dillon-Stade - 97200 Fort de France - MARTINIQUE", 0,1,"C", 0);
		$this->Cell(0, $aspTailleLigne, "SIRET : 477 654 032 00010 - APE : 744 B - Carte Transactions : 187T (délivrée par la préfecture de la Martinique)", 0,1,"C", 0);
		$this->Cell(0, $aspTailleLigne, "Capital Social : 20 001 euros - Tél : ".'09.70.40.50.55'." - E-mail : ServiceClients@immobilier.fr", 0,1,"C", 0);
		
		$this->Cell(0, $aspTailleLigne, "Immobilier.fr - SIRET : 477 654 032 00010 - APE : 744 B - Carte Transactions 187 T (délivrée par la préfecture de la Martinique)", 0,1,"C", 0);
		$this->Cell(0, $aspTailleLigne, "Garantie SOCAF 30.000 euros - Compte C.A. Martinique", 0,1,"C", 0);
		$this->Cell(0, $aspTailleLigne, "11, rue des Arts et Métiers - Lot. Dillon-Stade - 97200 Fort de France - Martinique", 0,1,"C", 0);
		
		$this->Close();
		if (isset($attrs['return'])) {
			try{
				$this->Output(Yii::getPathOfAlias('webroot')."/voidcourrier/courrier_recommande_BTK".$property_id.".pdf","F");
				return array(
					'path'		=> Yii::getPathOfAlias('webroot')."/courrier/",
					'filename'	=> "courrier_recommande_BTK".$property_id."_v1.pdf",
				);
			}catch(Exception $e){
				return false;
			}
		} else {
			$this->Output(Yii::getPathOfAlias('webroot')."/voidcourrier/courrier_recommande_BTK".$property_id.".pdf","F");
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
