<style>
	.form-horizontal .controls {margin-left: 139px;}
	.form-horizontal .control-label {width: 140px;text-align: left;font-weight: bold;}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.templete.js"> </script>
<script type="text/x-jquery-tmpl" id="champs-template">
	<tr>
		<td id="${id}">${field_name}</td>
		<td><input type="radio" {{if is_show == 2 || is_require == 1}} checked="" {{/if}} value="2" name="champ[${id}]"> OBLIGATOIRE</label></td>
		<td><input type="radio" {{if is_show == 1 && is_require != 1}} checked="" {{/if}} value="1" name="champ[${id}]"> FACULTATIF</td>
		<td><input type="radio" {{if is_show == 0}} checked="" {{/if}} value="0" name="champ[${id}]"> AUCUN</td>
	</tr>
</script>
<script type="text/x-jquery-tmpl" id="cases-template">
	<tr>
		<td>${value_cv}</td>
		<td><input type="radio" {{if is_show == 1}} checked="" {{/if}} value="1" name="cases[${id_cv}]"> OUI</td>
		<td><input type="radio" {{if is_show == 0}} checked="" {{/if}} value="0" name="cases[${id_cv}]"> NON</td>
	</tr>
</script>

<script type="text/javascript">
	$(document).ready(function(){
		var type_property = $("#type_property_id").val();
		var category_id = $("#category_id").val();
		showloadPage();
		ajaxGetvalue(category_id,type_property);
		
		$("#type_property_id, #category_id").live('change',function(){
			showloadPage();
			var type_property = $("#type_property_id").val();
			var category_id = $("#category_id").val();
			ajaxGetvalue(category_id,type_property);
		});
		
		function ajaxGetvalue(category,type){
			$.get(webroot+'/common/getChampsFields?category='+category+'&type='+type,function(res){
				hideLoadPage();
				if(!res.error){
					$("#cases-template-content").html('');
					$("#champs-template-content").html('');
					if(!$.isEmptyObject(res.dataChamps)){
						$("#champs-template").tmpl(res.dataChamps).appendTo("#champs-template-content");
					}
					if(!$.isEmptyObject(res.dataCases)){
						$("#cases-template").tmpl(res.dataCases).appendTo("#cases-template-content");
					}
					parent.$.fancybox.update();
					//console.log(res);
				}else{
					alert('Error...');
				}
				$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
			});
		}
		
		$("#AjouterDeBienForm").submit(function(){
			showloadPage();
			$.post(webroot+'/module/configAjouter',$(this).serialize(),function(res){
				hideLoadPage();
				alertify.set({ labels : { ok: "OK"} });
				alertify.alert(res.msg);
			});
			return false;
		});
	});
</script>
<div class="">
	<form class="form-horizontal well" id="AjouterDeBienForm" method="POST">
	<div class="nonboxy-widget">
		<fieldset>
				<div class="control-group">
					<label class="control-label" for="my_postal_code">Type de bien à ajouter :</label>
					<div class="controls">
						<select name="category" id="category_id">
							<?php if(!empty($categories)) foreach($categories as $id=>$category):?>
							<option value="<?php echo $id;?>"><?php echo $category;?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="my_postal_code">Type de transaction :</label>
					<div class="controls">
						<select name="type_property" id="type_property_id">
							<option value="1" selected="true">Vente</option>
							<option value="2">Location</option>
						</select>
					</div>
				</div>
			</fieldset>
		<div class="widget-head">
			<h5> <span class="color-icons"></span> Champs de saisie à afficher :</h5>
		</div>
		<div class="widget-content">
			<table class="table-default items table table-striped table-bordered">
				<tbody id="champs-template-content">
					
				</tbody>
			</table>
		</div>
		
		<div class="widget-head">
			<h5> <span class="color-icons"></span> Cases à cocher à afficher :</h5>
		</div>
		<div class="widget-content">
			<table class="table-default items table table-striped table-bordered">
				<tbody id="cases-template-content">
					
				</tbody>
			</table>
		</div>
		<fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-info">Valider et enregistrer</button>
				<button type="button" onclick="window.location.href='<?php echo PIUrl::createUrl('/module/configs');?>'" class="btn btn-warning">Retour</button>
			</div>
		</fieldset>
	</div>
	</form>
</div>