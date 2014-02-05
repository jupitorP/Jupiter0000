<?php
/* @var $this TagController */
/* @var $model ProductTag */

$this->breadcrumbs=array(
	'Product Tags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductTag', 'url'=>array('index')),
	array('label'=>'Manage ProductTag', 'url'=>array('admin')),
);
?>

<h1>Create ProductTag</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>