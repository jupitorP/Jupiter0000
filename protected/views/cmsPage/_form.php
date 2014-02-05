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
        'id' => 'cms-page-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('maxlength' => 1000, 'style' => 'width:700px;')); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'identifier'); ?>
        <?php echo $form->textField($model, 'identifier', array('maxlength' => 400, 'style' => 'width:400px;')); ?>
        <?php echo $form->error($model, 'identifier'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($model, 'is_active', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block;')); ?><?php echo $form->labelEx($model, 'is_active', array('style' => 'vertical-align: middle; display: inline-block; margin-left: 5px;')); ?>
        <?php echo $form->error($model, 'is_active'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'page_content'); ?>
        <?php echo $form->textArea($model, 'page_content', array('id' => 'page_content')); ?>
        <?php echo $form->error($model, 'page_content'); ?>
    </div>
    <div class="row">
                <?php echo $form->labelEx($model, 'note'); ?>
                <?php echo $form->textArea($model, 'note', array('style' => 'width:700px; height:80px;')); ?>
                <?php echo $form->error($model, 'note'); ?>
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
        loadCkeditor3('page_content','700','700');
    });
</script>