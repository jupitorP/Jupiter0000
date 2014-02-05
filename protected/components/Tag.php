<?php


class Tag   {

    public function Tag() {
        $productTagCount=new ProductTagCount;
        $menus=$productTagCount->model()->findAll(array('order'=>'tagcount_sum DESC','limit'=>50));
        $html = "";
        $cMenus=count($menus);
        if (!empty($cMenus)) {
            $html.="<div class='layout1_body'>";
            $html.="<div>";
            foreach ($menus as $menu) {
                $html.=CHtml::link($menu["tag_name"], array('tag/view', 'TagName' => $menu["tag_name"])) . ' ';
            }
            $html.="</div>";
            $html.="</div>";
        }

        return $html;
    }
}

?>