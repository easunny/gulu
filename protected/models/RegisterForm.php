<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $email;
	public $password;
	public $repassword;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
		array('email, password, repassword', 'required','message'=>'{attribute}不能为空'),
		// password needs to be authenticated
		array('email', 'email','message'=>'邮箱格式错误'),
		array('email', 'checkEmail'),
		array('password', 'checkpassword'),
		array('repassword', 'checkRepassword'),
			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'邮箱',
			'password'=>'密码',
			'repassword'=>'重复密码',
		);
	}

	/*
	 * 校验yemail是否已经被注册
	 */
	public function checkEmail($attribute,$params)
	{
		/*		if(!$this->hasErrors())
		 {
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
			$this->addError('password','Incorrect username or password.');
			}*/
	}


	/*
	 * 密码是否合法
	 */

	public function checkPassword($attribute,$params)
	{
		$length = strlen($this->password);
		if ($length<6) {
			$this->addError('password','密码需要大于6位');
		}elseif ($length>18){
			$this->addError('password','密码不能大于18位');
		}
	}

	/*
	 * 两次密码输入是否一样
	 */
	public function checkRepassword($attribute,$params)
	{
		if($this->password!=$this->repassword){
			$this->addError('repassword','两次密码输入不一致');
		}
	}
}
