<?php
$this->pageTitle = 'แก้ไขแจ้งการชำระเงิน';
$this->breadcrumbs = array(
    'แจ้งการชำระเงิน' => array('admin'),
    'แก้ไขแจ้งการชำระเงิน ' . '(' . $model->firstname . ' ' . $model->lastname .')'
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>