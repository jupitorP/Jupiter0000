<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'username'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'username', array('size' => 30, 'maxlength' => 20)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'rules'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->dropDownList($model, 'rules', CHtml::listData(Rules::model()->findAll(array('order' => 'rules ASC')), 'rules', 'rules_name'), array('empty' => 'เลือกทั้งหมด...', 'style' => 'width:200px;')); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_firstname'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'user_firstname', array('size' => 30, 'maxlength' => 100)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_lastname'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'user_lastname', array('size' => 30, 'maxlength' => 100)); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_birthday'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;">
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
            </li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'sex_id'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->radioButtonList($model, 'sex_id', array('1' => 'ชาย ', '2' => 'หญิง'), array('labelOptions' => array('style' => 'display:inline; float: none; padding: 0px;'), 'separator' => '',)); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_mobile'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'user_mobile', array('size' => 30, 'maxlength' => 50)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_tel'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'user_tel', array('size' => 30, 'maxlength' => 50)); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_email'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'user_email', array('size' => 30, 'maxlength' => 50)); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'province_id'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->dropDownList($model, 'province_id', CHtml::listData(Province::model()->findAll(array('order' => 'province_name ASC')), 'province_id', 'province_name'), array('empty' => 'เลือกทั้งหมด...', 'style' => 'width:200px;')); ?></li>
        </ul>
    </div>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'start_date'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 240px; padding: 4px; text-align: left; float: left;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'start_date',
                    'value' => $model->start_date,
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
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'user_update'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'user_update',
                    'value' => $model->user_update,
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