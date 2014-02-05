<?php
$this->pageTitle = Yii::app()->name . ' - แจ้งชำระเงิน';
$this->breadcrumbs = array(
    'แจ้งชำระเงิน',
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="layout2" >
    <div class="layout2_title"><?php echo $modelCmsPage->title; ?></div>
    <div class="layout2_body">
            <div class="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'pay-confirm-form',
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
                    <?php echo $form->labelEx($model, 'orderId'); ?>
                    <?php echo $form->textField($model, 'orderId', array('style' => 'width: 200px;')); ?>
                    <?php echo $form->error($model, 'orderId'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'mobile'); ?>
                    <?php echo $form->textField($model, 'mobile', array('style' => 'width: 200px;')); ?>
                    <?php echo $form->error($model, 'mobile'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email', array('style' => 'width: 200px;')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'price'); ?>
                    <?php echo $form->textField($model, 'price', array('style' => 'width: 100px;')); ?>
                    <?php echo $form->error($model, 'price'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'bankPayment'); ?>
                    <?php echo $form->dropDownList($model, 'bankPayment', array('ธ.ไทยพานิชย์' => 'ธ.ไทยพานิชย์', 'ธ.กสิกรไทย' => 'ธ.กสิกรไทย', 'ธ.กรุงเทพ' => 'ธ.กรุงเทพ'), array('empty' => 'เลือกธนาคาร...', 'style' => 'width:200px;')); ?>
                    <?php echo $form->error($model, 'bankPayment'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'timePayment'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'timePayment',
                        'value' => $model->timePayment,
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
                    <?php echo $form->error($model, 'timePayment'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'note'); ?>
                    <?php echo $form->textArea($model, 'note', array('style' => 'width: 420px; height: 80px;')); ?>
                    <?php echo $form->error($model, 'note'); ?>
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

                <div class="row buttonConfirm">
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