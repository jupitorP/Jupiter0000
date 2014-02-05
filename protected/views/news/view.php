<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'ข่าวประชาสัมพันธ์'=>array('index'),
	$model->news_topic,
);
?>
<?php $url= 'http://'.Yii::app()->request->getServerName().'/'.$this->mainFolder; ?>
<div id="layout3" >
<div id="layout3_title"><?=$model->news_topic?></div>
<div id="layout3_body">
    <?php if(!empty($model->news_image)){?>
    <div>        
        <?php echo CHtml::image($url.'/news_image/'.$model->news_image,$model->news_topic,array('style'=>'border: 2px solid #DCDCE6; margin-top: 10px; margin-bottom: 20px; margin-center: 0px; display: block;')); ?>
    </div>
    <?php } ?>
    <div style="padding: 0 20px 0 20px;">
        <?php echo CHtml::decode($model->news_detail); ?>
    </div>
</div>
<div id="layout3_bottom"></div>
</div>
<br  style="clear:both;"/>
