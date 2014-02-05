<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php
$this->pageTitle = 'แจ้งการชำระเงิน';
$this->breadcrumbs = array(
    'แจ้งการชำระเงิน',
);
?>
<div class="search-menu"><?php echo CHtml::link('ค้นหาขั้นสูง', '#', array('class' => 'search-button')); ?></div>
<div class="search-form" style="margin-bottom: 25px;">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'summaryText' => 'แสดงข้อมูล {start} ถึง {end} รายการ ค้นพบทั้งหมด {count} รายการ',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'firstname',
            'type' => 'html',
            'value' => 'ucwords($data->firstname.\' \'.$data->lastname)',
            'htmlOptions' => array('style' => 'width: 150px; text-align: center; color: #1B548D;'),
        ),
        array(
            'name' => 'tel',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
        array(
            'name' => 'email',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
        array(
            'name' => 'order_number',
            'htmlOptions' => array('style' => 'width: 80px; text-align: center; color: #1B548D;'),
        ),
        array(
            'name' => 'price',
            'value' => 'number_format($data->price)',            
            'htmlOptions' => array('style' => 'width: 80px; text-align: center; color: #800000;'),
        ),
        array(
            'name' => 'is_confirm',
            'type' => 'html',
            'value' => 'empty($data->is_confirm)?"<span style=\"color: #ff0000;\">รอตรวจสอบ</span>":"<span style=\"color: #009900;\">ถูกต้อง</span>"',
            'htmlOptions' => array('style' => 'width: 70px; text-align: center;'),
        ),
        array(
            'name' => 'payment_confirm_time',
            'value' => 'Helpers::dateConvert($data->payment_confirm_time,\'short\')',
            'htmlOptions' => array('style' => 'width: 80px; text-align: center;'),
        ),
        array(
            'header' => 'จัดการ',
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'array("paymentConfirm/view", "id"=>$data->payment_confirm_id)',
                    'label' => 'view',
                    'options' => array(),
                ),
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'array("paymentConfirm/delete", "id"=>$data->payment_confirm_id)',
                    'label' => 'delete',
                ),
            )
        ),
    ),
));
?>