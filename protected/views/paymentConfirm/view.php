<?php
$this->pageTitle = 'แจ้งการชำระเงิน';
$this->breadcrumbs = array(
    'แจ้งการชำระเงิน' => array('admin'),
    'ข้อมูลแจ้งการชำระเงิน ' . '(' . $model->firstname . ' ' . $model->lastname .')'
);
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="view-edit-button"><?php echo CHtml::button('แก้ไขข้อมูล', array('submit' => array('paymentConfirm/update/'.$model->payment_confirm_id))); ?></div>
<?php $pathPaymentConfirmFile = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder . '/payment_confirm_file'; ?>
<?php
$modelBank = Bank::model()->findByPk($model->bank_id);
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'firstname',
            'type' => 'html',
            'cssClass' => 'cdetailFontBold',
        ),
        array(
            'name' => 'lastname',
            'type' => 'html',
            'cssClass' => 'cdetailFontBold',
        ),
        array(
            'name' => 'order_number',
            'type' => 'html',
        ),
        array(
            'name' => 'tel',
            'type' => 'html',
        ),
        array(
            'name' => 'email',
            'type' => 'html',
        ),
        array(
            'name' => 'price',
            'type' => 'html',
             'value' => number_format($model->price),
        ),
        array(
            'name' => 'payment_confirm_time',
            'type' => 'html',
             'value' => Helpers::dateConvert($model->payment_confirm_time, 'short'),
        ),
        array(
            'name' => 'bank_id',
            'type' => 'html',
            'value' => $modelBank->bank_name,
        ),
        array(
            'name' => 'payment_confirm_file',
            'type' => 'raw',
            'value'=> empty($model->payment_confirm_file) ? "ไม่มีไฟล์" :CHtml::link(CHtml::encode($model->payment_confirm_file), $pathPaymentConfirmFile. '/' .$model->payment_confirm_file,array(target=>_blank))
        ),
        array(
            'name' => 'creation_time',
            'value' => Helpers::dateConvert($model->creation_time, 'short', 'datetime'),
        ),
        array(
            'name' => 'update_time',
            'value' => Helpers::dateConvert($model->update_time, 'short', 'datetime'),
        ),
        array(
            'name' => 'is_confirm',
            'type' => 'html',
            'value' => empty($model->is_confirm)?"<span style=\"color: #ff0000;\">รอตรวจสอบ</span>":"<span style=\"color: #009900;\">ถูกต้อง</span>",
        ),
        'note'
    ),
));
?>