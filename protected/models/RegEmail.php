<?php

/**
 * This is the model class for table "reg_email".
 *
 * The followings are the available columns in table 'reg_email':
 * @property integer $id
 * @property string $email
 * @property string $rand
 * @property string $data
 * @property integer $timestamp
 * @property integer $del
 */
class RegEmail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RegEmail the static model class
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
		return 'reg_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, rand, timestamp', 'required'),
			array('timestamp, del', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>255),
			array('rand', 'length', 'max'=>32),
			array('data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, rand, data, timestamp, del', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'email' => 'Email',
			'rand' => 'Rand',
			'data' => 'Data',
			'timestamp' => 'Timestamp',
			'del' => 'Del',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('rand',$this->rand,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('del',$this->del);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}