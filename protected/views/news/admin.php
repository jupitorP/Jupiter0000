<?php
/* @var $this NewsController */
/* @var $model News */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('ค้นหาข่าวประชาสัมพันธ์', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'news-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'news_topic',
        'news_date',
        'news_update',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}  / {delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'delete',
                    'url' => 'Yii::app()->createUrl("news/delete", array("id"=>$data->news_id))',
                ),
            )
        ),
    ),
));
?>
