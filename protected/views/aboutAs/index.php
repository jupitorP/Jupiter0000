<?php
$this->pageTitle ='เกี่ยวกับเรา';
$this->breadcrumbs = array(
    'เกี่ยวกับเรา'
);
?>
<div class="layout2" >
    <div class="layout2_title"><?php echo $modelCmsPage->title; ?></div>
    <div class="layout2_body">
        <?php echo $modelCmsPage->page_content; ?>
    </div>
    <div class="layout2_bottom"></div>
</div>