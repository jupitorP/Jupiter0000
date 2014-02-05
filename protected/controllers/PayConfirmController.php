<?php

class PayConfirmController extends Controller {

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

    public function actionIndex() {
        $model = new PayConfirmForm;
        $model->setScenario('index');

        $modelCmsPage = CmsPage::model()->find(array(
            'select' => 'title,page_content',
            'condition' => 'identifier=:identifier',
            'params' => array(':identifier' => 'pay-confirm'),
                ));

        if (isset($_POST['PayConfirmForm'])) {
            $model->attributes = $_POST['PayConfirmForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode("*** แจ้งการชำระเงิน www.ProGressSystem.com ***") . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                $Content = "==============================\r\n";
                $Content.="ชื่อ-นามสกุล : $model->name\r\n";
                $Content.="หมายเลขสั่งซื้อ : $model->orderId\r\n";
                $Content.="เบอร์โทร : $model->mobile\r\n";
                $Content.="อีเมล : $model->email\r\n";
                $Content.="จำนวนเงิน : $model->price\r\n";
                $Content.="ธนาคารที่โอนเงิน : $model->bankPayment\r\n";
                $Content.="วันที่โอนเงิน : ".Helpers::dateConvert($model->timePayment,'short')."\r\n";
                $Content.="หมายเหตุ : $model->note\r\n";
                $Content.= "==============================\r\n";

                mail(Yii::app()->params['adminEmail'], $subject, $Content, $headers);
                Yii::app()->user->setFlash('success', "แจ้งการชำระเงินเสร็จเรียบร้อย ขอบคุณสำหรับการชำระเงิน");
                $this->refresh();
            }
        }

        $this->render('index', array(
            'modelCmsPage' => $modelCmsPage,
            'model' => $model,
        ));
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}