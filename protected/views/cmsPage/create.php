<?php
$this->pageTitle = Yii::app()->name . ' - เพิ่มข้อมูล CMS Page';
$this->breadcrumbs = array(
    'จัดการ CMS Page' => array('admin'),
    'เพิ่มข้อมูล CMS Page'
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>