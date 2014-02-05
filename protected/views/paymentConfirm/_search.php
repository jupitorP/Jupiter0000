<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'firstname'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'firstname', array('size' => 30, 'maxlength' => 20)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'lastname'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'lastname', array('size' => 30, 'maxlength' => 20)); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'tel'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'tel', array('size' => 30, 'maxlength' => 20)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'email'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'email', array('size' => 30, 'maxlength' => 20)); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'order_number'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'order_number', array('size' => 30, 'maxlength' => 20)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'payment_confirm_time'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'payment_confirm_time',
                    'value' => $model->payment_confirm_time,
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
            </li>
        </ul>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('ค้นหา'); ?>
        &nbsp;
        <?php echo CHtml::button('รีเซต', array('onClick' => 'window.location="' . Yii::app()->getRequest()->getUrl() . '"')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>