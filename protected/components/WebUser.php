<?php
/*
 * 扩展CWebUser添加信息到Yii:app()->user
 */
class WebUser extends CWebUser 
{ 
    public function login($identity, $duration) { 
    	//自动更新最后登录时间与IP
    	//添加同步登录cookie
        parent::login($identity, $duration); 
    }
    public function logout($destroySession=true){
    	//删除同步登陆cookie
    	parent::logout($destroySession); 
    }
} 