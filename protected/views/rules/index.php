<?php
/* @var $this RulesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rules',
);

$this->menu=array(
	array('label'=>'Create Rules', 'url'=>array('create')),
	array('label'=>'Manage Rules', 'url'=>array('admin')),
);
?>

<h1>Rules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
