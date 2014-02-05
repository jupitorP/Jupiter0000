<?php

/**
 * This is the model class for table "hello_block".
 *
 * The followings are the available columns in table 'hello_block':
 * @property integer $hello_block_id
 * @property string $hello_block_name
 * @property string $hello_block_detail
 * @property string $hello_block_note
 * @property string $hello_block_date
 * @property string $hello_block_update
 * @property integer $hello_block_active
 */
class HelloBlock extends CActiveRecord {

    public $titleMenuManage;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HelloBlock the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'hello_block';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('hello_block_name, hello_block_detail', 'required', 'on' => 'create,update'),
            array('hello_block_active', 'numerical', 'integerOnly' => true),
            array('hello_block_name', 'length', 'max' => 100),
            array('hello_block_note', 'length', 'max' => 200),
            array('hello_block_detail, hello_block_update', 'safe'),
            array('hello_block_update', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'update'),
            array('hello_block_date', 'unsafe', 'on' => 'update'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('hello_block_id, hello_block_name, hello_block_detail, hello_block_note, hello_block_update, hello_block_active', 'safe', 'on' => 'search'),
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
            'hello_block_id' => 'Hello block id',
            'hello_block_name' => 'หัวข้อ',
            'hello_block_detail' => 'รายละเอียด',
            'hello_block_note' => 'หมายเหตุ',
            'hello_block_date' => 'วันที่เพิ่มข้อมูล',
            'hello_block_update' => 'วันที่แก้ไขข้อมูล',
            'hello_block_active' => 'อนุญาต',
            'titleMenuManage' => 'จัดการ',            
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

        $criteria->compare('hello_block_id', $this->hello_block_id);
        $criteria->compare('hello_block_name', $this->hello_block_name, true);
        $criteria->compare('hello_block_detail', $this->hello_block_detail, true);
        $criteria->compare('hello_block_note', $this->hello_block_note, true);
        $criteria->compare('hello_block_update', $this->hello_block_update, true);
        $criteria->compare('hello_block_active', $this->hello_block_active);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    protected function afterFind() {
        return parent::afterFind();
    }
    
    protected function beforeSave() {
        return parent::beforeSave();
    }

}