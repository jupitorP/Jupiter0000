<?php

/**
 * This is the model class for table "vdo_clip".
 *
 * The followings are the available columns in table 'vdo_clip':
 * @property integer $vdo_clip_id
 * @property string $vdo_clip_topic
 * @property string $vdo_clip_detail
 * @property string $vdo_clip_url
 * @property string $vdo_clip_date
 * @property string $vdo_clip_update
 * @property integer $vdo_clip_active
 */
class VdoClip extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VdoClip the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vdo_clip';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vdo_clip_topic', 'required', 'on' => 'create'),
            //array('vdo_clip_topic', 'required', 'on' => 'update'),
            array('vdo_clip_active', 'numerical', 'integerOnly' => true),
            array('vdo_clip_topic, vdo_clip_url', 'length', 'max' => 200),
            array('vdo_clip_detail, vdo_clip_date, vdo_clip_update', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('vdo_clip_id, vdo_clip_topic, vdo_clip_detail, vdo_clip_url, vdo_clip_date, vdo_clip_update, vdo_clip_active', 'safe', 'on' => 'search'),
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
            'vdo_clip_id' => 'Vdo Clip',
            'vdo_clip_topic' => 'ชื่อวิดีโอคลิป',
            'vdo_clip_detail' => 'รายละเอียด',
            'vdo_clip_url' => 'Url',
            'vdo_clip_date' => 'วันที่',
            'vdo_clip_update' => 'วันที่ปรับปรุง',
            'vdo_clip_active' => 'แสดง',
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

        $criteria->compare('vdo_clip_id', $this->vdo_clip_id);
        $criteria->compare('vdo_clip_topic', $this->vdo_clip_topic, true);
        $criteria->compare('vdo_clip_detail', $this->vdo_clip_detail, true);
        $criteria->compare('vdo_clip_url', $this->vdo_clip_url, true);
        $criteria->compare('vdo_clip_date', $this->vdo_clip_date, true);
        $criteria->compare('vdo_clip_update', $this->vdo_clip_update, true);
        $criteria->compare('vdo_clip_active', $this->vdo_clip_active);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
     protected function afterFind() {
        if (!empty($this->vdo_clip_date)) {
            list($da, $ti) = explode(' ', $this->vdo_clip_date);
            list($y, $m, $d) = explode('-', $da);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->vdo_clip_date = date('d-m-Y', $mk);
        }
        
        if (!empty($this->vdo_clip_update)) {
            list($da, $ti) = explode(' ', $this->vdo_clip_update);
            list($y, $m, $d) = explode('-', $da);
            list($h, $i, $s) = explode(':', $ti);
            $mk = mktime($h, $i, $s, $m, $d, $y);
            $this->vdo_clip_update = date('d-m-Y H:i:s', $mk);
        }

        return parent::afterFind();
    }

    protected function beforeSave() {
         if (!empty($this->vdo_clip_date)) {
            list($d, $m, $y) = explode('-', $this->vdo_clip_date);
            $mk = mktime(0, 0, 0, $m, $d, $y);
            $this->vdo_clip_date = date('Y-m-d', $mk);
        }
        
        $this->vdo_clip_update = new CDbExpression('NOW()');
        
        return parent::beforeSave();
    }

}