<?php

/**
 * This is the model class for table "orderview".
 *
 * The followings are the available columns in table 'orderview':
 * @property integer $odv_id
 * @property integer $od_id
 * @property integer $product_id
 * @property string $product_name
 * @property integer $odv_amount
 * @property double $odv_price
 * @property string $odv_more
 */
class Orderview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Orderview the static model class
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
		return 'orderview';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('od_id, product_id, odv_amount', 'numerical', 'integerOnly'=>true),
			array('odv_price', 'numerical'),
			array('product_name', 'length', 'max'=>250),
			array('odv_more', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('odv_id, od_id, product_id, product_name, odv_amount, odv_price, odv_more', 'safe', 'on'=>'search'),
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
			'odv_id' => 'Odv',
			'od_id' => 'Od',
			'product_id' => 'Product',
			'product_name' => 'Product Name',
			'odv_amount' => 'Odv Amount',
			'odv_price' => 'Odv Price',
			'odv_more' => 'Odv More',
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

		$criteria->compare('odv_id',$this->odv_id);
		$criteria->compare('od_id',$this->od_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('odv_amount',$this->odv_amount);
		$criteria->compare('odv_price',$this->odv_price);
		$criteria->compare('odv_more',$this->odv_more,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}