<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/jsfunc.js'; ?>"></script>
<div class="form">
    
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        )
            ));
    ?>

    <?php //echo $form->errorSummary($model);  ?>
    <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
        <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ข้อมูลข่าวประชาสัมพันธ์</legend>
        <div class="row">
            <?php echo $form->labelEx($model, 'news_topic'); ?>
            <?php echo $form->textField($model, 'news_topic', array('size' => 95, 'maxlength' => 500)); ?>
            <?php echo $form->error($model, 'news_topic'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'news_detail'); ?>
            <?php echo $form->textArea($model, 'news_detail', array('rows' => 6, 'cols' => 50, 'id' => 'news_detail')); ?>
            <?php echo $form->error($model, 'news_detail'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'news_date'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'news_date',
                'value' => $model->news_date,
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
            <?php echo $form->error($model, 'news_date'); ?>
        </div>

        <div class="row">            
            <?php echo $form->checkBox($model, 'news_active',array('value'=>1,'style'=>'vertical-align: middle; display: inline-block;')); ?><?php echo $form->labelEx($model, 'news_active',array('style'=>'vertical-align: middle; display: inline-block; margin-left: 5px;')); ?>
            <?php echo $form->error($model, 'news_active'); ?>
        </div>
    </fieldset>
    <div style="height: 10px;"></div>
    <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
        <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ข้อมูลประกอบ</legend>
        
        <div class="row">
            <?php if (!empty($model->news_image)) { ?>
                <?php $url = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder; ?>
                <?php echo CHtml::image($url . '/news_image/' . $model->news_image, $model->news_topic, array('style' => 'width: 120px; height: 100px; border: 1px solid #C0C0C0; margin-bottom: 5px; margin-left: 0px; display: block;')); ?>                        
                <?php echo $form->checkBox($model, 'del_news_image', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?> <?php echo $form->labelEx($model, 'del_news_image', array('style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?>
            <?php } ?>
            <?php echo $form->labelEx($model, 'news_image'); ?>
            <?php echo CHtml::activeFileField($model, 'news_image', array('size' => 24)); ?> <span style="font-size: 11px; color: #cccccc;">[สัดส่วนรูป 400px * 400px ขนาดไม่เกิน 500 kb]</span>
            <?php echo $form->error($model, 'news_image'); ?>
        </div>
        
        <div class="row">
            <?php if (!empty($model->news_file)) { ?>
                <?php echo CHtml::decode("<span style='font-size: 12px; margin-top: 25px; margin-bottom: 5px; margin-left: 0px; display: block; font-weight: bold;'>ชื่อไฟล์เอกสาร : " . $model->news_file . "</span>"); ?>
                <?php echo $form->checkBox($model, 'del_news_file', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?> <?php echo $form->labelEx($model, 'del_news_file', array('style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?>
            <?php } ?>
            <?php echo $form->labelEx($model, 'news_file'); ?>
            <?php echo CHtml::activeFileField($model, 'news_file', array('size' => 24)); ?> <span style="font-size: 11px; color: #cccccc;">[ขนาดไม่เกิน 1 mb หากมีหลายไฟล์ให้ zip เป็นไฟล์เดียว]</span>
            <?php echo $form->error($model, 'news_file'); ?>
        </div>
    </fieldset>
    <div class="row buttons" style="margin: 20px 0 0 20px; text-align: left;">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'ตกลง' : 'ตกลง'); ?>
        &nbsp;
        <?php echo CHtml::resetButton('รีเซต', ''); ?>
    </div>
    <div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px; font-style: italic;">ข้อมูลที่ต้องการ.</span></div>
    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
 $(document).ready(function() {
    loadCkeditor2('news_detail');
 });
</script>