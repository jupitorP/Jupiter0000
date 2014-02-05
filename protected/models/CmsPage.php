<?php

/**
 * This is the model class for table "cms_page".
 *
 * The followings are the available columns in table 'cms_page':
 * @property integer $page_id
 * @property string $title
 * @property string $identifier
 * @property string $page_content
 * @property string $creation_time
 * @property string $update_time
 * @property integer $is_active
 * @property integer $sort_order
 * @property string $note 
 */
class CmsPage extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CmsPage the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cms_page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, identifier', 'required'),
            array('is_active, sort_order', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('identifier', 'length', 'max' => 100),
            array('creation_time,update_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'create'),
            array('update_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'update'),
            array('page_content, creation_time, update_time, note', 'safe'),
            array('sort_order, creation_time', 'unsafe', 'on' => 'update'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('page_id, title, identifier, page_content, creation_time, update_time, is_active, sort_order,note', 'safe', 'on' => 'search'),
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
            'page_id' => 'Page',
            'title' => 'หัวข้อ',
            'identifier' => 'Identifier',
            'page_content' => 'รายละเอียด',
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

        $criteria->compare('page_id', $this->page_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('identifier', $this->identifier, true);
        $criteria->compare('page_content', $this->page_content, true);
        $criteria->compare('creation_time', $this->creation_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('note', $this->note);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'attributes' => array(
                            'title',
                            'identifier',
                            'creation_time',
                            'update_time',
                            'is_active',
                        ),
                    ),
                ));
    }
}