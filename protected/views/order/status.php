<div align="center">
<h2>อัพเดทสถานะการสั่งซื้อ</h3>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	 'action' => array('order/statussave'),
	'enableAjaxValidation'=>false,//print_r(Helpers::getStatus());
)); ?>


<select name="od_status">
<?php
$order_stauts=Helpers::getStatus();
 foreach($order_stauts as $k => $v){?>
<option value="<?=$k?>" <?=$status_order[1]==$k?'selected="selected"':''?>><?=$v?></option>
<?php  } ?>
</select>
<input type="hidden" name="od_id" value="<?=$status_order[0]?>" />
<?php echo CHtml::submitButton( 'อัพเดทสถานะ'); ?>
<?php $this->endWidget(); ?>
</div>