<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Registers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Register', 'url'=>array('index')),
	array('label'=>'Create Register', 'url'=>array('create')),
	array('label'=>'Update Register', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Register', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Register', 'url'=>array('admin')),
);
?>

<h1>View Register #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'user_firstname',
		'user_lastname',
		'user_birthday',
		'user_mobile',
		'user_tel',
		'user_email',
		'user_address',
		'sex_id',
		'province_id',
		'user_image',
		'user_file',
		'user_active',
		'start_date',
		'user_update',
		'user_comment',
		'rules',
	),
)); ?>
