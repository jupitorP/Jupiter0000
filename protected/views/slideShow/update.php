<?php
/* @var $this SlideShowController */
/* @var $model SlideShow */

$this->breadcrumbs=array(
	'Slide Shows'=>array('index'),
	$model->slide_show_id=>array('view','id'=>$model->slide_show_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SlideShow', 'url'=>array('index')),
	array('label'=>'Create SlideShow', 'url'=>array('create')),
	array('label'=>'View SlideShow', 'url'=>array('view', 'id'=>$model->slide_show_id)),
	array('label'=>'Manage SlideShow', 'url'=>array('admin')),
);
?>

<h1>Update SlideShow <?php echo $model->slide_show_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>