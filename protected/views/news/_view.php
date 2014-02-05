<?php
/* @var $this NewsController */
/* @var $data News */
?>
<?php $url= 'http://'.Yii::app()->request->getServerName().'/'.$this->mainFolder; ?>
<div class="view">
<div style="display: block; height: 130px;">
<div style="display: block; height: 130px; width: 130px; vertical-align: middle; text-align: center; float: left;">
<?php echo CHtml::image($url.'/news_image/'.$data->news_image,$data->news_topic,array('style'=>'width: 120px; height: 120px; border: 1px solid #C0C0C0; margin-bottom: 5px; margin-center: 0px; display: block;')); ?>
</div>
<div style=" padding: 4px; float: left; line-height: 18px;">
<div><?php echo CHtml::link(CHtml::encode($data->news_topic), array('news/view', 'id' => $data->news_id),array('title'=>$data->news_topic,'class'=>'news-topic-a'));?></div>
<div style="font-size: 12px; color: #FF0000">[<?php echo CHtml::decode($data->news_date); ?>]</div>
</div>
</div>
</div>