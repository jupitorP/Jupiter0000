<?php
$this->pageTitle = ' แก้ไขข้อมูลส่วนตัว';
$this->breadcrumbs = array(
    'แก้ไขข้อมูลส่วนตัว'
);
?>

<div class="layout2" >
    <div class="layout2_title">แก้ไขข้อมูลส่วนตัว</div>
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

            <?php
            Yii::app()->clientScript->registerScript(
                    'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
            );
            ?>

            <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
                <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ข้อมูลการเข้าสู่ระบบ</legend>
                <div style="padding: 20px 0px 20px 30px;">


                    <div class="row">
                        <?php echo $form->labelEx($model, 'username'); ?>
                        <?php echo $form->textField($model, 'username', array('size' => 25, 'maxlength' => 20, 'readonly' => 'readonly')); ?> 
                        <?php echo $form->error($model, 'username'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'old_password'); ?>
                        <?php echo $form->passwordField($model, 'old_password', array('size' => 25, 'maxlength' => 20, 'value' => '')); ?> <span style="font-size: 11px; color: #cccccc;">[ตัวอักษรหรือตัวเลขเท่านั้น ความยาว 6-20 ตัวอักษร]</span>
                        <?php echo $form->error($model, 'old_password'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <?php echo $form->passwordField($model, 'password', array('size' => 25, 'maxlength' => 20, 'value' => '')); ?> <span style="font-size: 11px; color: #cccccc;">[ตัวอักษรหรือตัวเลขเท่านั้น ความยาว 6-20 ตัวอักษร : ใช้รหัสผ่านเดิมไม่ต้องใส่ข้อมูล]</span>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'repeat_password'); ?>
                        <?php echo $form->passwordField($model, 'repeat_password', array('size' => 25, 'maxlength' => 20, 'value' => '')); ?> <span style="font-size: 11px; color: #cccccc;">[ตัวอักษรหรือตัวเลขเท่านั้น ความยาว 6-20 ตัวอักษร : ใช้รหัสผ่านเดิมไม่ต้องใส่ข้อมูล]</span>
                        <?php echo $form->error($model, 'repeat_password'); ?>
                    </div>
                </div>
            </fieldset>
            <div style="height: 10px;"></div>
            <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
                <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ข้อมูลส่วนตัว</legend>
                <div style="padding: 20px 0px 20px 30px;">
                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_firstname'); ?>
                        <?php echo $form->textField($model, 'user_firstname', array('size' => 40, 'maxlength' => 100)); ?>
                        <?php echo $form->error($model, 'user_firstname'); ?>                
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_lastname'); ?>
                        <?php echo $form->textField($model, 'user_lastname', array('size' => 40, 'maxlength' => 100)); ?>
                        <?php echo $form->error($model, 'user_lastname'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_birthday'); ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'user_birthday',
                            'value' => $model->user_birthday,
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
                        <?php echo $form->error($model, 'user_birthday'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'sex_id'); ?>
                        <div style="margin-left: 0px;"><?php echo $form->radioButtonList($model, 'sex_id', array('1' => 'ชาย ', '2' => 'หญิง'), array('labelOptions' => array('style' => 'display:inline; padding-right:15px;'), 'separator' => '',)); ?></div>
                        <?php echo $form->error($model, 'sex_id'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_email'); ?>
                        <?php echo $form->textField($model, 'user_email', array('size' => 40, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'user_email'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_mobile'); ?>
                        <?php echo $form->textField($model, 'user_mobile', array('size' => 40, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'user_mobile'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_tel'); ?>
                        <?php echo $form->textField($model, 'user_tel', array('size' => 40, 'maxlength' => 50)); ?>
                        <?php echo $form->error($model, 'user_tel'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_address'); ?>
                        <?php echo $form->textArea($model, 'user_address', array('rows' => 4, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'user_address'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'province_id'); ?>            
                        <?php echo $form->dropDownList($model, 'province_id', CHtml::listData(Province::model()->findAll(array('order' => 'province_name ASC')), 'province_id', 'province_name'), array('empty' => 'เลือกจังหวัด...', 'style' => 'width:200px;')); ?>
                        <?php echo $form->error($model, 'province_id'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'user_comment'); ?>
                        <?php echo $form->textArea($model, 'user_comment', array('rows' => 5, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'user_comment'); ?>
                    </div>
                </div>
            </fieldset>
            <div style="height: 10px;"></div>
            <fieldset style="border: 1px solid #DCDCE6; background-color: #FEFEFE; text-align: left; width: 620px; margin-left: 10px;">
                <legend style="border: 1px solid #DCDCE6; padding: 4px; font-size: 12px; font-weight: bold; background-color: #F9FAFD; text-align: left; margin-left: 0px;">ไฟล์เอกสารประกอบ</legend>
                <div style="padding: 20px 0px 20px 30px;">            
                    <div class="row">
                        <?php if (!empty($model->user_image)) { ?>
                            <?php $pathUsersImage = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/users_image'; ?>
                            <?php echo CHtml::image($pathUsersImage . '/' . $model->user_image, $model->user_firstname . " " . $model->user_lastname, array('style' => 'border: 1px solid #C0C0C0; margin-bottom: 5px; margin-left: 0px; display: block;')); ?>                        
                            <?php echo $form->checkBox($model, 'del_user_image', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?> <?php echo $form->labelEx($model, 'del_user_image', array('style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?>
                        <?php } ?>
                        <?php echo $form->labelEx($model, 'user_image'); ?>
                        <?php echo CHtml::activeFileField($model, 'user_image', array('size' => 24)); ?> <span style="font-size: 11px; color: #cccccc;">[สัดส่วนรูป 100px * 120px ขนาดไม่เกิน 500 kb]</span>
                        <?php echo $form->error($model, 'user_image'); ?>
                    </div>
                    <div class="row">
                        <?php if (!empty($model->user_file)) { ?>                        
                            <?php $pathUsersFile = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/users_file'; ?>
                            <div class="row-file-link"><?php echo CHtml::link(CHtml::decode($model->user_file), $pathUsersFile. '/' .$model->user_file,array('target'=>'_blank')); ?></div>
                            <?php echo $form->checkBox($model, 'del_user_file', array('value' => 1, 'style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?> <?php echo $form->labelEx($model, 'del_user_file', array('style' => 'vertical-align: middle; display: inline-block; margin-bottom: 15px;')); ?>
                        <?php } ?>
                        <?php echo $form->labelEx($model, 'user_file'); ?>
                        <?php echo CHtml::activeFileField($model, 'user_file', array('size' => 24)); ?> <span style="font-size: 11px; color: #cccccc;">[ขนาดไม่เกิน 1 mb หากมีหลายไฟล์ให้ zip เป็นไฟล์เดียว]</span>
                        <?php echo $form->error($model, 'user_file'); ?>
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