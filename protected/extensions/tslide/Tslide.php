<?php

class Tslide extends CWidget {

    public $width = '700';
    public $height = '400';
    public $dataProvider = null;
 public $assets;
 public static $defaultOptions = array('transition' => 'fade', 'debug' => YII_DEBUG);
    public function init() {
        //เริ่มต้นตรงนี้
         $this->assets = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');
    }

    public function run() {
        $cs = Yii::app()->clientScript;
         $ext = YII_DEBUG ? '.js' : '.min.js';
 $cs->registerScriptFile($this->assets . '/tslide'.$ext);

 $this->render('tslide',array('data'=>$this->dataProvider ) );
        //แล้วทำส่วนนี้ทีหลัง
    }

}

?>