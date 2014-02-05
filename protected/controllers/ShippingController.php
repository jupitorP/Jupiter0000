<?php

class ShippingController extends Controller
{
    public $layout = '//layouts/column2';

    public function actionIndex() {
        $modelCmsPage = CmsPage::model()->find(array(
            'select' => 'title,page_content',
            'condition' => 'identifier=:identifier',
            'params' => array(':identifier' => 'shipping'),
                ));

        $this->render('index', array(
            'modelCmsPage' => $modelCmsPage,
        ));
    }

}