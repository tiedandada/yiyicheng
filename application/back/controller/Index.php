<?php
namespace app\back\controller;
use think\Controller;
use think\facade\Session;
use think\Request;
use app\back\model\User;
use app\back\model\Goods_order;
class Index extends Base
{    public $user;
	 public $comment;
     public $goodsorder;
	function __construct(\think\App $app=null){
	parent::__construct($app);
	    $this->user=new User; 
	    $this->goodsorder=new Goods_order;
	}
    public function index()
    {           
        $arr['countuser']=$this->user->seleuser();
        $arr['countcomment']=$this->user->selecomment();
        $arr['countorder']=$this->goodsorder->seleorder();
        // echo $arr['countorder'];die;
    return $this->fetch('index',['admin_name'=>$this->admin_name,'ddurl'=>$this->ddurl,'arr'=>$arr]);

    }
    public function login(){
     
        return $this->fetch('login');
    }
}
