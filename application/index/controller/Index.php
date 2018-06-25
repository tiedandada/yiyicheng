<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Iavig_index;
class Index extends Base 
{
    public function index()
    { 
      return $this->fetch('index',['header'=> $this->header(),'two'=> $this->shoppingtwo()->toArray(),'one'=> $this->shoppingone()->toArray(),'three'=> $this->shoppingthree()->toArray(),'fouraa'=> $this->shoppingfour()->toArray(),'five'=> $this->shoppingfive()->toArray(),'six'=> $this->shoppingsix()->toArray()]);   //往header传值
     
    }
}
