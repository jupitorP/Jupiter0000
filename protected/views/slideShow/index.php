<?php
$this->breadcrumbs=array(
	'Slide Shows',
);
?>
<?php

/*
$this->widget('ext.FlexPictureSlider.FlexPictureSlider',
  array(
    'imageBlockSelector' => '#egalleria_yw0', //the jquery selector
    'widthSlider' => '680', //or you can use jquery '$(window).width()/1.6',
    'heightSlider' => '180', //or you can use jquery '$(window).height()/1.6',
    'slideUnitSize' => 'px', //px or %
    'timeBetweenChangeSlider' => 4000,
    'timeDelayAnimation' => 1000, //the time before slider starts in miliseconds
    'sliderSuffle' => true, //suffle the pictures for random display, only for version 1.1
 
   ));
*/
$this->widget('Tslide',array('dataProvider'=>$dataProvider,'width'=>600,'height'=>500));
/*$this->widget('Galleria', array(
    'dataProvider'=>$dataProvider,
    'options' => array(
        'transition' => 'slide',
      /*  'autoplay' => 1000,
        'autoplay' => false,
        'popupLinks'=>true,
        //'carousel' => false,
        'width' => 600,*/
	//	'lightbox'=> true,
        //'dataConfig' => array(),
  /*  ),
    'binding'=>array(
        'image'=>'slide_show_path',
    ),
)); */
?>
