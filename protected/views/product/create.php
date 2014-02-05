<?php
$this->pageTitle = Yii::app()->name . ' - เพิ่มข้อมูลสินค้า';
$this->breadcrumbs = array(
    'จัดการสินค้า' => array('admin'),
    'เพิ่มข้อมูลสินค้า'
);
?>
<script src="<?php echo Yii::app()->baseUrl . '/js/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/jsfunc.js'; ?>"></script>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_name'); ?>
        <?php echo $form->textField($model, 'product_name', array('maxlength' => 1000, 'style' => 'width:700px;')); ?>
        <?php echo $form->error($model, 'product_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_code'); ?>
        <?php echo $form->textField($model, 'product_code', array('maxlength' => 300, 'style' => 'width:250px;')); ?>
        <?php echo $form->error($model, 'product_code'); ?>
    </div>    
    <div class="row">
        <?php echo $form->labelEx($model, 'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id', CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name'), array('empty' => 'กรุณาเลือก...'));?>
        <?php echo $form->error($model, 'category_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_amount'); ?>
        <?php echo $form->textField($model, 'product_amount', array('maxlength' => 140, 'style' => 'width:140px;')); ?>
        <?php echo $form->error($model, 'product_amount'); ?>
    </div>
    <div class="row" style="display:inline-table; vertical-align:middle;">
        <?php echo $form->labelEx($model, 'product_price'); ?>
        <?php echo $form->textField($model, 'product_price', array('maxlength' => 140, 'style' => 'width:140px;')); ?>
        <?php echo $form->error($model, 'product_price'); ?>
       
    </div>
    <div class="row" style="display:inline-table; vertical-align:middle; padding: 15px 0 0 10px;">
     <?php echo $form->checkBox($model, 'product_active_price', array('id' => 'product_active_price','style' => 'display:inline-block; vertical-align:middle;')); ?>
     <?php echo $form->labelEx($model, 'product_active_price', array('style' => 'display:inline-block; vertical-align:middle;')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_detail'); ?>
        <?php echo $form->textArea($model, 'product_detail', array('id' => 'product_detail')); ?>
        <?php echo $form->error($model, 'product_detail'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_tag'); ?>
        <?php echo $form->textArea($model, 'product_tag', array('id' => 'product_tag','style' => 'width:700px; height:80px;')); ?>
        <div>หากแท็กมีหลายคำให้คั่นด้วยคอมม่า (,) เช่น สินค้าขายดี,สินค้าคุณภาพ,ราคาถูก</div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_image'); ?>
        <div id="area-figure">
            <div id="thumbnails" style="float:left;"></div>
            <div id="upload_image" style="float:left;">                    
                <span class="ic-camera">
                    <input id="input_imageupload" type="file"  name="Filedata" />
                </span>
            </div>
            <br class="clear" />
        </div>
        <?php $url = 'http://' . Yii::app()->request->getServerName() . '/' . $this->mainFolder; ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.widget.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.iframe-transport.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fileupload.js"></script>

        <script type="text/javascript">
            var i = 0;
            $(function() {
                $("#input_imageupload").fileupload({
                    url: '<?php echo $url; ?>/product/tmpimage',
                    dataType: 'html',
                    done: function(e, data) {
                        var $data = data.result;

                        var fileid = $data.substring(7, 39);
                        var type = $data.substring(40);
                        if ($data.substring(0, 7) === "FILEID:") {
                            for (i = 1; i < 100; i++) {
                                if ($('#Usepic' + i).val() == undefined) {
                                    $('#upload_image').append('<input id="Img' + i + '" type="hidden" value="' + fileid + "." + type + '" name="Productimage[img][' + i + ']">');
                                    $('#upload_image').append('<input id="Usepic' + i + '" type="hidden" value="Y" name="Productimage[usepic][' + i + ']">');

                                    break;
                                } else if ($('#Usepic' + i).value == "D") {
                                    $('#Usepic' + i).value = "Y";
                                    $('#Img' + i).value = fileid + "." + type;
                                    break;
                                }
                            }

                            addImage("<?php echo $url; ?>/product/thumbnail/?id=" + $data.substring(7), i);

                        } else {
                            alert('เกิดข้อผิดพลาดเกิดขึ้น ไม่สามารถอัพโหลดรูปได้');
                        }
                    }
                }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
            });

            function addImage(src, fid) {
                var newImg = document.createElement("img");
                newImg.style.margin = "5px";
                var newD = document.createElement('div');
                newD.className = 't-img';
                newD.id = fid;
                var newA = document.createElement('a');
                newA.href = 'javascript:delImg(\'' + fid + '\')';
                var radioHtml = '<div><input type="radio" id="rd_main_img_' + fid + '" name="Productimage[main_img]" value="' + fid + '"';
                if (fid == '1') {
                    radioHtml += ' checked="checked"';
                }
                radioHtml += '/>ตั้งเป็นรูปหลัก</div>';
                var radioFragment = document.createElement('div');
                radioFragment.innerHTML = radioHtml;
                newD.appendChild(newA);
                newD.appendChild(newImg);
                newD.appendChild(radioFragment);
                document.getElementById("thumbnails").appendChild(newD);
                if (newImg.filters) {
                    try {
                        newImg.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 0;
                    } catch (e) {
                        newImg.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + 0 + ')';
                    }
                } else {
                    newImg.style.opacity = 0;
                }
                newImg.onload = function() {
                    fadeIn(newImg, 0);
                };
                newImg.src = src;
            }

            function delImg(i) {
                if ($('#rd_main_img_' + i).prop('checked')) {
                    alert('ไม่สามารถลบรูปนี้ได้เพราะถูกตั้งเป็นรูปหลัก');
                } else {
                    if ($("#Usepic" + i).value == "O") {
                        $("#Usepic" + i).value = "D";
                    } else if ($("#Usepic" + i).value == "Y") {
                        $("#Usepic" + i).value = "D";
                    }
                    $('#' + i).fadeOut();
                    $("#Img" + i).value = "";
                }
            }

            function fadeIn(element, opacity) {
                var reduceOpacityBy = 5;
                var rate = 30;
                if (opacity < 100) {
                    opacity += reduceOpacityBy;
                    if (opacity > 100) {
                        opacity = 100;
                    }

                    if (element.filters) {
                        try {
                            element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
                        } catch (e) {
                            element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
                        }
                    } else {
                        element.style.opacity = opacity / 100;
                    }
                }

                if (opacity < 100) {
                    setTimeout(function() {
                        fadeIn(element, opacity);
                    }, rate);
                }
            }

        </script>
        <style type="text/css">
            #area-figure{
                border: 2px dashed #E5E5E5;
                border-radius: 10px;
                max-width: 100%;
                padding: 20px;
                position: relative;
                margin: 10px auto;
            }
            #upload_image{
                width:120px;height:120px;
                background-color:#EFEFEF;
                border:1px solid #CCCCCC;
                color:#CCCCCC;
            }

            #upload_image>span:after{
                content: "คลิกเลือกรูปภาพ";
                font-size: 13px;
                top:40%;
                position: absolute;
                vertical-align: middle;
                width: 100%;
                height:100%;     
                text-align:center;
            }

            #upload_image>span{
                display: block;         
                overflow: hidden;
                position: relative;
                vertical-align: middle;
                width: 100%;
                height:100%;
            }

            #input_imageupload{
                cursor: pointer;
                opacity: 0;
                filter: alpha(opacity=0);
                height: 100%;
                left: 0;
                line-height: 90px;
                margin: 0;
                padding: 0;
                position: absolute;
                top: 0;
                width: 100%;

                z-index: 1000;
                vertical-align: middle;
            }
        </style>        
        <?php echo $form->error($model, 'product_image'); ?>
    </div>
     
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึก'); ?>
        &nbsp;
        <?php echo CHtml::resetButton('รีเซต', ''); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<div style="text-align: right;"><span style="font-size: 12px; color: #ff0000;">*</span> <span style="font-size: 12px;">ข้อมูลที่ต้องการ.</span></div>
<script type="text/javascript">
    $(document).ready(function() {
        loadCkeditor3('product_detail','700','400');
    });
</script>