<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterNickForm extends CFormModel
{
	public $nick;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
		array('nick', 'required','message'=>'{attribute}不能为空'),
		array('nick', 'checkNick'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'nick'=>'昵称',
		);
	}


	/*
	 * 校验昵称是否合法
	 * 校验昵称是否已经被注册
	 */
	public function checkNick($attribute,$params)
	{

	}
}
