<script src="<?php echo Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/jsfunc.js'; ?>"></script>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
<table class="form">
<tr>
<td colspan="2"><?php echo $form->errorSummary($model); ?><br /></td>
</tr>
  <tr>
    <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'product_code'); ?></td>
    <td bgcolor="#E8E8E8">&nbsp;<?php echo $form->textField($model, 'product_code', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'product_code'); ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'category_id'); ?></td>
    <td bgcolor="#E8E8E8">&nbsp;<?php echo $form->dropDownList($model,'category_id', $this->getCategoryOptions(), array('empty' => 'เลือกหมวด')); // echo $form->textField($model,'category_id'); ?>
        <?php echo $form->error($model, 'category_id'); ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'product_name'); ?></td>
    <td bgcolor="#E8E8E8">&nbsp;<?php echo $form->textField($model, 'product_name', array('size' => 60, 'maxlength' => 80)); ?>
        <?php echo $form->error($model, 'product_name'); ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'product_amount'); ?></td>
    <td bgcolor="#E8E8E8">&nbsp;<?php echo $form->textField($model, 'product_amount', array('size' => 5, 'maxlength' => 5)); ?>
        <?php echo $form->error($model, 'product_amount'); ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'product_price'); ?></td>
    <td bgcolor="#E8E8E8">&nbsp;<?php echo $form->textField($model, 'product_price', array('size' => 11, 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'product_price'); ?></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'product_detail'); ?></td>
    <td bgcolor="#E8E8E8"> &nbsp;<?php        echo $form->textArea($model, 'product_detail', array('rows' => 6, 'cols' => 50, 'id' => 'product_detail')); ?>
        <?php echo $form->error($model, 'product_detail'); ?></td>
  </tr>
  <tr>
  <td valign="top" bgcolor="#E8E8E8">&nbsp;<?php echo $form->labelEx($model, 'product_image'); ?></td>
  <td bgcolor="#E8E8E8">&nbsp;<?php echo CHtml::activeFileField($model, 'product_image'); ?>
        <?php echo $form->error($model, 'product_image'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#E8E8E8">&nbsp;</td>
    <td bgcolor="#E8E8E8"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-blue')); ?></td>
  </tr>
</table>
    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
 $(document).ready(function() {
    loadCkeditor();
 });
</script>