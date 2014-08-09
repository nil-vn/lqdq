<?php $res = array();
    foreach ($row as $key=>$val) {
        $res[] = array('label'=>$key,'value'=>$val);
    }
$this->widget('zii.widgets.CDetailView', array(
'data' => array(), //to avoid error
'attributes' => $res,
));
?>
