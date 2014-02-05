<?php
/* @var $this OrderController */
/* @var $data Order */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('od_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->od_id), array('view', 'id'=>$data->od_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_address')); ?>:</b>
	<?php echo CHtml::encode($data->user_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_tel')); ?>:</b>
	<?php echo CHtml::encode($data->user_tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('od_status')); ?>:</b>
	<?php echo CHtml::encode($data->od_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('od_date')); ?>:</b>
	<?php echo CHtml::encode($data->od_date); ?>
	<br />


</div>