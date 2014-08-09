<?php
if (Yii::app()->user->hasFlash('success')) {
	echo "<p style='text-align: center;'>".Yii::app()->user->getFlash('success')."</p>";
}
if ($redirect) {
	header('Refresh: 3; url='.PIUrl::createUrl('/?property_id='.$id));
	//exit();
	// sleep(2);
	// $this->redirect(PIUrl::createUrl('/?property_id='.$id));
}
?>