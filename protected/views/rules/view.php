<?php
/* @var $this RulesController */
/* @var $model Rules */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	$model->rules_id,
);

$this->menu=array(
	array('label'=>'List Rules', 'url'=>array('index')),
	array('label'=>'Create Rules', 'url'=>array('create')),
	array('label'=>'Update Rules', 'url'=>array('update', 'id'=>$model->rules_id)),
	array('label'=>'Delete Rules', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rules_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rules', 'url'=>array('admin')),
);
?>

<h1>View Rules #<?php echo $model->rules_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rules_id',
		'rules_name',
	),
)); ?>
