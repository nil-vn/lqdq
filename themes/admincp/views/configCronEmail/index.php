<?php
//dump (include($_SERVER['DOCUMENT_ROOT'].'/back-office/themes/admincp/images_email/basePath.php'));
$count = count($model);
$adminName = Yii::app()->user->name;
if (isset($_GET['id']))
{
    $id = $_GET['id'];
} else
{
    $id = 0;
}
?>
<div class="container" style="margin-left: -30px;">
<div id="message_head" class="yukonsgrcp-head">
    <div id="message_heade">
        <div class="MyMessagesPage-mmfpTitle">
            <span class="MyMessagesPage-mmfpMessageTextDiv"><h2>Courriels immobilierdev.com &nbsp;<a href="javascript:window.open('','_self').close();">( Fermer cette fenêtre )</a></h2></span>
            <span class="MyMessagesPage-mmfpindex"></span>			
        </div>
    </div>
    <font size="-1">Vous êtes connecté en tant que “<strong><?php echo $adminName; ?></strong>”</font>
</div>


<table width="100%" cellspacing="0" cellpadding="0" class="maillist table table-striped" >
    <tr class="MyMessagesPage-mmfpmesggreybar">

        <td class="MyMessagesPage-mmfpOtherBar" width="80px">
            <strong>Email</strong>
        </td>
        <td class="MyMessagesPage-mmfpResizeFromBar" width="200px">
            <strong>Mot de passe</strong>
        </td>
        <td class="MyMessagesPage-mmfpResizeFromBar" width="200px">
            <strong>Hôte</strong>
        </td>
        <td class="MyMessagesPage-mmfpResizeFromBar" width="100px">
            <strong>Établi</strong>
        </td>
        <td class="MyMessagesPage-mmfpResizeFromBar" width="100px">
            <strong>Action</strong>
        </td>

    </tr>
    <tr class="fu_insert"></tr>
    <?php
    foreach ($model as $value)
    {
        ?>
        <tr class="MyMessagesPage-mmfpOtherMessage" id="item_<?php //echo $value->id  ?>">
            <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->email; ?></td>
            <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo '*************************';//$encode = encrypt_decrypt('encrypt',$value->pass); echo encrypt_decrypt('decrypt',$encode);  ?></td>
            <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->host; ?></td>
            <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo get_date_tin($value->created); //echo date('d/m/Y', strtotime($value->created)); ?></td>
            <td class="MyMessagesPage-mmfpResizeFromBar" >
                <a id="<?php echo $value->id; ?>" rel="gallery" class="updateEmail"  href="javascript:void(0);"><img style="width: 11px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/list-icons/edit.gif"/></a>      
                <a id="<?php echo $value->id; ?>" class="deleteEmail"  href="javascript:void(0);"><img style="width: 15px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconDeleteFolder.gif"/></a>           
            </td>
        </tr>

        <?php
    }
    ?>	

</tr>
<a rel="gallery" class="createEmail" href="javascript:void(0);">Ajouter: <img style="width: 11px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/list-icons/add.gif"/></a>
</table>
<div style="margin-left: 50%;">
    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header' => '',
    ));
    ?>

</div>
</div>    
