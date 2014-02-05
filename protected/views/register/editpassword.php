<?php
$this->pageTitle = 'แก้ไขรหัสผ่าน';
$this->breadcrumbs = array(
    'แก้ไขรหัสผ่าน'
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="layout2" >
    <div class="layout2_title">แก้ไขรหัสผ่าน</div>
    <div class="layout2_body">

        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'register-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true),
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                )
                    ));
            ?>
            <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
                <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ข้อมูลรหัสผ่าน</legend>
                <div style="padding: 20px 0px 20px 30px;">

                    <div class="row">
                        <?php echo $form->labelEx($model, 'old_password'); ?>
                        <?php echo $form->passwordField($model, 'old_password', array('size' => 25, 'maxlength' => 20, 'value' => '')); ?> <span style="font-size: 11px; color: #cccccc;">[ตัวอักษรหรือตัวเลขเท่านั้น ความยาว 6-20 ตัวอักษร]</span>
                        <?php echo $form->error($model, 'old_password'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <?php echo $form->passwordField($model, 'password', array('size' => 25, 'maxlength' => 20, 'value' => '')); ?> <span style="font-size: 11px; color: #cccccc;">[ตัวอักษรหรือตัวเลขเท่านั้น ความยาว 6-20 ตัวอักษร]</span>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'repeat_password'); ?>
                        <?php echo $form->passwordField($model, 'repeat_password', array('size' => 25, 'maxlength' => 20, 'value' => '')); ?> <span style="font-size: 11px; color: #cccccc;">[ตัวอักษรหรือตัวเลขเท่านั้น ความยาว 6-20 ตัวอักษร]</span>
                        <?php echo $form->error($model, 'repeat_password'); ?>
                    </div>
                </div>
            </fieldset>
            <div class="buttonLogin" style="margin-top: 20px;">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'ตกลง' : 'ตกลง'); ?>
                &nbsp;
                <?php echo CHtml::resetButton('รีเซต', ''); ?>
            </div>
            <div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px;">ข้อมูลที่ต้องการ.</span></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="layout2_bottom"></div>
</div>