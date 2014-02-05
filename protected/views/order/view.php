<style type="text/css">
.order-container {
font-family:Tahoma, Geneva, sans-serif;
margin:0px auto;
width:950px;
font-size:14px;
}
.order-head {
margin:50px 0 10px 0;
}
.order-title {
text-align:center;
font-size:24px;
font-weight:bold;
}
.order-head .order-customer {
float:left;
margin:10px 0 10px 0;
padding:5px;
border:1px solid #000;
}
.order-head .order-date {
text-align:right;
margin:10px 0 10px 0;
float:right;
padding:5px;
border:1px solid #000;
}
.order-underline {
border-bottom:#000 1px dashed;
}
.clear {
clear:both;
}
</style>
<?php
//print_r($orderview);
?>
<div class="order-container">
<div class="order-title">ใบสั่งซื้อ</div>
<div class="order-head">
<p><strong>เลขที่ใบสั่งซื้อ : </strong><?=$model->od_id?></p>
<p><strong>วันที่สั่งซื้อ : </strong><?=Helpers::dateConvert($model->od_date,'digit')?> </p>
<p><strong>ชื่อ-สกุล : </strong> <?=$model->user_name?></p>
<p><strong>ที่อยู่ : </strong> <?=$model->user_address?> <br class="clear" />
</p><div class="order-content">
<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border:1px solid #CCC;">
<tr align="center" >
<td style="border-bottom:1px solid #ccc;"><strong>รหัสสินค้า</strong></td>
<td style="border-bottom:1px solid #ccc;"><strong>รายการ</strong></td>
<td style="border-bottom:1px solid #ccc;"><strong>จำนวน</strong></td>
<td style="border-bottom:1px solid #ccc;"><strong>ราคา/หน่วย</strong></td>
<td style="border-bottom:1px solid #ccc;"><strong>ราคารวม</strong></td>
</tr>
<?php
$dataArray = $orderview->getData();
$qtnTotal=0;
$priceTotal=0;
foreach($dataArray as $data){
?>
<tr>
<td align="center"><?php echo CHtml::encode($data->product_id); ?></td>
<td><?php echo CHtml::encode($data->product_name); ?></td>
<td align="center"><?php echo CHtml::encode($data->odv_amount); ?></td>
<td align="center"><?php echo CHtml::encode(number_format($data->odv_price,2,'.',',')); ?></td>
<td align="center"><?php echo CHtml::encode(number_format($data->odv_amount*$data->odv_price,'2','.',',')); ?></td>
</tr>
<?php
$qtnTotal+=$data->odv_amount;
$priceTotal+=($data->odv_amount*$data->odv_price);
 }

?>
<tr>
  <td colspan="2" align="right"><strong>รวมทั้งหมด</strong></td>
  <td align="center"><strong>
    <?=$qtnTotal?>
  </strong></td>
  <td align="right">&nbsp;</td>
  <td align="center"><strong>
    <?=number_format($priceTotal,2,'.',',')?>
  </strong></td>
</tr>
</table>
</div>
</div>