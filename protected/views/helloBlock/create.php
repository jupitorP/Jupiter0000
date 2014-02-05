<?php
/* @var $this HelloBlockController */
/* @var $model HelloBlock */

$this->breadcrumbs=array(
	'Hello Blocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HelloBlock', 'url'=>array('index')),
	array('label'=>'Manage HelloBlock', 'url'=>array('admin')),
);
?>

<h1>Create HelloBlock</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>