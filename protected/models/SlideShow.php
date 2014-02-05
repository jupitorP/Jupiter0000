<?php

/**
 * This is the model class for table "slide_show".
 *
 * The followings are the available columns in table 'slide_show':
 * @property integer $slide_show_id
 * @property string $slide_show_path
 */
class SlideShow extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SlideShow the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'slide_show';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('slide_show_path', 'required'),
            array('slide_show_path', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('slide_show_id, slide_show_path', 'safe', 'on' => 'search'),
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
            'slide_show_id' => 'Slide Show',
            'slide_show_path' => 'Slide Show Path',
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

        $criteria->compare('slide_show_id', $this->slide_show_id);
        $criteria->compare('slide_show_path', $this->slide_show_path, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
}