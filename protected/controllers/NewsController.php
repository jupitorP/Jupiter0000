<?php

class NewsController extends Controller {

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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        Yii::app()->theme = 'bluewhale-admin';
        $model = new News;
        $model->setScenario('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];

            $uploadedNewsImage = CUploadedFile::getInstance($model, 'news_image');
            $uploadedNewsFile = CUploadedFile::getInstance($model, 'news_file');

            /* begin save news image */
            if (!empty($uploadedNewsImage)) {
                $rnd = date('dmYHis');
                $newsImageType = end(explode('.', $uploadedNewsImage));
                $newsImageName = "{$rnd}.{$newsImageType}";
                $model->news_image = $newsImageName;
                $uploadedNewsImage->saveAs(dirname(__FILE__) . '/../../news_image/' . $newsImageName);
            }
            /* end save news image */

            /* begin save news file */
            if (!empty($uploadedNewsFile)) {
                $rnd = date('dmYHis');
                $newsFileType = end(explode('.', $uploadedNewsFile));
                $newsFileName = "{$rnd}.{$newsFileType}";
                $model->news_file = $newsFileName;
                $uploadedNewsFile->saveAs(dirname(__FILE__) . '/../../news_file/' . $newsFileName);
            }
            /* end save news file */

            if ($model->save())
                $this->redirect(array('admin'));
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model->setScenario('update');

        if (!empty($model->news_image)) {
            $news_image_old = $model->news_image;
        }

        if (!empty($model->news_file)) {
            $news_file_old = $model->news_file;
        }

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];

            $uploadedNewsImage = CUploadedFile::getInstance($model, 'news_image');
            $uploadedNewsFile = CUploadedFile::getInstance($model, 'news_file');

            if (!empty($model->del_news_image) && empty($uploadedNewsImage)) {
                @unlink(Yii::app()->basePath . "/../news_image/" . $news_image_old); //ลบไฟล์เดิมทิ้ง
                $model->news_image = "";
            }

            /* begin save users image */
            if (!empty($uploadedNewsImage)) {
                $rnd = date('dmYHis');
                $newsImageType = end(explode('.', $uploadedNewsImage));
                $newsImageName = "{$rnd}.{$newsImageType}";
                $model->news_image = $newsImageName;
                $uploadedNewsImage->saveAs(dirname(__FILE__) . '/../../news_image/' . $newsImageName);
                @unlink(Yii::app()->basePath . "/../news_image/" . $news_image_old); //ลบไฟล์เดิมทิ้ง                        
            }
            /* end save users image */

            if (!empty($model->del_news_file) && empty($uploadedNewsFile)) {
                @unlink(Yii::app()->basePath . "/../news_file/" . $news_file_old); //ลบไฟล์เดิมทิ้ง
                $model->news_file = "";
            }

            /* begin save user file */
            if (!empty($uploadedNewsFile)) {
                $rnd = date('dmYHis');
                $newsFileType = end(explode('.', $uploadedNewsFile));
                $newsFileName = "{$rnd}.{$newsFileType}";
                $model->news_file = $newsFileName;
                $uploadedNewsFile->saveAs(dirname(__FILE__) . '/../../news_file/' . $newsFileName);
                @unlink(Yii::app()->basePath . "/../news_file/" . $news_file_old); //ลบไฟล์เดิมทิ้ง
            }
            /* end save user file */

            if ($model->save())
                $this->redirect(array('admin'));
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

        if (!empty($model->news_image)) {
            @unlink(Yii::app()->basePath . "/../news_image/" . $model->news_image); //ลบไฟล์
        }

        if (!empty($model->news_file)) {
            @unlink(Yii::app()->basePath . "/../news_file/" . $model->news_file); //ลบไฟล์
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

        $criteriaNews->select = 'news_id,news_topic,news_image,news_date';
        $criteriaNews->condition = 'news_active=1';
        $criteriaNews->order = 'news_id ASC';

        $dataProvider = new CActiveDataProvider('News', array(
                    'criteria' => $criteriaNews));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->titlepage='ข่าวประชาสัมพันธ์';
        Yii::app()->theme = 'bluewhale-admin';
        $model = new News('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['News']))
            $model->attributes = $_GET['News'];

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
        $model = News::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
