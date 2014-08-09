<table summary="" >
	<caption><?php echo $title; ?></caption>
	<tbody>
		<tr>
			<td colspan="7">
				<?php $this->widget('CLinkPager', array(
					'pages'=>$pages,
				)); ?>
			</td>
		</tr>
	</tbody>
	<tbody>
		<tr>
			<th scope="col" title="Pas interess&eacute; par privil&egrave;ge"><a href="javascript:doOrder('pip')">PIP</a></th>
			<th scope="col"><a href="javascript:doOrder('commentaire')">Commentaire</a></th>
			<th scope="col"><a href="javascript:doOrder('id')">Ref. annonce</a></th>
			<th scope="col"><a href="javascript:doOrder('nom')">Nom</a></th>
			<th scope="col"><a href="javascript:doOrder('adresse')">Adresse du bien</a></th>
			<th scope="col"><a href="javascript:doOrder('prix')">Prix</a></th>
			<th scope="col"><a href="javascript:doOrder('dMaj')">Date MAJ</a></th>
		</tr>
	</tbody>
	<?php if (count($listAnnonces)) : ?>
	<tbody>
		<?php foreach ($listAnnonces as $annonce) : ?>
		<tr id="id<?php echo $annonce['annonce']['id']; ?>">
			<td scope="row">
				<?php if ($annonce['info']['pip'] == 1 || $annonce['info']['pip'] == 2) $btn0="visible"; else $btn0="hidden"; ?>
				<img id="btn0<?php echo $annonce['annonce']['id']; ?>" src="/back-office/images/162/28.png" title="Annuler le choix" align="absmiddle" border="0" onclick="pip(<?php echo $annonce['annonce']['id']; ?>,0,'')" style="cursor:pointer; visibility:<?php $btn0; ?>">&nbsp;&nbsp;&nbsp;
				<?php if ($annonce['info']['pip'] == 2) $btn2="hidden"; else $btn2="visible"; ?>
				<img id="btn2<?php echo $annonce['annonce']['id']; ?>" src="/back-office/images/16/01.png" title="Pas interess&eacute;" align="absmiddle" border="0" onclick="pip(<?php echo $annonce['annonce']['id']; ?>,2,'')" style="cursor:pointer; visibility:<?php $btn2; ?>">&nbsp;&nbsp;&nbsp;
				<?php if ($annonce['info']['pip'] == 1) $btn1="hidden"; else $btn1="visible"; ?>
				<img id="btn1<?php echo $annonce['annonce']['id']; ?>" src="/back-office/images/16/02.png" title="Interess&eacute;" align="absmiddle" border="0" onclick="pip(<?php echo $annonce['annonce']['id']; ?>,1,'')" style="cursor:pointer; visibility:<?php $btn1; ?>">
			</td>
			<td valign="top" style="vertical-align: top"><form name="ft<?php echo $annonce['annonce']['id']; ?>"><textarea name="com" style="width:150px;height:30px;vertical-align: top" onfocus="this.style.color='red'"><?php echo $annonce['info']['com']; ?></textarea><input type="button" name="OK" value="OK" style="height:30px;vertical-align: top" onclick="pip(<?php echo $annonce['annonce']['id']; ?>,3,this.form.com.value)"></form></td>
			<td><a href="<?php echo Yii::app()->createAbsoluteUrl('/') . '?property_id=' . $annonce['annonce']['id']; ?>" target="_blank">BTK<?php echo $annonce['annonce']['id']; ?></a></td>
			<td><?php echo WpUserMeta::model()->getMetaValues($annonce['annonce']['user_id'], 'first_name') . " " . WpUserMeta::model()->getMetaValues($annonce['annonce']['user_id'], 'last_name'); ?></td>
			<td>
				<?php echo $annonce['annonce']['address']; ?><br>
				<?php echo $annonce['annonce']['postal_code'] . " " . $annonce['annonce']['city']; ?>
			</td>
			<td><strong><?php echo $annonce['annonce']['prix']; ?></strong> &euro;</td>
			<td><?php echo $annonce['annonce']['date_mail']; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tbody>
		<tr>
			<td colspan="7">
				<?php $this->widget('CLinkPager', array(
					'pages'=>$pages,
				)); ?>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
			<td colspan="5"><?php echo $pages->itemCount . " annonces"; ?></td>
		</tr>
	</tfoot>
	<?php else: ?>
	<tbody>
		<tr>
			<td colspan="6"><font color="red">Aucune donn&eacute;e correspondante.</font></td>
		</tr>
	</tbody>
	<?php endif; ?>
</table>


<script>
function doOrder(colName){
	
}
function pip(id,interesse,com){
	$.ajax({
		url: '<?php echo Yii::app()->createUrl('/module/traitementProspection'); ?>',
		type: 'POST',
		data: "id="+id+"&interesse="+interesse+"&com="+escape(com),
		success: function(response)
		{
			if (response.ret == 1) {
				pipcmd(id, interesse);
			} else {
				alert(response.msg);
			}
		}
	});
	//sendQueryAjaxEval("ajax/traitementProspection.asp","id="+id+"&interesse="+interesse+"&com="+escape(com));
}
function pipcmd(id,interesse){
	var mycolor,dis,en1,en2,mytitle;
	if(interesse=="0"){
		mycolor="#ffffff";
		dis=0;
		en1=1;
		en2=2;
		mytitle="";
		}
	else if(interesse=="2"){
		mycolor="#BDBDBD";
		dis=2;
		en1=1;
		en2=0;
		mytitle="Pas interessé";
		}
	
	else if(interesse=="1"){
		mycolor="#A9D0F5";
		dis=1;
		en1=2;
		en2=0;
		mytitle="Interessé";
		}
	else if(interesse=="3"){
		document.forms["ft"+id].elements["com"].style.color='black';
		return;
	}
	else 
		return;
	
	document.getElementById("id"+id).title =mytitle;
	document.getElementById("id"+id).style.background = mycolor;
	document.getElementById("btn"+dis+""+id).style.visibility ="hidden";
	document.getElementById("btn"+en1+""+id).style.visibility ="visible"
	document.getElementById("btn"+en2+""+id).style.visibility ="visible"
}
</script>