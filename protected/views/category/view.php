<?php
$this->pageTitle = 'ข้อมูลหมวดสินค้า';
$this->breadcrumbs = array(
    'จัดการหมวดสินค้า' => array('admin'),
    'ข้อมูลหมวดสินค้า ' . '(' . $model->category_name . ')'
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="view-edit-button"><?php echo CHtml::button('แก้ไขข้อมูล', array('submit' => array('category/update/'.$model->category_id))); ?></div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'category_name',
            'cssClass' => 'cdetailFontBold',
        ),
        'category_code',
        array(
            'name' => 'creation_time',
            'value' => Helpers::dateConvert($model->creation_time, 'short', 'datetime'),
        ),
        array(
            'name' => 'update_time',
            'value' => Helpers::dateConvert($model->update_time, 'short', 'datetime'),
        ),
        array(
            'name' => 'is_active',
            'value' => $model->is_active == 1 ? "อนุญาต" : "ไม่อนุญาต",
        ),
        'note'
    ),
));
?>