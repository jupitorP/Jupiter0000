<?php
$this->pageTitle = 'เข้าสู่ระบบ';
$this->breadcrumbs = array(
    'เข้าสู่ระบบ',
);
?>
<div class="layout2" >
    <div class="layout2_title">เข้าสู่ระบบ</div>
    <div class="layout2_body">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                    ));
            ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'username'); ?>
                <?php echo $form->textField($model, 'username'); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'password'); ?>
                <?php echo $form->passwordField($model, 'password'); ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>
            <div class="row rememberMe">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </div>
            <div class="row buttonLogin">
                <?php echo CHtml::submitButton('เข้าสู่ระบบ', ''); ?>
            </div>
            <div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px;">ข้อมูลที่ต้องการ.</span></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="layout2_bottom"></div>
</div>