<?php

class LoginController extends Controller {

    public $defaultAction = 'login';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (Yii::app()->user->isGuest) {
            $model = new UserLogin;
            // collect user input data
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to previous page if valid
                if ($model->validate()) {
                    $this->lastViset();
                    if (Yii::app()->user->returnUrl == '/index.php')
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    else
                        $this->redirect(PIUrl::createUrl('/'));
                    //$this->redirect(Yii::app()->user->returnUrl);
                }else {
                 $model->verifyCode = '';   
                }
            }
            // display the login form
            $this->render('/user/login', array('model' => $model));
        } else
            $this->redirect(PIUrl::createUrl('/'));
        //$this->redirect(Yii::app()->controller->module->returnUrl);
    }

    private function lastViset() {
        $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }

}
