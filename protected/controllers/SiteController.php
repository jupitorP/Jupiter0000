<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public $layout = '//layouts/column2';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        $modelCmsPage = CmsPage::model()->find(array(
            'select' => 'title,page_content',
            'condition' => 'identifier=:identifier',
            'params' => array(':identifier' => 'hello-page'),
                ));
        $criteria = new CDbCriteria;
        $criteria->with = array('category');
        $criteria->select = 'category.category_name as category_name,t.product_active_price,t.product_code,t.product_name,t.product_amount,t.product_price,t.product_image';
        $criteria->limit = 12;
        $criteria->order = 'category.category_name  ASC';

        $dataProvider = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria, 'pagination' => false));

        $this->render('index', array(
            'modelCmsPage' => $modelCmsPage,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode("*** แจ้งการติดต่อเรา www.สติ๊กเกอร์ติดขนม.com ***") . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";
                        
                $Content = "==============================\r\n";
                $Content.="หัวข้อ : $model->subject\r\n";
                $Content.="ชื่อ-นามสกุล : $model->name\r\n";
                $Content.="เบอร์โทร : $model->tel\r\n";
                $Content.="อีเมล : $model->email\r\n";
                $Content.="รายละเอียด : $model->body\r\n";
                $Content.= "==============================\r\n";

                mail(Yii::app()->params['adminEmail'], $subject, $Content, $headers);
                Yii::app()->user->setFlash('success', 'ได้รับข้อมูลติดต่อเราเรียบร้อย ขอบคุณเป็นอย่างสูง');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}