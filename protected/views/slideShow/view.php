<?php
/* @var $this SlideShowController */
/* @var $model SlideShow */

$this->breadcrumbs=array(
	'Slide Shows'=>array('index'),
	$model->slide_show_id,
);

$this->menu=array(
	array('label'=>'List SlideShow', 'url'=>array('index')),
	array('label'=>'Create SlideShow', 'url'=>array('create')),
	array('label'=>'Update SlideShow', 'url'=>array('update', 'id'=>$model->slide_show_id)),
	array('label'=>'Delete SlideShow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->slide_show_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SlideShow', 'url'=>array('admin')),
);
?>

<h1>View SlideShow #<?php echo $model->slide_show_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'slide_show_id',
		'slide_show_path',
	),
)); ?>
