<?php

namespace app\back\controller;

use think\Controller;
use think\facade\Request;
use app\back\model\Admin;
class Login extends Base
{   
	public $cadmin;
	function __construct(\think\App $app=null){
		parent::__construct($app);
		$this->cadmin=new Admin;
	}
    function index(){
    	
        $adname=Request::param('adname');
        $adminpwd=Request::param('adpwd');
        return $this->cadmin->duanadmin($adname,$adminpwd);
    }
    function upd_admin_pwd(){

    	return $this->fetch('form-wizard',['admin_name'=>$this->admin_name]);
    }
}
