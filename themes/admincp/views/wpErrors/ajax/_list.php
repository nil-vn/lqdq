<?php
$total = count($model);
$limit = 30;
$page = $params['page'];
if ($total == 0)
{
    $next = -1;
    $prev = -1;
    $first = -1;
    $last = -2;
} else
{
    $next = $page + 1;
    $prev = $page - 1;
    $first = 1;
    $last = (int) (($total - 1) / $limit) + 1;
}
if ($total >= $page * $limit)
{
    $count = 30;
} else
{
    $count = $limit - ($limit * $page - $total);
}
$from = ($page - 1) * $limit + 1;
if ($total >= $page * $limit)
{
    $to = $from + $limit - 1;
} else
{
    $to = $from + $limit - ($page * $limit - $total) - 1;
}
?>
<script>
    $(function() {
        $("#checkall").click(function() {
            var checkedStatus = this.checked;
            $(".MyMessagesPage-mmfpCheckboxMessage").find(":checkbox").each(function() {
                $(this).prop("checked", checkedStatus);
            });
        });
    });
</script>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/webmail/webmail.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/webmail/fancybox.css" rel="stylesheet">
<div id="navTop" class="MyMessagesPage-mmfpGreyButtonAreaDiv" style="padding:10px 10px;">
    <!-- Pagination -->
    <ul class="pagination">
            <?php if ($prev > 0)
            { ?>
            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $first)); ?>">«Les plus récents</a></li>

            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $prev)); ?>">&lt;Prec.</a></li>
<?php } ?>    
        <li style="float:left;padding:3px"><?php
if ($total == 0)
{
    echo '<strong>0 result</strong>';
} else
{
    ?>
                <strong><?php echo $from; ?></strong>
                -
                <strong><?php echo $to; ?></strong>
                &nbsp;sur&nbsp;<strong><?php echo $total; ?></strong> <!--(page 3/386) -->
                &nbsp;
<?php } ?></li>
<?php if ($next <= $last)
{ ?>
            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $next)); ?>">Suiv.&gt;</a></li>
            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $last)); ?>">Les plus anciens»</a></li>
<?php } ?>
    </ul>
</div>

<table width="100%" cellspacing="0" cellpadding="0" class="maillist table table-striped">
    <tr class="MyMessagesPage-mmfpmesggreybar">
        <td class="MyMessagesPage-mmfpCheckboxBar" width="20px">
            <input id="checkall" name="ca" type="checkbox"><!--&nbsp;<a href="#" onClick="checkall();">Tous</a> -->
        </td>
        <td class="MyMessagesPage-mmfpOtherBar" width="80px">
            Action
        </td>
        <td class="MyMessagesPage-mmfpResizeFromBar" width="200px">
            De
        </td>
        <td class="MyMessagesPage-mmfpResizeFromBar" width="200px">
            A
        </td>
        <td class="MyMessagesPage-mmfpResizeBar">
            Sujet
        </td>
        <td class="MyMessagesPage-mmfpResizeBar" width="130px">
            Reçu le
        </td>                    
    </tr>
        <?php
        if ($total == 0)
        {
            echo "<tr><td colspan='6' style='text-align:center'><h2>Aucun message en attente de traitement</h2></td></tr>";
        } else
            for ($i = $from - 1; $i < $from - 1 + $count; $i++)
            {
                $adminTraitementMail = $model[$i];
                ?>
            <tr id="<?php echo $adminTraitementMail['id_mail']; ?>" class="MyMessagesPage-email_message" onmouseover="if (this.style.backgroundColor == 'rgb(255, 255, 255)' || this.style.backgroundColor == '' || this.style.backgroundColor == '#ffffff') {
                                this.style.backgroundColor = '#eeeeee';
                            }" onmouseout="if (this.Fstyle.backgroundColor == '#eeeeee' || this.style.backgroundColor == 'rgb(238, 238, 238)') {
                                        this.style.backgroundColor = '#ffffff';
                                    }" style="background-color: rgb(255, 255, 255);">
                <td class="MyMessagesPage-mmfpCheckboxMessage">
                    <input id="selection" name="selection" type="checkbox" value="<?php echo $adminTraitementMail['id_mail']; ?>" onclick="if (this.checked) {
                                        check(this);
                                    } else {
                                        uncheck(this);
                                    }">
                </td>
                <td class="MyMessagesPage-mmfpFlagMessage" width="80px">

                    <!-- VISU MAIL -->
                    <a class="various" value="<?php echo $adminTraitementMail['id_mail']; ?>" title="Ouvir" data-fancybox-type="iframe" href="javascript:void(0);"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconForwardMail.gif" border="0" alt="Traiter le message"></a>


                    <!-- MESSAGE TRAITEMENT -->
        <?php
        if ($adminTraitementMail['traite'] == 3)
        {
            $mes = AdminTraitementMailMessage::model()->findByAttributes(array('id_mail' => $adminTraitementMail['id_mail']), array('order' => 'date DESC'));
            ?>
                        <a class="infotraitement" title="<?php echo $mes['user'] . ' - ' . $mes['message'] . ' - le ' . date('d/m/Y', strtotime($mes['date'])); ?>" onclick="flagOn(<?php echo '\'' . $mes['user'] . '\',\'' . date('d/m/Y', strtotime($mes['date'])) . '\',\'' . $mes['message'] . '\''; ?>)">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconFlagOn.gif" border="0">                
                        </a>
                        <?php } else
                        { ?>
                        <a class="atraiter" href="javascript:void(0);" onclick="webmail_markAsProcessed(<?php echo $adminTraitementMail['id_mail']; ?>);" title="Marquer ce message comme A Traiter">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconFlagOff.gif" border="0" />
                        </a>
                        <?php } ?>
                    <!-- SUPPRESSION -->
                    <a onclick="webmail_delete(<?php echo $adminTraitementMail['id_mail']; ?>, 'delete');
                                    webmail_update();" style="cursor:pointer" title="Supprimer">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconDeleteFolder.gif" border="0" alt="Supprimer ce message">
                    </a>

                </td>
                <td class="MyMessagesPage-mmfpResizeFromMessage">
                    <a style="color:#333;" class="various" value="<?php echo $adminTraitementMail['id_mail']; ?>" data-fancybox-type="iframe" href="javascript:void(0);">
                        <?php
                        if ($adminTraitementMail['lu'] == 1)
                        {
                            echo $adminTraitementMail['expediteur'];
                        } else
                        {
                            echo '<strong>' . $adminTraitementMail['expediteur'] . '</strong>';
                        }
                        ?>
                    </a>
                </td>
                <td class="MyMessagesPage-mmfpResizeFromMessage">
                    <a style="color:#333;" class="various" value="<?php echo $adminTraitementMail['id_mail']; ?>" data-fancybox-type="iframe" href="javascript:void(0);">
                <?php
                if ($adminTraitementMail['lu'] == 1)
                {
                    echo $adminTraitementMail['destinataire'];
                } else
                {
                    echo '<strong>' . $adminTraitementMail['destinataire'] . '</strong>';
                }
                ?>
                    </a>
                </td>
                <td class="MyMessagesPage-mmfpResizeMessage">
                    <a style="color:#333;" class="various" value="<?php echo $adminTraitementMail['id_mail']; ?>" data-fancybox-type="iframe" href="javascript:void(0);">
                    <?php
                    if ($adminTraitementMail['lu'] == 1)
                    {
                        echo $adminTraitementMail['sujet'];
                    } else
                    {
                        echo '<strong>' . $adminTraitementMail['sujet'] . '</strong>';
                    }
                    ?>
                    </a>
                </td>
                <?php PIUrl::createUrl('home/index', array('id' => 3)); ?>
                <td class="MyMessagesPage-mmfpRecMessage">
        <?php
        if ($adminTraitementMail['lu'] == 1)
        {
            if (date('d/m/Y') == date('d/m/Y', strtotime($adminTraitementMail['date_envoi'])))
            {
                echo date('h:i', strtotime($adminTraitementMail['date_envoi']));
            } else
            {
                echo date('d/m/Y', strtotime($adminTraitementMail['date_envoi']));
            }
        } else
        {
            if (date('d/m/Y') == date('d/m/Y', strtotime($adminTraitementMail['date_envoi'])))
            {
                echo '<strong>' . date('h:i', strtotime($adminTraitementMail['date_envoi'])) . '</strong>';
            } else
            {
                echo '<strong>' . date('d/m/Y', strtotime($adminTraitementMail['date_envoi'])) . '</strong>';
            }
        }
        ?>
                </td>
                <td class="MyMessagesPage-mmfpOtherMessage"></td>		
            </tr>
    <?php } ?>
</table>
<div id="navBottom" class="MyMessagesPage-mmfpGreyButtonAreaDiv" style="padding:10px 10px;">
    <!-- Pagination -->
    <ul class="pagination">
<?php if ($prev > 0)
{ ?>
            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $first)); ?>">«Les plus récents</a></li>

            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $prev)); ?>">&lt;Prec.</a></li>
<?php } ?>    
        <li style="float:left;padding:3px"><?php
if ($total == 0)
{
    echo '<strong>0 result</strong>';
} else
{
    ?>
                <strong><?php echo $from; ?></strong>
                -
                <strong><?php echo $to; ?></strong>
                &nbsp;sur&nbsp;<strong><?php echo $total; ?></strong> <!--(page 3/386) -->
                &nbsp;
<?php } ?></li>
<?php if ($next <= $last)
{ ?>
            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $next)); ?>">Suiv.&gt;</a></li>
            <li><a href="<?php echo PIUrl::createUrl('webmail/index', array('id' => $_SESSION['NewPreiod'], 'page' => $last)); ?>">Les plus anciens»</a></li>
<?php } ?>
    </ul>
</div>