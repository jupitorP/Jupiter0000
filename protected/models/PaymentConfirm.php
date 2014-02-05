<?php

/**
 * This is the model class for table "payment_confirm".
 *
 * The followings are the available columns in table 'payment_confirm':
 * @property integer $payment_confirm_id
 * @property string $firstname
 * @property string $lastname
 * @property string $tel
 * @property string $email
 * @property string $order_number
 * @property double $price
 * @property string $payment_confirm_time
 * @property string $payment_confirm_file
 * @property integer $bank_id
 * @property string $note
 * @property integer $is_confirm
 * @property string $creation_time
 * @property string $update_time
 */
class PaymentConfirm extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PaymentConfirm the static model class
     */
    
    public $verifyCode;
    public $del_payment_confirm_file;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'payment_confirm';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('firstname,tel,price,bank_id,payment_confirm_time', 'required'),
            array('verifyCode', 'required','on'=>'index'),
            array('bank_id, is_confirm', 'numerical', 'integerOnly' => true),
            array('price', 'numerical'),
            array('firstname, lastname', 'length', 'max' => 100),
            array('tel, email', 'length', 'max' => 50),
            array('order_number', 'length', 'max' => 100),
            array('note', 'length', 'max' => 500),
            array('payment_confirm_file', 'file', 'maxSize' => 1024 * 1024 * 1, 'allowEmpty' => true, 'on' => 'create,update,index'),
            array('creation_time,update_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'create,index'),
            array('update_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'update'),
            array('payment_confirm_id, firstname, lastname, tel, email, order_number, price, payment_confirm_time, payment_confirm_file, bank_id, note, is_confirm, creation_time, update_time,del_payment_confirm_file,verifyCode', 'safe'),
            array('update_time', 'unsafe','on'=>'update'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(),'on'=>'index'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('payment_confirm_id, firstname, lastname, tel, email, order_number, price, payment_confirm_time, payment_confirm_file, bank_id, note, is_confirm, creation_time, update_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'payment_confirm_id' => 'Payment Confirm',
            'firstname' => 'ชื่อ',
            'lastname' => 'นามสกุล',
            'tel' => 'เบอร์โทร',
            'email' => 'อีเมล',
            'order_number' => 'หมายเลขสั่งซื้อ',
            'price' => 'จำนวนเงิน',
            'payment_confirm_time' => 'วันที่โอนเงิน',
            'payment_confirm_file' => 'ไฟล์เอกสาร',
            'bank_id' => 'ธนาคารที่โอนเงิน',
            'note' => 'หมายเหตุ',
            'is_confirm' => 'ยืนยันแล้ว',
            'creation_time' => 'วันที่เพิ่มข้อมูล',
            'update_time' => 'วันที่ปรับปรุงข้อมูล',
            'verifyCode' => 'รหัสยืนยัน',
            'del_payment_confirm_file' => 'ลบไฟล์เอกสาร',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('order_number', $this->order_number, true);
         $criteria->compare('payment_confirm_time', Helpers::dateFormat($this->payment_confirm_time, "format1"), true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    protected function beforeSave() {
        if (!empty($this->payment_confirm_time)) {
            list($d, $m, $y) = explode('-', $this->payment_confirm_time);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->payment_confirm_time = date('Y-m-d', $mk);
        }
        
        $this->update_time = new CDbExpression('NOW()');

        return parent::beforeSave();
    }

}