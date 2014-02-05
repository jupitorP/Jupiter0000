<?php
/* @var $this TagController */
/* @var $model ProductTag */

$this->breadcrumbs=array(
	'Product Tags'=>array('index'),
	$model->tag_id=>array('view','id'=>$model->tag_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductTag', 'url'=>array('index')),
	array('label'=>'Create ProductTag', 'url'=>array('create')),
	array('label'=>'View ProductTag', 'url'=>array('view', 'id'=>$model->tag_id)),
	array('label'=>'Manage ProductTag', 'url'=>array('admin')),
);
?>

<h1>Update ProductTag <?php echo $model->tag_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>