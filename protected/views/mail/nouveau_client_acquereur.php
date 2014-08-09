<?php $userInfo = WpUser::model()->findByAttributes(array('ID'=>$property->user_id)); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td width="60">&nbsp;</td>
<td width="480">
<br><br><br>
Cher(e) client(e),<br><br>Conformément à notre contrat de diffusion, merci de trouver les coordonnées d'un candidat acquéreur intéressé par votre bien référence <strong>BTK<?php echo $property->id;?></strong>:<br><br><?php echo $buyer->customer_gender." ".$buyer->customer_name;?><br>
E-mail: <strong><a href="mailto:<?php echo $buyer->customer_email?>" target="_blank"><?php echo $buyer->customer_email?></a></strong><div class="im"><br>
<?php 
$customer_tel = trim($buyer->customer_tel);
if (!empty($customer_tel)){ echo "Téléphone fixe: ".$customer_tel;} ?>
<br>
<?php $customer_phone = trim($buyer->customer_phone);
if(!empty($customer_phone)){ echo "Téléphone portable: ".$customer_phone;} ?>
<br>Merci de contacter cette personne au plus tôt pour une visite de votre bien.<br><br>Sachez que vous pouvez consulter la liste des clients acquéreurs inscrits sur votre annonce, directement à partir de votre espace client :<br>
<br><center><a href="<?php echo Yii::app()->request->hostInfo.'/accesmembres/?loginUser='.hashCrypte($property->user_id).'&actionTo=mycustomer&hash='.sha1($userInfo->user_email).'&property_id='.$property->id;?>">&gt;&gt; Cliquez ici pour acceder à votre espace client</a></center>
<br><br>
<?php
$check = WpListCustomer::model()->findByAttributes(array('post_property_id' => $property->id));
if (!empty($check)) {
	if (empty($check->operator)) { ?>
	<p style="background:#fff;border-top:2px solid #e05c51;border-bottom:2px solid #e05c51;text-align:left;padding:5px 5px 5px 5px;color:#555;font-size:10px"><strong>Le site <a href="http://immobilier.fr" target="_blank">immobilier.fr</a> fait toutes les diligences nécessaires pour vérifier la qualité de sa clientèle ainsi qu'éviter le démarchage par des professionnels de l'immobilier.</strong><br>
Il est cependant possible que des professionnels de l'immobilier ou des clients indélicats se glissent malgré nos efforts dans nos annonces.<br><br>Vous pouvez donc être exceptionnellement confronté:<br>1) à des professionnels de l'immobilier.<br>
2) à des clients indélicats se présentant comme des acquéreurs mais visant à soutirer illégalement des sommes d'argent ou des informations personnelles.<br><br>Dans le but de préserver vos intérêts et de maintenir la qualité du site nous vous demandons de nous signaler au plus vite toute personne entrant dans l'une de ces deux catégories et qui vous serait transmise par le site <a href="http://immobilier.fr" target="_blank">immobilier.fr</a>, afin que nous puissions prendre les mesures nécessaires.<br>
<b>Pour nous signaler la présence d'un client indélicat, veuillez cliquer sur le lien suivant:</b><br></p>
	<?php }
}
?>
<center><a href="<?php echo Yii::app()->request->hostInfo.'/accesmembres/?loginUser='.hashCrypte($seller['ID']).'&actionTo=mycustomer&hash='.sha1($userInfo->user_email).'&property_id='.$property->id;?>" target="_blank">&gt;&gt; Cliquez ici pour nous signaler ce client comme indélicat</a></center>
<p></p>Toute l'équipe d'<a href="http://immobilier.fr" target="_blank">immobilier.fr</a> vous souhaite une bonne transaction.
</div></td>