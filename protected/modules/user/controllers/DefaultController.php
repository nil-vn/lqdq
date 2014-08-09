<?php

class DefaultController extends Controller
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = $this->module->layout;
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANNED,
		    ),
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('/user/index',array(
			'dataProvider'=>$dataProvider,
		));
	}

}