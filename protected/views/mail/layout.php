<div align='center'>
	<font size='-2'>Pour être sûr de recevoir les mails de
		<a target='_blank' href='http://www.immobilier.fr/'>www.immobilier.fr</a>,<br>nous vous recommandons de rajouter 
		<a target='_blank' href='mailto:<?php echo $serverMail;?>'><?php echo $serverMail;?></a> dans votre carnet d'adresses.
	</font>
</div>
<table width='600' cellspacing='0' cellpadding='0' border='0' align='center'>
	<tbody>
		<tr>
			<td width='600' height='57' colspan='8'><img width='600' height='57' border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_header.jpg'></td>
		</tr>
		<tr>
			<td><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_02.jpg'></td>
			<td><a target='_blank' title='Vente immobilière' href='http://www.immobilier.fr/m/vente/ventes-immobilieres.html'><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_03.jpg'></a></td>
			<td><a target='_blank' title='Achat immobilier' href='http://www.immobilier.fr/m/achat/achat-immobilier.html'><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_04.jpg'></a></td>
			<td><a target='_blank' title='Location' href='http://www.immobilier.fr/m/location/location.html'><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_05.jpg'></a></td>
			<td><a target='_blank' title='Credit immobilier' href='http://credit.immobilier.fr/'><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_06.jpg'></a></td>
			<td><a target='_blank' title='Nous contacter' href='http://www.immobilier.fr/m/contact/'><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_07.jpg'></a></td>
			<td><a target='_blank' title='Espace client' href='http://clients.immobilier.fr/'><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_08.jpg'></a></td>
			<td><img border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_09.jpg'></td>
		</tr>
		<tr>
			<td width='600' background='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_content.jpg' colspan='8'>
				<table width='100%' cellspacing='0' cellpadding='0' border='0'>
					<tbody>
						<tr>
							<td width='60'>&nbsp;</td>
							<td width='480'><?php echo $this->renderInternal(Yii::getPathOfAlias(Yii::app()->mail->viewPath.'.'.$view).'.php',$data)?></td>
							<td width='60'>&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td width='600' valign='bottom' height='54' colspan='8'>
				<img width='600' height='55' border='0' alt='' src='<?php echo $this->baseHostPlugin;?>/front-end/library/images/email/Mail_footer.jpg'>
				<div align='center' valign='bottom'><a target='_blank' style='text-decoration:none' href='http://www.immobilier.fr'><font size='-1' color='#EDB329'> &copy; 2008 Copyright Immobilier.fr - Tous droits réservés </font></a></div>
			</td>
		</tr>
	</tbody>
</table>