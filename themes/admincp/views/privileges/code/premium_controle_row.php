<?php
$data[0] = $rowData->$select[0];
$data[1] = $rowData->$select[1];
$data[2] = $rowData->$select[2];
$data[3] = date(Yii::app()->params['datetime'], strtotime($rowData->$select[3]));
$data[4] = $rowData->$select[4];
switch ($data[2]) {
    case 0:
        $css = ' class="simple"';
        $status = 'Attente traitement';
        break;
    case 1:
        $css = ' class="avocat"';
        $status = "";
        break;
    case 2:
        $css = ' class="mail"';
        $status = 'Basculé en contrôle';
        break;
    case 3:
        $css = ' class="recommande"';
        $status = 'Contrôle effectué';
        break;
}
if (strlen($data[4]) > 0) {
    if (strtotime(date('Y-m-d')) > strtotime($data[4])) {
        $css = ' style="background-color:#CF0"';
        $status = '<strong style="color:red">Rappel du ' . date(Yii::app()->params['date'], strtotime($data[4])) . '</strong>';
    }
}
?>
<tr>
    <th scope="row" <?php echo $css; ?>>
        <a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[1]; ?>" target="_blank">BTK<?php echo $data[1]; ?></a>
    </th>
    <td><strong><?php echo $status; ?></strong></td>
    <td><?php echo $data[3]; ?></td>
    <td>

    </td>		  
    <td style="text-align:center">
        <?php if ($data[2] == 0) { ?>
            <a href="javascript:void();" class="premium_controle_supprimer" value="<?php echo $data[1]; ?>" title="Supprimer du tableau et actualiser l'annonce">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/privilege/01.png" width="16" height="16" border="0" alt="Supprimer du tableau et actualiser l'annonce" />
            </a>
            <!-- RAPPEL ANNONCE -->
            <div id="fr<?php echo $data[0]; ?>">
                Rappeler dans: 
                <select name="delay" class="delay" style="width:55px">                            
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        $select = '';
                        if ($i == 3) {
                            $select = 'selected="selected"';
                        }
                        echo '<option value="' . $i . '" ' . $select . '>' . $i . '</option> ';
                    }
                    ?>                            	
                </select> 
                <select name="period" class="period" style="width:100px">
                    <option value="d">jours</option>
                    <option value="w" selected="selected">semaines</option>
                    <option value="m">mois</option>
                </select>
                <a href="javascript:void(0);" class="premium_controle_rappel" value="<?php echo $data[0]; ?>" align="absmiddle" alt="" title="Rappeler ce client" >
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/privilege/37.png" /> 
                </a>
            </div>	
        <?php } ?>	      
    </td>
</tr>