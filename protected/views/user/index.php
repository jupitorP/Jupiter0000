<?php

$this->breadcrumbs = array(
    'ผู้ใช้งานระบบ',
);
?>
<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
