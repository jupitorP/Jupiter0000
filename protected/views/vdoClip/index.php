<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'วิดีโอคลิป',
);
?>
<div id="layout3" >
<div id="layout3_title">วิดีโอคลิป</div>
<div id="layout3_body">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
<div id="layout3_bottom"></div>
</div>