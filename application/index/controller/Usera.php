<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;
class Usera extends Base
{ 
    public $newuser;
    public function __construct(\think\App $app = null) {               //全部实例化
        parent::__construct($app);
        $this->newuser=new User();
    }
    public function user_index(Request $request)
    {   
        //登录页面 
     if($user=$request->param()){
        $user['user_name']=$request->param('user_name');
        $user['user_pwd']=$request->param('user_pwd');
        $data = $this->newuser->selectuser()->toArray();
        $arr = $data; 
        //对象转换数组
        $sum ='';
        $one='';
        $zero='';
        foreach ($arr as $k=>$v){
        if($v['user_name'] == $user['user_name'] && $v['user_pwd']==$user['user_pwd']){
            $one=1;
        } else {
            $zero=0; 
        }
        }
            if($one==1){
                echo 1;
            } else {
                echo 0;
            } 
     } else {
         return $this->fetch(); 
     }
}
     public function user_register(Request $request){
        $data['user_name']= $request->param('name');
        $data['user_pwd']= $request->param('pwd');
        $data['user_email']= $request->param('email');
        $data['user_phone']= $request->param('phone');
        $data['user_img']=$request->param('img');
        $selectarr = $this->newuser->selectname()->toArray();
      $one='';
      $two='';
      $three='';
      $four='';
      foreach ($selectarr as $k=>$v){
         if($v['user_name']==$data['user_name']){
               $two=2;
          }else {
              if(isset($data['user_name']) && isset($data['user_email']) && isset($data['user_phone'])){
               $one=1; 
              }
          }
        }
        if($two==2){
            echo 2;
        } else {
            echo 1;
        }
      $this->toregister();
    }
    public function toregister(){
           return $this->fetch("/usera/user_register");
    }
}