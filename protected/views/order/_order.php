<tr>
<td align="center"><?php echo CHtml::encode($data->product_id); ?></td>
<td><?php echo CHtml::encode($data->product_name); ?></td>
<td align="center"><?php echo CHtml::encode($data->odv_amount); ?></td>
<td align="right"><?php echo CHtml::encode($data->odv_price); ?></td>
<td align="right"><?php echo CHtml::encode($data->odv_amount*$data->odv_price); ?></td>
</tr>