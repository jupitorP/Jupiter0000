<?php

/**
 * This is the model class for table "product_tag".
 *
 * The followings are the available columns in table 'product_tag':
 * @property integer $tag_id
 * @property integer $product_id
 * @property string $tag_name
 */
class ProductTag extends CActiveRecord {

    public $product_image;
    public $product_name;
    public $product_code;
    public $product_price;
    public $product_amount;
    public $product_active_price;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductTag the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product_tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id', 'numerical', 'integerOnly' => true),
            array('tag_name', 'length', 'max' => 150),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('product_active_price, tag_id, product_id, tag_name', 'safe'),
            array('tag_id, product_id, tag_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'tag_id' => 'Tag',
            'product_id' => 'Product',
            'tag_name' => 'Tag Name',
            'product_code' => 'Code',
            'product_price' => 'ราคา',
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

        $criteria->compare('tag_id', $this->tag_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('tag_name', $this->tag_name, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}