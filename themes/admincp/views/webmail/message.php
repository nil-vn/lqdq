<?php 
if(!$successSave)
    echo "<script>alert('Cannot save with this value!!!');</script>";
// server
function ListFolder($path)
{
    //using the opendir function
    $dir_handle = @opendir($path) or die("Unable to open $path");
    
    //Leave only the lastest folder name
    $dirname = end(explode("/", $path));
    
    //display the target folder.
    echo ("<li>$dirname\n");
    echo "<ul>\n";
    while (false !== ($file = readdir($dir_handle))) 
    {
        if($file!="." && $file!="..")
        {
            if (is_dir($path."/".$file))
            {
                //Display a list of sub folders.
                ListFolder($path."/".$file);
            }
            else
            {
                //Display a list of files.
                echo "<li>$file</li>";
            }
        }
    }
    echo "</ul>\n";
    echo "</li>\n";
    
    //closing the directory
    closedir($dir_handle);
}
?>
<script type="text/javascript">
function iframeLoaded() {
	var x = document.getElementById("idIframe");
	var y = x.contentWindow.document;
	y.body.style.backgroundColor="red";
}
</script>  
<script>
// download attachment
$(function () {
	$(".download_attachment").click(function () {
		alert($(this).attr("value"));
	});
});
</script>
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/webmail/webmail.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/webmail/message.css" rel="stylesheet">
<div id="message" class="yukonsgrcp-rcp">
    <div class="yukonsgrcp-n">
        <div class="yukonsgrcp-e">
			<div class="yukonsgrcp-w"></div>
            <div id="message_head" class="yukonsgrcp-head breadcrumb">
                <div id="message_heade" >
                    <div class="MyMessagesPage-mmfpTitle">
                        <span class="MyMessagesPage-mmfpMessageTextDiv">					
                            Message reçu le <?php echo date('d/m/Y h:i:s A',strtotime($model['date_envoi']));?>
                            &nbsp;&nbsp;					
                        </span>
                    </div>
                </div>
            </div>
            <div id="message_mid" class="yukonsgrcp-mid">
                <div id="message_mide">
					<div class="message_mide_top">
                        <table width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td class="MyMessagesPage-mmfpDisplay" valign="middle">
                                        De :
                                        <span class="MyMessagesPage-mmfpTopFilter">
                                            <?php echo $model['expediteur'];?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="MyMessagesPage-mmfpDisplay" valign="middle">
                                        A :
                                        <span class="MyMessagesPage-mmfpTopFilter">
                                            <?php echo $model['destinataire'];?>
                                        </span>
                                    </td>
                                </tr>
								<?php if ($model['id_annonce_s']!=null) {
										$id_annonce = $model['id_annonce_s'];
									} else if ($model['id_annonce_b']!=null) {
										$id_annonce = $model['id_annonce_b'];
									} else {
										$id_annonce = -1;
									}
									$_SESSION['post_property_id']=$id_annonce;
									if ($id_annonce != -1) {
								?>
                                <tr>
                                    <td class="MyMessagesPage-mmfpDisplay" valign="middle">
                                        Référence concernée :
                                        <span class="MyMessagesPage-mmfpTopFilter">
                                            <strong>BTK<?php echo $id_annonce;?></strong>
                                        </span>
                                    </td>
                                </tr>
								<?php } ?>
                                <tr>
                                    <td class="MyMessagesPage-mmfpDisplay" valign="middle">
                                        Sujet :
                                        <span class="MyMessagesPage-mmfpTopFilter">
                                            <strong><?php echo $model['sujet'];?></strong>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>			
                        <div class="MyMessagesPage-mmfpGreyButtonAreaDiv"></div>
                        <div class="MyMessagesPage-mmfpFooterDiv">
                            <div class="MyMessagesPage-mmfplegend">
                                <?php
                                if(!empty($model->MailMessage)){
                                    ?>
                                    <h4><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconAlert_16x16.gif" border="0" align="absmiddle"> Message non trait&eacute;</h4>
                                    Dernier message de <strong><?php echo $model->MailMessage->user ?></strong> (ajouté le <?php echo $model->MailMessage->date;?>)
                                    <br />
                                    <strong><?php echo $model->MailMessage->message;?></strong>
                                    <br />
                                    <br />
                                    <?php
                                }
                                ?>
                                <div >
                                    <!-- MARQUER COMME TRAITE -->
                                    <a href="javascript:parent.jQuery.fancybox.close();">
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/fermer.gif" border="0"> Fermer le message
									</a>
									<?php if ($id_annonce>0) { ?>
                                    <a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $id_annonce;?>" target="_blank">
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/gerer.gif" border="0"> Ouvrir annonce
									</a>
									<?php } ?>
                                    <!-- REPONDRE -->
									<?php if ($id_annonce<=0) {?>
                                    <a href="<?php echo PIUrl::createUrl('suivi_clientele/index',array('reponseMail'=>$model['expediteur'])); ?>" target="_blank">
									<?php } else {?>
									<a href="<?php echo PIUrl::createUrl('suivi_clientele/index',array('id'=>$id_annonce)); ?>" target="_blank">
									<?php }?>
									<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/email.gif" border="0"> Répondre 
                                    </a>
                                    <!-- MARQUER COMME TRAITE -->
                                    <a href="javascript:void(0);" onclick="webmail_markAsTraite(<?php echo $model['id_mail'];?>);">
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconForwardMail.gif" border="0"> Marquer comme Traité 
                                    </a>
                                    <!-- MARQUER COMME NON TRAITE -->
                                    <a href="javascript:void(0);" onclick="webmail_markAsProcessed(<?php echo $model['id_mail'];?>);">
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconFlagOn.gif" border="0"> Marquer comme <strong>A Traiter</strong> 
                                    </a>
                                    <!-- MARQUER COMME SUPPRIME -->							
                                    <a href="javascript:void(0);" onclick="webmail_delete(<?php echo $model['id_mail'];?>,'delete');">
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconDeleteFolder.gif" border="0"/> Supprimer le message 
                                    </a>
                                    <!-- CREER FICHE ACQUEREUR -->			
                                    <a href="<?php if ($id_annonce>0) echo PIUrl::createUrl('/').'/?property_id='.$id_annonce; else echo PIUrl::createUrl('/');?>" id="nouvelle_fiche_acquereur" value="<?php echo $id_annonce;?>" target="_blank">
                                        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/clients.gif" border="0"> Nouvelle fiche acquéreur 
                                    </a>
									<?php if ($id_annonce == -1) { ?>
									<a href="<?php echo PIUrl::createUrl('/');?>" target="_blank">
										<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/gerer.gif" border="0">
										Ouvrir le BO
									</a>
									<?php } ?>
                                    <!-- BLACKLISTER UN MAIL -->
                                    <a href="<?php echo PIUrl::createUrl('webmail/validate');?>" data-fancybox-type="iframe" class="validate" title="Test"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconError_16x16.gif" border="0"> Blacklister un email</a>
                                </div>
								<?php if ($id_annonce == -1) { ?>
								<form name="recherche1" style="margin:10px 0px 0px 0px" action="<?php echo PIUrl::createUrl('home/search');?>" target="_blank" method="get">
									Adresse e-mail:
									<input type="text" name="profile" style="color:black;width:180px" value="<?php echo $model['expediteur'];?>">
									<input name="submit" type="submit" value="Rechercher" class="btn">
								</form>
								<form name="recherche2" action="<?php echo PIUrl::createUrl('/');?>" target="_blank" method="get">
									Référence:
									<input type="text" name="property_id" value="" style="color:black;width:180px">
									<input type="submit" value="Rechercher" class="btn">
								</form>
								<?php }?>
                                <form name="reference" style="margin:0px;" action="" method="get">
                                    Définir le message comme appartenant à la référence annonce:
                                    <br>
									<input name="id" type="hidden" value="<?php echo $model['id_mail'];?>">
									<?php if ($id_annonce != -1) { ?>
										<input type="text" name="ref" value="<?php echo $id_annonce;?>" style="color:black;width:180px">
										<input name="" type="submit" value="Changer" class="btn">
									<?php } else { ?>
										<input class="input-large" type="text" name="ref" value="" style="color:black;background-color:#FF9900; width:180px">
										<input class="btn" name="definir" type="submit" value="Definir">
										
									<?php } ?>
                                </form>				
                            </div>
                            <div class="MyMessagesPage-mmfpPagination"></div>
                            <div class="MyMessagesPage-mmfpGreyButtonAreaDiv"></div>
                        </div>
                    </div>
                    <table width="100%" cellspacing="0" cellpadding="0" class="MyMessagesPage-mmfptable">
                        <tbody>
                        <tr>
							<td>
							<script>
							$(function () {
	$(".downloadAttachment").click(function () {
		$(this).attr({
			'href': webroot+'/webmail/download'+$(this).attr('value'),
		});
	});
});
							</script>
							<?php 
								$path = 'themes/admincp/images_email';
								$path .= '/'.$model['id_mail'];
								if (is_dir($path)==1) {
									$open_dir = opendir($path);
									while (($file = readdir($open_dir)) !== false) {
										if($file != '.' && $file != '..') {
											$fullpath = Yii::app()->theme->baseUrl.'/images_email/'.$model['id_mail'].'/'.$file;
											$filename = $file;
											if(strpos($file,'.mp3')!==false) {
												echo '<span style="float:left; padding:10px"><a href="javascript:void(0);" class="downloadAttachment" value="?mail_id='.$model['id_mail'].'&filename='.$filename.'"><img src="'.Yii::app()->theme->baseUrl.'/images_email/down.gif" border="0" align="absmiddle"/></a><a href="'.$fullpath.'" target="_blank">'.$filename.'</a><br/>';
												//Thực hiện thao tác trên file
												echo '<object type="application/x-shockwave-flash" data="'.Yii::app()->theme->baseUrl.'/dewplayer.swf?mp3='.$fullpath.'" width="200" height="20" id="dewplayer"><param name="wmode" value="transparent" /><param name="movie" value="'.Yii::app()->theme->baseUrl.'/dewplayer.swf?mp3='.$fullpath.'" /></object></span>';
											} else {
												echo '<span style="float:left; padding:10px"><a href="javascript:void(0);" class="downloadAttachment" value="?mail_id='.$model['id_mail'].'&filename='.$filename.'"><img src="'.Yii::app()->theme->baseUrl.'/images_email/down.gif" border="0" align="absmiddle"/></a><a href="'.$fullpath.'" target="_blank">'.$filename.'</a></span>';
											}
										}
									}
									closedir($open_dir);
								}
							?>
							</td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellspacing="0" cellpadding="0" class="MyMessagesPage-mmfptable">
                        <tbody>
                            <tr>
                                <td class="MyMessagesPage-mmfpUnderLine">
                                </td>
							</tr>	
                            <tr>
                                <td class="MyMessagesPage-mmfpUnderLine">
                                    <div style="margin:15px 15px;"><?php echo $this->clean_jscode($model['body_html']);?></div>
                                </td>
                            </tr>			
                        </tbody>
                    </table>
                </div>
            </div>
		</div>	
	</div>	
</div>