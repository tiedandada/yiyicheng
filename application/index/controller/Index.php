<?php
namespace app\index\controller;
use think\Request;
use app\index\controller\Iavig_index;
use think\facade\Session; 
use think\Db;
class Index extends Base 
{
    public function index()
         
    {
        if(empty(Session::get('name'))){
        $bades="您好游客,请登录";
    } else {
        $bades="你好".Session::get('name');
    }
      return $this->fetch('index',['header'=> $this->header(),'two'=> $this->shoppingtwo()->toArray(),'one'=> $this->shoppingone()->toArray(),'three'=> $this->shoppingthree()->toArray(),'fouraa'=> $this->shoppingfour()->toArray(),'five'=> $this->shoppingfive()->toArray(),'six'=> $this->shoppingsix()->toArray(),'bades'=>$bades]);   //往header传值

    }
    public function souindex(Request $request){
        $data=$request->param('souindex');
       $arr= Db::table('goods')
        ->where([
        ['goods_name', 'like',"%{$data}%"]
        ])
        ->select();
       if(empty($arr)){
           return 1;die;
       } else {
//           print_r($arr);
           return 0;die;
       }
    }
    


 
}
