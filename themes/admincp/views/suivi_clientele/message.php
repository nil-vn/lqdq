<?php
// category
// messageList
?>
<table align="center" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <strong>GESTION DES MESSAGES</strong> 
                <br>
                <br>
                <form name="form" action="" method="post">
                    <a href="<?php echo PIUrl::createUrl('suivi_clientele/categorie');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/fermer.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;Retour</a>
                    <br>
                    <table width="670px" class="tdgris">
                        <input name="ReponseCategory[id_categorie]" type="hidden" value="9">
                        <tbody>
                            <tr>
                                <td>Modifier la catégorie:<br />
                                    <input name="ReponseCategory[titre]" style="width:600px" type="text" size="200" maxlength="100" value="<?php echo $category['titre'];?>"></td>
                                <td width="3%"><br><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/edit_add.gif" onclick="document.form.submit()" align="absmiddle" border="0"></a></td>
                            </tr>
                            <tr>
                                <td width="50%" colspan="2" align="center">
                                    <input name="" type="button" value="Ajouter un message" onclick="location.replace('<?php echo PIUrl::createUrl('suivi_clientele/add_message')?>')" class="input">
                                    &nbsp;&nbsp;
                                    <input name="" type="button" value="Ajouter un contact" onclick="location.replace('<?php echo PIUrl::createUrl('suivi_clientele/contact')?>')" class="input">
                                </td>
                            </tr>
                        </tbody>
					</table>
                    <br>
                    <br>
                    <table width="670px" class="tdgris" class="table table-bordered">
                        <tbody>
							<?php foreach($messageList as $message) { ?>
							<tr>
                                <td><a href="<?php echo PIUrl::createUrl('suivi_clientele/message_editer',array('id'=>$message['id_message']));?>"><strong><?php echo $message['titre'];?></strong></a></td>
                                <td width="3%"><a href="<?php echo PIUrl::createUrl('suivi_clientele/message',array('id'=>$category['id_categorie'],'id_message'=>$message['id_message'],'action'=>'supperime'));?>" onclick="if (!confirm('Merci de confirmer la suppression du message intitulée:\n<?php echo $message['titre'];?>')){return false}"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/edit_delete.gif" alt="Supprimer" border="0"></a></td>
                            </tr>
							<?php } ?>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>
    </tbody>
</table>