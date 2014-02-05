<?php
/* @var $this HelloBlockController */
/* @var $model HelloBlock */

$this->breadcrumbs=array(
	'Hello Blocks'=>array('index'),
	$model->hello_block_id,
);

$this->menu=array(
	array('label'=>'List HelloBlock', 'url'=>array('index')),
	array('label'=>'Create HelloBlock', 'url'=>array('create')),
	array('label'=>'Update HelloBlock', 'url'=>array('update', 'id'=>$model->hello_block_id)),
	array('label'=>'Delete HelloBlock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->hello_block_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HelloBlock', 'url'=>array('admin')),
);
?>

<h1>View HelloBlock #<?php echo $model->hello_block_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'hello_block_id',
		'hello_block_name',
		'hello_block_detail',
		'hello_block_note',
		'hello_block_date',
		'hello_block_update',
		'hello_block_active',
	),
)); ?>
