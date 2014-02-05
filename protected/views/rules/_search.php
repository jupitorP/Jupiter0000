<?php
/* @var $this RulesController */
/* @var $model Rules */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rules_id'); ?>
		<?php echo $form->textField($model,'rules_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rules_name'); ?>
		<?php echo $form->textField($model,'rules_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->