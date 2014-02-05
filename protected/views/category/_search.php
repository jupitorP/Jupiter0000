<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'category_code'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'category_code', array('size' => 30, 'maxlength' => 20)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'category_name'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'category_name', array('size' => 30, 'maxlength' => 20)); ?></li>
        </ul>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('ค้นหา'); ?>
        &nbsp;
        <?php echo CHtml::button('รีเซต', array('onClick' => 'window.location="' . Yii::app()->getRequest()->getUrl() . '"')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>