<?php
/* @var $this PaymentConfirmController */
/* @var $model PaymentConfirm */

$this->breadcrumbs=array(
	'Payment Confirms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PaymentConfirm', 'url'=>array('index')),
	array('label'=>'Manage PaymentConfirm', 'url'=>array('admin')),
);
?>

<h1>Create PaymentConfirm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>