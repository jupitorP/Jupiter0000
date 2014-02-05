<?php
/* @var $this SlideShowController */
/* @var $data SlideShow */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('slide_show_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->slide_show_id), array('view', 'id'=>$data->slide_show_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slide_show_path')); ?>:</b>
	<?php echo CHtml::encode($data->slide_show_path); ?>
	<br />


</div>