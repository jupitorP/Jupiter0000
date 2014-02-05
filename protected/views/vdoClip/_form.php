<?php
/* @var $this VdoClipController */
/* @var $model VdoClip */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/jsfunc.js'; ?>"></script>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'vdo-clip-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>
    <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
        <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ข้อมูลวิดีโอคลิป</legend>
        <div class="row">
            <?php echo $form->labelEx($model, 'vdo_clip_topic'); ?>
            <?php echo $form->textField($model, 'vdo_clip_topic', array('size' => 60, 'maxlength' => 200)); ?>
            <?php echo $form->error($model, 'vdo_clip_topic'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'vdo_clip_detail'); ?>
            <?php echo $form->textArea($model, 'vdo_clip_detail', array('rows' => 6, 'cols' => 50, 'id' => 'vdo_clip_detail')); ?>
            <?php echo $form->error($model, 'vdo_clip_detail'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'vdo_clip_url'); ?>
            <?php echo $form->textField($model, 'vdo_clip_url', array('size' => 80, 'maxlength' => 200)); ?>
            <?php echo $form->error($model, 'vdo_clip_url'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'vdo_clip_date'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'vdo_clip_date',
                'value' => $model->vdo_clip_date,
                'language' => 'th',
                'options' => array(
                    'showAnim' => 'fold',
                    'mode' => 'datetime',
                    'dateFormat' => 'dd-mm-yy', // save to db format
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'yearRange' => '1900:now',
                    'showOn' => 'both',
                    'buttonText' => '...',
                ),
                'htmlOptions' => array('style' => 'width: 80px;'),
                    )
            );
            ?>
            <?php echo $form->error($model, 'vdo_clip_date'); ?>
        </div>
        <div class="row">
            <?php echo $form->checkBox($model, 'vdo_clip_active', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block;')); ?><?php echo $form->labelEx($model, 'vdo_clip_active', array('style' => 'vertical-align: middle; display: inline-block; margin-left: 5px;')); ?>
            <?php echo $form->error($model, 'vdo_clip_active'); ?>
        </div>

        <div class="row buttons" style="margin: 20px 0 0 20px; text-align: left;">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'ตกลง' : 'Save'); ?>
            &nbsp;
            <?php echo CHtml::resetButton('รีเซต', ''); ?>
        </div>
        <div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px; font-style: italic;">ข้อมูลที่ต้องการ.</span></div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(document).ready(function() {
        loadCkeditor2('vdo_clip_detail');
    });
</script>