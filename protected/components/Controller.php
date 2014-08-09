<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = 'main';
	public $theme = 'admincp';
	public $baseHost;
	public $baseHostPlugin;
	public $image = '';
	public $description='';
	public $keywords='';
	public $about='';
	public $title='';
	public $categories=array();
	public $acticleCategories=array();
	public $property_id = null;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function init(){
		parent::init();
		$this->baseHost = Yii::app()->request->hostInfo;
		$this->baseHostPlugin = $this->baseHost.'/wp-content/plugins/immobilier';
	}
	protected function afterRender($view, &$output) {
		Yii::app()->clientScript->registerCoreScript('jquery');
		//Yii::app()->dynamicRes->debug();
		//Yii::app()->dynamicRes->saveScheme();
	}
	
	/**
	* $data = array(
	*	'view'=>'mail',
	*	'server'=>'phihoang12b2@gmail.com',
	*	'data'=>array(
	*		'email'=>'phihoang12b2@gmail.com'
	*	)
	*);
	*$this->SendMail('hjkhjkh@jkhjk.kjljlk','asdad',$data,'layout');
	**/
	
	public function SendMail($mailTo = '',$subject = '',$params=array(),$layout = 'layout')
	{
		if(isset($params['server']) && $params['server'] != ''){
			$mailFrom = $params['server'];
		}
		$message	=	new YiiMailMessage;
		$message->view = $layout;
		$sid				= 1;
		$params				= $params;
		$message->subject	= $subject;
		//$message->from = $mailFrom;
		$message->setBody($params, 'text/html');
		$message->addTo($mailTo);
		return Yii::app()->mail->send($message);
	}
}