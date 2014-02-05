<?php
$this->pageTitle = 'ติดต่อเรา';
$this->breadcrumbs = array(
    'ติดต่อเรา'
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="layout2" >
    <div class="layout2_title">ติดต่อเรา</div>
    <div class="layout2_body">
            <div class="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'contact-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                        ));
                ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'name'); ?>
                    <?php echo $form->textField($model, 'name', array('style' => 'width: 200px;')); ?>
                    <?php echo $form->error($model, 'name'); ?>
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
                    <?php echo $form->labelEx($model, 'subject'); ?>
                    <?php echo $form->textField($model, 'subject', array('maxlength' => 128, 'style' => 'width: 420px;')); ?>
                    <?php echo $form->error($model, 'subject'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'body'); ?>
                    <?php echo $form->textArea($model, 'body', array('style' => 'width: 420px; height: 140px;')); ?>
                    <?php echo $form->error($model, 'body'); ?>
                </div>

                <?php if (CCaptcha::checkRequirements()): ?>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'verifyCode'); ?>
                        <div>
                            <?php $this->widget('CCaptcha'); ?>
                            <?php echo $form->textField($model, 'verifyCode', array('maxlength' => 7, 'style' => 'width: 80px;')); ?>
                        </div>
                        <?php echo $form->error($model, 'verifyCode'); ?>
                    </div>
                <?php endif; ?>
                <div class="row buttonContact">
                    <?php echo CHtml::submitButton('ตกลง', ''); ?>
                    &nbsp;
                    <?php echo CHtml::resetButton('รีเซต', ''); ?>
                </div>
                <div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px;">ข้อมูลที่ต้องการ.</span></div>
                <?php $this->endWidget(); ?>
            </div>
    </div>
    <div class="layout2_bottom"></div>
</div>