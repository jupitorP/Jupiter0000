<?php

class UserController extends Controller {

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
            // 'accessControl', // perform access control for CRUD operations
            // 'postOnly + delete', // we only allow deletion via POST request
            'rights'
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->titlepage = 'แสดงข้อมูลสมาชิก';
        Yii::app()->theme = 'bluewhale-admin';
        
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->titlepage = 'เพิ่มข้อมูลสมาชิก';
        Yii::app()->theme = 'bluewhale-admin';

        $model = new User;
        $model->setScenario('create');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

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

            //$model->user_active = 1;
            //$model->rules = 2;
            //$type = "Member";

            $modelRules = Rules::model()->findByPk($model->rules);
            $type = $modelRules->rules_rights;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', "เพิ่มข้อมูลสมาชิกเรียบร้อย");
                $authorizer = Yii::app()->getModule("rights")->authorizer;
                $authorizer->authManager->assign($type, $model->id);
                $this->redirect(array('view', 'id' => $model->id));
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
        $this->titlepage = 'แก้ไขข้อมูลสมาชิก';
        Yii::app()->theme = 'bluewhale-admin';

        $model = $this->loadModel($id);
        $model->setScenario('update');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (!empty($model->user_image)) {
            $user_image_old = $model->user_image;
        }

        if (!empty($model->user_file)) {
            $user_file_old = $model->user_file;
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

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
                if ($model->rules != $model->temp_rules) {
                    $authorizer = Yii::app()->getModule("rights")->authorizer;
                    $modelRules = Rules::model()->findByPk($model->temp_rules);
                    $typeTemp = $modelRules->rules_rights;
                    if (!empty($typeTemp)) {
                        $authorizer->authManager->revoke($typeTemp, $model->id);
                    }
                    $modelRules = Rules::model()->findByPk($model->rules);
                    $type = $modelRules->rules_rights;
                    if (!empty($type)) {
                        $authorizer->authManager->assign($type, $model->id);
                    }
                }
                Yii::app()->user->setFlash('success', "แก้ไขข้อมูลสมาชิกเรียบร้อย");
                $this->redirect(array('view', 'id' => $model->id));
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
        if (!empty($model->user_image)) {
            @unlink(Yii::app()->basePath . "/../users_image/" . $model->user_image); //ลบไฟล์เดิมทิ้ง
        }
        if (!empty($model->user_file)) {
            @unlink(Yii::app()->basePath . "/../users_file/" . $model->user_file); //ลบไฟล์เดิมทิ้ง
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->titlepage = 'จัดการข้อมูลสมาชิก';
        Yii::app()->theme = 'bluewhale-admin';

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

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
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
