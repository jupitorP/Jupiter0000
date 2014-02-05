<?php
class ContactForm extends CFormModel {
    public $name;
    public $tel;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    
    public function rules() {
        return array(
            array('name, subject, body, verifyCode', 'required'),
            array('email', 'email'),
            array('name, tel, email, subject, body, verifyCode', 'safe'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    public function attributeLabels() {
        return array(
            'name' => 'ชื่อ-นามสกุล',
            'tel' => 'เบอร์โทร',
            'email' => 'อีเมล',
            'subject' => 'หัวข้อ',
            'body' => 'รายละเอียด',
            'verifyCode' => 'รหัสยืนยัน',
        );
    }
}