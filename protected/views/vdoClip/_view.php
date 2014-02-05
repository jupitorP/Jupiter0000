<?php
$str = $data->vdo_clip_url;
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
?>
<div style="display: block; height: 130px;">
<div style="display: block; height: 130px; width: 130px; vertical-align: middle; text-align: center; float: left;">
<?php echo CHtml::image("http://i3.ytimg.com/vi/$strImgNamYT/default.jpg", $data->vdo_clip_topic,array('style'=>'width: 120px; height: 120px; border: 1px solid #C0C0C0; margin-bottom: 5px; margin-center: 0px; display: block;')); ?>
</div>
<div style=" padding: 4px; float: left; line-height: 18px;">
<div><?php echo CHtml::link(CHtml::encode($data->vdo_clip_topic), array('vdoClip/view', 'id' => $data->vdo_clip_id),array('title'=>$data->vdo_clip_topic,'class'=>'news-topic-a'));?></div>
<div style="font-size: 12px; color: #FF0000">[<?php echo CHtml::decode($data->vdo_clip_date); ?>]</div>
</div>
</div>