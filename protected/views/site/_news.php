<?php $url= 'http://'.Yii::app()->request->getServerName().'/'.$this->mainFolder; ?>
<div style="height: 90px; margin:0 auto 0px auto; display: block; text-align: center; clear: both;">
<div style="vertical-align: top; text-align: center; width: 120px; display: block; float: left; margin: 0px auto 0px auto">
<?php echo CHtml::image($url.'/news_image/'.$data->news_image,$data->news_topic,array('style'=>'width: 100px; height: 80px; border: 1px solid #C0C0C0; margin-bottom: 5px; margin-center: 0px; display: block;')); ?>
</div>
<div style="vertical-align: top; text-align: left; display: block; margin: 0px 0px 0px 0px;">
<div><?php echo CHtml::link(CHtml::encode($data->news_topic), array('news/view', 'id' => $data->news_id),array('title'=>$data->news_topic,'class'=>'news-topic-a'));?></div>
<div style="font-size: 12px; color: #FF0000">[<?php echo CHtml::decode($data->news_date); ?>]</div>
</div>
</div>