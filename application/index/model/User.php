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
        return $user->save($name);
//        echo $this->_Sql();
    }
}
