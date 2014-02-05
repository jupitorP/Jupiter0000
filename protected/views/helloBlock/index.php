<?php
/* @var $this HelloBlockController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hello Blocks',
);

$this->menu=array(
	array('label'=>'Create HelloBlock', 'url'=>array('create')),
	array('label'=>'Manage HelloBlock', 'url'=>array('admin')),
);
?>

<h1>Hello Blocks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
