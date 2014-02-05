<?php

/**
 * This is the model class for table "product_image".
 *
 * The followings are the available columns in table 'product_image':
 * @property integer $pdimg_id
 * @property integer $product_id
 * @property string $pdimg_name
 * @property string $pdimg_album
 */
class ProductImage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id', 'numerical', 'integerOnly'=>true),
			array('pdimg_name', 'length', 'max'=>100),
			array('pdimg_album', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pdimg_id, product_id, pdimg_name, pdimg_album', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pdimg_id' => 'Pdimg',
			'product_id' => 'Product',
			'pdimg_name' => 'Pdimg Name',
			'pdimg_album' => 'Pdimg Album',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pdimg_id',$this->pdimg_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('pdimg_name',$this->pdimg_name,true);
		$criteria->compare('pdimg_album',$this->pdimg_album,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}