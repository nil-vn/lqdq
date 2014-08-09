<?php
	// caption
	// headers[]
	// filters
	// model[]
	// params[] = {'action'=>'','method'=>'post','submitValue'=>'ok'}
	// protected/components/views/tableWidget.php
	
?>
<style>
td form {
	margin: 10px 0 10px;
}
</style>
<table <?php echo $inlineStyle;?>>
	<?php if ($caption!=null) {?>
    <caption><strong><h2><?php echo $caption?></h2></strong></caption>
	<?php }?>
    <thead>
        <tr>
			<?php foreach($headers as $header) {?>
				<th scope="col" style="text-align:center"><?php echo $header;?></th>
			<?php } ?>
        </tr>
    </thead>
	<?php if ($filter!=null) {?>
    <tbody>
        <tr>
            <td  style="text-align:center"  class="well form-inline" colspan="<?php echo count($headers);?>">
				<?php 
					if ($isView) {
						$this->controller->renderPartial($filter);
					} else {
						echo $filter;
					}
				?>
            </td>
        </tr>
    </tbody>
	<?php } ?>
	<?php if ($item_count>$page_size) { 
	
	$queryString = '';
	if (strpos($_SERVER['QUERY_STRING'],'page')===false) {
		$queryString = $_SERVER['QUERY_STRING'];
	} else {
		$params = explode('&',$_SERVER['QUERY_STRING']);
		foreach ($params as $key => $value) {
			if (strpos($value,'page')===false) {		
				$queryString .= $value.'&';
			} else {
				$params[$key] = '';
			}
		}
	}
	$queryString = trim($queryString,'&');
	
	if ($queryString != '') {
		$queryString = '&'.$queryString;
	}
	?>
    <tbody>
        <tr>
            <td colspan="<?php echo count($headers);?>" style="text-align:center">
            	<?php $this->widget('CLinkPager', array(
					'pages'=>$pages,
					'selectedPageCssClass'=>'active',
					'hiddenPageCssClass'=>'disabled',
					'header'=>'',
					'htmlOptions'=>array(
						'class'=>'pagination',
						'style'=>'display:inline-block',
					),
				)); ?>
            </td>
        </tr>
    </tbody>
	<?php }?>
	<?php if($item_count<=0) { ?>
	<tbody>
        <tr>
            <td colspan="8" style="text-align:center">
                <font color="red">Aucune donnée correspondante.</font>
            </td>
        </tr>
    </tbody>
	<?php } else {?>
    <tbody class="dataTable">
        <?php
        //dump($select);
        foreach ($model as $data) {
			$this->controller->renderPartial($row,array('rowData'=>$data,'select'=>$select));
			//dump($data->$select[5]);
		}
		?>
    </tbody>
	<?php if ($resultCaption!=null) {?>
    <tfoot>
        <tr>
            <th scope="row" style="text-align:center">Total</th>
            <th colspan="<?php echo (count($headers)-1);?>" style="text-align:center">
				<?php
				// if ($total!=null){
				// 	echo $total.' '.$resultCaption;
				// } else {
					echo $item_count.' '.$resultCaption;
				// }
				?> 
            </th>
        </tr>
    </tfoot>
	<?php } ?>
	<?php } ?>
</table>