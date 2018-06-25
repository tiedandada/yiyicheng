<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;
use app\index\model\Category;
use app\index\model\Goods;
class Base extends Controller
{ 
    public $newuser;
     public $category;
     public $headerDate;
     public $goods;
    public function __construct(\think\App $app = null) {               //全部实例化
        parent::__construct($app);
        $this->newuser=new User();
        $this->category = new Category(); 
        $this->goods = new Goods();
    }
   
    public function header(){
       return $this->category->pass();
    }
    public function shoppingone(){
      $one = $this->goods->join('category','goods.class_id=1')->select(); 
      return $one;
    }
    public function shoppingtwo(){
      $two = $this->goods->join('category','goods.class_id=2')->select(); 
      return $two;
    }
     public function shoppingthree(){
      $three = $this->goods->join('category','goods.class_id=6')->select(); 
      return $three;
    }
    public function shoppingfour(){
      $four = $this->goods->join('category','goods.class_id=7')->select(); 
      return $four;
    }
    public function shoppingfive(){
      $five = $this->goods->join('category','goods.class_id=3')->select(); 
      return $five;
    }
    public function shoppingsix(){
      $six = $this->goods->join('category','goods.class_id=5')->select(); 
      return $six;
    }
    public function timeshopping(){
        
      $time = $this->goods->timeshopping(); 
      
      return $time; 
    }
}