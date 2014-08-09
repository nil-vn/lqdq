<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/privilege/action.js"></script>
<?php
$this->widget('TableWidget', array(
    'caption' => null,
    'headers' => array('id annonce', 'Nom', 'Prenom', 'Mail', 'Tel', 'Date insertion', 'Adresse ip', 'Action'),
    'model' => $model,
    'row' => 'code/location_attente_row',
    'item_count' => $item_count,
    'page_size' => PAGE_SIZE,
    'pages' => $pages,
    'select' => $select,
));
?>