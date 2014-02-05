<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'หมวดสินค้า',
);
?>

<div class="layout2" >
<div class="layout2_title">หมวดสินค้า</div>
<div class="layout2_body">

<?php 

$this->widget('ext.widgets.EColumnListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'columns' => 2
)); ?>

</div>
<div class="layout2_bottom"></div>
</div>
<br  style="clear:both;"/>