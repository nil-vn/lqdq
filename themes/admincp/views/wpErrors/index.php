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

    <?php
    $form = $this->beginWidget('CActiveForm');
    ?>
    <input type="submit" class="btnDelete" value="Delete All" >
    <table width="100%" cellspacing="0" cellpadding="0" class="maillist table table-striped" id="delError">
        <tr class="MyMessagesPage-mmfpmesggreybar">
            <td class="MyMessagesPage-mmfpOtherBar" width="20px">
                <input type="checkbox" id="select_all" />
            </td>
            <td class="MyMessagesPage-mmfpOtherBar" width="20px">
                <strong>Id</strong>
            </td>
            <td class="MyMessagesPage-mmfpOtherBar" width="10px">
                <strong>Types</strong>
            </td>
            <td class="MyMessagesPage-mmfpResizeFromBar" width="110px">
                <strong>Établi</strong>
            </td>
            <td class="MyMessagesPage-mmfpResizeFromBar" width="40px">
                <strong>Ip</strong>
            </td>
            <td class="MyMessagesPage-mmfpResizeFromBar" width="20px">
                <strong>Url</strong>
            </td>
            <td class="MyMessagesPage-mmfpResizeFromBar" width="80px">
                <strong>Types d'erreurs</strong>
            </td>
            <td class="MyMessagesPage-mmfpResizeFromBar" width="200px">
                <strong>Les messages d'erreur</strong>
            </td>
            <td class="MyMessagesPage-mmfpResizeFromBar" width="20px">
                <strong>Action</strong>
            </td>

        </tr>
        <tr class="fu_insert"></tr>
        <?php
        foreach ($model as $value)
        {
            ?>
            <tr class="MyMessagesPage-mmfpOtherMessage" id="item_<?php echo $value->id ?>">
                <td align="center"><input type="checkbox" name="chkDel[]" value="<?php echo $value->id; ?>" ></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->id; ?></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->types; ?></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->created; ?></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->ip; ?></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><a href="<?php echo $value->url; ?>">Link</a></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->error_types; ?></td>
                <td class="MyMessagesPage-mmfpResizeFromBar"><?php echo $value->error_messages; ?></td>
                <td class="MyMessagesPage-mmfpResizeFromBar" >                    
                    <a id="<?php echo $value->id; ?>" class="deleteError"  href="javascript:void(0);"><img style="width: 15px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconDeleteFolder.gif"/></a>           
                </td>
            </tr>

            <?php
        }
        ?>	

        </tr>

    </table>
        <?php $this->endWidget(); ?>
    <div style="margin-left: 50%;">
        <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'header' => '',
        ));
        ?>

    </div>
</div>    
<script>
    /*CheckAll records by Jquery*/
    $(document).ready(function() {
        $("#select_all").click(function() {
            var checked_status = this.checked;
            $("input[name='chkDel[]']").each(function() {
                this.checked = checked_status;
            });
        });
    });

    /*Delete all record WpErrors by Ajax*/
//    $(document).ready(function() {
//        $(".btnDelete").live('click', function() {
//             id = $(this).attr('id');
//            var parent = $(this).parent();
//            $.ajax({
//                type: "POST",
//                url: '/back-office/WpErrors/deleteAll/' + id,
//                data: $('#delError').serialize(),
//                success: function(data)
//                {
//
//                    parent.slideUp('slow', function() {
//                        $(this).parent().remove();
//                    });
//                }
//            });
//            return false;
//        });
//    });
</script>
