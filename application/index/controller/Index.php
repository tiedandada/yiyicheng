<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\controller\Iavig_index;
//use app\index\controller\Base;

class Index extends Base 
{
    public function index()
    { 
//        $time= $this->timeshopping()->toArray();
//        print_r($time);
//        foreach ($time as $k=>$v){
//            if($v['goods_time']>'2018-06-14 04:08:04'){
//                echo 111111111;
//            }
//        }
      return $this->fetch('index',['header'=> $this->header(),'two'=> $this->shoppingtwo()->toArray(),'one'=> $this->shoppingone()->toArray(),'three'=> $this->shoppingthree()->toArray(),'fouraa'=> $this->shoppingfour()->toArray(),'five'=> $this->shoppingfive()->toArray(),'six'=> $this->shoppingsix()->toArray()]);   //往header传值
     
    }
   
    public function iavig_index(){
      $arr = $this->fetch('index',['arr'=> $this->shopping()]); 
      print_r($arr);
      return $arr;

    }
}
