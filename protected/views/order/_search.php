<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <table width="100%" border="1">
  <tr>
    <td><?php echo $form->label($model,'od_id'); ?></td>
    <td><?php echo $form->textField($model,'od_id'); ?></td>
     <td><?php echo $form->label($model,'user_name'); ?></td>
    <td><?php echo $form->textField($model,'user_name',array('size'=>60,'maxlength'=>100)); ?></td>
  </tr>
  <tr>
   
    <td><?php echo $form->label($model,'user_tel'); ?></td>
    <td><?php echo $form->textField($model,'user_tel',array('size'=>25,'maxlength'=>25)); ?></td>
    <td><?php echo $form->label($model,'od_status'); ?></td>
    <td>        <select name="Order[od_status]">
		<?php 
		$order_stauts=Helpers::getStatus();
 foreach($order_stauts as $k => $v){?>
<option value="<?=$k?>"><?=$v?></option>
<?php  } ?>
</select></td>
  </tr>
  <tr>
    
    <td><?php echo $form->label($model,'od_date'); ?></td>
    <td><?php echo $form->textField($model,'od_date'); ?> ถึง</td>
    <td><?php echo CHtml::submitButton('ค้นหา',array('class'=>'btn btn-blue')); ?></td><td></td>
  </tr>
</table>


<?php $this->endWidget(); ?>

</div><!-- search-form -->