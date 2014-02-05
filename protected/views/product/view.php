<?php
$mainFolder = '';
if (!empty($this->mainFolder)) {
    $mainFolder = '/' . $this->mainFolder;
}
$url = 'http://' . Yii::app()->request->getServerName() . $mainFolder;
$this->breadcrumbs = array(
    $modelCategoryName->category_name => array('product/?catid=' . $model->category_id),
    $model->product_name,
);
$this->pageTitle = $model->product_name;
?>
<script src="<?php echo Yii::app()->baseUrl . '/js/jquery.elevatezoom.js'; ?>"></script>
<script type="text/javascript">
    $(function(){
        $("#zoom").elevateZoom(
        {gallery:'gallery', cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true, 
            loadingIcon: '<?php echo $url . '/images/animate/spinner.gif' ?>',
            zoomWindowWidth:590,
            borderSize: 1
        }
    );
    });
</script>
<style type="text/css">
    .zoomWindow{
        margin-left:10px;	
    }
</style>
<div class="layoutview" >
    <div class="layoutview_body">
        <div id="product_image">
            <div class="img_zoom"> 
                <?php
                echo CHtml::image("$url/images/products/mediums/" . CHtml::encode($model->product_image), $model->product_name, array('id' => 'zoom', ' data-zoom-image' => "$url/images/products/larges/" . CHtml::encode($model->product_image)));
                ?>
            </div>
            <div id="gallery">
                <?php
                $checkMdProductImg = count($modelProductImage);
                if ($checkMdProductImg > 1) {
                    foreach ($modelProductImage As $kPdImg => $vPdImg) {
                        $mediums = "$url/images/products/mediums/" . CHtml::encode($vPdImg->pdimg_name);
                        $larges = "$url/images/products/larges/" . CHtml::encode($vPdImg->pdimg_name);
                        ?>
                        <a href="#" data-image="<?php echo $mediums; ?>"  data-zoom-image="<?php echo $larges; ?>">
                            <?php
                            echo CHtml::image("$url/images/products/thumbs/" . CHtml::encode($vPdImg->pdimg_name), $model->product_name, array('width' => 90));
                            ?>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>            
        </div>
        <div id="product_detail_all">
            <div class="product_detail_item">
                <div class="product_name"><h1><?php echo $model->product_name; ?></h1></div>
                <div class="product_code"><?php echo CHtml::encode($model->getAttributeLabel('product_code')); ?> : <?php echo $model->product_code; ?></div>
                <?php
                if (!empty($model->product_tag)) {
                    ?>
                    <div id="tag">
                        <span class="tag_title">Tag :</span> 
                        <?php
                        $tagArr = explode(',', $model->product_tag);
                        $tagNo = 0;
                        $tagResult = '';
                        foreach ($tagArr As $kTag => $vTag) {
                            if ($tagNo == 0) {
                                $tagResult = CHtml::link($vTag, array('tag/view', 'TagName' => $vTag));
                            } else {
                                $tagResult.=',' . CHtml::link($vTag, array('tag/view', 'TagName' => $vTag));
                            }
                            ?>
                            <?php $tagNo++;
                        } ?>
                        <span><?php echo trim($tagResult); ?></span>
                    </div>
                <?php } ?>
                <div style="margin: 10px auto;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/banner_detail.png"></img>
                </div>
                <?php if (empty($model->product_active_price)) { ?>
                    <div class="item_price">ราคา <span class="item_price_number"><?php echo $model->product_price; ?></span> บาท</div>
                <?php } ?>
                <div class="item_update">ปรับปรุงข้อมูลล่าสุด : <?php echo Helpers::dateConvert($model->product_update, 'short') ?></div>
            </div >
        </div>
        <div style="clear: both;"></div>
        <div id="item_show_detail">
            <div class="product_detail_topic">
                <div>รายละเอียดสินค้า</div>
            </div>
            <div class="product_detail">
                <div><?php echo $model->product_detail; ?></div>
            </div>
            <div class="product_detail_bottom"></div>
            <div align="center">
                <div class="fb-comments" data-href="http://www.progresssystem.com/product/<?php echo $model->product_id; ?>" data-numposts="10" data-colorscheme="light" width="610"></div>
            </div>
        </div>
    </div>
    <div class="layout2_bottom"></div>
</div>
<br style="clear:both;"/>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/th_TH/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>