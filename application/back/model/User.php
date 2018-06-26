<?php

namespace app\back\model;

use think\Model;
use think\Db;
class User extends Model
{
    function seleuser(){
    	
    	$count['user_count']=$this->select()->count('user_name');
        // $a=Db::table('comment')
        $a=$this->jion('user','user.user_id=comment.user_id')->select()->count('comment_con');
        dump($a);
    }
}
