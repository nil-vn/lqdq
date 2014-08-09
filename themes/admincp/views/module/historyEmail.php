<?php
if(!empty($mail)){
	echo 'id_mail: '.$mail->id_mail.'</br>';
	echo 'de: '.$mail->de.'</br>';
	echo 'dest: '.$mail->dest.'</br>';
	echo 'url: '.$mail->url.'</br>';
	echo 'res: '.$mail->res.'</br>';
	echo 'dt: '.date('d/m/Y H:i:s',strtotime($mail->dt)).'</br>';
	echo 'errDesc: '.$mail->errDesc.'</br>';
	echo $mail->bodyHtml;
	echo "<br><hr style='width:500px'>".$mail->bodyText."<br>";
}