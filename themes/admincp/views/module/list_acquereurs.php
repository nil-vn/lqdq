<?php
	$myTitle = "";
	if($param['envoye'] ==1){
		$myTitle = "envoy&eacute;(s)";
	}elseif($param['isBlacklist'] == 1){
		$myTitle = "blacklist&eacute;(s)";
	}elseif($param['envoye'] == 0 && $param['controle'] == 1){
		$myTitle = "en attente d'envoi - D&eacute;calage 30J";
	}elseif($param['envoye'] == 0 && $param['controle'] == 2){
		$myTitle = "supprim&eacute;s - refus&eacute;s OP";
	}elseif($param['envoye'] == 0 && $param['controle'] == 3){
		$myTitle = "mis en attente OP";
	}elseif($param['envoye'] == 0 && $param['controle'] == 0){
		$myTitle = "nouveau";
	}else{
		$myTitle = "tous";
	}
?>
<div class="row-fluid main-filter-7">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="mySelect well">
				<form name="aquereursFilterForm" action="">
				<div class="in-select">
					<h3>Filtres:</h3>
					<div class="select-top">
						<span>id : </span>
						<input type="text" name="id" class="txt" value="<?php echo $param['id'];?>" style="width:100px;"/>
					</div>
					<div class="select-top">
						<span>Controlé : </span>
						<select name="controle">
							<option value="10" <?php if($param['controle'] == 10) echo 'selected';?>>Tous</option>
							<option value="0" <?php if($param['controle'] == 0) echo 'selected';?>>Pas controlé</option>
							<option value="1" <?php if($param['controle'] == 1) echo 'selected';?>>Valide</option>
							<option value="2" <?php if($param['controle'] == 2) echo 'selected';?>>Invalide</option>
							<option value="3" <?php if($param['controle'] == 3) echo 'selected';?>>Attente</option>
							<option value="4" <?php if($param['controle'] == 4) echo 'selected';?>>Controlé (valide ou invalide)</option>
						</select>
					</div>
					<div class="select-top">
						<span>Envoyé  : </span>
						<select name="envoye">
							<option value="10" <?php if($param['envoye'] == 10) echo 'selected';?>>Tous</option>
							<option value="0" <?php if($param['envoye'] == 0) echo 'selected';?>>Pas envoyé</option>
							<option value="1" <?php if($param['envoye'] == 1) echo 'selected';?>>Envoyé</option>
						</select>
					</div>
					<div class="select-top">
						<span>Blacklisté   : </span>
						<select name="isBlacklist">
							<option value="10" <?php if($param['isBlacklist'] == 10) echo 'selected';?>>Tous</option>
							<option value="0" <?php if($param['isBlacklist'] == 0) echo 'selected';?>>Non blacklisté</option>
							<option value="1" <?php if($param['isBlacklist'] == 1) echo 'selected';?>>Blacklisté</option>
						</select>
					</div>
					<div class="select-top">
						<input type="submit" value="Afficher les résultats" class="btn btn_sub"/>
					</div>
				</div>
				</form>
				<p class="ou">Ou</p>
				<strong> Accès rapide : </strong>
				<ul class="list-li">
					<?php $and =0; ?>
					<?php if($countAcqNouveau >0):?>
					<li><a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id='.$_GET['id'].'&controle=0&envoye=0&isBlacklist=0');?>">
					 Acq nouveau <span> (<?php echo $countAcqNouveau;?>)</span></a></li>
					<?php $and++; endif;?>
					
					<?php if($countAcqAttente >0):?>
					<li><?php echo $and > 0 ? '& ' : '';?> <a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id='.$_GET['id'].'&controle=3&envoye=0&isBlacklist=0');?>">
					 Acq mis en attente OP<span> (<?php echo $countAcqAttente;?>)</span></a></li>
					<?php $and++; endif;?>
					
					<?php if($countAcqSupprime >0):?>
					<li><?php echo $and > 0 ? '& ' : '';?> <a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id='.$_GET['id'].'&controle=2&envoye=0&isBlacklist=0');?>">
					 Acq supprimés - refusés<span> (<?php echo $countAcqSupprime;?>)</span></a></li>
					<?php $and++; endif;?>
					
					<?php if($countAcqAttente30 >0):?>
					<li><?php echo $and > 0 ? '& ' : '';?> <a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id='.$_GET['id'].'&controle=1&envoye=0&isBlacklist=0');?>">
					 Acq en attente d'envoi - décalage 30J<span> (<?php echo $countAcqAttente30;?>)</span></a></li>
					<?php $and++; endif;?>
					
					<?php if($countAcqBlacklist >0):?>
					<li><?php echo $and > 0 ? '& ' : '';?> <a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id='.$_GET['id'].'&controle=10&envoye=0&isBlacklist=1');?>">
					 Acq blacklistés <span> (<?php echo $countAcqBlacklist;?>)</span></a></li>
					<?php $and++; endif;?>
					
					<?php if($countAcqEnvoyes >0):?>
					<li><?php echo $and > 0 ? '& ' : '';?> <a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id='.$_GET['id'].'&controle=10&envoye=1&isBlacklist=10');?>">
					 Acq envoyés<span> (<?php echo $countAcqEnvoyes;?>)</span></a></li>
					<?php endif;?>
					</ul>
				<div class="cls"></div>
			</div>
			<?php if($property !== null):?>
			<div class="titre">
				<h3>CLIENT(S) ACQUEREUR(S) <span>"<?php echo $myTitle;?>"</span> INSCRIT(S) SUR L'ANNONCE <span><?php echo !empty($property->payment) ? CHtml::encode($property->payment->package) : '""';?></span> REFERENCE <?php echo $param['id'];?> </h3>	
				<div class="mn-color well">
					Explication code couleurs:
					<span class="yellow"></span> 
					Blacklisté
					<span class="blue"></span> 
					Attente 
					<span class="pink"></span> 
					Supprimé 
					<span class="white"></span> 
					Envoyé ou Attente envoie décalage 30J
				</div>
			</div>
			
			<?php if(!empty($model)){ foreach($model as $listCus):?>
			<?php
				$colorClass = "white";
				if($listCus->controle == 3)
					$colorClass = "blue";
				elseif($listCus->controle == 2)
					$colorClass = "red";
				if($listCus->checkIsBlacklist() >=1 || $listCus->checkIsBlacklistValide() >= 1)
					$colorClass = "oreange";
			?>
			<div class="row-fluid well <?php echo $colorClass?>" title="blacklist  en cours (controlé=<?php echo $listCus->controle;?>,envoyé=<?php echo $listCus->envoye;?>,IsBlacklist=<?php echo ($listCus->checkIsBlacklist() >=1 || $listCus->checkIsBlacklistValide() >=1) ? 'True' :'False';?>)">
				<div class="main-comment">
					<div class="contact-main">
						<div class="contact-info">
							<div class="info-left">
								<p><strong><?php echo $listCus->customer_gender.' '.$listCus->customer_first_name.' '.$listCus->customer_last_name;?></strong><span> (<?php echo $listCus->id;?>)</span></p>
								<p>Tel : <span>(<strong><?php echo $listCus->customer_tel;?></strong>)</span></p>
								<p>Portable : <span>(<strong><?php echo $listCus->customer_phone;?></strong>)</span></p>
								<p class="clickEmail" onclick="window.open('<?php echo PIUrl::createUrl('/home/searchAcq?email='.$listCus->customer_email);?>','_blank')">Email : <strong><?php echo $listCus->customer_email;?></strong></p>
								<p><a class="update_aquereurs_form" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('module/UpdateAquereurs',array('id'=>$listCus->id));?>">
									<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/modifier.png" width="16" height="16"/>  Modifier les infos client
								</a></p>
							</div>
							<div class="info-right">
								<p>Provenance : <strong><?php echo $listCus->provenance;?></strong></p>
								<p>Inscrit le : <strong><?php if($listCus->customer_registration_date !='') echo date(Yii::app()->params['datetime'],strtotime($listCus->customer_registration_date));?></strong></p>
								<p>Envoyé le : <strong><?php if($listCus->date_sending !='') echo date(Yii::app()->params['datetime'],strtotime($listCus->date_sending));?></strong></p>
								<p>Visualisé le :<strong><?php if($listCus->date_visualization !='') echo date(Yii::app()->params['datetime'],strtotime($listCus->date_visualization));?></strong></p>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="contact-message">
							<div class="message-client">
								<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/mess-client.gif"/>
								<textarea readonly="readonly" name="mess-client"><?php echo $listCus->customer_message;?></textarea>
							</div>
							<div class="message-interni">
								<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/mess-interne.gif"/>
								<textarea readonly="readonly" name="mess-interne"><?php echo $listCus->internal_message;?></textarea>
							</div>
						</div>
					</div>
					<div class="comment-info">
						<div class="ip-content">
							<span>Votre commentaire(interne) :</span>
							<textarea name="your-comment"></textarea>
						</div>
						<button rel="<?php echo $listCus->id;?>" type="button" name="write_comment" value="" class="btn acq-write_comment">Ecrire commentaire</button>
						<?php if($listCus->envoye == 0):?>
						<?php $outLink = $listCus->controle ==3 ? '&attente=1' : '';?>
						<a target="_blank" href="<?php echo PIUrl::createUrl('/module/voirAcq?id='.$listCus->id.$outLink);?>" name="more_detail" value="" class="btn" >Voir fiche</a>
						<?php endif;?>
						<?php if($listCus->checkIsBlacklist() <1 && $listCus->checkIsBlacklistValide() <1):?>
							<?php if($listCus->controle ==2):?>
							<button rel="<?php echo $listCus->id;?>" data-type="3" name="remove" value="" class="btn cl-red btn-Supprimer-Acq" >Annuler suppr</button>
							<?php else:?>
							<button rel="<?php echo $listCus->id;?>" data-type="2" name="remove" value="" class="btn cl-red btn-Supprimer-Acq" >Supprimer Acq</button>
							<?php endif;?>
							<button rel="<?php echo $listCus->id;?>" data-property="<?php echo $listCus->property->id;?>" href="#ProposerBlacklistFormList" name="black_list" value="" class="btn cl-red Proposer_BLACKLIST" >Proposer BLACKLIST</button>
						<?php endif;?>
						<div class="table-list-comment">
						<table class="table table-default table-bordered">
							<thead>
							<tr>
								<th style="text-align:center" colspan="2"><span class="countComment"><?php echo count($listCus->comments);?></span> Commentaire(s)</th>
							</tr>
							</thead>
							<tbody>
							<?php if(!empty($listCus->comments)) foreach($listCus->comments as $comment):?>
							<tr>
								<td><?php echo date(Yii::app()->params['datetime'],strtotime($comment->created));?></td>
								<td><?php echo $comment->comment.' <br /> Edité par <strong>'.Yii::app()->user->name;?></strong></td>
							</tr>
							<?php endforeach;?>
							</tbody>
					</table></div>
					</div>
				</div>
			</div>
			<?php endforeach; }else{?>
			<div style="padding:1%;width:98%" class="row-fluid well">Aucun client...</div>
			<?php }?>
		</div>
		<?php endif;?>
</div>

<style>#ProposerBlacklistFormList select,#ProposerBlacklistFormList textarea{width:98%}</style>
<div id="ProposerBlacklistFormList" style="display: none;margin-top:10px;padding-top:10px; width:500px;">
	<form id="ProposerBlacklistFormListFrom" method="POST">
		<input type="hidden" name="list_customer_id" id="list_customer_id" value=""/>
		<input type="hidden" name="post_property_id" value="" id="post_property_id"/>
		<fieldset>
			<div class="control-group">
				<h3>Choisissez un type de client</h3>
			</div>
			<div class="control-group">
				<label for="type_client_one">Type de client:</label>
				<select name="type_client" id="type_client_one">
					<option value="">Déclarer ce client comme :</option>
					<option value="Professionnel de l'immobilier">Déclarer comme professionnel de l'immobilier</option>
					<option value="Client indélicat">Déclarer comme client indélicat</option>
					<option value="Autre">Autre</option>
				</select>
			</div>
			<div class="control-group">
				<label class="" for="listCustomerComment">Commentaire:</label>
				<textarea name="listCustomerComment" rows="5" id="listCustomerComment" class="input-xlarge"></textarea>
			</div>
			<button  type="submit" value="" class="btn btn-click-blacklist">Proposer BLACKLIST</button>
		</fieldset>
	</form>
</div>
<script>
	var userName = "<?php echo Yii::app()->user->name;?>";
	var dateType = "<?php echo Yii::app()->params['datetime']?>";
	$().ready(function(){
		$(".Proposer_BLACKLIST").live('click',function(){
			$($(this).attr('href')).find("#list_customer_id").val($(this).attr('rel'));
			$($(this).attr('href')).find("#post_property_id").val($(this).data('property'));
			$($(this).attr('href')).find("#listCustomerComment").val('');
			$($(this).attr('href')).find("#type_client_one").removeClass('error');
			$($(this).attr('href')).find("#type_client_one option:first-child").attr('selected','selected');
			$.fancybox({href : $(this).attr('href'),width:'550px',type:'inline'});
		});	
	});
	
	$("#ProposerBlacklistFormListFrom").live('submit',function(){
		var _form = $(this);
		_form.find("select,textarea").removeClass('error');
		if($("#type_client_one").val()==''){
			_form.find("#type_client_one").addClass('error');
			_form.find("#type_client_one").focus();
			error('Veuillez sélectionner un type de client dans la liste déroulante.');
			return false;
		}
		if(_form.find("#listCustomerComment").val() == ''){
			_form.find("#listCustomerComment").addClass('error');
			_form.find("#listCustomerComment").focus();
			error('Merci d\'entrer un commentaire');
			return false;
		}
		_form.find("button[type='submit']").attr('disabled','disabled');
		showloadPage();
		$.post(webroot+'/module/ajaxBlacklist',$(this).serialize(),function(res){
			window.location.reload();
		});
		return false;
	});
</script>