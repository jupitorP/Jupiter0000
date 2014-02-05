<script src="<?php echo Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/jsfunc.js'; ?>"></script>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'hello-block-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'hello_block_name'); ?>
        <?php echo $form->textField($model, 'hello_block_name', array('maxlength' => 400, 'style' => 'width:580px;')); ?>
        <?php echo $form->error($model, 'hello_block_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'hello_block_detail'); ?>
        <?php echo $form->textArea($model, 'hello_block_detail', array('id' => 'hello_block_detail')); ?>
        <?php echo $form->error($model, 'hello_block_detail'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'hello_block_note'); ?>
        <?php echo $form->textArea($model, 'hello_block_note', array('style' => 'width:580px; height: 50px;')); ?>
        <?php echo $form->error($model, 'hello_block_note'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'hello_block_date'); ?>
        <?php echo CHtml::decode("<span style='font-size: 12px; margin-top: 2px; margin-bottom: 10px; display: block; font-weight: normal;'> " .Helpers::dateConvert($model->hello_block_date,'short','datetime'). "</span>"); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'hello_block_update'); ?>
        <?php echo CHtml::decode("<span style='font-size: 12px; margin-top: 2px; margin-bottom: 10px; display: block; font-weight: normal;'> " .Helpers::dateConvert($model->hello_block_update,'short','datetime'). "</span>"); ?>
    </div>
    <div class="row">
        <?php echo $form->checkBox($model, 'hello_block_active',array('value'=>1,'style'=>'vertical-align: middle; display: inline-block;')); ?><?php echo $form->labelEx($model, 'hello_block_active',array('style'=>'vertical-align: middle; display: inline-block; margin-left: 5px;')); ?>
            <?php echo $form->error($model, 'hello_block_active'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึก'); ?>
        &nbsp;
        <?php echo CHtml::resetButton('รีเซต', ''); ?>
    </div>    
    <?php $this->endWidget(); ?>
</div>
<div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px;">ข้อมูลที่ต้องการ.</span></div>
<script type="text/javascript">
 $(document).ready(function() {
    loadCkeditor3('hello_block_detail','585','300');
 });
</script>