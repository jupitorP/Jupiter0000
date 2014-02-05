<?php
/* @var $this TagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Tags',
);

$this->menu=array(
	array('label'=>'Create ProductTag', 'url'=>array('create')),
	array('label'=>'Manage ProductTag', 'url'=>array('admin')),
);
?>

<h1>Product Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
