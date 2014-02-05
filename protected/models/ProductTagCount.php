<?php

/**
 * This is the model class for table "product_tag_count".
 *
 * The followings are the available columns in table 'product_tag_count':
 * @property integer $tagcount_id
 * @property string $tag_name
 * @property integer $tagcount_sum
 */
class ProductTagCount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductTagCount the static model class
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
		return 'product_tag_count';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tagcount_sum', 'numerical', 'integerOnly'=>true),
			array('tag_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tagcount_id, tag_name, tagcount_sum', 'safe', 'on'=>'search'),
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
			'tagcount_id' => 'Tagcount',
			'tag_name' => 'Tag Name',
			'tagcount_sum' => 'Tagcount Sum',
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

		$criteria->compare('tagcount_id',$this->tagcount_id);
		$criteria->compare('tag_name',$this->tag_name,true);
		$criteria->compare('tagcount_sum',$this->tagcount_sum);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}