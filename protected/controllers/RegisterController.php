<?php

class RegisterController extends Controller
{
	public function actionIndex()
	{
		$success = false;
		$model=new RegisterForm;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form-register-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		if(isset($_POST['RegisterForm']))
		{

			$model->attributes=$_POST['RegisterForm'];
			if($model->validate())
			{
				//注册信息
				$data['email']=$model->email;
				$data['time']=time();
				$data['ip']='ip';
				$data['password']=md5(md5($model->password).$data['time']);
				//保存到表中，email验证成功后添加到
				$register = new Register;
				$register->email = $model->email;
				$register->timestamp =time();
				$register->rand = md5(rand());
				$register->data = json_encode($data);
				$register->save();
				$mailer = Yii::app()->mailer;
				$mailer->AddAddress($model->email);
				$mailer->Subject = 'GULU.ME(咕噜工坊)注册-邮箱认证';
				$mailer->Body = $register->rand;
				if($mailer->Send()){
					$success = true;
				}
			}
		}
		$this->render('index',array('model'=>$model,'success'=>$success));
	}

	public function actionEmail()
	{
		$error = false;
		//是否有参数
		if(!isset($_GET['id'])||!isset($_GET['rand'])){
			$error = '链接错误';
		}
		//密钥是否有效
		if(!$error){
			$register = Register::model()->findByAttributes($_GET['id']);
			if(!$register || $register->del == 1){
				$error = '链接已失效';
			}elseif((time()-$register->timestamp)<3600*48){
				$error = '链接已失效';
			}elseif($register->rand != $_GET['rand']){
				$error = '链接验证失败';
			}
		}
		//邮箱是否被注册
		if(!$error){
			$user = Users::model()->findByAttributes(array('email'=>$register->email));
			if($user){
				$error = '链接已失效';
			}
		}
		$model=new RegisterNickForm;
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-nick-form-email-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/

		if(!$error && isset($_POST['RegisterNickForm']))
		{
			$model->attributes=$_POST['RegisterNickForm'];
			if($model->validate())
			{
				//删除邮件纪录
				$register->del = 1;
				$register->save();
				//添加新用户
				$user = new Users;
				$data = json_decode($register->data);
				$user->email = $register->email;
				$user->nick = $model->nick;
				$user->password = $data['password'];
				$user->updateTime = $data['time'];
				$user->lastTime = time();
				$user->lastIp = Functions::getIp();
				$user->save();
				Yii::app()->user->login($user->uid);
				return;
			}
		}
		$this->render('email',array('model'=>$model,'error'=>$error));
	}

	protected  function binding() {
		$oauthType = Yii::app()->user->_register_oauthType;
		if('sina' == $oauthType){
			;
		}elseif ('qq' == $oauthType){
			;
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
	// return the filter configuration for this controller, e.g.:
	return array(
	'inlineFilterName',
	array(
	'class'=>'path.to.FilterClass',
	'propertyName'=>'propertyValue',
	),
	);
	}

	public function actions()
	{
	// return external action classes, e.g.:
	return array(
	'action1'=>'path.to.ActionClass',
	'action2'=>array(
	'class'=>'path.to.AnotherActionClass',
	'propertyName'=>'propertyValue',
	),
	);
	}
	*/
}