<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		<?php echo $form->label($model,'news_topic'); ?>
		<?php echo $form->textField($model,'news_topic',array('size'=>60,'maxlength'=>200)); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-blue')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->