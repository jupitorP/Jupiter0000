<?php

$this->pageTitle = Yii::app()->name . ' - แสดงข้อมูล CMS Page';
$this->breadcrumbs = array(
    'จัดการ CMS Page' => array('admin'),
    'แสดงข้อมูล CMS Page ' . '(' . $model->identifier . ')'
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="view-edit-button"><?php echo CHtml::button('แก้ไขข้อมูล', array('submit' => array('cmsPage/update/'.$model->page_id))); ?></div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'title',
            'cssClass' => 'cdetailFontBold',
        ),
        'identifier',
        array(
            'name' => 'page_content',
             'type'=>'html',
            'value' => CHtml::decode("$model->page_content"),
        ),
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
