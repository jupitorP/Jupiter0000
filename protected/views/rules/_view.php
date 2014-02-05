<?php
/* @var $this RulesController */
/* @var $data Rules */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rules_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rules_id), array('view', 'id'=>$data->rules_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rules_name')); ?>:</b>
	<?php echo CHtml::encode($data->rules_name); ?>
	<br />


</div>