<?php

namespace app\back\model;

use think\Model;

class Comment extends Model
{
    function selecomment(){
    	return $this->select()->count();
    }
}
