<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;
use think\facade\Session;
use think\Db;
class Usera extends Base
{ 
    public $newuser;
    public function __construct(\think\App $app = null) {               //全部实例化
        parent::__construct($app);
        $this->newuser=new User();
    }
    public function user_index(Request $request)
    {    //登录页面 
        $bades="你好游客";
     if($user=$request->param()){
        $user['user_name']=$request->param('user_name');
        $user['user_pwd']=$request->param('user_pwd'); 
        $data = $this->newuser->selectname($user['user_name']);
        if(empty($data)){
            return 0;die;                           //用户名不存在
        }else if($data['user_name'] == $user['user_name'] && $data['user_pwd']==$user['user_pwd']){
            return 1;                               //登录成功
            Session::set('name','thinkphp');
        } else {
            return 2;die;                           //用户名或密码不正确 
        }
     } else {
          return $this->fetch('user_index',['bades'=>$bades]);
     }
    
}
     public function user_register(Request $request){
           $user['name']= $request->param('name');
           $user['pwd']= $request->param('pwd');
           $user['email']= $request->param('email');
           $user['phone']= $request->param('phone');
           if(!empty($user['name']) && !empty($user['pwd']) && !empty($user['email']) && !empty($user['phone'])){
         $this->newuser->insertuser($user['name'],$user['pwd'],$user['email'],$user['phone']);
         return 5;
        }
        if(empty($user['name'])){
            return 3;die;
        }
        $selectarr = $this->newuser->selectname($user['name']);
        if(empty($selectarr)){
            return 1;
         }else{
            return 0;die;
        }
        $this->toregister();
    }
    public function toregister(){
        return $this->fetch("/usera/user_register");
    }
    public function user_stutes(Request $request){
        $data=$request->param();
        print_r($data['username']);
//        $userid=1;
//        Db::table('user')->where('user_id',$userid)->update([ 'user_name' => $data['username'],
//                      'user_pwd'=>$data['userpwd']
//            ]);
        $this->touser_stutes();
         
    }
    public function touser_stutes(){
        return $this->fetch('user_stutes');
    }
}