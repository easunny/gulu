<?php
class CookieSSO
{
	public $dommain;
	public $msg;
	public function __construct($dommain,$key){
		$this->dommain = $dommain;
	}
	public function login($uid,$nick,$loginTime,$autoLogin = 0,$expire=0) {
		$nick = urlencode($nick);
		$sign = session_id();
		setcookie('_uid_',$uid,0,'/',$domain);
		$_SESSION['_uid_']=$uid;
		setcookie('_nick_',$nick,0,'/',$domain);
		setcookie('_loginTime_',$loginTime,0,'/',$domain);
		setcookie('_sign_',$sign,0,'/',$domain);
		setcookie('_autoLogin_',$autoLogin,$expire,'/',$domain);
	}
	
	public function authServer($uid,$sign){
		@session_id($sign);
		@session_start();
		$msg['error'] = false;
		if(isset($_SESSION['_uid_'])&&$uid!=$_SESSION['_uid_']){
			$msg['error'] = true;
			$msg['errorMsg'] = '校验码错误';
		}
		echo json_encode($msg);
	}
	/*
	 * 通过url用户信息是否有效，一般来说来说，
	 */
	public function authClient($url){
		$content = file_get_contents($url);
		$this->msg = $msg = json_decode($content);
		if ($msg['error']){
			return false;
		}else{
			return true;
		}
	}
}