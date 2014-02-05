<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $.datepicker.setDefaults($.datepicker.regional['th']);
    $('#start_date').datepicker();
}
");
?>
<?php
$this->pageTitle = 'จัดการสมาชิก';
$this->breadcrumbs = array(
    'จัดการสมาชิก',
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
<div class="create-button"><?php echo CHtml::button('เพิ่มข้อมูล', array('submit' => array('user/create'))); ?></div>
<?php $url = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/users_image'; ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'summaryText' => 'แสดงข้อมูล {start} ถึง {end} รายการ ค้นพบทั้งหมด {count} รายการ',
    'pager' => array(
        'header' => false,
    ),
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns' => array(
        array(
            'name' => 'user_image',
            'type' => 'html',
            'value' => 'empty($data->user_image)?"":CHtml::image("' . $url . '/".$data->user_image,"$data->user_firstname $data->user_lastname",array("width"=>100,"height"=>100,"style"=>"vertical-align: middle;"))',
            'filter' => false,
            'htmlOptions' => array('style' => 'width: 110px; text-align: center;'),
        ),
        array(
            'name' => 'username',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center; font-weight: bold; color: #1B548D;'),
        ),
        array(
            'name' => 'user_firstname',
            'htmlOptions' => array('style' => 'width: 110px; text-align: left;'),
        ),
        array(
            'name' => 'user_lastname',
            'htmlOptions' => array('style' => 'width: 110px; text-align: left;'),
        ),
        array(
            'name' => 'user_mobile',
            'htmlOptions' => array('style' => 'width: 110px; text-align: left;'),
        ),
        array(
            'name' => 'user_email',
            'htmlOptions' => array('style' => 'width: 120px; text-align: left;'),
        ),
        array(
            'name' => 'start_date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'start_date',
                'language' => 'th',
                'options' => array(
                    'language' => 'th',
                    'showAnim' => 'fold',
                    'mode' => 'datetime',
                    'dateFormat' => 'dd-mm-yy', // save to db format
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'yearRange' => '1900:now',
                ),
                'htmlOptions' => array(
                    'id' => 'start_date',
                    'style' => 'width: 100px;',
                ),
                'defaultOptions' => array(
                    'language' => 'th',
                    'showAnim' => 'fold',
                    'mode' => 'datetime',
                    'dateFormat' => 'dd-mm-yy', // save to db format
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'yearRange' => '1900:now',
                )
                    ), true),
            'value' => 'Helpers::dateConvert($data->start_date,\'short\')',
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
        array(
            'name' => 'rules_name',
            'filter' => CHtml::dropDownList('User[rules]', $model->rules, CHtml::listData(Rules::model()->findAll(), 'rules', 'rules_name'), array(
                'empty' => 'เลือกทั้งหมด...',
            )),
            'htmlOptions' => array('style' => 'text-align: center; font-weight: bold; color: #1B548D;'),
        ),
        array(
            'header' => 'จัดการ',
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'Yii::app()->createUrl("user/delete", array("id"=>$data->id))',
                ),
            )
        ),
    ),
));
?>