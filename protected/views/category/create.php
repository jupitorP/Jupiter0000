<?php
$this->pageTitle = 'เพิ่มหมวดสินค้า';
$this->breadcrumbs = array(
    'จัดการหมวดสินค้า' => array('admin'),
    'เพิ่มหมวดสินค้า'
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>