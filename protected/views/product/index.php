<?php
$this->pageTitle = 'สินค้าทั้งหมด';
$this->breadcrumbs = array(
    $showCategory,
);
$this->pageTitle = $showCategory;
?>
<div class="layout2" >
    <div class="layout2_title"><?php echo $showCategory; ?></div>
    <div class="layout2_body"><?php
$this->widget('ext.widgets.EColumnListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'columns' => 3,
    'widthPercent' => false,
    'widthColumn' => 100,
    'summaryText' => 'แสดงข้อมูลที่ {start} ถึง  {end} จากทั้งหมด {count} รายการ',
    'pager' => array(
        'header' => false,
    ),
));
?></div>
    <div class="layout2_bottom"></div>
</div>
<div style="clear:both;"></div>

