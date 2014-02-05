<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $user_firstname
 * @property string $user_lastname
 * @property string $user_birthday
 * @property string $user_mobile
 * @property string $user_tel
 * @property string $user_email
 * @property string $user_address
 * @property integer $sex_id
 * @property integer $province_id
 * @property string $user_image
 * @property string $user_file
 * @property integer $user_active
 * @property string $start_date
 * @property string $user_update
 * @property string $user_comment
 * @property string $rules
 */
class Register extends CActiveRecord {

    public $repeat_password;
    public $old_password;
    public $old_start_date;
    public $del_user_image;
    public $del_user_file;
    public $temp_password;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Register the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, user_firstname, user_mobile, user_lastname, user_birthday, sex_id, user_email', 'required', 'on' => 'create'),
            array('username, user_firstname, user_mobile, user_lastname, user_birthday, sex_id, user_email', 'required', 'on' => 'editprofile'),
            array('password,repeat_password', 'required', 'on' => 'create'),
            array('password,repeat_password,old_password', 'required', 'on' => 'editpassword'),
            array('old_password', 'equalPasswords', 'on' => 'editprofile'),
            array('old_password', 'equalPasswords', 'on' => 'editpassword'),
            array('username, password, repeat_password,old_password', 'length', 'min' => 6, 'max' => 20),
            array('repeat_password', 'compare', 'compareAttribute' => 'password'),
            array('username, password', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => 'ข้อมูลต้องเป็นตัวอักษรหรือตัวเลขเท่านั้น'),
            array('username, password, user_email', 'filter', 'filter' => 'trim'),
            array('username,user_email', 'unique', 'className' => 'User', 'message' => '{attribute} "{value}" มีอยู่ในระบบแล้ว'),
            array('user_email', 'length', 'max' => 50),
            array('user_email', 'email'),
            array('user_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 0.5, 'allowEmpty' => true, 'on' => 'create'),
            array('user_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 0.5, 'allowEmpty' => true, 'on' => 'editprofile'),
            array('user_file', 'file', 'maxSize' => 1024 * 1024 * 1, 'allowEmpty' => true, 'on' => 'create'),
            array('user_file', 'file', 'maxSize' => 1024 * 1024 * 1, 'allowEmpty' => true, 'on' => 'editprofile'),
            array('password,repeat_password', 'required', 'on' => 'create'),
            array('sex_id,province_id, user_active,rules', 'numerical'),
            array('user_mobile, user_tel', 'length', 'max' => 50),
            array('user_comment', 'length', 'max' => 400),
            array('user_address', 'length', 'max' => 400),
            array('rules', 'length', 'max' => 1),
            array('start_date,user_update', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'create'),
            array('user_birthday, user_address, start_date, user_update, user_comment,del_user_image, del_user_file', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, user_firstname, user_lastname, user_birthday, user_mobile, user_tel, user_email, user_address, sex_id, province_id, user_image, user_file, user_active, start_date, user_update, user_comment, rules', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'username' => 'ชื่อเข้าระบบ',
            'password' => 'รหัสผ่าน',
            'repeat_password' => 'ยืนยันรหัสผ่าน',
            'old_password' => 'รหัสผ่านเดิม',
            'user_firstname' => 'ชื่อ',
            'user_lastname' => 'นามสกุล',
            'user_birthday' => 'วันเดือนปี เกิด',
            'user_mobile' => 'โทรศัพท์มือถือ',
            'user_tel' => 'โทรศัพท์',
            'user_email' => 'อีเมล',
            'user_address' => 'ที่อยู่',
            'sex_id' => 'เพศ',
            'province_id' => 'จังหวัด',
            'user_image' => 'รูปประจำตัว',
            'user_file' => 'ไฟล์เอกสาร',
            'user_active' => 'อนุญาตให้เข้าระบบ',
            'start_date' => 'วันที่เริ่มเป็นสมาชิก',
            'user_update' => 'วันที่ปรับปรุงข้อมูลล่าสุด',
            'user_comment' => 'หมายเหตุ',
            'del_user_image' => 'ลบรูปประจำตัว',
            'del_user_file' => 'ลบไฟล์เอกสาร',
            'rules' => 'ประเภทสมาชิก',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('user_firstname', $this->user_firstname, true);
        $criteria->compare('user_lastname', $this->user_lastname, true);
        $criteria->compare('user_birthday', $this->user_birthday, true);
        $criteria->compare('user_mobile', $this->user_mobile, true);
        $criteria->compare('user_tel', $this->user_tel, true);
        $criteria->compare('user_email', $this->user_email, true);
        $criteria->compare('user_address', $this->user_address, true);
        $criteria->compare('sex_id', $this->sex_id);
        $criteria->compare('province_id', $this->province_id);
        $criteria->compare('user_image', $this->user_image, true);
        $criteria->compare('user_file', $this->user_file, true);
        $criteria->compare('user_active', $this->user_active);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('user_update', $this->user_update, true);
        $criteria->compare('user_comment', $this->user_comment, true);
        $criteria->compare('rules', $this->rules, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    protected function afterFind() {
        $this->temp_password = $this->password;
        $this->old_start_date = $this->start_date;

        if (!empty($this->user_birthday)) {
            list($y, $m, $d) = explode('-', $this->user_birthday);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->user_birthday = date('d-m-Y', $mk);
        }

        if (!empty($this->start_date)) {
            list($da, $ti) = explode(' ', $this->start_date);
            list($y, $m, $d) = explode('-', $da);
            list($h, $i, $s) = explode(':', $ti);
            $mk = mktime($h, $i, $s, $m, $d, $y);
            $this->start_date = date('d-m-Y H:i:s', $mk);
        }

        if (!empty($this->user_update)) {
            list($da, $ti) = explode(' ', $this->user_update);
            list($y, $m, $d) = explode('-', $da);
            list($h, $i, $s) = explode(':', $ti);
            $mk = mktime($h, $i, $s, $m, $d, $y);
            $this->user_update = date('d-m-Y H:i:s', $mk);
        }

        return parent::afterFind();
    }

    protected function beforeSave() {
        if (!empty($this->user_birthday)) {
            list($d, $m, $y) = explode('-', $this->user_birthday);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->user_birthday = date('Y-m-d', $mk);
        }

        if ($this->isNewRecord) {// <---- the difference
            $this->password = User::hashPassword($this->password);
        }

        if (!($this->isNewRecord)) {
            if (!empty($this->password)) {
                $this->password = User::hashPassword($this->password);
            } else {
                $this->password = $this->temp_password;
            }

            $this->start_date = $this->old_start_date;
            $this->user_update = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    public function equalPasswords($attribute, $params) {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!empty($this->old_password)) {
            if ($user->password != User::hashPassword($this->old_password)) {
                $this->addError($attribute, 'รหัสผ่านเดิมไม่ถูกต้อง');
            }
        }
    }

}