<?php

/**
 * This is the model class for table "bank".
 *
 * The followings are the available columns in table 'bank':
 * @property integer $bank_id
 * @property string $bank_name
 * @property string $bank_number
 * @property string $creation_time
 * @property string $update_time
 * @property integer $is_active
 * @property integer $sort_order
 * @property string $note
 */
class Bank extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bank the static model class
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
		return 'bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bank_name', 'required'),
			array('is_active, sort_order', 'numerical', 'integerOnly'=>true),
			array('bank_name, bank_number, note', 'length', 'max'=>100),
			array('creation_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bank_id, bank_name, bank_number, creation_time, update_time, is_active, sort_order, note', 'safe', 'on'=>'search'),
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
			'bank_id' => 'Bank',
			'bank_name' => 'Bank Name',
			'bank_number' => 'Bank Number',
			'creation_time' => 'Creation Time',
			'update_time' => 'Update Time',
			'is_active' => 'Is Active',
			'sort_order' => 'Sort Order',
			'note' => 'Note',
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

		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_number',$this->bank_number,true);
		$criteria->compare('creation_time',$this->creation_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}