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
//        $user=$request->param();
//        print_r($user);
//        print_r($request->param());
     if($user=$request->param()){
        $user['user_name']=$request->param('user_name');
        $user['user_psd']=$request->param('user_psd');
//        print_r($user['user_name']);
        $data = $this->newuser->selectuser()->toArray();
        $arr = $data; 
        //对象转换数组
        $sum ='';
        foreach ($arr as $k=>$v){
//            print_r($v['user_name']);
        if($v['user_name'] == $user['user_name'] && $v['user_pwd']==$user['user_psd']){
            echo $sum;
        } else {
           echo $sum; 
        }
        }
      if($sum==1){
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
//        print_r($data);
        $selectarr = $this->newuser->selectname()->toArray();
//        print_r($selectarr);
      $one='';
      $two='';
      foreach ($selectarr as $k=>$v){
//          print_r($v);
          if($v['user_name']==$data['user_name']){
              echo $one;
          } else {
              echo $two;
          }
      }
      if (isset($one)){
          $one=0;
         
//         print_r($arr);
      } else {
          $one=1;
          $this->newuser->insertuser($data);
         print_r($data);
      }
      
      $this->toregister();
//          return $this->fetch();
    }
    public function toregister(){
           return $this->fetch("/usera/user_register");
    }
}