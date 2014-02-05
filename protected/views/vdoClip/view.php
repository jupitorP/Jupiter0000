<?php
/* @var $this vdo_clipController */
/* @var $model vdo_clip */

$this->breadcrumbs=array(
	'วิดีโอคลิป'=>array('index'),
	$model->vdo_clip_topic,
);
?>
<?php
$str = $model->vdo_clip_url;
$screen_width="422px";
$screen_height="360px";
$autoplay=0;

$numlimit = "11";
$condition = "=";
$intStr = "";
$intStr = strpos($str, "$condition");
if ($intStr === false) {
    $strImgNamYT = "";
} else {
    $intStr = $intStr + 1;
    $strImgNamYT = substr($str, $intStr, $numlimit);
}
$strImgNamYT;

$vdofile_play = "<object type=\"application/x-shockwave-flash\" style=\"width:$screen_width; height:$screen_height;\" data=\"http://www.youtube.com/v/$strImgNamYT?autoplay=$autoplay\">
<param name=\"movie\" value=\"http://www.youtube.com/v/$strImgNamYT?autoplay=$autoplay\" />
</object>";
?>
<div id="layout3" >
<div id="layout3_title"><?=$model->vdo_clip_topic?></div>
<div id="layout3_body">
    <div style="width: 100%; text-align: center;">
        <?php echo CHtml::decode("<div style='margin: 10px auto 40px auto; display: block; text-align: center;'>".$vdofile_play."</div>"); ?>
    </div>
    <div style="padding: 0 20px 0 20px;">
        <?php echo CHtml::decode($model->vdo_clip_detail); ?>
    </div>
    <div style="vertical-align: bottom; text-align: right; color: #ff0000;">[วันที่ : <?php echo $model->vdo_clip_date; ?>]</div>
</div>
<div id="layout3_bottom"></div>
</div>
<br  style="clear:both;"/>
