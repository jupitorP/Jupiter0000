<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $category_id
 * @property string $category_name
 */
class Category extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     * 
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name', 'required'),
            array('category_name,category_code', 'length', 'max' => 100),
            array('creation_time,update_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'create'),
            array('update_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'update'),
            array('creation_time', 'unsafe', 'on' => 'update'),            
            array('category_id,category_name,category_code,creation_time,update_time,is_active,sort_order,note', 'safe'),
            array('category_id,category_name,category_code,creation_time,update_time,is_active,sort_order,note', 'safe', 'on' => 'search'),
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
            'category_id' => 'category_id',
            'category_name' => 'ชื่อหมวดสินค้า',
            'category_code' => 'รหัสหมวดสินค้า',
            'creation_time' => 'วันที่เพิ่มข้อมูล',
            'update_time' => 'วันที่ปรับปรุงข้อมูล',
            'is_active' => 'อนุญาต',
            'sort_order' => 'จัดเรียง',
            'note' => 'หมายเหตุ',
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
        $criteria->compare('category_name', $this->category_name, true);
        $criteria->compare('category_code', $this->category_code, true);
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'attributes' => array(
                            'category_code',
                            'category_name',
                            'creation_time',
                            'update_time',
                            'is_active',
                        ),
                    ),
                ));
    }
}