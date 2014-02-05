<?php

class ProductController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'rights'
        );
    }

    public function actionTmpimage() {
        Yii::app()->lnwupload->tmpuploadImg();
    }

    public function actionThumbnail($id = null) {
        $sesArray = Yii::app()->session['file_info'];
        header("Content-type: image/jpeg");
        header("Content-Length: " . strlen($sesArray["'" . $id . "'"]));
        echo $sesArray["'" . $id . "'"];
    }

    public function actionAddtocart($cartId = 0) {
        $model = new Product;
        $qty_total = 0;
        $qty_in_cart = 0;
        $qty_in_db = 0;
        $cart = Yii::app()->shoppingCart;
        $product = $model->findByPk($cartId);
        $cart->put($product);
        $posi_quantity = $cart->itemAt($cartId);
        $qty_in_cart = $posi_quantity->getQuantity();
        $qty_in_db = $product->product_amount;
        $qty_total = $qty_in_cart + $qty_in_db;
        if ($qty_in_cart > $qty_in_db) {//จำนวนในตะกร้ามากกว่าในฐานข้อมูล 
            $cart->update($product, $qty_in_db); //กำหนดให้เท่ากับจำนวนในฐานข้อมูล
            Yii::app()->user->setFlash('error', "สินค้าชิ้นนี้เหลือน้อยกว่าจำนวนที่สั่งซื้อ");
            $this->redirect(array('showcart'));
        } else {
            if (!empty($product)) {
                Yii::app()->user->setFlash('success', "หยิบสินค้าลงในตะกร้าเรียบร้อยแล้ว");
                $this->redirect(array('showcart'));
            } else {
                $this->redirect(array('index'));
            }
        }
    }

    public function actionShowcart($remove = null, $removeAll = null) {
        $btnUpdates = isset($_POST['btnUpdate']) ? $_POST['btnUpdate'] : 0;
        $quantitys = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
        if (!empty($remove)) {
            $this->cartRemove($remove);
            Yii::app()->user->setFlash('success', "ลบรายการสินค้าในตะกร้าเรียบร้อยแล้ว");
            $this->redirect(array('showcart'));
        } else if (!empty($removeAll)) {
            Yii::app()->shoppingCart->clear();
            Yii::app()->user->setFlash('success', "เคลียร์รายการสินค้าในตะกร้าเรียบร้อยแล้ว");
            $this->redirect(array('showcart'));
        } else if (!empty($btnUpdates)) {
            $error = "";

            foreach ($quantitys as $qtyId => $qtyVal) {
                $qtyVal*=1;
                if (!empty($qtyVal)) {
                    $product = Product::model()->findByPk($qtyId);
                    $cart = Yii::app()->shoppingCart;
                    $cart->update($product, $qtyVal);
                    $posi_quantity = $cart->itemAt($qtyId);
                    $qty_in_cart = $posi_quantity->getQuantity();
                    $qty_in_db = $product->product_amount;
                    if ($qty_in_cart > $qty_in_db) {//จำนวนในตะกร้ามากกว่าในฐานข้อมูล 
                        $cart->update($product, $qty_in_db); //กำหนดให้เท่ากับจำนวนในฐานข้อมูล

                        $error = true;
                    }
                } else {
                    //$this->cartRemove($qtyId);
                }
            }
            if ($error) {
                Yii::app()->user->setFlash('error', "สินค้าชิ้นนี้เหลือน้อยกว่าจำนวนที่สั่งซื้อ");
            } else {
                Yii::app()->user->setFlash('success', "อัพเดทรายการสินค้าในตะกร้าเรียบร้อยแล้ว");
            }
            $this->redirect(array('showcart'));
        } else {
            $showCarts = Yii::app()->shoppingCart->getPositions();
            $this->render('showcart', array('showCarts' => $showCarts));
        }
    }

    public function actionOrderConfirm() {
        $userId = Yii::app()->user->id;
        $showUser = User::model()->findByPk($userId);
        // $showUser =User::model()->loadModel($userId);
        $showCarts = Yii::app()->shoppingCart->getPositions();
        $this->render('orderconfirm', array('showCarts' => $showCarts, 'model_user' => $showUser));
    }

    public function actionOrderSave() {
        //บันทึกลง order กับ orderview และ update จำนวนสินค้าใน product
        if (isset($_POST['User'])) {
            $model_order = new Order();
            $model_orderv = new Orderview();
            $model_order->attributes = $_POST['User'];
            $userId = Yii::app()->user->id; //รหัสสมาชิก
            $name = trim($model_order['user_name']); //ชื่อสมาชิก

            $tel = trim($model_order['user_tel']); //เบอร์โทรสมาชิก
            $address = trim(nl2br($model_order['user_address'])); //ที่อยู่สมาชิก
            //echo  $name;
            //exit();
            $model_order->user_id = $userId;
            $model_order->user_name = $name;
            $model_order->user_tel = $tel;
            $model_order->user_address = $address;
            $model_order->od_date = date('Y-m-d');


            if ($model_order->save()) {
                $last_order_id = Yii::app()->db->getLastInsertID(); //หา Id ล่าสุด
                $showCarts = Yii::app()->shoppingCart->getPositions();
                //insert ลง orderview
                foreach ($showCarts as $showCart) {
                    $model_orderv->setIsNewRecord(true);
                    $model_orderv->setPrimaryKey(NULL);
                    $model_orderv->od_id = $last_order_id; //รหัสใบสั่งซื้อ
                    $pd_id = $showCart->getId(); //รหัสสินค้า
                    $pd_qty = $showCart->getQuantity();
                    $model_orderv->product_id = $pd_id;
                    $model_orderv->product_name = $showCart->getName();
                    $model_orderv->odv_price = $showCart->getPrice(); //ราคา/ชิ้น
                    $model_orderv->odv_amount = $pd_qty; //จำนวน/ชิ้น
                    if ($model_orderv->save(false)) {
                        $model_pd = Product::model()->findByPk($pd_id);
                        $model_pd->product_amount = ($model_pd->product_amount - $pd_qty);
                        $model_pd->save(); //update จำนวนสินค้า
                    }
                }
                Yii::app()->shoppingCart->clear();
                $this->redirect(array('index'));
            }
        } else {
            $this->redirect(array('showcart'));
        }
    }

    public function cartRemove($remove) {
        Yii::app()->shoppingCart->remove($remove);
    }

    public function actionCreate() {
        Yii::app()->theme = 'bluewhale-admin';
        $model = new Product;
        $rnd = date('dmYHis');

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            $product_image = $_POST['Productimage'];
            $model->product_create = date('Y-m-d H:i:s');
            $model->product_update = date('Y-m-d H:i:s');
         
            if ($model->save()) {
                $yiiApp = Yii::app();
                $lastId = $yiiApp->db->getLastInsertID();
                $pathName = $yiiApp->lnwupload->getFolder();
                $pathReal = $yiiApp->lnwupload->realPath() . '/tmp';
                if (isset($product_image['img'])) {
                    $countImg = count($product_image['img']);
                    for ($i = 1; $i <= $countImg; $i++) {
                        $vimgs = $product_image['img'][$i];
                        $mainImg = $product_image['main_img'];
                        $modelPdImg = new ProductImage;
                        if ($vimgs != "") {
                            $yiiApp->lnwupload->resizeRealImg('resizeBig', $pathReal . '/' . $vimgs, $pathName . '/larges/', $vimgs, 740, 740, 100);
                            $yiiApp->lnwupload->resizeRealImg('resize', $pathReal . '/' . $vimgs, $pathName . '/mediums/', $vimgs, 340, 340, 100);
                            $yiiApp->lnwupload->resizeRealImg('resize', $pathReal . '/' . $vimgs, $pathName . '/thumbs/', $vimgs, 180, 180, 100);
                            unlink('tmp/' . $vimgs);
                            $insertImg = $vimgs;
                            $modelPdImg->setIsNewRecord(true);
                            if ($mainImg == $i) {
                                $modelPdImg->pdimg_album = 1;
                                $updateProductImg = $yiiApp->db->createCommand("UPDATE product SET product_image='" . $insertImg . "' WHERE product_id=" . $lastId);
                                $updateProductImg->execute();
                            }
                            $modelPdImg->product_id = $lastId;
                            $modelPdImg->pdimg_name = $insertImg;
                            $modelPdImg->save();
                        }
                    }
                }
                //Save Tag

                if (!empty($_POST['Product']['product_tag'])) {
                    $tagName = $_POST['Product']['product_tag'];
                    //ค้นหา tag ว่างหรือไม่ว่างใน product_tag_count
                    $tagNameArr = explode(',', $tagName);
                    foreach ($tagNameArr As $kTagName => $vTagName) {
                        if (!empty($vTagName)) {
                            $vTagName = trim($vTagName);
                            $modelTag = new ProductTagCount;
                            $chkTagCount = $modelTag->model()->find(array('condition' => "tag_name='$vTagName' ", 'select' => 'tag_name,tagcount_id'));
                            if (empty($chkTagCount->tag_name)) {//เพิ่ม Tag
                                $modelTag->tag_name = $vTagName;
                                $modelTag->save();
                            } else {//Update Tag
                                $modelTagId = $modelTag->model()->findByPk($chkTagCount->tagcount_id);
                                $modelTagId->tagcount_sum = $modelTagId->tagcount_sum + 1;
                                $modelTagId->save();
                            }
                            //save ลง product_tag
                            $modelTag2 = new ProductTag;
                            $modelTag2->product_id = $lastId;
                            $modelTag2->tag_name = $vTagName;
                            $modelTag2->save();
                        }
                    }
                }

                $this->redirect(array('admin'));
            }
        }
        $this->titlepage = 'เพิ่มสินค้า';
        $this->render('create', array(
            'model' => $model
        ));
    }

    public function actionUpdate($id = null) {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'แก้ไขรายการสินค้า';
        $model = $this->loadModel($id);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            $product_image = $_POST['Productimage'];
            $yiiApp = Yii::app();
            $pdimg_name = '';
            if (preg_match('/^([0-9]+)\/\m/', $product_image['main_img'], $idMainImg)) {

                $updateMainImg0 = $yiiApp->db->createCommand("UPDATE product_image SET pdimg_album=0  WHERE product_id=" . $id);
                $updateMainImg0->execute();


                $updateMainImg1 = $yiiApp->db->createCommand("UPDATE product_image SET pdimg_album=1  WHERE pdimg_id=" . $idMainImg[1]);
                $updateMainImg1->execute();

                $productImg = ProductImage::model()->find(array('condition' => "pdimg_album='1' and product_id=$id"));
                $pdimg_name = $productImg->pdimg_name;
            }
            $model->product_image = $pdimg_name;
            $model->product_update = date('Y-m-d H:i:s');
            if ($model->save()) {

                $lastId = $id;
                $pathName = $yiiApp->lnwupload->getFolder();
                $pathReal = $yiiApp->lnwupload->realPath() . '/tmp';
                if (isset($product_image['img'])) {
                    $countImg = count($product_image['img']);
                    for ($i = 1; $i <= $countImg; $i++) {
                        $vimgs = $product_image['img'][$i];
                        $mainImg = $product_image['main_img'];
                        $modelPdImg = new ProductImage;
                        if ($vimgs != "") {
                            $yiiApp->lnwupload->resizeRealImg('resizeBig', $pathReal . '/' . $vimgs, $pathName . '/larges/', $vimgs, 740, 740, 100);
                            $yiiApp->lnwupload->resizeRealImg('resize', $pathReal . '/' . $vimgs, $pathName . '/mediums/', $vimgs, 340, 340, 100);
                            $yiiApp->lnwupload->resizeRealImg('resize', $pathReal . '/' . $vimgs, $pathName . '/thumbs/', $vimgs, 180, 180, 100);
                            unlink('tmp/' . $vimgs);
                            $insertImg = $vimgs;
                            $modelPdImg->setIsNewRecord(true);
                            if ($mainImg == $i) {
                                $modelPdImg->pdimg_album = 1;
                                $updateMainImg0 = $yiiApp->db->createCommand("UPDATE product_image SET pdimg_album=0  WHERE product_id=" . $id);
                                $updateMainImg0->execute();

                                $updateProductImg = $yiiApp->db->createCommand("UPDATE product SET product_image='" . $insertImg . "' WHERE product_id=" . $id);
                                $updateProductImg->execute();
                            }
                            $modelPdImg->product_id = $lastId;
                            $modelPdImg->pdimg_name = $insertImg;
                            $modelPdImg->save();
                        }
                    }
                }

                if (!empty($_POST['Product']['product_old_tag']) || !empty($_POST['Product']['product_tag'])) {
                    $tagName = $_POST['Product']['product_tag'];
                    $tagNameOld = $_POST['Product']['product_old_tag'];
                    //ค้นหา tag ว่างหรือไม่ว่างใน product_tag_count
                    $tagNameArr = explode(',', $tagName);
                    $tagNameOldArr = explode(',', $tagNameOld);
                    //เอาแท็กเก่าตรวจสอบก่อนหาว่าถูกลบทิ้งหรือป่าว
                    if (!empty($tagNameOld)) {

                        foreach ($tagNameOldArr As $kTagNameOld => $vTagNameOld) {
                            if (!in_array($vTagNameOld, $tagNameArr)) {//ไม่มีในtagให้ลบ1
                                $modelTag = new ProductTag;
                                $modelTagCount = new ProductTagCount;
                                $modelTagId = $modelTag->model()->find(array('condition' => "tag_name='$vTagNameOld' AND product_id=$lastId", 'select' => 'tag_name,tag_id'));
                                if (!empty($modelTagId->tag_name)) {
                                    $chkTagCount = $modelTagCount->model()->find(array('condition' => "tag_name='$vTagNameOld' ", 'select' => 'tag_name,tagcount_id'));
                                    $modelTagCountId = $modelTagCount->model()->findByPk($chkTagCount->tagcount_id);
                                    $modelTagCountId->tagcount_sum = $modelTagCountId->tagcount_sum - 1;
                                    $modelTagCountId->save();
                                    $modelTag->model()->findByPk($modelTagId->tag_id)->delete();
                                }
                            }
                        }
                    }

                    if (!empty($tagName)) {
                        foreach ($tagNameArr As $kTagName => $vTagName) {
                            if (!empty($vTagName)) {
                                $vTagName = trim($vTagName);
                                if (!in_array($vTagName, $tagNameOldArr)) {
                                    $modelTagCount = new ProductTagCount;
                                    $chkTagCount = $modelTagCount->model()->find(array('condition' => "tag_name='$vTagName' ", 'select' => 'tag_name,tagcount_id'));
                                    if (empty($chkTagCount->tag_name)) {//เพิ่ม Tag
                                        $modelTagCount->tag_name = $vTagName;
                                        $modelTagCount->save();
                                    } else {//Update Tag
                                        $modelTagId = $modelTagCount->model()->findByPk($chkTagCount->tagcount_id);
                                        $modelTagId->tagcount_sum = $modelTagId->tagcount_sum + 1;
                                        $modelTagId->save();
                                    }
                                    $modelTag = new ProductTag;
                                    $modelTag->product_id = $lastId;
                                    $modelTag->tag_name = $vTagName;
                                    $modelTag->save();
                                }
                            }
                        }
                    }
                    $modelTagCount = new ProductTagCount;
                    $modelTagCount->model()->deleteAll('tagcount_sum<1');
                }

                $this->redirect(array('admin'));
                exit();
            }
        }

        $modelImage = Yii::app()->db->createCommand()->select('*')->from('product_image')->where('product_id=:id', array(':id' => $id))->queryAll();
        $this->render('update', array(
            'model' => $model, 'modelImage' => $modelImage,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->setScenario('delete');
        $modelProductImage = new ProductImage;
        $tags = $model->product_tag;


        if (!empty($tags)) {
            $modelTags = new ProductTag;
            $modelTagCount = new ProductTagCount;
            $tagArr = explode(',', $tags);
            foreach ((array) $tagArr as $vTags) {
                $modelTags->model()->deleteAll("product_id=$id");
                $chkTagCount = $modelTagCount->model()->find(array('condition' => "tag_name='$vTags' ", 'select' => 'tag_name,tagcount_id'));
                $modelTagId = $modelTagCount->model()->findByPk($chkTagCount->tagcount_id);
                $modelTagId->tagcount_sum = $modelTagId->tagcount_sum - 1;
                $modelTagId->save();
            }

            $modelTagCount->model()->deleteAll('tagcount_sum<1');
        }

        $modelPI = $modelProductImage->findAll(array('select' => 'pdimg_name', 'condition' => 'product_id=' . $id));

        foreach ((array) $modelPI as $ptImage) {
            if (!empty($ptImage->pdimg_name)) {
                @unlink(Yii::app()->basePath . "/../images/products/thumbs/" . $ptImage->pdimg_name);
                @unlink(Yii::app()->basePath . "/../images/products/larges/" . $ptImage->pdimg_name);
                @unlink(Yii::app()->basePath . "/../images/products/mediums/" . $ptImage->pdimg_name);
            }
        }

        $modelProductImage->deleteAll('product_id=' . $id);
        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        $showCategory = 'สินค้าทั้งหมด';

        $criteria = new CDbCriteria;
        $criteria->with = array('category');
        $criteria->select = "product_active_price,product_id,product_code,product_name,product_amount,product_price,product_image,category.category_name As category_name";

        if (isset($_GET['q'])) {
            $model->q = $_GET['q'];
        }

        if (isset($_GET['catid'])) {
            $modelCategory = Category::model()->findByPk($_GET['catid']);
            $showCategory = $modelCategory->category_name;
            $criteria->addSearchCondition("category.category_id", $modelCategory->category_id, 'true', 'OR');
        }

        $criteria->addSearchCondition("product_name", $model->q, 'true', 'OR');
        $criteria->addSearchCondition("product_code", $model->q, 'true', 'OR');

        $dataProvider = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => 12),
                ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'showCategory' => $showCategory
        ));
    }

    public function actionAdmin() {
        Yii::app()->theme = 'bluewhale-admin';
        $this->titlepage = 'แสดงรายการสินค้า';
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionView($id) {
        $this->layout = '';

        $modelProductImage = ProductImage::model()->findAll(array('condition' => 'product_id=' . $id, 'order' => 'pdimg_album DESC'));
        $model = $this->loadModel($id);
        $modelCategoryName = Category::model()->find(array('condition' => 'category_id=' . $model->category_id, 'select' => 'category_name'));
        $this->render('view', array(
            'model' => $model,
            'modelCategoryName' => $modelCategoryName,
            'modelProductImage' => $modelProductImage
        ));
    }

    public function loadModel($id) {

        $model = Product::model()->with(array('category' => array(
                        'select' => '*')))->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getCategoryOptions() {
        $records = Category::model()->findAll();
        $list = CHtml::listData($records, 'category_id', 'category_name');
        return $list;
    }

}