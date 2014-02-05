<?php
$this->pageTitle = Yii::app()->name . ' - แก้ไขข้อมูลสมาชิก';
$this->breadcrumbs = array(
    'จัดการสมาชิก' => array('admin'),
    'แก้ไขข้อมูลสมาชิก ' . '(' . $model->user_firstname . ' ' . $model->user_lastname . ')'
);
?>
<?php echo $this->renderPartial('updateForm', array('model'=>$model)); ?>