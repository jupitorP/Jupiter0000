<?php
$this->pageTitle = 'สมัครสมาชิก';
$this->breadcrumbs=array(
	'สมัครสมาชิก'
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>