<?php
$this->pageTitle = Yii::app()->name . ' - แก้ไขข้อ CMS Page';
$this->breadcrumbs = array(
    'จัดการ CMS Page' => array('admin'),
    'แก้ไขข้อ CMS Page ' . '(' . $model->identifier . ')'
);
?>
<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>