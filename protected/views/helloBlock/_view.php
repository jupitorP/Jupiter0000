<?php
/* @var $this HelloBlockController */
/* @var $data HelloBlock */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->hello_block_id), array('view', 'id'=>$data->hello_block_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_name')); ?>:</b>
	<?php echo CHtml::encode($data->hello_block_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_detail')); ?>:</b>
	<?php echo CHtml::encode($data->hello_block_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_note')); ?>:</b>
	<?php echo CHtml::encode($data->hello_block_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_date')); ?>:</b>
	<?php echo CHtml::encode($data->hello_block_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_update')); ?>:</b>
	<?php echo CHtml::encode($data->hello_block_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hello_block_active')); ?>:</b>
	<?php echo CHtml::encode($data->hello_block_active); ?>
	<br />


</div>