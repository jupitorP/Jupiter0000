<?php
$this->pageTitle = 'แก้ไขหมวดสินค้า';
$this->breadcrumbs = array(
    'จัดการหมวดสินค้า' => array('admin'),
    'แก้ไขหมวดสินค้า ' . '(' . $model->category_name . ')'
);
?>
<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>