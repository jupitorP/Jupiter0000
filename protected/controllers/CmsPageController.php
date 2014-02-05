<?php

class CmsPageController extends Controller {

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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'ข้อมูล CMS Page';
        
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
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'เพิ่มข้อมูล CMS Page';
        
        $model = new CmsPage;
        $model->setScenario('create');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CmsPage'])) {
            $model->attributes = $_POST['CmsPage'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "บันทึกข้อมูลเรียบร้อย");
                $this->redirect(array('view', 'id' => $model->page_id));
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
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'แก้ไขข้อมูล CMS Page';
        
        $model = $this->loadModel($id);
        $model->setScenario('update');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CmsPage'])) {
            $model->attributes = $_POST['CmsPage'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "แก้ไขข้อมูลเรียบร้อย");
                $this->redirect(array('view', 'id' => $model->page_id));
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
        $model ->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CmsPage');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'จัดการ CMS Page';        

        $model = new CmsPage('search');
        $model->setScenario('admin');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CmsPage']))
            $model->attributes = $_GET['CmsPage'];

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
        $model = CmsPage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cms-page-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
