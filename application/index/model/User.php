<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    public function selectuser(){
       return User::select();
    }
    public function selectname(){
        return User::select();
    }
    public function insertuser($name){
        $user = new User;
        $user ->$name;
        return $user->save();
         echo $this->_Sql();
    }
}
