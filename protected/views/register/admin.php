<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Registers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Register', 'url'=>array('index')),
	array('label'=>'Create Register', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('register-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Registers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'register-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'password',
		'user_firstname',
		'user_lastname',
		'user_birthday',
		/*
		'user_mobile',
		'user_tel',
		'user_email',
		'user_address',
		'sex_id',
		'province_id',
		'user_image',
		'user_file',
		'user_active',
		'start_date',
		'user_update',
		'user_comment',
		'rules',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
