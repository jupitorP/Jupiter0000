<?php
/* @var $this TagController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag',
	$tagName
);
$this->pageTitle='Tag '.$tagName;
?>

<div class="layout2" >
<div class="layout2_title"><h1>Tag : <?php echo $tagName;?></h1></div>
<div class="layout2_body"><?php
$this->widget('ext.widgets.EColumnListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
		'widthPercent'=>false,
	'widthColumn'=>100,
    'columns' => 3,
	'summaryText'=>'แสดงข้อมูลที่ {start} ถึง  {end} จากทั้งหมด {count} รายการ',
));
?></div>
<div class="layout2_bottom"></div>
</div>
<br  style="clear:both;"/>