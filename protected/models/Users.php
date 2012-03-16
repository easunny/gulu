<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $uid
 * @property string $nick
 * @property string $email
 * @property string $password
 * @property integer $updateTime
 * @property integer $lastTime
 * @property string $lastIp
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('nick, email, password, updateTime, lastTime, lastIp', 'required'),
		array('updateTime, lastTime', 'numerical', 'integerOnly'=>true),
		array('nick', 'length', 'max'=>60),
		array('email', 'length', 'max'=>255),
		array('password', 'length', 'max'=>32),
		array('lastIp', 'length', 'max'=>40),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('uid, nick, email, password, updateTime, lastTime, lastIp', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'nick' => 'Nick',
			'email' => 'Email',
			'password' => 'Password',
			'updateTime' => 'Update Time',
			'lastTime' => 'Last Time',
			'lastIp' => 'Last Ip',
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

		$criteria->compare('uid',$this->uid);
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('updateTime',$this->updateTime);
		$criteria->compare('lastTime',$this->lastTime);
		$criteria->compare('lastIp',$this->lastIp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}