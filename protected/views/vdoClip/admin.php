<?php
/* @var $this vdo_clipController */
/* @var $model vdo_clip */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vdo-clip-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('ค้นหาวิดีโอคลิป', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'vdo-clip-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'vdo_clip_topic',
        'vdo_clip_date',
        'vdo_clip_update',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}  / {delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'Yii::app()->createUrl("vdo_clip/delete", array("id"=>$data->vdo_clip_id))',
                ),
            )
        ),
    ),
));
?>