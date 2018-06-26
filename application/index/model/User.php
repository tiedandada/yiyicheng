<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    public function selectuser($username){
       return $user= User::where('user_name', $username)->find();
    }
    public function selectname($username){
        return $user = User::where('user_name', $username)->find();
    }
    public function insertuser($name,$pwd,$email,$phone){
        $user = new User;
        $user->user_name = $name;
        $user->user_pwd = $pwd;
        $user->user_email = $email;
        $user->user_phone = $phone;
        $user->save();
    }
    
}
