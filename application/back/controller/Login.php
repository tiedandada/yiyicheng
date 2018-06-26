<?php

namespace app\back\controller;

use think\Controller;
use think\facade\Request;
use app\back\model\Admin;
use think\facade\Session;
class Login extends Controller
{   
	  public $admin_name;
	function __construct(\think\App $app=null){
		parent::__construct($app);
		$cadmin;
        $this->cadmin=new Admin;
        
        $this->admin_name=Session::get('admin_name');
	}
    function index(){
    	
        $adname=Request::param('adname');
        $adminpwd=Request::param('adpwd');
        return $this->cadmin->duanadmin($adname,$adminpwd);
    }
    
    function loginout(){
        Session::delete('admin_name');
        return $this->fetch('Index/login');
    }
}
