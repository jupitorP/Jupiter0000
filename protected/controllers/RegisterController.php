<?php

class RegisterController extends Controller {

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
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'create'),
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionComplete($id) {
        $this->render('complete', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionEditpassword() {
        $id = Yii::app()->User->id;

        if (!empty($id)) {
            $model = $this->loadModel($id);

            $model->setScenario('editpassword');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Register'])) {
                $model->attributes = $_POST['Register'];
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "แก้ไขรหัสผ่านเรียบร้อย");
                    $this->redirect(array('editpassword'));
                }
            }

            $this->render('editpassword', array(
                'model' => $model,
            ));
        } else {
            $this->redirect(array('site/login'));
        }
    }

    public function actionEditprofile() {
        $id = Yii::app()->User->id;

        if (!empty($id)) {
            $model = $this->loadModel($id);

            $model->setScenario('editprofile');

            if (!empty($model->user_image)) {
                $user_image_old = $model->user_image;
            }

            if (!empty($model->user_file)) {
                $user_file_old = $model->user_file;
            }

            if (isset($_POST['Register'])) {
                $model->attributes = $_POST['Register'];

                $uploadedUserImage = CUploadedFile::getInstance($model, 'user_image');
                $uploadedUserFile = CUploadedFile::getInstance($model, 'user_file');

                if (!empty($model->del_user_image) && empty($uploadedUserImage)) {
                    @unlink(Yii::app()->basePath . "/../users_image/" . $user_image_old); //ลบไฟล์เดิมทิ้ง
                    $model->user_image = "";
                }

                /* begin save users image */
                if (!empty($uploadedUserImage)) {
                    $rnd = date('dmYHis');
                    $userImageType = end(explode('.', $uploadedUserImage));
                    $userImageName = "{$rnd}.{$userImageType}";
                    $model->user_image = $userImageName;
                    $uploadedUserImage->saveAs(dirname(__FILE__) . '/../../users_image/' . $userImageName);
                    @unlink(Yii::app()->basePath . "/../users_image/" . $user_image_old); //ลบไฟล์เดิมทิ้ง                        
                }
                /* end save users image */

                if (!empty($model->del_user_file) && empty($uploadedUserFile)) {
                    @unlink(Yii::app()->basePath . "/../users_file/" . $user_file_old); //ลบไฟล์เดิมทิ้ง
                    $model->user_file = "";
                }

                /* begin save user file */
                if (!empty($uploadedUserFile)) {
                    $rnd = date('dmYHis');
                    $userFileType = end(explode('.', $uploadedUserFile));
                    $userFileName = "{$rnd}.{$userFileType}";
                    $model->user_file = $userFileName;
                    $uploadedUserFile->saveAs(dirname(__FILE__) . '/../../users_file/' . $userFileName);
                    @unlink(Yii::app()->basePath . "/../users_file/" . $user_file_old); //ลบไฟล์เดิมทิ้ง
                }
                /* end save user file */


                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "แก้ไขข้อมูลส่วนตัวเรียบร้อย");
                    $this->redirect(array('editprofile'));
                }
            }

            $this->render('editprofile', array(
                'model' => $model,
            ));
        } else {
            $this->redirect(array('site/login'));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new Register;
        $model->setScenario('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Register'])) {
            $model->attributes = $_POST['Register'];

            $uploadedUserImage = CUploadedFile::getInstance($model, 'user_image');
            $uploadedUserFile = CUploadedFile::getInstance($model, 'user_file');

            /* begin save users image */
            if (!empty($uploadedUserImage)) {
                $rnd = date('dmYHis');
                $userImageType = end(explode('.', $uploadedUserImage));
                $userImageName = "{$rnd}.{$userImageType}";
                $model->user_image = $userImageName;
                $uploadedUserImage->saveAs(dirname(__FILE__) . '/../../users_image/' . $userImageName);
            }
            /* end save users image */

            /* begin save user file */
            if (!empty($uploadedUserFile)) {
                $rnd = date('dmYHis');
                $userFileType = end(explode('.', $uploadedUserFile));
                $userFileName = "{$rnd}.{$userFileType}";
                $model->user_file = $userFileName;
                $uploadedUserFile->saveAs(dirname(__FILE__) . '/../../users_file/' . $userFileName);
            }
            /* end save user file */

            $model->user_active = 1;
            $model->rules = 2;
            $type = "Member";

            if ($model->save()) {
                $authorizer = Yii::app()->getModule("rights")->authorizer;
                $authorizer->authManager->assign($type, $model->id);
                $this->redirect(array('complete', 'id' => $model->id));
            }
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Register'])) {
            $model->attributes = $_POST['Register'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /*
          $dataProvider = new CActiveDataProvider('Register');
          $this->render('index', array(
          'dataProvider' => $dataProvider,
          ));
         */
        $this->redirect(array('create'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Register('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Register']))
            $model->attributes = $_GET['Register'];

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
        $model = Register::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
