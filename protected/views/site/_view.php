<?php
$mainFolder = '';
if (!empty($this->mainFolder)) {
    $mainFolder = '/' . $this->mainFolder;
}
$url = 'http://' . Yii::app()->request->getServerName() . $mainFolder;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/prettyphoto/css/prettyPhoto.css" />
<div class="view">
    <div class="image_zoom">
        <?php
        $imgProduct = CHtml::image("$url/images/products/thumbs/" . CHtml::encode($data->product_image), "$data->product_name", array("width" => 140, 'border' => 0));
        echo CHtml::link($imgProduct, array('product/view', 'id' => $data->product_id), array('title' => $data->product_name));
        ?>
    </div>
    <div class="product_item">
        <div class="product_item_code">
            <span class="code_label"><?php echo CHtml::encode($data->getAttributeLabel('product_code')); ?>:</span>
            <span><?php echo CHtml::encode($data->product_code); ?></span>
        </div>
        <div class="product_item_name">
            <?php
            echo CHtml::link(CHtml::encode($data->product_name), array('product/view', 'id' => $data->product_id), array('title' => $data->product_name));
            ?>
        </div>
        <?php if (empty($data->product_active_price)) { ?> 
            <div class="product_item_price">
                <span><?php echo CHtml::encode($data->getAttributeLabel('product_price')); ?>: </span>
                <span class="price_number"><?php echo CHtml::encode($data->product_price); ?></span> บาท
            </div>
        <?php } ?>
    </div>
    <div style="clear:both;"></div>
</div>