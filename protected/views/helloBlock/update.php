<?php
$this->pageTitle = Yii::app()->name . ' - แก้ไขข้อมูล Hello Block';
$this->breadcrumbs = array(
    'จัดการ Hello Block' => array('admin'),
    'แก้ไขข้อมูล Hello Block'
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>