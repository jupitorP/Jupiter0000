<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<p><?php echo CHtml::link('ค้นหาข้อมูลการสั่งซื้อ','#',array('class'=>'search-button')); ?></p>
<div class="search-form" style="display:none">
  <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'od_id',
		array('name'=>'od_date','type'=>'raw','value'=>'Helpers::dateConvert($data->od_date,\'digit\')'),
		'user_name',
		'user_address',
		'user_tel',
		array('name'=>'od_status','type'=>'raw'
		, 'value'=>'CHtml::link(Helpers::statusOrder($data->od_status), array("#"),
		array("onclick"=>"openCenteredWindow(\'status/$data->od_id?od_status=$data->od_status\',\'400\',\'200\') ;return false;"))', 'header'=>'สถานะการสั่งซื้อ'),
		array('name'=>'','type'=>'raw'
		, 'value'=>'CHtml::link("<font color=\"#9966FF\">ดูใบสั่งซื้อนี้</font>", array("order/$data->od_id"),
		array("target"=>"_blank"))', 'header'=>'ใบสั่งซื้อ'),
	),
)); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsfunc.js" type="text/javascript"></script>
