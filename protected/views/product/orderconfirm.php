<div class="layout2" >
<div class="layout2_title">ยืนยันการสั่งซื้อสินค้า</div>
<div class="layout2_body">
<table width="100%" border="0" cellpadding="4" cellspacing="0">
    <tr>
    <td align="center" valign="middle" bgcolor="#0099FF" style="width:80px; height:30px; color: #FFF;"><strong>รหัสสินค้า</strong></td>
    <td align="center" valign="middle" bgcolor="#0099FF" style="color: #FFF"><strong>ชื่อสินค้า</strong></td>
    <td align="center" bgcolor="#0099FF" style="color: #FFF;width:80px;"><strong>ราคา/หน่วย</strong></td>
    <td align="center" bgcolor="#0099FF" style="color: #FFF;width:60px;"><strong>จำนวน</strong></td>
    <td align="center" bgcolor="#0099FF" style="color: #FFF;width:80px;"><strong>ราคารวม</strong></td>
    </tr>
  <?php 
  $url = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder;
  $allQty=0;
  $totalPrice=0;
  if(!empty($showCarts)){
  foreach($showCarts as $showCart) {
	  $price=$showCart->getPrice();
	  $quantity=$showCart->getQuantity();
	  $totalPrice+=($price*$quantity);
	  $allQty+=$quantity;
  ?>
  <tr>
    <td bgcolor="#F7F7F7"><?=$showCart->getCode()?></td>
    <td bgcolor="#F7F7F7"><?=$showCart->getName()?></td>
    <td align="center" bgcolor="#F7F7F7"><?=$price?></td>
    <td align="center" bgcolor="#F7F7F7"><?=$quantity?></td>
    <td align="center" bgcolor="#F7F7F7"><?=$showCart->getSumPrice()?></td>
    </tr>
  <?php } ?>

  <tr>
    <td colspan="3" align="right" bgcolor="#D9E0FF"><strong>รวมทั้งหมด</strong></td>
    <td align="center" bgcolor="#D9E0FF"><strong>
      <?=$allQty?>
    </strong></td>
    <td align="center" bgcolor="#D9E0FF"><strong>
      <?=$totalPrice?>
    </strong></td>
    </tr>
    <?php } else { ?>
    <?php } ?>
</table>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mycart-form',
    'action' => 'ordersave',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'clientOptions' => array('validateOnSubmit' => false),
        ));
?>
<br />
<table width="100%" border="0" cellpadding="3" cellspacing="0">
  <tr>
        <td colspan="2" bgcolor="#FF9900"><strong style="color: #FFF">ที่อยู่ในการจัดส่ง</strong></td>
    </tr>
    <tr>
        <td width="27%" align="right" bgcolor="#F7F7F7"><strong>ชื่อ-สกุล</strong></td>
        <td width="73%" bgcolor="#F7F7F7">
            <?php 
			
			//echo $form->textField($model_user, 'user_firstname', array('size' => 30, 'maxlength' => 50)); 
			
			?>
            <?php // echo $form->error($model_user, 'user_firstname'); ?>
            <input type="text" name="User[user_name]" value="<?=$model_user->user_firstname.' '.$model_user->user_lastname?>" />
        </td>
    </tr>
    <tr>
        <td align="right" bgcolor="#F7F7F7"><strong>เบอร์โทร</strong></td>
        <td bgcolor="#F7F7F7">
              <?php echo $form->textField($model_user, 'user_tel', array('size' => 20, 'maxlength' => 20)); ?>
            <?php echo $form->error($model_user, 'user_tel'); ?>
            
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" bgcolor="#F7F7F7"><strong>ที่อยู่</strong></td>
        <td bgcolor="#F7F7F7">
              <?php echo $form->textArea($model_user, 'user_address', array('rows' => 6, 'cols' => 50, 'id' => 'user_address')); ?>
            <?php echo $form->error($model_user, 'user_address'); ?>
            </td>
    </tr>
    <tr>
        <td bgcolor="#F0E2C6">&nbsp;</td>
        <td bgcolor="#F0E2C6"><input type="submit" name="bt_ordersave" id="bt_ordersave" value="บันทึกข้อมูล" /></td>
    </tr>
</table>
<?php $this->endWidget(); ?>
</div>
<div class="layout2_bottom"></div>
</div>
<br  style="clear:both;"/>