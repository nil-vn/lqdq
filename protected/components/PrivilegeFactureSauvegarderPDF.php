<?php

define('FRONTEND_APP_DIR', dirname(__FILE__) . '/../../../wp-content/plugins/immobilier/front-end/application/');
require_once(FRONTEND_APP_DIR . 'components/tcpdf/tcpdf.php');

/**
 * Generate Premium Facture PDF
 * @author thanhvv
 */
class PrivilegeFactureSauvegarderPDF extends TCPDF {

    public $footer_line_color = array(255, 255, 255);

    public function __construct() {
        parent::__construct();
    }

    public function exportPDF($attrs = array()) {
        $aspTypo = "helvetica";
        $aspTailleTitre = 16;
        $aspTailleSousTitre = 14;
        $aspTailleTexte = 12;
        $aspTailleLigne = 6;
        $aspTailleInterLigne = $aspTailleLigne;
        $aspTailleLigneTitre = 8;
        $aspYDebut = 40;

        $id = $attrs['id'];
        $data = $attrs['data'];

        $client_nom = $data->client_lastname;
        $client_prenom = $data->client_firstname;
        $client_adresse1 = $data->client_address1;
        $client_adresse2 = $data->client_address2;
        $client_cp = $data->client_cp;
        $client_ville = $data->client_city;

        $acquereur_genre = $data->purchaser_kind;
        $acquereur_nom = $data->purchaser_lastname;
        $acquereur_prenom = $data->purchaser_firstname;

        $prix_vente = $data->sale_price;
        $commission = $data->commission;
        $honoraire_ttc = $data->honorary_ttc;
        $remise = $data->discount_ttc;
        $ladate = $data->creation_date;

        // '***********************
        // '* DONNEES DU PAIEMENT *
        // '***********************
        // 'PRIX T.T.C.
        $pttc = $honoraire_ttc;
        //dump($pttc); exit();
        // 'PRIX H.T.
        $pht = round($pttc / 1.196, 2);
        // 'T.V.A.
        $tva = round($pttc - $pht, 2);

        // 'TOTAL TTC
        //$pttc = number_format($pttc);
        //dump($pptc); exit();
        // '----------------------------------------------------------------------
        // ' DEBUT FICHIER PDF
        // ' Définition des constantes de la page
        // '    - taille du texte
        // '    - taille de l'interligne (ligne vide)
        // '    - etc.
        $aspTypo = "helvetica";
        $aspTailleTitre = 10;
        $aspTailleSousTitre = 9;
        $aspTailleTexte = 9;
        $aspTailleLigne = 4;
        $aspTailleInterligne = $aspTailleLigne;
        $aspTailleLigneTitre = 6;
        $aspYdebut = 40;

        $this->SetTitle("Immobilier.fr - Facture Privilège n°" . $id);
        $this->SetAuthor("Immobilier.fr");
        $this->SetPrintHeader(false);
        $this->SetFooterMargin(13);
        $this->SetAuthor("Immobilier.fr");
        $this->SetSubject("Accord de diffusion d'une annonce de vente immobilière sur Internet");
        $this->Open();
        $this->AddPage();

        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->SetTextColor(0, 0, 0);

        $this->SetFillColor(239, 239, 239);
        $this->SetY($aspYDebut + 6);

        $this->Image(Yii::getPathOfAlias('webroot') . "/pdf/images/immobilier.fr.jpg", 15, 3, 180, 25);

        $this->SetDrawColor(239, 239, 239);
        $this->SetLineWidth(0.5);
        $this->Line(10, 27, 200, 27);

        // 'CADRE ADRESSE DU DESTINATAIRE
        $this->SetFillColor(255, 255, 255);
        $this->RoundedRect(10, 43, 190, 90, 2, '1111', "FD"); // 'cadre blanc interne


        $this->SetFont($aspTypo, "B", $aspTailleTitre);
        // '$this->Ln(aspTailleLigne*4)
        $this->SetX(25);
        $this->SetY(36);
        $this->Text($this->GetX(), $this->GetY(), "FACTURE N°" . $id);


        // '*************************
        // 'SOCIETE
        $this->SetY(46);
        $this->Text($this->GetX() + 3, $this->GetY(), "Société");

        $this->SetFont($aspTypo, "", $aspTailleTexte);

        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "Immobilier.fr");
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "11 rue des Arts et Métiers");
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "Lotissement Dillon");
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "97200 Fort de France");

        $this->Ln($aspTailleLigne * 2);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 3, $this->GetY(), "Téléphones");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "05 96 42 57 90 (13h - 21h)");
        $this->Ln($aspTailleLigne);
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Text($this->GetX() + 3, $this->GetY(), "Service France Métropolitaine");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "09 65 31 31 79 (8h - 19h)");
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "Fax");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "05 96 42 57 58");

        $this->Ln($aspTailleLigne * 3);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 3, $this->GetY(), "SIRET");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "47765403200010");

        $this->Ln($aspTailleLigne);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 3, $this->GetY(), "APE");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "744B");

        $this->Ln($aspTailleLigne);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 3, $this->GetY(), "CARTE TRANSACTION");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 3, $this->GetY(), "T 187 transaction sur immeuble et fonds de commerce");

        // '*************************************
        // 'INFO CLIENT
        $this->SetY(50);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 107, $this->GetY(), "Client(s) Vendeur(s)");
        $this->SetFont($aspTypo, "", $aspTailleTexte);

        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 107, $this->GetY(), $client_prenom . " " . strtoupper($client_nom));
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 107, $this->GetY(), $client_adresse1);
        if (strlen($client_adresse2) > 2) {
            $this->Ln($aspTailleLigne);
            $this->Text($this->GetX() + 107, $this->GetY(), $client_adresse2);
        }
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 107, $this->GetY(), $client_cp . " " . strtoupper($client_ville));

        $this->Ln($aspTailleLigne * 2);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 107, $this->GetY(), "Référence annonce :");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 107, $this->GetY(), "BTK" . $data->post_property_id);

        $this->Ln($aspTailleLigne * 2);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 107, $this->GetY(), "Acquéreurs :");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne);
        $this->Text($this->GetX() + 107, $this->GetY(), $acquereur_genre . " " . $acquereur_prenom . " " . $acquereur_nom);

        $this->Ln($aspTailleLigne * 8);
        $this->SetFont($aspTypo, "B", $aspTailleTexte);
        $this->Text($this->GetX() + 107, $this->GetY(), "Date :");
        $this->SetFont($aspTypo, "", $aspTailleTexte);
        $this->Ln($aspTailleLigne - 4);
        $this->Text($this->GetX() + 117, $this->GetY(), substr($ladate, 0, 10));

        $this->Ln($aspTailleLigne * 4);
        $this->SetY($this->GetY() + 8);
        // '***************************************************************************************
        $this->SetFillColor(239, 239, 239);

        $this->RoundedRect($this->GetX() + 0.1, $this->GetY() + 0.1, 189.8, 8, 2, '1111', "F");

        if ($remise <> 0) {
            $this->RoundedRect($this->GetX(), $this->GetY(), 190, 26, 2, '1111', "");
        } else {
            $this->RoundedRect($this->GetX(), $this->GetY(), 190, 18, 2, '1111', "");
        }

        $this->SetY($this->GetY() + 2);
        $this->SetFont($aspTypo, "BI", $aspTailleSousTitre);
        $this->Cell(90, $aspTailleLigne, "Désignation", 0, 0, "L", 0);
        $this->Cell(32, $aspTailleLigne, "Prix de vente", 0, 0, "R", 0);
        $this->SetX($this->GetX() + 2);
        $this->Cell(32, $aspTailleLigne, "Commission", 0, 0, "C", 0);
        $this->SetX($this->GetX() + 2);
        $this->Cell(32, $aspTailleLigne, "Honoraire TTC", 0, 0, "C", 0);


        $this->SetY($this->GetY() + $aspTailleLigne + $aspTailleInterLigne - 1);

        $this->SetFont($aspTypo, "", $aspTailleSousTitre);

        $this->Cell(90, $aspTailleLigne, "Honoraire sur la vente", 0, 0, "L", 0);
        // '$this->SetFont aspTypo, "B", aspTailleSousTitre
        $this->Cell(30, $aspTailleLigne, number_format($prix_vente, 2), 0, 0, "R", 0);
        $this->Cell(2, $aspTailleLigne, "€", 0, 0, "L", 0);
        $this->SetX($this->GetX() + 2);
        //dump(number_format(($prix_vente*($commission/100)),2)); exit();
        // 'Commission fixe
        if (is_numeric($commission)) {
            //$this->Cell(32, $aspTailleLigne, number_format($commission, 1), 0, 0, "C", 0);
            $this->Cell(18, $aspTailleLigne, number_format($commission, 1), 0, 0, "R", 0);
            $this->Cell(2, $aspTailleLigne, "%", 0, 0, "L", 0);
        }
        // 'Commission négociée
        else {
            $this->Cell(32, $aspTailleLigne, "", 0, 0, "C", 0);
            $this->Text($this->GetX() - 23, $this->GetY() + 0, "Forfaitaire");
            $this->Text($this->GetX() - 30, $this->GetY() + 0, "(suite négociations)");
        }

        $this->SetX($this->GetX() + 2);
        $this->Cell(55, $aspTailleLigne, number_format($pttc, 2), 0, 1, "C", 0);

        $this->Cell(190, $aspTailleLigne, "", 0, 1, "L", 0); //'ligne vide*2
        // ' REMISE
        if ($remise <> 0) {
            $this->Cell(90, $aspTailleLigne, "Remise exceptionnelle", 0, 0, "L", 0);
            // '$this->SetFont aspTypo, "B", aspTailleSousTitre
            $this->Cell(32, $aspTailleLigne, "", 0, 0, "R", 0);
            $this->SetX($this->GetX() + 2);

            $this->Cell(32, $aspTailleLigne, "", 0, 0, "C", 0);
            $this->SetX($this->GetX() + 2);

            $this->Cell(32, $aspTailleLigne, "- " & number_format(remise, 2), 0, 1, "C", 0);

            $this->Cell(190, $aspTailleLigne * 2, "", 0, 1, "L", 0); //'ligne vide*2
        } else {
            $this->Cell(190, $aspTailleLigne, "", 0, 1, "L", 0); //'ligne vide*2
        }

        // '*******************************************************************************************
        // 'CADRE TOTAL
        // 'total ht
        $this->RoundedRect($this->GetX(), $this->GetY() - 1, 190, 15, 2, "");
        $this->RoundedRect($this->GetX() + 0.1, $this->GetY() + $aspTailleLigne * 2, 189.8, $aspTailleLigne + 2, 2, '1111', "F");
        // 'separation
        $this->Line(170, $this->GetY() - 1, 170, $this->GetY() + 14);

        $this->SetFont($aspTypo, "", $aspTailleSousTitre);
        $this->Cell(132, $aspTailleLigne, "", 0, 0, "L", 0);
        $this->Cell(26, $aspTailleLigne, "Honoraire H.T", 0, 0, "R", 0);
        $this->Cell(23, $aspTailleLigne, number_format($pht, 2), 0, 0, "R", 0);
        $this->Cell(5, $aspTailleLigne, "€", 0, 1, "L", 0);

        // 'tva
        $this->SetFont($aspTypo, "", $aspTailleSousTitre);
        $this->Cell(132, $aspTailleLigne, "", 0, 0, "L", 0);
        $this->Cell(26, $aspTailleLigne, "T.V.A. (19,6%)", 0, 0, "R", 0);
        $this->Cell(23, $aspTailleLigne, number_format($tva, 2), 0, 0, "R", 0);
        $this->Cell(5, $aspTailleLigne, "€", 0, 1, "L", 0);
        // 'total ttc
        $this->SetY($this->GetY() + 1);
        $this->SetFont($aspTypo, "B", $aspTailleSousTitre);
        $this->Cell(132, $aspTailleLigne, "", 0, 0, "L", 0);
        $this->Cell(26, $aspTailleLigne, "Honoraire T.T.C.", 0, 0, "R", 0);
        $this->Cell(23, $aspTailleLigne, number_format($pttc, 2), 0, 0, "R", 0);
        $this->Cell(5, $aspTailleLigne, "€", 0, 1, "L", 0);


        // '----------------------------------------------------------------------------------------------
        // ' Détail de Reglement
        // '
        $this->Ln($aspTailleLigne * 4);
        // '$this->SetFont aspTypo, "B", aspTailleSousTitre
        $this->Cell(190, $aspTailleLigne, "Payable par virement bancaire sur le compte d'Immobilier.fr (RIB en annexe)", 0, 1, "L", 0);
        $this->Cell(190, $aspTailleLigne, "", 0, 1, "L", 0);
        $this->Ln($aspTailleLigne);

        $this->SetTextColor(151, 0, 0);
        $this->SetFont("Helvetica", "U", 62);
        // $this->RotatedText (55,190,"Facture Annulée",45);
        $this->SetTextColor(0, 0, 0);

        // 'pied de page
        // '**********************************************************************************************
        // 'FOOTER
        $this->SetLineWidth(0.5);
        $this->Line(10, 258, 200, 258);
        $this->SetY(260);
        $this->SetFont($aspTypo, "", 7);

        $this->Cell(0, $aspTailleLigne - 2, "Immobilier.fr - 11, rue des Arts et Métiers - Lot. Dillon-Stade - 97200 Fort de France - MARTINIQUE", 0, 1, "C", 0);
        $this->Cell(0, $aspTailleLigne - 2, "SIRET : 477 654 032 00010 - APE : 744 B - Carte Transactions : 187T (délivrée par la préfecture de la Martinique)", 0, 1, "C", 0);
        $this->Cell(0, $aspTailleLigne - 2, "Capital Social : 20 001 euros - Tél : 09.70.40.50.55 - E-mail : ServiceClients@immobilier.fr", 0, 1, "C", 0);

        $this->Line(10, 278, 200, 278);

        $this->Close();
        if (isset($attrs['return'])) {
            try {
                $this->Output(Yii::getPathOfAlias('webroot') . "/factures/facture_privilege_" . $id . ".pdf", "F");
                return array(
                    'path' => Yii::getPathOfAlias('webroot') . "/factures/",
                    'filename' => "facture_privilege_" . $id . ".pdf",
                );
            } catch (Exception $e) {
                return false;
            }
        } else {
            $this->Output(Yii::getPathOfAlias('webroot') . "/factures/facture_privilege_" . $id . ".pdf", "F");
        }
    }

    public function Footer() {
        $aspTypo = "helvetica";
        $cur_y = $this->y;
        $this->SetTextColorArray($this->footer_text_color);
        $this->SetFontSize(9);
        $this->SetFont($aspTypo, "i", 8);
        //set style for cell border
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
        //print document barcode
        $barcode = $this->getBarcode();
        if (!empty($barcode)) {
            $this->Ln($line_width);
            $barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
            $style = array(
                'position' => $this->rtl ? 'R' : 'L',
                'align' => $this->rtl ? 'R' : 'L',
                'stretch' => false,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => false,
                'padding' => 0,
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false,
                'text' => false
            );
            $this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
        }
        $w_page = isset($this->l['w_page']) ? $this->l['w_page'] . ' ' : '';
        if (empty($this->pagegroups)) {
            $pagenumtxt = 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages();
        } else {
            $pagenumtxt = 'Page ' . $this->getPageNumGroupAlias() . '/' . $this->getPageGroupAlias();
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

    protected function date_createdPDF() {
        switch (date('D')) {
            case "Mon" : $day = "lundi";
                break;
            case "Tue" : $day = "mardi";
                break;
            case "Wed" : $day = "mercredi";
                break;
            case "Thu" : $day = "jeudi";
                break;
            case "Fri" : $day = "vendredi";
                break;
            case "Sat" : $day = "samedi";
                break;
            case "Sun" : $day = "dimanche";
                break;
        }
        switch (date('M')) {
            case "Jan" : $month = "janvier";
                break;
            case "Feb" : $month = "février";
                break;
            case "Mar" : $month = "mars";
                break;
            case "Apr" : $month = "quatre mois";
                break;
            case "May" : $month = "mai";
                break;
            case "Jun" : $month = "juin";
                break;
            case "Jul" : $month = "juillet";
                break;
            case "Aug" : $month = "août";
                break;
            case "Sep" : $month = "septembre";
                break;
            case "Oct" : $month = "octobre";
                break;
            case "Nov" : $month = "novembre";
                break;
            case "Dec" : $month = "décembre";
                break;
        }
        $date = $day . " " . date('d') . " " . $month . " " . date('Y') . " " . date('H:i:s');
        return $date;
    }

}
