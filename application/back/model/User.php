<?php

namespace app\back\model;

use think\Model;
use think\Db;
class User extends Model
{
    function seleuser(){
    	
    	return $this->select()->count('user_name');
        
       
    }
    function selecomment(){
    	return $this->join('comment','user.user_id=comment.user_id')->select()->count('comment.comment_id');       
    }
   
}
