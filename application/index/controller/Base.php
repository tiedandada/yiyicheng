<?php

namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\User;
use app\index\model\Category;
use app\index\model\Goods;
use think\facade\Session;
class Base extends Controller
{ 
    public $newuser;
     public $category;
     public $headerDate;
     public $goods;
     public $bades;
    public function __construct(\think\App $app = null) {               //全部实例化
        parent::__construct($app);
        $this->newuser=new User();
        $this->category = new Category(); 
        $this->goods = new Goods();        
       if(empty(Session::has('user_name'))){
        $bades="您好游客,请登录";
    } else {
        $bades="你好".Session::get('name');
    }   
    }
   
    public function header(){
       return $this->category->pass();
    }
    public function shoppingone(){
      $one = $this->goods->where('class_id',1)->select(); 
      return $one;
    }
    public function shoppingtwo(){
      $two = $this->goods->where('class_id',3)->select(); 
      return $two;
    }
     public function shoppingthree(){
      $three = $this->goods->where('class_id',2)->select(); 
      return $three;
    }
    public function shoppingfour(){
      $four = $this->goods->where('class_id',4)->select(); 
      return $four;
    }
    public function shoppingfive(){
      $five = $this->goods->where('class_id',5)->select(); 
      return $five;
    }
    public function shoppingsix(){
      $six = $this->goods->where('class_id',6)->select(); 
      return $six;
    }
    public function timeshopping(){
        
      $time = $this->goods->timeshopping(); 
      
      return $time; 
    }
}