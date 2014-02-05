<?php
$this->pageTitle = 'สมัครสมาชิก';
$this->breadcrumbs=array(
	'สมัครสมาชิก'
);
?>
<div class="layout2" >
<div class="layout2_title">สมัครสมาชิก</div>
<div class="layout2_body">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<div class="layout2_bottom"></div>
</div>