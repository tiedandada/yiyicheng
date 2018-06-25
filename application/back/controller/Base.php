<?php

namespace app\back\controller;

use think\Controller;
use think\facade\Session;
use think\Request;
class Base extends Controller
{    public $admin_name;
	 public $ddurl;
    function __construct(\think\App $app=null ){
    	parent::__construct($app);
     if (empty(Session::get('admin_name'))) {
    		return $this->fetch('login');
    	}else{
    		$this->ddurl=request()->controller() . '/' . request()->action();
    		  
            $this->admin_name=Session::get('admin_name');

             }
    }
}
