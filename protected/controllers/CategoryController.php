<?php

class CategoryController extends Controller {

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
        $this->titlepage = 'ข้อมูลหมวดสินค้า';
        
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
        $this->titlepage = 'เพิ่มหมวดสินค้า';
        
        $model = new Category;
        $model->setScenario('create');
        
        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            if ($model->save()){
                Yii::app()->user->setFlash('success', "เพิ่มข้อมูลเสร็จเรียบร้อย");
                $this->redirect(array('admin'));
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
        $this->titlepage = 'แก้ไขหมวดสินค้า';
        $model = $this->loadModel($id);
        $model->setScenario('update');
        
        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            if ($model->save()){
                Yii::app()->user->setFlash('success', "แก้ไขข้อมูลเสร็จเรียบร้อย");
                $this->redirect(array('admin'));
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
        $this->loadModel($id)->delete();
        $model->setScenario('delete');

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($id=null) {

        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('category');
        $criteria->select = 'category.category_name as category_name,t.product_name as product_name';
        if (!empty($id)) {
            $criteria->condition = "t.category_id='$id' ";
        }
        $dataProvider = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria));
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'จัดการหมวดสินค้า';
        $model = new Category('search');
        $model->setScenario('admin');
        
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Category']))
            $model->attributes = $_GET['Category'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
