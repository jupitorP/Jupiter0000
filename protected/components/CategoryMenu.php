<?php

Yii::import('zii.widgets.CMenu', true);

class CategoryMenu extends CMenu {

    public function init() {
        echo $this->buildMenu();
        parent::init();
    }

    public function buildMenu() {
        $menus = $this->getMenuCategory();

        $html = "";
        if ($menus) {
            $html.="<ul class='layout1_body'>";
            foreach ($menus as $menu) {
                $html.="<li class='li_menutop'>";
                //$html.="<a href='product?catid=".$menu["category_id"]."'>".$menu["category_name"]."</a>";//href not loop :(
                $html.=CHtml::link($menu["category_name"], array('product/?catid=' . $menu["category_id"]));
                $html.="</li>";
            }
            $html.="</ul>";
        }

        return $html;
    }

    public function getMenuCategory() {
        $category = new Category;
        $result = $category->model()->findAll(array('order' => 'category_name ASC'));
        return $result;
    }

}

?>