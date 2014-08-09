<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/suivi_clientele/suivi_clientele.css" rel="stylesheet">
<form id="reponse" name="form" action="" method="post">
    <strong>
        <a href="<?php echo PIUrl::createUrl('suivi_clientele/categorie');?>">
            <img src="" width="16" height="16" border="0" align="absmiddle">&nbsp;Ajouter une catégorie
        </a>&nbsp;&nbsp;
        <a href="<?php echo PIUrl::createUrl('suivi_clientele/add_message');?>">
            <img src="" width="19" height="14" border="0" align="absmiddle">&nbsp;Ajouter un message
        </a>&nbsp;&nbsp;
        <a href="<?php echo PIUrl::createUrl('suivi_clientele/contact');?>">
            <img src="" width="16" height="16" border="0" align="absmiddle">&nbsp;Ajouter un contact
        </a>
    </strong>
    <hr noshade="noshade">

    <input name="action" type="hidden" value="envoyer">
    <table width="800" class="tdgris">
        <tbody><tr>
                <td width="269"><nobr><strong>Catégorie de message :</strong></nobr></td>
        <td width="519">
            <select id="categorie" name="categorie" class="input" >
                <option value="0">Veuillez sélectionner une catégorie de message</option>
				<?php foreach ($categoryList as $category)  {?>
					<option value="<?php echo $category['id_categorie'];?>"><?php echo $category['titre'];?></option>
				<?php } ?>
            </select>
        </td>
        </tr>
        <tr>
            <td><strong>Choix du message :</strong></td>
            <td align="left">
                <div id="messagebox">
					
				</div>
            </td>
        </tr>
        <!--<tr>
                <td colspan="2">&nbsp;</td>
        </tr> -->
        <tr>
            <td colspan="2">
                <span class="Style1"><u>Détail du message sélectionné  :</u></span>
			</td>
        </tr>
        <tr>
            <td colspan="2">
                <span id="message">
					<?php //$this->renderPartial('ajax/_template','reponseMail'=>$reponseMail); 
					?>
				</span>
            </td>
        </tr>
        </tbody>
    </table>
</form>