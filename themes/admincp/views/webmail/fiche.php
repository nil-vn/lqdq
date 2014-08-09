<?php
$count = count($model);
$id = $model[0]->post_property_id;
//
switch ($post_property->type_property) {
    case 1:
        $type_transaction = "vente";
        break;
    case 2:
        $type_transaction = "location";
        break;
    case 3:
        $type_transaction = "colocation";
        break;
    default:
        $type_transaction = "type inconnu";
}
//
switch ($post_property->payment_id) {
    case 1:
        $type_mandat = "agence";
        break;
    case 2:
        $type_mandat = "privilège";
        break;
    case 3:
        $type_mandat = "premium (CB)";
        break;
    case 4:
        $type_mandat = "premium (Chèque)";
        break;
    case 5:
    case 6:
        $type_mandat = "gratuite (ancien)";
        break;
    case 7:
        $type_mandat = "découverte";
        break;
    default:
        $type_mandat = "type inconnu";
        break;
}
//
if (($post_property->status == 0) && ($post_property->is_validate == 1))
    $status = '<font color="green">EN LIGNE</font>';
elseif ($post_property->status == 1)
    $status = '<font color="red">DIFFEREE</font>';
elseif ($post_property->status == 2)
    $status = '<font color="red">SUPPRIMEE</font>';
elseif ($post_property->status == 3)
    $status = '<font color="red">VENDU</font>';
elseif ($post_property->status == 4)
    $status = '<font color="red">NE VEUT PAS AGENCE</font>';
elseif ($post_property->status == 5)
    $status = '<font color="red">INJOIGNABLE</font>';
elseif ($post_property->status == 14)
    $status = '<font color="red">EN VEILLE</font>';
elseif ($post_property->status == 15)
    $status = '<font color="red">DESACTIVEE</font>';
elseif (($post_property->status == 0) && ($post_property->is_validate == 0))
    $status = '<font color="red">HORS LIGNE</font>';
//
$arrUserMeta = CHtml::listData($post_property->user->metas, 'meta_key', 'meta_value');
$post_property->user->metas = $arrUserMeta;
if (isset($arrUserMeta['landline']) && $arrUserMeta['landline'] != '') {
    $landline = $arrUserMeta['landline'];
} else {
    $landline = '';
}
if (isset($arrUserMeta['mobile_phone']) && $arrUserMeta['mobile_phone'] != '') {
    $mobile_phone = $arrUserMeta['mobile_phone'];
} else {
    $mobile_phone = '';
}
if (isset($arrUserMeta['email']) && $arrUserMeta['email'] != '') {
    $email = $arrUserMeta['email'];
} else {
    $email = '';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>immobilierdev.com - Traitement des annonces d&eacute;couvertes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/fiche/clientcide.2.2.0.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/fiche/ReMooz.js"></script>
<body bgcolor="#FFFFFF">
		<?php if ($count > 0) { ?>
            <form id="fannonce" 
                  name="fannonce" 
                  onSubmit="" 
                  method="post">
                <input name="id" type="hidden" value="<?php echo $id; ?>">

                <table width="100%" align="left">
                    <tr>
                        <td colspan="2">
                            <h2 style="float:left;">CONTROLE ANNONCE DECOUVERTES</h2> (Reste <?php echo $count; ?> annonces à controler)
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" align="left">

                            <div id="">

                                <h2>Annonce de <?php echo $type_transaction; ?>

                                    <!-- STATUT ANNONCE -->

									<?php echo $type_mandat; ?>
                                    &nbsp;
									<?php echo $status;?>
                                    (<a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $post_property->id; ?>" target="_blank"><font color="blue"><u>Ouvrir l'annonce complète</u></font></a>)
                                </h2>

                            </div>



                            <table border="0" cellspacing="0" cellpadding="0" id="Tannonce">
                                <tr>
                                    <td> 
                                        <!--#include virtual="/back-office/modules/photos/index.asp"-->

                                        <div style="clear:both"></div>

                                        <!-- RECAPITULATIF -->
                                        <table border="0" cellspacing="0" cellpadding="0" align="center" class="formulaire">
                                            <tr>
                                                <td class="intitule">
                                                    <div>Prix :</div>
                                                </td>
                                                <td width="4px" class="asterisque"></td>
                                                <td class="champ" colspan="3"><input name="prix" id="prix" value="<?php echo $post_property->prix ?>" type="text" onfocus="this.className = 'on'" onblur="this.className = ''" maxlength="10"  />&nbsp;Euros</td>
                                            </tr>
                                            <tr>
                                                <td id="espace_horizontal_blanc" colspan="3"></td>
                                            </tr>
    <?php if (true){//annonce_type_bien . id_type_bien <> 31 or annonce_type_bien . id_type_bien <> 32) { ?>
                                                <tr>
                                                    <td class="intitule">
                                                        <div>Surf Terrain :</div>
                                                    </td>
                                                    <td width="4px" class="asterisque"></td>
                                                    <td class="champ" colspan="3"><input name="terrain" id="terrain" value="<?php echo $post_property->getMetaValue('surface_terrain');?>" type="text" onfocus="this.className = 'on'" onblur="this.className = ''" maxlength="10" />&nbsp;M2</td>
                                                </tr>
                                                <tr>
                                                    <td id="espace_horizontal_blanc" colspan="3"></td>
                                                </tr>
                                                    <?php } ?>
                                            <tr>
                                                <td class="intitule">
                                                    <div>Fixe :</div>
                                                </td>
                                                <td width="4px" class="asterisque"></td>
                                                <td class="champ" colspan="3">
                                                    <input name="tel1" id="tel1" value="<?php echo $landline; ?>" type="text" onfocus="this.className = 'on'" onblur="this.className = ''" maxlength="15"  />
													<?php if ($landline != '') { ?>
                                                        <a href="http://immobilierdev.com/jump.asp?url=http://www.google.fr/search[pi]q=%22<?php echo $this->formatPhone($landline,' ');?>%22+OR+%22<?php echo $this->formatPhone($landline,'-');?>%22+OR+%22<?php echo $this->formatPhone($landline,'.');?>%22+OR+%22<?php echo $landline;?>%22[et]hl=fr[et]rls=GGLD,GGLD:2007-31,GGLD:fr[et]filter=0" target="_blank" title="rechercher avec google">
                                                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/fiche/google.gif" border="0" align="absmiddle" />
                                                        </a>
													<?php } ?>  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="intitule">
                                                    <div>Portable :</div>
                                                </td>
                                                <td width="4px" class="asterisque"></td>
                                                <td class="champ" colspan="3">
                                                    <input name="tel2" id="tel2" value="<?php echo $mobile_phone; ?>" type="text" onfocus="this.className = 'on'" onblur="this.className = ''" maxlength="15"  />
													<?php if ($mobile_phone != '') { ?>
                                                        <a href="http://immobilierdev.com/jump.asp?url=http://www.google.fr/search[pi]q=%22<?php echo $this->formatPhone($mobile_phone,' ');?>%22+OR+%22<?php echo $this->formatPhone($mobile_phone,'-');?>%22+OR+%22<?php echo $this->formatPhone($mobile_phone,'.');?>%22+OR+%22<?php echo $mobile_phone;?>%22[et]hl=fr[et]rls=GGLD,GGLD:2007-31,GGLD:fr[et]filter=0" target="_blank" title="rechercher avec google">
                                                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/fiche/google.gif" border="0" align="absmiddle" />
                                                        </a>
													<?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="intitule">
                                                    <div>Email :</div>
                                                </td>
                                                <td width="4px" class="asterisque"></td>
                                                <td class="champ" colspan="3">
                                                    <input id="email" name="email" type="text" size="30" value="<?php echo $email; ?>" style="text-transform:lowercase;" />
													<?php if ($email != '') { ?>
                                                        <a href="http://immobilierdev.com/jump.asp?url=http://www.google.fr/search[pi]q=%22<?php echo $email;?>%22[et]hl=fr[et]rls=GGLD,GGLD:2007-31,GGLD:fr[et]filter=0" target="_blank" title="rechercher avec google">
                                                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/fiche/google.gif" border="0" align="absmiddle" />
                                                        </a>
													<?php } ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="intitule">
                                                    <div>Descriptif</div>
                                                </td>
                                                <td width="4px" class="asterisque"></td>
                                                <td class="champ" colspan="3">
                                                    <textarea style="width:550px; height:250px;" name="descriptif"><?php echo $post_property->description; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="espace_horizontal_blanc" colspan="3"></td>
                                            </tr>
                                            <tr>
                                                <td class="intitule">
                                                    <div>Commentaire client</div>
                                                </td>
                                                <td width="4px" class="asterisque"></td>
                                                <td class="champ" colspan="3">
                                                    <textarea style="width:550px; height:100px;" name="commentaire"></textarea>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>       

                        </td>
                        <td width="50%" valign="top">



                            <div style="width:100%; min-height:450px; background-color:#060; color:#fff; cursor:pointer; font-size:18px; font-weight:bold; line-height:25px;  vertical-align:middle" align="center" 
                                 onClick="document.fannonce.submit();">
                                &gt;&gt;&gt;&gt;
                                <br><br>
                                ENREGISTRE L'ANNONCE
                                <br>
                                ET
                                <br>
                                PASSE A L'ANNONCE SUIVANTE
                                <br><br>
                                &gt;&gt;&gt;&gt;
                            </div>
                            &nbsp;ou&nbsp;
                            <br>
                            <div style="width:100%; min-height:100px; background-color:#C30; color:#fff; cursor:pointer; font-size:18px; font-weight:bold; line-height:25px; text-align:center; vertical-align:middle" align="center"
                                 onClick="location.replace('?delid=<?php echo $post_property->id ?>');">
                                SUPPRIMER L'ANNONCE
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>

                    <!--  -->

                    </tr>
                </table>
            </form>
            <script language="javascript">
				function refuser(id) {
					var comm = prompt("Veuillez indiquer la raison de désactivation de cette annonce :\n(ex: annonce située à l'étranger)");
					if (comm)
						location.replace('decouverte_valider.asp?id=' + id.toString() + '&action=supprimer&comm=' + comm);
				}
            </script>
<?php } else { ?>

        <center>
            <br>
            <br>
            <strong>Aucune annonce découverte en attente d'activation.</strong>
            <br>
            <br>

        </center>
<?php } ?>
</body>
</html>