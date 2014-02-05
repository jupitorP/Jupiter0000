<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'payment-confirm-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'style' => 'width: 550px;',
        )
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'firstname'); ?>
        <?php echo $form->textField($model, 'firstname', array('style' => 'width: 200px;')); ?>
        <?php echo $form->error($model, 'firstname'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'lastname'); ?>
        <?php echo $form->textField($model, 'lastname', array('style' => 'width: 200px;')); ?>
        <?php echo $form->error($model, 'lastname'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tel'); ?>
        <?php echo $form->textField($model, 'tel', array('style' => 'width: 200px;')); ?>
        <?php echo $form->error($model, 'tel'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('style' => 'width: 200px;')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'order_number'); ?>
        <?php echo $form->textField($model, 'order_number', array('style' => 'width: 200px;')); ?>
        <?php echo $form->error($model, 'order_number'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price', array('style' => 'width: 100px;')); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'bank_id'); ?>
        <?php echo $form->dropDownList($model, 'bank_id', CHtml::listData(Bank::model()->findAll(array('condition' => 'is_active=1','order' => 'bank_name ASC')), 'bank_id', 'bank_name'), array('empty' => 'เลือกธนาคาร...', 'style' => 'width:200px;')); ?>
        <?php echo $form->error($model, 'bank_id'); ?>                
    </div>
    <div class="row">
                <?php echo $form->labelEx($model, 'payment_confirm_time'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'payment_confirm_time',
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
                    'htmlOptions' => array(
                        'style' => 'width: 80px;',
                        'value'=>Helpers::dateFormat($model->payment_confirm_time,'format2'),
                    ),
                        )
                );
                ?>
                <?php echo $form->error($model, 'user_birthday'); ?>
            </div>
    <div class="row">
        <?php if (!empty($model->payment_confirm_file)) { ?>
            <?php $pathFile = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/payment_confirm_file'; ?>
            <?php echo CHtml::link(CHtml::decode("<span style='font-size: 12px; margin-top: 25px; margin-bottom: 5px; margin-left: 0px; display: block; font-weight: bold;'>ชื่อไฟล์เอกสาร : " . $model->payment_confirm_file . "</span>"), $pathFile . '/' . $model->payment_confirm_file, array(target => _blank)); ?>
            <?php echo $form->checkBox($model, 'del_payment_confirm_file', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?> <?php echo $form->labelEx($model, 'del_payment_confirm_file', array('style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?>
        <?php } ?>
        <?php echo $form->labelEx($model, 'payment_confirm_file'); ?>
        <?php echo CHtml::activeFileField($model, 'payment_confirm_file', array('size' => 24)); ?> <span style="font-size: 11px; color: #cccccc;">[ขนาดไม่เกิน 1 mb หากมีหลายไฟล์ให้ zip เป็นไฟล์เดียว]</span>
        <?php echo $form->error($model, 'payment_confirm_file'); ?>
    </div>
    <div class="row">
        <?php echo $form->checkBox($model, 'is_confirm', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block;')); ?><?php echo $form->labelEx($model, 'is_confirm', array('style' => 'vertical-align: middle; display: inline-block; margin-left: 5px;')); ?>
        <?php echo $form->error($model, 'is_confirm'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'note'); ?>
        <?php echo $form->textArea($model, 'note', array('style' => 'width:400px; height:80px;')); ?>
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