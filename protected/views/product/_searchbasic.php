<fieldset>
    <legend>ค้นหาสินค้า</legend>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'post',
            ));
    ?>
    <div class="row">
        <ul style="margin: 0px auto; padding: 0px; list-style: none; overflow: auto;">
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'product_name'); ?></li>
            <li style="margin: 0px; padding: 0px; width: 200px; padding: 4px; text-align: left; float: left;"><?php echo $form->textField($model, 'product_name', array('style' => 'width:150px;')); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px 0; text-align: right; float: left;"><?php echo $form->label($model, 'category_name'); ?></li>
            <li style="margin: 0px; padding: 0px; padding: 4px; text-align: left; float: left;"><?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(array('order' => 'category_name ASC')), 'category_id', 'category_name'), array('empty' => 'เลือกทั้งหมด...', 'style' => 'width:200px;')); ?></li>
        </ul>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('ค้นหา'); ?>
        &nbsp;
        <?php echo CHtml::button('รีเซต', array('onClick' => 'window.location="' . Yii::app()->request->baseUrl . '/product"')); ?>
    </div>

    <?php $this->endWidget(); ?>
</fieldset>