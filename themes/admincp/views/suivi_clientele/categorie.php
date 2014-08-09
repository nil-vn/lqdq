<?php
	// $model
?>
<table align="center" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <fieldset>
                    <legend>
                        <strong>GESTION DES CATEGORIES DE MESSAGES</strong>
                    </legend>
                    <br>
                    <br>
                    <form name="form" action="" method="post">
                        <a href="<?php echo PIUrl::createUrl('suivi_clientele');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/fermer.gif" width="19" height="14" border="0" align="absmiddle">&nbsp;Retour index</a>&nbsp;&nbsp;
                        <a href="<?php echo PIUrl::createUrl('suivi_clientele/add_message')?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/email.gif" width="19" height="14" border="0" align="absmiddle">&nbsp;Ajouter un message</a>&nbsp;&nbsp;
                        <a href="<?php echo PIUrl::createUrl('suivi_clientele/contact')?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/contact.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;Ajouter un contact</a>
                        <table width="500">
                            <input name="action" type="hidden" value="ajouter">
                            <tbody>
                                <tr>
                                    <td width="97%"><strong>Ajouter une catégorie :</strong><br><input name="titre" type="text" size="100" style="width:460px" maxlength="100"></td>
                                    <td width="3%"><br><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/edit_add (2).gif" onclick="if (document.form.titre.value == ''){alert('Merci de saisir le titre de la catégorie à ajouter.')} else{document.form.submit()}" align="absmiddle" border="0" alt="Ajouter à la liste"></a></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <br>
                                        <br><strong>Liste des catégories de messages :</strong></td>
                                </tr>
								<?php foreach($model as $category) { ?>
                                <tr class="table">
                                    <td><a href="<?php echo PIUrl::createUrl('suivi_clientele/message',array('id'=>$category['id_categorie']));?>"><strong><?php echo $category['titre'];?></strong></a></td>
                                    <td><a href="<?php echo PIUrl::createUrl('suivi_clientele/categorie',array('id'=>$category['id_categorie'],'action'=>'supperime'));?>" onclick="return confirm('Merci de confirmer la suppression de la catégorie intitulée: <?php echo $category['titre'];?>');"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/edit_delete.gif" alt="Supprimer" border="0"></a></td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
                    </form>
                </fieldset>
            </td>
        </tr>
    </tbody>
</table>