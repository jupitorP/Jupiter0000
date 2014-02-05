<?php
/* @var $this SlideShowController */
/* @var $model SlideShow */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'slide_show_id'); ?>
		<?php echo $form->textField($model,'slide_show_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slide_show_path'); ?>
		<?php echo $form->textField($model,'slide_show_path',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->