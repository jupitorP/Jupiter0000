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
$this->pageTitle = 'จัดการสินค้า';
$this->breadcrumbs = array(
    'จัดการสินค้า',
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
<div class="create-button"><?php echo CHtml::button('เพิ่มข้อมูล', array('submit' => array('product/create'))); ?></div>
<?php
$pathProduct = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/' . images . '/' . products . '/' . thumbs;

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'summaryText' => 'แสดงข้อมูล {start} ถึง {end} รายการ ค้นพบทั้งหมด {count} รายการ',
    'pager' => array(
        'header' => false,
    ),
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'product_image',
            'type' => 'html',
            'value' => 'empty($data->product_image)?"":CHtml::image("' . $pathProduct . '/".$data->product_image,"$data->product_name",array("width"=>100,"height"=>100,"style"=>"vertical-align: middle;"))',
            'filter' => false,
            'htmlOptions' => array('style' => 'width: 110px; text-align: center;'),
        ),
        array(
            'name' => 'product_code',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
        array(
            'name' => 'product_name',
            'htmlOptions' => array('style' => 'text-align: left; color: #1B548D;'),
        ),
        array(
            'name' => 'category_name',
            'htmlOptions' => array('style' => 'width: 220px; text-align: left;'),
        ),
        array(
            'name' => 'product_amount',
            'value' => 'number_format($data->product_amount)',
            'htmlOptions' => array('style' => 'width: 80px; text-align: center; color: #800000;'),
        ),
        array(
            'name' => 'product_price',
            'value' => 'number_format($data->product_price)',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center; color: #1B548D;'),
        ),
        array(
            'header' => 'จัดการ',
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'array("product/view", "id"=>$data->product_id)',
                    'label' => 'view',
                    'options' => array("target" => "_blank"),
                ),
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'array("product/delete", "id"=>$data->product_id)',
                    'label' => 'delete',
                ),
            )
        ),
    ),
));
?>