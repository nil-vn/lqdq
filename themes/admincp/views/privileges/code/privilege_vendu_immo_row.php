<!--All function button writen in path /themes/admincp/js/privilege/privilege.js-->
<?php
$data[0] = $rowData->$select[0];
$data[1] = $rowData->$select[1];
$arrUserMeta = (object) CHtml::listData($rowData->postProperty->user->metas, 'meta_key', 'meta_value');
$data[2] = date(Yii::app()->params['date'], strtotime($rowData->$select[2]));
$data[3] = $rowData->$select[3];
$data[4] = $rowData->$select[4];
$data[5] = date(Yii::app()->params['date'], strtotime($rowData->$select[5]));
$data[6] = $rowData->$select[6];
switch ($data[1]) {
    case 0:
        $css = ' class="simple"';
        $status = "Attente traitement";
        break;
    case 1:
        $css = ' class="avocat"';
        $status = 'Facture envoy&eacute;e (attente acte authentique)';
        break;
    case 2:
        $css = ' class="mail"';
        $status = 'ttente r&egrave;glement';
        break;
    case 3:
        $css = ' class="recommande"';
        $status = 'Dossier cl&ocirc;t';
        break;
    case 4:
        $css = ' class="avocat"';
        $status = 'Conflit/Avocat';
        break;
}
?>
<tr <?php echo $css; ?>>
    <th scope="row"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0] ?>" target="_blank">BTK<?php echo $data[0]; ?></a></th>
    <td><strong><?php echo getUserMeta($arrUserMeta, 'first_name'); ?> <?php echo getUserMeta($arrUserMeta, 'last_name'); ?></strong></td>
    <td>
        <!-- acquereurs -->
        <?php if ($data[1] == 3) { ?><strong><?php echo $data[3]; ?> <?php echo $data[4]; ?></strong><?php } ?>
    </td>
    <td>
        <!-- statut -->
        <strong><?php echo $status; ?></strong>                        
    </td>
    <td>
        <!-- date facture -->
        <?php
        if ($data[1] == 2) {
            echo $data[5];
        }
        ?>
    </td>
    <td>
        <!-- honoraires -->
        <?php
        if ($data[1] == 3) {
            echo $data[6] . '&euro;';
        }
        ?>
    </td>
    <td><?php echo $data[2]; ?></td>
    <td>
        <?php if ($data[1] > 0 && $data[1] < 3) { ?>
            <!-- ACTUALISER FACTURE -->

            <a href="javascript:void(0);" class="privilege_vendu_immo_actualiser" title="Actualiser les données de facture">
                <input hidden="input" id="pro_ve_im_ac" value="<?php echo $data[0]; ?>">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/162/22.png" width="16" height="16" border="0"/>
            </a>
            <!-- VOIR FACTURE -->
            <a href="<?php echo PIUrl::createUrl('/compta/privilege_vendu_immo_download/'.$data[0]); ?>" title="Visualiser la facture" target="_blank">
                
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/16/24.png" width="16" height="16" border="0"/>
            </a>
            <!-- VOIR LETTRE NOTAIRE -->
            <a href="privilege_lettre_notaire?id=<?php echo $data[0]; ?>" title="Visualiser le courrier notaire" target="_blank">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/16/21.png" width="16" height="16" border="0"/>
            </a>
            <!-- RENVOYER FACTURE AU COMPTABLE -->
            <a href="javascript:void(0);" class="privilege_vendu_immo_envoyer" value="<?php echo $data[0]; ?>" title="Envoyer la facture au comptable">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/16/47.png" width="16" height="16" border="0"/>
            </a>
        <?php } else if ($data[1] == 3) { ?>
            <!-- VOIR FACTURE -->
            <a href="privilege_facture?id=<?php echo $data[0]; ?>" title="Visualiser la facture" target="_blank">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/16/24.png" width="16" height="16" border="0"/>
            </a>
            <!-- RENVOYER FACTURE AU COMPTABLE -->
            <a href="javascript:void(0);" class="privilege_vendu_immo_envoyer" value="<?php echo $data[0]; ?>" title="Envoyer la facture au comptable">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/16/47.png" width="16" height="16" border="0"/>
            </a>
        <?php } else { ?>
            <!-- SUPPRIMER -->
            <a href="javascript:void(0);" class="privilege_vendu_immo_supprimer" value="<?php echo $data[0]; ?>" title="Supprimer ce dossier">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cross.gif" width="16" height="16" border="0"/>
            </a>                            	
        <?php } ?>
    </td>		  
    <td>
        <?php
        switch ($data[1]) {
            case 0:
                ?>                 	
                <a href="privilege_facture_creer/<?php echo $data[0]; ?>" title="Créer la facture">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/161/12.png" width="16" height="16" border="0"/>
                </a>
                <?php
                break;
            case 1:
                ?>
                <!-- CONFLIT -->
                <a href="javascript:void(0);" class="privilege_vendu_immo_conflit" value="<?php echo $data[0]; ?>" title="Conflit/Avocat">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/163/07.png" width="16" height="16" border="0"/>
                </a> 
                &nbsp;
                <a href="javascript:void(0);" class="privilege_vendu_immo_reglement" value="<?php echo $data[0]; ?>" title="marquer comme en attente de reglement">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/161/37.png" width="16" height="16" border="0"/>
                </a>
                <?php
                break;
            case 2:
                ?>	
                <!-- CONFLIT -->
                <a href="javascript:void(0);" class="privilege_vendu_immo_conflit" value="<?php echo $data[0]; ?>" title="Conflit/Avocat">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/163/07.png" width="16" height="16" border="0"/>
                </a> 
                &nbsp;						
                <a href="javascript:void(0);" class="privilege_vendu_immo_cloture" value="<?php echo $data[0]; ?>" title="marquer comme dossier cl&ocirc;t">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/162/02.png" width="16" height="16" border="0"/>
                </a>
                <?php
                break;
            case 4:
                ?>                	
                <a href="javascript:void(0);" class="privilege_vendu_immo_reglement" value="<?php echo $data[0]; ?>" title="marquer comme en attente de reglement">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/161/37.png" width="16" height="16" border="0"/>
                </a>
                &nbsp;
                <!-- SUPPRIMER -->
                <a href="javascript:void(0);" class="privilege_vendu_immo_supprimer" value="<?php echo $data[0]; ?>" title="Supprimer ce dossier">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cross.gif" width="16" height="16" border="0"/>
                </a> 
                &nbsp;					    
                <a href="javascript:void(0);" class="privilege_vendu_immo_cloture" value="<?php echo $data[0]; ?>" title="marquer comme dossier cl&ocirc;t">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/162/02.png" width="16" height="16" border="0"/>
                </a>
                <?php
                break;
        }
        ?>
    </td>
</tr>
