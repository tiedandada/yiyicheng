<?php
namespace app\index\controller;
use think\Request;
use app\index\controller\Iavig_index;
use think\facade\Session; 
class Index extends Base 
{
    public function index()
         
    {
        if(empty(Session::has('user_name'))){
        $bades="您好游客,请登录";
    } else {
        $bades="你好".Session::get('name');
    }
      return $this->fetch('index',['header'=> $this->header(),'two'=> $this->shoppingtwo()->toArray(),'one'=> $this->shoppingone()->toArray(),'three'=> $this->shoppingthree()->toArray(),'fouraa'=> $this->shoppingfour()->toArray(),'five'=> $this->shoppingfive()->toArray(),'six'=> $this->shoppingsix()->toArray(),'bades'=>$bades]);   //往header传值

    }
    
    


 
}
