<?php
$this->pageTitle = Yii::app()->name . ' - เพิ่มข้อมูลสมาชิก';
$this->breadcrumbs = array(
    'จัดการสมาชิก' => array('admin'),
    'เพิ่มข้อมูลสมาชิก'
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>