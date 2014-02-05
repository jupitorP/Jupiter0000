<?php
/**
 * @var CDataProvider $data
 * @var string $imagePrefixSeparator
 * @var string $srcPrefix
 * @var string $srcPrefixThumb
 */
echo "<div id='galleria_" . $this->id . "' >";
if (isset($bind)) {
    $images = $data->getData();
    foreach ($images as $image) {
        $htmlOptions = array();
        $alt      ='';
		if(@ !empty($image->$bind['description'])){
			  $alt=$image->$bind['description'];
		}
        $htmlOptions['title'] = @!empty($image->$bind['title']) ? $image->$bind['title'] : '';
 //$htmlOptions['href']='http://www.google.com';
        $imageName     =@!empty($image->$bind['imagePrefix']) ? $image->$bind['imagePrefix'] . $imagePrefixSeparator . $image->$bind['image'] : $image->$bind['image'];
        $imageSrc      = $srcPrefix . $imageName;
        $imageSrcThumb = $srcPrefixThumb ? $srcPrefixThumb . $imageName : $imageSrc;
		$images= CHtml::link(CHtml::image($imageSrcThumb, $alt, $htmlOptions), $imageSrc, $htmlOptions);
echo $images;
       // echo CHtml::link(CHtml::image($imageSrcThumb, $alt, $htmlOptions), $imageSrc, $htmlOptions);
    }
}
echo "</div>";
