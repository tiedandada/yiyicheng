<?php
namespace app\back\controller;
use think\Controller;
use think\facade\Session;
use think\Request;
use app\back\model\User;

class Index extends Base
{    public $user;
	 public $comment;
	function __construct(\think\App $app=null){
	parent::__construct($app);
	    $this->user=new User; 
	    
	}
    public function index()
    {           
        $arr['countuser']=$this->user->seleuser();
        $arr['countcomment']=$this->user->selecomment();
        // echo $arr['countuser'];die;
    return $this->fetch('index',['admin_name'=>$this->admin_name,'dzurl'=>$this->ddurl,'arr'=>$arr]);

    }
    public function login(){
     
        return $this->fetch('login');
    }
}
