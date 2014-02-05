<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php
$this->pageTitle = 'จัดการหมวดสินค้า';
$this->breadcrumbs = array(
    'จัดการหมวดสินค้า',
);
?>
<div class="search-menu"><?php echo CHtml::link('ค้นหาขั้นสูง', '#', array('class' => 'search-button')); ?></div>
<div class="search-form" style="">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="create-button"><?php echo CHtml::button('เพิ่มข้อมูล', array('submit' => array('category/create'))); ?></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'category-grid',
    'summaryText' => 'แสดงข้อมูล {start} ถึง {end} รายการ ค้นพบทั้งหมด {count} รายการ',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'category_code',
            'htmlOptions' => array('style' => 'width: 150px; text-align: center;'),
        ),
        array(
            'name' => 'category_name',
            'htmlOptions' => array('style' => 'text-align: left; color: #1B548D;'),
        ),
        array(
            'name' => 'creation_time',
            'value' => 'Helpers::dateConvert($data->creation_time,\'short\')',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
        array(
            'name' => 'update_time',
            'value' => 'Helpers::dateConvert($data->update_time,\'short\')',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
        array(
            'name' => 'is_active',
             'value' => '$data->is_active == 1 ?"อนุญาต" : "ยังไม่อนุญาต"',
            'htmlOptions'=>array('style'=>'width: 80px; text-align: center;'),
        ),
        array(
            'header' => 'จัดการ',
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'array("category/view", "id"=>$data->category_id)',
                    'label' => 'view',
                ),
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'array("category/delete", "id"=>$data->category_id)',
                    'label' => 'delete',
                ),
            )
        ),
    ),
));
?>
