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
        $is=request()->controller() . '/' . request()->action();
        
     if (empty(Session::get('admin_name')) && $is!="Index/login") {
            
    	  $this->redirect('index/login');
    	}else{
            
    		$this->ddurl=request()->controller() . '/' . request()->action();
    		  // echo $this->ddurl;die;
            $this->admin_name=Session::get('admin_name');

             }
    }

    
}
