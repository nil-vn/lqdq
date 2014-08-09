<?php
$mypostvillec = getUserMeta($userMetas, 'mypostville');
if ($mypostvillec != '' && $mypostvillec != 0)
{
    $mypostvilleS = explode('_', $mypostvillec);
    $mypostvilleS = $mypostvilleS[count($mypostvilleS) - 1] . ' ' . $mypostvilleS[0];
} else
{
    $mypostvilleS = getUserMeta($userMetas, 'address');
    if ($mypostvilleS == '')
    {
        $mypostvilleS = getUserMeta($userMetas, 'additionaladdress');
    }
}
?>

<form name="fpagesblanches" id="fpagesblanches" method="post" action="http://www.pagesjaunes.fr/pagesblanches/RecherchePagesBlanchesExpress.do" target="_blank" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="portail" value="PJ">
    <input type="hidden" name="nom" value="<?php echo getUserMeta($userMetas, 'first_name'); ?>">
    <input type="hidden" name="ou" value="<?php echo $mypostvilleS; ?>">
    <input type="image" src="<?php echo Yii::app()->baseUrl; ?>/images/pagesblanches.jpg" style="width:51px; height:33px; border:0px">
</form>
<div class="immobilierHomeDiv"><strong>Inscrit le <?php echo date(Yii::app()->params['datetime'], strtotime($model->user->user_registered)); ?></strong> <br />Dernière connexion le <strong><?php echo date(Yii::app()->params['datetime'], strtotime(getUserMeta($userMetas, 'last_login_time'))); ?></strong></div>
<p class="immobilierHomeDiv"><strong><?php echo getUserMeta($userMetas, 'landline'); ?> <br /> <!--<a href="#">> Connexion à l'espace client <</a>--></strong></p>
<div class="cls"></div>
<form class="form-horizontal well" id="saveUserForm">
    <input type="hidden" name="WpUser[id]" value="<?php echo $model->user->ID; ?>"/>
    <input type="hidden" name="WpUser[property_id]" value="<?php echo $model->id; ?>"/>
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_first_name">Nom *</label>
            <div class="controls">
                <input name="WpUserMeta[first_name]" value="<?php echo getUserMeta($userMetas, 'first_name'); ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_first_name" data-original-title="Nom">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_last_name">Prénom *</label>
            <div class="controls">
                <input name="WpUserMeta[last_name]" value="<?php echo getUserMeta($userMetas, 'last_name'); ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_last_name" data-original-title="Prénom">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_email">E-mail * </label>
            <div class="controls">
                <input name="WpUser[user_email]" value="<?php echo $model->user->user_email; ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_email" data-original-title="E-mail">
                <p class="help-block">
                    <?php $this->renderPartial('btn_validate_email', array('model' => $model, 'validateEmail' => $validateEmail)); ?>
                </p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_address">Adresse</label>
            <div class="controls">
                <input name="WpUserMeta[address]" value="<?php echo getUserMeta($userMetas, 'address'); ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_address" data-original-title="Adresse">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_additionaladdress">Adresse 2</label>
            <div class="controls">
                <input name="WpUserMeta[additionaladdress]" value="<?php echo getUserMeta($userMetas, 'additionaladdress'); ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_additionaladdress" data-original-title="Adresse 2">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="my_postal_code">Recherche par cp ou ville</label>
            <div class="controls">
                <input name="WpUserMeta[mypostcode]" value="<?php echo getUserMeta($userMetas, 'mypostcode'); ?>" type="text" class="input-xlarge text-tip" id="my_postal_code" data-original-title="Recherche par cp ou ville">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Ville</label>
            <div class="controls">
                <select name="WpUserMeta[mypostville]" id="user_villes">
                    <?php
                    $criteria = new CDbCriteria();
                    $criteria->select = '*';
                    $criteria->order = 'nom';
                    $criteria->condition = 'cp LIKE :title';
                    $criteria->params = array(':title' => getUserMeta($userMetas, 'mypostcode') . '%');
                    $villesUser = WpVille::model()->findAll($criteria);
                    ?>
                    <option id="property_villes_title"  value="0">Veuillez sélectionner votre ville</option> 
                        <?php if(!empty($villesUser)) foreach($villesUser as $vl):?>
						<?php $selected_villeUser = ($vl->cp."_".$vl->nom == getUserMeta($userMetas, 'mypostville')) ? 'selected' : '';?>
						<option class="user_villes_title" <?php echo $selected_villeUser; ?> value="<?php echo $vl->cp."_".$vl->nom; ?>">
							<?php echo $vl->nom ." (".$vl->cp.")"; ?>
						</option>
					<?php endforeach;?>
                </select>
                <span class="help-inline" id="loading-villes-user" style="display:none">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/loading.gif">
                </span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_landline">Fixe: </label>
            <div class="controls">
                    <?php $fixe = getUserMeta($userMetas, 'landline'); ?>
                <input name="WpUserMeta[landline]" value="<?php echo $fixe; ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_landline" data-original-title="Fixe">
                <?php if (trim($fixe) != ''): ?>
                    <p class="help-block">
    <?php $this->renderPartial('btn_validate_phone', array('model' => $model, 'phone' => $validateFixe, 'type' => 1, 'phoneNumber' => $fixe)); ?>
                    </p>
<?php endif; ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="WpUserMeta_mobile_phone">Portable: </label>
            <div class="controls">
                    <?php $mobile_phone = getUserMeta($userMetas, 'mobile_phone'); ?>
                <input name="WpUserMeta[mobile_phone]" value="<?php echo $mobile_phone; ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_mobile_phone" data-original-title="Portable">
                <?php if (trim($mobile_phone) != ''): ?>
                    <p class="help-block">
    <?php $this->renderPartial('btn_validate_phone', array('model' => $model, 'phone' => $validatePortable, 'type' => 2, 'phoneNumber' => $mobile_phone)); ?>
                    </p>
<?php endif; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="WpUserMeta_mobile_myfax">Fax</label>
            <div class="controls">
                <input name="WpUserMeta[myfax]" value="<?php echo getUserMeta($userMetas, 'myfax'); ?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_mobile_myfax" data-original-title="Fax">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button class="btn" type="submit"><i class="color-icons disk_co"></i>Enregistrer</button>
            </div>
        </div>
    </fieldset>
</form>
<div class="widget-box">
    <div class="widget-head">
        <h5> <span class="color-icons vcard_co"></span> Commentaire fiche client </h5>
    </div>
    <form method="POST" class="well" id="userCommentForm" action="<?php echo PIUrl::createUrl('/common/commentUser'); ?>">
        <input type="hidden" name="WpUserComment[user_id]" value="<?php echo $model->user->ID; ?>"/>
        <input type="hidden" name="WpUserComment[property_id]" value="<?php echo $model->id; ?>"/>
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="WpUserComment_comment"> Votre commentaire :</label>
                <div class="controls">
<?php $userComment = $model->user->comment; ?>
                    <textarea name="WpUserComment[comment]" style="width:100%" rows="5" id="WpUserComment_comment" class="input-xlarge"><?php echo $userComment !== null ? $userComment->comment : ''; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn"><i class="color-icons disk_co"></i>Ajouter le commentaire</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>