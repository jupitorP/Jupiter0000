<?php
$this->pageTitle = Yii::app()->name . ' - จัดการ CMS Page';
$this->breadcrumbs = array(
    'จัดการ CMS Page',
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="create-button"><?php echo CHtml::button('เพิ่มข้อมูล', array('submit' => array('cmsPage/create'))); ?></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cms-page-grid',
    'summaryText' => 'แสดงข้อมูล {start} ถึง {end} รายการ ค้นพบทั้งหมด {count} รายการ',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'title',
            'htmlOptions' => array('style' => 'text-align: left; font-weight: bold; color: #1B548D;'),
        ),
        array(
            'name'=>'identifier',
            'htmlOptions'=>array('style'=>'width: 200px; text-align: left;'),
        ),
        array(
            'name'=>'creation_time',
            'value'=>'Helpers::dateConvert($data->creation_time,\'short\',\'datetime\')',
            'htmlOptions'=>array('style'=>'width: 120px; text-align: center;'),
        ),
        array(
            'name'=>'update_time',
            'value'=>'Helpers::dateConvert($data->update_time,\'short\',\'datetime\')',
            'htmlOptions'=>array('style'=>'width: 120px; text-align: center;'),
        ),
        array(
            'name' => 'is_active',
             'value' => '$data->is_active == 1 ?"อนุญาต" : "ยังไม่อนุญาต"',
            'htmlOptions'=>array('style'=>'width: 100px; text-align: center;'),
        ),
        array(
            'header' => 'จัดการ',
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'array("cmsPage/delete", "id"=>$data->page_id)',
                    'label' => 'delete',
                ),
            )
        ),
    ),
));
?>
