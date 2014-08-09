<?php	
if($etape == 1){
	$message_html = 'Madame, Monsieur,<br /><br />'
		.'Vous avez r&eacute;gularis&eacute; avec la soci&eacute;t&eacute; www.immobilier.fr un contrat de diffusion pour votre annonce r&eacute;f&eacute;rence BTK' .$property_id. ' dans la formule Privil&egrave;ge.<br />'
		.'Votre annonce a &eacute;t&eacute; d&eacute;sactiv&eacute;e de notre support www.immobilier.fr car votre bien a &eacute;t&eacute; vendu.<br /><br />'

		."Selon les termes de ce contrat, vous devez communiquer l''int&eacute;gralit&eacute; des coordonn&eacute;es du ou des acqu&eacute;reur(s) &agrave; notre premi&egrave;re demande et ce m&ecirc;me si vous avez vendu votre bien &agrave; un client ne provenant pas du site www.immobilier.fr, que ce soit par vous-m&ecirc;me ou par une agence.<br /><br />"
					
		.'Merci de nous adresser par retour de courrier:<br /><br />'
		.'<b>'
		."A) Une copie de la page de votre compromis faisant appara&icirc;tre l''&eacute;tat civil du ou des acqu&eacute;reur(s) en pr&eacute;cisant au dos de la feuille les coordonn&eacute;es compl&egrave;tes du notaire en charge de votre vente.<br /><br />"
		."B) Uniquement si vous avez d&eacute;j&agrave; sign&eacute; l''acte de vente authentique, une attestation de votre notaire indiquant l''&eacute;tat civil du ou des acqu&eacute;reur(s) de votre bien.'
		.'</b><br /><br />"

		."Si votre ou vos acqu&eacute;reur(s) ne proviennent pas du site www.immobilier.fr, il s''agit d''une simple formalit&eacute; qui permettra de clore d&eacute;finitivement votre dossier.<br /><br />"

		.'Votre courrier accompagn&eacute; des documents est &agrave; adresser &agrave;:<br /><br />'

		.'<B>INTERNET SARL / (IMMOBILIER.FR)<br />'
		.'(Suivi des contrats Privilege)<br />'
		.'4, Rue Galvani<br />'
		.'75017 PARIS<br />'
		.'FRANCE</B><br /><br />'

		."Pour toute(s) question(s) relative(s) &agrave; ce courrier vous pouvez nous contacter par e-mail &agrave; l''adresse suivante:<br />"


		."<a href='mailto:juridique@immobilier.fr'>juridique@immobilier.fr</a>, en indiquant dans l''objet de votre message la r&eacute;f&eacute;rence de votre annonce BTK".$property_id.".<br /><br />"
		."Dans l''attente de vous lire, je vous transmets mes sinc&egrave;res salutations.<br /><br />Tel. 09.70.40.50.55<br /><br />";
} elseif($etape == 2){
	$message_html = "La génération du courrier simple a échouée -> <a href='http://www.immobilier.fr/back-office/index.asp?id_m=".$property_id."'>référence BTK".$property_id."</a>";
} elseif($etape == 3){
	$message_html = "La génération du courrier recommandé a échouée -> <a href='http://www.immobilier.fr/back-office/index.asp?id_m=".$property_id."'>référence BTK".$property_id."</a>";
}
echo $body =
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
				.'<html>'
				.'<head>'
				.'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">'
				.'<title>Courriel Immobilier.fr</title>'
				.'</head>'
				.'<body bgcolor="#FFFFFF">'
				.'<style type="text/css">'
				.'body {'
					.'font-family: 3D"Microsoft Sans Serif", Arial;'
					.'font-size: 12px;'
				.'}'
				.'</style>'

				.'<div align="center"><font size="-2">'
				.'Pour &ecirc;tre s&ucirc;r de recevoir les mails de <a href="http://www.immobilier.fr/" target="_blank">www.immobilier.fr</a>,<br />'
				."nous vous recommandons d''ajouter <a href='mailto:".$emailsend."'>".$emailsend."</a> dans votre carnet d''adresses."
				.'</font></div>'

				.'<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">'
					.'<tr>'
						.'<td width="600" height="57" colspan="8">'
						.'<img src="http://www.immobilier.fr/mail/Mail_header.jpg" width="600" height="57" border="0" alt="">'
						.'</td>'
					.'</tr>'
					.'<tr>'
						.'<td><IMG SRC="http://www.immobilier.fr/mail/Mail_02.jpg" ALT="" border="0"></td>'
						.'<td><a href="http://www.immobilier.fr/m/vente/ventes-immobilieres.html" title="Vente immobili&egrave;re" target="_blank"><IMG SRC="http://www.immobilier.fr/mail/Mail_03.jpg" ALT="" border="0"></a></td>'
						.'<td><a href="http://www.immobilier.fr/m/achat/achat-immobilier.html" title="Achat immobilier" target="_blank"><IMG SRC="http://www.immobilier.fr/mail/Mail_04.jpg" ALT="" border="0"></a></td>'
						.'<td><a href="http://www.immobilier.fr/m/location/location.html" title="Location" target="_blank"><IMG SRC="http://www.immobilier.fr/mail/Mail_05.jpg" ALT="" border="0"></a></td>'
						.'<td><a href="http://credit.immobilier.fr/" title="Cr&eacute;dit immobilier" target="_blank"><IMG SRC="http://www.immobilier.fr/mail/Mail_06.jpg" ALT="" border="0"></a></td>'
						.'<td><a href="http://www.immobilier.fr/m/contact/" title="Nous contacter" target="_blank"><IMG SRC="http://www.immobilier.fr/mail/Mail_07.jpg" ALT="" border="0"></a></td>'
						.'<td><a href="http://clients.immobilier.fr/" title="Espace client" target="_blank"><IMG SRC="http://www.immobilier.fr/mail/Mail_08.jpg" ALT="" border="0"></a></td>'
						.'<td><IMG SRC="http://www.immobilier.fr/mail/Mail_09.jpg" ALT="" border="0"></td>'
					.'</tr>'

					.'<tr>'
						.'<td width="600" background="http://www.immobilier.fr/mail/Mail_content.jpg" colspan="8">'
						.'<table width="100%" border="0" cellpadding="0" cellspacing="0">'
						.'<tr>'
							.'<td width="60">&nbsp;</td>'
							.'<td width="480">'
								.'<br /><br /><br />'
								. $message_html
								.'<br /><br /></td>'
						.'	<td width="60">&nbsp;</td>'
						.'</tr>'
						.'</table>'
						.'</td>'
					.'</tr>'
					.'<tr>'
						.'<td width="600" height="54" valign="bottom" colspan="8">'
						.'<img src="http://www.immobilier.fr/mail/Mail_footer.jpg" width="600" height="55" border="0" alt="">'
						.'<div align="center" valign="bottom"><a href="http://www.immobilier.fr" style="text-decoration:none;"><font color="#EDB329" size="-1"> &copy; 2008 Copyright Immobilier.fr - Tous droits r&eacute;serv&eacute;s </font></a></div>'
						.'</td>'
					.'</tr>'
				.'</table>'
				.'</body>'
				.'</html>';
				?>