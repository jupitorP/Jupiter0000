<?php
class PayConfirmForm extends CFormModel {
    public $name;
    public $orderId;
    public $mobile;
    public $email;
    public $price;
    public $bankPayment;
    public $timePayment;
    public $note;
    public $verifyCode;
    
    public function rules() {
        return array(
            array('name, mobile, price, bankPayment, timePayment, verifyCode', 'required'),
            array('email', 'email'),
            array('price', 'numerical', 'integerOnly'=>true, 'min'=>5),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
            array('name, orderId, mobile, email, price, bankPayment, timePayment, note, verifyCode', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'name' => 'ชื่อ-นามสกุล',
            'orderId' => 'หมายเลขสั่งซื้อ',
            'mobile' => 'เบอร์โทร',
            'email' => 'อีเมล',
            'price' => 'จำนวนเงิน',
            'bankPayment' => 'ธนาคารที่โอนเงิน',
            'timePayment' => 'วันที่โอนเงิน',
            'note' => 'หมายเหตุ',
            'verifyCode' => 'รหัสยืนยัน',
        );
    }
}