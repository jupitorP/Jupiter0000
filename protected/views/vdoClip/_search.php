<?php
/* @var $this VdoClipController */
/* @var $model VdoClip */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_id'); ?>
		<?php echo $form->textField($model,'vdo_clip_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_topic'); ?>
		<?php echo $form->textField($model,'vdo_clip_topic',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_detail'); ?>
		<?php echo $form->textArea($model,'vdo_clip_detail',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_url'); ?>
		<?php echo $form->textField($model,'vdo_clip_url',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_date'); ?>
		<?php echo $form->textField($model,'vdo_clip_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_update'); ?>
		<?php echo $form->textField($model,'vdo_clip_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vdo_clip_active'); ?>
		<?php echo $form->textField($model,'vdo_clip_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->