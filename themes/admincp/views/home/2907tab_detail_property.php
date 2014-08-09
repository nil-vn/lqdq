<script>
    $(document).ready(function() {
        loadSubLesOptions($(".btn-getSubLesOption"));
    });
</script>
<?php
if (!empty($model->city))
{
    $postvilleS = explode('_', $model->city);
    $postvilleS = $postvilleS[count($postvilleS) - 1] . ' ' . $postvilleS[0];
} else
{
    $postvilleS = $model->address;
}
?>
<form name="fpagesblanches" id="fpagesblanches" method="post" action="http://www.pagesjaunes.fr/pagesblanches/RecherchePagesBlanchesExpress.do" target="_blank" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="portail" value="PJ">
    <input type="hidden" name="nom" value="<?php echo getUserMeta($userMetas, 'first_name'); ?>">
    <input type="hidden" name="ou" value="<?php echo $postvilleS; ?>">
    <input type="image" src="<?php echo Yii::app()->baseUrl; ?>/images/pagesblanches.jpg" style="width:51px; height:33px; border:0px">
</form>
<div class="immobilierHomeDiv"><p><strong>  <-    Ref BTK<?php echo $model->id; ?>    -> <br /> <a rel="<?php echo $model->id ?>" date="<?php echo datediff($model->created, date('Y-m-d H:s:i')); ?>" id="UpdateDateCreatedProperty" href="javascript:void(0)">> Actualiser l'annonce <</a></strong></p></div>
<p class="immobilierHomeDiv">Actualisée le : <strong id="dateCreatedProperty"><?php echo date(Yii::app()->params['datetime'], strtotime($model->created)); ?></strong> <font color="red">(Il y a <span id="dateCompareProperty"><?php echo datediff($model->created, date('Y-m-d H:s:i')); ?></span> jours)</font> </p>
<?php if ($model->date_modified != ''): ?>
    <p class="immobilierHomeDiv">Actu client : <strong id="dateCreatedProperty"><?php echo date(Yii::app()->params['datetime'], strtotime($model->date_modified)); ?></strong> <font color="red">(Il y a <span id="dateCompareProperty"><?php echo datediff($model->date_modified, date('Y-m-d H:s:i')); ?></span> jours)</font> </p>
<?php endif; ?>
<div class="cls"></div>
<div class="well">

    <form method="POST" id="saveCategoryForm" action="<?php echo PIUrl::createUrl('/home/saveCategory/', array('id' => $model->id)); ?>">
        <fieldset>
            <div class="control-group">
                <label class="control-label" style="margin:45%;">
                    <?php
                    $listCategory = "";
                    if (!empty($myCategory))
                        foreach ($myCategory as $category):
                            ?>
                            <?php
                            if ($category->parent_id == 0)
                                $listCategory = $category->category_name . ' / ' . $listCategory;
                            else
                            {
                                $listCategory = $listCategory . $category->category_name . " / ";
                            }
                            ?>
                        <?php endforeach; ?>
                    <h5 id="label-category"><?php
                        $listCategory = trim($listCategory);
                        echo rtrim($listCategory, "/");
                        ?></h5>
                </label>
                <div class="cls"></div>
                <label class="control-label">
                    <a href="javascript:void(0)" class="btn-modifier">Modifier</a>
                    <span id="btn-save-category" uuid="<?php echo $model->id; ?>" style="color:red;font-weight: bold;cursor: pointer;display:none">Appliquer les modifications</span>
                </label>
                <div class="span6" id="container-category" style="display:none" data-type="hidden">
                    <blockquote>
                        <?php if (!empty($categories)) foreach ($categories as $category): ?>
                                <div id="box-category-<?php echo $category->id; ?>">
                                    <?php $checked = in_array($category->id, $arrCategory) ? 'checked="true"' : ''; ?>
                                    <p><input data-group="group" data-parent="<?php echo $category->parent_id; ?>" class="checkbox-category checkbox-category-parent" name="Category[]" value="<?php echo $category->id; ?>" <?php echo $checked; ?> type="checkbox"></input> <strong><?php echo $category->category_name; ?></strong></p>
                                    <div class="box-sub-category">
                                        <?php
                                        if ($checked != '' && $category->parent_id == 0)
                                        {
                                            $group1 = $group2 = $group3 = "";
                                            $countGroup1 = $countGroup2 = $countGroup3 = 0;
                                            foreach ($subCategories as $subCategory)
                                            {
                                                $subchecked = in_array($subCategory->id, $arrCategory) ? 'checked="true"' : '';
                                                if ($subCategory->type == 1)
                                                {
                                                    $countGroup1++;
                                                    $group1.='<small style="margin-left: 20px;"><input name="Category[]" data-parent="' . $subCategory->parent_id . '" class="checkbox-category" data-group="group1" ' . $subchecked . ' type="checkbox" value="' . $subCategory->id . '" /> ' . $subCategory->category_name . '</small>';
                                                } elseif ($subCategory->type == 2)
                                                {
                                                    $countGroup2++;
                                                    $group2.='<small style="margin-left: 20px;"><input name="Category[]" data-parent="' . $subCategory->parent_id . '" class="checkbox-category" data-group="group2" ' . $subchecked . ' type="checkbox" value="' . $subCategory->id . '" /> ' . $subCategory->category_name . '</small>';
                                                } else
                                                {
                                                    $countGroup3++;
                                                    $group3.='<small style="margin-left: 20px;"><input name="Category[]" data-parent="' . $subCategory->parent_id . '" class="checkbox-category" data-group="group3" ' . $subchecked . ' type="checkbox" value="' . $subCategory->id . '" /> ' . $subCategory->category_name . '</small>';
                                                }
                                            }
                                            if ($group1 != '')
                                                $group1 = "<span>Option(s) facultative(s)</span>" . $group1;
                                            if ($group2 != '')
                                                $group2 = "<span>Option(s) facultative(s)</span>" . $group2;
                                            if ($group3 != '')
                                                $group3 = "<span>Option(s) facultative(s)</span>" . $group3;
                                            echo $group1 . $group2 . $group3;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                    </blockquote>
                </div>

            </div>
        </fieldset>
    </form>
    <form class="form-horizontal" id="savePropertyFrom" method="POST" action="<?php echo PIUrl::createUrl('/home/savePropertyDetail'); ?>">
        <fieldset>
            <input type="hidden" name="Property[id]" value="<?php echo $model->id ?>"/>
            <?php if (in_array('qualite', $arrFieldName)): ?>
                <div class="control-group">
                    <label class="control-label" for="property_qualite">Qualité*</label>
                    <div class="controls">
                        <select name="<?php echo array_search('qualite', $arrFieldName); ?>_qualite" id="property_qualite">
                            <?php
                            $metaValueQualite = $model->getMetaValue('qualite', false, true);
                            echo '<option value="0">' . $model->getValueNoSelected('qualite') . '</option>';
                            if (!empty($qualites))
                                foreach ($qualites as $qualite)
                                {
                                    $selected = $metaValueQualite == $qualite->id ? 'selected' : '';
                                    echo '<option ' . $selected . ' value="' . $qualite->id . '">' . $qualite->value . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
            <div class="control-group">
                <label class="control-label" for="property_pays">Pays*</label>
                <div class="controls">
                    <select name="pays" id="property_pays">
                        <option value="fr" selected="selected">France</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="property_address">Adresse</label>
                <div class="controls">
                    <input name="Property[address]" type="text" class="input-xlarge text-tip" id="property_address" data-original-title="Adresse" value="<?php echo $model->address; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="property_postal_code">Code postal</label>
                <div class="controls">
                    <input name="Property[postal_code]" value="<?php echo $model->postal_code; ?>" type="text" class="input-xlarge text-tip number-mask" id="property_postal_code" data-original-title="Code postal">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="property_villes">Ville *</label>
                <div class="controls">
                    <select name="Property[villes]" id="property_villes" class="text-tip isRequired" title="Ville">
                        <?php
                        $criteria = new CDbCriteria();
                        $criteria->select = '*';
                        $criteria->order = 'nom';
                        $criteria->condition = 'cp LIKE :title';
                        $criteria->params = array(':title' => $model->postal_code . '%');
                        $villesUser = WpVille::model()->findAll($criteria);
                        ?>
                        <option id="user_villes_title"  value="0">Veuillez sélectionner votre ville</option> 
                        <?php if (!empty($villesUser)) foreach ($villesUser as $vl): ?>
                                <?php $selected_villeUser = ($vl->cp . "_" . $vl->nom."" == $model->city) ? 'selected' : ''; ?>
                                <option class="property_villes_value" <?php echo $selected_villeUser; ?> value="<?php echo $vl->cp . "_" . $vl->nom; ?>">
                                    <?php echo $vl->nom . " (" . $vl->cp . ")"; ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                    <span class="help-inline" id="loading-villes" style="display:none">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/loading.gif">
                    </span>
                    <p class="help-block">
                        Compléments d'informations sur l'annonce, ces données sont importantes et parfois déterminantes pour les clients acquéreurs.
                    </p>
                </div>
            </div>
            <?php
            if (!empty($arrField))
                foreach ($arrField as $field):
                    if ($field->htmlvar_name == 'qualite')
                        continue;
                    $label = $field->field_name;
                    $class = "";
                    if ($field->is_require)
                    {
                        $class = "isRequired";
                        $label.= " *";
                    }
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="property_<?php echo str_replace('[]', '', $field->htmlvar_name); ?>"><?php echo $label; ?></label>
                        <div class="controls">
                            <?php if ($field->type == 1): ?>
                                <?php $metaValues = WpCategoryField::model()->getAllValueOfCategory($field->htmlvar_name, $field->id); ?>							
                                <select name="<?php echo $field->id . "_" . $field->htmlvar_name; ?>" id="property_<?php echo str_replace('[]', '', $field->htmlvar_name); ?>" class="text-tip <?php echo $class; ?>" title="<?php echo $field->field_name; ?>">
                                    <?php
                                    echo '<option value="0" >' . $model->getValueNoSelected($field->htmlvar_name) . '</option>';
                                    $metavalue_field = $model->getMetaValue($field->htmlvar_name, false, true);
                                    if (!empty($metaValues))
                                        foreach ($metaValues as $metaValue):
                                            $selected = $metavalue_field == $metaValue->id ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $metaValue->id; ?>" <?php echo $selected; ?>><?php echo $metaValue->value; ?></option>
                                        <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                                <?php
                                if ($field->htmlvar_name == 'bedrooms' || $field->htmlvar_name == 'bathrooms' || $field->htmlvar_name == 'nb_tete')
                                {
                                    $limitChar = '2';
                                } elseif ($field->htmlvar_name == 'numero_etage')
                                {
                                    $limitChar = '3';
                                } else
                                {
                                    $limitChar = '10';
                                }
                                $fieldValue = $model->getMetaValue($field->htmlvar_name);
                                ?>
                                <input maxlength="<?php echo $limitChar; ?>" name="<?php echo $field->id . "_" . $field->htmlvar_name; ?>" value="<?php echo $fieldValue != '' ? $fieldValue : 0; ?>" type="text" class="limit-char input-xlarge text-tip number-mask <?php echo $class; ?>" id="property_<?php echo $field->htmlvar_name; ?>" data-original-title="<?php echo $field->field_name; ?>">
                            <?php endif; ?>

                            <?php
                            if ($field->htmlvar_name == 'prix' || $field->htmlvar_name == 'montant_bouquet' || $field->htmlvar_name == 'montant_rente')
                                echo '<span class="help-inline">€</span>';
                            elseif ($field->htmlvar_name == 'surface' || $field->htmlvar_name == 'surface_terrain')
                                echo '<span class="help-inline">m²</span>';
                            ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <div class="control-group">
                <div class="controls">
                    <p id="lesoptiontitle"><span class="color-icons add_co"></span> <a data-type="hidden" data-property="<?php echo $model->id; ?>" class="btn-getSubLesOption" href="javascript:void(0)">Voir / Modifier les options de l'annonce</a></p>
                    <div id="container-list-lesoption" style="display:none">
                        <?php if (!empty($arrLesoption)) foreach ($arrLesoption as $lesOption): ?>
                                <div class="box-lesoption" data-id="<?php echo $lesOption->id ?>" data-htmlname="<?php echo $lesOption->htmlvar_name; ?>">
                                    <p><span class="color-icons asterisk_orange_co"></span> <?php echo $lesOption->field_name; ?></p>
                                    <div class="list-lesoption list-lesoption-<?php echo $lesOption->id; ?>">
                                        <div class="cls"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <strong>Descriptif du bien (20 caractères minimum):</strong>
                    <textarea id="Property_description" name="Property[description]" style="min-height:150px" class="input-xlarge" rows="3"><?php echo $model->description; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input name="Property[sendmail]" type="checkbox" value="1">
                        Envoyer un mail au client après modification</label>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button class="btn" type="submit"><i class="color-icons disk_co"></i>Enregistrer</button>
                </div>
            </div>
        </fieldset>
    </form>
    <?php if (in_array(1, $model->categories)): ?>
        <div class="nonboxy-widget">
            <div class="widget-head">
                <h5> INFOS PERFORMANCES ENERGETIQUES</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <form action="<?php echo PIUrl::createUrl('/home/saveEnegy'); ?>" class="form-horizontal" id="saveEnegyForm">
                        <input type="hidden" name="WpEnegy[property_id]" value="<?php echo $model->id ?>"/>
                        <fieldset>
                            <div class="input-append date" id="datepicker" data-date="<?php echo date(Yii::app()->params['date'], time()); ?>" data-date-format="dd/mm/yyyy">
                                <div class="control-group">
                                    <label class="control-label"> Date de réalisation du diagnostic </label>
                                    <div class="controls">
                                        <div class="input-append">
                                            <input style="margin-left: 185px;width: 183px;" name="WpEnegy[dpeDate]" size="16" type="text" value="<?php echo ($model->enegy == null || $model->enegy->dpeDate == '0000-00-00') ? '' : date(Yii::app()->params['date'], strtotime($model->enegy->dpeDate)); ?>">
                                            <span class="add-on margin-fix"><i class="icon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Consommations énergétiques</label>
                                <div class="controls">
                                    <input maxlength="6" name="WpEnegy[dpeNRJ]" value="<?php echo $model->enegy != null ? $model->enegy->dpeNRJ : ''; ?>" type="text" class="input-medium text-tip number-mask limit-char" id="WpEnegy_dpeNRJ" data-original-title="first tooltip">
                                    <span class="help-inline">ou</span> 
                                    <select name="WpEnegy[dpeNRJselect]" id="WpEnegy_dpeNRJselect">
                                        <option selected="selected" value="">Sélectionner une lettre</option>
                                        <option value="25">A (≤50)</option>
                                        <option value="70">B (51 à 90)</option>
                                        <option value="120">C (91 à 150)</option>
                                        <option value="190">D (151 à 230)</option>
                                        <option value="280">E (231 à 330)</option>
                                        <option value="390">F (331 à 450)</option>
                                        <option value="451">G (&gt; 450)</option>
                                    </select>
                                    <span class="help-inline">en</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Emissions de gaz à effet de serre</label>
                                <div class="controls">
                                    <input maxlength="6" name="WpEnegy[dpeGES]" value="<?php echo $model->enegy != null ? $model->enegy->dpeGES : ''; ?>" type="text" class="input-medium text-tip number-mask limit-char" id="WpEnegy_dpeGES" data-original-title="first tooltip">
                                    <span class="help-inline">ou</span> 
                                    <select name="WpEnegy[dpeGESselect]" id="WpEnegy_dpeGESselect">
                                        <option selected="selected" value="">Sélectionner une lettre</option>
                                        <option value="5">A (≤5)</option>
                                        <option value="8">B (6 à 10)</option>
                                        <option value="15">C (11 à 20)</option>
                                        <option value="29">D (21 à 35)</option>
                                        <option value="45">E (36 à 55)</option>
                                        <option value="58">F (56 à 80)</option>
                                        <option value="81">G (&gt; 80)</option>
                                    </select>
                                    <span class="help-inline">en</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn" type="submit"><i class="color-icons disk_co"></i>modifier DPE</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>