<?php
$url = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mycart-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'clientOptions' => array('validateOnSubmit' => false),
        ));
?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#info,#info-error").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="layout2" >
    <div class="layout2_title">ตะกร้าสินค้า</div>
    <div class="layout2_body"><table width="100%" border="0" cellpadding="4" cellspacing="1">
            <tr>
                <td align="center" valign="middle" bgcolor="#0099FF" style="width:80px; height:30px; color: #FFF;"><strong>รหัสสินค้า</strong></td>
                <td align="center" valign="middle" bgcolor="#0099FF" style="color: #FFF"><strong>ชื่อสินค้า</strong></td>
                <td align="center" bgcolor="#0099FF" style="color: #FFF;width:80px;"><strong>ราคา/หน่วย</strong></td>
                <td align="center" bgcolor="#0099FF" style="color: #FFF;width:60px;"><strong>จำนวน</strong></td>
                <td align="center" bgcolor="#0099FF" style="color: #FFF;width:80px;"><strong>ราคารวม</strong></td>
                <td align="center" bgcolor="#0099FF" style="color: #FFF;width:50px;"><strong>Clear</strong></td>
            </tr>
<?php
$allQty = 0;
$totalPrice = 0;
if (!empty($showCarts)) {
    foreach ($showCarts as $showCart) {
        $price = $showCart->getPrice();
        $quantity = $showCart->getQuantity();
        $totalPrice+=($price * $quantity);
        $allQty+=$quantity;
        ?>
                    <tr>
                        <td bgcolor="#F7F7F7"><?= $showCart->getCode() ?></td>
                        <td bgcolor="#F7F7F7"><?= $showCart->getName() ?></td>
                        <td align="center" bgcolor="#F7F7F7"><?= $price ?></td>
                        <td align="center" bgcolor="#F7F7F7"><input type="text" name="quantity[<?= $showCart->getId() ?>]" value="<?= $quantity ?>"  style="width:30px;" /></td>
                        <td align="center" bgcolor="#F7F7F7"><?= $showCart->getSumPrice() ?></td>
                        <td align="center" bgcolor="#F7F7F7">
        <?php
        echo CHtml::link('<img src="' . $url . '/images/icons/trash.png" alt="clear cart" title="ลบรายการสินค้าที่สั่งซื้อ" />', '#', array('submit' => array('product/showcart', 'remove' => $showCart->getId()), 'confirm' => 'Are you sure?'));
        ?>
                        </td>
                    </tr>
    <?php } ?>

                <tr>
                    <td colspan="3" align="right" bgcolor="#D9E0FF"><strong>รวมทั้งหมด</strong></td>
                    <td align="center" bgcolor="#D9E0FF"><strong>
    <?= $allQty ?>
                        </strong></td>
                    <td align="center" bgcolor="#D9E0FF"><strong>
    <?= $totalPrice ?>
                        </strong></td>
                    <td bgcolor="#D9E0FF">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="6" align="right"><input type="submit" name="btnUpdate" value="Update" /></td>
                </tr>
                <tr>
                    <td colspan="6" align="center"><?php //echo CHtml::link('Delete All','#',array('submit'=>array('product/showcart','removeAll'=>'OK'),'confirm' => 'Are you sure?')); ?>
    <?php echo CHtml::link('&laquo; ซื้อสินค้าต่อ', array('product/index')); ?>   / <?php echo CHtml::link('ยืนยันการสั่งซื้อ &raquo;', array('product/orderconfirm')); ?></td>
                </tr>
                    <?php } else { ?>
                <tr>
                    <td colspan="6" align="center">ยังไม่มีสินค้าในตะกร้า</td>
                </tr>
<?php } ?>
        </table></div>
    <div class="layout2_bottom"></div>
</div>
<br  style="clear:both;"/>

<?php $this->endWidget(); ?>
