<?php 
	// contactList
?>
<table align="center" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <strong>GESTION DES CATEGORIES DES EXPEDITEURS</strong>
                <br>	
                <a href="<?php echo PIUrl::createUrl('suivi_clientele/categorie');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/fermer.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;Retour</a>
                <br>
                <br>
                <form name="form" action="" method="post">
                    <strong>Ajouter un expediteur :</strong>
                    <br>
                    <table width="500" class="tdgris">
                        <input name="action" type="hidden" value="ajouter">
                        <tbody>
							<tr>
                                <td width="50%" colspan="2"></td>
                            </tr>
                            <tr>
                                <td>Prénom:</td>
                                <td><input name="ReponseContact[prenom]" type="text" size="100" maxlength="100"></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td><input name="ReponseContact[email]" type="text" size="100" maxlength="100"></td>
                            </tr>
                            <tr>
                                <td>Service:</td>
                                <td><input name="ReponseContact[service]" type="text" size="100" maxlength="100"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="47%"><input name="" class="btn" type="submit" value="Ajouter"></td>
                            </tr>
                        </tbody>
					</table>
                    <br>
                    Liste des expéditeurs :<br>
                    <table width="680" class="tdgris">

                        <tbody>
							<?php foreach($contactList as $contact) {?>
                            <tr class="table">
                                <td width="50%"><!--<a href="contact_modifier.asp?id="> --><strong><?php echo $contact['prenom'];?> - <?php echo $contact['email'];?><br><?php echo $contact['service'];?></strong><!--</a> --></td>
                                <td width="3%"><a href="<?php echo PIUrl::createUrl('suivi_clientele/contact',array('id'=>$contact['id_contact'],'action'=>'supperime'));?>" onclick="if (!confirm('Merci de confirmer la suppression du contact intitulé:\n<?php echo $contact['prenom'];?> - <?php echo $contact['service'];?>')) {
                            return false}"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/edit_delete.gif" alt="Supprimer" border="0"></a></td>
                            </tr>
							<?php } ?>
                        </tbody>
                    </table>
                </form>

            </td>
        </tr>
    </tbody>
</table> 