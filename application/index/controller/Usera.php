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
//        print_r($data);
        if(empty($data)){
            return 0;die;                           //用户名不存在
        }else if($data['user_pwd']==$user['user_pwd']){
           $arr= $data->toArray();
//           print_r($arr);
//                echo $arr['user_name'];
         $bades = Session::set('name',$arr['user_name']);                                //登录成功
//         $name=Session::get('name');
//         echo $name;
          return 2; 
        } else {
            return 1;die;                           //用户名或密码不正确 
        }
     } else {
         $bades="你好游客";
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
        $name=$this->newuser->selectname($data['username']);
        $arrname=$data['username'];
        $arr=$data['userpwd'];                    //更新
        
//        echo $arr;
        if (empty($name['user_name'])){
            return 1;
        } else  if(!empty ($data['userpwd'])){
            $name->user_pwd=$arr;
            $name->save();
            return 0;
       
        }      
//         $user = User::get(1);
//                $user->user_name = 'thinkphp';
//                $user->save();
//                $gag= Db::table('user')->update(['user_name'=>$data['usesrname'],'user_pwd'=>$data['userpwd']]); 
//                dump($gag);
            
        
          $this->touser_stutes('user_stutes',['arr'=>$arr]);
         
    }
    public function touser_stutes(){
        
        return $this->fetch('user_stutes');
    }
}