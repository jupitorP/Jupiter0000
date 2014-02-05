<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_address'); ?>
		<?php echo $form->textArea($model,'user_address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'user_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_tel'); ?>
		<?php echo $form->textField($model,'user_tel',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'user_tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'od_status'); ?>
		<?php echo $form->textField($model,'od_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'od_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'od_date'); ?>
		<?php echo $form->textField($model,'od_date'); ?>
		<?php echo $form->error($model,'od_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->