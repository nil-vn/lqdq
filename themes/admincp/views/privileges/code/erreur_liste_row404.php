<?php
$data[0] = date(Yii::app()->params['date'],strtotime($rowData->$select[0]));
$data[1] = htmlspecialchars($rowData->$select[1]);
$data[2] = $rowData->$select[2];
$data[3] = $rowData->$select[3];
$data[4] = $rowData->$select[4];
$data[5] = $rowData->$select[5];
$data[6] = $rowData->$select[6];
//dump($data[1]);
?>
<tr>
<td><?php echo $data[0]?></td>
<td>'</td>
<td><?php echo $data[1];?></td>
<td>'</td>
<td><?php echo $data[2]?></td>
<td><?php echo $data[3]?></td>
<td><?php echo $data[4]?></td>
<td><?php echo $data[5]?></td>
<td><?php echo $data[6]?></td>
</tr>