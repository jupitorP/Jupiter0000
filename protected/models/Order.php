<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $od_id
 * @property string $user_id
 * @property string $user_name
 * @property string $user_address
 * @property string $user_tel
 * @property string $od_status
 * @property string $od_date
 */
class Order extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'length', 'max' => 50),
            array('user_name', 'length', 'max' => 100),
            array('user_tel', 'length', 'max' => 25),
            array('od_status', 'length', 'max' => 1),
            array('user_address, od_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('od_id, user_id, user_name, user_address, user_tel, od_status, od_date', 'safe', 'on' => 'search'),
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
            'od_id' => 'รหัสใบสั่งซื้อ',
            'user_id' => 'User',
            'user_name' => 'ชื่อ-นามสกุล',
            'user_address' => 'ที่อยู่จัดส่งสินค้า',
            'user_tel' => 'เบอร์โทรติดต่อ',
            'od_status' => 'สถานะการสั่งซื้อ',
            'od_date' => 'วันที่สั่งซื้อ',
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

        $criteria->compare('od_id', $this->od_id);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_address', $this->user_address, true);
        $criteria->compare('user_tel', $this->user_tel, true);
        $criteria->compare('od_status', $this->od_status, true);
        $criteria->compare('od_date', $this->od_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}