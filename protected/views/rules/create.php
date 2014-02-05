<?php
/* @var $this RulesController */
/* @var $model Rules */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rules', 'url'=>array('index')),
	array('label'=>'Manage Rules', 'url'=>array('admin')),
);
?>

<h1>Create Rules</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>