<?php

$this->pageTitle = Yii::app()->name . ' - แสดงข้อมูลสมาชิก';
$this->breadcrumbs = array(
    'จัดการสมาชิก' => array('admin'),
    'แสดงข้อมูลสมาชิก ' . '(' . $model->user_firstname . ' ' . $model->user_lastname . ')'
);
?>
<?php

Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<?php $pathUsersImage = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/users_image'; ?>
<?php $pathUsersFile = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/users_file'; ?>
<div class="view-edit-button"><?php echo CHtml::button('แก้ไขข้อมูล', array('submit' => array('user/update/'.$model->id))); ?></div>
<?php
$modelRules = Rules::model()->findByPk($model->rules);
$modelProvince = Province::model()->findByPk($model->province_id);
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'user_image',
            'type' => 'html',
            'value' => empty($model->user_image) ? "ไม่มีรูปภาพ" : CHtml::image($pathUsersImage . '/' . $model->user_image, 'some thing here', array("width" => 100, "height" => 100, "style" => "vertical-align: middle;")),
        ),
        array(
            'name' => 'username',
            'cssClass' => 'cdetailFontBold'
        ),
        array(
            'name' => 'user_firstname',
            'cssClass' => 'cdetailFontBold'
        ),
        array(
            'name' => 'user_lastname',
            'cssClass' => 'cdetailFontBold'
        ),
        array(
            'name' => 'rules',
            'value' => $modelRules->rules_name,
            'cssClass' => 'cdetailFontBold'
        ),
        array(
            'name' => 'sex_id',
            'value' => $model->sex_id == 1 ? "ชาย" : "หญิง",
        ),
        array(
            'name' => 'user_birthday',
            'value' => Helpers::dateConvert($model->user_birthday, 'short'),
        ),
        'user_mobile',
        'user_tel',
        'user_email',
        'user_address',
        array(
            'name' => 'province_id',
            'value' => $modelProvince->province_name,
        ),
        array(
            'name' => 'user_active',
            'value' => $model->user_active == 1 ? "อนุญาต" : "ยังไม่อนุญาต",
        ),
        array(
            'name' => 'user_file',
            'type' => 'raw',
            'value'=> empty($model->user_file) ? "ไม่มีไฟล์" :CHtml::link(CHtml::encode($model->user_file), $pathUsersFile. '/' .$model->user_file,array(target=>_blank))
        ),
        array(
            'name' => 'start_date',
            'value' => Helpers::dateConvert($model->start_date, 'short', 'datetime'),
        ),
        array(
            'name' => 'user_update',
            'value' => Helpers::dateConvert($model->user_update, 'short', 'datetime'),
        ),
        'user_comment',
    ),
));
?>