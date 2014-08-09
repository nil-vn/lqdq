<?php Yii::import('application.extensions.yii-mail.*');
class Mailer extends YiiMail {
	#Demo: Yii::app()->mail->sendMailWithTemplate('phihoang12b2@gmail.com','Subject','mail',array('email'=>'asdasdasd@gmail.com'));
	public function sendMailWithTemplate($email = NULL, $subject = NULL, $view = NULL, $data = NULL,$serverMail='info@immobilier.fr',$layout='layout',$from=NULL) {
		if (isset($email) && isset($view)) {
			/**
			 * @todo Change message email
			 */
			$subject = isset($subject) ? $subject : "(No Subject)";

			try {
				$message = new YiiMailMessage;
				$message->view = $layout;
				$message->setSubject($subject);
				
				$message->setBody(
					array(
						'data'	=> isset($data) ? $data : array(),
						'serverMail'=>$serverMail,
						'view'=>$view
					),
					'text/html'
				);

				$message->addTo($email);
				if($from != null){
					 $message->from = $from;
				}else{
					$from = 'orishop.biz@gmail.com';
				}
				$message->from = array($from => "www.immobilier.fr");
                                    
				Yii::app()->mail->send($message);
				return array(
					'error'	=> false,
					'data'=>$message
				);
			} catch (Exception $ex) {
				// TODO : Can't send mail
				
				return array(
					'error'	=> true,
					'message'=> $ex->getMessage()
				);
			}
		}else{
			return false;
		}
	}
}
