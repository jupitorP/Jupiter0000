<?php
$this->breadcrumbs=array(
	'Cms Pages',
);
 ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
