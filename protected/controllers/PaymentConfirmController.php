<?php

class PaymentConfirmController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights'
        );
    }

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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'แจ้งการชำระเงิน';

        $model = $this->loadModel($id);
        $model->setScenario('view');

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->titlepage = 'เพิ่มข้อแจ้งการชำระเงิน';
        Yii::app()->theme = 'bluewhale-admin';

        $model = new PaymentConfirm;
        $model->setScenario('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PaymentConfirm'])) {
            $model->attributes = $_POST['PaymentConfirm'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->payment_confirm_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->titlepage = 'แก้ไขข้อมูลแจ้งการชำระเงิน';
        Yii::app()->theme = 'bluewhale-admin';

        $model = $this->loadModel($id);
        $model->setScenario('update');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (!empty($model->payment_confirm_file)) {
            $payment_confirm_file_old = $model->payment_confirm_file;
        }

        if (isset($_POST['PaymentConfirm'])) {
            $model->attributes = $_POST['PaymentConfirm'];

            $uploadedPaymentConfirmFile = CUploadedFile::getInstance($model, 'payment_confirm_file');

            if (!empty($model->del_payment_confirm_file) && empty($uploadedPaymentConfirmFile)) {
                @unlink(Yii::app()->basePath . "/../payment_confirm_file/" . $payment_confirm_file_old); //ลบไฟล์เดิมทิ้ง
                $model->payment_confirm_file = "";
            }

            /* begin save user file */
            if (!empty($uploadedPaymentConfirmFile)) {
                $rnd = date('dmYHis');
                $paymentConfirmFileType = end(explode('.', $uploadedPaymentConfirmFile));
                $paymentConfirmFileName = "{$rnd}.{$paymentConfirmFileType}";
                $model->payment_confirm_file = $paymentConfirmFileName;
                $uploadedPaymentConfirmFile->saveAs(dirname(__FILE__) . '/../../payment_confirm_file/' . $paymentConfirmFileName);
                @unlink(Yii::app()->basePath . "/../payment_confirm_file/" . $payment_confirm_file_old); //ลบไฟล์เดิมทิ้ง
            }
            /* end save user file */

            if ($model->save()) {
                Yii::app()->user->setFlash('success', "แก้ไขข้อมูลแจ้งการชำระเงินเรียบร้อย");
                $this->redirect(array('view', 'id' => $model->payment_confirm_id));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->setScenario('delete');

        if (!empty($model->payment_confirm_file)) {
            @unlink(Yii::app()->basePath . "/../payment_confirm_file/" . $model->payment_confirm_file); //ลบไฟล์ทิ้ง
        }

        $model->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->titlepage = 'แจ้งการชำระเงิน';

        $model = new PaymentConfirm;
        $model->setScenario('index');

        if (isset($_POST['PaymentConfirm'])) {
            $model->attributes = $_POST['PaymentConfirm'];

            $uploadedPaymentConfirmFile = CUploadedFile::getInstance($model, 'payment_confirm_file');

            /* begin save payment confirm file */
            if (!empty($uploadedPaymentConfirmFile)) {
                $rnd = date('dmYHis');
                $paymentConfirmFileType = end(explode('.', $uploadedPaymentConfirmFile));
                $paymentConfirmFileName = "{$rnd}.{$paymentConfirmFileType}";
                $model->payment_confirm_file = $paymentConfirmFileName;
                $uploadedPaymentConfirmFile->saveAs(dirname(__FILE__) . '/../../payment_confirm_file/' . $paymentConfirmFileName);
            }
            /* end save payment confirm file */

            if ($model->save()) {

                /* begin send mail */
                $modelBank = Bank::model()->findByPk($model->bank_id);
                $name = '=?UTF-8?B?' . base64_encode($model->firstname . ' ' . $model->lastname) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode("*** แจ้งการชำระเงิน www.สติ๊กเกอร์ติดขนม.com ***") . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                $Content = "==============================\r\n";
                $Content.="ชื่อ-นามสกุล : $model->firstname $model->lastname\r\n";
                $Content.="หมายเลขสั่งซื้อ : $model->order_number\r\n";
                $Content.="เบอร์โทร : $model->tel\r\n";
                $Content.="อีเมล : $model->email\r\n";
                $Content.="จำนวนเงิน : $model->price\r\n";
                $Content.="ธนาคารที่โอนเงิน : $modelBank->bank_name\r\n";
                $Content.="วันที่โอนเงิน : " . Helpers::dateConvert($model->payment_confirm_time, 'short') . "\r\n";
                $Content.="หมายเหตุ : $model->note\r\n";
                $Content.= "==============================\r\n";

                mail(Yii::app()->params['adminEmail'], $subject, $Content, $headers);
                /* end send mail */

                Yii::app()->user->setFlash('success', "ได้รับข้อมูลแจ้งการชำระเงินเรียบร้อย ขอบคุณเป็นอย่างสูง");
                $this->refresh();
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'แจ้งการชำระเงิน';

        $model = new PaymentConfirm('search');
        $model->setScenario('admin');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['PaymentConfirm']))
            $model->attributes = $_GET['PaymentConfirm'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = PaymentConfirm::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'payment-confirm-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
