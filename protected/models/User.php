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

class User extends CActiveRecord {
    
    public $repeat_password;
    public $old_password;
    public $old_start_date;
    public $del_user_image;
    public $del_user_file;
    public $temp_password;
    public $temp_rules;
    public $rules_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
            array('username, user_firstname, password, repeat_password, rules, user_mobile, user_lastname, user_birthday, sex_id, user_email', 'required', 'on' => 'create'),
            array('username, user_firstname, rules, user_mobile, user_lastname, user_birthday, sex_id, user_email', 'required', 'on' => 'update'),
            array('username, password, repeat_password,old_password', 'length', 'min' => 6, 'max' => 20),
            array('repeat_password', 'compare', 'compareAttribute' => 'password'),
            array('username, password', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => 'ข้อมูลต้องเป็นตัวอักษรหรือตัวเลขเท่านั้น'),
            array('username, password, user_email', 'filter', 'filter' => 'trim'),
            array('username,user_email', 'unique', 'className' => 'User', 'message' => '{attribute} "{value}" มีอยู่ในระบบแล้ว'),
            array('user_email', 'length', 'max' => 50),
            array('user_email', 'email'),
            array('user_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 0.5, 'allowEmpty' => true, 'on' => 'create,update'),
            array('user_file', 'file', 'maxSize' => 1024 * 1024 * 1, 'allowEmpty' => true, 'on' => 'create,update'),
            array('password,repeat_password', 'required', 'on' => 'create'),
            array('sex_id,province_id, user_active,rules', 'numerical'),
            array('user_mobile, user_tel', 'length', 'max' => 50),
            array('user_address', 'length', 'max' => 400),
            array('user_comment', 'length', 'max' => 400),
            array('rules', 'length', 'max' => 1),
            array('start_date,user_update', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'create'),
            array('user_birthday, user_address, start_date, user_update, user_comment,del_user_image, del_user_file', 'safe'),
            array('start_date', 'unsafe', 'on' => 'update'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, user_firstname, user_lastname, user_birthday, user_mobile, user_tel, user_email, user_address, sex_id, province_id, user_image, user_file, user_active, start_date, user_update, rules, rules_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rules' => array(self::BELONGS_TO, 'Rules', 'rules')
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
            'start_date' => 'วันที่สมัคร',
            'user_update' => 'วันที่ปรับปรุง',
            'user_comment' => 'หมายเหตุ',
            'del_user_image' => 'ลบรูปประจำตัว',
            'del_user_file' => 'ลบไฟล์เอกสาร',
            'rules' => 'ประเภทสมาชิก',
            'rules_name' => 'ประเภทสมาชิก',
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
        $criteria->with = array('rules');
        $criteria->select = "id,user_image,username,user_firstname,user_lastname,user_mobile,user_email,start_date,rules.rules_name As rules_name";
        $criteria->compare('id', $this->id);
        $criteria->compare('user_image', $this->user_image, true);
        $criteria->compare('username', $this->username, true);                
        $criteria->compare('user_firstname', $this->user_firstname, true);
        $criteria->compare('user_lastname', $this->user_lastname, true);
        $criteria->compare('user_birthday', Helpers::dateFormat($this->user_birthday, "format1"), true);
        $criteria->compare('sex_id', $this->sex_id, true);
        $criteria->compare('user_mobile', $this->user_mobile, true);
        $criteria->compare('user_tel', $this->user_tel, true);        
        $criteria->compare('user_email', $this->user_email, true);        
        $criteria->compare('province_id', $this->province_id, true);
        $criteria->compare('start_date', Helpers::dateFormat($this->start_date, "format1"), true);
        $criteria->compare('user_update', Helpers::dateFormat($this->user_update, "format1"), true);
        $criteria->compare('rules.rules', $this->rules, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                    'sort' => array(
                        'attributes' => array(
                            'username' ,
                            'user_firstname',
                            'user_lastname',
                            'user_mobile',
                            'user_email',
                            'start_date',
                            'rules_name' => array(
                                'asc' => 'rules.rules_name',
                                'desc' => 'rules.rules_name DESC',
                            )                            
                        ),
                    ),
                ));
    }
    
    protected function afterFind() {
        $this->temp_password = $this->password;
        $this->temp_rules = $this->rules;

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
            
            $this->user_update = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    public function validatePassword($password) {
        return $this->hashPassword($password) === $this->password;
    }

    public function hashPassword($phrase, $salt = null) {
        $key = 'Gf;B&yXL|beJUf-K*PPiU{wf|@9K9j5?d+YW}?VAZOS%e2c -:11ii<}ZM?PO!96';
        if ($salt == '') {
            $hasSha512 = hash('md5', $key);
            $salt = substr($hasSha512, 0, 10);
        } else {
            $salt = substr($salt, 0, 10);
        }
        return hash('md5', $salt . $key . $phrase);
    }

}