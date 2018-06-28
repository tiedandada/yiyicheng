<?php

namespace app\back\model;

use think\Model;

class Category extends Model
{
    function sumclass(){
    	return $this->select();
    }
}
