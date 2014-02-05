<?php
$this->pageTitle='สวัสดีค่ะ www.สติ๊กเกอร์ติดขนม.com ยินดีต้อนรับ';
?>
<div class="layout2">
    <?php ?>
    <div class="layout2_title"><?php echo $modelCmsPage->title; ?></div>
    <div class="layout2_body">
        <?php echo $modelCmsPage->page_content; ?>
    </div>
    <div class="layout2_bottom"></div>

    <div class="layout2_title">สินค้าตัวอย่าง</div>
    <div class="layout2_body">
        <?php
        $this->widget('ext.widgets.EColumnListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'enableSorting' => true,
            'template' => '{pager}{items}{pager}',
            'columns' => 4
        ));
        ?>
        <div class="showAll"><?php echo CHtml::link(CHtml::encode('ดูทั้งหมด'), array('product/index'), array('title' => 'ดูทั้งหมด')); ?></div>
    </div>
    <div class="layout2_bottom"></div>
</div>