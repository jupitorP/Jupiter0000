<?php

class TagController extends Controller {

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

    public function actionView($TagName=null) {
        if(!empty($TagName)){
       $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('product');
        $criteria->select = 'product.product_id as product_id,product.product_name as product_name,
            product.product_code As product_code,product.product_name As product_name,product.product_amount As product_amount,
            product.product_price As product_price,product.product_image As product_image,product.product_active_price As product_active_price';
         $criteria->condition = "tag_name='$TagName' ";
     $dataProvider = new CActiveDataProvider('ProductTag',array(
         'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 50,
                    )
     ));
        $this->render('view', array(
            'dataProvider' => $dataProvider,
            'tagName'=>$TagName
        ));
    }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ProductTag;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ProductTag'])) {
            $model->attributes = $_POST['ProductTag'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->tag_id));
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

        if (isset($_POST['ProductTag'])) {
            $model->attributes = $_POST['ProductTag'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->tag_id));
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
        echo 'xxx';
        exit();
        $dataProvider = new CActiveDataProvider('ProductTag');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ProductTag('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProductTag']))
            $model->attributes = $_GET['ProductTag'];

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
        $model = ProductTag::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-tag-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
