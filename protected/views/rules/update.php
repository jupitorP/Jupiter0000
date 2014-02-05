<?php
/* @var $this RulesController */
/* @var $model Rules */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	$model->rules_id=>array('view','id'=>$model->rules_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rules', 'url'=>array('index')),
	array('label'=>'Create Rules', 'url'=>array('create')),
	array('label'=>'View Rules', 'url'=>array('view', 'id'=>$model->rules_id)),
	array('label'=>'Manage Rules', 'url'=>array('admin')),
);
?>

<h1>Update Rules <?php echo $model->rules_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>