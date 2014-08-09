<style type="text/css">
    .container table textarea, .container table input[type|=text]{width: 600px;}
    .container table textarea{height: 300px;}
    .container table select{width: auto;}
</style>
<table align="center" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <strong>AJOUTER UN MESSAGE</strong> 
                <br>
                <br>

                <a href="<?php echo PIUrl::createUrl('suivi_clientele/categorie');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/fermer.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;Retour</a>

                <br>

                <br>
				<?php if (isset($_GET['id'])) {?>
					<form name="form" action="<?php echo PIUrl::createUrl('suivi_clientele/message',array('id'=>1,'id_message'=>$_GET['id']));?>" method="post">
				<?php } else {?>
					<form name="form" action="<?php echo PIUrl::createUrl('suivi_clientele/message',array('id'=>1,'action'=>'addnew'));?>" method="post">
				<?php } ?>
                    <input name="action" type="hidden" value="editer">
                    <table width="800" class="tdgris">
                        <tbody><tr>
                                <td width="50%" align="right">Catégorie :</td>
                                <td width="50%">
                                    <select name="ReponseMessage[id_categorie]" class="input">
										<?php foreach($categoryList as $category) {?>
                                        <option value="<?php echo $category['id_categorie'];?>" <?php if ($category['id_categorie']==$model['id_categorie']) { echo 'selected="selected"'; } ?>><?php echo $category['titre'];?></option>
										<?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" align="right">Service d'expedition :</td>
                                <td width="50%">
                                    <select name="ReponseMessage[id_contact]" class="input">
										<?php foreach($contactList as $contact) {?>
                                        <option value="<?php echo $contact['id_contact'];?>" <?php if ($contact['id_contact']==$model['id_contact']) { echo 'selected="selected"'; } ?>><?php echo $contact['prenom'];?> - <?php echo $contact['service'];?></option>
										<?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%" align="right"><strong>Titre/Objet du message :</strong></td>
                                <td width="50%"><input name="ReponseMessage[titre]" type="text" size="75" maxlength="200" value="<?php echo $model['titre'];?>"></td>
                            </tr>
                            <!--<tr>
                                    <td width="50%" align="right"><strong>Objet :</strong></td>
                                    <td width="50%"><input name="objet" type="text" size="100" maxlength="200"></td>
                            </tr> -->
                            <tr>
                                <td width="50%" align="right"><strong>Contenu du message :</strong></td>
                                <td width="50%">
                                    <p class="info">
                                        Possibilité d'insérer le code dans le message pour remplacer :<br>
                                        <br>
                                        la référence annonce : [#REF]
                                        <br>
                                        le mail du client : [#EMAIL]
                                        <br>
                                        le mot de passe du client : [#PASS]
                                        <br>
                                        le detail annonce : [#DETAIL]
                                        <br>
                                        le lien vers le detail annonce : [#URL]
                                        <br>
                                    </p>
                                    <textarea name="ReponseMessage[contenu]" cols="76" rows="15"><?php echo $model['contenu'];?></textarea>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                    <td width="50%"><strong>Prénom de l'expéditeur</strong></td>
                                    <td width="50%"><input name="prenom" type="text" size="100" maxlength="100"></textarea></td>
                            </tr>
                            -->
                            <tr>
                                <td width="50%" colspan="2" align="center"><input name="" type="submit" value="<?php if (isset($_GET['id'])) {echo 'Modifier';} else { echo 'Ajouter';}?>" class="input"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>
    </tbody>
</table>