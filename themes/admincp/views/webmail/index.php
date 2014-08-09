<?php

//dump (include($_SERVER['DOCUMENT_ROOT'].'/back-office/themes/admincp/images_email/basePath.php'));
$count = count($model);
$adminName = Yii::app()->user->name;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 0;
}


// -----------
/*
require_once('Net/POP3.php');

$pop3 =& new Net_POP3;
$pop3->connect('pop.gmail.com', 995);
$pop3->login('hqnhatdn@gmail.com', 'z81726354', false);
$msgCnt = $pop3->numMsg();
$headers = $pop3->getParsedHeaders($msgCnt); 
$from = mb_decode_mimeheader($headers['From']);
$subject = mb_decode_mimeheader($headers['Subject']);
$content = $pop3->getBody($msgCnt); 
$pop3->disconnect(); 

echo "From: $from\n";
echo "Subject: $subject\n";
echo "Body: $content\n";
*/
/*$root = __DIR__;

function is_in_dir($file, $directory, $recursive = true, $limit = 1000) {
    $directory = realpath($directory);
    $parent = realpath($file);
    $i = 0;
    while ($parent) {
        if ($directory == $parent) return true;
        if ($parent == dirname($parent) || !$recursive) break;
        $parent = dirname($parent);
    }
    return false;
}

$path = null;
if (isset($_GET['file'])) {
    $path = $_GET['file'];
    if (!is_in_dir($_GET['file'], $root)) {
        $path = null;
    } else {
        $path = '/'.$path;
    }
}

if (is_file($root.$path)) {
    readfile($root.$path);
    return;
}

if ($path) echo '<a href="?file='.urlencode(substr(dirname($root.$path), strlen($root) + 1)).'">..</a><br />';
foreach (glob($root.$path.'/*') as $file) {
    $file = realpath($file);
    $link = substr($file, strlen($root) + 1);
    echo '<a href="?file='.urlencode($link).'">'.basename($file).'</a><br />';
}*/
?>
<div id="message_head" class="yukonsgrcp-head">
    <div id="message_heade">
        <div class="MyMessagesPage-mmfpTitle">
            <span class="MyMessagesPage-mmfpMessageTextDiv"><h2>Courriels immobilierdev.com &nbsp;<a href="javascript:window.open('','_self').close();">( Fermer cette fenêtre )</a></h2></span>
            <span class="MyMessagesPage-mmfpindex"></span>			
        </div>
    </div>
	<font size="-1">Vous êtes connecté en tant que “<strong><?php echo $adminName;?></strong>”</font>
</div>
<div class="control-group">
	<div class="well form-inline">
		<label class="control-label">Classement par période : </label>
		<select id="NewPeriod" name="NewPeriod" onchange="location.replace('<?php echo PIUrl::createUrl('webmail/index');?>/' + this.value);">
			<option value="0">Tous</option>
			<option value="1" <?php if ($_SESSION['NewPreiod']==1) {echo 'selected="selected"';}?>>Dernières 24 heures</option>
			<option value="7" <?php if ($_SESSION['NewPreiod']==7) {echo 'selected="selected"';}?>>Derniers 7 jours</option>
			<option value="14" <?php if ($_SESSION['NewPreiod']==14) {echo 'selected="selected"';}?>>2 dernieres semaines</option>
			<option value="31" <?php if ($_SESSION['NewPreiod']==31) {echo 'selected="selected"';}?>>Derniers 31 jours</option>
		</select>
		<input class="btn btn-default" name="" type="button" value="Supprimer la sélection" onclick="webmail_deleteAll();">
		<button class="btn btn-default update">Actualiser</button>
		<button class="btn btn-default" disabled="disabled" onclick="location.replace('/back-office/webmail/controle/index');">Contrôle</button>
	</div>
</div>
<div id="message" class="yukonsgrcp-rcp">
<?php $this->renderPartial('ajax/_list', array('model' => $model,'params'=>$params)); ?>
</div>
<div class="MyMessagesPage-mmfpFooterDiv">
    <div class="MyMessagesPage-mmfplegend">
		<div>
            <b style="float:left">Légende :</b> 
        </div>
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconForwardMail.gif" style="float:left"><div style="float:left">Ouvrir le message</div>
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconFlagOn.gif" style="float:left"><div style="float:left">message <strong>a traiter</strong></div>
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/webmail/iconDeleteFolder.gif" style="float:left"><div style="float:left">Supprimer le message</div>
        <!--<div style="background-color:#FDE7D5">d&eacute;tect&eacute; comme <strong>[SPAM]</strong></div> -->
    </div>


    <div class="MyMessagesPage-mmfpPagination">
    </div>

            <!--<div class="paging0" id="id"><span>Page 1</span> / 1</div> -->
        <br>
        <br>
        <input class="btn btn-default" name="" type="button" value="Supprimer la sélection" onclick="webmail_deleteAll();">
        <button class="btn btn-default update">Actualiser</button>
    </div>
</div>