<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property string $news_topic
 * @property string $news_detail
 * @property string $news_date
 * @property string $news_update
 * @property integer $news_active
 * @property string $news_file
 * @property string $news_image
 */
class News extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
     */
    
    public $del_news_image;
    public $del_news_file;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('news_topic', 'required', 'on' => 'create'),
            array('news_topic', 'required', 'on' => 'update'),
            array('news_topic', 'length', 'max' => 200),
            array('news_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 0.5, 'allowEmpty' => true, 'on' => 'create'),
            array('news_file', 'file', 'maxSize' => 1024 * 1024 * 1, 'allowEmpty' => true, 'on' => 'create'),
            array('news_image', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 0.5, 'allowEmpty' => true, 'on' => 'update'),
            array('news_file', 'file', 'maxSize' => 1024 * 1024 * 1, 'allowEmpty' => true, 'on' => 'update'),
            array('news_active', 'numerical', 'integerOnly' => true),
            array('news_detail, news_date, news_update,del_news_image, del_news_file', 'safe'),
            array('news_id, news_topic, news_detail, news_date, news_update, news_active, news_file, news_image,del_news_image, del_news_file', 'safe', 'on' => 'search'),
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
            'news_topic' => 'หัวข้อข่าว',
            'news_detail' => 'รายละเอียด',
            'news_date' => 'ข่าววันที่',
            'news_update' => 'วันที่ปรับปรุง',
            'news_active' => 'แสดง',
            'news_image' => 'ภาพประกอบ',
            'news_file' => 'ไฟล์เอกสาร',
            'del_news_image' => 'ลบรูปภาพ',
            'del_news_file' => 'ลบไฟล์เอกสาร',
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

        $criteria->compare('news_id', $this->news_id);
        $criteria->compare('news_topic', $this->news_topic, true);
        $criteria->compare('news_detail', $this->news_detail, true);
        $criteria->compare('news_date', $this->news_date, true);
        $criteria->compare('news_update', $this->news_update, true);
        $criteria->compare('news_active', $this->news_active);
        $criteria->compare('news_file', $this->news_file, true);
        $criteria->compare('news_image', $this->news_image, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    protected function afterFind() {
        if (!empty($this->news_date)) {
            list($da, $ti) = explode(' ', $this->news_date);
            list($y, $m, $d) = explode('-', $da);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->news_date = date('d-m-Y', $mk);
        }
        
        if (!empty($this->news_update)) {
            list($da, $ti) = explode(' ', $this->news_update);
            list($y, $m, $d) = explode('-', $da);
            list($h, $i, $s) = explode(':', $ti);
            $mk = mktime($h, $i, $s, $m, $d, $y);
            $this->news_update = date('d-m-Y H:i:s', $mk);
        }

        return parent::afterFind();
    }

    protected function beforeSave() {
         if (!empty($this->news_date)) {
            list($d, $m, $y) = explode('-', $this->news_date);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->news_date = date('Y-m-d', $mk);
        }
        
        $this->news_update = new CDbExpression('NOW()');
        
        return parent::beforeSave();
    }

}