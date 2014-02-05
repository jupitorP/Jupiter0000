<script src="<?php echo Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/jsfunc.js'; ?>"></script>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'category-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'category_name'); ?>
        <?php echo $form->textField($model, 'category_name', array('maxlength' => 1000, 'style' => 'width:700px;')); ?>
        <?php echo $form->error($model, 'category_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'category_code'); ?>
        <?php echo $form->textField($model, 'category_code', array('maxlength' => 300, 'style' => 'width:250px;')); ?>
        <?php echo $form->error($model, 'category_code'); ?>
    </div>
    <div class="row">
                <?php echo $form->checkBox($model, 'is_active', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block;')); ?><?php echo $form->labelEx($model, 'is_active', array('style' => 'vertical-align: middle; display: inline-block; margin-left: 5px;')); ?>
                <?php echo $form->error($model, 'is_active'); ?>
    </div>
    <div class="row">
                <?php echo $form->labelEx($model, 'note'); ?>
                <?php echo $form->textArea($model, 'note', array('style' => 'width:700px; height:80px;')); ?>
                <?php echo $form->error($model, 'note'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'creation_time'); ?>
        <?php echo CHtml::decode("<span style='font-size: 12px; margin-top: 2px; margin-bottom: 10px; display: block; font-weight: normal;'> " . Helpers::dateConvert($model->creation_time, 'short', 'datetime') . "</span>"); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'update_time'); ?>
        <?php echo CHtml::decode("<span style='font-size: 12px; margin-top: 2px; margin-bottom: 10px; display: block; font-weight: normal;'> " . Helpers::dateConvert($model->update_time, 'short', 'datetime') . "</span>"); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึก'); ?>
        &nbsp;
        <?php echo CHtml::resetButton('รีเซต', ''); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px;">ข้อมูลที่ต้องการ.</span></div>