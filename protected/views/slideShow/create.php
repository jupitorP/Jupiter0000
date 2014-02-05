<?php
/* @var $this SlideShowController */
/* @var $model SlideShow */

$this->breadcrumbs=array(
	'Slide Shows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SlideShow', 'url'=>array('index')),
	array('label'=>'Manage SlideShow', 'url'=>array('admin')),
);
?>

<h1>Create SlideShow</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>