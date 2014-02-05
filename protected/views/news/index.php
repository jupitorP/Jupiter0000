<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'ข่าวประชาสัมพันธ์',
);

$this->menu=array(
	//array('label'=>'Create News', 'url'=>array('create')),
	//array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
