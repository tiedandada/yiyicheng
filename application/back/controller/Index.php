<?php
namespace app\back\controller;
use think\Controller;
use think\facade\Session;
use think\Request;
use app\back\model\User;
use app\back\model\Comment;
class Index extends Base
{    public $user;
	 public $comment;
	function __construct(\think\App $app=null){
	parent::__construct($app);
	    $this->user=new User; 
	    $this->comment=new Comment;
	}
    public function index()
    {   
        
        $countuser=$this->user->seleuser();
        $countcomment=$this->comment->selecomment();
        echo $countcomment;die;
    return $this->fetch('index',['admin_name'=>$this->admin_name,'dzurl'=>$this->ddurl,'countuser'=>$countuser]);

    }
    public function login(){
     
        return $this->fetch('login');
    }
}
