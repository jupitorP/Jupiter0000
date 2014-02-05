<?php
$this->pageTitle = Yii::app()->name . ' - จัดการ Hello Block';
$this->breadcrumbs = array(
    'จัดการ Hello Block',
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'hello-block-grid',
     'summaryText' => 'แสดงข้อมูล {start} ถึง {end} รายการ ค้นพบทั้งหมด {count} รายการ',
    'dataProvider' => $model->search(),
    'columns' => array(
        'hello_block_name',
        array(
            'name'=>'hello_block_note',
            'htmlOptions'=>array('style'=>'width: 250px; text-align: left;'),
        ),
        array(
            'name'=>'hello_block_date',
            'value'=>'Helpers::dateConvert($data->hello_block_date,\'short\',\'datetime\')',
            'htmlOptions'=>array('style'=>'width: 150px; text-align: center;'),
        ),
        array(
            'name'=>'hello_block_update',
            'value'=>'Helpers::dateConvert($data->hello_block_update,\'short\',\'datetime\')',
            'htmlOptions'=>array('style'=>'width: 150px; text-align: center;'),
        ),
        array(
            'header' => 'จัดการ',
            'class' => 'CButtonColumn',
            'template' => '{update}',
        ),
    ),
));
?>