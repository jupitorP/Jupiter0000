<?php
/* @var $this HelloBlockController */
/* @var $model HelloBlock */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'hello_block_id'); ?>
		<?php echo $form->textField($model,'hello_block_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hello_block_name'); ?>
		<?php echo $form->textField($model,'hello_block_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hello_block_detail'); ?>
		<?php echo $form->textArea($model,'hello_block_detail',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hello_block_note'); ?>
		<?php echo $form->textField($model,'hello_block_note',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hello_block_date'); ?>
		<?php echo $form->textField($model,'hello_block_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hello_block_update'); ?>
		<?php echo $form->textField($model,'hello_block_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hello_block_active'); ?>
		<?php echo $form->textField($model,'hello_block_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->